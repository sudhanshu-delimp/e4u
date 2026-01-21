<?php

namespace App\Http\Controllers\Center\Profile;

use Exception;
use Carbon\Carbon;
use App\Models\User;
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
use App\Repositories\Duration\DurationInterface;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Repositories\Message\MassageMediaInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Http\Requests\MassageProfile\StoreMasssageMediaRequest;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;

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
    


    public function __construct(MassageProfileInterface $massage_profile ,MessageInterface $escort, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, DurationInterface $duration,MassageAvailabilityInterface $massage_availability)
    {
        $this->escort = $escort;
        $this->massage_availability = $massage_availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->media = $media;
        $this->massage_profile = $massage_profile;
        //$this->massage_media = $massage_media;
    }

   
    // public function makeAvailability($request_data)
    // {

      
    //     $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
    //     $availability = [];

    //     foreach ($days as $day) {

    //         $status = $request_data['availability_time'][$day] ?? 'closed';

    //         if ($status === 'closed') {
    //             $availability[$day] = [
    //                 'status' => 'closed',
    //                 'from' => null,
    //                 'to' => null,
    //             ];
    //             continue;
    //         }

    //         if ($status === '24_hours') {
    //             $availability[$day] = [
    //                 'status' => '24_hours',
    //                 'from' => '12:00 AM',
    //                 'to' => '11:59 PM',
    //             ];
    //             continue;
    //         }


    //         $from = null;
    //         $to   = null;

    //         if (!empty($request_data['time'][$day]['hh_from']) &&
    //             !empty($request_data['time'][$day]['ampm_from'])) {
    //             $from = $request_data['time'][$day]['hh_from'].' '.$request_data['time'][$day]['ampm_from'];
    //         }

    //         if (!empty($request_data['time'][$day]['hh_to']) &&
    //             !empty($request_data['time'][$day]['ampm_to'])) {
    //             $to = $request_data['time'][$day]['hh_to'].' '.$request_data['time'][$day]['ampm_to'];
    //         }

    //         $availability[$day] = [
    //             'status' => $status,
    //             'from' => $from,
    //             'to' => $to,
    //         ];
    //     }

    //     return $availability;
    // }


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

        $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
        $path = $this->media;
        $durations = $this->duration->all();
        return view('center.dashboard.profile.create',compact('path','media','escort','durations','massage_profile','massage_durations'));
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
            //dd($escort->imagePosition(9));
            return view('center.dashboard.profile.update', compact('defaultServiceIds','defaultImages','media', 'path', 'escort', 'service', 'availability', 'service_one', 'service_two', 'service_three', 'durations', 'edit_mode','massage_durations','massage_default'));
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
                        if(isset($data['duration_id']) && isset($data['massage_profile_id']) && isset($data['data_type']))
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
            'address'=>$request->address,
            ];

            $message = 'Business information updated successfully.';
            if($data =  MassageProfile::where(['id'=>$request->massage_id])->update($input)) 
            $error = false;
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
                ];

            $message = 'Updated successfully.';
            if($data =  MassageProfile::where(['id'=>$request->massage_id])->update($input)) 
            $error = false;
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
                $input = [
                'social_links' => (!empty($request->$request->social_links)) ? $request->$request->social_links : null,
                ];

            $message = 'Updated successfully.';
            $profile = MassageProfile::where(['id'=>$request->massage_id])->first();
            if($profile)
            {
                $profile->default_setting = 1;
                $profile->social_links = json_encode($request->social_links);
                $profile->save();
            }

            $error = false;
        }
        ########### End Update Who We #####################

        return response()->json(compact('error','message'));
    }


    // public function updateProfile($id)
    // {
    //     $escort = $this->escort->find($id);
    //     list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
    //     $durations = $this->duration->whereIn('id',[2,3,4]);
    //     $availability = $escort->availability;
    //     $service = $this->service;
    //     return view('escort.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations'));
    // }

    // public function showAboutMe()
    // {
        
    //     $user = auth()->user()->id;
    //     if(!$massage_profile = $this->massage_profile->findDefault($user,1)) {
    //         $massage_profile = $this->massage_profile->make();
    //     }
    //     //dd($massage_profile);
    //     list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
    //     $durations = $this->duration->all();
    //     //dd($massage_profile->massage_services()->where('category_id', 1)->get());
    //     //dd($massage_profile->massage_services);
    //     $availability = $massage_profile->availability;
    //     return view('center.my-account.profile-information',compact('massage_profile','service_one','service_two','service_three','availability','durations'));
    // }

    // public function storeAboutMe(UpdateRequestAboutMe $request)
    // {
    //     //dd($request->all());
    //     $input = [
    //         'building'=>$request->building,
    //         'parking'=>$request->parking,
    //         'entry'=>$request->entry,
    //         'furniture_types'=>$request->furniture_types,
    //         'shower'=>$request->shower,
    //         'ambiance'=>$request->ambiance,
    //         'security'=>$request->security,
    //         'payment'=>$request->payment,
    //         'loyalty'=>$request->loyalty,
    //         'user_id' => auth()->user()->id,
    //         'enabled'=>1,
    //         'default_setting' => 1
    //     ];
    //     $request->language ? $input['language'] = $request->language : $input['language'] ='';
    //    //dd($input);

    //     $error=true;
    //     if($data = $this->massage_profile->updateOrCreate($input, auth()->user()->id,1)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('error'));
    // }

   


    

    // public function storeSocialsLink(Request $request)
    // {
    //     //dd($request->social_links);
    //     $input = [
    //         'social_links'=>$request->social_links,
    //         'default_setting' => 1
    //     ];
       

    //     $error=true;
    //     if($data = $this->massage_profile->updateOrCreate($input, auth()->user()->id,1)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('error'));
    // }



    // public function storeRates(StoreRateRequest $request)
    // {
    //     //dd($request->all());
    //     $user = auth()->user()->id;
    //     $massage_profile = $this->massage_profile->findDefault($user,1);
    //     $arr = [];
    //     foreach($request->duration_id as $key =>$value)
    //     {
    //         $arr  += [$value => [
    //             "massage_price" => $request->massage_price[$key],
    //             "incall_price" => $request->incall_price[$key],
    //             "outcall_price" => $request->outcall_price[$key]],
    //             ];
    //     }
    //     $error=true;
    //     if($data = $massage_profile->durations()->sync($arr)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }


    // public function storeAvailability(StoreAvailabilityRequest $request)
    // {
    //     //dd($request->all());
    //     $user = auth()->user()->id;
    //     $massage_profile = $this->massage_profile->findDefault($user,1);
    //     $massage_profile_id = $massage_profile->id;
    //     $data = [];
    //     if(!empty($request->mon_hh_from)) {
    //         $data  += [
    //         "monday_from" => $this->parseTime($request->mon_hh_from,$request->mon_mm_from,$request->mon_time_from),
    //         "monday_to" => $this->parseTime($request->mon_hh_to,$request->mon_mm_to,$request->mon_time_to),
    //         ];

    //     } else {
    //         $data  += [
    //             "monday_from" => null,
    //             "monday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->tue_hh_from))
    //     {
    //         $data  += [
    //             "tuesday_from" => $this->parseTime($request->tue_hh_from,$request->tue_mm_from,$request->tue_time_from),
    //             "tuesday_to" => $this->parseTime($request->tue_hh_to,$request->tue_mm_to,$request->tue_time_to),
    //             ];
    //     } else {
    //         $data  += [
    //             "tuesday_from" => null,
    //             "tuesday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->wed_hh_from))
    //     {
    //         $data  += [
    //             "wednesday_from" =>$this->parseTime($request->wed_hh_from,$request->wed_mm_from,$request->wed_time_from),
    //             "wednesday_to" => $this->parseTime($request->wed_hh_to,$request->wed_mm_to,$request->mon_time_to),
    //              ];
    //     } else {
    //         $data  += [
    //             "wednesday_from" => null,
    //             "wednesday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->thu_hh_from))
    //     {
    //         $data  += [
    //             "thursday_from" => $this->parseTime($request->thu_hh_from,$request->thu_mm_from,$request->thu_time_from),
    //             "thursday_to" => $this->parseTime($request->thu_hh_to,$request->thu_mm_to,$request->thu_time_to),
    //             ];
    //     } else {
    //         $data  += [
    //             "thursday_from" => null,
    //             "thursday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->fri_hh_from))
    //     {
    //         $data  += [
    //             "friday_from" => $this->parseTime($request->fri_hh_from,$request->fri_mm_from,$request->fri_time_from),
    //             "friday_to" => $this->parseTime($request->fri_hh_to,$request->fri_mm_to,$request->fri_time_to),
    //              ];
    //     } else {
    //         $data  += [
    //             "friday_from" => null,
    //             "friday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->sat_hh_from))
    //     {
    //         $data  += [
    //             "saturday_from" => $this->parseTime($request->sat_hh_from,$request->sat_mm_from,$request->sat_time_from),
    //             "saturday_to" => $this->parseTime($request->sat_hh_to,$request->sat_mm_to,$request->sat_time_to),
    //             ];
    //     } else {
    //         $data  += [
    //             "saturday_from" => null,
    //             "saturday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->sun_hh_from))
    //     {
    //         $data  += [
    //             "sunday_from" =>$this->parseTime($request->sun_hh_from,$request->sun_mm_from,$request->sun_time_from),
    //             "sunday_to" => $this->parseTime($request->sun_hh_to,$request->sun_mm_to,$request->sun_time_to),
    //             ];
    //     } else {
    //         $data  += [
    //             "sunday_from" => null,
    //             "sunday_to" => null,
    //         ];
    //     }
    //     if(!empty($request->availability_time)) 
    //     {
    //         $data  += [
    //         "availability_time" =>$request->availability_time,
    //         ];
    //     }
    //      $data  += [
    //         "massage_profile_id" =>$massage_profile_id,
    //         ];
    //     //dd($data);
    //     //$escort = $this->escort->find($escortId);
    //     $availability = $massage_profile->availability;
        
    //     $error=true;
    //     if($data = $this->massage_availability->store($data, $availability ? $availability->id : null)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }

    // public function storeServices(StoreServiceRequest $request)
    // {
    //     //dd($request->all());
    //     $user = auth()->user()->id;
    //     $massage_profile = $this->massage_profile->findDefault($user,1);
    //     $arr = [];
    //     //dd($request->service_id);
    //     if(!empty($request->service_id)) {
    //         foreach($request->service_id as $key =>$value)
    //         {
                
    //             $arr  += [$value => ["price" => $request->price[$key],
    //                                 "category_id" => $request->category_id[$key]]];
                
    //         }
    //     }
    //    //dd($massage_profile);
    //     $error=true;
    //     if($data = $massage_profile->services()->sync($arr)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }

    // public function uploadCovidReport($file, $escort_id)
    // {
    //     $file_path = 'escort-covid-report/'.$escort_id.'/'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
    //     Storage::disk('escorts')->put($file_path, file_get_contents($file));

    //     $data = [
    //         'escort_id' => $escort_id,
    //         'path' => 'escorts/'.$file_path,
    //     ];

    //     EscortCovidReport::create($data);

    //     return true;
    // }

    // public function storeReadMore(UpdateRequestReadMore $request, $id)
    // {
    //     $input = [
    //         'piercing'=>$request->piercing,
    //         'drugs'=>$request->drugs,
    //         'travel'=>$request->travel,
    //         'tattoos'=>$request->tattoos,
    //         'smoke'=>$request->smoke,
    //         'available_to'=>$request->available_to,
    //         'license'=>$request->license,
    //         'play_type'=> $request->play_type,
    //         'payment_type'=>$request->payment_type
    //     ];
    //     $request->language ? $input['language'] = $request->language : '';
    //     $error=true;
    //     if($data = $this->escort->store($input, $id)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }


    // public function storeAbout(UpdateRequestAbout $request ,$id)
    // {
    //     $input = [
    //         'about'=>$request->about,
    //     ];


    //     $error = true;
    //     if(isset($request->about)) {
    //         $data = $this->escort->store($input, $id);
    //         $error = false;
    //     }
    //     return response()->json(compact('error'));
    // }


    // public function createProfile(StoreRequest $request)
    // {

    //     $input = [
    //         'name'=>$request->name,
    //         'age'=>$request->age,
    //         'phone'=>$request->phone,
    //         'pincode'=>$request->pincode,
    //         'city_id'=>$request->city_id,
    //         'country_id'=>$request->country_id,
    //         'state_id'=>$request->state_id,
    //         'social_links'=>$request->social_links,
    //         'user_id' => auth()->user()->getMemberIdAttribute(),
    //         'enabled' => 1,
    //     ];

    //     $error=true;
    //     if($data = $this->escort->store($input, $id = null)) {
    //         $error = false;
    //         $url = route('update.profile', [$data->id]);
    //     }
    //     return response()->json(compact('data','error','url'));
    // }

    
    

    // public function parseTime($hour,$minutes,$meridian)
    // {
    //     if(($hour && $minutes && $meridian) == null){
    //         return null;
    //     } else {
    //         return Carbon::createFromFormat('g:i A',$hour.":".$minutes." ".$meridian)->toTimeString();
    //     }
    // }

    
    // public function deleteProfile($id)
    // {
    //     $escort = $this->escort->find($id);

    //     $escort->services()->sync([]);
    //     $escort->durations()->sync([]);
    //     $escort->medias()->delete();
    //     $escort->images()->delete();
    //     $escort->videos()->delete();
    //     $escort->messages()->delete();
    //     $this->escort->destroy($id);
    //     $error = 1;


    //     return response()->json(compact('error'));

    // }


    // public function saveMembership(Request $request, $id)
    // {
    //     $escort = $this->escort->find($id);
    //     $data = [];
    //     $enable = [];
    //     $data = ['plan_type' =>$request->plan_type];
    //     $enable = ['enabled' =>1];
    //     $user = $this->user->store($data, $escort->user_id);
    //     $escort_update = $this->escort->store($enable, $id);
    //     $error = 1;


    //     return response()->json(compact('error'));

    // }

    // public function uploadFile($attachment, $escort)
    // {
    //     $escort_id = $escort->id;
        
    //     list($type, $prefix) = $this->getPrefix($attachment);

    //     $file_path = $prefix.$escort_id.'/banner/'.Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$attachment->getClientOriginalExtension();
    //     Storage::disk('escorts')->put($file_path, file_get_contents($attachment));

    //     if(!$media = $this->media->findByPath('escorts/'.$file_path)) {
    //         $data = [
    //             'escort_id' => $escort_id,
    //             'type' => $type,
    //             'path' => 'escorts/'.$file_path,
    //         ];
    //         $media = $this->media->store($data);
    //     }

    //     return true;
    // }

    // public function galleries()
    // {
    //     // $media = $this->media->findByUid(auth()->user()->id);
    //     // $path = $this->media;
    //     //dd($path->findByposition(auth()->user()->id,1)['path']);
        
        
    //      $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
    //      $path = $this->media;
    //      return view('center.dashboard.archives.archive-view-photos',compact('path','media'));
    // }


    // public function defaultImages(Request $request)
    // {

    //     //dd($request->all());
    //     $error = false;
    //     $this->media->nullPosition(auth()->user()->id,$request->position);
    //     if($media = $this->media->find($request->meidaId)) {

    //         $media->position = $request->position;
    //         $media->default = 1;
    //         $media->save();
    //         $error = true; 
    //     }
       
    //     // foreach($request->position as $position => $id) {
    //     //     if($id != null) {
    //     //         
    //     //         $media->position = $position;
    //     //         $media->save();
    //     //         $error = true;
    //     //     }

    //     // }
    //     return response()->json(compact('error'));
    // }


    // public function getDefaultImages()
    // {
    //     $error = true;
    //     //$result = $this->media->imageswithoutnull(auth()->user()->id);
    //     //.dd($result);//$path->
    //     //dd($this->media->findByposition(auth()->user()->id,1)['id']);
    //     $path = [];
    //     $path = [
    //         1 => ['path' => asset($this->media->findByposition(auth()->user()->id,1)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,1)['id'] 
    //         ],
    //         2 => ['path' => asset($this->media->findByposition(auth()->user()->id,2)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,2)['id'] 
    //         ],
    //         3 => ['path' => asset($this->media->findByposition(auth()->user()->id,3)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,3)['id'] 
    //         ],
    //         4 => ['path' => asset($this->media->findByposition(auth()->user()->id,4)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,4)['id'] 
    //         ],
    //         5 => ['path' => asset($this->media->findByposition(auth()->user()->id,5)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,5)['id'] 
    //         ],
    //         6 => ['path' => asset($this->media->findByposition(auth()->user()->id,6)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,6)['id'] 
    //         ],
    //         7 => ['path' => asset($this->media->findByposition(auth()->user()->id,7)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,7)['id'] 
    //         ],
    //         8 => ['path' => asset($this->media->findByposition(auth()->user()->id,8)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,8)['id'] 
    //         ],
    //         9 => ['path' => asset($this->media->findByposition(auth()->user()->id,9)['path']),
    //             'id' => $this->media->findByposition(auth()->user()->id,9)['id'] 
    //         ],
    //     ];
    //     //dd($path);
    //     // $path[1] = asset($this->media->findByposition(auth()->user()->id,1));
    //     // $path[2] = asset($this->media->findByposition(auth()->user()->id,2));
    //     // $path[3] = asset($this->media->findByposition(auth()->user()->id,3));
    //     // $path[4] = asset($this->media->findByposition(auth()->user()->id,4));
    //     // $path[5] = asset($this->media->findByposition(auth()->user()->id,5));
    //     // $path[6] = asset($this->media->findByposition(auth()->user()->id,6));
    //     // $path[7] = asset($this->media->findByposition(auth()->user()->id,7));
    //     // $path[8] = asset($this->media->findByposition(auth()->user()->id,8));
    //     // $path[9] = asset($this->media->findByposition(auth()->user()->id,9));
    //     return response()->json(compact('error','path'));
    // }


    // public function ImagesDelete(Request $request, $id)
    // {

    //     //dd($request->all());
    //     $error = false;
    //     $this->media->nullPosition(auth()->user()->id,$request->position);
    //     if($media = $this->media->find($id)) {
    //         $media->delete();
    //         $error = true; 
    //     }
    //     return response()->json(compact('error'));
    // }


    // public function uploadGaller(StoreMasssageMediaRequest $request)
    // {
    //     $userId = auth()->user()->id;
    //     //dd($request->selected_files);
    //     $my_data['status'] = '';
         
    //     if($request->hasFile('img'))
    //     {
    //         $names = [];
    //         $media_arr = [];
    //         $total_Img_count = $this->media->get_user_row(auth()->user()->id)->count();
    //         $upload_Img_count = count($request->file('img'));
    //         $upload_count = 30 - $total_Img_count;
    //         $val = [];
    //         // echo "count :".$this->media->all()->count();
    //         //dd($upload_count);
    //         if($upload_Img_count <= $upload_count) {
    //             $i = 1;
                
    //         foreach($request->file('img') as $key => $image)
    //         {
    //             if(in_array($key,$request->selected_files)) {

                
    //                 $mime = $image->getMimeType();
    //                 if(strstr($mime, "video/")){
    //                     $prefix = 'videos/';
    //                     $type = 1;  //0=>image; 1=>video
    //                 } else {
    //                     $prefix = 'images/';
    //                     $type = 0;
    //                 }
    //                 list($width, $height) = getimagesize($image);
    //                 $file_path = $prefix.$userId.'/'.Str::uuid().'.'.$image->getClientOriginalExtension();
    //                 // $file_path = $prefix.$userId.'/'.Str::uuid()->slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$image->getClientOriginalExtension();
    //                 //dd($file_path);
    //                 Storage::disk('massageProfile')->put($file_path, file_get_contents($image));
    //                 $data = [
    //                     'user_id' => $userId,
    //                     'type' => $type,
    //                     'path' => 'massageProfile/'.$file_path,
    //                 ];
    //                 if($key == 8) {
    //                     $data['position'] = $key;
    //                     $data['default'] = 1;
    //                 }
    //                 $media_arr = $this->media->store($data);
    //                 $my_data['status'] = 200;
                       
                    
                  
    //                 // if(!$media = $this->media->findByPath('massageProfile/'.$file_path)) {
    //                 //     $data = [
    //                 //         'user_id' => $userId,
    //                 //         'type' => $type,
    //                 //         //'position' => $position,
    //                 //         'path' => 'massageProfile/'.$file_path,
    //                 //     ];
    //                 //     if($key == 8) {
    //                 //         $data['position'] = $key;
    //                 //         $data['default'] = 1;
    //                 //     }
    //                 //     if($this->media->get_user_row($userId)->count() < 30) {
    //                 //         $media_arr = $this->media->store($data);
    //                 //         $my_data['status'] = 200;
                           
    //                 //      } else {
    //                 //         $my_data['status'] = 405; // Can't upload more then 30 Images
    //                 //         $my_data['count'] = $upload_count;
    //                 //     }
    //                 //     $my_data['name1'] = $image->getClientOriginalName();
                        
    //                 // } else {

    //                 //     if($key == 8) {
    //                 //         $this->media->nullPosition($userId,$key);
    //                 //         $media->position = $key;
    //                 //         $media->default = 1;
    //                 //         $media->save();
    //                 //     }
    //                 //     $my_data['status'] = 200;
    //                 //     $val[] = $image->getClientOriginalName();
                        
    //                 // }
    //             } else {
    //                 $my_data['status'] = 400;
    //             }
    //             $i++;
                  
    //         }
            
    //         } else {
    //             if($upload_count == 0) {
    //                 $my_data['msg'] = "Can't upload more then 30 Images";
    //             } else {
    //                 $req_count = $upload_Img_count - $upload_count;
    //                 $my_data['msg'] = "Please select only ". $upload_count." images";
    //             }
                
    //         }
          
            
    //     }
    //     //dd(count($val));
       
    //     $my_data['url'] = route('cen.archive-view-photos');
        
       
    //     return response()->json(compact('my_data','val'));
    // }

    // public function getPrefix($file)
    // {
    //     $mime = $file->getMimeType();
    //     if(strstr($mime, "video/")){
    //         $str = 'videos/';
    //         $type = 3;  //2=>image; 3=>video (banner)
    //     } else {
    //         $str = 'images/';
    //         $type = 2;  //2=>image; 3=>video (banner)
    //     }
    //     return [$type, 'attatchment/'.$str];
    // }

   

    // public function massageSettings(Request $request)
    // {
    //     $setting =MassageSetting::where('user_id', auth()->id())->first();

    //     return view('center.my-account.notifications-and-features', compact('setting'));
    // }

    
    // public function updateNotificationsAndFeatures(Request $request)
    // {
       
    //     $user = auth()->user();
    //     $data = [
    //             'features_viewer_notifications_forward_v_alerts' => $request->features_viewer_notifications_forward_v_alerts ?? 0,
    //             'features_allow_viewers_to_ask_you_a_question' => $request->features_allow_viewers_to_ask_you_a_question ?? 0,
    //             'features_allow_viewers_to_send_you_a_text_message' => $request->features_allow_viewers_to_send_you_a_text_message ?? 0,

    //             'auto_recharge_no' => $request->auto_recharge_no ?? 0,
    //             'auto_recharge_500' => $request->auto_recharge_500 ?? 0,
    //             'auto_recharge_1000' => $request->auto_recharge_1000 ?? 0,
    //             'auto_recharge_1500' => $request->auto_recharge_1500 ?? 0,

    //             'agent_receive_communications' => $request->agent_receive_communications ?? 0,
    //             'agent_send_communications' => $request->agent_send_communications ?? 0,

    //             'alert_notification_email' => $request->alert_notification_email ?? 0,
    //             'alert_notification_text' => $request->alert_notification_text ?? 0,

    //             'idle_preference_time' => $request->idle_preference_time,
    //             'twofa' => $request->twofa,

    //     ];

    //     $setting = $user->massage_settings;
    //     if ($setting) {
    //         $setting->update($data);
    //     } else {
    //         $user->massage_settings()->create(array_merge($data, ['user_id' => $user->id]));
    //     }

    //     return $this->successResponse('Notification settings updated successfully!');
    // }


}
