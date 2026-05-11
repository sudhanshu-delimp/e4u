<?php

namespace App\Repositories\Shareholding;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Shareholding;
use App\Models\Shareholder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;

use App\Repositories\Shareholding\ShareholdingInterface;

class ShareholdingRepository extends BaseRepository implements ShareholdingInterface
{
    protected $shareholder;
    public $user_model;
    public $response = [];

    public function __construct(Shareholding $shareholder, User $user_model)
    {
        $this->shareholder = $shareholder;
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

                $shareholder = (new Shareholder);
                $shareholderData = $shareholder->where('id', $data['shareholder_id'] )->first();
                $trustDeedFile = "";
                if(!$shareholderData) {
                    $this->response = ['status' => false, 'message' => 'Shareholder data no found.'];
                return $this->response;
                }
                $shareholding = $data['shareholding'];
                if( $data['number_of_shares'] == 1) {
                    $shareholding = 100;
                }
                $sharePurchase = ($data['number_of_shares']*$data['shareholding'])/100;
                $sharePurchase = number_format($sharePurchase, 2, '.', '');

                $shareholderData  =  [
                    'user_id' => $shareholderData->id,
                    'member_id' => $shareholderData->member_id ?? null,
                    'date_of_entry' => !empty($data['date_of_entry']) ? Carbon::parse($data['date_of_entry'])->format('Y-m-d') : null,
                    'threshold' => $data['threshold'] ?? null,
                    'number_of_shares' => $data['number_of_shares'] ?? null,
                    'shareholding' => $shareholding ?? null,
                    'share_purchase' => $sharePurchase ?? null,
                    'held_on_trust' => $data['held_on_trust'] ?? null,
                ];

                if (isset($data['shareholding_id']) && (!empty($data['shareholding_id']))) {
                    $shareholding = $this->shareholder->where('id', $data['shareholding_id'])->first();
                    if ($shareholding) {
                        $trustDeedFile = $shareholding->trust_deed_file;
                        $shareholding->update($shareholderData);
                        $message = 'Shareholding updated successfully.';
                    } else {
                        $this->response = ['status' => false, 'message' => 'Shareholding not found.'];
                        return $this->response;
                    }
                } else {
                    $message = 'New shareholding added successfully.';
                    $shareholding = Shareholding::create($shareholderData);
                }
                $shareholdingData = $this->shareholder->where('id', $shareholding->id)->first();
                if ($shareholdingData) {
                    if (!empty($data['trust_deed_file'])) {
                        $file = $data['trust_deed_file'];
                        $filename = time() . '.' . $file->getClientOriginalExtension();
                        $file_path = 'shareholding_files/' . $filename;
                        $file->storeAs('public/shareholding_files', $filename);
                        $shareholdingData->trust_deed_file = $file_path;
                        $shareholdingData->save();
                    } else if($data['held_on_trust'] == 'no' &&  !empty($trustDeedFile)) {
                        $path = storage_path('app/public/');
                        $fullPath = $path.$trustDeedFile;
                        $shareholdingData->trust_deed_file = "";
                        $shareholdingData->save();
                        unlink( $fullPath);
                    }
                }

                $this->response = ['status' => true, 'message' => $message];
                return $this->response;
            } catch (Exception $e) {

                Log::info($e->getMessage() . " Line no.:" . $e->getLine() . " Line no.:" . $e->getFile());
                $this->response = ['status' => false, 'message' => 'Error occured while making request...'.$e->getMessage()];
                return $this->response;
            }
        });
    }
}
