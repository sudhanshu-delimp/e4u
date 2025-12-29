<?php

namespace App\Http\Controllers\Center\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreEscortMediaRequest;
use App\Repositories\Escort\EscortInterface;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\Duration\DurationInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\MassageProfile\MassageProfileInterface;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use FFMpeg;
use File;

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

    public function createProfile(StoreRequest $request , $id)
    {
        $data = $request->validated();

        $input = [
            'name'=>$request->name,
            'age'=>$request->age,
            'phone'=>$request->phone,
            'pincode'=>$request->pincode,
            'city_id'=>$request->city_id,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'social_links'=>$request->social_links,
            'user_id' => auth()->id(),
            'completed' => 2,
            'enabled' => 1,
        ];

        //$id = request()->get('id');

        $escort = $this->escort->store($input, $id);

        $error = false;

        $url = route('escort.update.profile', [$escort->id]);

        return response()->json(compact('escort','error','url'), 200);
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
