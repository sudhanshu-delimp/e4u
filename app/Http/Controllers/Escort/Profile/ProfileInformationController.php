<?php

namespace App\Http\Controllers\Escort\Profile;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Duration;
use App\Models\Playmate;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Escort\AvailabilityInterface;
use App\Repositories\Service\ServiceInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\Escort\UpdateRequestAboutMe;
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
use App\Repositories\Escort\EscortMediaInterface;
use App\Models\EscortCovidReport;
//use Illuminate\Http\Request;

class ProfileInformationController extends Controller
{
    protected $escort;
    protected $availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserInterface $user, EscortInterface $escort, AvailabilityInterface $availability,  ServiceInterface $service, DurationInterface $duration, EscortMediaInterface $media)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
    }

    // public function updateBasicProfile($id)
    // {
    //     $profile = $this->escort->find($id);

    //     return view('escort.dashboard.profile.create-profile', compact('profile'));
    // }

    public function updateProfile($id)
    {
        $escort = $this->escort->find($id);
        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        $durations = $this->duration->all();
        $availability = $escort->availability;
        $service = $this->service;
        return view('escort.dashboard.profile.update',compact('escort','service','availability','service_one','service_two','service_three','durations'));
    }

    public function showAboutMe()
    {

        $user = auth()->user();
        if(!$escort = $this->escort->findDefault($user->id,1)) {
            $escort = $this->escort->make();
        }
        list($service_one, $service_two, $service_three) = $this->service->findByCategory([1,2,3]);
        $durations = $this->duration->all();
        $availability = $escort->availability;
        //$playmates = Playmate::all();
        $users_for_available_playmate = $this->user->findPlaymates(auth()->user()->id);


        /*$userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        $users_for_available_playmate = $this->user->findPlaymates(auth()->user()->id);
        return view('escort.dashboard.Playmates.playmates',compact('users_for_available_playmate','escort'));*/

         /*$userall = $this->user->find(auth()->user()->id);

         foreach($users_for_available_playmate as $allUser) {
             //dd($allUser->escorts);
             if(!empty($allUser->escorts)) {
                 foreach($allUser->escorts as $escort) {
                 echo "<pre>id :-".$escort->id."</br>";

                 }
             }


         }
        dd("hii");
        $allEscorts = $userall->playmates;*/

        return view('escort.dashboard.profile.information.profileInformation',compact('users_for_available_playmate','escort','service_one','service_two','service_three','availability','durations','user'));
    }

    public function escortplaymate(Request $request)
    {
        //dd($request->all());

        $user = $this->user->find(auth()->user()->id);
        $user->available_playmate = $request->available_playmate;
        $user->save();

        return response()->json(compact('user'));

    }
    public function storeAboutMe(UpdateRequestAboutMe $request)
    {
        //dd($request->all());
        $save_user = auth()->user();
        $user = $this->user->find(auth()->user()->id);
        $user->escorts_names = $request->name;
        $user->save();
        $input = [
            //'name'=>$request->name,
            'nationality_id'=>$request->nationality_id,
            'height'=>$request->height,
            'eyes'=>$request->eyes,
            'orientation'=>$request->orientation,
            'age'=>$request->age,
            'hair_color'=>$request->hair_color,
            'skin_tone'=>$request->skin_tone,
            'breast'=>$request->breast,
            'endowment'=>$request->endowment,
            'thickness'=>$request->thickness,
            'circumcised'=>$request->circumcised,
            'butt'=>$request->butt,
            'preference'=>$request->preference,
            'hormones'=>$request->hormones,
            'contact'=>$request->contact,
            'ethnicity'=>$request->ethnicity,
            'body_type'=>$request->body_type,
            'hair_style'=>$request->hair_style,
            'weight'=>$request->weight,
            'dress_size'=>$request->dress_size,
            'user_id' => auth()->user()->id,
            'piercing'=>$request->piercing,
            'drugs'=>$request->drugs,
            'travel'=>$request->travel,
            'tattoos'=>$request->tattoos,
            'smoke'=>$request->smoke,
            'available_to'=>$request->available_to,
            'license'=>$request->license,
            'play_type'=> $request->play_type,
            'payment_type'=>$request->payment_type,
            'shaved'=>$request->shaved ? $request->shaved : NULL,
            'covidreport'=>$request->covidreport ? $request->covidreport : NULL,
            'enabled'=>1,
            'default_setting' => 1
        ];
        $request->language ? $input['language'] = $request->language : $input['language'] ='';
       //dd($input);

        $error=true;
        if($data = $this->escort->updateOrCreate($input, auth()->user()->id,1)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function storeSocialsLink(Request $request)
    {
        //dd($request->social_links);
        $input = [
            'social_links'=>$request->social_links,
            //'default_setting' => 1
        ];


        $error=true;
        //if($data = $this->escort->updateOrCreate($input, auth()->user()->id,1)) {
        if($data = $this->user->store($input, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function storeRates(StoreRateRequest $request)
    {
        $user = auth()->user()->id;
        $escort = $this->escort->findDefault($user,1);
        //dd($escort);
        $arr = [];
        foreach($request->duration_id as $key =>$value)
        {
            $arr  += [$value => [
                "massage_price" => $request->massage_price[$key],
                "incall_price" => $request->incall_price[$key],
                "outcall_price" => $request->outcall_price[$key]],
                ];
        }
        $error=true;
        if($data = $escort->durations()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }



    /***
     * @UpdatedOn: 14-Jul-2023
     * @By:Bikash Chhualsingh
     *
     */
    public function storeAvailability(StoreAvailabilityRequest $request)
    {
        //dd($request->all());
        $user = auth()->user()->id;
        $escort = $this->escort->findDefault($user,1);
        $escortId = $escort->id;
        $data['escort_id'] = $escortId;

        $shortDays = config('escorts.days.short_form');
        foreach ($shortDays as $day => $shortDay) {
            if(!empty($request->{$shortDay."_from"})) {
                $data  += [
                    $day."_from" => date('H:i:s', strtotime($request->{$shortDay."_from"}.$request->{$shortDay."_time_from"})),
                    $day."_to" => date('H:i:s', strtotime($request->{$shortDay."_to"}.$request->{$shortDay."_time_to"}))
                ];
            } else {
                $data  += [
                    $day."_from" => null,
                    $day."_to" => null,
                ];
            }
        }
        if(!empty($request->availability_time))
        {
            $data  += [
                "availability_time" =>$request->availability_time,
            ];
        }
//        dd($data);
        //$escort = $this->escort->find($escortId);
        $availability = $escort->availability;

        $error=true;
        if($data = $this->availability->store($data, $availability ? $availability->id : null)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }

    public function storeServices(StoreServiceRequest $request)
    {
        $user = auth()->user()->id;
        $escort = $this->escort->findDefault($user,1);
        $arr = [];
        //dd($request->service_id);
        if(!empty($request->service_id)) {
            foreach($request->service_id as $key =>$value)
            {
                $arr  += [$value => ["price" => $request->price[$key]]];
            }
        }

        $error=true;
        if($data = $escort->services()->sync($arr)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }

    public function uploadCovidReport($file, $escort_id)
    {
        $file_path = 'escort-covid-report/'.$escort_id.'/'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
        Storage::disk('escorts')->put($file_path, file_get_contents($file));

        $data = [
            'escort_id' => $escort_id,
            'path' => 'escorts/'.$file_path,
        ];

        EscortCovidReport::create($data);

        return true;
    }

    public function storeReadMore(UpdateRequestReadMore $request, $id)
    {
        $input = [
            'piercing'=>$request->piercing,
            'drugs'=>$request->drugs,
            'travel'=>$request->travel,
            'tattoos'=>$request->tattoos,
            'smoke'=>$request->smoke,
            'available_to'=>$request->available_to,
            'license'=>$request->license,
            'play_type'=> $request->play_type,
            'payment_type'=>$request->payment_type
        ];
        $request->language ? $input['language'] = $request->language : '';
        $error=true;
        if($data = $this->escort->store($input, $id)) {
            $error = false;
        }
        return response()->json(compact('data','error'));
    }
    public function storeAbout(UpdateRequestAbout $request ,$id)
    {
        $input = [
            'about'=>$request->about,
        ];


        $error = true;
        if(isset($request->about)) {
            $data = $this->escort->store($input, $id);
            $error = false;
        }
        return response()->json(compact('error'));
    }
    public function createProfile(StoreRequest $request)
    {

        $input = [
            'name'=>$request->name,
            'age'=>$request->age,
            'phone'=>$request->phone,
            'pincode'=>$request->pincode,
            'city_id'=>$request->city_id,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'social_links'=>$request->social_links,
            'user_id' => auth()->user()->getMemberIdAttribute(),
            'enabled' => 1,
        ];

        $error=true;
        if($data = $this->escort->store($input, $id = null)) {
            $error = false;
            $url = route('update.profile', [$data->id]);
        }
        return response()->json(compact('data','error','url'));
    }




    public function parseTime($hour,$minutes,$meridian)
    {
        if(($hour && $minutes && $meridian) == null){
            return null;
        } else {
            return Carbon::createFromFormat('g:i A',$hour.":".$minutes." ".$meridian)->toTimeString();
        }
    }


    public function deleteProfile($id)
    {
        $escort = $this->escort->find($id);

        $escort->services()->sync([]);
        $escort->durations()->sync([]);
        $escort->medias()->delete();
        $escort->images()->delete();
        $escort->videos()->delete();
        $escort->messages()->delete();
        $this->escort->destroy($id);
        $error = 1;


        return response()->json(compact('error'));

    }
    public function saveMembership(Request $request, $id)
    {
        $escort = $this->escort->find($id);
        $data = [];
        $enable = [];
        $data = ['plan_type' =>$request->plan_type];
        $enable = ['enabled' =>1];
        $user = $this->user->store($data, $escort->user_id);
        $escort_update = $this->escort->store($enable, $id);
        $error = 1;


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
    public function savePlaymate($id)
    {
        //dd($id);

        $userId = auth()->user() ? auth()->user()->id : null;
        //dd($userId);
        $index = [
                'user_id' => $userId,
                'playmate_id' => $id,
                ];
                $error = 0;
                if(!empty($userId)) {
                    $result = Playmate::where('playmate_id',$id)->where('user_id', $userId)->first();

                    if(!is_null($result))
                    {
                        $error = 0;
                    } else {

                        $data = Playmate::create($index);
                        //dd($data);
                        $error = 1;
                    }
                }


        return response()->json(compact('error'));
        //return
    }
    public function removePlaymate($id)
    {
        //dd($id);

        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        $index = [
                'user_id' => $userId,
                'playmate_id' => $id,
                ];
                $error = 0;
                if(!is_null($userId)) {
                    $result = Playmate::where('playmate_id',$id)->where('user_id', $userId)->delete();


                }


        return response()->json(compact('error'));
        //return
    }
    /*public function myNewPlaymate()
    {
        //dd($id);
        $user = auth()->user()->id;

        if(!$escort = $this->escort->findDefault($user,1)) {
            $escort = $this->escort->make();
        }
        $userId = auth()->user() ? auth()->user()->id : null; //request()->post('userId');
        $users_for_available_playmate = $this->user->findPlaymates(auth()->user()->id);
        return view('escort.dashboard.Playmates.playmates',compact('users_for_available_playmate','escort'));
        //return
    }*/
}
