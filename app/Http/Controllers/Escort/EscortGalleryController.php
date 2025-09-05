<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\Escort\StoreGalleryMediaRequest;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\EscortMedia;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

use App\Models\EscortCovidReport;
//use Illuminate\Http\Request;

class EscortGalleryController extends AppController
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
    public function __construct(EscortInterface $escort, EscortMediaInterface $media)
    {
        $this->escort = $escort;
        $this->media = $media;
    }

    public function photoGalleries()
    {
        $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
        $mediaCategory = $media->whereNull('position');
        $path = $this->media;
        return view('escort.dashboard.archives.archive-view-photos',compact('mediaCategory','media','path'));
    }

    public function videoGalleries()
    {
        $media = $this->media->get_videos(auth()->user()->id);
        $path = $this->media->findByVideoposition(auth()->user()->id,1)['path'];

        return view('escort.dashboard.archives.archive-view-videos',compact('path','media'));
    }
    public function uploadGallery(StoreGalleryMediaRequest $request)
    {
        try {
        $userId = auth()->user()->id;
        $response['status'] = '';
        $prefix = 'images/';
        $type = 0;
        $file_path = $prefix.$userId;
        if($request->hasFile('img')){
            if ($request->hasFile('img')) {
                foreach($request->file('img') as $key => $image){
                    $encryptedFileName = $this->_generateUniqueFilename($image->getClientOriginalName());
                    $destination_path = $file_path.'/gallery_'.$encryptedFileName;
                    Storage::disk('escorts')->put($destination_path, file_get_contents($image));
                    if(!$media = $this->media->findByPath('escorts/'.$destination_path)) {
                    $data = [
                    'user_id' => $userId,
                    'type' => $type,
                    'path' => 'escorts/'.$destination_path,
                    ];
                    $response['status'] = 200;
                    $media = $this->media->store($data);
                    }
                    else {
                        $response['status'] = 200;
                    }
                }
            }
        }
        if($request->hasFile('banner')){
            $key = 9;
            $image = $request->file('banner');
            $encryptedFileName = $this->_generateUniqueFilename($image->getClientOriginalName());
            $destination_path = $file_path.'/banner_'.$encryptedFileName;
            $manager = new ImageManager(new GdDriver());
            $extension = strtolower($image->getClientOriginalExtension());
            $orgImage = $manager->read($image->getPathname());
            $resizeImage = $orgImage->scaleDown(width: 1920, height: 469);
            $encoded = match ($extension) {
                'jpg', 'jpeg' => $resizeImage->toJpeg(quality: 90),
                'png'         => $resizeImage->toPng(),
                default       => throw new \Exception('Unsupported image format')
            };
            Storage::disk('escorts')->put($destination_path, (string) $encoded);
            if(!$media = $this->media->findByPath('escorts/'.$destination_path)) {
                $mediaRecordId = null;
                if($bannerImages = EscortMedia::where('position', '=', 9)->where('user_id', '=', auth()->user()->id)->get()) {
                    foreach ($bannerImages as $bannerImage) {
                        $bannerImage->default = 0;
                        $bannerImage->save();
                    }
                }
                $data = [
                'user_id' => $userId,
                'type' => $type,
                'position' => $key,
                'path' => 'escorts/'.$destination_path
                ];
                $media = $this->media->store($data);
                $response['status'] = 200;
            } else {
                $this->media->nullPosition($userId,$key);
                $media->position = $key;
                $media->save();
                $response['status'] = 200;
            }
        }
        if($request->hasFile('pinup'))
        {
            $key = 10;
            $image = $request->file('pinup');
            $encryptedFileName = $this->_generateUniqueFilename($image->getClientOriginalName());
            $extension = strtolower($image->getClientOriginalExtension());
            $destination_path = $file_path.'/pinup_'.$encryptedFileName;
            $manager = new ImageManager(new GdDriver());
            $orgImage = $manager->read($image->getPathname());
            $resizeImage = $orgImage->scaleDown(width: 855, height: 627);
            $encoded = match ($extension) {
                'jpg', 'jpeg' => $resizeImage->toJpeg(quality: 90),
                'png'         => $resizeImage->toPng(),
                default       => throw new \Exception('Unsupported image format')
            };
            Storage::disk('escorts')->put($destination_path, (string) $encoded);
            if(!$media = $this->media->findByPath('escorts/'.$destination_path)) {
                $mediaRecordId = null;
                if($pinupImages = EscortMedia::where('position', '=', 10)->where('user_id', '=', auth()->user()->id)->get()) {
                    foreach ($pinupImages as $pinupImage) {
                        $pinupImage->default = 0;
                        $pinupImage->save();
                    }
                }
                $data = [
                'user_id' => $userId,
                'type' => $type,
                'position' => $key,
                'path' => 'escorts/'.$destination_path
                ];
                $media = $this->media->store($data);
                $response['status'] = 200;
            } else {
                $this->media->nullPosition($userId,$key);
                $media->position = $key;
                $media->save();
                $response['status'] = 200;
            }
        }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json($response);
    }
    public function uploadVideosGaller(Request $request)
    {

        $userId = auth()->user()->id;
        $my_data['status'] = '';

        if($request->hasFile('videos'))
        {
            $names = [];
            $media_arr = [];
            $total_Img_count = $this->media->get_videos(auth()->user()->id)->count();

            $upload_videos_count = count($request->file('videos'));
            $upload_count = 6 - $total_Img_count;

            $i = 1;
            foreach($request->file('videos') as $key => $video)
            {
                $mime = $video->getMimeType();
                if(strstr($mime, "video/")){
                    $prefix = 'videos/';
                    $type = 1;  //0=>image; 1=>video
                } else {
                    $prefix = 'images/';
                    $type = 0;
                }
                list($width, $height) = getimagesize($video);
                
                $file_path = $prefix.$userId.'/'.Str::slug(pathinfo($video->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$video->getClientOriginalExtension();


                  
                    Storage::disk('escorts')->put($file_path, file_get_contents($video));

                    if(!$media = $this->media->findByPath('escorts/'.$file_path)) {
                        $data = [
                            'user_id' => $userId,
                            'type' => $type,
                            'path' => 'escorts/'.$file_path,
                        ];
                        if($key == 8) {
                            $data['position'] = $key;
                            $data['default'] = 1;
                        }
                        if($this->media->get_videos($userId)->count() < 6 ){
                            $media = $this->media->store($data);
                            $my_data['status'] = 200;

                        } else {
                            $my_data['status'] = 405; // Can't upload more then 30 Images
                            $my_data['count'] = $upload_count;
                        }
                        

                    } else {


                        $my_data['status'] = 1062;
                    }


                $i++;

            }
        }
        $my_data['url'] = route('escort.archive-view-videos');


        return response()->json(compact('my_data'));
    }
    public function defaultImages(Request $request)
    {
        $error = false;
        $msg = '';

        $media = $this->media->find($request->meidaId);

        $labels = [
            9 => 'Banner',
            10 => 'Pin Up',
        ];
        $repositoryName = array_key_exists($request->position,$labels)?$labels[$request->position]:'Gallery';
        if((in_array($request->position,[9,10]) && $request->position != $media->position) || ($request->position < 9 && in_array($media->position,[9,10]))) {
            $msg = "The photo you selected is not a {$repositoryName} image.  Please select a {$repositoryName} image from your repository.";
        } 
        else if(!in_array($media->position,[9,10]) && !empty($media->default)){
            $msg = "The photo you selected is already set as the default. Please select a {$repositoryName} image from your repository.";
        }
        else {
            $this->media->nullPosition(auth()->user()->id, $request->position);
            $media->position = $request->position;
            $media->default = 1;
            $media->save();
            $error = true;
        }
        return response()->json(compact('error','msg'));
    }
    public function defaultVideos(Request $request)
    {
       // dd("DefaultImages");
        //dd($request->all());
        $error = false;
        $msg = '';

        $media = $this->media->find($request->meidaId);

        $this->media->nullVedioPosition(auth()->user()->id,$request->position);
        if($media->count() > 0) {
            $media->position = $request->position;
            $media->default = 1;
            $media->save();
            $error = true;
        }




        return response()->json(compact('error','msg'));
    }
    public function getDefaultImages()
    {

        $error = true;
        $path = [
            1 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 1, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 1, 1)['id']
            ],
            2 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 2, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 2, 1)['id']
            ],
            3 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 3, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 3, 1)['id']
            ],
            4 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 4, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 4, 1)['id']
            ],
            5 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 5, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 5, 1)['id']
            ],
            6 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 6, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 6, 1)['id']
            ],
            7 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 7, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 7, 1)['id']
            ],
            8 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 8, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 8, 1)['id']
            ],
            9 => [
                'path' => asset($this->media->findByposition(auth()->user()->id, 9, 1)['path']),
                'id' => $this->media->findByposition(auth()->user()->id, 9, 1)['id']
            ],
            10 => [
                'path' => asset($this->media->findByVideoposition(auth()->user()->id, 10, 1)['path']),
                'id' => $this->media->findByVideoposition(auth()->user()->id, 10, 1)['id']
            ],
        ];
        return response()->json(compact('error','path'));
    }
    public function agentgetDefaultImages($id)
    {

        $error = true;
        
        $path = [];
        $path = [
            1 => ['path' => asset($this->media->findByposition($id,1)['path']),
                'id' => $this->media->findByposition($id,1)['id']
            ],
            2 => ['path' => asset($this->media->findByposition($id,2)['path']),
                'id' => $this->media->findByposition($id,2)['id']
            ],
            3 => ['path' => asset($this->media->findByposition($id,3)['path']),
                'id' => $this->media->findByposition($id,3)['id']
            ],
            4 => ['path' => asset($this->media->findByposition($id,4)['path']),
                'id' => $this->media->findByposition($id,4)['id']
            ],
            5 => ['path' => asset($this->media->findByposition($id,5)['path']),
                'id' => $this->media->findByposition($id,5)['id']
            ],
            6 => ['path' => asset($this->media->findByposition($id,6)['path']),
                'id' => $this->media->findByposition($id,6)['id']
            ],
            7 => ['path' => asset($this->media->findByposition($id,7)['path']),
                'id' => $this->media->findByposition($id,7)['id']
            ],
            8 => ['path' => asset($this->media->findByposition($id,8)['path']),
                'id' => $this->media->findByposition($id,8)['id']
            ],
            9 => ['path' => asset($this->media->findByposition($id,9)['path']),
                'id' => $this->media->findByposition($id,9)['id']
            ],
            10 => ['path' => asset($this->media->findByVideoposition($id,1)['path']),
                'id' => $this->media->findByVideoposition($id,1)['id']
            ],
        ];
        return response()->json(compact('error','path'));
    }
    public function ImagesDelete(Request $request, $id)
    {

        $error = false;
        $this->media->nullPosition(auth()->user()->id,$request->position);
        if($media = $this->media->find($id)) {
            @unlink(Storage::disk('escorts')->path("../".$media->path));
            $media->delete();
            $error = true;
        }
        return response()->json(compact('error'));
    }
    public function videosDelete(Request $request, $id)
    {
        $error = false;
        $this->media->nullVedioPosition(auth()->user()->id,$request->position);
        if($media = $this->media->find($id)) {
            unlink(Storage::disk('escorts')->path("../".$media->path));
            $media->delete();
            $error = true;
        }
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

    public function getAccountMediaGallery(Request $request, $category=null){
        try {
            $media = $this->media->with_Or_withoutPosition(auth()->user()->id, []);
            $mediaCategory = match ($category) {
                'gallery' => $media->whereNull('position'),
                'banner'  => $media->whereIn('position',[9]),
                'pinup'   => $media->whereIn('position',[10]),
            };
            $path = $this->media;
            $response = [];
            $response['success'] = true;
            $response['category'] = $category;
            $response['gallery_container_html'] = view('escort.dashboard.profile.partials.media_gallery_container',compact('mediaCategory','media','path','category'))->render();
            $response['gallery_modal_container_html'] = view('escort.dashboard.profile.partials.gallery_modal_container',compact('media','path'))->render();
            $response['banner_modal_container_html'] = view('escort.dashboard.profile.partials.banner_modal_container',compact('media','path'))->render();
            $response['pinup_modal_container_html'] = view('escort.dashboard.profile.partials.pinup_modal_container',compact('media','path'))->render();
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
