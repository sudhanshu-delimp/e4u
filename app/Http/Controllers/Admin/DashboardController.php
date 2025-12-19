<?php

namespace App\Http\Controllers\Admin;

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
use App\Http\Requests\Admin\UpdateStaff;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\Admin\AddNewStaff;
use App\Repositories\Admin\AdminInterface;

class DashboardController extends BaseController
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
    
    public function __construct(TourInterface $tour, UserInterface $user, DurationInterface $duration, EscortInterface $escort, AvailabilityInterface $availability, ServiceInterface $service, EscortMediaInterface $media, AdminInterface $staffRepo)
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
        return view('admin.dashboard', compact('escorts', 'userEscort'));
    }
    public function edit()
    {
        $staff = $this->user->find(auth()->user()->id);
        return view('admin.my-account.edit-my-account', compact('staff'));
    }
    public function editPassword()
    {
        $escort = $this->user->find(auth()->user()->id);
        return view('admin.my-account.change-password');
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
            'phone' =>  removeSpaceFromString($request->phone),
            'city_id' =>  $request->location,
            'gender' =>  $request->gender,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $data = $request->all();
            $user = User::where('id', $data['user_id'])->first();
            $staff = $user->staff_detail;
            $staff->update([
                'name' => $data['name'] ?? $staff->name,
                'address' => $data['address'] ?? $staff->address,
                'kin_name' => $data['kin_name'] ?? $staff->kin_name,
                'kin_relationship' => $data['kin_relationship'] ?? $staff->kin_relationship,
                'kin_mobile' => $data['kin_mobile'] ?? $staff->addkin_mobileress,
                'kin_email' => $data['kin_email'] ?? $staff->kin_email,
                'location' => $data['location'] ?? $staff->location,
                'security_level' => $data['security_level'] ?? 3,
                'position' => $data['security_level'] ?? 3,
                'commenced_date' => $data['commenced_date'] ?? $staff->commenced_date,
                'employment_status' => $data['employment_status'] ?? $staff->employment_status,
                'employment_agreement' => $data['employment_agreement'] ?? $staff->employment_agreement,
                'building_access_code' => $data['building_access_code'] ?? $staff->building_access_code,
                'keys_issued' => $data['keys_issued'] ?? $staff->keys_issued,
                'car_parking' => $data['car_parking'] ?? $staff->car_parking,
            ]);
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function updatePassword(Request $request)
    {
        $error = true;
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:new_password_confirmation',
            'new_password_confirmation' => 'required|min:8',
        ], [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.same' => 'New password and confirmation do not match.',
            'new_password_confirmation.required' => 'Please confirm your new password.',
            'new_password_confirmation.min' => 'Password confirmation must be at least 8 characters.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(["status" => false, "message" => 'Your current password is incorrect.']);
        }
        //$user->password = Hash::make($request->new_password);
        //$user->save();
        $data = $request->all();
        $this->user->changeUserPassword($data);
        return response()->json(["status" => true, "message" => 'Your password has been updated successfully!']);
    }

    /**
     * Upload avtar for logged in user
     */
    public function uploadAvatar()
    {
        return view('admin.my-account.upload-avatar');
    }
    public function storeMyAvatar(StoreAvatarMediaRequest $request, $id)
    {
        try {
            if ((int) Auth::id() !== (int) $id) {
                return response()->json(['type' => 1, 'message' => 'Unauthorized'], 403);
            }

            $src = $request->input('src');

            $semicolonPos = strpos($src, ';');
            $mime = substr($src, 5, $semicolonPos - 5); // image/jpeg
            $extension = explode('/', $mime)[1] ?? 'png';
            $extension = strtolower($extension) === 'jpeg' ? 'jpg' : strtolower($extension);

            $commaPos = strpos($src, ',');
            $base64 = substr($src, $commaPos + 1);
            $binary = base64_decode($base64, true);

            $dir = public_path('avatars');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $avatarOwner = Auth::id();
            $avatarName = time() . '-' . $avatarOwner . '.' . $extension;
            $fullPath = $dir . DIRECTORY_SEPARATOR . $avatarName;
            if (File::put($fullPath, $binary) === false) {
                throw new \RuntimeException('Failed to save avatar file');
            }

            $user = $this->user->find($id);
            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }

            if (!empty($user->avatar_img)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $user->avatar_img;
                if (File::exists($oldPath)) {
                    @File::delete($oldPath);
                }
            }

            $user->avatar_img = $avatarName;
            $user->save();

            $type = 0;
            return response()->json(compact('type', 'avatarName'));
        } catch (\Throwable $e) {
            \Log::error('Error saving avatar for user ' . $id . ': ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove saved avtar
     */
    public function removeMyAvatar()
    { try {
            $user = $this->user->find(auth()->user()->id);

            if (!$user) {
                return response()->json(['type' => 1, 'message' => 'User not found'], 404);
            }
            $path =  public_path('/avatars/' . $user->avatar_img);
            if (File::exists($path)) {
                File::delete($path);
                $user->avatar_img = null;
                $user->save();
            } else {
                return response()->json(['type' => 1, 'message' => 'Image not found!']);
            }
            $defaultImg = asset(config('constants.staff_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
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
            return view('admin.management.staff.staff-edit', compact('staff'));
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
            return view('admin.management.staff.staff-view', compact('staff'));
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
            //return response()->redirectTo('/dashboard')->with('error', __(accessDeniedMsg()));
        }
        return view('admin.management.staff.staff');
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
}