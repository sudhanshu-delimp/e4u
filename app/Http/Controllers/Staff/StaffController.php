<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Duration;
use App\Traits\ResizeImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Tour\TourInterface;
use App\Repositories\User\UserInterface;
use App\Http\Requests\Escort\StoreRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\Escort\StoreRateRequest;
use App\Http\Requests\Escort\StoreTourRequest;
use App\Http\Requests\StoreAvatarMediaRequest;
use App\Repositories\Service\ServiceInterface;
use App\Http\Requests\Escort\UpdateRequestAbout;
use App\Repositories\Duration\DurationInterface;
use App\Http\Requests\Escort\StoreServiceRequest;
use App\Http\Requests\Escort\UpdateRequestPolicy;
use App\Repositories\Escort\EscortMediaInterface;
use App\Http\Requests\Escort\UpdateRequestAboutMe;
use App\Repositories\Escort\AvailabilityInterface;
use App\Http\Requests\Escort\UpdateRequestReadMore;
use App\Http\Requests\Escort\StoreAvailabilityRequest;
use App\Http\Requests\Staff\UpdateStaff;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class StaffController extends BaseController
{
    protected $escort;
    protected $agentEscort;
    protected $availability;
    protected $service;
    protected $duration;
    protected $user;
    protected $media;
    protected $tour;

    public function __construct(TourInterface $tour, UserInterface $user, DurationInterface $duration, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service, EscortMediaInterface $media)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->tour = $tour;
    }

    /**
     * Staff Dashboard
     */
    public function index()
    {
        $escorts = $this->escort->all();
        $userEscort = $this->user->all();
        return view('staff.dashboard.dashboard', compact('escorts', 'userEscort'));
    }
    public function edit()
    {
        $staff = $this->user->find(auth()->user()->id);
        return view('staff.my-account.edit-my-account', compact('staff'));
    }
    public function editPassword()
    {
        $escort = $this->user->find(auth()->user()->id);
        return view('staff.my-account.change-password');
    }

    /**
     * Update the staff.
     *
     * @param  \App\Http\Requests\Staff\UpdateStaff  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaff $request)
    {
        $data = [];
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' =>  $request->phone,
            'city_id' =>  $request->location,
            'gender' =>  $request->gender,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $data = $request->all();
            $user = User::where('id', $data['user_id'])->first();
            $staff = $user->staff_detail;
            $staff->update([
                'name' => $data['name'] ?? null,
                'address' => $data['address'] ?? null,
                'kin_name' => $data['kin_name'] ?? null,
                'kin_relationship' => $data['kin_relationship'] ?? null,
                'kin_mobile' => $data['kin_mobile'] ?? null,
                'kin_email' => $data['kin_email'] ?? null,
                'location' => $data['location'] ?? null,
                'commenced_date' => $data['commenced_date'] ?? null,
                'employment_status' => $data['employment_status'] ?? null,
                'employment_agreement' => $data['employment_agreement'] ?? null,
                'building_access_code' => $data['building_access_code'] ?? null,
                'keys_issued' => $data['keys_issued'] ?? null,
                'car_parking' => $data['car_parking'] ?? null,
            ]);
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(Request $request)
    {
         $error = true;
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required|min:8',
        ], [
            'password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.same' => 'New password and confirmation do not match.',
            'password_confirmation.required' => 'Please confirm your new password.',
            'password_confirmation.min' => 'Password confirmation must be at least 8 characters.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["status" => false, "message" => 'Your current password is incorrect.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(["status" => true, "message" => 'Your password has been updated successfully!']);

        
    }



    public function uploadAvatar()
    {
        return view('staff.my-account.upload-avatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request, $id)
    {
        $extension = explode('/', mime_content_type($request->src))[1];
        $data = $request->src;

        list($type, $data)  = explode(';', $data);
        list(, $data)       = explode(',', $data);
        $data               = base64_decode($data);
        $avatar_owner       = Auth::user()->id;

        $avatarName          = time() . '-' . $avatar_owner . '.' . $extension;
        $avatar_uri          = file_put_contents(public_path() . '/avatars/' . $avatarName, $data);

        //dd($avatar_uri);
        $user = User::find($id);
        $user->avatar_img = $avatarName;

        $user->save();
        $type = 0;
        return response()->json(compact('type', 'avatarName'));
    }
    public function removeMyAvatar()
    {
        $user = User::find(auth()->user()->id);
        $user->avatar_img = null;
        $user->save();
        $type = 1;
        return response()->json(compact('type'));
    }

        public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $resposne = $this->user->changeUserPassword($data);

        if($resposne['status'])
        return $this->successResponse($resposne['message']);
        else
        return $this->validationError($resposne['message']);
    }
}
