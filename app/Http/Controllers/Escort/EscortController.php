<?php

namespace App\Http\Controllers\Escort;

use Auth;
use File;
use FFMpeg;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\Tour;
use App\Models\User;
use App\Models\Escort;
use App\Models\PinUps;
use App\Models\Pricing;
use App\Models\Purchase;
use App\Models\EscortPinup;
use Illuminate\Support\Str;
use MongoDB\Driver\Session;
use App\Models\EscortBumpup;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\DashboardViewer;
use App\Models\PasswordHistory;
use Illuminate\Http\JsonResponse;
use App\Models\FeesSupportService;
use Illuminate\Support\Facades\DB;
use App\Models\PricingFeeUpdateLog;
use App\Traits\DataTablePagination;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\FeesConciergeService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use App\Models\VariablLoyaltyProgram;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreEscortRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\Purchase\PurchaseInterface;
use App\Repositories\Playmate\PlaymateInterface;
use App\Repositories\AttemptLogin\AttemptLoginRepository;
use App\Models\EscortNotification;
use App\Models\AdvertiserDiscount;
use App\Services\WalletService;
use App\Services\EscortListingFeatureService;
use App\Services\PinPaymentService;
use App\Mail\PaymentMailer;
use App\Mail\Escort\Listing\CancelMailer;
use Illuminate\Support\Facades\Mail;


class EscortController extends BaseController
{
    use DataTablePagination;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $escort;
    protected $purchase;
    protected $user;
    protected $attemptlogin;
    protected $walletService;
    protected $pinService;
    protected $featureService;
    protected $playmateHistory;
    protected $account;

    public function __construct(AttemptLoginRepository $attemptlogin, EscortInterface $escort, UserInterface $user, PurchaseInterface $purchase, WalletService $walletService, PinPaymentService $pinService, EscortListingFeatureService $featureService, PlaymateInterface $playmateHistory)
    {
        $this->escort = $escort;
        $this->purchase = $purchase;
        $this->user = $user;
        $this->attemptlogin = $attemptlogin;
        $this->walletService = $walletService;
        $this->pinService = $pinService;
        $this->featureService = $featureService;
        $this->playmateHistory = $playmateHistory;

        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $result = $this->attemptlogin->findby(auth()->user()->id);
        $result2 = $this->attemptlogin->secondLastlogin(auth()->user()->id);
        if ($result[0]->login_count <= 1 && !session()->has('welcome_popup_closed')) {
            session(['show_welcome_popup' => true]);
        }
        $escorts = $this->escort->all();
        $tasks = Task::latest()->paginate(10);
        $viewer_array = DashboardViewer::where('user_id', auth()->id())->first();
        $expiringListings = $this->escort->getExpiringListings(0, 2, true);
        $notification = $this->getActiveNotification();
        return view('escort.dashboard.index', compact('escorts', 'result', 'result2', 'tasks', 'viewer_array', 'expiringListings', 'notification'));
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
        foreach ($viewers as $view) :
            $my_view[$view['key']] = 0;
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
        $user = auth()->user();
        if ($user->status == "Suspended") {
            return redirect()->route('escort.dashboard')->with('info', config('common.access_denied_suspended_msg'));
        }
        session()->forget('listing_checkout_done');
        return view('escort.dashboard.add_listing');
    }


