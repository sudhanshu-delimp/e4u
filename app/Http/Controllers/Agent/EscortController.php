<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Repositories\Agent\AgentEscortInterface;
use App\Repositories\Escort\EscortMediaInterface;
use App\Repositories\Thumbnail\ThumbnailInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreEscortRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\Escort\StoreEscortMediaRequest;
use App\Repositories\Duration\DurationInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Escort\StoreRequest;
use Illuminate\Http\Request;
use App\Repositories\Service\ServiceInterface;
use Carbon\Carbon;
use Auth;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use FFMpeg;
use File;
class EscortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ResizeImage;

    protected $escort;
    protected $user;
    protected $media;
    protected $thumbnail;
    protected $service;
    protected $duration;

    public function __construct(DurationInterface $duration, ServiceInterface $service,EscortMediaInterface $media, AgentEscortInterface $escort, UserInterface $user, ThumbnailInterface $thumbnail)
    {
        $this->escort = $escort;
        $this->user = $user;
        $this->media = $media;
        $this->thumbnail = $thumbnail;
        $this->service = $service;
        $this->duration = $duration;

    }

    public function index()
    {
        $user = auth()->user();
        
        if(!$escort = $user->escorts->where('user_id', $user->id)->where('completed', 1)->first()) {

            $data = [
                'user_id' => $user->id,
                'name' => '',
                'enabled' => 0, 
                'completed' => 1,
            ];

            $escort = $this->escort->store($data);
        }

        $profile = $escort;

        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        $durations = $this->duration->all();
        $availability = $escort->availability;
        $service = $this->service;

        return view('agent.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations'));
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $escorts = $this->user->findEscort();
        
        $usr_type = $this->user->find(auth()->user()->id);
       
        if(!$profile = $this->escort->find($id)) {
            $profile = $this->escort->make();
        }
        return view('agent.dashboard.profile.create-profile', compact('usr_type','escorts','profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEscortRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function userList(Request $request)
    {
        $agent = $this->user->find(auth()->id());
        $str = $request->get('query');
        $query = $agent->agentEscorts();

        if(substr(strtoupper($request->get('query')), 0, 5) == "E4U20") {
            $escorts = $query->get()->filter(function($item) use($str) {
                    return $item->member_id == strtoupper($str);
                });
        } else {
            $escorts = $agent->where('name',  'LIKE', "%{$str}%")
                ->orWhere('users.id',  '=', "{$str}")
                ->orWhere('phone',  'LIKE', "%{$str}%")
                ->get();
        }
        return response()->json($escorts);
    }

    public function nextStep($id)
    {
        $escort = $this->escort->find($id);
        $escort->completed = 2;

        $escort->save();
        return redirect()->route('agent.update.profile', [$escort->id]);
    }

    public function createProfile(StoreRequest $request)
    {
        //dd($request->all());
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
            'user_id' => $request->user_id,
            'completed' => 2,
            'enabled' => 1,
        ];

        $id = request()->get('id');

        $escort = $this->escort->store($input, $id);

        $error = false;

        $url = route('agent.update.profile', [$escort->id]);

        return response()->json(compact('escort','error'), 200);
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
                'deleteUrl' => route('agent.delete.media', $media->id),
                'name' => $attachment->getClientOriginalName(),
                'size' => $attachment->getSize(),
                'thumbnailUrl' => $thumbnail_url ?? url($media->path),
                'type' => $attachment->getMimeType(),
                'url' => url($media->path),
                'play_type' => $media->type,
                'default_url' => route('agent.media.mark.default', $media->id),
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */

    public function edit()
    {
        $escort = $this->user->find(auth()->user()->id);
        return view('escort.update_escort', compact('escort'));
    }

    public function editPassword()
    {
        return view('escort.change_password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEscortRequest  $request
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateEscortRequest $request)
    {
        $data = [];
        $data = [
                'name' => $request->name,
                'gender' => $request->gender,
        ];

        $error = true;
        if($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(UpdateEscortRequest $request)
    {
        $data = [];
        $data = [
                'password' => Hash::make($request->password),
        ];

        $error = true;
        if($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function escortsPlayMates($escort_id)
    {
        
        $escort = $this->escort->find($escort_id);

        return view('agent.dashboard.fragments.playmate-list', compact('escort'));
    }
    public function findPlaymatesId($escort_id)
    {
        $str = request()->get('query');
        $playmates = $this->escort->escortsForPlaymates($escort_id, $str);
        return response()->json($playmates);
    }
    public function findPlaymates()
    {
        $escort_id = request()->get('escort_id');
        $str = request()->get('query');

        $playmates = $this->escort->escortsForPlaymates($escort_id, $str);

        return response()->json($playmates);
    }
    public function addPlaymate()
    {
        
        $escort = $this->escort->find(request()->get('escort_id'));
       
        $escort->playmates()->attach(request()->get('playmate_id'));

        return view('agent.dashboard.fragments.playmate-list', compact('escort'));
    }
    public function removePlaymate()
    {
        $escort = $this->escort->find(request()->get('escort_id'));

        $escort->playmates()->detach(request()->get('playmate_id'));

        $template = view('agent.dashboard.fragments.playmate-list', compact('escort'))->render();

        $message = 'Playmate removed successfully';

        return response()->json(compact('template', 'message'));
    }


}
