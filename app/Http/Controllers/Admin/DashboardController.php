<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreEscortRequest;
use App\Http\Requests\UpdateEscortRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use FFMpeg;
use File;

class DashboardController extends BaseController
{
    protected $escort;
    protected $user;

    public function __construct(EscortInterface $escort, UserInterface $user)
    {
        $this->escort = $escort;
        $this->user = $user;

    }

    public function index()
    {
        return view('admin.dashboard');
    }
    public function edit()
    {
        $escort = $this->user->find(auth()->user()->id);


        return view('admin.my-account.edit-my-account', compact('escort'));
    }
    public function editPassword()
    {
        $escort = $this->user->find(auth()->user()->id);
        return view('admin.my-account.change-password');
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
        //dd($request->all());
        $data = [];
        $data = [
                'name' => $request->name,
                'gender' => $request->gender,
                //'contact_type' => $request->contact_type,
            //    'phone' => $request->phone,
                //'city_id'=>$request->city_id,
                //'country_id'=>$request->country_id,
                // 'state_id'=>$request->state_id,
                // 'email'=>$request->email ? $request->email : null,
                //'social_links'=>$request->social_links,
        ];

        $error = true;
        if($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(UpdateEscortRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
       //dd($request->all());
        $error = true;
        if(!Hash::check($request->password, $user->password)){
           //'Return error with current passowrd is not match';
           $error = false;
        }else{
            //'Write here your update password code';
            $data = [
                'password' => Hash::make($request->new_password),
            ];
            $this->user->store($data, auth()->user()->id);

        }

        return response()->json(compact('error'));
    }
    public function uploadAvatar()
    {
        return view('admin.my-account.upload-avatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request,$id)
    {
        // $attachment = $request->file('avatar_img');
        // list($width, $height) = getimagesize($attachment);
        // $mime = $attachment->getMimeType();
        // if(strstr($mime, "video/")){
        //     $prefix = 'videos/';
        //     $type = 1;  //0=>image; 1=>video
        // } else {
        //     $prefix = 'images/';
        //     $type = 0;
        //     //$file_path = $prefix.$id.'/'.Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$attachment->getClientOriginalExtension();
        //     $file_path = $attachment->getClientOriginalName();
        //     Storage::disk('avatars')->put($file_path, file_get_contents($attachment));
        //     //dd($attachment->getClientOriginalName());
        //     $user = $this->user->find($id);
        //     $user->avatar_img = $attachment->getClientOriginalName();
        //     $user->save();
        // }
        // return response()->json(compact('type'));

        $extension = explode('/', mime_content_type($request->src))[1];
        $data = $request->src;

        list($type, $data)  = explode(';', $data);
        list(, $data)       = explode(',', $data);
        $data               = base64_decode($data);
        $avatar_owner       = Auth::user()->id;

        $avatarName          = time(). '-' .$avatar_owner .'.'.$extension;
        $avatar_uri          = file_put_contents(public_path() . '/avatars/' . $avatarName, $data);

        //dd($avatar_uri);
        $user = $this->user->find($id);
        $user->avatar_img = $avatarName;

        $user->save();
        $type = 0;
        return response()->json(compact('type','avatarName'));
    }
    public function removeMyAvatar()
    {
            $user = $this->user->find(auth()->user()->id);
            $user->avatar_img = null;
            $user->save();
            $type = 1;
        return response()->json(compact('type'));
    }
}