    // function listing_checkout(UpdateEscortRequest $request) {
    function listing_checkout(Request $request, $type)
    {
        // if (session()->has('listing_checkout_done')) {
        //     return redirect()->route('escort.account.add-listing');
        // }

        $checkout_type = !empty($request->checkout_type) ? $request->checkout_type : null;
        $refundAmount = 0.00;
        switch ($request->checkout_type) {
            case 'upgrade': {
                    $escort_id = $request->input('escort_id');
                    $newMembership = $request->input('membership');
                    $escortDetail = getEscortDetail($escort_id);
                    $today = Carbon::today($escortDetail->time_zone);

                    $oldPurchase = $escortDetail->mainPurchase;
                    $start_date = $today->copy()->addDay()->format('d-m-Y');
                    $end_date = $oldPurchase->end_date;
                    $oldMembership = $oldPurchase->membership;

                    $escort_ids = [$escort_id];
                    $start_dates = [$start_date];
                    $end_dates = [$end_date];
                    $memberships = [$newMembership];

                    $refundAmount = getListingRefundAmount($escortDetail);
                }
                break;
            default: {
                    $escort_ids = $request->input('escort_id');
                    $start_dates = $request->input('start_date');
                    $end_dates = $request->input('end_date');
                    $memberships = $request->input('membership');
                }
                break;
        }
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
                'escort_id' => $escort_id,
                'start_date' => $start_dates[$key],
                'end_date' => $end_dates[$key],
                'membership' => $memberships[$key]
            ];
        }
        $escorts = Escort::whereIn('id', $escort_ids)->pluck('name', 'id')->toArray();
        //save here in session to retrieve later
        session()->put('checkout', $checkoutData);
        return view('escort.dashboard.checkoutPage', compact('data', 'escorts', 'checkout_type', 'refundAmount', 'type'));
    }

    public function listing_success(Request $request)
    {
        $redirect_url = null;
        session()->forget('listing_checkout_done');
        $sessionRoutes = [
            'checkout' => route('escort.dashboard.listings', 'current'),
            'tour_checkout' => route('escort.view.tour.list', 'current'),
        ];

        foreach ($sessionRoutes as $sessionKey => $route) {
            if (session()->has($sessionKey)) {
                session()->forget($sessionKey);
                $redirect_url = $route;
                break;
            }
        }

        if (!$redirect_url) {
            return redirect()->route('escort.dashboard');
        }

        return view('escort.dashboard.complete-listings', compact('redirect_url'));
    }


    function listings($type)
    {
        $relatedEscorts = null;
        return view('escort.dashboard.listings', compact('type', 'relatedEscorts'));
    }

    public function escortList($type)
    {
        $today  = Carbon::today();

        $escort = auth()->user()->escort;

        $active_escorts = Escort::select(['id', 'name', 'profile_name', 'state_id', 'city_id', 'membership', 'start_date', 'end_date'])
            ->with('state', function ($query) {
                $query->select(['id', 'name', 'country_id']);
            })
            ->where(['enabled' => 1, 'user_id' => auth()->user()->id])
            ->whereNotNull('profile_name')
            ->get()->toArray();

        $suspended_escorts = Escort::select(['id', 'name', 'profile_name', 'state_id', 'city_id', 'membership', 'start_date', 'end_date'])
            ->where('enabled', 1)
            ->where('user_id', auth()->user()->id)
            ->whereNotNull('profile_name')
            ->where('utc_end_time', '>=', Carbon::now())
            ->get();

        $activePinup = EscortPinup::where('user_id', auth()->user()->id)
            ->whereNotNull('start_date')
            ->where('utc_end_time', '>=', $today) // still active (today or future)
            ->exists();

        return view('escort.dashboard.list', compact('escort', 'type', 'active_escorts', 'suspended_escorts', 'activePinup'));
    }

    public function dataTable($type = NULL)
    {
        $conditions = [];
        if ($type == 'current') {
            //$conditions[] = ['enabled', 1];
            $conditions[] = ['utc_end_time', '>=', now()];
        } elseif ($type == 'past') {
            $conditions[] = ['enabled', 0];
            $conditions[] = ['utc_end_time', NULL];
        }
        list($result, $count) = $this->escort->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            auth()->user()->id,
            $conditions
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "other" => request()->get('order')[0]['column'],
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }

    public function dataTableListing($type = NULL)
    {
        $conditions = [];
        $conditionsIn = [];
        if ($type == 'current') {
            $conditions[] = ['end_date', '>=', date('Y-m-d')];
            $conditions[] = ['status', '=', 'listed'];
            $conditionsIn['column'] = 'status';
            $conditionsIn['condition'] = ['listed'];
        } elseif ($type == 'past') {
            $conditions[] = ['end_date', '<', date('Y-m-d')];
        }
        list($result, $count) = $this->purchase->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            auth()->user()->id,
            $conditions
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
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
        $escort = User::where('id', auth()->user()->id)->first();
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
            //'gender' => $request->gender,
            'contact_type' => $request->contact_type,
            // 'phone' => $request->phone,
            //'city_id'=>$request->city_id,
            //'country_id'=>$request->country_id,
            // 'state_id'=>$request->state_id,
            // 'email' => $request->email ? $request->email : null,
            //'social_links'=>$request->social_links,
            'pay_id_name' => $request->PayID_Name,
            'pay_id_no' => $request->PayID_NO,
            'social_media_consent' => $request->social_media_consent,

        ];

        if (isset($request->gender) && $request->gender != "")
            $data['gender'] = $request->gender;

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
        if ($request->notification_feature && in_array('available_playmate', $request->notification_feature)) {
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
            return response()->json(compact('type', 'avatarName'));
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
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }
            $path =  public_path('/avatars/' . $user->avatar_img);
            if (File::exists($path)) {
                File::delete($path);
                $user->avatar_img = null;
                $user->save();
            } else {
                return response()->json(['type' => 1, 'message' => 'Image not found!']);
            }
            $defaultImg = asset(config('constants.escort_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
    }


    public function notificationsFeatures()
    {
        $setting = User::with('escort_settings')->where('id', auth()->user()->id)->first();
        return view('escort.dashboard.profileNotifications', compact('setting'));
    }

    public function updateNotificationsFeatures(Request $request)
    {
        $user = auth()->user();


        $data = [
            'features_viewer_notifications_forward_v_alerts' => $request->features_viewer_notifications_forward_v_alerts ?? '0',
            'features_allow_viewers_to_ask_you_a_question' => $request->features_allow_viewers_to_ask_you_a_question ?? '0',
            'features_allow_viewers_to_send_you_a_text_message' => $request->features_allow_viewers_to_send_you_a_text_message ?? '0',
            'features_i_am_available_as_a_playmate' => $request->features_i_am_available_as_a_playmate ?? '0',

            'auto_recharge_no' => $request->auto_recharge_no == '1' ? '1' : '0',
            'auto_recharge_100' => $request->auto_recharge_100 == '1' ? '1' : '0',
            'auto_recharge_250' => $request->auto_recharge_250 == '1' ? '1' : '0',
            'auto_recharge_500' => $request->auto_recharge_500 == '1' ? '1' : '0',

            'agent_receive_communications' => $request->agent_receive_communications ?? '0',
            'agent_send_communications' => $request->agent_send_communications ?? '0',

            'alert_notification_email' => $request->alert_notification_email ?? '0',
            'alert_notification_text' => $request->alert_notification_text ?? '0',

            'idle_preference_time' => $request->idle_preference_time ?? '60',

            'twofa' => $request->twofa ?? '2',

            'subscriptions_num' => $request->subscriptions_num ?? '0',
            'subscriptions_state' => $request->subscriptions_state ?? null,
            'datatable_entries' => $request->entries ?? '25',

        ];

        $setting = $user->escort_settings;

        if ($setting) {
            $setting->update($data);
            $user->available_playmate = (int)$request->features_i_am_available_as_a_playmate ?? 0;
            $user->save();
        } else {
            $user->escort_settings()->create(array_merge($data, ['user_id' => $user->id]));
        }

        return $this->successResponse('Notification settings updated successfully!');
    }




    public function getGeoLocationProfiles(Request $request)
    {
        try {
            $response['success'] = false;
            $state_id = $request->state;
            $profiles = Escort::where(['user_id' => auth()->user()->id, 'state_id' => $state_id])
                ->whereNotNull('profile_name')
                // ->whereDoesntHave('purchase', function ($query) {
                //     $query->where('utc_end_time', '>=', Carbon::now());
                // })
                ->whereNull('utc_end_time')
                ->get(['id', 'name', 'profile_name', 'state_id']);
            if ($profiles->isNotEmpty()) {
                $response['success'] = true;
                $response['profiles'] = $profiles;
                $response['message'] = "Profiles are available.";
            } else {
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

    public function validateDateRange(Request $request)
    {
        try {
            $response['success'] = true;
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $escortId = $request->escortId;
            $escort = $this->escort->find($escortId);

            $conflictExists = Purchase::overlapping($startDate, $endDate)
                ->whereHas('escort', function ($q) use ($escort) {
                    $q->where('user_id', auth()->user()->id);
                    $q->where('state_id', '<>', $escort->state_id);
                })
                ->with('escort:id,state_id')
                ->orderByDesc('end_date')
                ->first()?->escort?->state?->name;

            if ($conflictExists) {
                return response()->json([
                    'success'  => false,
                    'redirect_url' => route('escort.store.tour'),
                    'message' => "You have a Current or Upcomming Listing in {$conflictExists}. To create multiple Listings across Locations, use the Tour creator.",
                ], 422);
            }
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAvailablePlaymates(Request $request)
    {
        try {
            $response['success'] = false;
            $selectedStateId = $request->input('state_id');
            $accountUserId = auth()->user()->id;
            $userIds = User::where('current_state_id', $selectedStateId)->pluck('id');
            $escorts = Escort::whereIn('user_id', $userIds)
                ->where('state_id', $selectedStateId)
                ->where('user_id', '!=', $currentUserId)
                ->get();

            if ($conflictExists) {
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



    public function showPricingsummary()
    {

        $states = config('escorts.profile.states');
        $membership_types = MembershipPlan::where('is_for_calculater', '1')->get()->toArray();
        $no_of_members = config('agent.no_of_members');
        $advertings = Pricing::with('memberships')->get()->toArray();
        $discount = AdvertiserDiscount::getActiveForUser($this->account->id);
        if ($this->account->type == ESCORT && $discount) {
            $rows = array_map(function ($item) use ($discount) {
                if (in_array($item['membership_id'], ['1', '2', '3'])) {
                    $item['special_discount'] = $discount->value;
                    $item['new_rate'] = number_format($discount->discountAmount($item['price']), 2);
                    $item['discount_amount'] = AdvertiserDiscount::getNetDiscount((object)$item, $discount);
                }
                return $item;
            }, $advertings);
            $advertings = $rows;
        }
        $pricing_log = PricingFeeUpdateLog::get()->toArray();

        $fees_concierge_services = FeesConciergeService::all();
        $fees_support_services = FeesSupportService::all();
        $variablLoyaltyProgram = VariablLoyaltyProgram::all();
        return view('escort.dashboard.Community.pricing', compact('advertings', 'membership_types', 'states', 'no_of_members', 'fees_concierge_services', 'fees_support_services', 'variablLoyaltyProgram'));
    }

    public function bumpup_register(Request $request)
    {
        try {
            $escortBumpUp = $this->featureService->registerBumpUp($request);
            if ($request->filled('payment_token')) {
                $paymentId = decrypt($request->payment_token);
                $payment = $this->pinService->paymentHistoryDetail($paymentId);
                if (!empty($payment)) {
                    $escortBumpUp->paymentItems()->create([
                        'payment_history_id' => $payment->id,
                        'amount' => $payment->amount
                    ]);
                }

                /* Send Payment Mail */
                $mailConfig = config("payment_mail_templates.bumpUp");
                $mainAccount = $this->account;
                Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment'), $mailConfig['subject']));
            }

            return response()->json([
                'success' => true,
                'message' => 'Profile ID ' . $escortBumpUp->escort_id . ' has been Bumped Up.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while booking the Pinup.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function getUpgradeAmount(Request $request)
    {
        try {
            $profileId = $request->escortId;
            $membershipId = $request->membershipId;
            $profileDetail = getEscortDetail($profileId);
            $refundAmount = getListingRefundAmount($profileDetail);
            list($newDicount, $newAmount) = calculateTotalFee($membershipId, $profileDetail->left_listing_days, $this->account);
            $net_paid_amount = number_format($newAmount - $refundAmount, 2, '.', '');

            return response()->json([
                'success' => true,
                'net_amount' => $net_paid_amount,
                'newAmount' => $newAmount,
                'fee_token' => encrypt($net_paid_amount),
                'message' => ''
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while booking the Pinup.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function upgradeList(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                // $profileId = $request->escort_id;
                // $membershipId = $request->membership;
                // $profileDetail = getEscortDetail($profileId);
                // $oldPurchase = $profileDetail->mainPurchase;
                // $newPurchase = $oldPurchase->replicate();

                // list($usedDicount, $usedAmount) = calculateTotalFee($oldPurchase->membership, ($oldPurchase->days_number - $profileDetail->left_listing_days), $this->account);
                // list($dicount, $amount, $unitAmount, $unitDiscount) = calculateTotalFee($membershipId, $profileDetail->left_listing_days, $this->account);

                // $today = Carbon::today($profileDetail->TimeZone);
                // $startOfToady = $today->copy()->startOfDay()->setTimezone('UTC');
                // $endOfToady = $today->copy()->endOfDay()->setTimezone('UTC');

                // $oldPurchase->end_date = $today->format('d-m-Y');
                // $oldPurchase->status = 'expire';
                // $oldPurchase->utc_end_time = $endOfToady;
                // $oldPurchase->paid_rate = $usedAmount;
                // $oldPurchase->save();

                // $newPurchase->parent_id = $oldPurchase->id;
                // $newPurchase->membership = $membershipId;
                // $newPurchase->start_date =  $today->copy()->format('d-m-Y');
                // $newPurchase->utc_start_time =  $startOfToady;
                // $newPurchase->rate = $unitAmount;
                // $newPurchase->discount_rate = $unitDiscount;
                // $newPurchase->total_rate = $profileDetail->left_listing_days * $unitAmount;
                // $newPurchase->paid_rate = $amount;
                // $newPurchase->save();

                // $profileDetail->purchase_id = $newPurchase->id;
                // $profileDetail->membership = $membershipId;
                // $profileDetail->save();

                $newPurchase = $this->featureService->upgradeMembership($request);

                if ($request->filled('payment_token')) {
                    $paymentId = decrypt($request->payment_token);
                    $payment = $this->pinService->paymentHistoryDetail($paymentId);
                    if (!empty($payment)) {
                        $newPurchase->paymentItems()->create([
                            'payment_history_id' => $payment->id,
                            'amount' => $newPurchase->paid_rate,
                        ]);
                    }
                    /* Send Payment Mail */
                    $mailConfig = config("payment_mail_templates.upgrade");
                    $mainAccount = $this->account;
                    Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment'), $mailConfig['subject']));
                }
            });


            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Listing has been upgraded.',
                ]);
            } else {
                return redirect()->route('escort.list', 'current');
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while booking the Pinup.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function getActiveNotification()
    {
        $userId = auth()->user()->member_id;
        $notification  = EscortNotification::where('status', 'Published')
            ->where('start_date', '<=', now())
            ->where(function ($query) use ($userId) {
                $query->whereNull('member_id')
                    ->orWhere('member_id', $userId);
            })
            ->orderBy('start_date', 'asc')
            ->select('id', 'heading', 'content', 'template_name')
            ->first();
        return $notification;
    }

    public function cancelProfileCredit(Escort $profile)
    {
        try {
            $result = getListingCancelAmount($profile);
            return response()->json([
                'success' => true,
                'refund_amount' => $result->net_credit_amount,
                'message' => '',
                'result' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while booking the Pinup.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function cancelProfileListing(Escort $profile)
    {
        try {
            $result = getListingCancelAmount($profile);

            if (!empty($result->main_purchase)) {
                $this->walletService->credit(
                    $this->account,
                    $result->listing_adjusted_credit_amount,
                    $result->main_purchase,
                    'Cancel Profile Listing.',
                    [
                        'user_id' => $this->account->id,
                        'escort_id' => $profile->id
                    ]
                );
                $result->main_purchase->update(['status' => 'cancel']);
            }

            if (!empty($result->other_purchase)) {
                $this->walletService->credit(
                    $this->account,
                    $result->extend_listing_credit_amount,
                    $result->other_purchase,
                    'Cancel Extended Profile Listing.',
                    [
                        'user_id' => $this->account->id,
                        'escort_id' => $profile->id
                    ]
                );
                $result->other_purchase->update(['status' => 'cancel']);
            }

            foreach ($profile->playmates as $playmate) {
                $this->playmateHistory->trashPlaymateHistory($profile->id, $playmate->id);
            }
            /**
             * Detach all playmates this escort added
             */
            $profile->playmates()->detach();
            /**
             * Detach this escort from other users who added them as a playmate
             */
            $profile->addedBy()->detach();
            $profile->update([
                'enabled' => 0,
                'membership' => null,
                'start_date' => null,
                'end_date' => null,
                'utc_start_time' => null,
                'utc_end_time' => null,
                'purchase_id' => null
            ]);

            Mail::to($this->account->email)->send(new CancelMailer(compact('result')));

            return response()->json([
                'success' => true,
                'refund_amount' => $result->net_credit_amount,
                'message' => 'Profile ID ' . $profile->id . ' has been canceled.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while booking the Pinup.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
