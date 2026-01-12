<?php

namespace App\Http\Controllers\Center\Profile;

use File;
use FFMpeg;
use stdClass;
use Exception;
use App\Models\Escort;
use App\Models\MassageRate;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MassageGallery;
use App\Models\MassageProfile;
use App\Models\MassageService;
use Illuminate\Support\Facades\DB;
use App\Models\MassageAvailability;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Escort\StoreRequest;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Duration\DurationInterface;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Message\MessageMediaInterface;
use App\Http\Requests\Escort\StoreEscortMediaRequest;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Repositories\MassageProfile\MassageAvailabilityInterface;

class CreateController extends Controller
{
    use ResizeImage;

    protected $escort;
    protected $media;
    protected $thumbnail;
    protected $service;
    protected $duration;
    protected $massage_profile;
    protected $massage_availability;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response MessageMediaInterface
     */
    public function __construct(MassageProfileInterface $massage_profile ,MessageInterface $escort, MessageMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, DurationInterface $duration,MassageAvailabilityInterface $massage_availability)
    {
        $this->escort = $escort;
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->service = $service;
        $this->duration = $duration;
        $this->massage_profile = $massage_profile;
        $this->massage_availability = $massage_availability;
    }

   
    public function archives($id = null)
    {
        $user = auth()->user();

        if(!$profile = $this->escort->find($id)) {
            $profile = $this->escort->make();
        }
        
        return view('escort.dashboard.profile.archives.create-archives', compact('profile'));
    }

    public function archivesProfile($id = null)
    {
        $user = auth()->user();

        if(!$profile = $this->escort->find($id)) {
            $profile = $this->escort->make();
        }
        
        return view('escort.dashboard.profile.archives.create-archives', compact('profile'));
    }

    public function archivesMedia($id = null)
    {
        $user = auth()->user();

        if(!$profile = $this->escort->find($id)) {
            $profile = $this->escort->make();
        }
        

        return view('escort.dashboard.profile.archives.archives-media', compact('profile'));
    }
   
    public function archivesMediamasseurs($id = null)
    {
        $user = auth()->user();

        if(!$profile = $this->escort->find($id)) {
            $profile = $this->escort->make();
        }
        

        return view('escort.dashboard.profile.archives.media-masseurs', compact('profile'));
    }

    public function archivesMediamasseurs01($id = null)
    {
        $user = auth()->user();

        if(!$profile = $this->escort->find($id)) {
            $profile = $this->escort->make();
        }
        

        return view('escort.dashboard.profile.archives.media-masseurs01', compact('profile'));
    }

    
    public function index($id = null)
    {
        $user = auth()->user();
        $escort = $this->massage_profile->findDefault($user->id,1);
        if(!$escort) {
            $escort = $this->massage_profile->make();
        }
        $massage_profile = $escort;
        $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
        $path = $this->media;
        $durations = $this->duration->all();
        return view('center.dashboard.profile.create',compact('path','media','escort','durations','massage_profile'));
    }

    public function get_profile(Request $request, $id)
    {
     
        $user = auth()->user();
        $escort = $this->escort->find($id);

        //dd($escort);
        if(!$escort) {
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
            //$users_for_available_playmate = $this->user->findPlaymates(auth()->user()->id);
            $defaultImages = $this->media->findDefaultMedia($user->id, 0);
            $escortDefault = $this->escort->findDefault(auth()->user()->id, 1);

            


            $defaultServiceIds = $escortDefault->services()->pluck('service_id')->toArray();

            ///dd($escortDefault->services());

            $edit_mode = true;
            ///return view('center.dashboard.profile.update',compact('path','media','massage','durations','massage_profile','edit_mode'));
            return view('center.dashboard.profile.update', compact('defaultServiceIds','defaultImages','media', 'path', 'escort', 'service', 'availability', 'service_one', 'service_two', 'service_three', 'durations', 'edit_mode'));
        }

     


        //dd($massage_profile);
        // $defaultServiceIds = $escort->services()->pluck('service_id')->toArray();
        // $profile = $escort;
        // $profile = $escort;
        // list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        // $durations = $this->duration->all();
        // $availability = $escort->availability;
        // $service = $this->service;

        //$media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
       // $path = $this->media;
        //$durations = $this->duration->all();
        
        
    }


