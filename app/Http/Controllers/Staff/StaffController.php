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
use App\Http\Requests\Staff\AddNewStaff;
use App\Repositories\Staff\StaffInterface;

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
    protected $current_date_time;
    protected $staffRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    
    public function __construct(TourInterface $tour, UserInterface $user, DurationInterface $duration, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service, EscortMediaInterface $media, StaffInterface $staffRepo)
    {
        $this->escort = $escort;
        $this->availability = $availability;
        $this->service = $service;
        $this->duration = $duration;
        $this->user = $user;
        $this->media = $media;
        $this->tour = $tour;
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->staffRepo = $staffRepo;
        $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
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

    /**
     * Upload avtar for logged in user
     */
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

        $user = User::find($id);
        $user->avatar_img = $avatarName;

        $user->save();
        $type = 0;
        return response()->json(compact('type', 'avatarName'));
    }

    /**
     * Remove saved avtar
     */
    public function removeMyAvatar()
    {
        $user = User::find(auth()->user()->id);
        $user->avatar_img = null;
        $user->save();
        $type = 1;
        return response()->json(compact('type'));
    }

    /**
     * Change password
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $resposne = $this->user->changeUserPassword($data);

        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Add staff
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function add_sfaff(AddNewStaff $request)
    {
        $data = $request->all();
        $resposne = $this->staffRepo->addUpdateStaff($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Edit staff
     * 
     * @param integer $id
     */
    public function editStaff($id)
    {
        $staff = User::with('staff_detail')->where("id", $id)->first();
        if ($staff) {
            return view('staff.management.staff.staff-edit', compact('staff'));
        } else {
            return "";
        }
    }

    /**
     * Store staff
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function update_staff(Request $request)
    {
        $data = $request->all();
        $resposne = $this->staffRepo->addUpdateStaff($data);
        if (isset($resposne['status']) && $resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }
    /**
     * View staff
     * 
     * @param integer $id
     */
    public function viewStaff($id)
    {
        $staff = User::with('staff_detail')->where("id", $id)->first();
        if ($staff) {
            return view('staff.management.staff.staff-view', compact('staff'));
        } else {
            return "";
        }
    }
    /**
     * View staff list
     */
    public function staff_list()
    {
        if(!$this->viewAccessEnabled){
            return response()->redirectTo('/staff-dashboard')->with('error', __(accessDeniedMsg()));
        }
        return view('staff.management.staff.staff');
    }

    /**
     * Get all staff list
     */
    public function staff_data_list()
    {
        list($result, $count) = $this->staff_data_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }

    /**
     *  Get all staff list with filter
     * 
     * @param integer $start
     * @param integer $limit
     * @param string $order_key
     * @param string $dir
     */
    public function staff_data_pagination($start, $limit, $order_key, $dir)
    {
        $loggedInUserId = auth()->user()->id;
        $staff = User::with('state', 'staff_detail', 'account_setting', 'LoginStatus')
            ->where('type', config('staff.staff_role_type')) //Type = 6 
            ->where('id', '!=', $loggedInUserId);

        $search = request()->input('search.value');

        if (!empty($search)) {
            $staff->where(function ($query) use ($search) {
                $query->where('member_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('state', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        switch ($order_key) {
            case 1:
                $staff->orderBy('id', $dir);
                break;
            case 2:
                $staff->orderBy('name', $dir);
                break;
            default:
                $staff->orderBy('id', 'DESC')->orderBy('id', 'ASC');
                break;
        }

        $total_staffs = $staff->count();
        $staffs = $staff->offset($start)->limit($limit)->get();
        $i = 1;
        foreach ($staffs as $key => $item) {
            //$item->no_of_client = (isset($item->referrals_count) && $item->referrals_count > 0) ? $item->referrals_count : '0';
            $logAndStatus = $item->LoginStatus;
            $item->last_login = ((isset($item->account_setting) && ($item->account_setting->last_login != NULL)) ? convert_aus_date_time_format($item->account_setting->last_login) : 'NA');
            $item->login_count = (isset($logAndStatus->login_count) && $logAndStatus->login_count > 0) ? $logAndStatus->login_count : 0;
            $item->sfaff_id = $item->id;
            $item->territory = isset($item->state->name) ? $item->state->name : 'NA';
            $item->security_level = isset($item->staff_detail->security_level) ? $item->staff_detail->securityLevel($item->staff_detail->security_level) : 'NA';
            $item->position = isset($item->staff_detail->position) ? $item->staff_detail->position($item->staff_detail->position) : 'NA';
            $suspend_html = "";
            $activate_html = "";
            if ($item->status != 'Suspended')
                $suspend_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-ban"></i> Suspend</a><div class="dropdown-divider"></div>';
            if ($item->status == 'Suspended')
                $activate_html = '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center active-account-btn" href="javascript:void(0)" data-id=' . $item->id . '>   <i class="fa fa-check"></i> Activate</a><div class="dropdown-divider"></div>';

            $dropdown = '<div class="dropdown no-arrow ml-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item view-account-btn view-staff-btn d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id=' . $item->id . '>  
                <i class="fa fa-eye "></i> View Account</a>';

            if ($this->editAccessEnabled) {
                $dropdown .= '<div class="dropdown-divider"></div>' . $activate_html . $suspend_html;
                $dropdown .= '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-staff-btn" href="javascript:void(0)" data-id=' . $item->id . '  data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>';
            }
            $dropdown .= '</div></div>';

            $item->action = $dropdown;
            $i++;
        }
        return [$staffs, $total_staffs];
    }
    /**
     *  Suspent the access of staff dashboard
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function suspend_staff(Request $request)
    {
        if ($request->id && $request->request_type && $request->request_type == 'suspend') {

            $user = User::where('id', $request->id)->first();
            if ($user->status && $user->status == 'Suspended') {
                return $this->successResponse('This Account Already Suspended');
            }

            $user->status = '3';
            $response = $user->save();

            if ($response)
                return $this->successResponse('Account Suspended Successfully');
            else
                return $this->successResponse('Error Occurred while Account Suspending');
        } else {
            return $this->successResponse('Unknown Input Found');
        }
    }

    /**
     * Check email
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function check_staff_email(Request $request)
    {
        $data = $request->all();
        $errors = $this->staffRepo->check_staff_email($data);

        if (!empty($errors))
            return $this->validationError('Email Validation', $errors);
        else
            return $this->successResponse('Email(s) are available');
    }

    /**
     *  Change the staff status
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function approve_staff_account(Request $request)
    {

        $data = $request->all();
        $resposne = $this->staffRepo->change_user_status($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     *  Approve the staff
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function activate_user(Request $request)
    {

        $data = $request->all();
        $resposne = $this->staffRepo->activate_user($data);
        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

    /**
     * Print staff detail
     */
    public function printStaffDetails(Request $request)
    {
        $userId  = $request->user_id;
        $staff = User::with('staff_detail')->where("id", $userId)->first();
        if ($staff) {
            return view('staff.management.staff.staff_report', ['staff' => $staff]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Staff ID is required.'], 400);
        }
    }
}
