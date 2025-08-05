<?php

namespace App\Http\Controllers\Auth\Advertiser;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Sms\SendSms;
use App\Models\PasswordSecurity;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAdvertiserRegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Repositories\State\StateInterface;
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
    protected $redirectTo = RouteServiceProvider::Dashboard;
    protected $state;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StateInterface $state)
    {
        $this->middleware('guest');
        $this->state = $state;
    }

    public function index()
    {
        $state = $this->state->allByCountryId();

        return view('auth.advertiser.register',compact('state'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

     /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $data
      * @return \Illuminate\Contracts\Validation\Validator
      */

    protected function create($data)
    {

        return User::create([
            // 'phone' => (int) $data['phone'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'state_id' => $data['state_id'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
            'enabled' => 1,
            'viewer_contact_type' => ["2"],
            'tour_permissition_type' => ["1","2"],
            'profile_creator' => ["1","2"]
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(StoreAdvertiserRegisterRequest $request)
    {

        event(new Registered($user = $this->create($request->all())));

        //dd($user);
        if($user) {
            $error = 1;
            $phone = $user->phone;
            $pwd = $user->password;
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $user->member_id = $user->memberId;
            $user->save();

            PasswordSecurity::create([
                'user_id' => $user->id,
                'password_expiry_days' =>30,
                //'status' =>1,
                'password_updated_at' => Carbon::now(),
            ]);

            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";

            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
            return response()->json(compact('error','phone'));
        } else {
            $error = 0;
            return response()->json(compact('error'));
        }


    }
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    // public function register(StoreAdvertiserRegisterRequest $request)
    // {
    //     dd($request->all());

    //     event(new Registered($user = $this->create($request->all())));

    //     $this->guard()->login($user);

    //     if ($response = $this->registered($request, $user)) {
    //         return $response;
    //     }

    //     return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
    // }
}
