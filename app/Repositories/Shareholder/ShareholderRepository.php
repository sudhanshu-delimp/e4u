<?php

namespace App\Repositories\Supplier;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Shareholder;
use App\Models\ShareholderSetting;
use App\Models\AccountSetting;
use App\Mail\Shareholder\ApprovalEmail;
use App\Mail\Shareholder\SuspendEmail;
use App\Mail\Shareholder\ActivateEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Shareholder\ShareholderInterface;
class ShareholderRepository extends BaseRepository implements ShareholderInterface
{
    protected $supplier;
    protected $supplier_setting;
    protected $setting;
    public $user_model;
    public $response = [];

    public function __construct(Supplier $supplier, User $user_model,  AccountSetting $setting, SupplierSetting $supplier_setting)
    {
        $this->supplier_setting = $supplier_setting;
        $this->supplier = $supplier;
        $this->setting = $setting;
        $this->user_model = $user_model;
        $this->response = ['status' => false, 'message' => ''];
    }

    public function check_email(array $data)
    {
        $errors = [];
        if (isset($data['user_id']) && $data['user_id'] != "") {
            if (!empty($data['email'])) {
                $existsEmail = $this->supplier->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

            if (!empty($data['email2'])) {
                $existsEmail2 = $this->supplier->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        } else {
            if (!empty($data['email'])) {
                $existsEmail = $this->supplier->where('email', $data['email'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }
            if (!empty($data['email2'])) {
                $existsEmail2 = $this->supplier->where('email2', $data['email2'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        }
        return $errors;
    }

    public function addUpdate(array $data)
    {
        return  DB::transaction(function () use ($data) {
            try {
                $contactType = isset($data['contact_type']) ? $data['contact_type'] : "";
                $supplierData  =  [
                    'name' => $data['business_name'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'email' => $data['email'] ?? null,
                    'state_id' => $data['location'] ?? null,
                    'business_name' => $data['business_name'] ?? null,
                    'business_number' => $data['business_number'] ?? null,
                    'abn' => $data['abn'] ?? null,
                    'business_address' => $data['business_address'] ?? null,
                   // 'contact_type' => isset($contactType)  ? json_encode($contactType) : null,
                ];

                if (isset($data['user_id']) && (!empty($data['user_id']))) {
                    $user = $this->supplier->where('id', $data['user_id'])->first();
                    if ($user) {
                        $user->update($supplierData);
                        $message = 'Supplier updated successfully.';
                    } else {
                        $this->response = ['status' => false, 'message' => 'Supplier not found.'];
                        return $this->response;
                    }
                } else {
                    $supplierData['enabled'] = 1;
                    $supplierData['status'] = 2;
                    $supplierData['type'] = '10';
                    $message = 'New supplier added successfully.';
                    $user = Supplier::create($supplierData);
                    if ($user) {
                        $supplier = $this->supplier->where('id', $user->id)->first();
                        //$supplier->update(['contact_type' => $contactType]);
                        $this->setting->create_account_setting($user);
                    }
                }

                /// Update supplier detail
                $agrement_file = "";
                $supplierDetail = $user->supplier_detail ?? $user->supplier_detail()->create(['user_id' => $user->id]);
                /* if (!empty($data['agreement_file'])) {
                   
                    $file = $data['agreement_file'];
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $file_path = 'supplier_files/' . $filename; 
                    $file->storeAs('public/supplier_files', $filename);
                    $supplierDetail->update(['agreement_file' => $file_path]);
                    $agrement_file = $file_path;
                } else {
                    $agrement_file  = $supplierDetail->agreement_file;
                } */

                $supplierDetail->update([
                    'date_appointed' => !empty($data['date_appointed'])
                        ? Carbon::parse($data['date_appointed'])->format('Y-m-d')
                        : null,
                    'agreement_date' => !empty($data['agreement_date'])
                        ? Carbon::parse($data['agreement_date'])->format('Y-m-d')
                        : null,
                    'point_of_contact' => $data['point_of_contact'] ?? null,

                    'term' => $data['term'] ?? null,
                    'fee' => $data['fee'] ?? null,
                    /* 'commission_advertising' => $data['commission_advertising'] ?? 0.00,
                    'commission_advertising_type' => $data['commission_advertising_type'] ?? 'fixed',
                    'commission_massage_centre' => $data['commission_massage_centre'] ?? 0.00,
                    'commission_massage_centre_type' => $data['commission_massage_centre_type'] ?? 'fixed', */
                    'agreement_file' => $agrement_file,

                ]);

                 $supplierBankDetail = $user->supplier_bank_detail ?? $user->supplier_bank_detail()->create(['user_id' => $user->id]);

                 $supplierBankDetail->update([
                    'bank_name' => $data['bank_name'] ?? null,
                    'account_name' => $data['account_name'] ?? null,
                    'bsb' => $data['bsb'] ?? null,
                    'account_number' => $data['account_number'] ?? null,
                ]);

                $supplierSetting = \App\Models\SupplierSetting::firstOrNew(['user_id' => $user->id]);
                $supplierSetting->idle_preference_time = $data['idle_preference_time'] ?? '99999999';
                $supplierSetting->twofa = $data['twofa'] ?? '2';
                $supplierSetting->save();

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
        $user = $this->supplier->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $password  = random_string($type = 'alnum', $len = 8);
            $user->update(['status' =>  $data['status'], 'password' => Hash::make($password)]);
            $this->sendApprovalEmail($user, $password);
            return $this->response = ['status' => true, 'message' => 'Supplier account approved successfully.'];
        } else {
            return $this->response = ['status' => true, 'message' => 'Error occured while approving the user.'];
        }
    }


    public function activate_user(array $data)
    {
        $user = $this->supplier->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $user->update(['status' => '1']);
            $this->sendActiveEmail($user);
            return $this->response = ['status' => true, 'message' => 'Supplier account activated successfully.'];
        } else {
            return $this->response = ['status' => true, 'message' => 'Error occured while activating the user.'];
        }
    }


    public function sendApprovalEmail($user, $plainPassword)
    {
        try {
            $user['plainPassword'] = $plainPassword;
            Mail::to($user->email)->send(new ApprovalEmail($user));
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            logErrorLocal($e);
        }
        return true;
    }

    public function sendSuspendEmail($user)
    {
        try {
            Mail::to($user->email)->send(new SuspendEmail($user));
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            logErrorLocal($e);
        }
        return true;
    }

    public function sendActiveEmail($user)
    {
        try {
            Mail::to($user->email)->send(new ActivateEmail($user));
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            logErrorLocal($e);
        }
        return true;
    }
}
