<?php

namespace App\Http\Controllers\Center;

use Auth;
use File;
use FFMpeg;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Duration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\Service\ServiceInterface;
use App\Http\Requests\Escort\StoreRequestRates;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Http\Requests\Escort\StoreRequestServices;
use App\Repositories\Escort\AvailabilityInterface;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Http\Requests\MassageProfile\UpdateRequestAboutMe;
use App\Repositories\MassageProfile\MassageProfileInterface;

class CenterController extends Controller
{
    protected $escort;
    protected $availability;
    protected $service;
    protected $user;
    protected $massage_profile;

    public function __construct(MassageProfileInterface $massage_profile, UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service)
    {
        $this->escort = $escort;
        $this->massage_profile = $massage_profile;
        $this->availability = $availability;
        $this->service = $service;
        $this->user = $user;
    }


    public function index()
    {

        
        $escorts = $this->escort->all();

        return view('center.dashboard.index', compact('escorts'));
        //return view('center.profile-info.create-profile', compact('escorts'));
    }
    public function escortList()
    {
        $escorts = $this->escort->all();

        return view('center.dashboard.list', compact('escorts'));
    }
    public function dataTable()
    {
        list($escort, $count) = $this->massage_profile->massagePaginated(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $escort
        );

        return response()->json($data);
    }