    public function createProfile(Request $request)
    {
        try 
        {

            DB::beginTransaction();
            $user = auth()->user();
            $availability     = $this->makeAvailability($request->all());
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
            $massage->language        = $request->filled('language') ? (int) $request->language : null;

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


    public function nextStep($id)
    {
        $escort = $this->escort->find($id);
        $escort->completed = 2;

        $escort->save();
        return redirect()->route('escort.update.profile', [$escort->id]);
    }

    // public function createProfile(Request $request)
    // {
    
    //     $user = auth()->user();
    //     $request_data = $request->all();
    //     $availability =  $this->makeAvailability($request_data);
    //     $availabilityJson = json_encode($availability);

    //     $massage = new MassageProfile();

    //     $massage->user_id            = auth()->user()->id;
    //     $massage->profile_name       = $request->filled('profile_name') ? $request->profile_name : null;
    //     $massage->business_name      = $request->filled('business_name') ? $request->business_name : null;
    //     $massage->business_no        = $request->filled('business_no') ? $request->business_no : null;
    //     $massage->phone              = $request->filled('phone') ? $request->phone : null;
    //     $massage->address            = $request->filled('address') ? $request->address : null;

    //     $massage->about              = $request->filled('about_title') ? $request->about_title : null;
    //     $massage->about_us_box       = $request->filled('about_us_box') ? $request->about_us_box : null;

    //     $massage->building           = $request->filled('building') ? $request->building : null;
    //     $massage->parking            = $request->filled('parking') ? $request->parking : null;
    //     $massage->entry              = $request->filled('entry') ? $request->entry : null;

    //     $massage->furniture_types    = $request->filled('furniture_types') ? $request->furniture_types : null;
    //     $massage->shower             = $request->filled('shower') ? $request->shower : null;
    //     $massage->ambiance           = $request->filled('ambiance') ? $request->ambiance : null;

    //     $massage->security           = $request->filled('security') ? $request->security : null;
    //     $massage->payment            = $request->filled('payment') ? $request->payment : null;
    //     $massage->loyalty            = $request->filled('loyalty') ? $request->loyalty : null;
    //     $massage->language           = $request->filled('language')? (int) $request->language : null;

    
    //     $massage->save();
    //     if($massage->id)
    //     {
    //             $massage_profile_id = $massage->id;
    //             ###### Saving Our Open Times #################
    //             $massage_availability =  new MassageAvailability;
    //             $massage_availability->massage_profile_id = $massage_profile_id;
    //             $massage_availability->availability_time  = $availabilityJson; 
    //             $massage_availability->save();
    //             ########### End Saving Our Open Times #########

                
    //             ############ Saving Our Service (Tags) ##############
    //             if(!empty($request->service_id)) {
    //                     $arr = [];
    //                     foreach($request->service_id as $key =>$value)
    //                     {
    //                         $arr[] = [
    //                             "price" => $request->price[$key],
    //                             "category_id" => (int) $request->category_id[$key],
    //                             "massage_profile_id" => $massage_profile_id,
    //                             "service_id" => (int) $value,
    //                             'created_at' => now(),
    //                             'updated_at' => now(),  
    //                         ];

                        
    //                     }

    //                     if(!empty($arr))  
    //                     MassageService::insert($arr);
    //                 }
    //             ############ End Saving Our Service (Tags) ##############


    //             ################### Store Rates #########################
    //             if(!empty($request->duration_id))
    //             {
    //                 $rates = [];
    //                 foreach($request->duration_id as $key =>$value)
    //                 {
    //                     $rates [] = [
    //                         "massage_price" => $request->massage_price[$key],
    //                         "incall_price" => $request->incall_price[$key],
    //                         "outcall_price" => $request->outcall_price[$key],
    //                         "duration_id" => $value,
    //                         "massage_profile_id" => $massage_profile_id,
    //                         'created_at' => now(),
    //                         'updated_at' => now(), 
    //                         ];
    //                 }

    //                 if(!empty($rates))  
    //                 MassageRate::insert($rates);
    //             }   
    //             ################### End Store Rates #########################   


    //             ############# Store Images And Videos #######################
    //             $media_arr = [];
    //             if(!empty($request->position))
    //             {
    //                 foreach ($request->position as $position => $mediaId) {
    //                     if ($mediaId) {
    //                         $media_arr[$position]  = [
    //                             'massage_media_id' => isGalleryTemplate($mediaId),
    //                             'position' => $position,
    //                         ];
    //                     }
    //                 }  
                    
    //                 foreach ($media_arr as $newRecord) 
    //                 {
    //                     $gallery = new MassageGallery;
    //                     $gallery->massage_profile_id = $massage_profile_id;
    //                     $gallery->massage_media_id = $newRecord['massage_media_id'];
    //                     $gallery->position = $newRecord['position'];
    //                     $gallery->created_at = date('Y-m-d H:i:s');
    //                     $gallery->save();
    //                 }


    //                 $videoGalleryArray = $request->video_position;
    //                 if(count($videoGalleryArray) > 0)
    //                 {
    //                     foreach($videoGalleryArray as $key=>$video){

    //                         if($video!="")
    //                         {
    //                             $gallery = new MassageGallery;
    //                             $gallery->massage_profile_id = $massage_profile_id;
    //                             $gallery->massage_media_id = $video;
    //                             $gallery->position = $key;
    //                             $gallery->type = '1';
    //                             $gallery->created_at = date('Y-m-d H:i:s');
    //                             $gallery->save();
    //                         }   
                            
    //                     }
    //                 }

    //             }
    //             ############# End Store Images And Videos #######################    
              

                

    //     dd($gallery);
    //     //dd($massage->id);

    //     return response()->json([
    //         'success' => true,
    //         'escort_id' => $massage->id,
    //     ]);
    // }

    // }


        // public function makeAvailability($request_data)
        // {

        //         $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        //         $availability = [];
        //         foreach ($days as $day) 
        //         {

        //             $status = $request_data['availability_time'][$day] ?? 'closed';
        //             if ($status === 'closed') 
        //             {

        //                 $availability[$day] = [
        //                     'status' => 'closed',
        //                     'from'   => null,
        //                     'to'     => null,
        //                 ];

        //             } 
        //             elseif ($status === '24_hours') 
        //             {

        //                 $availability[$day] = [
        //                     'status' => '24_hours',
        //                     'from'   => '12:00 AM',
        //                     'to'     => '11:59 PM',
        //                 ];

        //             } 
        //             elseif ($status === 'til_late') 
        //             {

        //                 $from = null;
        //                 $to   = null;

        //                 if (
        //                     !empty($request_data['time'][$day]['hh_from']) &&
        //                     !empty($request_data['time'][$day]['ampm_from'])
        //                 ) {
        //                     $from = $request_data['time'][$day]['hh_from'] . ' ' . $request_data['time'][$day]['ampm_from'];
        //                 }

        //                 if (
        //                     !empty($request_data['time'][$day]['hh_to']) &&
        //                     !empty($request_data['time'][$day]['ampm_to'])
        //                 ) {
        //                     $to = $request_data['time'][$day]['hh_to'] . ' ' . $request_data['time'][$day]['ampm_to'];
        //                 }

        //                 $availability[$day] = [
        //                     'status' => 'til_late',
        //                     'from'   => $from,
        //                     'to'     => $to,
        //                 ];
        //             }
                
        //         }

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


    public function saveMedia(StoreEscortMediaRequest $request)
    {
        $escort_id = $request->get('escort_id');
        $medias = array();

        foreach($request->file('files') as $attachment) {

            list($width, $height) = getimagesize($attachment);
            //echo "width=".$width."</br>height=".$height."</br>";

            list($type, $prefix) = $this->getPrefix($attachment);
            //dd($type);
            $file_path = $prefix.$escort_id.'/'.Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$attachment->getClientOriginalExtension();
            Storage::disk('escorts')->put($file_path, file_get_contents($attachment));

            if(!$media = $this->media->findByPath('escorts/'.$file_path)) {
                $data = [
                    'escort_id' => $escort_id,
                    'type' => $type,
                    'path' => 'escorts/'.$file_path,
                ];
                $media = $this->media->store($data);
            }

            $thumbnail_url = null;

            $thumbnail = $prefix.$escort_id.'/thumb/'.Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$attachment->getClientOriginalExtension();

            if($media->type == 0) {
                Storage::disk('escorts')->put($thumbnail, file_get_contents($attachment));
                if(!$thumbnail_media = $this->thumbnail->findByPath('escorts/'.$file_path)) {
                    $data = [
                        'media_id' => $media->id,
                        'model' => 'App\Models\EscortMedia',
                        'path' => 'escorts/'.$thumbnail,
                        'size' => '100X100',
                    ];

                    $thumbnail_media = $this->thumbnail->store($data);
                    $this->resizeCropImage(100, 100, public_path('escorts/'.$file_path), public_path('escorts/'.$thumbnail), $quality = 80);
                }

                $thumbnail_url = url('escorts/'.$thumbnail);
            }

            $medias[] = [
                'id' => $media->id,
                'deleteType' => 'DELETE',
                'deleteUrl' => route('escort.delete.media', $media->id),
                'name' => $attachment->getClientOriginalName(),
                'size' => $attachment->getSize(),
                'thumbnailUrl' => $thumbnail_url ?? url($media->path),
                'type' => $attachment->getMimeType(),
                'url' => url($media->path),
                'play_type' => $media->type,
                'default_url' => route('escort.media.mark.default', $media->id),
            ];
        }

        return response()->json(array('files' => $medias), 200);
    }

    public function getPrefix($file)
    {
        $mime = $file->getMimeType();
        if(strstr($mime, "video/")){
            $str = 'videos/';
            $type = 1;  //0=>image; 1=>video
        } else {
            $str = 'images/';
            $type = 0;  //0=>image; 1=>video
        }
        return [$type, 'attatchment/'.$str];
    }

    public function deleteMedia($id)
    {
        $media = $this->media->find($id);

        foreach($media->thumbnails as $thumbnail) {
            $this->deleteFile(public_path($thumbnail->path));
        }

        $this->deleteFile(public_path($media->path));
        $this->media->destroy($id);

        return response()->json(['status' => true], 200);
    }

    protected function deleteFile($file)
    {
        if (File::exists($file)) {
            unlink($file);
        }
    }

    // public function markDefault($id)
    // {
    //     $media = $this->media->find($id);
    //     $this->media->markDefault($media);

    //     $profile = $this->escort->find($media->escort_id);

    //     $template = view('escort.dashboard.profile.partials.escort-media-table', compact('profile'))->render();

    //     $status = true;

    //     return response()->json(compact('template', 'status'), 200);
    // }


    public function cities($id)
    {
       //echo config("escorts.profile.states.$id.cities");
        $data = [];
        foreach(config("escorts.profile.states.$id.cities") as $key => $state)
        {
            $data[$key] = $state['cityName'];
            // $data['id'] = $key;
            //echo $state['cityName']."</br>";

        }
        //dd($data);
        return response()->json(compact('data'));
    }
}
