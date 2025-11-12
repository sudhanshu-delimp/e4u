<?php

namespace App\Http\Controllers\Escort;


use Auth;
use File;
use FFMpeg;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Escort;
use App\Models\PinUps;
use App\Models\Pricing;
use App\Models\Purchase;
use App\Models\PasswordHistory;
use App\Models\EscortPinup;
use App\Models\Tour;
use Illuminate\Support\Str;
use MongoDB\Driver\Session;
use Illuminate\Http\Request;
use App\Models\DashboardViewer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Traits\DataTablePagination;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreEscortRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\AttemptLogin\AttemptLoginRepository;

class EscortController extends Controller
{
    use DataTablePagination;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $escort;
    protected $user;
    protected $attemptlogin;

    public function __construct(AttemptLoginRepository $attemptlogin, EscortInterface $escort, UserInterface $user)
    {
        $this->escort = $escort;
        $this->user = $user;
        $this->attemptlogin = $attemptlogin;
    }

    public function index()
    {
        $result = $this->attemptlogin->findby(auth()->user()->id);
        $result2 = $this->attemptlogin->secondLastlogin(auth()->user()->id);

        $escorts = $this->escort->all();
        $tasks = Task::latest()->paginate(10);
        $viewer_array = DashboardViewer::where('user_id', auth()->id())->first(); 
        return view('escort.dashboard.index', compact('escorts', 'result', 'result2', 'tasks','viewer_array'));
    }


    public function customiseDashboard(Request $request)
    {
        
        $viewer_array = DashboardViewer::where('user_id', auth()->id())->first(); 
        return view('escort.dashboard.customise-dashboard', compact('viewer_array'));
    }

    public function updateCustomiseDashboard(Request $request)
    {
           $viewers = config('constants.dashboard_viewer.escort');
            $my_view = [];
            foreach($viewers as $view) :
                $my_view[$view['key']] = 0 ;
            endforeach;

          
            $viewer = DashboardViewer::firstOrCreate(
                ['user_id' => auth()->id()],
                ['my_view' =>  $my_view]
            );

            $data = $viewer->my_view;
            $data[$request->key] = (int) $request->value;

            $viewer->update(['my_view' => $data]);
            return response()->json(['success' => true, 'data' => $data]);
    }

    

    function add_listing()
    {
        return view('escort.dashboard.add_listing');
    }


    // function listing_checkout(UpdateEscortRequest $request) {
    function listing_checkout(Request $request)
    {
        $escort_ids = $request->input('escort_id');
        $start_dates = $request->input('start_date');
        $end_dates = $request->input('end_date');
        $memberships = $request->input('membership');

        $data = array_map(function ($escort_id, $start_date, $end_date, $membership) {
            return [
                'escort_id' => $escort_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'membership' => $membership,
            ];
        }, $escort_ids, $start_dates, $end_dates, $memberships);
        $checkoutData = [];
        foreach ($escort_ids as $key => $escort_id) {
            $index = date('Ymd', strtotime($start_dates[$key])) . rand(100, 999);
            $checkoutData[$index] = [
                'escort_id'=>$escort_id,
                'start_date'=>$start_dates[$key],
                'end_date'=>$end_dates[$key],
                'membership'=>$memberships[$key]
            ];
        }
        $escorts = Escort::whereIn('id', $escort_ids)->pluck('name', 'id')->toArray();
        //save here in session to retrieve later
        session()->put('checkout', $checkoutData);
        return view('escort.dashboard.checkoutPage', compact('data', 'escorts'));
    }


    function listings($type)
    {
        $relatedEscorts = null;
        /*$relatedEscorts = Escort::with(['purchase' => function ($query) use ($type) {
                if($type == 'past') {
                    $query->where('end_date', '<', date('Y-m-d'));
                } else {
                    $query->where('end_date', '>=', date('Y-m-d'));
                }
                $query->orderBy('start_date', 'ASC');
            }])
            ->whereHas('purchase')
            ->with([
                'Brb' => function($query){
                    $query->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                }
            ])
            ->where('user_id', auth()->user()->id)
            ->orderBy('name', 'ASC')
            ->get()->toArray();*/

        return view('escort.dashboard.listings', compact('type', 'relatedEscorts'));
    }

