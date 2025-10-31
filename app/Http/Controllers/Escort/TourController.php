<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\Escort\StoreTourRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\Escort\UpdateRequestAboutMe;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\UpdateRequestAboutAll;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Escort\EscortMediaInterface;
use App\Models\EscortCovidReport;
use App\Repositories\Tour\TourInterface;

use App\Models\Escort;
use App\Models\Tour;
use App\Models\TourLocation;
use App\Models\TourProfile;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $escort;
    protected $availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $tour;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TourInterface $tour,UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability,  ServiceInterface $service, DurationInterface $duration, EscortMediaInterface $media)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->tour = $tour;
    }

    public function tourProfileList($sm,$id)
    {
        $escorts = $this->escort->FindByUsers(auth()->user()->id);
        $tours = $this->tour->find($id);
        return view('escort.dashboard.archives.archive-tour-summer',compact('escorts','tours'));
    }
    public function viewTourList($type)
    {
        $escort = $this->escort->FindByUsers(auth()->user()->id);
        $escorts = $escort->whereNotNull('state_id')->where('default_setting',0)->unique('state_id');
        $tours = $this->tour->all();
        $user_names = $escort->whereNotNull('state_id')->where('default_setting',0);
        $find_tour = null;
        return view('escort.dashboard.archives.archive-tour-view-profiles',compact('escorts','tours','find_tour','user_names', 'type'));
    }
    public function viewTourEdit($id)
    {

        $escort = $this->escort->FindByUsers(auth()->user()->id);
        $escorts = $escort->whereNotNull('state_id')->where('default_setting',0)->unique('state_id');

        $find_tour = $this->tour->find($id);
        $user_names = $escort->whereNotNull('state_id')->where('default_setting',0);
        //dd($find_tour->tour_location);
        $template = view('escort.dashboard.archives.partials.edit-tour', compact('escorts','find_tour','user_names'))->render();

        $status = true;

        return response()->json(compact('template', 'status'), 200);
        //return response()->json(compact('find_tour'));
    }
    public function createTour($id = null)
    {
        // $escort = $this->escort->FindByUsers(auth()->user()->id);
        // $escorts = $escort->whereNotNull('state_id')->where('default_setting',0)->unique('state_id');

        // $user_names = $escort->whereNotNull('state_id')->where('default_setting',0);

        // $tours = $this->tour->all();
        // $find_tour = null;

        //dd($user_names);
        //return view('escort.dashboard.NewTour.create-tour',compact('escorts','tours','find_tour','user_names'));
        if(!empty($id)){
            $tour = Tour::findOrFail($id);
            $tourLocations = TourLocation::where(['tour_id'=>$id])->get();
            $userLocations = $this->getAccountLocations(true);
            return view('escort.dashboard.NewTour.edit-tour',compact('tour','tourLocations','userLocations'));
        }
        else{
            return view('escort.dashboard.NewTour.create-tour');
        }
    }
    public function nameByState($id)
    {
        $escort = $this->escort->FindByUsers(auth()->user()->id);
        $escorts = $escort->where('state_id','==',$id)->where('default_setting',0);
        //dd($escorts);
        //dd($find_tour->tour_location);
        //$template = view('escort.dashboard.archives.partials.edit-tour', compact('escorts','find_tour'))->render();

        $status = true;

        return response()->json(compact('status','escorts','id'), 200);
        //return response()->json(compact('find_tour'));
    }

    public function TourDataTable(Request $request, $type = NULL)
    {

    $today = \Carbon\Carbon::today();
    $user_id = auth()->user()->id;
    $search = $request->get('search');
    $sortBy = $request->get('sort_by', 'id');
    $sortDir = $request->get('sort_dir', 'desc');
    $length = $request->get('length', 10);
    $start = $request->get('start', 0);
    $query = \App\Models\Tour::with('locations');
    $query->where('user_id', $user_id);
    if ($type === 'current') {
        //$query->whereHas('locations', fn($q) => $q->where('start_date', '<=', $today));
    } elseif ($type === 'past') {
        //$query->whereDoesntHave('locations', fn($q) => $q->where('start_date', '>', $today));
    }

    // Search by tour name
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    $total = $query->count();
    $tours = $query->orderBy($sortBy, $sortDir)
    ->skip($start)
    ->take($length)
    ->get()
    ->map(function ($tour, $index) {
        $startDate = $tour->locations->min('start_date');
        $endDate = $tour->locations->max('end_date');
        $days = $startDate && $endDate ? \Carbon\Carbon::parse($startDate)->diffInDays(\Carbon\Carbon::parse($endDate)) + 1 : 0;

        $action = '<div class="dropdown no-arrow archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">';
        if($tour->tourPurchase->count() == 0){
            $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('account.checkout_tour', $tour->id).'"> <i class="fa fa-location-arrow " ></i> Checkout</a><div class="dropdown-divider"></div>';
        }
        $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('escort.store.tour', $tour->id).'"> <i class="fa fa-pen " ></i> Edit</a>'; 
        $action .= '</div></div>';

        return [
            'id' => $tour->id,
            'name' => $tour->name,
            'start_date' => $startDate->format('d-m-Y'),
            'end_date' => $endDate->format('d-m-Y'),
            'days' => $days,
            'action' => $action
        ];
    });

return response()->json([
    'data' => $tours,
    'recordsTotal' => $total,
    'recordsFiltered' => $total,
]);

    }



    public function viewTour()
    {
        $escorts = $this->escort->FindByUsers();
        //return view('escort.dashboard.tour.createTour',compact('escorts'));
        return response()->json(compact('escorts'));
    }
    public function create(StoreTourRequest $request)
    {
        $escorts = $this->escort->FindByUsers();
        //return view('escort.dashboard.tour.createTour',compact('escorts'));
        return response()->json(compact('escorts'));
    }
    public function createStoreTour(StoreTourRequest $request, $id = null)
    {
        $tourData = [];
        $tourData = [
            'name' => $request->name,
            'start_date' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->start_date[0])->format('Y-m-d'),
            'end_date' => \Carbon\Carbon::createFromFormat('d-m-Y', last($request->end_date))->format('Y-m-d'),
            'location' => $request->stateId,
           // 'location' => $request->cityId,
        ];
        $tour = $this->tour->store($tourData,$id);
        //$tour = $this->tour->find(1);
        //dd($tour->id);
        $arr = [];
        //dd($request->cityId);
        // if(!empty($request->stateId)) {
        //     foreach($request->stateId as $key => $stateId)
        //     {
        //         $arr += [$stateId  => [
        //                     "profile_id" => (int) $request->escortId[$key],
        //                     "start_date" => $tourData['start_date'],
        //                     "end_date" => $tourData['end_date'],
        //                     "user_id" => auth()->user()->id,
        //                     "tour_plan" => $request->tour_plan[$key],
        //                     ]
        //                 ];
        //     }
        // }
           
        if (!empty($request->stateId)) {
            
            foreach ($request->stateId as $key => $stateId) {
                $arr[$stateId] = [ 
                    "profile_id" => (int) $request->escortId[$key] ?? null,  // Added safety check
                    "start_date" => $tourData['start_date'] ?? null,  // Avoid undefined index error
                    "end_date" => $tourData['end_date'] ?? null,
                    "user_id" => auth()->id(),
                    "tour_plan" => $request->tour_plan[$key] ?? null,
                ];
            }
        }

        $error = true;

        if($data = $tour->locations()->sync($arr)) {

                $error = false;

        }

        //dd($tour->locations);
        //
        //return view('escort.dashboard.tour.createTour',compact('escorts'));
        return response()->json(compact('error','tour'));
    }
    public function DeleteTour($id)
    {

       // dd($id);
        $tour = $this->tour->find($id);
        //$tour = $this->tour->find(1);
        //dd($tour->id);
        $arr = [];

        $error = true;

        if($data = $tour->locations()->sync($arr)) {

                $error = false;

        }
        $this->tour->destroy($id);
        //dd($tour->locations);
        //
        //return view('escort.dashboard.tour.createTour',compact('escorts'));
        return response()->json(compact('error'));
    }

    public function updateBasicProfile($id = null)
    {
        $latest = $this->escort->latest();
        $user = auth()->user();
        if($id == null)
        {
            $update_id = $latest->id;
            $profile = $this->escort->findDefault($user->id,1);
        } else {
            $update_id = $id;
            $profile = $this->escort->find($id);
        }
        //dd($latest->id);





        return view('escort.dashboard.profile.create-profile', compact('profile','update_id'));
    }

    public function updateProfile($id)
    {
        $escort = $this->escort->find($id);
        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        $durations = $this->duration->all();
        $availability = $escort->availability;
        $service = $this->service;
        //dd($escort->nation);
        return view('escort.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations'));
    }
    public function updatePolicy(UpdateRequestPolicy $request, $id)
    {
        $escort = $this->escort->find($id);
        $input = [
            'pricing_policy' => $request->pricing_policy,
            'disclaimer' => $request->disclaimer,
        ];
        $error=true;
        if(isset($request->pricing_policy) || isset($request->disclaimer)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }

        //return redirect()->back()->with('status','Record successfully inserted!..');
        return response()->json(compact('error'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Escort\UpdateRequestAboutMe  $request
     * @return \Illuminate\Http\Response
     */

    public function createBySetting(UpdateRequestAboutAll $request)
    {

        $error = 0;
        $user = auth()->user();
        $escort = $this->escort->findDefault($user->id,1);
        //dd($request->start_date);
        $input = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'profile_name'=>$request->profile_name ? $request->profile_name : null,
            'membership'=>$request->membership ? $request->membership : null,
            'gender'=>$escort->gender ? $escort->getRawOriginal('gender') : NULL,
            'nationality_id'=>$escort->nationality_id ? $escort->nationality_id : NULL,
            'height'=>$escort->height ? $escort->height : NULL,
            'eyes'=>$escort->eyes ? $escort->eyes : NULL,
            'orientation'=>$escort->orientation ? $escort->orientation : NULL,
            'age'=>$escort->age ? $escort->age : NULL,
            'hair_color'=>$escort->hair_color ? $escort->hair_color : NULL,
            'skin_tone'=>$escort->skin_tone ? $escort->skin_tone : NULL,
            'breast'=>$escort->breast ? $escort->breast : NULL,
            'contact'=>$escort->contact ? $escort->contact : NULL,
            'ethnicity'=>$escort->ethnicity ? $escort->ethnicity : NULL,
            'body_type'=>$escort->body_type ? $escort->body_type : NULL,
            'hair_style'=>$escort->hair_style ? $escort->hair_style : NULL,
            'weight'=>$escort->weight ? $escort->weight : NULL,
            'dress_size'=>$escort->dresss_size ? $escort->dresss_size : NULL,
            'covidreport' => $escort->covidreport ? $escort->covidreport : NULL,
            'piercing'=>$escort->piercing ? $escort->piercing : NULL,
            'drugs'=>$escort->drugs ? $escort->drugs : NULL,
            'travel'=>$escort->travel ? $escort->travel : NULL,
            'tattoos'=>$escort->tattoos ? $escort->tattoos : NULL,
            'smoke'=>$escort->smoke ? $escort->smoke : NULL,
            'available_to'=>$escort->available_to ? $escort->available_to : NULL,
            'license'=>$escort->license ? $escort->license : NULL,
            'play_type'=> $escort->play_type ? $escort->play_type : NULL,
            'payment_type'=>$escort->payment_type ? $escort->payment_type : NULL,
            'language'=>$escort->language ? $escort->language : NULL,
            'social_links'=>$escort->social_links ? $escort->social_links : NULL,
            'enabled'=>1,
            'user_id'=>$user->id,
            'default_setting' => 0,
        ];
        //dd($input);
        if($new_escort = $this->escort->create($input)) {
            $escortId = $new_escort->id;
            $error = 1;

        }
        $arr = [];

        foreach($escort->durations as $key =>$durations)
        {
            //dd($durations->pivot);
            $id = $durations->pivot->duration_id;
            $arr[$id] = [
                'massage_price' => $durations->pivot->massage_price,
                'incall_price' => $durations->pivot->incall_price,
                'outcall_price' => $durations->pivot->outcall_price,
            ];
        }
        ;
        //dd($arr);
        if($data_durations  = $new_escort->durations()->sync($arr)) {
            $error = 1;
        }
        $data  = [
            "monday_from" => $escort->availability->monday_from,
            "monday_to" => $escort->availability->monday_to,
            "tuesday_from" => $escort->availability->tuesday_from,
            "tuesday_to" => $escort->availability->tuesday_to,
            "wednesday_from" =>$escort->availability->wednesday_from,
            "wednesday_to" => $escort->availability->wednesday_to,
            "thursday_from" => $escort->availability->thursday_from,
            "thursday_to" => $escort->availability->thursday_to,
            "friday_from" => $escort->availability->friday_from,
            "friday_to" => $escort->availability->friday_to,
            "saturday_from" => $escort->availability->saturday_from,
            "saturday_to" => $escort->availability->saturday_to,
            "sunday_from" =>$escort->availability->sunday_from,
            "sunday_to" => $escort->availability->sunday_to,
            "escort_id" => $escortId,
        ];
        $availability = $escort->availability;
        if($data = $this->availability->store($data)) {
            $error = 1;
        }
        //dd($data);

        if($escort->services != null) {
            $service_arr = [];
            foreach($escort->services as $key =>$services)
            {
                //dd($durations->pivot);
                //dd($escort->services);

                $id = $services->pivot->service_id;
                $service_arr[$id] = [
                    'price' => $services->pivot->price,
                ];

            }

            if($data_services = $new_escort->services()->sync($service_arr)) {
            $error = 1;
            }
        }



        return response()->json(compact('error','escortId'));
        //return redirect()->route('escort.update.profile', [$escortId]);
    }

    public function storeAboutMe(UpdateRequestAboutMe $request, $id)
    {

        $input = [
            'gender'=>$request->gender,
            'nationality_id'=>$request->nationality_id,
            //'statistics'=>$request->statistics,
            'height'=>$request->height,
            'eyes'=>$request->eyes,
            'orientation'=>$request->orientation,
            'age'=>$request->age,
            'hair_color'=>$request->hair_color,
            'skin_tone'=>$request->skin_tone,
            'breast'=>$request->breast,
            'contact'=>$request->contact,
            'ethnicity'=>$request->ethnicity,
            'body_type'=>$request->body_type,
            'hair_style'=>$request->hair_style,
            'weight'=>$request->weight,
            'dress_size'=>$request->dress_size,
            'profile_name'=>$request->profile_name,
            'membership'=>$request->membership,
            'covidreport' => $request->covidreport,
        ];
        $user = auth()->user();
        $escort = $this->escort->findDefault($user->id,1);
        if($escort->id == $id)
        {
            $id = null;
            $input['user_id'] =$user->id;

        }

        $request->start_date ? $input['start_date'] = $request->start_date : NULL;
        $request->end_date ? $input['end_date'] = $request->end_date : NULL;
        $error = true;

        if($escort = $this->escort->store($input, $id)) {
            $error = false;
            if($request->file('banner_image')) $this->uploadFile($request->file('banner_image'), $escort);
            if($request->file('banner_video')) $this->uploadFile($request->file('banner_video'), $escort);
        }

        if(($escort->covidreport == 1 || $escort->covidreport == 2 ) && $request->file('covid_report_file')) {
            $this->uploadCovidReport($request->file('covid_report_file'), $escort->id);
        } else {
            $escort->covidReport()->delete();
        }

        return response()->json(compact('escort','error'));
    }

    public function uploadCovidReport($file, $escort_id)
    {
        $file_path = 'escort-covid-report/'.$escort_id.'/'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
        Storage::disk('escorts')->put($file_path, file_get_contents($file));

        $data = [
            'escort_id' => $escort_id,
            'path' => 'escorts/'.$file_path,
        ];

        EscortCovidReport::create($data);

        return true;
    }

    public function storeReadMore(UpdateRequestReadMore $request, $id)
    {
        $input = [
            'piercing'=>$request->piercing,
            'drugs'=>$request->drugs,
            'travel'=>$request->travel,
            'tattoos'=>$request->tattoos,
            'smoke'=>$request->smoke,
            'available_to'=>$request->available_to,
            'license'=>$request->license,
            'play_type'=> $request->play_type,
            'payment_type'=>$request->payment_type
        ];
        $request->language ? $input['language'] = $request->language : NULL;
        $error=true;
        if($data = $this->escort->store($input, $id)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }
    public function storeAbout(UpdateRequestAbout $request ,$id)
    {
        $input = [
            'about'=>$request->about,
        ];


        $error = true;
        if(isset($request->about)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function createProfile(StoreRequest $request)
    {

        $input = [
            'name'=>$request->name,
            'age'=>$request->age,
            'phone'=>$request->phone,
            'pincode'=>$request->pincode,
            'city_id'=>$request->city_id,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'social_links'=>$request->social_links,
            'user_id' => auth()->user()->getMemberIdAttribute(),
            'enabled' => 1,
        ];

        $error=true;
        if($data = $this->escort->store($input, $id = null)) {
            $error = false;
            $url = route('update.profile', [$data->id]);
        }
        return response()->json(compact('data','error','url'));
    }

    public function storeServices(StoreServiceRequest $request,  $id)
    {
        $escort = $this->escort->find($id);
        $arr = [];
        //dd($request->service_id);
        if(!empty($request->service_id)) {
            foreach($request->service_id as $key =>$value)
            {
                $arr  += [$value => ["price" => $request->price[$key]]];
            }
        }

        $error=true;
        if($data = $escort->services()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }
    public function storeRates(StoreRateRequest $request, $id)
    {
        $escort = $this->escort->find($id);
        $arr = [];
        foreach($request->duration_id as $key =>$value)
        {
            $arr  += [$value => [
                "massage_price" => $request->massage_price[$key],
                "incall_price" => $request->incall_price[$key],
                "outcall_price" => $request->outcall_price[$key]],
                ];
        }
        $error=true;
        if($data = $escort->durations()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }

    public function parseTime($hour,$minutes,$meridian)
    {
        if(($hour && $minutes && $meridian) == null){
            return null;
        } else {
            return Carbon::createFromFormat('g:i A',$hour.":".$minutes." ".$meridian)->toTimeString();
        }
    }

    public function storeAvailability(StoreAvailabilityRequest $request, $escortId)
    {
        $data = [];
        if(!empty($request->mon_hh_from))
        {
        $data  += [
            "monday_from" => $this->parseTime($request->mon_hh_from,$request->mon_mm_from,$request->mon_time_from),
            "monday_to" => $this->parseTime($request->mon_hh_to,$request->mon_mm_to,$request->mon_time_to),
            "escort_id" => $escortId,
                ];

        }
        if(!empty($request->tue_hh_from))
        {
            $data  += [
                "tuesday_from" => $this->parseTime($request->tue_hh_from,$request->tue_mm_from,$request->tue_time_from),
                "tuesday_to" => $this->parseTime($request->tue_hh_to,$request->tue_mm_to,$request->tue_time_to),
                "escort_id" => $escortId,
                    ];
        }
        if(!empty($request->wed_hh_from))
        {
            $data  += [
                "wednesday_from" =>$this->parseTime($request->wed_hh_from,$request->wed_mm_from,$request->wed_time_from),
                "wednesday_to" => $this->parseTime($request->wed_hh_to,$request->wed_mm_to,$request->mon_time_to),
                "escort_id" => $escortId,
                    ];
        }
        if(!empty($request->thu_hh_from))
        {
            $data  += [
                "thursday_from" => $this->parseTime($request->thu_hh_from,$request->thu_mm_from,$request->thu_time_from),
                "thursday_to" => $this->parseTime($request->thu_hh_to,$request->thu_mm_to,$request->thu_time_to),
                "escort_id" => $escortId,
                    ];
        }
        if(!empty($request->fri_hh_from))
        {
            $data  += [
                "friday_from" => $this->parseTime($request->fri_hh_from,$request->fri_mm_from,$request->fri_time_from),
                "friday_to" => $this->parseTime($request->fri_hh_to,$request->fri_mm_to,$request->fri_time_to),
                "escort_id" => $escortId,
                    ];
        }
        if(!empty($request->sat_hh_from))
        {
            $data  += [
                "saturday_from" => $this->parseTime($request->sat_hh_from,$request->sat_mm_from,$request->sat_time_from),
                "saturday_to" => $this->parseTime($request->sat_hh_to,$request->sat_mm_to,$request->sat_time_to),
                "escort_id" => $escortId,
                    ];
        }
        if(!empty($request->sun_hh_from))
        {
            $data  += [
                "sunday_from" =>$this->parseTime($request->sun_hh_from,$request->sun_mm_from,$request->sun_time_from),
                "sunday_to" => $this->parseTime($request->sun_hh_to,$request->sun_mm_to,$request->sun_time_to),
                "escort_id" => $escortId,
                    ];
        }

        $escort = $this->escort->find($escortId);
        $availability = $escort->availability;
        $error=true;
        if($data = $this->availability->store($data, $availability ? $availability->id : null)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
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
        $data = ['plan_type' =>$request->plan_type];
        $enable = ['enabled' =>1];
        $user = $this->user->store($data, $escort->user_id);
        $escort_update = $this->escort->store($enable, $id);
        $error = 1;


        return response()->json(compact('error'));

    }

    public function uploadFile($attachment, $escort)
    {
        $escort_id = $escort->id;

        list($type, $prefix) = $this->getPrefix($attachment);

        $file_path = $prefix.$escort_id.'/banner/'.Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$attachment->getClientOriginalExtension();
        Storage::disk('escorts')->put($file_path, file_get_contents($attachment));

        if(!$media = $this->media->findByPath('escorts/'.$file_path)) {
            $data = [
                'escort_id' => $escort_id,
                'type' => $type,
                'path' => 'escorts/'.$file_path,
            ];
            $media = $this->media->store($data);
        }

        return true;
    }

    public function getPrefix($file)
    {
        $mime = $file->getMimeType();
        if(strstr($mime, "video/")){
            $str = 'videos/';
            $type = 3;  //2=>image; 3=>video (banner)
        } else {
            $str = 'images/';
            $type = 2;  //2=>image; 3=>video (banner)
        }
        return [$type, 'attatchment/'.$str];
    }

    public function getAccountLocations($asArray = false)
    {
        $escort = $this->escort->FindByUsers(auth()->user()->id);
        $stateIds = $escort->whereNotNull('state_id')->pluck('state_id')->unique()->toArray();
        $allStates = config('escorts.profile.states');
        $userStates = [];
        foreach ($stateIds as $stateId) {
            if (isset($allStates[$stateId])) {
                $userStates[] = [
                    'id' => $stateId,
                    'name' => $allStates[$stateId]['stateName']
                ];
            }
        }
        return $asArray ? $userStates : response()->json($userStates);
    }

    public function getAccountProfiles(Request $request){
        $stateId = $request->input('state_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $escort = $this->escort->FindByUsers(auth()->user()->id);
        // $escorts = $escort->where('state_id',$stateId)->toArray();
        $escorts = $escort->where('state_id', $stateId)->whereNotNull('name');

        $availableEscorts = $escorts->filter(function ($escort) use ($startDate, $endDate) {
            return !$escort->purchase()
                ->where(function ($query) use ($startDate, $endDate) {
                    // $query->where('start_date', '<=', $endDate)
                    //       ->where('end_date', '>=', $startDate);
                    $query->overlapping($startDate, $endDate);
                })->exists(); // true = overlap found, false = no overlap or no purchases
        })->values();

        $userProfiles = [];
        foreach ($availableEscorts as $escort) {
                $userProfiles[] = [
                    'id' => $escort['id'],
                    'name' => $escort['name']
                ];
        }
        return response()->json($userProfiles);
    }

    public function saveAccountTour(Request $request){
        DB::beginTransaction();
        try {
              // Create a new Tour
            $tour = Tour::create([
                'name' => $request->tour_name,
                'user_id' => auth()->id() // Assuming the user is logged in
            ]);
            
            foreach ($request->locations as $location) {
                // Create Tour Location
                $tourLocation = TourLocation::create([
                    'tour_id' => $tour->id,
                    'state_id' => $location['location_id'],
                    'start_date' => $location['start_date'],
                    'end_date' => $location['end_date']
                ]);

                // Add Profiles to Location
                foreach ($location['profiles'] as $profile) {
                    TourProfile::create([
                        'tour_location_id' => $tourLocation->id,
                        'escort_id' => $profile['profile_id'],
                        'tour_plan' => $profile['tour_plan']
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Tour created successfully!',
                'tour_id' => $tour->id
            ]);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error saving tour: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateAccountTour(Request $request, $id)
{
    DB::beginTransaction();
    try {
        // Step 1: Update the tour basic info
        $tour = Tour::findOrFail($id);
        $tour->update([
            'name' => $request->tour_name,
        ]);

        $existingLocationIds = [];

        // Step 2: Loop through locations
        foreach ($request->locations as $location) {
            if (isset($location['id'])) {
                // Update existing location
                $tourLocation = TourLocation::find($location['id']);
                if ($tourLocation) {
                    $tourLocation->update([
                        'state_id' => $location['location_id'],
                        'start_date' => $location['start_date'],
                        'end_date' => $location['end_date'],
                    ]);
                }
            } else {
                // Create new location
                $tourLocation = TourLocation::create([
                    'tour_id' => $tour->id,
                    'state_id' => $location['location_id'],
                    'start_date' => $location['start_date'],
                    'end_date' => $location['end_date'],
                ]);
            }

            $existingLocationIds[] = $tourLocation->id;

            // Step 3: Sync profiles in each location
            $existingProfileIds = [];

            foreach ($location['profiles'] as $profile) {
                if (isset($profile['id'])) {
                    // Update existing profile
                    $tourProfile = TourProfile::find($profile['id']);
                    if ($tourProfile) {
                        $tourProfile->update([
                            'escort_id' => $profile['profile_id'],
                            'tour_plan' => $profile['tour_plan'],
                        ]);
                    }
                } else {
                    // Create new profile
                    $tourProfile = TourProfile::create([
                        'tour_location_id' => $tourLocation->id,
                        'escort_id' => $profile['profile_id'],
                        'tour_plan' => $profile['tour_plan'],
                    ]);
                }

                $existingProfileIds[] = $tourProfile->id ?? null;
            }

            // Delete removed profiles from this location
            TourProfile::where('tour_location_id', $tourLocation->id)
                ->whereNotIn('id', array_filter($existingProfileIds))
                ->delete();
        }

        // Step 4: Delete removed locations
        TourLocation::where('tour_id', $tour->id)
            ->whereNotIn('id', $existingLocationIds)
            ->each(function ($loc) {
                // Delete related profiles too
                $loc->profiles()->delete();
                $loc->delete();
            });

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Tour updated successfully!',
            'tour_id' => $tour->id
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error updating tour: ' . $e->getMessage()
        ], 500);
    }
}


    public function updateTour($id)
    {
        $tour = Tour::with(['locations.profiles'])->findOrFail($id);
        dd($tour);
        //$locations = Location::all();
        //$profiles = Profile::all();
        //return view('escort.dashboard.NewTour.create-tour',compact('escorts','tours','find_tour','user_names'));
    }

    public function tourCheckout($id){
        $tour = Tour::findOrFail($id);
        $data = [];
        $escort_ids = [];
        $tourProfiles = $tour->tourProfiles;
        foreach ($tourProfiles as $profile) {
            $data[] = [
                'escort_id' => $profile->escort_id,
                'tour_location_id'=>$profile->tour_location_id,
                'membership' => $profile->tour_plan,
                'start_date' => $profile->location->start_date->format('d-m-Y'),
                'end_date' => $profile->location->end_date->format('d-m-Y'),
            ];
            $escort_ids[] = $profile->escort_id;
        }
        $checkoutData = [];
        foreach($data  as $key=>$listing){
            $index = date('Ymd', strtotime($listing['start_date'])) . rand(100, 999);
            $checkoutData[$index] = [
                'escort_id'=>$listing['escort_id'],
                'tour_location_id'=>$listing['tour_location_id'],
                'start_date'=>$listing['start_date'],
                'end_date'=>$listing['end_date'],
                'membership'=>$listing['membership']
            ];
        }
        $escorts = Escort::whereIn('id', $escort_ids)->pluck('name', 'id')->toArray();
        session()->put('checkout', $checkoutData);
        return view('escort.dashboard.checkoutPage', compact('data', 'escorts'));
    }
}
