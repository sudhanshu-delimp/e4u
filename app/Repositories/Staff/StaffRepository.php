<?php

namespace App\Repositories\Staff;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\AccountSetting;
use App\Events\StaffRegistered;
use App\Mail\StaffApprovalEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Staff\StaffInterface;

class StaffRepository extends BaseRepository implements StaffInterface
{
    protected $staff;
    protected $setting;
    public $user_model;
    public $response = [];

    public function __construct(Staff $staff, User $user_model,  AccountSetting $setting)
    {
        $this->staff = $staff;
        $this->setting = $setting;
        $this->user_model = $user_model;
        $this->response = ['status' => false, 'message' => ''];
    }

    public function check_staff_email(array $data)
    {
        $errors = [];
        if (isset($data['user_id']) && $data['user_id'] != "") {
            if (!empty($data['email'])) {
                $existsEmail = $this->staff->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

            if (!empty($data['email2'])) {
                $existsEmail2 = $this->staff->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        } else {
            if (!empty($data['email'])) {
                $existsEmail = $this->staff->where('email', $data['email'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }
            if (!empty($data['email2'])) {
                $existsEmail2 = $this->staff->where('email2', $data['email2'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        }
        return $errors;
    }

    public function addUpdateStaff(array $data)
    {
        return  DB::transaction(function () use ($data) {
            try {
                $staffData  =  [
                    'name' => $data['name'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'email' => $data['email'] ?? null,
                    //'state_id' => $data['location'] ?? null,
                    'city_id' => $data['location'] ?? null,
                    'gender' => $data['gender'] ?? null,
                ];

                if (isset($data['user_id']) && (!empty($data['user_id']))) {
                    $user = $this->staff->where('id', $data['user_id'])->first();
                    if ($user) {
                        $user->update($staffData);
                        $message = 'Staff updated successfully';
                    } else {
                        $this->response = ['status' => false, 'message' => 'Staff not found'];
                        return $this->response;
                    }
                } else {
                    $staffData['enabled'] = 1;
                    $staffData['status'] = 2;
                    $staffData['type'] = (string) config('staff.staff_role_type');
                    $message = 'New staff added successfully';
                    $user = User::create($staffData);
                    if ($user) {
                        $this->setting->create_account_setting($user);
                    }
                }

                /// Update staff detail
                $staff = $user->staff_detail ?? $user->staff_detail()->create(['user_id' => $user->id]);

                $staff->update([
                    'name' => $data['name'] ?? null,
                    'address' => $data['address'] ?? null,
                    'kin_name' => $data['kin_name'] ?? null,
                    'kin_relationship' => $data['kin_relationship'] ?? null,
                    'kin_mobile' => $data['kin_mobile'] ?? null,
                    'kin_email' => $data['kin_email'] ?? null,
                   
                    'location' => $data['location'] ?? null,
                    'commenced_date' => $data['commenced_date'] ?? null,
                    'security_level' => $data['security_level'] ?? null,
                    //'position' => $data['position'] ?? null,
                     'position' => $data['security_level'] ?? null,
                    'employment_status' => $data['employment_status'] ?? null,
                    'employment_agreement' => $data['employment_agreement'] ?? null,
                    'building_access_code' => $data['building_access_code'] ?? null,
                    'keys_issued' => $data['keys_issued'] ?? null,
                    'car_parking' => $data['car_parking'] ?? null,
                ]);

                $this->response = ['status' => true, 'message' => $message];
                return $this->response;
            } catch (Exception $e) {

                Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
                logErrorLocal($e);
                $this->response = ['status' => false, 'message' => 'Error occured while making request...'];
                return $this->response;
            }
        });
    }


    public function change_user_status(array $data)
    {
        $user = $this->staff->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $password  = random_string($type = 'alnum', $len = 8);
            $user->update(['status' =>  $data['status'], 'password' => Hash::make($password)]);
            $this->sendApprovalEmail($user, $password);
            return $this->response = ['status' => true, 'message' => 'Approved Successfully'];
        } else {
            return $this->response = ['status' => true, 'message' => 'Error occured while approving the user'];
        }
    }


    public function activate_user(array $data)
    {
        $user = $this->staff->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $user->update(['status' => '1']);
            return $this->response = ['status' => true, 'message' => 'Activated Successfully'];
        } else {
            return $this->response = ['status' => true, 'message' => 'Error occured while activating the user'];
        }
    }


    public function sendApprovalEmail($user, $plainPassword)
    {
        $user['plainPassword'] = $plainPassword;

        logErrorLocal($user);
        Mail::to($user->email)->send(new StaffApprovalEmail($user));
    }
}
