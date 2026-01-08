<?php

namespace App\Http\Controllers\Center\Profile;

use File;
use FFMpeg;
use App\Models\Escort;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Escort\StoreRequest;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\Duration\DurationInterface;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Http\Requests\Escort\StoreEscortMediaRequest;
use App\Repositories\MassageProfile\MassageProfileInterface;

class CreateController extends Controller
{
    use ResizeImage;

    protected $escort;
    protected $media;
    protected $thumbnail;
    protected $service;
    protected $duration;
    protected $massage_profile;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(MassageProfileInterface $massage_profile ,EscortInterface $escort, EscortMediaInterface $media, ThumbnailInterface $thumbnail,  ServiceInterface $service, DurationInterface $duration)
    {
        $this->escort = $escort;
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->service = $service;
        $this->duration = $duration;
        $this->massage_profile = $massage_profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if(!$escort = $this->massage_profile->findDefault($user->id,1)) {
            $escort = $this->massage_profile->make();
        }
        else
        {
             $escort = $this->massage_profile->make();
        }

        $massage_profile = $escort;
        // $user = auth()->user();
        // if(!empty($user->profile_creator) && in_array(2,$user->profile_creator)) {
        //     if(!$escort = $this->escort->findDefault($user->id,1)) {
        //         $escort = $this->escort->make();
        //     }
        // } else {
        //     $escort = $this->escort->make();
        // }
        $defaultServiceIds = $escort->services()->pluck('service_id')->toArray();
        $profile = $escort;

        // if(!$escort = $user->escorts->where('user_id', $user->id)->where('completed', 1)->first()) {

        //     $data = [
        //         'user_id' => $user->id,
        //         'name' => '',
        //         'enabled' => 0, 
        //         'completed' => 1,
        //     ];

        //     $escort = $this->escort->store($data);
        // }

        $profile = $escort;

        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        $durations = $this->duration->all();
        $availability = $escort->availability;
        $service = $this->service;

        $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
        $path = $this->media;






        //return view('center.profile-info.create-profile',compact('escort','service','availability','service_one','service_two','service_three','durations'));
        return view('center.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations','path','media','massage_profile'));
    }

    public function nextStep($id)
    {
        $escort = $this->escort->find($id);
        $escort->completed = 2;

        $escort->save();
        return redirect()->route('escort.update.profile', [$escort->id]);
    }

    public function createProfile(Request $request)
    {
        // dd($request->all());
        //$data = $request->validated();

        // $input = [
        //     'profile_name'=>$request->profile_name,
        //     'business_name'=>$request->business_name,
        //     'business_no'=>$request->business_no,
        //     'phone'=>$request->phone,
        //     'address'=>$request->address,
        //     'country_id'=>$request->country_id,
        //     'state_id'=>$request->state_id,
        //     'social_links'=>$request->social_links,
        //     'user_id' => auth()->id(),
        //     'completed' => 2,
        //     'enabled' => 1,
        // ];

        // //$id = request()->get('id');

        // $escort = $this->escort->store($input, $id);

        // $error = false;

        // $url = route('escort.update.profile', [$escort->id]);

        // return response()->json(compact('escort','error','url'), 200);

        $request_data = $request->all();
        $availability =  $this->makeAvailability($request_data);
        $escort = new Escort();

        $escort->profile_name       = $request->filled('profile_name') ? $request->profile_name : null;
        $escort->business_name      = $request->filled('business_name') ? $request->business_name : null;
        $escort->business_no        = $request->filled('business_no') ? $request->business_no : null;
        $escort->phone              = $request->filled('phone') ? $request->phone : null;
        $escort->address            = $request->filled('address') ? $request->address : null;

        $escort->about_title        = $request->filled('about_title') ? $request->about_title : null;
        $escort->about_us_box       = $request->filled('about_us_box') ? $request->about_us_box : null;

        $escort->building           = $request->filled('building') ? $request->building : null;
        $escort->parking            = $request->filled('parking') ? $request->parking : null;
        $escort->entry              = $request->filled('entry') ? $request->entry : null;

        $escort->furniture_types    = $request->filled('furniture_types') ? $request->furniture_types : null;
        $escort->shower             = $request->filled('shower') ? $request->shower : null;
        $escort->ambiance           = $request->filled('ambiance') ? $request->ambiance : null;

        $escort->security           = $request->filled('security') ? $request->security : null;
        $escort->payment            = $request->filled('payment') ? $request->payment : null;
        $escort->loyalty            = $request->filled('loyalty') ? $request->loyalty : null;


        $escort->massage_price      = !empty($request->massage_price) ? $request->massage_price : null;
        $escort->incall_price       = !empty($request->incall_price) ? $request->incall_price : null;
        $escort->outcall_price      = !empty($request->outcall_price) ? $request->outcall_price : null;

        $escort->availability  = !empty($availability) ? $availability : null;
        $escort->save();

        return response()->json([
            'success' => true,
            'escort_id' => $escort->id,
        ]);

    }


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

    public function markDefault($id)
    {
        $media = $this->media->find($id);
        $this->media->markDefault($media);

        $profile = $this->escort->find($media->escort_id);

        $template = view('escort.dashboard.profile.partials.escort-media-table', compact('profile'))->render();

        $status = true;

        return response()->json(compact('template', 'status'), 200);
    }
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
