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
use App\Models\EscortGallery;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Illuminate\Support\Facades\DB;

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
        $path = $this->media;
        return view('escort.dashboard.archives.archive-view-photos',compact('media','path'));
    }

    public function videoGalleries()
    {
        return view('escort.dashboard.archives.archive-view-videos');
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
                    $manager = new ImageManager(new GdDriver());
                    $extension = strtolower($image->getClientOriginalExtension());
                    $orgImage = $manager->read($image->getPathname());
                    //$resizeImage = $orgImage->scaleDown(width: 481, height: 410);
                    //$resizeImage = $orgImage->cover(width: 481, height: 410, position: 'top');

                    // $resizeImage = $orgImage->resize(481, 410, function ($constraint) {
                    //     $constraint->aspectRatio();
                    //     $constraint->upsize();
                    // })->pad(481, 410, '#ffffff');
                    // $encoded = match ($extension) {
                    // 'jpg', 'jpeg' => $resizeImage->toJpeg(quality: 90),
                    // 'png'         => $resizeImage->toPng(),
                    // default       => throw new \Exception('Unsupported image format')
                    // };
                    //Storage::disk('escorts')->put($destination_path, (string) $encoded);
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
            if($request->position==9){
                EscortMedia::where(['template'=>'1','user_id'=>auth()->user()->id])->delete();
            }
            $this->media->nullPosition(auth()->user()->id, $request->position);
            if($media->template){
                $copy = $media->replicate();
                $copy->user_id = auth()->user()->id;
                $copy->default = 1;
                $copy->save();
            }
            else{
                $media->position = $request->position;
                $media->default = 1;
                $media->save();
            }
            $error = true;
        }
        return response()->json(compact('error','msg'));
    }
    public function defaultVideos(Request $request)
    {
        $error = false;
        $msg = '';

        $media = $this->media->find($request->mediaId);

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
                'gallery' => $media->whereNotIn('position',[9,10]),
                'banner'  => $media->whereIn('position',[9])->where('template','0'),
                'pinup'   => $media->whereIn('position',[10]),
            };
            $path = $this->media;
            $response = [];
            $response['success'] = true;
            $response['category'] = $category;
            $response['gallery_container_html'] = view('escort.dashboard.profile.partials.media_gallery_container',compact('mediaCategory','media','path','category'))->render();
            $response['gallery_modal_container_html'] = view('escort.dashboard.profile.partials.gallery_modal_container',compact('media','path'))->render();
            $response['banner_modal_container_html'] = view('escort.dashboard.profile.partials.banner_modal_container',compact('media','path'))->render();
            
            if(auth()->user()->type!='4')
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

    public function getAccountVideoGallery(Request $request){
        try {
            $media = $this->media->get_videos(auth()->user()->id);
            $response = [];
            $response['success'] = true;
            $response['total_count'] = $media->count();
            $response['video_container_html'] = view('escort.dashboard.profile.partials.video_gallery_container',compact('media'))->render();
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getDefaultVideos($profileId = 0){
        try {
            $user_id = auth()->user()->id;
            if($profileId){
                //$accountVideos = EscortMedia::where(['user_id'=>$user_id,'type'=>1,'default'=>1])->orderBy('position','ASC')->get();
                $media = EscortGallery::where(['escort_id'=>$profileId,'type'=>'1'])->orderBy('position','ASC')->get();
                foreach($media as $key=>$item){
                    $media[$key]->id = $item->escort_media_id;
                    $media[$key]->media = $item->media;
                }
            }
            else{
                $media = $this->media->findDefaultMedia(auth()->user()->id,1);
            }
            
            $response = [];
            $response['success'] = true;
            $response['media'] = $media;
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function uploadChunk(Request $request)
    {
        $file = $request->file('file');
        $chunkIndex = $request->input('chunkIndex');
        $fileName = $request->input('fileName');

        $chunkPath = "chunks/{$fileName}/chunk_{$chunkIndex}";
        Storage::disk('escorts')->put($chunkPath, file_get_contents($file));

        return response()->json(['status' => 'chunk_received']);
    }

    public function mergeChunks(Request $request)
    {
        $prefix = 'videos/';
        $userId = auth()->user()->id;
        $fileName = $request->input('fileName');
        $originalName = $fileName;
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $slug = Str::slug($baseName);
        $uniqueFileName = $slug . '-' . Str::uuid() . '.' . $extension;
        
        $totalChunks = (int) $request->input('totalChunks');

        // This will be the final merged file location: public/escorts/videos/{filename}
        $finalFilePath = "{$prefix}{$userId}/{$uniqueFileName}";

        $finalFullPath = public_path("escorts/{$finalFilePath}");

        // Ensure the 'videos' directory exists
        if (!file_exists(dirname($finalFullPath))) {
            mkdir(dirname($finalFullPath), 0777, true);
        }

        $finalStream = fopen($finalFullPath, 'ab');

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = "chunks/{$fileName}/chunk_{$i}";

            if (Storage::disk('escorts')->exists($chunkPath)) {
                $chunkStream = Storage::disk('escorts')->readStream($chunkPath);
                stream_copy_to_stream($chunkStream, $finalStream);
                fclose($chunkStream);

                // Delete the chunk
                Storage::disk('escorts')->delete($chunkPath);
            } else {
                fclose($finalStream);
                return response()->json(['error' => "Missing chunk {$i}"], 400);
            }
        }

        fclose($finalStream);

        // Optionally clean up the chunk directory
        Storage::disk('escorts')->deleteDirectory("chunks/{$fileName}");
        $data = [
            'user_id' => $userId,
            'type' => 1,
            'path' => "escorts/{$finalFilePath}",
        ];
        $media = $this->media->store($data);

        return response()->json([
            'status' => 'file_merged',
            'url' => asset("escorts/{$finalFilePath}") // Returns public URL
        ]);
    }
}
