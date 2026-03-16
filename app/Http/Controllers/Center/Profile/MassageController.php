<?php

namespace App\Http\Controllers\Center\Profile;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Masseur;
use App\Models\Service;
use App\Models\Duration;
use App\Models\MassageRate;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MassageGallery;
use App\Models\MassageProfile;
use App\Models\MassageService;
use App\Models\MassageSetting;
use App\Models\MassagerMasseur;
use App\Models\EscortCovidReport;
use Illuminate\Support\Facades\DB;
use App\Models\MassageAvailability;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Service\ServiceInterface;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Repositories\Duration\MassageDurationInterface;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Http\Requests\Escort\UpdateRequestReadMore;

use App\Repositories\Message\MessageMediaInterface;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Http\Requests\MassageProfile\StoreMasssageMediaRequest;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;
use Illuminate\Pagination\LengthAwarePaginator;

// use App\Repositories\MassageProfile\MassageMediaInterface;
use App\Repositories\Message\MassageMediaInterface;
use App\Repositories\MassageProfile\MassageMediaInterface as MassageMedia;

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
    


    public function __construct(MassageProfileInterface $massage_profile ,MessageInterface $escort, MassageMedia $massage_media, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, MassageDurationInterface $duration,MassageAvailabilityInterface $massage_availability)
    {
        $this->escort = $escort;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
        $this->massage_media = $massage_media;
    }

   
    public function massager_list(Request $request)
    {
        return view('center.dashboard.list');
    }

    public function  get_all_massager_list(Request $request)
    {

            $masseurs  = MassageProfile::where('user_id', auth()->user()->id)->where('default_setting','=',0)->get();
            $countries = getCountryList();

            $data = $masseurs->map(function ($row) use ($countries) {

                if($row->enabled==1)
                $status = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-ban"></i> Deactivate</a>';   
                 else
                $status = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-circle"></i> Activate</a>';     
               
                $status = "";
               
                 $action = '<div class="dropdown no-arrow">
                                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                     <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                 </a>
                                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                   
                                                  
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="update-profile/'.$row->id.'" target="_blank"> <i class="fa fa-pen"></i> Edit profile </a>
                                                   '.$status.
                                                  
                                                   
                            '</div>';
                 //  <div class="dropdown-divider"></div>           
                //<a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#viewMasseur">  <i class="fa fa-eye "></i> View Profile</a>

                return [
                   
                    'profile_name' => $row->profile_name,
                    'business_name' => $row->business_name,
                    'business_no' => $row->business_no,
                    'phone' => $row->phone,
                    'created_at' => date('d M Y', strtotime($row->created_at)),
                    'status' => ($row->enabled==1) ? '<span class="custom_badge badge_active">Active</span>' : '<span class="custom_badge badge_inactive">Deactive</span>',
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

        
        $massage_durations = (isset($escort->durations) && count($escort->durations)>0) ? $escort->durations->toArray() : [];

        // echo '<pre>';
        // print_r($massage_durations);
        // exit;

        

        $media = $this->massage_media->with_Or_withoutPosition(auth()->user()->id, []);
        $path = $this->massage_media;
        $durations = $this->duration->all();

        $masseurs  = Masseur::all();


        dd($user->business_name );
        return view('center.dashboard.profile.create',compact('path','media','escort','durations','massage_profile','massage_durations','masseurs','user'));
    }

    public function getProfile(Request $request, $id)
    {
       
        $user = auth()->user();

        
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
            $availability = $escort->availability ? json_decode($escort->availability->availability_time, true) : [];
            $service = $this->service;
            $path = $this->media;
            $media = $this->media->with_Or_withoutPosition(auth()->user()->id, [], $id);
            $defaultImages = $this->media->findDefaultMedia($user->id, 0);
            $escortDefault = $this->escort->findDefault(auth()->user()->id, 1);
           
            $defaultServiceIds = $escortDefault->services()->pluck('service_id')->toArray();
            $edit_mode = true;

           

            
            $social_links = $escort->social_links;

            
            
            //dd($escort->imagePosition(9));
            return view('center.dashboard.profile.update', compact('defaultServiceIds','defaultImages','media', 'path', 'escort', 'service', 'availability', 'service_one', 'service_two', 'service_three', 'durations', 'edit_mode','massage_durations','massage_default','social_links'));
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
                    $value = $request->post_value;    
                    
                    $profile->update([
                        $field => $value
                    ]);
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
            $availability     = $this->makeAvailability($request_data);
            $availabilityJson = json_encode($availability);

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
            if($data =  MassageProfile::where(['id'=>$request->massage_id])->update($input)) 
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
            if($data =  MassageProfile::where(['id'=>$request->massage_id])->update($input)) 
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
            if($data =  MassageProfile::where(['id'=>$request->massage_id])->update($input)) 
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
                $availability     = $this->makeAvailability($request_data);

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

                }
               
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
    
        $profiles  = MassageProfile::where([
                                ['user_id', '=', auth()->user()->id],
                                ['default_setting', '!=', 1],
                                ['enabled', '=', 1],
                                ])->get();

        return view('center.dashboard.listing.add-listing',compact('profiles'));     
    }



    public function add_listing_user(Request $request)
    {
        dd($request->all());

    }


    


}