    public function escortList($type)
    {
        $today  = Carbon::today();

        $escort = auth()->user()->escort;

        $active_escorts = Escort::select(['id', 'name', 'profile_name', 'state_id', 'city_id','membership','start_date','end_date'])
            ->with('state', function ($query) {
                $query->select(['id', 'name', 'country_id']);
            })
            ->where(['enabled' => 1, 'user_id' => auth()->user()->id])
            ->whereNotNull('profile_name')
            ->get()->toArray();

        $suspended_escorts = Escort::select(['id', 'name', 'profile_name', 'state_id', 'city_id','membership','start_date','end_date'])
            ->where('enabled', 1)
            ->where('user_id', auth()->user()->id)
            ->whereNotNull('profile_name')
            ->where('utc_end_time', '>=', Carbon::now())
            ->get();

            $activePinup = EscortPinup::where('user_id', auth()->user()->id)
            ->where('utc_end_time', '>=', $today) // still active (today or future)
            ->exists();

        return view('escort.dashboard.list', compact('escort', 'type', 'active_escorts','suspended_escorts','activePinup'));
    }

    public function dataTable($type = NULL)
    {
        $conditions = [];
        if ($type == 'current') {
            $conditions[] = ['enabled', 1];
        } elseif ($type == 'past') {
            $conditions[] = ['enabled', 0];
        }
        list($result, $count) = $this->escort->paginatedList(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column'] == 1 ? 6 : request()->get('order')[0]['column']),
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            auth()->user()->id,
            $conditions




            //auth()->user()->state_id,
            //$usr_type->agentEscorts->pluck("id")->toArray(),
        );

        // foreach($result as $key => $item) {

        //     if($item->getRawOriginal('gender')==3)
        //         $item->stage_name = 'TS-'.$item->name;
        //         else
        //         $item->stage_name = $item->name;


            
        // }


        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        //dd($result);

        return response()->json($data);
    }

