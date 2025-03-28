<?php

namespace App\Http\Controllers\Auth\Advertiser;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Sms\SendSms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Models\PasswordSecurity;
use Carbon\Carbon;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::MassageDashboard;
    protected $redirectTo = RouteServiceProvider::Dashboard;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
    public function login(Request $request)
    {
        //dd($request->all());
        $this->validateLogin($request);
        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();
        }
       //dd($user);
        $hasher = app('hash');
        $error = 0;
        if (Hash::check($request->password, $user->password)) {
            $error = 1;
            $phone = $user->phone;
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $user->save();
            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
            
        
            $sendotp = new SendSms();
            $output = $sendotp->send($phone,$msg);
            $id = $user->id;
            return response()->json(compact('error','phone')); 
            

        } else {
            return $this->sendFailedLoginResponse($request);
            //dd("hellog user");
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
        //dd($request->all());
        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();
        }
        //$user = User::where('phone','=',$request->phone)->first();
        $error = false;

        //dd($user->otp);
        
        
        if($user->otp == (int)$request->otp) {
            
            auth()->login($user);
            $user->otp = null;
            $user->save();
            //dd($user->otp);
            $type = $user->type;
            $error = true;
            $this->guard()->user();
            return response()->json(compact('error','type')); 
            //return $this->sendLoginResponse($request);
        } else {
           
            return $this->sendFailedLoginResponse($request);
        }
        // $req = $request->only($this->username(), 'password','type');
        //$req = $request->only($this->username(), 'password','type');
        // dd($req);
        //return $request->only($this->username(), 'password','type');
    }
    protected function credentials(Request $request)
    {
        // $req = $request->only($this->username(), 'password','type');
        // dd($req);
        return $request->only($this->username(), 'password','type');
    }
    public function index()
    {
        return view('auth.advertiser.login');
    }
    public function indexAgent()
    {
        return view('auth.advertiser.loginAgent');
    }

    public function indexViewer()
    {
        return view('auth.advertiser.loginViewer');
    }
    public function forgotpassword()
    {
        return view('auth.advertiser.forgot');
    }
    public function viewerForgotPassword($token)
    {
        
        return view('auth.advertiser.forgotViewer',compact('token'));
    }
    public function agentForgotPassword($token)
    {
        
        return view('auth.advertiser.forgotAgent',compact('token'));
    }
    public function adminForgotPassword($token)
    {
        
        return view('auth.advertiser.forgotAdmin',compact('token'));
    }
    public function escortForgotPassword($token)
    {
        
        return view('auth.advertiser.forgotEscort',compact('token'));
    }
    

    public function username()
    {
        return 'phone';
    }

    /*
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
     public function logout(Request $request)
     {
        $cart = session()->get('cart');
        //session()->put('cart', $cart);
       //dd($cart);  
        $this->guard()->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        session()->put('cart', $cart);
         if ($response = $this->loggedOut($request)) {
            
             return $response;

         }
         
         return $request->wantsJson()
             ? new JsonResponse([], 204)
             //: redirect('/escort-login')
             : redirect('/');
     }
     protected function validateLogin(Request $request)
     {
         $request->validate([
             $this->username() => 'required|string',
             'password' => 'required|string',
         ]);
     }
     
}
