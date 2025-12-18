<?php

namespace App\Http\Controllers\Agent;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;
use Illuminate\Http\Request;
use App\Models\PasswordSecurity;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Repositories\User\UserInterface;
use App\Http\Requests\StoreEscortRequest;
use App\Http\Requests\UpdateEscortRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\Escort\EscortInterface;
use App\Http\Requests\StoreAgentBankDetailRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\AgentBank\AgentBankDetailInterface;


class AgentAccountController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use AuthenticatesUsers;
    protected $escort;
    protected $user;
    protected $agentBankDetail;

    public function __construct(EscortInterface $escort, UserInterface $user, AgentBankDetailInterface $agentBankDetail)
    {
        $this->escort = $escort;
        $this->user = $user;
        $this->agentBankDetail = $agentBankDetail;

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

   
    public function edit()
    {
        $user = User::with('agent_detail')->where('id',auth()->user()->id)->first();
        return view('agent.dashboard.my-account', compact('user'));
    }
    public function editPassword()
    {

        $user = $this->user->find(auth()->user()->id);
        return view('agent.dashboard.change-password',compact('user'));
    }
    public function bankDetails()
    {
        $user = $this->user->find(auth()->user()->id);
        // $passwordData = PasswordSecurity::all();
        // $mytime = Carbon::now();
        // $arr = [];

        //dd($arr);
        return view('agent.dashboard.bank_account',compact('user'));
    }

   

    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }


    // public function saveBankDetails(StoreAgentBankDetailRequest $request ,$id = null)
    // {
    //     $value = $request->all();
    //     session($value);
    //     $error = false;
    //     $user = auth()->user();
    //     $phone = $user->phone;
    //     $otp = $this->generateOTP();
    //     $user->otp = $otp;
    //     $user->save();
    //     $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
    //     $sendotp = new SendSms();
    //     $output = $sendotp->send($phone,$msg);
    //     $user_id = $user->id;

    //     return response()->json(compact('error','phone','otp'));

    //     // $data = [];
    //     // $data = [
    //     //         'bank_name' => $request->bank_name,
    //     //         'bsb' => $request->bsb,
    //     //         'account_name' => $request->account_name,
    //     //         'account_number' => $request->account_number,
    //     //         'state' => $request->state,
    //     //         'user_id' => auth()->user()->id,
    //     //     ];
    //     // if(isset($request->bankId)) {
    //     //     $id = $request->bankId;
    //     //     $error = false;

    //     //     $otp = $this->generateOTP();
    //     //     $user->otp = $otp;
    //     //     $user->save();
    //     //     $msg = "Never tell anyone this code. Your E4U one time password code is: ".$otp;


    //     //     $sendotp = new SendSms();
    //     //     $output = $sendotp->send($phone,$msg);
    //     //     $user_id = $user->id;

    //     //     return response()->json(compact('error','phone','id','otp'));
    //     // } else {
    //     //     $id = null;
    //     //     $this->agentBankDetail->store($data, $id);
    //     //     $error = false;
    //     // }


    // }

   


    public function deleteAgentBank(Request $request)
    {
        $deleted = $this->agentBankDetail->deleteAgentBankDetail($request->id);
        if ($deleted['status']) {
            return $this->successResponse($deleted['message']);
        } else {
            return $this->validationError($deleted['message']);
        }

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
                // 'city_id'=>$request->city_id,
                // 'country_id'=>$request->country_id,
                // 'state_id'=>$request->state_id,
                // business_name ,abn ,business_address ,business_number,contact_person,email2
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
        list($agentBankDetail, $count, $primary_account,$primary_bank_acc_id) = $this->agentBankDetail->paginatedByAgentBankDetail(
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
            "data"            => $agentBankDetail
        );

        return response()->json($data);
    }



    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $resposne = $this->user->changeUserPassword($data);

        if($resposne['status'])
        return $this->successResponse($resposne['message']);
        else
        return $this->validationError($resposne['message']);
    }




    public function saveBankDetails(StoreAgentBankDetailRequest $request ,$id = null)
    {


        if($request->bankId=="")
         {
             $data = [
                'bank_name' => $request->bank_name,
                'bsb' => $request->bsb,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'state' => $request->state,
                'user_id' => auth()->user()->id,
                'replace' => $request->replace,
            ];
            $resposne = $this->agentBankDetail->saveAgentBankDetails($data);
         }
        else
        {
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
           $resposne = $this->agentBankDetail->updateAgentBankDetails($data);
        }
           
        
        if($resposne['status'])
        return $this->successResponse($resposne['message']);
        else
        return $this->validationError($resposne['message']);

    

    }
}
