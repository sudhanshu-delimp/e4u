<?php

namespace App\Http\Controllers\Agent;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Duration;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AgentNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Repositories\Tour\TourInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreTourRequest;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\Service\ServiceInterface;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Repositories\Agent\AgentEscortInterface;
use App\Repositories\Duration\DurationInterface;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Repositories\Escort\EscortMediaInterface;
use App\Http\Requests\Escort\UpdateRequestAboutMe;
use App\Repositories\Escort\AvailabilityInterface;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\StoreAvailabilityRequest;

class AgentController extends BaseController
{
    protected $escort;
    protected $agentEscort;
    protected $availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $tour;

    public function __construct(TourInterface $tour, UserInterface $user, DurationInterface $duration, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service, EscortMediaInterface $media, AgentEscortInterface $agentEscort)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->tour = $tour;
        $this->agentEscort = $agentEscort;
    }


    public function index()
    {
        $escorts = $this->escort->all();
        $userEscort = $this->user->all();
        //dd($userEscort->where('type',3)->count());
        //return redirect()->view('agent.dashboard.index',compact('escorts'));
        $agentNotifications = $this->agentNotificationCount();
        return view('agent.dashboard.index', compact('escorts', 'userEscort', 'agentNotifications'));
    }
    public function escortList()
    {
        $escorts = $this->escort->all();

        return view('agent.dashboard.list', compact('escorts'));
    }


    public function viewTourList()
    {

        $template  = view('agent.dashboard.Advertisers.tourList',)->render();
        $status = true;
        return response()->json(compact('template', 'status'), 200);
    }
    public function onlyEscortList()
    {
        $escorts = $this->escort->all();

        $template  = view('agent.dashboard.Advertisers.only-escort-listing', compact('escorts'))->render();
        $status = true;
        return response()->json(compact('template', 'status'), 200);
    }
    public function dataTable()
    {
        $usr_type = $this->user->find(auth()->user()->id);
        list($escort, $count) = $this->agentEscort->paginatedByEscortId(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $usr_type->agentEscorts->pluck("id")->toArray(),

        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $escort
        );

        return response()->json($data);
    }

    public function escortDataTable()
    {
        $user = auth()->user();
        $escorts = $user->agentEscorts();
        $usr_type = $this->user->find(auth()->user()->id);
        //dd($usr_type->agentEscorts);//$usr_type->agentEscorts->pluck("id")->toArray(),
        //list($user, $count) = $user->agentEscorts()->paginatedAgentTyeEscort(
        list($user, $count) = $this->user->paginatedAgentTyeEscort(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $user,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user
        );

        return response()->json($data);
    }

    public function timeConvert($array)
    {
        $time = explode(':', $array);
    }
    // public function updateProfile($id)
    // {
    //     $escort = $this->escort->find($id);
    //     list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
    //     $durations = $this->duration->all();
    //     $availability = $escort->availability;
    //     $service = $this->service;
    //     //$time = $this->service->getHourMinetTime($availability->friday_from);
    //     //echo "</pre>"; print_r($time); dd("sdhflk");
    //     //dd($escort->services()->where('category_id', 2)->get());
    //     return view('agent.dashboard.profile.update',compact('service','availability','escort','service_one','service_two','service_three','durations'));
    // }
    ///////////////////
    public function updatePolicy(UpdateRequestPolicy $request, $id)
    {
        $escort = $this->escort->find($id);
        $input = [
            'pricing_policy' => $request->pricing_policy,
            'disclaimer' => $request->disclaimer,
        ];
        $error = true;
        if (isset($request->pricing_policy) || isset($request->disclaimer)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }
        //return redirect()->back()->with('status','Record successfully inserted!..');
        return response()->json(compact('error'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Escort\UpdateRequestAboutMe  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAboutMe(UpdateRequestAboutMe $request, $id)
    {
        $get_escort_userId = $this->escort->find($id);
        $data = ['plan_type' => $request->membership];
        if (!empty($request->membership)) {
            $user = $this->user->store($data, $get_escort_userId->user_id);
        }
        $input = [
            'gender' => $request->gender,
            'nationality_id' => $request->nationality_id,
            //'statistics'=>$request->statistics,
            'height' => $request->height,
            'eyes' => $request->eyes,
            'orientation' => $request->orientation,
            'age' => $request->age,
            'hair_color' => $request->hair_color,
            'skin_tone' => $request->skin_tone,
            'breast' => $request->breast,
            'contact' => $request->contact,
            'ethnicity' => $request->ethnicity,
            'body_type' => $request->body_type,
            'hair_style' => $request->hair_style,
            'weight' => $request->weight,
            'dress_size' => $request->dress_size,
            'profile_name' => $request->profile_name,
            'membership' => $request->membership,
        ];
        $request->start_date ? $input['start_date'] = $request->start_date : '';
        $request->end_date ? $input['end_date'] = $request->end_date : '';
        $error = true;
        if ($data = $this->escort->store($input, $id)) {
            $error = false;
        }
        //return redirect()->back()->with('status','Record successfully inserted!..');
        return response()->json(compact('data', 'error'));
    }


    public function storeReadMore(UpdateRequestReadMore $request, $id)
    {
        $input = [
            'piercing' => $request->piercing,
            'drugs' => $request->drugs,
            'travel' => $request->travel,
            'tattoos' => $request->tattoos,
            'smoke' => $request->smoke,
            'available_to' => $request->available_to,
            'license' => $request->license,
            'play_type' => $request->play_type,
            'payment_type' => $request->payment_type
        ];
        $request->language ? $input['language'] = $request->language : '';
        $error = true;
        if ($data = $this->escort->store($input, $id)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }
    public function storeAbout(UpdateRequestAbout $request, $id)
    {
        $input = [
            'about' => $request->about,
        ];
        $error = true;
        if (isset($request->about)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function createProfile(StoreRequest $request)
    {

        $input = [
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'pincode' => $request->pincode,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'social_links' => $request->social_links,
            'user_id' => auth()->user()->getMemberIdAttribute(),
            'enabled' => 1,
        ];

        $error = true;
        if ($data = $this->escort->store($input, $id = null)) {
            $error = false;
            $url = route('update.profile', [$data->id]);
        }
        return response()->json(compact('data', 'error', 'url'));
    }

    public function storeServices(StoreServiceRequest $request,  $id)
    {
        $escort = $this->escort->find($id);
        $arr = [];
        foreach ($request->service_id as $key => $value) {
            $arr  += [$value => ["price" => $request->price[$key]]];
        }
        $error = true;
        if ($data = $escort->services()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }
    public function storeRates(StoreRateRequest $request, $id)
    {

        $escort = $this->escort->find($id);

        $arr = [];
        foreach ($request->duration_id as $key => $value) {
            $arr  += [
                $value => [
                    "massage_price" => $request->massage_price[$key],
                    "incall_price" => $request->incall_price[$key],
                    "outcall_price" => $request->outcall_price[$key]
                ],
            ];
        }
        $error = true;
        if ($data = $escort->durations()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }

    public function parseTime($hour, $minutes, $meridian)
    {
        if (($hour && $minutes && $meridian) == null) {
            return null;
        } else {
            return Carbon::createFromFormat('g:i A', $hour . ":" . $minutes . " " . $meridian)->toTimeString();
        }
    }

    public function storeAvailability(StoreAvailabilityRequest $request, $escortId)
    {

        $data = [];
        if (!empty($request->mon_hh_from)) {
            $data  += [
                "monday_from" => $this->parseTime($request->mon_hh_from, $request->mon_mm_from, $request->mon_time_from),
                "monday_to" => $this->parseTime($request->mon_hh_to, $request->mon_mm_to, $request->mon_time_to),
                "escort_id" => $escortId,
            ];
        }
        if (!empty($request->tue_hh_from)) {
            $data  += [
                "tuesday_from" => $this->parseTime($request->tue_hh_from, $request->tue_mm_from, $request->tue_time_from),
                "tuesday_to" => $this->parseTime($request->tue_hh_to, $request->tue_mm_to, $request->tue_time_to),
                "escort_id" => $escortId,
            ];
        }
        if (!empty($request->wed_hh_from)) {
            $data  += [
                "wednesday_from" => $this->parseTime($request->wed_hh_from, $request->wed_mm_from, $request->wed_time_from),
                "wednesday_to" => $this->parseTime($request->wed_hh_to, $request->wed_mm_to, $request->mon_time_to),
                "escort_id" => $escortId,
            ];
        }
        if (!empty($request->thu_hh_from)) {
            $data  += [
                "thursday_from" => $this->parseTime($request->thu_hh_from, $request->thu_mm_from, $request->thu_time_from),
                "thursday_to" => $this->parseTime($request->thu_hh_to, $request->thu_mm_to, $request->thu_time_to),
                "escort_id" => $escortId,
            ];
        }
        if (!empty($request->fri_hh_from)) {
            $data  += [
                "friday_from" => $this->parseTime($request->fri_hh_from, $request->fri_mm_from, $request->fri_time_from),
                "friday_to" => $this->parseTime($request->fri_hh_to, $request->fri_mm_to, $request->fri_time_to),
                "escort_id" => $escortId,
            ];
        }
        if (!empty($request->sat_hh_from)) {
            $data  += [
                "saturday_from" => $this->parseTime($request->sat_hh_from, $request->sat_mm_from, $request->sat_time_from),
                "saturday_to" => $this->parseTime($request->sat_hh_to, $request->sat_mm_to, $request->sat_time_to),
                "escort_id" => $escortId,
            ];
        }
        if (!empty($request->sun_hh_from)) {
            $data  += [
                "sunday_from" => $this->parseTime($request->sun_hh_from, $request->sun_mm_from, $request->sun_time_from),
                "sunday_to" => $this->parseTime($request->sun_hh_to, $request->sun_mm_to, $request->sun_time_to),
                "escort_id" => $escortId,
            ];
        }
        //dd($arr);
        $escort = $this->escort->find($escortId);
        $availability = $escort->availability;
        $error = true;
        if ($data = $this->availability->store($data, $availability ? $availability->id : null)) {
            $error = false;
        }
        return response()->json(compact('data', 'error'));
    }
    public function deleteProfile($id)
    {
        $escort = $this->escort->find($id);

        $escort->services()->sync([]);
        $escort->durations()->sync([]);
        $escort->medias()->delete();
        $escort->images()->delete();
        $escort->videos()->delete();
        $escort->messages()->delete();
        $this->escort->destroy($id);
        $error = 1;


        return response()->json(compact('error'));
    }

    public function saveMembership(Request $request, $id)
    {
        $escort = $this->escort->find($id);
        $data = [];
        $enable = [];
        $data = ['plan_type' => $request->plan_type];
        $enable = ['enabled' => 1];
        $user = $this->user->store($data, $escort->user_id);
        $escort_update = $this->escort->store($enable, $id);
        $error = 1;


        return response()->json(compact('error'));
    }
    public function createStoreTour(StoreTourRequest $request, $id = null)
    {
        $tourData = [];
        $tourData = [
            'name' => $request->name,
            'start_date' => $request->start_date[0],
            'end_date' => last($request->end_date),
            'location' => $request->stateId,
            // 'location' => $request->cityId,
        ];
        // dd($id);
        $tour = $this->tour->store($tourData, $id);
        //$tour = $this->tour->find(1);
        //dd($tour->id);
        $arr = [];
        //dd($request->cityId);
        if (!empty($request->stateId)) {
            foreach ($request->stateId as $key => $stateId) {
                $arr += [
                    $stateId  => [
                        "profile_id" => (int) $request->escortId[$key],
                        "start_date" => $request->start_date[$key],
                        "end_date" => $request->end_date[$key],
                        "user_id" => $request->user_id,
                        "tour_plan" => $request->tour_plan[$key],
                    ]
                ];
            }
        }
        //dd($arr);
        $error = true;

        if ($data = $tour->locations()->sync($arr)) {

            $error = false;
        }

        //dd($tour->locations);
        $userId = $request->user_id;
        //return view('escort.dashboard.tour.createTour',compact('escorts'));
        return response()->json(compact('error', 'tour', 'userId'));
    }
    public function editStoreTour(StoreTourRequest $request, $id)
    {
        //echo "uid=".$id;

        $editTour = $this->tour->find($id);
        $total_days = 0;
        $request_total_days = 0;
        // dd($editTour->locations);
        foreach ($editTour->locations as $key => $tour) {
            $days = Carbon::parse($tour->end_date)->diffInDays(Carbon::parse($tour->start_date));
            //$days[] += $tour->tour_plan;
            $total_days += $days;
        }

        $arr = [];
        //dd($request->cityId);
        if (!empty($request->stateId)) {
            foreach ($request->stateId as $key => $stateId) {
                $arr += [
                    $stateId  => [
                        "profile_id" => (int) $request->escortId[$key],
                        "start_date" => $request->start_date[$key],
                        "end_date" => $request->end_date[$key],
                        "user_id" => $request->user_id,
                        "tour_plan" => $request->tour_plan[$key],
                    ]
                ];
                $day = Carbon::parse($request->end_date[$key])->diffInDays(Carbon::parse($request->start_date[$key]));
                $request_total_days += $day;
            }
        }

        echo "befor edit tour days:" . $total_days . "</br>";
        echo "after edit tour days:" . $request_total_days . "</br>";

        //if($editTour->)






        ///////////////////////
        $tourData = [];
        if (isset($request->name)) {
            $tourData['name'] = $request->name;
        }
        if (isset($request->start_date)) {
            $tourData['start_date'] = $request->start_date[0];
        }
        if (isset($request->end_date)) {
            $tourData['end_date'] = last($request->end_date);
        }
        if (isset($request->stateId)) {
            $tourData['location'] = $request->stateId;
        }
        // $tourData = [
        //     'name' => $request->name,
        //     'start_date' => $request->start_date[0],
        //     'end_date' => last($request->end_date),
        //     'location' => $request->stateId,
        //    // 'location' => $request->cityId,
        // ];
        // dd($id);
        $tour = $this->tour->store($tourData, $id);
        //$tour = $this->tour->find(1);
        //dd($tour->id);

        //dd($arr);
        $error = true;

        if ($data = $tour->locations()->sync($arr)) {

            $error = false;
        }

        //dd($tour->locations);
        $userId = $request->user_id;
        //return view('escort.dashboard.tour.createTour',compact('escorts'));
        return response()->json(compact('error', 'tour', 'userId'));
    }
    public function createTourApend(Request $request)
    {
        // echo "idd==".$id;
        // dd($request->all());
        $row_count = $request->row_count;
        $escort = $this->escort->all();
        $escorts = $escort->whereNotNull('state_id')->where('default_setting', 0)->unique('state_id');

        $user_names = $escort->whereNotNull('state_id')->where('default_setting', 0);

        $tours = $this->tour->all();
        $find_tour = null;

        //dd($user_names);
        $template = view('agent.dashboard.Advertisers.tour.partials.tourModalAppend', compact('tours', 'find_tour', 'escorts', 'user_names', 'row_count'))->render();

        $status = true;

        return response()->json(compact('template', 'status'), 200);
    }
    public function editTourApend(Request $request)
    {
        // echo "idd==".$id;
        // dd($request->all());
        $row_count = $request->row_count;
        $escort = $this->escort->all();
        $escorts = $escort->whereNotNull('state_id')->where('default_setting', 0)->unique('state_id');

        $user_names = $escort->whereNotNull('state_id')->where('default_setting', 0);

        $tours = $this->tour->all();
        $find_tour = null;

        //dd($user_names);
        $template = view('agent.dashboard.Advertisers.tour.partials.tourEditModalAppend', compact('tours', 'find_tour', 'escorts', 'user_names', 'row_count'))->render();

        $status = true;

        return response()->json(compact('template', 'status'), 200);
    }
    public function viewTourEdit($id)
    {

        $find_tour = $this->tour->find($id);

        $escort = $this->escort->FindByUsers(array_unique($find_tour->tour_location->pluck('user_id')->toArray()));
        // $escort = $this->escort->FindByUsers(array_unique($find_tour->tour_location->pluck('user_id')->toArray()));

        $escorts = $escort->whereNotNull('state_id')->where('default_setting', 0);
        //->unique('state_id');

        $user_names = $escort->whereNotNull('state_id')->where('default_setting', 0);

        $tourLocation = $find_tour->location;
        // unset($tourLocation[0]);
        //   dd($tourLocation);




        $template = view('agent.dashboard.Advertisers.tour.partials.edit-tour', compact('find_tour', 'escorts', 'user_names', 'tourLocation'))->render();

        $status = true;

        return response()->json(compact('template', 'status', 'tourLocation'), 200);
        //return response()->json(compact('find_tour'));
    }
    public function viewTourApend(Request $request, $id)
    {
        // echo "idd==".$id;
        // dd($request->all());
        $row_count = $request->row_count;
        $find_tour = $this->tour->find($id);
        // dd($find_tour);
        $escort = $this->escort->FindByUsers(array_unique($find_tour->tour_location->pluck('user_id')->toArray()));

        $escorts = $escort->whereNotNull('state_id')->where('default_setting', 0)->unique('state_id');
        //  dd($escorts);


        $user_names = $escort->whereNotNull('state_id')->where('default_setting', 0);

        $template = view('agent.dashboard.Advertisers.tour.partials.tourModalAppend', compact('find_tour', 'escorts', 'user_names', 'row_count'))->render();

        $status = true;

        return response()->json(compact('template', 'status'), 200);
        //return response()->json(compact('find_tour'));
    }
    public function nameByState($id)
    {
        $escort = $this->escort->all();
        // $escort = $this->escort->FindByUsers(auth()->user()->id);
        $escorts = $escort->where('state_id', '==', $id)->where('default_setting', 0);




        $escort1 = $this->escort->FindByUsers($escorts->pluck('user_id'));


        $allStateId = $escort1->whereNotNull('state_id')->where('default_setting', 0)->unique('state_id');
        $arrayNotNullStateId = [$allStateId->pluck('state_id')];
        //dd($arrayNotNullStateId);

        //dd($find_tour->tour_location);
        //$template = view('escort.dashboard.archives.partials.edit-tour', compact('escorts','find_tour'))->render();

        $status = true;

        return response()->json(compact('status', 'escorts', 'id', 'arrayNotNullStateId'), 200);
        //return response()->json(compact('find_tour'));
    }

    public function uploadAvatar()
    {
        return view('agent.dashboard.upload-avatar');
    }

    public function agentSaveAvatar(StoreAvatarMediaRequest $request, $id)
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

    public function agentRemoveAvatar()
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
            $defaultImg = asset(config('constants.agent_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
    }


    public function notificationsFeatures()
    {

        $setting = User::with('agent_settings')->where('id', auth()->user()->id)->first();
        return view('agent.dashboard.notifications-and-features', compact('setting'));
    }

    public function updateNotificationsFeatures(Request $request)
    {
        $user = auth()->user();
        $data = [
            'direct_chatting_with_advertisers'      => $request->boolean('direct_chatting_with_advertisers') ? '1' : '0',
            'advertiser_email'                      => $request->boolean('advertiser_email') ? '1' : '0',
            'advertiser_text'                       => $request->boolean('advertiser_text') ? '1' : '0',
            'call'                                  => $request->boolean('call_access') ? '1' : '0',
            'escort_email'                          => $request->boolean('escort_email') ? '1' : '0',
            'escort_text'                           => $request->boolean('escort_text') ? '1' : '0',
            'idle_preference_time'                  => $request->input('idle_time', '60'),
            'twofa'                                 => $request->input('twofa', '2'),

        ];

        $setting = $user->agent_settings;
        if ($setting) {
            $setting->update($data);
        } else {
            $user->agent_settings()->create(array_merge($data, ['user_id' => $user->id]));
        }

        return $this->successResponse('Notification settings updated successfully!');
    }

    public function agentNotificationCount()
    {
        $today = Carbon::today();
        $todayDate = $today->toDateString();
        $loggedMemberId = Auth::user()->member_id;
        

        $notifications = AgentNotification::where('status', 'Published')->where(function ($query) use ($todayDate, $loggedMemberId) {

            // Adhoc notifications valid for today
            $query->where('type', 'adhoc')
                ->where('start_date', '<=', $todayDate)
                ->where('end_date', '>=', $todayDate);

            // Notice notifications valid for today with matching member_id
            $query->orWhere(function ($q) use ($todayDate, $loggedMemberId) {
                $q->where('type', 'notice')
                    ->where('start_date', '<=', $todayDate)
                    ->where('end_date', '>=', $todayDate)
                    ->where('member_id', $loggedMemberId);
            });

            // Scheduled notifications valid for today based on scheduled_days or forever recurring
            $query->orWhere(function ($q) use ($todayDate) {
                $q->where('type', 'scheduled')
                    ->where(function ($sq) use ($todayDate) {
                        $sq->whereRaw('FIND_IN_SET(?, scheduled_days)', [$todayDate])
                            ->orWhere('recurring_type', 'forever');
                    });
            });
        })->orderBy('created_at', 'desc')
            ->select('id', 'heading', 'content')
            ->get();

        return $notifications;
    }
}
