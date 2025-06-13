<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Models\MassageGallery;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\MassageProfile\StoreMasssageMediaRequest;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\MassageProfile\MassageMediaInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Models\EscortCovidReport;
use FFMpeg;
use File;
//use Illuminate\Http\Request;

class UpdateController extends Controller
{
    protected $escort;
    protected $massage_availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_profile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(MassageAvailabilityInterface $massage_availability, MassageProfileInterface $massage_profile, UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability,  ServiceInterface $service, DurationInterface $duration, MassageMediaInterface $media)
    {
        $this->escort = $escort;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
    }

    public function index()
    {
        return view('escort.dashboard.profile.createProfile');
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
        $escort = $this->massage_profile->find($id);

        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        $durations = $this->duration->all();
        //dd($escort->availability);
        $availability = $escort->availability;
        $service = $this->service;
        $massage_img = $escort->medias;
       
        //dd($escort);
       //dd($escort->imagePosition(8));
        return view('center.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations'));
        // {{--return view('center.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations'));--}}
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Escort\UpdateRequestAboutMe  $request
     * @return \Illuminate\Http\Response
     */
    
    public function createBySetting(StoreMasssageMediaRequest $request ,$id = null)
    {
       
        //dd($request->file('img'));
        $error = 0;
        $user = auth()->user();
        $massage_profile = $this->massage_profile->findDefault($user->id,1);
        // dd($user->id);
        // dd($massage_profile);
        $input = [
            'name'=>$request->name ? $request->name : null,
            'phone'=>$request->phone ? $request->phone : null,
            'profile_name'=>$request->profile_name ? $request->profile_name : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'address' => $request->address,
            'about'=>$request->about ? $request->about : null,
            //'gender'=>$escort->gender ? $escort->getRawOriginal('gender') : NULL,
            'phone'=>$request->phone ? $request->phone : NULL,
            'city_id'=>$request->city_id ? $request->city_id : NULL,
            'state_id'=>$request->state_id ? $request->state_id : NULL,
            'ambiance'=>$request->ambiance ? $request->ambiance : NULL,
            'parking'=>$request->parking ? $request->parking : NULL,
            'entry'=>$request->entry ? $request->entry : NULL,
            'building'=>$request->building ? $request->building : NULL,
            'furniture_types'=>$request->furniture_types ? $request->furniture_types : NULL,
            'shower'=>$request->shower ? $request->shower : NULL,
            'security'=>$request->security ? $request->security : NULL,
            'payment'=>$request->payment ? $request->payment : NULL,
            'loyalty'=>$request->loyalty ? $request->loyalty : NULL,
            'language'=>$request->language ? $request->language : NULL,
            'social_links'=>$massage_profile && $massage_profile->social_links != null ? $massage_profile->social_links : NULL,
            'enabled'=>1,
            'user_id'=>$user->id,
            'default_setting' => 0,
            
        ];
        //dd($input);
        $my_data = [];
        if($new_massage_profile = $this->massage_profile->store($input,$id)) {
            $massage_profile_id = $new_massage_profile->id;
            $my_data['new_profile'] = 1;
        
        }
        $arr = [];

        foreach($request->duration_id as $key =>$value)
        {
            $arr  += [$value => [
                "massage_price" => $request->massage_price[$key],
                "incall_price" => $request->incall_price[$key],
                "outcall_price" => $request->outcall_price[$key]],
                ];
        }
        ;
        //dd($arr);
        if($data_d = $new_massage_profile->durations()->sync($arr)) {
            $my_data['new_duration'] = 1;
        }
        $data = [];
        if(!empty($request->mon_hh_from)) {
            $data  += [
            "monday_from" => $this->parseTime($request->mon_hh_from,$request->mon_mm_from,$request->mon_time_from),
            "monday_to" => $this->parseTime($request->mon_hh_to,$request->mon_mm_to,$request->mon_time_to),
            ];

        } else {
            $data  += [
                "monday_from" => null,
                "monday_to" => null,
            ];
        }
        if(!empty($request->tue_hh_from))
        {
            $data  += [
                "tuesday_from" => $this->parseTime($request->tue_hh_from,$request->tue_mm_from,$request->tue_time_from),
                "tuesday_to" => $this->parseTime($request->tue_hh_to,$request->tue_mm_to,$request->tue_time_to),
                ];
        } else {
            $data  += [
                "tuesday_from" => null,
                "tuesday_to" => null,
            ];
        }
        if(!empty($request->wed_hh_from))
        {
            $data  += [
                "wednesday_from" =>$this->parseTime($request->wed_hh_from,$request->wed_mm_from,$request->wed_time_from),
                "wednesday_to" => $this->parseTime($request->wed_hh_to,$request->wed_mm_to,$request->mon_time_to),
                 ];
        } else {
            $data  += [
                "wednesday_from" => null,
                "wednesday_to" => null,
            ];
        }
        if(!empty($request->thu_hh_from))
        {
            $data  += [
                "thursday_from" => $this->parseTime($request->thu_hh_from,$request->thu_mm_from,$request->thu_time_from),
                "thursday_to" => $this->parseTime($request->thu_hh_to,$request->thu_mm_to,$request->thu_time_to),
                ];
        } else {
            $data  += [
                "thursday_from" => null,
                "thursday_to" => null,
            ];
        }
        if(!empty($request->fri_hh_from))
        {
            $data  += [
                "friday_from" => $this->parseTime($request->fri_hh_from,$request->fri_mm_from,$request->fri_time_from),
                "friday_to" => $this->parseTime($request->fri_hh_to,$request->fri_mm_to,$request->fri_time_to),
                 ];
        } else {
            $data  += [
                "friday_from" => null,
                "friday_to" => null,
            ];
        }
        if(!empty($request->sat_hh_from))
        {
            $data  += [
                "saturday_from" => $this->parseTime($request->sat_hh_from,$request->sat_mm_from,$request->sat_time_from),
                "saturday_to" => $this->parseTime($request->sat_hh_to,$request->sat_mm_to,$request->sat_time_to),
                ];
        } else {
            $data  += [
                "saturday_from" => null,
                "saturday_to" => null,
            ];
        }
        if(!empty($request->sun_hh_from))
        {
            $data  += [
                "sunday_from" =>$this->parseTime($request->sun_hh_from,$request->sun_mm_from,$request->sun_time_from),
                "sunday_to" => $this->parseTime($request->sun_hh_to,$request->sun_mm_to,$request->sun_time_to),
                ];
        } else {
            $data  += [
                "sunday_from" => null,
                "sunday_to" => null,
            ];
        }
        if(!empty($request->availability_time)) 
        {
            $data  += [
            "availability_time" =>$request->availability_time,
            ];
        }
         $data  += [
            "massage_profile_id" =>$massage_profile_id,
            ];
        //dd($data);
        //$escort = $this->escort->find($escortId);
        $availability = $new_massage_profile->availability;
        
       
       if($data_massage_availability = $this->massage_availability->store($data, $availability ? $availability->id : null)) {
        $my_data['new_availability'] = 1;
       }
            
        //dd($data);
        
        $service_arr = [];
        
        if(!empty($request->service_id)) {
            foreach($request->service_id as $key =>$value)
            {
                $service_arr  += [$value => ["price" => $request->price[$key],
                                    "category_id" => $request->category_id[$key]]];
                
            }
        }
       //dd($arr);
        
        if($data_service = $new_massage_profile->services()->sync($service_arr)) {
            $my_data['new_services'] = 1;
        }

        // 
        
       // dd($request->file('img'));
        $media_arr = [];
        if($request->hasFile('img'))
        {
            $names = [];
            
            foreach($request->file('img') as $position =>$image)
            {
                
                $mime = $image->getMimeType();
                if(strstr($mime, "video/")){
                    $prefix = 'videos/';
                    $type = 1;  //0=>image; 1=>video
                } else {
                    $prefix = 'images/';
                    $type = 0;
                }
                list($width, $height) = getimagesize($image);
                //list($type, $prefix) = $this->getPrefix($image);
                $file_path = $prefix.$user->id.'/'.Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$image->getClientOriginalExtension();
                //dd($file_path);
                Storage::disk('massageProfile')->put($file_path, file_get_contents($image));
               
                if(!$media = $this->media->findByPath('massageProfile/'.$file_path)) {
                    $data = [
                        'user_id' => $user->id,
                        'type' => $type,
                        //'position' => $position,
                        'path' => 'massageProfile/'.$file_path,
                    ]; 
                    // $media = $this->media->updateOrCreate($data,$user->id,$position);
                    if($this->media->get_user_row(auth()->user()->id)->count() < 30) {
                        $media = $this->media->create($data);
                        $media_arr[]  = [
                        'massage_media_id' => $media['id'],
                        'position' => $position,
                        // 'position' => $media['position'],
                        ];
                    } else {
                        $my_data['msg'] = "Opss... There are 30 Images";
                    } 
                        
                    
                    //echo "mmid=".$media['id'];
                } else {
                    $media_arr[]  = [
                        'massage_media_id' => $media->id,
                        'position' => $position,
                    ];
                    //echo "elseid=".$media->id;
                }
                $my_data['status'] = 200;
               //$destinationPath = 'content_images/';
                // $filename = $image->getClientOriginalName();
                // $image->move($file_path, $filename);
                // array_push($names, $filename);    
            }
        }
        //dd($media_arr);
        
        if($request->position) {
            foreach($request->position as $position) {
                
                if($media = $this->media->find($position)) {
                    $media_arr[]  = [
                        'massage_media_id' => $media->id,
                        'position' => $media->position,
                    ];
                    //echo  "id =".$media->id."--p=".$media->position."</br>";
                }
                
                
            }
        }
        
        if($this->media->get_user_row(auth()->user()->id)->count() <= 30) {
            foreach($media_arr as $key => $value) {
                $result = MassageGallery::where('position',$value['position'])
                    //->where('massage_media_id',$value['massage_media_id'])
                    ->where('massage_profile_id',$massage_profile_id)
                    ->delete();
            }
        }
        $new_massage_profile->gallary()->syncWithoutDetaching($media_arr);
        
        $my_data['url'] = route('center.update.profile', [$massage_profile_id]);
        return response()->json(compact('my_data'));
        //return redirect()->route('center.update.profile', [$massage_profile_id]);
    }

