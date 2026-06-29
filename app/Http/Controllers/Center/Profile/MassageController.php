<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\MassageProfile\PurchaseListingRequest;
use App\Http\Requests\MassageProfile\StoreMasssageMediaRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Http\Requests\UpdateEscortRequest;
use App\Models\Duration;
use App\Models\EscortCovidReport;
use App\Models\MassageAvailability;
use App\Models\MassageBrb;
use App\Models\MassageBumpup;
use App\Models\MassageDuration;
use App\Models\MassageGallery;
use App\Models\MassageLike;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\MassageRate;
use App\Models\MassageReviews;
use App\Models\MassagerMasseur;
use App\Models\MassageService;
use App\Models\MassageSetting;
use App\Models\MassageStatistics;
use App\Models\MassageSuspendProfile;
use App\Models\Masseur;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\User;
use App\Repositories\Duration\MassageDurationInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use App\Repositories\MassageProfile\MassageMediaInterface as MassageMedia;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\Message\MassageMediaInterface;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\User\UserInterface;
use App\Traits\ResizeImage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\AgentCommission;


//use Illuminate\Http\Request;

class MassageController extends Controller
{
    protected $escort;
    protected $massage_availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $massage_media;
    protected $massage_profile;
     protected $account;
    


    public function __construct(MassageProfileInterface $massage_profile ,MessageInterface $escort, MassageMedia $massage_media, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, MassageDurationInterface $duration,MassageAvailabilityInterface $massage_availability)
    {
        $this->escort = $escort;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
        $this->massage_media = $massage_media;
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

   
    public function massager_list(Request $request)
    {
    
        // if(is_domain_localhost())
        // $active_profile = get_massage_listed_profile();
        // else
        // $active_profile = [];
        $active_profile = get_massage_listed_profile();
       

       
        return view('center.dashboard.list',compact('active_profile'));
    }

    public function  get_all_massager_list(Request $request)
    {
            
            $massage = MassageProfile::with([
                'mainPurchase',
                'brb' => function ($query) {
                    $query->where('brb_time', '>', Carbon::now('UTC'))
                        ->where('active', 'Y')
                        ->orderBy('brb_time', 'desc');
                },
                'activeBumpup',
                'user:id,status',
                'activeUpcomingSuspend'
            ])
            ->where('user_id', auth()->user()->id)
            ->where('default_setting', 0);
           /*  if($request->isImpersonated) {
                $massage = $massage->where('created_by', $request->impersonatedId);
            } */
            $massage = $massage->withCount(['mainPurchase as is_active']) 
            ->orderByDesc('is_active') 
            ->orderBy('id', 'desc')   
            ->get();


           
          
        

            $home_state = auth()->user()->state_id;
            $localTimeZone  = config("escorts.profile.states.$home_state.timeZone");
        
            $data = $massage->map(function ($row) use($localTimeZone)  {

            if(!empty($row->is_active))
            $is_live = true;
            else
            $is_live = false;   
        
            $isExtended = $row->isListingExtended();

           

            $profile_url = ['id' => $row->id,'ids' => '[]'];
            
            $brb = [];
            if(isset($row->brb) && (count($row->brb)>0))
            $brb = json_decode(json_encode($row->brb),true);  
        
            $activeUpcomingSuspend = [];
            if(isset($row->activeUpcomingSuspend) && (!empty($row->activeUpcomingSuspend)))
            $activeUpcomingSuspend = json_decode(json_encode($row->activeUpcomingSuspend),true); 

           
           $isBumpUped = $row->activeBumpup;
           $row->is_bumpup = !empty($isBumpUped) ? true : false;


            if(!empty($brb) && $is_live)
            $profile_name = '<span id="brb_'.$row->id.'"> '.$row->profile_name.' <sup class="brb_icon listing-tag-tooltip ml-1">Closed <small class="listing-tag-tooltip-desc">Closed  '.date('d-m-Y h:i A', strtotime($brb[0]['selected_time'])).'</small></sup></span>';  
            else
            $profile_name = '<span id="brb_'.$row->id.'"> '.$row->profile_name.'</span>';     

            //$profile_name = '<span id="brb_'.$row->id.'"> '.$row->profile_name.' <pre>'.json_encode($brb, JSON_PRETTY_PRINT).'</pre></span>'; 

            if((!empty($activeUpcomingSuspend) || $row->user->status == "Suspended") && $is_live)
            {
                if($row->user->status == "Suspended")
                $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                <small class="listing-tag-tooltip-desc">Your membership has been Suspended due to a Report</small>
                </sup>';
                else 
                $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($activeUpcomingSuspend['start_date'])) . " to ".date("d-m-Y", strtotime($activeUpcomingSuspend['end_date'])).'</small>
                </sup>';
            }


             if(isset($isExtended->count) && $isExtended->count && $is_live)
             $profile_name  .= '<sup class="brb_icon listing-tag-tooltip ml-1" style="background-color:#1CC88A">Extended <small class="listing-tag-tooltip-desc">Extended  '.date('d-m-Y h:i A', strtotime($isExtended->data->start_date)).'</small></sup>';  


             if( $is_live && $isBumpUped  && (!empty($isBumpUped ))){
                $profile_name .= '<sup class="bumpup_icon listing-tag-tooltip ml-1">Bumped Up
                <small class="listing-tag-tooltip-desc">From ' . getMassageLocalTime($isBumpUped->utc_start_time, $localTimeZone)->format('d-m-Y h:i A') . " to ".getMassageLocalTime($isBumpUped->utc_end_time, $localTimeZone)->format('d-m-Y h:i A').'</small>
                </sup>';
            }

                $status = "";
                
                if($is_live)
                $status = '<div class="dropdown-divider '.canManageClass().'"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center massage_action '.canManageClass().'" data-row-id="'.$row->id.'"  data-row-action="cancel"  href="javascript:void(0)">   <i class="fa fa-window-close"></i> Cancel<div class="dropdown-divider"></div></a>';     
               

                if(!$is_live)
                $status .= '<div class="dropdown-divider '.canManageClass().'"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"  
                href="javascript:void(0)" 
                onclick="openModal(\''.route('web.massage-description', $profile_url).'\')"> 
                <i class="fa fa-eye"></i> View
                <div class="dropdown-divider"></div></a>'; 
                else
                $status.= '<div class="dropdown-divider '.canManageClass().'"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"  
                href="'.route('web.massage-description', $profile_url).'"> 
                <i class="fa fa-eye"></i> View
                </a>'; 


                if(!$is_live)
                $status .= '<div class="dropdown-divider '.canManageClass().'"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center massage_action '.canManageClass().'" data-row-id="'.$row->id.'"  data-row-action="delete"  href="javascript:void(0)">   <i class="fa fa-trash"></i> Delete</a>';     
               
                if(!$is_live)
                $status .= '<div class="dropdown-divider '.canManageClass().'"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center duplicate_profile '.canManageClass().'" data-row-id="'.$row->id.'"  data-row-action="duplicate"  href="javascript:void(0)">   <i class="fa fa-pen"></i> Duplicate</a>'; 

               
                 $action = '<div class="dropdown no-arrow">
                                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                     <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                 </a>
                                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                   
                                                  
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center '.canManageClass().'" href="update-profile/'.$row->id.'"> <i class="fa fa-pen"></i> Edit </a>
                                                   '.$status. 
                            '</div>';

                 //  <div class="dropdown-divider"></div>           
                //<a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#viewMasseur">  <i class="fa fa-eye "></i> View Profile</a>

                return [
                    'is_live' => $is_live ? 1 : 0,
                    'id' => $row->id,
                    'profile_name' => $profile_name,
                    'business_name' => $row->business_name,
                    'business_no' => $row->business_no,
                    'phone' => $row->phone,
                    'created_at' => date('d M Y', strtotime($row->created_at)),
                    'status' => ($is_live) ? '<span class="custom_badge badge_active">Active</span>' : '<span class="custom_badge badge_inactive">Inactive</span>',
                    'action' => $action

                ];
            });  


          


            return response()->json([
                'data' => $data
            ]);

 
    }



