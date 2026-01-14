<?php

namespace App\Repositories\Operator;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Operator;
use App\Models\OperatorSetting;
use App\Models\AccountSetting;
use App\Mail\Operator\OperatorApprovalEmail;
use App\Mail\Operator\OperatorSuspendEmail;
use App\Mail\Operator\OperatorActivateEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Operator\OperatorInterface;

class OperatorRepository extends BaseRepository implements OperatorInterface
{
    protected $operator;
    protected $operator_setting;
    protected $setting;
    public $user_model;
    public $response = [];

    public function __construct(Operator $operator, User $user_model,  AccountSetting $setting, OperatorSetting $operator_setting)
    {
        $this->operator_setting = $operator_setting;
        $this->operator = $operator;
        $this->setting = $setting;
        $this->user_model = $user_model;
        $this->response = ['status' => false, 'message' => ''];
    }

    public function check_operator_email(array $data)
    {
        $errors = [];
        if (isset($data['user_id']) && $data['user_id'] != "") {
            if (!empty($data['email'])) {
                $existsEmail = $this->operator->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

            if (!empty($data['email2'])) {
                $existsEmail2 = $this->operator->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        } else {
            if (!empty($data['email'])) {
                $existsEmail = $this->operator->where('email', $data['email'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }
            if (!empty($data['email2'])) {
                $existsEmail2 = $this->operator->where('email2', $data['email2'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        }
        return $errors;
    }

    public function addUpdateOperator(array $data)
    {
        return  DB::transaction(function () use ($data) {
            try {
                $operatorData  =  [
                    'name' => $data['company_name'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'email' => $data['email'] ?? null,
                    'state_id' => $data['state_id'] ?? null,
                    'business_name' => $data['business_name'] ?? null,
                    'business_number' => $data['business_number'] ?? null,
                    'abn' => $data['abn'] ?? null,
                    'business_address' => $data['business_address'] ?? null,
                    'contact_type' => isset($data['contact_type'])  ? json_encode($data['contact_type']): null,
                ];

                if (isset($data['user_id']) && (!empty($data['user_id']))) {
                    $user = $this->operator->where('id', $data['user_id'])->first();
                    if ($user) {
                        $user->update($operatorData);
                        $message = 'Operator updated successfully.';
                    } else {
                        $this->response = ['status' => false, 'message' => 'Operator not found.'];
                        return $this->response;
                    }
                } else {
                    $operatorData['enabled'] = 1;
                    $operatorData['status'] = 2;
                    $operatorData['type'] = '7';
                    $message = 'New operator added successfully.';
                    $user = User::create($operatorData);
                    if ($user) {
                        $this->setting->create_account_setting($user);
                    }
                }

                /// Update operator detail
                $operator = $user->operator_detail ?? $user->operator_detail()->create(['user_id' => $user->id]);
            
                $operator->update([
                    'date_appointed' => $data['date_appointed'] ?? null,
                    'point_of_contact' => $data['point_of_contact'] ?? null,
                    'agreement_date' => $data['agreement_date'] ?? null,
                    'term' => $data['term'] ?? null,
                    'fee' => $data['fee'] ?? null,
                    'commission_advertising_percent' => $data['commission_advertising_percent'] ?? null,
                    'commission_massage_centre_percent' => $data['commission_massage_centre_percent'] ?? null,
                    
                ]);

                $operatorSetting = \App\Models\OperatorSetting::firstOrNew(['user_id' => $user->id]);
                $operatorSetting->idle_preference_time = $data['idle_preference_time'] ?? null;
                $operatorSetting->twofa = $data['twofa'] ?? '2';
                $operatorSetting->save();

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
        $user = $this->operator->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $password  = random_string($type = 'alnum', $len = 8);
            $user->update(['status' =>  $data['status'], 'password' => Hash::make($password)]);
            $this->sendApprovalEmail($user, $password);
            return $this->response = ['status' => true, 'message' => 'Operator account approved successfully.'];
        } else {
            return $this->response = ['status' => true, 'message' => 'Error occured while approving the user.'];
        }
    }


    public function activate_user(array $data)
    {
        $user = $this->operator->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $user->update(['status' => '1']);
            $this->sendActiveEmail($user);
            return $this->response = ['status' => true, 'message' => 'Operator account activated successfully.'];
        } else {
            return $this->response = ['status' => true, 'message' => 'Error occured while activating the user.'];
        }
    }


    public function sendApprovalEmail($user, $plainPassword)
    {
        try {
            $user['plainPassword'] = $plainPassword;
            //logErrorLocal($user);
            Mail::to($user->email)->send(new OperatorApprovalEmail($user));
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            logErrorLocal($e);
        }
        return true;
    }

    public function sendSuspendEmail($user)
    {
        try {
            Mail::to($user->email)->send(new OperatorSuspendEmail($user));
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            logErrorLocal($e);
        }
        return true;
    }

    public function sendActiveEmail($user)
    {
        try {
            Mail::to($user->email)->send(new OperatorActivateEmail($user));
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            logErrorLocal($e);
        }
        return true;
    }
}