    public function storeAboutMe(UpdateRequestAboutMe $request, $id)
    {
       // dd($id);
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
        $escort = $this->massage_profile->findbysetting($id);
        dd($escort);
        if($escort->id == $id)
        {
            $id = null;
            $input['user_id'] =$user->id;
            
        }

        $request->start_date ? $input['start_date'] = $request->start_date : NULL;
        $request->end_date ? $input['end_date'] = $request->end_date : NULL;
        $error = true;

        if($escort = $this->massage_profile->store($input, $id)) {
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
                $arr += [$value => ["price" => $request->price[$key]]];
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
        if(!empty($request->mon_hh_from)) {
            $data  += [
            "monday_from" => $this->parseTime($request->mon_hh_from,$request->mon_mm_from,$request->mon_time_from),
            "monday_to" => $this->parseTime($request->mon_hh_to,$request->mon_mm_to,$request->mon_time_to),
            "escort_id" => $escortId,
                ];

        } else {
            $data  += [
                "monday_from" => null,
                "monday_to" => null,
            ];
        }
        if(!empty($request->tue_hh_from))
        {
            $data  += [
                "tuesday_from" => $this->parseTime($request->tue_hh_from,$request->tue_mm_from,$request->tue_time_from),
                "tuesday_to" => $this->parseTime($request->tue_hh_to,$request->tue_mm_to,$request->tue_time_to),
                "escort_id" => $escortId,
                    ];
        } else {
            $data  += [
                "tuesday_from" => null,
                "tuesday_to" => null,
            ];
        }
        if(!empty($request->wed_hh_from))
        {
            $data  += [
                "wednesday_from" =>$this->parseTime($request->wed_hh_from,$request->wed_mm_from,$request->wed_time_from),
                "wednesday_to" => $this->parseTime($request->wed_hh_to,$request->wed_mm_to,$request->mon_time_to),
                "escort_id" => $escortId,
                    ];
        } else {
            $data  += [
                "wednesday_from" => null,
                "wednesday_to" => null,
            ];
        }
        if(!empty($request->thu_hh_from))
        {
            $data  += [
                "thursday_from" => $this->parseTime($request->thu_hh_from,$request->thu_mm_from,$request->thu_time_from),
                "thursday_to" => $this->parseTime($request->thu_hh_to,$request->thu_mm_to,$request->thu_time_to),
                "escort_id" => $escortId,
                    ];
        } else {
            $data  += [
                "thursday_from" => null,
                "thursday_to" => null,
            ];
        }
        if(!empty($request->fri_hh_from))
        {
            $data  += [
                "friday_from" => $this->parseTime($request->fri_hh_from,$request->fri_mm_from,$request->fri_time_from),
                "friday_to" => $this->parseTime($request->fri_hh_to,$request->fri_mm_to,$request->fri_time_to),
                "escort_id" => $escortId,
                    ];
        } else {
            $data  += [
                "friday_from" => null,
                "friday_to" => null,
            ];
        }
        if(!empty($request->sat_hh_from))
        {
            $data  += [
                "saturday_from" => $this->parseTime($request->sat_hh_from,$request->sat_mm_from,$request->sat_time_from),
                "saturday_to" => $this->parseTime($request->sat_hh_to,$request->sat_mm_to,$request->sat_time_to),
                "escort_id" => $escortId,
                    ];
        } else {
            $data  += [
                "saturday_from" => null,
                "saturday_to" => null,
            ];
        }
        if(!empty($request->sun_hh_from))
        {
            $data  += [
                "sunday_from" =>$this->parseTime($request->sun_hh_from,$request->sun_mm_from,$request->sun_time_from),
                "sunday_to" => $this->parseTime($request->sun_hh_to,$request->sun_mm_to,$request->sun_time_to),
                "escort_id" => $escortId,
                    ];
        } else {
            $data  += [
                "sunday_from" => null,
                "sunday_to" => null,
            ];
        }
        if(!empty($request->availability_time)) 
        {
            $data  += [
            "availability_time" =>$request->availability_time,
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
}
