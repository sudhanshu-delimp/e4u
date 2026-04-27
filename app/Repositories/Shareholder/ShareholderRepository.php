<?php

namespace App\Repositories\Shareholder;

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
    protected $shareholder;
    protected $shareholder_setting;
    protected $setting;
    public $user_model;
    public $response = [];

    public function __construct(Shareholder $shareholder, User $user_model, AccountSetting $setting, ShareholderSetting $shareholder_setting)
    {
        $this->shareholder_setting = $shareholder_setting;
        $this->shareholder = $shareholder;
        $this->setting = $setting;
        $this->user_model = $user_model;
        $this->response = ['status' => false, 'message' => ''];
    }

    public function check_email(array $data)
    {
        $errors = [];
        if (isset($data['user_id']) && $data['user_id'] != "") {
            if (!empty($data['email'])) {
                $existsEmail = $this->shareholder->where('email', $data['email'])->where('id', '!=', $data['user_id'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }

            if (!empty($data['email2'])) {
                $existsEmail2 = $this->shareholder->where('email2', $data['email2'])->where('id', '!=', $data['user_id'])->exists();

                if ($existsEmail2) {
                    $errors['email2'] = ['This email is already taken.'];
                }
            }
        } else {
            if (!empty($data['email'])) {
                $existsEmail = $this->shareholder->where('email', $data['email'])->exists();
                if ($existsEmail) {
                    $errors['email'] = ['This email is already taken.'];
                }
            }
            if (!empty($data['email2'])) {
                $existsEmail2 = $this->shareholder->where('email2', $data['email2'])->exists();

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
                $shareholderData  =  [
                    'contact_person' => $data['contact_person'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'email' => $data['email'] ?? null,
                    // 'state_id' => $data['location'] ?? null,
                    'business_name' => $data['business_name'] ?? null,
                    // 'abn' => $data['abn'] ?? null,
                    //'business_number' => $data['business_number'] ?? null,
                    'business_address' => $data['business_address'] ?? null,
                    'contact_type' => isset($data['contact_type'])  ? $contactType : null,
                ];

                $contactIds = isset($data['contact_id']) ? $data['contact_id'] : [];
                $persons = isset($data['key_contact_name']) ? $data['key_contact_name'] : [];
                $mobiles = isset($data['key_contact_phone']) ? $data['key_contact_phone'] : [];
                $emails = isset($data['key_contact_email']) ? $data['key_contact_email'] : [];
                 $idsFromForm = [];

                if (isset($data['user_id']) && (!empty($data['user_id']))) {
                    $user = $this->shareholder->where('id', $data['user_id'])->first();
                    if ($user) {
                        $user->update($shareholderData);
                        foreach ($persons as $index => $person) {

                            $contactId = $contactIds[$index] ?? null;
                            $mobile     = $mobiles[$index] ?? null;
                            $email     = $emails[$index] ?? null;
                            // skip empty row
                            if (!$person && !$mobile && !$email) {
                                continue;
                            }

                            if ($contactId) {
                                // UPDATE EXISTING
                                $contact = $user->contacts()->find($contactId);

                                if ($contact) {
                                    $contact->update([
                                        'name'  => $person,
                                        'mobile' => $mobile,
                                        'email' => $email,
                                    ]);

                                    $idsFromForm[] = $contactId;
                                }
                            } else {
                                // CREATE NEW
                                $newContact = $user->contacts()->create([
                                    'name'  => $person,
                                    'mobile' => $mobile,
                                    'email' => $email,
                                ]);

                                $idsFromForm[] = $newContact->id;
                            }
                        }
                        # DELETE REMOVED CONTACTS

                        $user->contacts()
                            ->whereNotIn('id', $idsFromForm)
                            ->delete();

                        $message = 'Shareholder\'s Account updated successfully.';
                    } else {
                        $this->response = ['status' => false, 'message' => 'Shareholder not found.'];
                        return $this->response;
                    }
                } else {
                    $shareholderData['enabled'] = 1;
                    $shareholderData['status'] = 2;
                    $shareholderData['type'] = '8';
                    $message = 'New shareholder\'s account added successfully.';
                    $user = Shareholder::create($shareholderData);
                    if ($user) {
                        $shareholder = $this->shareholder->where('id', $user->id)->first();
                        $shareholder->update(['contact_type' => $contactType]);
                        $this->setting->create_account_setting($user);

                        foreach ($persons as $index => $person) {
                            if ($person || $mobiles[$index] || $emails[$index]) {
                                $shareholder->contacts()->create([
                                    'name'  => $person,
                                    'mobile' => $mobiles[$index] ?? null,
                                    'email' => $emails[$index] ?? null,
                                ]);
                            }
                        }
                    }
                }

                $shareholderSetting = \App\Models\ShareholderSetting::firstOrNew(['user_id' => $user->id]);
                $shareholderSetting->idle_preference_time = $data['idle_preference_time'] ?? '99999999';
                $shareholderSetting->twofa = $data['twofa'] ?? '2';
                $shareholderSetting->save();

                $this->response = ['status' => true, 'message' => $message];
                return $this->response;
            } catch (Exception $e) {

                Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
                $this->response = ['status' => false, 'message' => 'Error occured while making request...'];
                return $this->response;
            }
        });
    }


    public function change_user_status(array $data)
    {
        try {
            $user = $this->shareholder->where('id', $data['user_id'])->firstOrFail();
            if ($user && $data['status'] != "") {
                $password  = random_string($type = 'alnum', $len = 8);
                $user->update(['status' =>  $data['status'], 'password' => Hash::make($password)]);
                $this->sendApprovalEmail($user, $password);
                return $this->response = ['status' => true, 'message' => 'Shareholder\'s account approved successfully.'];
            } else {
                return $this->response = ['status' => true, 'message' => 'Error occured while approving the user.'];
            }
        } catch (Exception $e) {
            Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
            $this->response = ['status' => false, 'message' => 'Error occured while making request...'];
            return $this->response;
        }
    }


    public function activate_user(array $data)
    {
        $user = $this->shareholder->where('id', $data['user_id'])->firstOrFail();
        if ($user && $data['status'] != "") {
            $user->update(['status' => '1']);
            $this->sendActiveEmail($user);
            return $this->response = ['status' => true, 'message' => 'Shareholder\'s account has been activated successfully.'];
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