    public function make_time_json(Request $request)
    {
         $request_data     = $request->all();
         $availability     = $this->makeAvailability($request_data);

         return response()->json([
                'success' => true,
                'data' => $availability
         ], 200);
    }


    public function makeAvailability($request_data)
    {
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $availability = [];

        foreach ($days as $day) {

            $status = $request_data['availability_time'][$day] ?? 'closed';

            if ($status === 'closed') {
                $availability[$day] = [
                    'status' => 'closed',
                    'from' => null,
                    'to' => null,
                ];
                continue;
            }

            if ($status === '24_hours') {
                $availability[$day] = [
                    'status' => '24_hours',
                    'from' => '12:00 AM',
                    'to' => '11:59 PM',
                ];
                continue;
            }

            // custom / til_late
            $from = null;
            $to   = null;

            if (!empty($request_data['time'][$day]['hh_from']) &&
                !empty($request_data['time'][$day]['ampm_from'])) {
                $from = $request_data['time'][$day]['hh_from'].' '.$request_data['time'][$day]['ampm_from'];
            }

            if (!empty($request_data['time'][$day]['hh_to']) &&
                !empty($request_data['time'][$day]['ampm_to'])) {
                $to = $request_data['time'][$day]['hh_to'].' '.$request_data['time'][$day]['ampm_to'];
            }

            $availability[$day] = [
                'status' => $status,
                'from' => $from,
                'to' => $to,
            ];
        }

        return $availability;
    }


    public function index($id = null)
    {
        $user = auth()->user();    
        $escort = $this->massage_profile->findDefault($user->id,1);
        if(!$escort) {
            $escort = $this->massage_profile->make();
        }
        $massage_profile = $escort;
        $defaultServiceIds = $escort->services()->pluck('service_id')->toArray();

        

        
        $massage_durations = (isset($escort->durations) && count($escort->durations)>0) ? $escort->durations->toArray() : [];
        $availability = $massage_profile->availability ? json_decode($massage_profile->availability->availability_time, true) : [];


        // echo '<pre>';
        // print_r($massage_durations);
        // exit;

        $media = $this->massage_media->with_Or_withoutPosition(auth()->user()->id, []);
        $path = $this->massage_media;
        $durations = $this->duration->all();

        $masseurs  = Masseur::all();
        return view('center.dashboard.profile.create',compact('path','media','escort','durations','massage_profile','massage_durations','masseurs','user','availability'));
    }

    public function getProfile(Request $request, $id)
    {
       
       
        $user = auth()->user();

        /* if($request->isImpersonated) {
            $profile = MassageProfile::where('id', $id)->where('created_by', $request->impersonatedId)->first();
            if(!$profile){
                 return redirect()->route('center.dashboard')->with('error', accessDeniedMsg());
            }
        } */

        
        ########## default profile data ############
        $massage_default = $this->massage_profile->findDefault($user->id,1);
        if(!$massage_default ) {
            $massage_default = $this->massage_profile->make();
        }

        

        $massage_durations = (isset($massage_default->durations) && count($massage_default->durations)>0) ? $massage_default->durations->toArray() : [];
        ########## End default profile data ########

        $escort = $this->escort->find($id);
        if(!$escort || !$id){
        return redirect()->route('center.profile');
        }
        else
        {
           
            $user = auth()->user();
            list($service_one, $service_two, $service_three) = $this->service->findByCategory([1, 2, 3]);
            $durations = $this->duration->all();
            $massage_availability = $escort->availability ? json_decode($escort->availability->availability_time, true) : [];
            $service = $this->service;
            $path = $this->media;
            $media = $this->media->with_Or_withoutPosition(auth()->user()->id, [], $id);
            $defaultImages = $this->media->findDefaultMedia($user->id, 0);
            $escortDefault = $this->escort->findDefault(auth()->user()->id, 1);
           
            $defaultServiceIds = $escortDefault->services()->pluck('service_id')->toArray();
            $edit_mode = true;
    
            $social_links = $escort->social_links;
            $availability = $massage_default->availability ? json_decode($massage_default->availability->availability_time, true) : [];

            
            //dd($escort->imagePosition(9));
            return view('center.dashboard.profile.update', compact('defaultServiceIds','defaultImages','media', 'path', 'escort', 'service', 'availability', 'service_one', 'service_two', 'service_three', 'durations', 'edit_mode','massage_durations','massage_default','social_links','massage_availability'));
        }
        
    }

    
    