    public function dataTableListing($type = NULL)
    {

        $start = request()->get('start');
        $limit = request()->get('length');
        $order_key = (request()->get('order')[0]['column'] == 1 ? 6 : request()->get('order')[0]['column']);
        $dir = request()->get('order')[0]['dir'];
        $columns = request()->get('columns');
        $search = request()->get('search')['value'];
        $user_id = auth()->user()->id;
        $ascDesc = 'ASC';
        $recordTotal = 0;
        $dataTableData = [];
        //$dataTablePagination = (new DataTablePagination);
        //$order = $dataTablePagination->getOrder($order_key);
        // $searchables = $dataTablePagination->getSearchableFields($columns);

        $result = Escort::with(['purchase' => function ($query) use ($type, $ascDesc, $start, $limit) {
            if ($type == 'past') {
                $query->where('end_date', '<', date('Y-m-d'));
                $ascDesc = 'DESC';
            } else {
                $query->where('end_date', '>=', date('Y-m-d'));
            }
             $query->offset($start)
            ->limit($limit)

           ->orderBy('start_date', $ascDesc);
        }])
            ->whereHas('purchase')
            ->with([
                'Brb' => function ($query) {
                    $query->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                }
            ])
            ->where('profile_name', '!=', null)
            ->where('user_id', auth()->user()->id);

        if ($search) {
            $result = $result->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('profile_name', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }
        $result = $result->get()->toArray();
       // For count
        $resultNoLImit = Escort::with(['purchase' => function ($query2) use ($type, $ascDesc, $start, $limit) {
            if ($type == 'past') {
                $query2->where('end_date', '<', date('Y-m-d'));
                $ascDesc = 'DESC';
            } else {
                $query2->where('end_date', '>=', date('Y-m-d'));
            }
           $query2->orderBy('start_date', $ascDesc);
        }])
            ->whereHas('purchase')
            ->with([
                'Brb' => function ($query2) {
                    $query2->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                }
            ])
            ->where('profile_name', '!=', null)
            ->where('user_id', auth()->user()->id);

        if ($search) {
            $resultNoLImit = $resultNoLImit->where(function ($query2) use ($search) {
                $query2->where('id', 'like', "%{$search}%")
                    ->orWhere('profile_name', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }
        $resultNoLImit = $resultNoLImit->get();
        foreach ($resultNoLImit as $escort2) {
            if ($escort2['purchase']) {
               
                foreach ($escort2['purchase'] as $purchase2) {
                     $recordTotal++;
                }
            }
        }

        $i = 1;

        foreach ($result as $escort) {
            if ($escort['purchase']) {
                // $recordTotal++;
                foreach ($escort['purchase'] as $purchase) {
                    $daysDiff = 0;
                    $brb = $escort['profile_name'];
                    $totalAmount = 0;
                    if (isset($escort['brb'][0]['brb_time'])) {
                        $brb =
                            '<span id="brb_' .
                            $escort['id'] .
                            '" >' .
                            $escort['profile_name'] .
                            ' <sup
                                            title="Brb at ' .
                            date(
                                'd-m-Y h:i A',
                                strtotime($escort['brb'][0]['brb_time']),
                            ) .
                            '"
                                            class="brb_icon">BRB</sup></span>';
                    }
                    if (!empty($purchase['start_date'])) {
                        $daysDiff = Carbon::parse(
                            $purchase['end_date'],
                        )->diffInDays(Carbon::parse($purchase['start_date']))+1;
                        if($purchase['start_date'] == $purchase['end_date']) {
                            $daysDiff = 1;
                        }
                        [$discount, $rate] = calculateTatalFee(
                            $purchase['membership'],
                            $daysDiff,
                        );
                        $totalAmount = $rate;
                        $totalAmount -= $discount;
                        $totalAmount = formatIndianCurrency($totalAmount);
                    }
                    $dataTableData[] = [
                        //'sl_no' => $i++,
                        'id' => $escort['id'],
                        //'profile_name' => $escort['profile_name'],
                        'profile_name' => $escort['profile_name'] ? $brb : 'NA',
                        //'city' =>
                        config(
                            "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
                        ) .
                            '<br>' .
                            config("escorts.profile.states.$escort[state_id].stateName"),
                        'city' => config(
                            "escorts.profile.states.$escort[state_id].stateName",
                        ),
                        'name' => $escort['name'],
                        'start_date' => date(
                            'd-m-Y',
                            strtotime($purchase['start_date']),
                        ),
                        'end_date' => date('d-m-Y', strtotime($purchase['end_date'])),
                        'days' => $daysDiff,
                        'membership' => $purchase['membership'] ? getMembershipType($purchase['membership']) : "NA",
                        'fee' => $totalAmount,
                    ];
                }
            }
        }
        // print_r($dataTableData);die;
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($recordTotal),
            "recordsFiltered" => intval($recordTotal),
            "data"            => $dataTableData
        );

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeState()
    {
        $user = auth()->user();
        $homeState = $user->state_id;

        $escort = $this->escort->all();
        $escorts = $escort->whereNotNull('state_id')->where('state_id', '!=', auth()->user()->state_id)->where('user_id', auth()->user()->id)->where('default_setting', 0)->unique('state_id');

        // dd( $escorts);
        // foreach($escorts as $states) {

        //          echo $states->state_id."</br>";
        //          echo $states->state->name."</br>";


        // }
        //  dd("hlfhsd");
        return view('escort.dashboard.archives.home-state', compact('escorts', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEscortRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEscortRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function show(Escort $escort)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $escort = User::where('id',auth()->user()->id)->first();
        return view('escort.dashboard.my-account', compact('escort'));
    }
    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);

        return view('escort.dashboard.change-password', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEscortRequest  $request
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEscortRequest $request)
    {
        $data = [];
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'contact_type' => $request->contact_type,
            // 'phone' => $request->phone,
            //'city_id'=>$request->city_id,
            //'country_id'=>$request->country_id,
            // 'state_id'=>$request->state_id,
           // 'email' => $request->email ? $request->email : null,
            //'social_links'=>$request->social_links,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function profileTourPermissionUpdate(UpdateEscortRequest $request)
    {
        $data = [];
        $data = [
            'viewer_contact_type' => $request->viewer_contact_type,
            'tour_permissition_type' => $request->tour_permissition_type,
            'profile_creator' => $request->profile_creator,
            //'contact_type' => $request->contact_type,
            // 'phone' => $request->phone,
            //'city_id'=>$request->city_id,
            //'country_id'=>$request->country_id,
            // 'state_id'=>$request->state_id,
            // 'email'=>$request->email ? $request->email : null,
            //'social_links'=>$request->social_links,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function notificationUpdate(UpdateEscortRequest $request)
    {
        $playmateAvailable = null;
        if($request->notification_feature && in_array('available_playmate', $request->notification_feature)){
            $playmateAvailable = true;
        }

        $data = [
            'alert_notifications' => $request->alert_notifications,
            'agent_communications' => $request->agent_communications,
            'notification_features' => $request->notification_feature,
            'available_playmate' => $playmateAvailable,
            'idle_preference_time' => $request->idle_time,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(UpdateEscortRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $msg = true;

        // verify current password
        if (!Hash::check($request->password, $user->password)) {
            $msg = false;
            $message = 'Invalid current password';
            return response()->json(compact('msg', 'message'));
        }

        // check new password against current and last 5 previous passwords
        $newPassword = $request->new_password;

        // Collect last 5 password hashes
        $previousHashes = PasswordHistory::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->pluck('password')
            ->all();

        // Also include current hash to prevent reusing current
        $hashesToCheck = array_merge([$user->password], $previousHashes);


        foreach ($hashesToCheck as $oldHash) {
            if (Hash::check($newPassword, $oldHash)) {
                $msg = false;
                $message = 'You cannot reuse any of your last 5 passwords.';
                return response()->json(compact('msg', 'message'));
            }
        }

        // Store current password to history BEFORE updating
        if (!empty($user->password)) {
            PasswordHistory::create([
                'user_id' => $user->id,
                'password' => $user->password,
            ]);
        }

        // Update to new password
        $this->user->store([
            'password' => Hash::make($newPassword),
        ], $user->id);

        // Trim history to last 5 (delete older ones)
        $historyIdsToKeep = PasswordHistory::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->pluck('id')
            ->all();

        PasswordHistory::where('user_id', $user->id)
            ->whereNotIn('id', $historyIdsToKeep)
            ->delete();

        return response()->json(compact('msg'));
    }
    public function updatePasswordExpiry(UpdateEscortRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $error = true;

        //'Write here your update password code';
        $user->passwordSecurity->password_expiry_days = $request->password_expiry_days;
        $user->passwordSecurity->password_notification = $request->password_notification;
        $user->passwordSecurity->password_updated_at = Carbon::now();
        $user->passwordSecurity->save();
        // dd( $request->all());
        return response()->json(compact('error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escort $escort)
    {
        //
    }

    public function escortsPlayMates($escort_id)
    {
        $escort = $this->escort->find($escort_id);

        return view('escort.dashboard.fragments.playmate-list', compact('escort'));
    }

    //public function findPlaymatesId($escort_id)
    public function findPlaymatesId()
    {
        //$escort_id = request()->get('escort_id');
        //
        $str = request()->get('query');
        $escort_id = request()->get('escort_id');
        //dd($str);
        $playmates = $this->escort->escortsForPlaymates($escort_id, $str);
        //dd($playmates);

        return response()->json($playmates);
    }
    public function findPlaymates()
    {
        $escort_id = request()->get('escort_id');
        $str = request()->get('query');

        $playmates = $this->escort->escortsForPlaymates($escort_id, $str);

        return response()->json($playmates);
    }

    public function addPlaymate()
    {

        $escort = $this->escort->find(request()->get('escort_id'));

        $escort->playmates()->attach(request()->get('playmate_id'));

        return view('escort.dashboard.fragments.playmate-list', compact('escort'));
    }

    public function removePlaymate()
    {
        $escort = $this->escort->find(request()->get('escort_id'));

        $escort->playmates()->detach(request()->get('playmate_id'));

        $template = view('escort.dashboard.fragments.playmate-list', compact('escort'))->render();

        $message = 'Playmate removed successfully';

        return response()->json(compact('template', 'message'));
    }

    public function ProfileInformation()
    {
        return view('escort.dashboard.profileInformation');
    }
    public function uploadAvatar()
    {
        return view('escort.dashboard.profileAvatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request, $id)
    {
        try {
            if ((int) Auth::id() !== (int) $id) {
                return response()->json(['type' => 1, 'message' => 'Unauthorized'], 403);
            }

            $src = $request->input('src');

            $semicolonPos = strpos($src, ';');
            $mime = substr($src, 5, $semicolonPos - 5); // image/jpeg
            $extension = explode('/', $mime)[1] ?? 'png';
            $extension = strtolower($extension) === 'jpeg' ? 'jpg' : strtolower($extension);

            $commaPos = strpos($src, ',');
            $base64 = substr($src, $commaPos + 1);
            $binary = base64_decode($base64, true);

            $dir = public_path('avatars');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $avatarOwner = Auth::id();
            $avatarName = time() . '-' . $avatarOwner . '.' . $extension;
            $fullPath = $dir . DIRECTORY_SEPARATOR . $avatarName;
            if (File::put($fullPath, $binary) === false) {
                throw new \RuntimeException('Failed to save avatar file');
            }

            $user = $this->user->find($id);
            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }

            if (!empty($user->avatar_img)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $user->avatar_img;
                if (File::exists($oldPath)) {
                    @File::delete($oldPath);
                }
            }

            $user->avatar_img = $avatarName;
            $user->save();

            $type = 0;
            return response()->json(compact('type','avatarName'));
        } catch (\Throwable $e) {
            \Log::error('Error saving avatar for user ' . $id . ': ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => $e->getMessage()], 500);
        }
    }
    public function removeMyAvatar()
    {
        try {
            $user = $this->user->find(auth()->user()->id);
            
            if (!$user) {
                return response()->json([ 'type' => 1,'message' => 'User not found'], 404);
            }
            $path =  public_path('/avatars/' . $user->avatar_img);
            if(File::exists($path)){
                File::delete($path);
                $user->avatar_img = null;
                $user->save();
            }else{
                return response()->json(['type' => 1, 'message' => 'Image not found!']);
            }
           $defaultImg = asset(config('constants.escort_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg ]);
            
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json([ 'type' => 1,'message' => 'An error occurred while removing avatar. Please try again.' ], 500);
        }
    }
    public function notificationsFeatures()
    {
        return view('escort.dashboard.profileNotifications');
    }
    public function getGeoLocationProfiles(Request $request){
        try {
            $response['success'] = false;
            $state_id = $request->state;
            $profiles = Escort::where(['user_id'=>auth()->user()->id,'state_id'=>$state_id])
                ->whereNotNull('profile_name')
                ->whereDoesntHave('purchase', function ($query) {
                    $query->where('utc_end_time', '>=', Carbon::now());
                })
                ->get(['id','name','profile_name','state_id']);
            if($profiles->isNotEmpty()){
                $response['success'] = true;
                $response['profiles'] = $profiles;
                $response['message'] = "Profiles are available.";
            }
            else{
                $response['message'] = "You need to create at least one Profile for the Location.";
            }
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function validateDateRange(Request $request){
        try {
            $response['success'] = false;
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $escortId = $request->escortId;
            $escort = $this->escort->find($escortId);
            $startDate = '11-11-2025';
            $endDate = '15-11-2025';

            $conflictExists = Purchase::overlapping($startDate, $endDate)
                ->whereHas('escort', function ($q) use ($escort) {
                $q->where('user_id',auth()->user()->id);
                $q->where('state_id', '<>', $escort->state_id);
            })
            ->with('escort:id,state_id')
            ->orderByDesc('end_date')
            ->first()?->escort?->state?->name;

            if($conflictExists){
                $response['success'] = true;
                $response['message'] = "You have a Current or Upcomming Listing in {$conflictExists}. To create multiple Listings across Locations, use the Tour creator.";
            }

            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAvailablePlaymates(Request $request){
        try {
            $response['success'] = false;
            $selectedStateId = $request->input('state_id');
            $accountUserId = auth()->user()->id;
            $userIds = User::where('current_state_id', $selectedStateId)->pluck('id');
            $escorts = Escort::whereIn('user_id', $userIds)
            ->where('state_id', $selectedStateId)
            ->where('user_id', '!=', $currentUserId)
            ->get();

            if($conflictExists){
                $response['success'] = true;
                $response['playmates'] = $escorts;
            }

            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }



      public function showPricingsummary() {
        
        $states = config('escorts.profile.states');
        $advertings= config('agent.advertising');
        $membership_types = config('agent.membership_types');
        $no_of_members = config('agent.no_of_members');

        
        return view('escort.dashboard.Community.pricing',compact('advertings', 'membership_types','states','no_of_members'));
    }
}
