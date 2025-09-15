<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\MyLegbox;
use App\Models\PasswordSecurity;
use App\Models\MyMassageLegbox;
use App\Models\User;
use App\Sms\SendSms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

   
    protected $redirectTo = 'RouteServiceProvider::HOME';
    protected $user;
    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
    }
    

    public function login(Request $request)
    {
    
        $this->validateLogin($request);
        $path = null;
        $show_id = null;

        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
            if($user == null || $user->type != 0) {
                return $this->sendFailedLoginResponse($request);
            }
            if ($user != null && $user->status && in_array($user->status, ['Suspended', 'Pending', 'Blocked'])) {
            
                throw ValidationException::withMessages([
                    'phone' => ["Your account has been " . $user->status . ". Please contact to admin."],
                ]);
            }
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();

            if($user == null || $user->type != 0) {
                return $this->sendFailedLoginResponse($request);
                }
                if ($user != null && $user->status && in_array($user->status, ['Suspended', 'Pending', 'Blocked'])) {
                
                    throw ValidationException::withMessages([
                        'email' => ["Your account has been " . $user->status . ". Please contact to admin."],
                    ]);
                }
        }

        if($user->type == 0){
            session(['radio_location_filter' => true]);
        }

        $hasher = app('hash');
        $error = 0;
        if (Hash::check($request->password, $user->password)) 
        {
            $error = 1;
            $phone = $user->phone;
            $otp = $this->user->generateOTP();
            $user->otp = $otp;
            $path = $request->path;
            $user->save();


            if(! is_null($request->escort_id)) 
            {

                $show_id = $request->escort_id;
                $escort_id = $request->escort_id;
                $result = MyLegbox::where('escort_id',$request->escort_id)->where('user_id', $user->id)->first();
                if(empty($result)) {
                    $index = [];
                    $index = [
                    'user_id' => $user->id,
                    'escort_id' => $request->escort_id,
                    ];
                    MyLegbox::create($index);
                }
            }
            if(! is_null($request->massage_id)) {
                $show_id = $request->massage_id;
                $massage_id = $request->massage_id;
                //$path = $request->path;
                $result = MyMassageLegbox::where('massage_id',$request->massage_id)->where('user_id', $user->id)->first();
                if(empty($result)) {
                    $index = [];
                    $index = [
                    'user_id' => $user->id,
                    'massage_id' => $request->massage_id,
                    ];
                    MyMassageLegbox::create($index);
                }
            }

            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
            $id = $user->id;
            return response()->json(compact('error','phone','path','show_id'));
        } 
        else {
            return $this->sendFailedLoginResponse($request);
        }



        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // if (method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        // if ($this->attemptLogin($request)) {
        //     if ($request->hasSession()) {
        //         $request->session()->put('auth.password_confirmed_at', time());
        //     }

        //     return $this->sendLoginResponse($request);
        // }

        // // If the login attempt was unsuccessful we will increment the number of attempts
        // // to login and redirect the user back to the login form. Of course, when this
        // // user surpasses their maximum number of attempts they will get locked out.
        // $this->incrementLoginAttempts($request);


    }
    protected function checkOTP(Request $request)
    {
        // echo "viewer";
        // dd($request->all());
        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();
        }
        //$user = User::where('phone','=',$request->phone)->first();
        $error = false;

        //TODO:: remove bypass before deployment
        if(1 || $user->otp == (int)$request->otp) {

            auth()->login($user);
            $user->otp = null;
            $user->save();
            $error = true;
            $this->guard()->user();
            return response()->json(compact('error'));
            //return $this->sendLoginResponse($request);
        } else {

            return $this->sendFailedLoginResponse($request);
        }
        // $req = $request->only($this->username(), 'password','type');
        //$req = $request->only($this->username(), 'password','type');
        // dd($req);

    }
    protected function credentials(Request $request)
    {
        // $req = $request->only($this->username(), 'password','type');
        // dd($req);
       return $request->only($this->username(), 'password','type');
    }
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        // $result = MyLegbox::where('escort_id',$request->escort_id)->where('user_id', auth()->user()->id)->first();
        // if(empty($result)) {
        //     $index = [];
        //     $index = [
        //     'user_id' => auth()->user()->id,
        //     'escort_id' => $request->escort_id,
        //     ];
        //     MyLegbox::create($index);
        // }
        if ($response = $this->authenticated($request, $this->guard()->user())) {

            return $response;
        }

        if($request->wantsJson()){

            return response()->json(['status' => true], 200);
        }

        return redirect()->intended($this->redirectPath());
    }
}