    public function deleteProfile($id)
    {
        //dd($id);
        $escort = $this->massage_profile->find($id);

        $escort->services()->sync([]);
        $escort->durations()->sync([]);
        $escort->medias()->delete();
        $escort->images()->delete();
        $escort->availability()->delete();
        //$escort->videos()->delete();
        //$escort->messages()->delete();
        $this->massage_profile->destroy($id);
        $error = 1;

        return redirect()->route('center.list');
        //return response()->json(compact('error'));

    }
    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('center.my-account.change-password',compact('user'));
    }
    public function updatePassword(UpdateEscortRequest $request)
    {

        $user = $this->user->find(auth()->user()->id);
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
    public function updatePasswordExpiry(UpdateEscortRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $error = true;

            //'Write here your update password code';
            $user->passwordSecurity->password_expiry_days = $request->password_expiry_days;
            $user->passwordSecurity->password_notification = $request->password_notification;
            $user->passwordSecurity->password_updated_at = Carbon::now();
            $user->passwordSecurity->save();
            // dd( $request->all());
        return response()->json(compact('error'));
    }
    public function uploadAvatar()
    {
        return view('center.my-account.upload-avatar');
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
        //     //dd($user);
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
    public function edit()
    {
        $escort = User::where('id',auth()->user()->id)->first();
        return view('center.my-account.edit-my-account', compact('escort'));
    }
    public function update(UpdateEscortRequest $request)
    {
        //dd($request->all());
        $data = [];
        $data = [
                'name' => $request->name,
                // 'gender' => $request->gender,
                // 'contact_type' => $request->contact_type,
                'phone' => $request->phone,
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

    public function timeConvert($array)
    {
        $time = explode(':',$array);

    }

    ///////////////////


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Escort\UpdateRequestAboutMe  $request
     * @return \Illuminate\Http\Response
     */
    // public function storeAboutMe(UpdateRequestAboutMe $request, $id)
    // {
    //     dd("center controller");
    //     $input = [
    //         'gender'=>$request->gender,
    //         'nationality_id'=>$request->nationality_id,
    //         'statistics'=>$request->statistics,
    //         'height'=>$request->height,
    //         'eyes'=>$request->eyes,
    //         'orientation'=>$request->orientation,
    //         'age'=>$request->age,
    //         'hair_color'=>$request->hair_color,
    //         'skin_tone'=>$request->skin_tone,
    //         'breast'=>$request->breast,
    //         'contact'=>$request->contact,
    //         'ethnicity'=>$request->ethnicity,
    //         'body_type'=>$request->body_type,
    //         'hair_style'=>$request->hair_style,
    //         'weight'=>$request->weight,
    //         'dress_size'=>$request->dress_size,
    //     ];

    //     $error=true;
    //     if($data = $this->escort->store($input, $id)) {
    //         $error = false;
    //     }
    //     //return redirect()->back()->with('status','Record successfully inserted!..');
    //     return response()->json(compact('data','error'));


    // }


    // public function storeReadMore(UpdateRequestReadMore $request, $id)
    // {
    //     $input = [
    //         'piercing'=>$request->piercing,
    //         'drugs'=>$request->drugs,
    //         'language'=>$request->language,
    //         'travel'=>$request->travel,
    //         'tattoos'=>$request->tattoos,
    //         'smoke'=>$request->smoke,
    //         //'available_to'=>$request->available_to,
    //         'license'=>$request->license,
    //         'play_type'=> $request->play_type,
    //         'payment_type'=>$request->payment_type
    //     ];
    //     $error=true;
    //     if($data = $this->escort->store($input, $id)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }
    // public function storeAbout(UpdateRequestAbout $request, $id)
    // {
    //     $input = [
    //         'about'=>$request->about,
    //     ];
    //     $error=true;
    //     if($data = $this->escort->store($input, $id)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }


    // public function storeServices(StoreRequestServices $request,  $id)
    // {
    //     $escort = $this->escort->find($id);
    //     $arr = [];
    //     foreach($request->service_id as $key =>$value)
    //     {
    //         $arr  += [$value => ["price" => $request->price[$key]]];
    //     }
    //     $error=true;
    //     if($data = $escort->services()->sync($arr)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }
    // public function storeRates(StoreRequestRates $request, $id)
    // {

    //     $escort = $this->escort->find($id);

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
    //     if($data = $escort->durations()->sync($arr)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }

    // public function parseTime($hour,$minutes,$meridian)
    // {
    //     if(($hour && $minutes && $meridian) == null){
    //         return null;
    //     } else {
    //         return Carbon::createFromFormat('g:i A',$hour.":".$minutes." ".$meridian)->toTimeString();
    //     }
    // }

    // public function storeAvailability(StoreAvailabilityRequest $request, $escortId)
    // {

    //     $data = [];
    //     if(!empty($request->mon_hh_from))
    //     {
    //     $data  += [
    //         "monday_from" => $this->parseTime($request->mon_hh_from,$request->mon_mm_from,$request->mon_time_from),
    //         "monday_to" => $this->parseTime($request->mon_hh_to,$request->mon_mm_to,$request->mon_time_to),
    //         "escort_id" => $escortId,
    //             ];

    //     }
    //     if(!empty($request->tue_hh_from))
    //     {
    //         $data  += [
    //             "tuesday_from" => $this->parseTime($request->tue_hh_from,$request->tue_mm_from,$request->tue_time_from),
    //             "tuesday_to" => $this->parseTime($request->tue_hh_to,$request->tue_mm_to,$request->tue_time_to),
    //             "escort_id" => $escortId,
    //                 ];
    //     }
    //     if(!empty($request->wed_hh_from))
    //     {
    //         $data  += [
    //             "wednesday_from" =>$this->parseTime($request->wed_hh_from,$request->wed_mm_from,$request->wed_time_from),
    //             "wednesday_to" => $this->parseTime($request->wed_hh_to,$request->wed_mm_to,$request->mon_time_to),
    //             "escort_id" => $escortId,
    //                 ];
    //     }
    //     if(!empty($request->thu_hh_from))
    //     {
    //         $data  += [
    //             "thursday_from" => $this->parseTime($request->thu_hh_from,$request->thu_mm_from,$request->thu_time_from),
    //             "thursday_to" => $this->parseTime($request->thu_hh_to,$request->thu_mm_to,$request->thu_time_to),
    //             "escort_id" => $escortId,
    //                 ];
    //     }
    //     if(!empty($request->fri_hh_from))
    //     {
    //         $data  += [
    //             "friday_from" => $this->parseTime($request->fri_hh_from,$request->fri_mm_from,$request->fri_time_from),
    //             "friday_to" => $this->parseTime($request->fri_hh_to,$request->fri_mm_to,$request->fri_time_to),
    //             "escort_id" => $escortId,
    //                 ];
    //     }
    //     if(!empty($request->sat_hh_from))
    //     {
    //         $data  += [
    //             "saturday_from" => $this->parseTime($request->sat_hh_from,$request->sat_mm_from,$request->sat_time_from),
    //             "saturday_to" => $this->parseTime($request->sat_hh_to,$request->sat_mm_to,$request->sat_time_to),
    //             "escort_id" => $escortId,
    //                 ];
    //     }
    //     if(!empty($request->sun_hh_from))
    //     {
    //         $data  += [
    //             "sunday_from" =>$this->parseTime($request->sun_hh_from,$request->sun_mm_from,$request->sun_time_from),
    //             "sunday_to" => $this->parseTime($request->sun_hh_to,$request->sun_mm_to,$request->sun_time_to),
    //             "escort_id" => $escortId,
    //                 ];
    //     }
    //     //dd($arr);
    //     $escort = $this->escort->find($escortId);
    //     $availability = $escort->availability;
    //     $error=true;
    //     if($data = $this->availability->store($data,$availability ? $availability->id : null)) {
    //         $error = false;
    //     }
    //     return response()->json(compact('data','error'));
    // }


    ////////////////////
}
