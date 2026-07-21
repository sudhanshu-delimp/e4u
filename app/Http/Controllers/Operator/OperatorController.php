<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Operator;
use App\Models\OperatorStaff;
use App\Http\Requests\Operator\UpdateStaffMyAccount;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\Operator\UpdateMyAccountOperator;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreAvatarMediaRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repositories\OperatorBank\OperatorBankDetailInterface;

class OperatorController extends BaseController
{

    protected $current_date_time;
    protected $staffRepo;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;
    protected $user;
    protected $operatorId;
    protected $operatorName;
    protected $operatorBankDetail;

    public function __construct(UserInterface $user, OperatorBankDetailInterface $operatorBankDetail)
    {
        $this->user = $user;
        $this->operatorBankDetail = $operatorBankDetail;
        $this->middleware(function ($request, $next) {

            $this->user = $user = auth()->user();   // works here
            $this->operatorId =  $user->operator->id;
            $this->operatorName = $user->operator->name;
           

            // Now do everything that needs user data
            $securityLevel = isset($user->operator_staff_detail->security_level) ? $user->operator_staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view', 9);
            $editAccess = staffPageAccessPermission($securityLevel, 'edit', 9);
            $addAccess = staffPageAccessPermission($securityLevel, 'add', 9);
            $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar', 9);

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
                // return response()->redirectTo('/operator-dashboard')->with('error', __(accessDeniedMsg()));
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOperator()
    {
        $staff = OperatorStaff::with('operator')->where("id", auth()->user()->id)->first();
        $operator = $staff->operator;
        return view('operator.dashboard.my-account.my-operator', compact('staff', 'operator'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.dashboard.index');
    }


    /**
     * View my account
     * 
     *  @return \Illuminate\Http\Response
     */
    public function editMyaccount()
    {
        $staff = OperatorStaff::with('operator')->where("id", auth()->user()->id)->first();
        $operator = $staff->operator;
        return view('operator.dashboard.my-account.edit-my-account', compact('staff', 'operator'));
    }

    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('operator.dashboard.my-account.change-password', compact('user'));
    }

    /**
     * Update My Account
     *
     * @param  UpdateStaffMyAccount  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStaff(UpdateStaffMyAccount $request)
    {
        $data = [];
        $data = [
            //'name' => $request->name,
            //'gender' => $request->gender,
            'phone' =>  removeSpaceFromString($request->phone),
            //'city_id' =>  $request->location,
            //'gender' =>  $request->gender,
        ];

        $error = true;
       if ($this->user->where('id', auth()->user()->id)->update($data)) {
            $data = $request->all();
            $user = OperatorStaff::where('id', auth()->user()->id)->first();
            $staff = $user->operator_staff_detail;
            $staff->update([
                //'name' => $data['name'] ?? $staff->name,
                'address' => $data['address'] ?? $staff->address,
                'kin_name' => $data['kin_name'] ?? "",
                'kin_relationship' => $data['kin_relationship'] ?? "",
                'kin_mobile' => $data['kin_mobile'] ?? "",
                'kin_email' => $data['kin_email'] ?? "",
                //'location' => $data['location'] ?? $staff->location,
                //'security_level' => $data['security_level'] ?? 3,
                //'position' => $data['security_level'] ?? 3,
                //'commenced_date' => $data['commenced_date'] ?? $staff->commenced_date,
                //'employment_status' => $data['employment_status'] ?? $staff->employment_status,
                //'employment_agreement' => $data['employment_agreement'] ?? $staff->employment_agreement,
                //'building_access_code' => $data['building_access_code'] ?? $staff->building_access_code,
                //'keys_issued' => $data['keys_issued'] ?? $staff->keys_issued,
                //'car_parking' => $data['car_parking'] ?? $staff->car_parking,
            ]);
            $staffSetting = \App\Models\OperatorStaffSetting::firstOrNew(['user_id' => $user->id]);
            $staffSetting->idle_preference_time = $data['idle_preference_time'] ?? null;
            $staffSetting->twofa = $data['twofa'] ?? '2';
            $staffSetting->save();
            $error = false;
        }
        return response()->json(compact('error'));
    }

    /**
     * Update My Account
     *
     * @param  UpdateMyAccountOperator  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMyAccountOperator $request)
    {
        $data = [
            'name' => $request->company_name ?? null,
            'business_name' => $request->business_name ?? null,
            'business_number' => $request->business_number ?? null,
            'abn' => $request->abn ?? null,
            'business_address' => $request->business_address ?? null,
            'business_number' => $request->business_number ?? null,
            'contact_type' => isset($request->contact_type)  ? json_encode($request->contact_type) : null,
        ];

        $error = true;
        if ($this->user->store($data, auth()->user()->id)) {
            $data = $request->all();
            $user = Operator::where('id', $data['user_id'])->first();
            $operatorDetail = $user->operator_detail;
            $point_of_contact = $data['point_of_contact'];
            $operatorDetail->update([
                'point_of_contact' => $data['point_of_contact'] ?? $operatorDetail->point_of_contact,
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
        return response()->redirectTo('/operator-dashboard');
        return view('operator.dashboard.my-account.upload-avatar');
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
            /** @var \App\Models\User $user */
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
    {
        try {
            /** @var \App\Models\User $user */
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
            $defaultImg = asset(config('constants.operator_default_icon'));
            return response()->json(['type' => 0, 'message' => 'Avatar removed successfully', 'img' => $defaultImg]);
        } catch (\Exception $e) {
            \Log::error('Error removing avatar: ' . $e->getMessage());
            return response()->json(['type' => 1, 'message' => 'An error occurred while removing avatar. Please try again.'], 500);
        }
    }

    /**
     * Update password
     * 
     * @param ChangePasswordRequest $request
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $data = $request->all();
        $resposne = $this->user->changeUserPassword($data);

        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }


    public function bankAccount()
    {
        return view('operator.dashboard.my-account.bank-account');
    }

    public function saveBankDetails(Request $request, $id = null)
    {
        if ($request->bankId == "") {
            $data = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'state' => $request->state,
                'user_id' => auth()->user()->id,
                'replace' => $request->replace,
            ];
            $resposne = $this->operatorBankDetail->saveOperatorBankDetails($data);
        } else {
            $data = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'state' => $request->state,
                'user_id' => auth()->user()->id,
                'bankId' => $request->bankId,
                'replace' => $request->replace,
            ];
            $resposne = $this->operatorBankDetail->updateOperatorBankDetails($data);
        }

        if ($resposne['status'])
            return $this->successResponse($resposne['message']);
        else
            return $this->validationError($resposne['message']);
    }

     public function BankDataTable() 
    {
        list($operatorBankDetail, $count, $primary_account,$primary_bank_acc_id) = $this->operatorBankDetail->paginatedByOperatorBankDetail(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            auth()->user()->id,
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "primary_account" => intval($primary_account),
            "primary_bank_acc_id" => intval($primary_bank_acc_id),
            "data"            => $operatorBankDetail
        );

        return response()->json($data);
    }


    public function generateOTP()
    {
        $otp = mt_rand(1000, 9999);
        return $otp;
    }
    public function deleteOperatorBank(Request $request)
    {
        $deleted = $this->operatorBankDetail->deleteOperatorBankDetail($request->id);
        if ($deleted['status']) {
            return $this->successResponse($deleted['message']);
        } else {
            return $this->validationError($deleted['message']);
        }
    }
    public function agentMonthlyreport()
    {
        return view('operator.dashboard.reports.agents-monthly-report');
    }
    public function e4uMonthlyreport()
    {
        return view('operator.dashboard.reports.operator-monthly-report');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
