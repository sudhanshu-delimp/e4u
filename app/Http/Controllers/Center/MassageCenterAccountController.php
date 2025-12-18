<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Sms\SendSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MassageCenterAccountController extends Controller
{
    public function index()
    {
        return view('center.dashboard.bookkeeping');
    }

    public function dataTable()
    {

        list($escort, $count) = $this->escort->paginatedByEscortId(
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
            "data"            => $escort
        );

        return response()->json($data);
    }

    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    public function saveBankDetails(StoreEscortBankDetailRequest $request ,$id = null)
    {
        //dd($request->all());
        $value = $request->all();
        session($value);
        $error = false;
        $user = auth()->user();
        $phone = $user->phone;
        $otp = $this->generateOTP();
        $user->otp = $otp;
        $user->save();
        $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
        $sendotp = new SendSms();
        $output = $sendotp->send($phone,$msg);
        $user_id = $user->id;

        return response()->json(compact('error','phone','otp'));

    }
    public function deleteEscortBank(StoreEscortBankDetailRequest $request , $id)
    {

        $error = false;
        $bank = $this->escortBankDetail->find($id);
        if($bank->state === 1) {
            $error = true;
        } else {
            $this->escortBankDetail->destroy($id);
        }

        return response()->json(compact('error','id'));


    }
    public function checkOTP(StoreEscortBankDetailRequest $request)
    {

        $data = $request->session()->all();
        //dd($data);

        $error = 1;

        //dd($user->otp);

        $user = auth()->user();
        //TODO:: remove bypass before deployment
        if(1 || $user->otp == (int)$request->otp) {

            $user->otp = null;
            $user->save();
            $bank_data = [
                'bank_name' => $request->session()->exists('bank_name') ? $data['bank_name'] : '',
                'bsb' => $data['bsb'],
                'account_name' => $data['account_name'],
                'account_number' => $data['account_number'],
                'state' => $data['state'],
                'user_id' => auth()->user()->id,
            ];


            // dd($bank_data);
            if($request->session()->has('bankId')) {
                // dd("bnak id");
                $id = $data['bankId'];
                $bankId = $this->escortBankDetail->find($id);

                unset($bank_data['bank_name']);
                if($bankId->state == 2 && $bankId->state == $data['state']) {
                    $error = 0;
                    //dd($bank_data);
                    $this->escortBankDetail->store($bank_data, $id);
                }
                else if($bankId->state == 1 && $bankId->state == $data['state']) {
                    $error = 3; // Primary account not updated
                    //dd($bank_data);
                    //$this->escortBankDetail->store($bank_data, $id);
                }
                else if($bankId->state == 2 && $data['state'] == 1) {
                    $error = 0;
                    //dd($bank_data);
                    $this->escortBankDetail->store($bank_data, $id);
                    $this->escortBankDetail->updatebyState(auth()->user()->id, $id);
                } else {
                    $error = 3; // Primary account not updated
                }

                // if($this->escortBankDetail->findByState(auth()->user()->id) != 0 && $data['state'] == 2) {
                //     $error = 3; // Primary account not updated
                // } else {
                //     $error = 0;
                //     //dd($bank_data);
                //     $this->escortBankDetail->store($bank_data, $id);$this->escortBankDetail->updatebyState(auth()->user()->id, $id);
                //     $request->session()->flash('status', 'Task was successful!');
                // }



            } else {
                $id = null;
                if($this->escortBankDetail->findByState(auth()->user()->id) == 0 && $data['state'] == 1){
                    $bankdata = $this->escortBankDetail->store($bank_data, $id);
                    $id = $bankdata->id;
                    $this->escortBankDetail->updatebyState(auth()->user()->id, $id);
                    $error = 0;
                } else if($this->escortBankDetail->findByState(auth()->user()->id) == 0 && $data['state'] == 2) {
                    $error = 2;// please select primary account

                } else if($this->escortBankDetail->findByState(auth()->user()->id) != 0 && $data['state'] == 2) {
                    $error = 0;
                    $id = null;
                    $bankdata = $this->escortBankDetail->store($bank_data, $id);
                } else {
                    $error = 0;
                    $id = null;
                    $bankdata = $this->escortBankDetail->store($bank_data, $id);
                    $bid = $bankdata->id;
                    $this->escortBankDetail->updatebyState(auth()->user()->id, $bid);

                }

                // dd();
                // $bankdata = $this->escortBankDetail->store($bank_data, $id);
                // $error = false;

                // if($data['state'] == 1) {
                //     $id = $bankdata->id;
                //     $this->escortBankDetail->updatebyState(auth()->user()->id, $id);
                // }
            }
            $request->session()->flash('status', 'Task was successful!');
            return response()->json(compact('error','bank_data'));
            //return $this->sendLoginResponse($request);
        } else {

            return $this->sendFailedLoginResponse($request);
        }
        // $req = $request->only($this->username(), 'password','type');
        //$req = $request->only($this->username(), 'password','type');
        // dd($req);
        //return $request->only($this->username(), 'password','type');
    }

    public function update(UpdateEscortRequest $request)
    {

        $data = [];
        $data = [
                'business_name' => $request->business_name,
                'abn' => $request->abn,
                'business_address' => $request->business_address,
                'business_number' => $request->business_number,
                'contact_person' => $request->contact_person,
                'email2' => $request->email2,
                'contact_type' => $request->contact_type,
        ];

        $error = true;
        if($this->user->store($data, auth()->user()->id)) {
            $error = false;
        }
        return response()->json(compact('error'));
    }

    public function BankDataTable() 
    {
        list($escortBankDetail, $count, $primary_account,$primary_bank_acc_id, $bankDetails) = $this->escortBankDetail->paginatedByEscortBankDetail(
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
            "primary_bank_bsb" => $bankDetails['primary_bank_bsb'],
            "primary_bank_ac_no" => $bankDetails['primary_bank_ac_no'],
            "data"            => $escortBankDetail
        );

        return response()->json($data);
    }

    public function updateBankPin(Request $request)
    {
        if (auth()->check()) {

            User::where('id', auth()->user()->id)
                ->update([
                    'user_bank_pin' => $request->user_bank_pin
                    // 'user_bank_pin' => Hash::make($request->user_bank_pin)
                ]);

            $body = [
                'name' => auth()->user()->name,
                'member_id' => auth()->user()->member_id,
                'pin' => $request->user_bank_pin,
                'subject' => 'Change Pin',
            ];

            Mail::to(auth()->user()->email)->queue(new EscortChangeBankPin($body));

            return response()->json([
                'error' => false,
                'message' => 'Your PIN has been changed successfully.'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Failed to update bank PIN.'
        ]);
    }
}
