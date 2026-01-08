<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Mail\EscortChangeBankPin;
use App\Mail\send2FAOtpEmail;
use App\Mail\sendBookeepingMassageBankPaymentReceipt;
use App\Models\MassageBankDetail;
use App\Models\MassageProfile;
use App\Models\User;
use App\Repositories\MassageBank\MassageBankDetailInterface;
use App\Repositories\MassageCenter\MassageCenterInterface;
use App\Repositories\Message\MessageInterface;
use App\Repositories\User\UserInterface;
use App\Sms\SendSms;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MassageCenterAccountController extends Controller
{
    use AuthenticatesUsers;
    protected $massageCenter;
    protected $user;
    protected $massageBankDetail;

    public function __construct( UserInterface $user, MassageBankDetailInterface $massageBankDetail)
    {
        //$this->massageCenter = $massageCenter;
        $this->user = $user;
        $this->massageBankDetail = $massageBankDetail;

    }

    public function index()
    {
        return view('center.dashboard.bookkeeping');
    }


    public function saveBankDetails(Request $request ,$id = null)
    {
        $value = $request->all();
        session($value);
        $error = false;
        $user = auth()->user();
        $phone = $user->phone;
        $otp = $user->generateOTP();
        $user->otp = $otp;
        $user->save();
        $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
        $sendotp = new SendSms();
        $output = $sendotp->send($phone,$msg);
        $user_id = $user->id;
        $isbankAccountAdded = (string)$request->isbankAccountAdded;

        return response()->json(compact('error','phone','otp','isbankAccountAdded'));

    }
    public function deleteMassageBank(Request $request , $id)
    {
        $error = false;
        $bank = $this->massageBankDetail->find($id);
        if($bank->state === 1) {
            $error = true;
        } else {
            $this->massageBankDetail->destroy($id);
        }

        return response()->json(compact('error','id'));


    }
    public function checkOTP(Request $request)
    {
        $data = $request->session()->all();

        $error = 1;

        $user = auth()->user();
        $isbankAccountAdded = (string)$request->isbankAccountAdded;
          

        $changeOtp = (isset($request->change_pin_active) && (int)$request->change_pin_active == 1) ? $request->change_pin_active : 0;

        $phone = $user->phone;
        $status = false;
        $changePin = '0';
        $error =true;
        $otp = $user->otp;
        $bank_data = [];

        if(($user && $changeOtp == 1) || ($user->otp != (int)$request->otp)) {

            if($user->otp == (int)$request->otp) {
                $status = true;
                $otp = $user->otp;
                $error = false;
                $changePin = '1';
            }
            return response()->json(compact('error','phone','otp','status','changePin'));
        }

        //TODO:: remove bypass before deployment
        if(1 || $user->otp == (int)$request->otp) {
            
            if($user->otp == (int)$request->otp) {
                //$user->otp = null;
                $user->save();
                $changePin = '2';
                $bank_data = [
                    'bank_name' => $request->session()->exists('bank_name') ? $data['bank_name'] : '',
                    'bsb' => $data['bsb'],
                    'account_name' => $data['account_name'],
                    'account_number' => $data['account_number'],
                    'state' => $data['state'],
                    'user_id' => auth()->user()->id,
                ];
            }
           
            if($request->session()->has('bankId')) {
                $id = $data['bankId'];
                $bankId = $this->massageBankDetail->find($id);

                if($bankId->state == 2 && $bankId->state == $data['state']) {
                    $error = 0;
                    $this->massageBankDetail->store($bank_data, $id);
                }
                else if($bankId->state == 1 && $bankId->state == $data['state']) {
                    $error = 3; 
                }
                else if($bankId->state == 2 && $data['state'] == 1) {
                    $error = 0;
                    $this->massageBankDetail->store($bank_data, $id);
                    $this->massageBankDetail->updatebyState(auth()->user()->id, $id);
                } else {
                    $error = 3; // Primary account not updated
                }

            } else {
                $id = null;
                $changePin = '2';
                
                if($this->massageBankDetail->findByState(auth()->user()->id) == 0 && $data['state'] == 1){
                    $bankdata = $this->massageBankDetail->store($bank_data, $id);

                    $id = $bankdata->id;
                    $this->massageBankDetail->updatebyState(auth()->user()->id, $id);
                    $error = 0;
                } else if($this->massageBankDetail->findByState(auth()->user()->id) == 0 && $data['state'] == 2) {
                    $error = 2;// please select primary account

                } else if($this->massageBankDetail->findByState(auth()->user()->id) != 0 && $data['state'] == 2) {
                    $error = 0;
                    $id = null;
                    $bankdata = $this->massageBankDetail->store($bank_data, $id);
                } else {
                    $error = 0;
                    $id = null;
                    //dd($bank_data, $id);
                    $bankdata = $this->massageBankDetail->store($bank_data, $id);
                    //dd($bankdata, $bank_data, $id);
                    $bid = $bankdata->id;
                    $this->massageBankDetail->updatebyState(auth()->user()->id, $bid);

                }

                // dd();
                // $bankdata = $this->massageBankDetail->store($bank_data, $id);
                // $error = false;

                // if($data['state'] == 1) {
                //     $id = $bankdata->id;
                //     $this->massageBankDetail->updatebyState(auth()->user()->id, $id);
                // }
            }
            $request->session()->flash('status', 'Task was successful!');
            return response()->json(compact('error','bank_data','changePin','otp','isbankAccountAdded'));
            //return $this->sendLoginResponse($request);
        } else {
            //return response()->json(compact('error','phone','otp','status','changePin'));
            return $this->sendFailedLoginResponse($request);
        }
        // $req = $request->only($this->username(), 'password','type');
        //$req = $request->only($this->username(), 'password','type');
        // dd($req);
        //return $request->only($this->username(), 'password','type');
    }

    public function update(Request $request)
    {

       // $data = [];
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
        list($massageBankDetail, $count, $primary_account,$primary_bank_acc_id, $bankDetails) = $this->massageBankDetail->paginatedBymassageBankDetail(
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
            "data"            => $massageBankDetail
        );

        return response()->json($data);
    }

    public function updateBankPin(Request $request)
    {
        if (auth()->check()) {

            User::where('id', auth()->user()->id)
                ->update([
                    'user_bank_pin' => $request->user_bank_pin
                ]);

            $body = [
                'name' => auth()->user()->name,
                'member_id' => auth()->user()->member_id,
                'pin' => $request->user_bank_pin,
                'subject' => 'Change Pin',
            ];

            Mail::to(auth()->user()->email)->queue(new EscortChangeBankPin($body));

            $msg = "Your PIN Number has been reset to: " . $request->user_bank_pin . " Do not disclose your PIN to anyone else.";
            $sendotp = new SendSms();
            $output = $sendotp->send(auth()->user()->phone,$msg);

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

    public function getEftBankDetails(Request $request)
    {

        if (auth()->check() && isset($request->bank_id) && !empty($request->bank_id)) {
           
            $massageBank = MassageBankDetail::where('id', (int)$request->bank_id)->first();

            $massageBank->bsb = $massageBank->bsb ? formatAccountNumber($massageBank->bsb,'bsb') : 'NA';

            $massageBank->account_number = $massageBank->account_number ?  formatAccountNumber($massageBank->account_number,null) : "NA";

            return response()->json([
                'error' => false,
                'message' => 'Bank details fetched successfully.',
                'type' => 'eft',
                'eft_bank' => $massageBank,
            ]);
        }
        
        return response()->json([
            'error' => true,
            'message' => 'Failed to fetch bank details.',
            'type' => 'eft',
            'eft_bank' => null,
        ]);
    }

    public function sendPaymentReceiptCenter(Request $request)
    {
        if (auth()->check() && isset($request->bsb) && !empty($request->bsb)) {
            $body = [
                'name' => auth()->user()->name,
                'member_id' => auth()->user()->member_id,
                'bsb' => $request->bsb,
                'account_number' => $request->account_number,
                'subject' => 'Bank Payment Receipt',
            ];

            Mail::to(auth()->user()->email)->queue(new sendBookeepingMassageBankPaymentReceipt($body));

            return response()->json([
                'error' => false,
                'message' => 'Bank payment receipt sent successfully.',
                'type' => 'payment_receipt',
            ]);
        }
        
        return response()->json([
            'error' => true,
            'message' => 'Failed to send bank payment receipt details.',
            'type' => 'payment_receipt'
        ]);
    }

    public function sendOtpForPinChange(Request $request ){
       try{
        $user = auth()->user();
        if($user){
            $phone = $user->phone;
            $user->otp = $user->generateOTP();
            $user->save();
            $error = false;
            $user = auth()->user();
           
            $otp = $user->otp;
            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
            $user_id = $user->id;

            $body = [
                'name' => auth()->user()->name,
                'member_id' => auth()->user()->member_id,
                'pin' => $otp,
                'subject' => '2FA Verification OTP',
            ];

            Mail::to(auth()->user()->email)->queue(new send2FAOtpEmail($body));

            return response()->json([
                'status' => $output,
                'message' => "Hello! Your one-time user code has been sent successfully. You can ignore this text message.",
            ]);
        }
       }catch(\Exception $e){
         return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
       }
    }
}