    public function update_single_data(Request $request)
    {
       
        try 
        {
            if(isset($request->post_type) && $request->post_type=='rate')
            {
                    if ($request->filled('post_json')) 
                    {
                        $data = json_decode($request->post_json, true);
                       
                        if(isset($data['duration_id']) && isset($data['data_type']))
                        {

                            if(isset($data['massage_profile_id']) && $data['massage_profile_id'] =="")
                            {
                                $massage_default = $this->massage_profile->findDefault(auth()->user()->id,1);
                                $massage_rate  = MassageRate::where(['massage_profile_id'=> $massage_default->id, 'duration_id'=> $data['duration_id']])->first();
                                if($massage_rate)
                                {
                                    $massage_rate->{$data['data_type']} = $data['new_value'];
                                    $massage_rate->save();
                                }
                                else
                                {
                                     $massage_rate   = new  MassageRate;
                                     $massage_rate->massage_profile_id= $massage_default->id;
                                     $massage_rate->duration_id =  $data['duration_id'];
                                     $massage_rate->{$data['data_type']} = $data['new_value'];
                                     $massage_rate->save();
                                }

                            }
                            else
                            {
                                $massage_rate  = MassageRate::where(['massage_profile_id'=> $data['massage_profile_id'], 'duration_id'=> $data['duration_id']])->first();
                                if($massage_rate)
                                {
                                    $massage_rate->{$data['data_type']} = $data['new_value'];
                                    $massage_rate->save();

                                }
                            }
                        }

                    }
            }
            else
            {
                if(isset($request->post_field) && isset($request->post_value) && $request->post_field!="" && $request->post_value!="")
                {
                    $profile  =  MassageProfile::where('user_id',auth()->user()->id)
                            ->where('default_setting',1)
                            ->first();
                            
                    $field = $request->post_field;

                    if($field=='language')
                    {
                        $value = json_decode($request->post_value); 
                        $profile->update([$field => $value]);
                    }
                    elseif($field=='service_id')
                    {
                        $service_data = json_decode($request->post_value,true); 

                        $service_id = isset($service_data['service_id']) ? $service_data['service_id'] : "";
                        $category_id = isset($service_data['category_id']) ? $service_data['category_id'] : "";
                        $price = isset($service_data['price']) ? $service_data['price'] : "";
                        
                        $massage_service = MassageService::where(['massage_profile_id'=> $profile->id,'service_id'=>$service_id,'category_id'=>$category_id])->first();
                        if($massage_service)
                        {
                             $massage_service->price = $price;
                             $massage_service->save();
                        }
                        else
                        {
                               MassageService::create(['massage_profile_id'=> $profile->id,'service_id'=>$service_id,'category_id'=>$category_id,'price'=> $price]);
                        }
                       
                    }

                    else
                    {
                         $value = $request->post_value; 
                         $profile->update([$field => $value]);
                    }
                    
                   
                }
                  
            }
           


            return response()->json([
                    'success' => true,
                    'message' => 'Data updated successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    public function createProfile(Request $request)
    {
       

        try 
        {
            
            DB::beginTransaction();
            $user = auth()->user();
            $request_data = $request->all(); 
            $availability     = make_time_availability($request_data);
            $availabilityJson = json_encode($availability);

            $massage_profile = MassageProfile::where('user_id', auth()->user()->id)
            ->where('default_setting', '!=', 1)
            ->where('enabled', '=', 1)
            ->first();

            /* ================== Massage Profile ================== */
            $massage = new MassageProfile();

            $massage->user_id         = $user->id;
            $massage->profile_name    = $request->filled('profile_name') ? $request->profile_name : null;
            $massage->business_name   = $request->filled('business_name') ? $request->business_name : null;
            $massage->business_no     = $request->filled('business_no') ? $request->business_no : null;
            $massage->phone           = $request->filled('phone') ? $request->phone : null;
            $massage->address         = $request->filled('address') ? $request->address : null;

            $massage->about           = $request->filled('about_title') ? $request->about_title : null;
            $massage->about_us_box    = $request->filled('about_us_box') ? $request->about_us_box : null;

            $massage->building        = $request->filled('building') ? $request->building : null;
            $massage->parking         = $request->filled('parking') ? $request->parking : null;
            $massage->entry           = $request->filled('entry') ? $request->entry : null;

            $massage->furniture_types = $request->filled('furniture_types') ? $request->furniture_types : null;
            $massage->shower          = $request->filled('shower') ? $request->shower : null;
            $massage->ambiance        = $request->filled('ambiance') ? $request->ambiance : null;

            $massage->security        = $request->filled('security') ? $request->security : null;
            $massage->payment         = $request->filled('payment') ? $request->payment : null;
            $massage->loyalty         = $request->filled('loyalty') ? $request->loyalty : null;
            $massage->language        = $request->filled('language')? array_map('strval', $request->language) : null;

            $social_links             = (!empty($request->social_links)) ? $request->social_links : null;
            $massage->social_links    = $social_links;

            $massage->contact         = $request->filled('contact') ? $request->contact : null;

           
            $massage->enabled  = 0; 
               


            $massage->save();

            $massage_profile_id = $massage->id;

            /* ================== Availability ================== */
            MassageAvailability::create([
                'massage_profile_id' => $massage_profile_id,
                'availability_time'  => $availabilityJson,
            ]);

            /* ================== Services ================== */
            if (!empty($request->service_id)) {
                $services = [];

                foreach ($request->service_id as $key => $value) {
                    $services[] = [
                        'price'              => $request->price[$key],
                        'category_id'        => (int) $request->category_id[$key],
                        'massage_profile_id' => $massage_profile_id,
                        'service_id'         => (int) $value,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }

                MassageService::insert($services);
            }

            /* ================== Rates ================== */
            if (!empty($request->duration_id)) {
                $rates = [];

                foreach ($request->duration_id as $key => $value) {
                    $rates[] = [
                        'massage_price'      => $request->massage_price[$key],
                        'incall_price'       => $request->incall_price[$key],
                        'outcall_price'      => $request->outcall_price[$key],
                        'duration_id'        => $value,
                        'massage_profile_id' => $massage_profile_id,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }

                MassageRate::insert($rates);
                
            }



             /* ================== Massager Masseur ================== */
            if (!empty($request->masseur_ids)) 
            {
                $masseurIds = $request->masseur_ids;
                if (is_string($masseurIds)) {
                    $masseurIds = json_decode($masseurIds, true);
                }
   
                $masseur = [];
                if (!empty($masseurIds) && is_array($masseurIds)) 
                {
                    foreach ($masseurIds as $key => $value) 
                    {
                            $masseur[] = [  
                                            'masseur_profile_id'    => $value,
                                            'massage_profile_id'    => $massage_profile_id,
                                            'created_at'            => now(),
                                            'updated_at'            => now(),
                                        ];
                    }   
                }

                if(!empty($masseur))
                MassagerMasseur::insert($masseur);
                update_profile_massure($massage_profile_id,$masseurIds);
            }


        
            /* ================== Gallery (Images) ================== */
            if (!empty($request->position)) {
                foreach ($request->position as $position => $mediaId) {
                    if ($mediaId) {
                        MassageGallery::create([
                            'massage_profile_id' => $massage_profile_id,
                            'massage_media_id'   => isMassageGalleryTemplate($mediaId),
                            'position'           => $position,
                            'type'               => 0,
                        ]);
                    }
                }
            }

            /* ================== Gallery (Videos) ================== */
            if (!empty($request->video_position)) {
                foreach ($request->video_position as $key => $video) {
                    if (!empty($video)) {
                        MassageGallery::create([
                            'massage_profile_id' => $massage_profile_id,
                            'massage_media_id'   => $video,
                            'position'           => $key,
                            'type'               => 1,
                        ]);
                    }
                }
            }
            

            DB::commit();

            return response()->json([
                'success'   => true,
                'massage_profile_id' => $massage_profile_id,
            ]);

        } 
        catch (Exception $e) 
        {
            DB::rollBack();
            Log::error('Massage profile creation failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }



    public function updateprofile(Request $request)
    {
        $message = "";
        $error = true;

        ######### Update profile ##########################
        if($request->type=='profile')
        {
            $input = [
            'profile_name'=>$request->profile_name,
            'business_name'=>$request->business_name,
            'business_no'=>$request->business_no,
            'phone'=>$request->phone,
            'address'=> $request->address,
            'social_links' => (!empty($request->social_links)) ? $request->social_links : null
            ];

            $message = 'Business information updated successfully.';
            if($data =  MassageProfile::find($request->massage_id)->update($input)) 
            $error = false;
            massage_profile_complete_status($request->massage_id);
        }
        ######### End Update profile  #####################


        ######### Update Abous us #########################
        if($request->type=='about_us')
        {
                $input = [
                'building'        => $request->filled('building') ? $request->building : null,
                'parking'         => $request->filled('parking') ? $request->parking : null,
                'entry'           => $request->filled('entry') ? $request->entry : null,
                'furniture_types' => $request->filled('furniture_types') ? $request->furniture_types : null,
                'shower'          => $request->filled('shower') ? $request->shower : null,
                'ambiance'        => $request->filled('ambiance') ? $request->ambiance : null,
                'security'        => $request->filled('security') ? $request->security : null,
                'payment'         => $request->filled('payment') ? $request->payment : null,
                'loyalty'         => $request->filled('loyalty') ? $request->loyalty : null,
                'language'        => $request->filled('language') ? array_map('strval', $request->language) : null,
                'contact'         => $request->filled('contact') ? $request->contact : null,

                ];

            $message = 'Updated successfully.';
            if($data =  MassageProfile::find($request->massage_id)->update($input)) 
            $error = false;
        
            massage_profile_complete_status($request->massage_id);
        }
        ######### End Update Abous us #####################


        ######### Update Who We ###########################
        if($request->type=='who_we')
        {
                $input = [
                'about'        => $request->filled('about_title') ? $request->about_title : null,
                'about_us_box'  => $request->filled('about_us_box') ? $request->about_us_box : null,
                ];

            $message = 'Who We Are updated successfully.';
            if($data =  MassageProfile::find($request->massage_id)->update($input)) 
            $error = false;
        }
        ########### End Update Who We #####################


        ######### Update Media ###########################
        if($request->type=='media' && $request->massage_id)
        {
            try 
            {
              
                $id = $request->massage_id;
                $user = auth()->user();
                $media_arr = [];
                $errors = "";
                $successFlashMsg = $id ? 'Profile updated successfully' : 'Profile created successfully';
                $galleryStorageFull = false;
                $noOfFilesInGallery = $this->media->get_user_row(auth()->user()->id, [8, 10])->count();
               
                if($request->position){
                    foreach($request->position as $position=>$media_id){
                        if(!empty($media_id)){
                            $media_arr[$position]  = [
                                'massage_profile_id' => $id,
                                'massage_media_id' => $media_id,
                                'position' => $position,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
                        }
                    }
                }

                $escortImages = MassageGallery::where(['massage_profile_id'=>$id,'type'=>'0'])->get();
                if($escortImages->count() > 0)
                {
                    foreach ($escortImages as $escortImage) {
                        if (isset($media_arr[$escortImage->position])) {
                            $escortImage->massage_media_id = $media_arr[$escortImage->position]['massage_media_id'];
                            $escortImage->updated_at = date('Y-m-d H:i:s');
                            $escortImage->save();
                            unset($media_arr[$escortImage->position]);
                        }
                    }
                    if(count($media_arr) > 0){
                        MassageGallery::insert($media_arr);
                    }
                }
                else
                {
                    MassageGallery::insert($media_arr);
                }

                $message = "Updated Successfully."; 
                $error = false;
                Artisan::queue('profile:sync-status'); // update profile verification status
            } catch (Exception $e) {
               $message = "Error occured while updating."; 
               $error = true; 
            }
                  

        }
        ########### End Update Media #####################
        

        ######### Update Video  ##########################
        if($request->type=='video' && $request->massage_id)
        {
            
               
                try 
                {
                $id = $request->massage_id;
                $escortVideos = MassageGallery::where(['massage_profile_id'=>$id,'type'=>'1'])->get();
                $videoGalleryArray = $request->video_position;
                if($escortVideos->count() > 0){
                    foreach($escortVideos as $key=>$video){
                        if(isset($videoGalleryArray[$video->position]) && $videoGalleryArray[$video->position]!=""){
                            $video->massage_media_id = $videoGalleryArray[$video->position];
                            $video->type = '1';
                            $video->updated_at = date('Y-m-d H:i:s');
                            $video->save();
                            unset($videoGalleryArray[$video->position]);
                        }
                    }
                }

                if(count($videoGalleryArray) > 0){
                    foreach($videoGalleryArray as $key=>$video){
                        if($video!="")
                        {
                            $gallery = new MassageGallery;
                            $gallery->massage_profile_id = $id;
                            $gallery->massage_media_id = $video;
                            $gallery->position = $key;
                            $gallery->type = '1';
                            $gallery->created_at = date('Y-m-d H:i:s');
                            $gallery->save();
                        }
                       
                    }
                }
        
                $message = "Updated Successfully."; 
                $error = false;
                } 
                catch (Exception $e) {
                  $message = "Error occured while updating."; 
                  $error = true; 
                } 
        }
        ######### End Update Video  ######################


        ######### Update Service  #########################
        if($request->type=='service')
        {
            try 
            {
                if ((isset($request->service_id)) &&  (!empty($request->service_id)) && (isset($request->category_id))  && (!empty($request->category_id))) 
                {
                    $services = [];

                    $massage_profile_id = $request->massage_id;

                    foreach ($request->service_id as $key => $value) {
                        $services[] = [
                            'price'              => $request->price[$key],
                            'category_id'        => (int) $request->category_id[$key],
                            'massage_profile_id' => $massage_profile_id,
                            'service_id'         => (int) $value,
                            'created_at'         => now(),
                            'updated_at'         => now(),
                        ];
                    }

                    if(!empty($services))
                    {
                        MassageService::where(['massage_profile_id'=> $massage_profile_id])->delete();
                        MassageService::insert($services);
                    }
                    
                    massage_profile_complete_status($request->massage_id);
                }


                $message = "Updated Successfully."; 
                $error = false;
            } 
            catch (Exception $e){
                $message = "Error occured while updating."; 
                $error = true; 
            }
        }
        ######### End Update Service  #####################


        ######### Update Rates  ###########################
        if($request->type=='rates')
        {
            try 
            {
                if (!empty($request->duration_id)) 
                {
                    $massage_profile_id = $request->massage_id;
                    $rates = [];
                    foreach ($request->duration_id as $key => $value) {
                        $rates[] = [
                            'massage_price'      => $request->massage_price[$key],
                            'incall_price'       => $request->incall_price[$key],
                            'outcall_price'      => $request->outcall_price[$key],
                            'duration_id'        => $value,
                            'massage_profile_id' => $massage_profile_id,
                            'created_at'         => now(),
                            'updated_at'         => now(),
                        ];
                    }

                    
                    if(!empty($rates))
                        {
                            MassageRate::where(['massage_profile_id'=> $massage_profile_id])->delete();
                            MassageRate::insert($rates);

                            $default_duration = find_massage_default_duration(auth()->user()->id);
                            $serviceMap = [
                                'massage' => $default_duration['massage_price'] ?? [],
                                '2_hand'  => $default_duration['incall_price'] ?? [],
                                '4_hand'  => $default_duration['outcall_price'] ?? [],
                            ];

                            $validServices = [];
                            foreach ($serviceMap as $service => $prices) {
                                if (isPriceValid($prices)) {
                                    $validServices[] = $service;
                                }
                            }

                            
                            $masseurs = DB::table('masseurs as m')
                                ->leftJoin('massager_masseurs as mm', 'm.id', '=', 'mm.masseur_profile_id')
                                ->whereNull('mm.masseur_profile_id')
                                ->select('m.*')
                                ->get();

                            $masseurIds = $masseurs->pluck('id')->toArray();

                            Log::info($masseurIds);

                            Masseur::whereIn('id', $masseurIds)
                                ->update([
                                    'service' => json_encode($validServices)
                                ]);
                            }
                      
                    massage_profile_complete_status($request->massage_id);    
                }


                $message = "Updated Successfully."; 
                $error = false;
            } 
            catch (Exception $e){
                $message = "Error occured while updating."; 
                $error = true; 
            }
        }
        ######### End Update Rates  #######################


        ######### Update Availibility  ####################
        if($request->type=='availibility')
        {
            try 
            {
                $request_data = $request->all();
                

                if(isset($request->profile_time_avail_update) && $request->profile_time_avail_update=='profile_time_avail_update')
                $availability     = $this->makeAvailability($request_data);
                else
                $availability     = make_time_availability($request_data);;

                Log::info($availability);
                if(!empty($availability))
                {   
                    
                    $massage_profile_id = $request->massage_id;
                    $availabilityJson = json_encode($availability);
                    $record = MassageAvailability::where('massage_profile_id', $massage_profile_id)->first();
                    if ($record) {
                        $record->availability_time = json_encode($availability);
                        $record->save();
                    }
                    else
                    {
                        MassageAvailability::create(['massage_profile_id'=>$massage_profile_id,'availability_time'=>json_encode($availability)]);
                    }
                }
               
                $message = "Updated Successfully."; 
                $error = false;
            } 
            catch (Exception $e){
                $message = "Error occured while updating."; 
                $error = true; 
            }
        }
        ######### End Update Rates  #######################


        ######### Update Who We ###########################
        if($request->type=='social_links')
        {
                // $input = [
                // 'social_links' => (!empty($request->social_links)) ? $request->social_links : null,
                // ];

            $message = 'Updated successfully.';
            $profile = MassageProfile::where(['id'=>$request->massage_id])->first();
            if($profile)
            {
                $profile->default_setting = 1;
                $profile->social_links = $request->social_links;
                $profile->save();
                massage_profile_complete_status($request->massage_id);
            }

            $error = false;
        }
        ########### End Update Who We #####################

        ######### Update masseur ###########################
        if($request->type=='masseur')
        {
            if (!empty($request->masseur_ids)) 
            {
               
                $default_duration = find_massage_default_duration(auth()->user()->id);
                $messure_service = [];

                if(isset($default_duration['massage_price']) && (empty($default_duration['massage_price'])))
                $messure_service[] = 'massage';
                
                if(isset($default_duration['incall_price']) && (empty($default_duration['incall_price'])))
                $messure_service[] = '2_hand'; 

                if(isset($default_duration['outcall_price']) && (empty($default_duration['outcall_price'])))
                $messure_service[] = '4_hand'; 

               

                $massage_profile_id = $request->massage_id;
                $masseurIds = $request->masseur_ids;
                if (is_string($masseurIds)) {
                    $masseurIds = json_decode($masseurIds, true);
                }
   
                $masseur = [];
                if (!empty($masseurIds) && is_array($masseurIds)) 
                {
                    foreach ($masseurIds as $key => $value) 
                    {
                        $masseur[] = [  
                                        'masseur_profile_id'    => $value,
                                        'massage_profile_id'    => $massage_profile_id,
                                        'created_at'            => now(),
                                        'updated_at'            => now(),
                                    ];
                    }   
                }

                if(!empty($masseur))
                {
                    MassagerMasseur::where(['massage_profile_id'=> $massage_profile_id])->delete();
                    MassagerMasseur::insert($masseur);
                    $messures =  Masseur::whereIn('id', $masseurIds)->get();
                    if($messures->isNotEmpty())
                    {
                        foreach($messures as $messure)
                        {
                            if(!empty($messure->service))
                            {
                                $newService = array_values(array_diff($messure->service, $messure_service));
                                $messure->service = !empty($newService) ? $newService : null;
                                $messure->save();
                            }
                        }
                    }

                }

                update_profile_massure($massage_profile_id,$masseurIds);
                $message = 'Updated successfully.';
                $error = false;
            }
        }
        ########### End Update masseur #####################

        return response()->json(compact('error','message'));
    }



   

    ######################### Listing Profile ###########################
    public function add_listing_page(Request $request)
    {
 
            
        $live_profiles = MassagePurchase::where('massage_centre_id',auth()->user()->id)
                        ->whereIn('status',['listed','pending'])
                        ->pluck('massage_profile_id'); 

        $profiles = MassageProfile::where([
            ['user_id', '=', auth()->user()->id],
            ['default_setting', '!=', 1],
            ['enabled', '=', 0],
        ])->get();

        return view('center.dashboard.listing.add-listing',compact('profiles','live_profiles'));     
    }



    public function action_massage_profile(Request $request)
    {
        
        DB::beginTransaction();
        try 
        {
            $mess = "";
            $userId = auth()->user()->id;
            $current_date = Carbon::parse(date('Y-m-d'));
            $home_state = auth()->user()->state_id;
            $massage  = MassageProfile::where(['user_id' => $userId, 'id'=>$request->profile_id])->first();

            if (!$massage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile not found.'
                ]);
            }

            ########## Cancel Profile ###############
            if($request->action=='cancel')
            {
                $puchases = MassagePurchase::where('massage_centre_id', $userId)
                ->where('massage_profile_id', $request->profile_id)
                ->whereIn('status', ['pending', 'listed'])
                ->get();

                if($puchases->isEmpty())
                {
                    return response()->json([
                        'success' => false,
                        'message' => 'Profile is not listed.'
                    ]); 
                } 

                foreach($puchases as $puchase)
                {
                    $profileTimezone = config("escorts.profile.states.$home_state.timeZone");
                    $utc_date_time =  Carbon::now($profileTimezone)->startOfDay()->utc();
                    $puchase->status = 'cancel';
                    $puchase->utc_cancel_time = $utc_date_time;
                    $puchase->save();
                }    


                $massage->purchase_id = NULL;
                $massage->save();
                $mess = 'Profile cancelled successfully.'; 
            }
            ########## End Cancel Profile ###############

            ########## Delete Profile ###################
            if($request->action=='delete')
            {
                $this->delete_massage_profile($massage,$request->profile_id);
                $mess = 'Profile deleted successfully.'; 
                
            }
            ######### End Delete Profile ################

        
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $mess
            ]);

        } 
        catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ]);
        }
        
    }



    public function delete_massage_profile($massage_profile_data,$massage_profile_id)
    {
        $userId = auth()->user()->id;
        MassagePurchase::where(['massage_centre_id' => $userId,'massage_profile_id' => $massage_profile_id])->delete();
        MassageRate::where('massage_profile_id', $massage_profile_id)->delete();
        MassageSuspendProfile::where(['massage_profile_id' => $massage_profile_id,'user_id' => $userId])->delete();
        MassageStatistics::where(['massage_id' => $massage_profile_id,'user_id' => $userId])->delete();
        MassageService::where('massage_profile_id', $massage_profile_id)->delete();
        MassagerMasseur::where('massage_profile_id',$massage_profile_id)->delete();
        MassageReviews::where('massage_id',$massage_profile_id)->delete();
        MassageLike::where('massage_id',$massage_profile_id)->delete();
        MassageGallery::where('massage_profile_id',$massage_profile_id)->delete();
        MassageBumpup::where(['massage_id' => $massage_profile_id,'user_id' => $userId])->delete();
        MassageBrb::where(['profile_id' => $massage_profile_id])->delete();
        MassageAvailability::where('massage_profile_id',$massage_profile_id)->delete();
        $massage_profile_data->delete();
    }

    public function duplicate_massage_profile(Request $request )
    {

        DB::beginTransaction();
        try 
        {
        
            $old_profile_id = isset($request->duplicate_profile_id) ? $request->duplicate_profile_id : "";
            $new_profile_name = isset($request->new_profile_name) ? $request->new_profile_name : "";

            $userId = auth()->user()->id;
            $massage  = MassageProfile::where(['user_id' => $userId, 'id'=>$old_profile_id])->first();

            if (!$massage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile not found.'
                ]);
            }

            if ($massage) 
            {
                $newMassage = $massage->replicate();
                $newMassage->profile_name = $new_profile_name;
                $newMassage->save();

                $new_massage_profile_id = $newMassage->id;

                if($new_massage_profile_id!="")
                {
                    MassageRate::where('massage_profile_id', $old_profile_id)
                    ->get()
                    ->each(function ($rate) use ($new_massage_profile_id) {
                        $newRate = $rate->replicate();
                        $newRate->massage_profile_id = $new_massage_profile_id;
                        $newRate->save();
                    });

                    MassageService::where('massage_profile_id', $old_profile_id)
                    ->get()
                    ->each(function ($rate) use ($new_massage_profile_id) {
                        $newRate = $rate->replicate();
                        $newRate->massage_profile_id = $new_massage_profile_id;
                        $newRate->save();
                    });

                    MassagerMasseur::where('massage_profile_id', $old_profile_id)
                    ->get()
                    ->each(function ($rate) use ($new_massage_profile_id) {
                        $newRate = $rate->replicate();
                        $newRate->massage_profile_id = $new_massage_profile_id;
                        $newRate->save();
                    });

                    MassageGallery::where('massage_profile_id', $old_profile_id)
                    ->get()
                    ->each(function ($rate) use ($new_massage_profile_id) {
                        $newRate = $rate->replicate();
                        $newRate->massage_profile_id = $new_massage_profile_id;
                        $newRate->save();
                    });


                    MassageAvailability::where('massage_profile_id', $old_profile_id)
                    ->get()
                    ->each(function ($rate) use ($new_massage_profile_id) {
                        $newRate = $rate->replicate();
                        $newRate->massage_profile_id = $new_massage_profile_id;
                        $newRate->save();
                    });
                }
            }
            DB::commit();
            return response()->json(['success'   => true,'message' => 'New Profile Created Successfully.']);
        } 

        catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ]);
        }

    }


     public function calculate(Request $request)
        {
            $request->validate([
                'location' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'membership_id' => 'required',
                'members' => 'required|integer|min:1'
            ]);
            

            $start = Carbon::parse($request->start_date);
            $end   = Carbon::parse($request->end_date);

          
            $days = $start->diffInDays($end) + 1;

        
            $ad = Pricing::where('membership_id', $request->membership_id)
                    ->with('memberships')
                    ->first();

            if (!$ad) {
                return response()->json(['error' => 'Membership not found'], 422);
            }

           
            list($total_discount, $total_rate, $single_fee) =
                calculateTotalFee($request->membership_id, $days, $this->account);

           
            $fee = $single_fee * $request->members;

            return response()->json([
                'days' => $days,
                'fee' => number_format($fee, 2),
                'membership_name' => $ad->memberships->name ?? 'N/A',
                'start_formatted' => $start->format('d-m-Y'),
                'end_formatted' => $end->format('d-m-Y'),
            ]);
        }


    public function calculate_listed_user(Request $request)
    {
        
         $days = $request->days;
         $ad = Pricing::where('membership_id', $request->membership_id)
                    ->with('memberships')
                    ->first();

            if (!$ad) {
                return response()->json(['error' => 'Membership not found'], 422);
        }

        
        list($total_discount, $total_rate, $normalRate, $discountRate,$appliedDiscountAmount) =
                calculateTotalFee($request->membership_id, $days, $this->account,Null);
       

      return response()->json([
                'total_rate' => $total_rate,
                'normalRate' => $normalRate,
                'discountRate' => $discountRate,
                'days' => $days,
                'membership_name' => $ad->memberships->name ?? 'N/A',
                'total_discount' => $total_discount,
                //'applied_discount' => $appliedDiscountAmount
            ]); 
    }


    public function listing_payment(PurchaseListingRequest $request)
    {
          
            $data = $request->validated();
            $payload_start_date = $request->listing_start_date;
            $payload_end_date = $request->listing_end_date;

            $home_state = auth()->user()->state_id;
    
            $profileTimezone = config("escorts.profile.states.$home_state.timeZone");


            $start_date = Carbon::createFromFormat('Y-m-d', $payload_start_date)->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $payload_end_date )->format('Y-m-d').' 23:59:59';
            

            $localStartDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$start_date", $profileTimezone);
            $utc_start_time = $localStartDateTime->copy()->setTimezone('UTC');

            $localEndDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$end_date", $profileTimezone);
            $utc_end_time = $localEndDateTime->copy()->setTimezone('UTC');


        
            $parent_id           = 0;
            $membership_id       = $request->membership_id;
            $massage_profile_id  = $request->massage_profile_id;
            $massage_centre_id   =  auth()->user()->id ?? 0;

            $start_date         = $request->listing_start_date;
            $end_date           = $request->listing_end_date;

            $utc_start_time     = $utc_start_time;
            $utc_end_time       = $utc_end_time ;

            $status             = 'pending';

            $rate               = $request->rate ?? 0;
            $discount_rate      = $request->discountRate ?? 0;
            $total_rate         = $request->total_fee;
            $paid_rate          = $request->total_rate ?? 0;
            $appliedDiscountAmount  = $request->applied_discount ?? 0;
            $checkout_number = md5(time());

            $purchase = [
                    'parent_id'          => $parent_id,
                    'checkout_number'    => $checkout_number,
                    'membership_id'      => $membership_id,
                    'massage_centre_id'  => $massage_centre_id,
                    'massage_profile_id' => $massage_profile_id,
                    'start_date'         => $start_date,
                    'end_date'           => $end_date,
                    'utc_start_time'     => $utc_start_time,
                    'utc_end_time'       => $utc_end_time,
                    'status'             => $status,
                    'rate'               => $rate,
                    'discount_rate'      => $discount_rate,
                    'total_rate'         => $total_rate,
                    'paid_rate'          => $paid_rate,
            ];
            session()->forget('MassagePurchase');
            session(['MassagePurchase' => $purchase]);
            $checkout_data['checkout_number'] = $purchase['checkout_number'];
            // $purchase = MassagePurchase::create([
            //     'parent_id'          => $parent_id,
            //     'membership_id'      => $membership_id,
            //     'massage_centre_id'  => $massage_centre_id,
            //     'massage_profile_id' => $massage_profile_id,
            //     'start_date'         => $start_date,
            //     'end_date'           => $end_date,
            //     'utc_start_time'     => $utc_start_time,
            //     'utc_end_time'       => $utc_end_time,
            //     'status'             => $status,
            //     'rate'               => $rate,
            //     'discount_rate'      => $discount_rate,
            //     'total_rate'         => $total_rate,
            //     'paid_rate'          => $paid_rate,
            // ]);

            /** Calulate agent commisson and save the commission */
            // $agentCommission = (new AgentCommission);
            // if($purchase) {
            //     $agentResponse = $agentCommission->saveCommissionData($purchase, $massage_centre_id, $paid_rate);
            // }

            // if($this->account->activeFeeDiscount){
            //     $this->account->activeFeeDiscount()->increment('spend_amount', $appliedDiscountAmount);
            // }
            
             return response()->json([
                'data' => $checkout_data,
                'success' => true,
                'message' => 'Transaction completed successfully.'
            ]);
    }



    public function  massager_current_listing(Request $request)
    {
            $today = Carbon::today();
            $massagers = MassagePurchase::with([
                'brb' => function ($query) {
                    $query->where('brb_time', '>', Carbon::now('UTC'))
                        ->where('active', 'Y')
                        ->orderBy('brb_time', 'desc');
                },
                'massageprofile',
                'user:id,status',
                'activeUpcomingSuspend'
            ])
            ->where('massage_centre_id', auth()->user()->id)
            ->whereIn('status', ['listed','pending'])
            /* ->when($request->isImpersonated, function ($query) use ($request) {
                $query->where('created_by', $request->impersonatedId);
            }) */
            ->orderByRaw("CASE 
                WHEN status = 'listed' THEN 1 
                WHEN status = 'pending' THEN 2 
            ELSE 3 
            END")
            ->limit(1)
            ->get();

            // echo '<pre>';
            // print_r($massagers->toArray());
            // echo '</pre>';
            // exit;


            $data = $massagers->map(function ($row) use ($today) {

                
                $brb = [];
                if(isset($row->brb) && (count($row->brb)>0))
                $brb = json_decode(json_encode($row->brb),true);  
            
                $activeUpcomingSuspend = [];
                if(isset($row->activeUpcomingSuspend) && (!empty($row->activeUpcomingSuspend)))
                $activeUpcomingSuspend = json_decode(json_encode($row->activeUpcomingSuspend),true);

    
                $start = Carbon::parse($row->start_date);
                $end   = Carbon::parse($row->end_date);
                $days = $start->diffInDays($end) + 1;

                $start_date = date('d M Y', strtotime($row->start_date));
                $end_date = date('d M Y', strtotime($row->end_date));

                if(!empty($brb))
                $profile_name = '<span id="brb_'.$row->massageprofile->id.'"> '.$row->massageprofile->profile_name.' <sup class="brb_icon listing-tag-tooltip">Closed <small class="listing-tag-tooltip-desc">Closed  '.date('d-m-Y h:i A', strtotime($brb[0]['selected_time'])).'</small></sup></span>';  
                else
                $profile_name = '<span id="brb_'.$row->massageprofile->id.'"> '.$row->massageprofile->profile_name.'</span>';     

                if(!empty($activeUpcomingSuspend) || $row->user->status == "Suspended")
                {
                    if($row->user->status == "Suspended")
                    $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                    <small class="listing-tag-tooltip-desc">Your membership has been Suspended due to a Report</small>
                    </sup>';
                    else 
                    $profile_name .= '<sup class="suspend_icon listing-tag-tooltip ml-1">Suspended
                    <small class="listing-tag-tooltip-desc">Suspend from ' . date("d-m-Y", strtotime($activeUpcomingSuspend['start_date'])) . " to ".date("d-m-Y", strtotime($activeUpcomingSuspend['end_date'])).'</small>
                    </sup>';
                }


                return [
                    'id' => $row->id,
                    'profile_name' => $profile_name,
                    'address' => 'Home State',//auth()->user()->home_state,
                    'business_name' => $row->massageprofile->business_name,
                    'start_date' => $start_date,
                    'end_date' =>  $end_date,
                    'days' => $days,
                    'membership' => 'Massage Centre',
                    'fee_paid' => '$ '.formatIndianNumber($row->paid_rate),
                    'status' =>  '<span class="custom_badge badge_current">Current</span>'

                ];
            });  


            return response()->json([
                'data' => $data
            ]);

 
    }


    public function  massager_past_listing(Request $request)
    {
           

            $today = Carbon::today();
            $massagers = MassagePurchase::with('massageprofile')->where('massage_centre_id', auth()->user()->id)
            ->whereIn('status', ['expire'])
            /* ->when($request->isImpersonated, function ($query) use ($request) {
                $query->where('created_by', $request->impersonatedId);
            }) */
            ->get();

        
            $data = $massagers->map(function ($row) use ($today) {

                $start = Carbon::parse($row->start_date);
                $end   = Carbon::parse($row->end_date);
                $days = $start->diffInDays($end) + 1;

                $start_date = date('d M Y', strtotime($row->start_date));
                $end_date = date('d M Y', strtotime($row->end_date));


                return [
                    'id' => $row->id,
                    'profile_name' => $row->massageprofile->profile_name,
                    'address' => auth()->user()->home_state,
                    'business_name' => $row->massageprofile->business_name,
                    'start_date' => $start_date,
                    'end_date' =>  $end_date,
                    'days' => $days,
                    'membership' => 'Massage Centre',
                    'fee_paid' => '$ '.$row->paid_rate,

                ];
            });  


            return response()->json([
                'data' => $data
            ]);

 
    }


    //"{"input_day":"time[tuesday][hh_from]","input_value":"03:00 AM","input_type":"from"}"

    public function update_open_time(Request $request)
    {
        if($request->post_json_open_time!=="")
        {
            $user = auth()->user();
            $post_json_open_time = json_decode($request->post_json_open_time, true);
            $massage_default = $this->massage_profile->findDefault($user->id,1);
            if(!$massage_default ) {
                $massage_default = $this->massage_profile->make();
            }

            
            
             $input_type = $post_json_open_time['input_type'];
             $availability = $massage_default->availability ? json_decode($massage_default->availability->availability_time, true) : [];

            if($input_type == 'from' || $input_type =='to')
            {
                     $input_day =  $post_json_open_time['input_day'];
                     $input_value =  $post_json_open_time['input_value'];

                    if(!empty($availability))
                    {
                        preg_match('/time\[(.*?)\]/', $input_day, $matches);
                        $day = $matches[1];
                        foreach ($availability as $key => &$value) {
                            if ($key === $day) 
                            {
                                $availability[$day][$input_type] = $input_value;

                                if($input_type =='to')
                                $availability[$day]['status']= 'custom';
                        
                                break;
                            }
                        }

                    }


                    $massagers_latest_open_time = $availability;
                    $availabilityJson = json_encode($availability);
                    if ($massage_default->availability) {
                        $massage_default->availability->availability_time = $availabilityJson;
                        $massage_default->availability->save(); 
                    }
            }

            if($input_type == 'radio_button')
            {
                
                    $input_day =  $post_json_open_time['input_day'];
                    $input_value =  $post_json_open_time['input_value'];
                    preg_match('/\[(.*?)\]/', $post_json_open_time['input_day'], $matches);
                    $day = $matches[1];
                    foreach ($availability as $key => &$value) 
                    {
                        if ($key === $day) 
                        {
                            if($input_value == 'til_late')
                            {
                                $availability[$day]['status']= 'til_late';
                                $availability[$day]['to']= null;
                            }
                            
                            if($input_value == 'closed')
                            {
                                $availability[$day]['status']= 'closed';
                                $availability[$day]['from']= null;
                                $availability[$day]['to']= null;
                            }
                        
                        }
                    }

                    $massagers_latest_open_time = $availability;
                    $availabilityJson = json_encode($availability);
                    if ($massage_default->availability) {
                        $massage_default->availability->availability_time = $availabilityJson;
                        $massage_default->availability->save(); 
                    }
               
                }

                ########### Update All Profile Time ####################
                $massage_profile = MassageProfile::where('user_id',$user->id)->where('default_setting','!=',1)->get();
                foreach($massage_profile as $profile)
                {
                    if ($profile->availability)
                     {
                         $profile->availability->availability_time = $availabilityJson;
                         $profile->availability->save(); 
                     }   
                }

                ########### Update all Masseur ##########################
                $masseurs = Masseur::where('user_id',$user->id)
                            ->where('status','1')
                            ->where('is_default','1')
                            ->get();
                 
                foreach( $masseurs as  $masseur)
                {
                    $masseur_availability = json_decode($masseur->availability, true);
                    if(!empty($masseur_availability))
                    {
                         $updated_avail = update_all_default_massures($massagers_latest_open_time,$masseur_availability);
                         if(!empty($updated_avail))
                         {
                            $new_availability_Json = json_encode($updated_avail);
                            $masseur->availability = $new_availability_Json;
                            $masseur->save();   
                         }

                    }
                }

            return response()->json([
                'success' => true,
                'availibility' => $availability,
                //'old_availability' => $old_availability,
            ]);

        }
    }


    public function update_availibility($inputAvailibility, $old_availability)
    {
        foreach ($inputAvailibility as $day => $newData) 
        {
            Log::info('day');
            Log::info($day);

            $oldData = $old_availability[$day] ?? null;
            $oldFrom = $oldData['from'];
            $oldTo   = $oldData['to'];

            $newFrom = $newData['from'];
            $newTo   = $newData['to'];
            $status  = $newData['status'];

            
            $oldFromTime = $oldFrom ? strtotime($oldFrom) : null;
            $oldToTime   = $oldTo ? strtotime($oldTo) : null;
            $newFromTime = $newFrom ? strtotime($newFrom) : null;
            $newToTime   = $newTo ? strtotime($newTo) : null;

           
            if ($status === 'closed') 
            {
                $old_availability[$day] = [
                    'status' => 'closed',
                    'from'   => null,
                    'to'     => null,
                ];
                continue;
            }

           
            if ($status === 'til_late') 
            {

                // if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime)) {
                //     $oldFrom = $newFrom;
                //     $old_availability[$day] = ['from'   => $oldFrom];
                // }

                // if ($newToTime && (!$oldToTime || $newToTime < $oldToTime)) {
                //     $oldTo = $newTo;
                //     $old_availability[$day] = ['to'   => $oldTo];
                // }

                // No changes 
                continue;
            }

    
            if ($status === 'custom') 
            {
                
                if ($newFromTime && (!$oldFromTime || $newFromTime > $oldFromTime)) {
                    $oldFrom = $newFrom;
                }

                Log::info($newToTime .'=========='. $oldToTime);
               
                if ($newToTime && (!$oldToTime || $newToTime < $oldToTime)) {
                    $oldTo = $newTo;
                }

                $old_availability[$day] = [
                    'status' => 'custom',
                    'from'   => $oldFrom,
                    'to'     => $oldTo,
                ];
            }

        }
        
        return $old_availability;
    }

   
    public function payment_completed()
    {
        $redirect_url = url('center-dashboard/listing/current');
        return view('escort.dashboard.complete-listings',compact('redirect_url'));
    }

}
