<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Sms\SendSms;
use App\Models\MyLegbox;
use App\Models\PasswordSecurity;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){

        return view('user.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create($data)
    {
        //dd($data);
         $user = User::create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'state_id' => $data['state_id'],
            'password' => Hash::make($data['password']),
            'enabled' => 1,
        ]);
        if(!empty($data['escort_id'])) {
            $index = [];
            $index = [
            'user_id' => $user->id,
            'escort_id' => $data['escort_id'],
            ];
            MyLegbox::create($index);
        }
        PasswordSecurity::create([
            'user_id' => $user->id,
            'password_expiry_days' =>30,
            //'status' =>1,
            'password_updated_at' => Carbon::now(),
        ]);
        

        return $user;
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function register(StoreUserRequest $request)
    {
        
       
        event(new Registered($user = $this->create($request->all())));

        //dd($user);
        if($user) {
            $error = 1;
            $phone = $user->phone;
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $user->member_id = $user->memberId;
            $user->save();
            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
            //$msg = "Never tell anyone this code. Your E4U one time password code is: ".$otp;
            
            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
            return response()->json(compact('error','phone','otp'));
        } else {
            $error = 0;
            return response()->json(compact('error'));
        }
        
        
    }
    public function resendOtp(Request $request)
    {
        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();
        }
       
        
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $phone = $user->phone;
            
            $user->save();
            $msg = "Never tell anyone this code. Your E4U one time password code is: ".$otp;
            
            $error = 1;
            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
           return response()->json(compact('error','phone')); 
        
        
        
    }
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    // public function register(StoreUserRequest $request)
    // {   
       
        
    //     event(new Registered($user = $this->create($request->all())));

    //     $this->guard()->login($user);

    //     if ($response = $this->registered($request, $user)) {
    //         return $response;
    //     }
        
    //     return $request->wantsJson() ? new JsonResponse([], 201) : redirect("/all-escorts-list");
    //     //return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
    // }
}
