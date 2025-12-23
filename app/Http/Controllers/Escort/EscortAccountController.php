<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserInterface;
use App\Repositories\EscortBank\EscortBankDetailInterface;
use App\Http\Requests\StoreEscortRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\StoreEscortBankDetailRequest;
use App\Mail\EscortChangeBankPin;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Sms\SendSms;
use App\Models\PasswordSecurity;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EscortAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use AuthenticatesUsers;
    protected $escort;
    protected $user;
    protected $escortBankDetail;

    public function __construct(EscortInterface $escort, UserInterface $user, EscortBankDetailInterface $escortBankDetail)
    {
        $this->escort = $escort;
        $this->user = $user;
        $this->escortBankDetail = $escortBankDetail;

    }

    public function index()
    {

        $escorts = $this->escort->all();

        return view('escort.dashboard.index', compact('escorts'));
    }

    public function escortList()
    {
        $escort = auth()->user()->escort;

        return view('escort.dashboard.list', compact('escort'));
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
     * @param  \App\Http\Requests\StoreEscortRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEscortRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function show(Escort $escort)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('escort.dashboard.my-account', compact('user'));
    }
    public function editPassword()
    {
        $user = $this->user->find(auth()->user()->id);
        return view('escort.dashboard.change-password',compact('user'));
    }
    public function bankDetails()
    {
        $user = $this->user->find(auth()->user()->id);
        // $passwordData = PasswordSecurity::all();
        // $mytime = Carbon::now();
        // $arr = [];

//        dd($user);
        return view('escort.dashboard.bank_account',compact('user'));
    }

    public function sendOtpForPinChange(Request $request ){
       try{
        $user = auth()->user();
        if($user){
            $phone = $user->phone;
            $user->otp = $this->generateOTP();
            $user->save();
            $error = false;
            $user = auth()->user();
            
            $otp = $user->otp;
            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
            $user_id = $user->id;
            return response()->json([
                'status' => $output,
                'message' => "Hello! Your one-time user code has been sent successfully. You can ignore this text message.",
            ]);
        }
       }catch(Exception $e){
         return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEscortRequest  $request
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
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

        // $data = [];
        // $data = [
        //         'bank_name' => $request->bank_name,
        //         'bsb' => $request->bsb,
        //         'account_name' => $request->account_name,
        //         'account_number' => $request->account_number,
        //         'state' => $request->state,
        //         'user_id' => auth()->user()->id,
        //     ];
        // if(isset($request->bankId)) {
        //     $id = $request->bankId;
        //     $error = false;

        //     $otp = $this->generateOTP();
        //     $user->otp = $otp;
        //     $user->save();
        //     $msg = "Never tell anyone this code. Your E4U one time password code is: ".$otp;


        //     $sendotp = new SendSms();
        //     $output = $sendotp->send($phone,$msg);
        //     $user_id = $user->id;

        //     return response()->json(compact('error','phone','id','otp'));
        // } else {
        //     $id = null;
        //     $this->escortBankDetail->store($data, $id);
        //     $error = false;
        // }


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
        $user = auth()->user();
        
        $changeOtp = (isset($request->change_pin_active) && (int)$request->change_pin_active == 1) ? $request->change_pin_active : 0;

        if($user && $changeOtp == 1){

            $phone = $user->phone;
            $status = false;
            $changePin = '0';
            $error =true;
            $otp = $user->otp;

            if(1 || $user->otp == (int)$request->otp) {
                $status = true;
                $otp = $user->otp;
                $error = false;
                $changePin = '1';
            }
            return response()->json(compact('error','phone','otp','status','changePin'));
            // return response()->json([
            //     'status' => $status,
            //     'change_pin_active' => $changePin,
            // ]);
        }

        $error = 1;

        //dd($user->otp);

        
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

    public function updatePassword(UpdateEscortRequest $request)
    {
        //dd($request->password);
        // $data = [
        //         'password' => Hash::make($request->password),
        // ];

        // $error = true;

        // if($this->user->store($data, auth()->user()->id)) {
        //     $error = false;
        // }

        // return response()->json(compact('error'));
        $user = $this->user->find(auth()->user()->id);
        $error = true;
        if(!Hash::check($request->password, $user->password)){
           //'Return error with current passowrd is not match';
           $error = false;
        }else{
            //'Write here your update password code';
            // $user->passwordSecurity->password_expiry_days = $request->password_expiry_days;
            // $user->passwordSecurity->password_notification = $request->password_notification;
            // $user->passwordSecurity->password_updated_at = Carbon::now();
            // $user->passwordSecurity->save();
            // dd( $request->all());
            $data = [
                'password' => Hash::make($request->new_password),
            ];
            $this->user->store($data, auth()->user()->id);




        }

        return response()->json(compact('error'));
    }
    public function updatePasswordExpiry(UpdateEscortRequest $request)
    {
        $user = $this->user->find(auth()->user()->id);
        $error = true;

            //'Write here your update password code';
            $user->passwordSecurity->password_expiry_days = $request->password_expiry_days;
            $user->passwordSecurity->password_notification = $request->password_notification;
            $user->passwordSecurity->password_updated_at = Carbon::now();
            $user->passwordSecurity->save();
            // dd( $request->all());
        return response()->json(compact('error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Escort  $escort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escort $escort)
    {
        //
    }

    public function escortsPlayMates($escort_id)
    {
        $escort = $this->escort->find($escort_id);

        return view('escort.dashboard.fragments.playmate-list', compact('escort'));
    }

    public function findPlaymates()
    {
        $escort_id = request()->get('escort_id');

        $str = request()->get('query');

        $playmates = $this->escort->escortsForPlaymates($escort_id, $str);

        return response()->json($playmates);
    }

    public function addPlaymate()
    {
        $escort = $this->escort->find(request()->get('escort_id'));

        $escort->playmates()->attach(request()->get('playmate_id'));

        return view('escort.dashboard.fragments.playmate-list', compact('escort'));
    }

    public function removePlaymate()
    {
        $escort = $this->escort->find(request()->get('escort_id'));

        $escort->playmates()->detach(request()->get('playmate_id'));

        $template = view('escort.dashboard.fragments.playmate-list', compact('escort'))->render();

        $message = 'Playmate removed successfully';

        return response()->json(compact('template', 'message'));
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
