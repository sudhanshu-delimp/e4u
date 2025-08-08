<?php

namespace App\Http\Controllers\Auth\Advertiser;

use App\Http\Controllers\AppController;
use App\Models\Escort;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordSecurity;
use App\Sms\SendSms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class LoginController extends AppController
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
        if(isset($request->type)) {

           if(! is_null($request->phone)) {
                $user = User::where('phone','=',$request->phone)->first();
                if($user == null || $user->type != 5) {
                    return $this->sendFailedLoginResponse($request);
                }
            }
            if(! is_null($request->email)) {
                $user = User::where('email','=',$request->email)->first();
                if($user == null || $user->type != 5) {
                    return $this->sendFailedLoginResponse($request);
                }
            }
        }


        $this->validateLogin($request);
        $count = null;
        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
            $count = User::where('phone','=',$request->phone)->count();
            if($user != null ){
                if($user->type == 0 || $user->type == 1 || $user->type == 2) {
                    return $this->sendFailedLoginResponse($request);
                }
            }
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();
            $count = User::where('email','=',$request->email)->count();
            if($user != null ){
                if($user->type == 0 || $user->type == 1 || $user->type == 2 ) {
                    return $this->sendFailedLoginResponse($request);
                }
            }
        }

        //TODO::Enable
        if(isset($user->id) && !isset($user->passwordSecurity)) {
            PasswordSecurity::create([
                'user_id' => $user->id,
                'password_expiry_days' =>0,
                //'status' =>1,
                'password_updated_at' => Carbon::now(),
            ]);
        }
        if($count === 1){


            $hasher = app('hash');
            $error = 0;
            //if (Hash::check($request->password, $user->password)) { //TODO::Enable
            if (1) {
                $pwd = $request->password;
                $error = 1;
                $phone = $user->phone;
                $otp = $this->generateOTP();
                $user->otp = $otp;
                $user->save();
                $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";


                $sendotp = new SendSms();
                $output = $sendotp->send($phone,$msg);
                $id = $user->id;
                //////////////////////////
                // $users = User::all();
                // foreach($users as $user) {
                //     $user->member_id = $user->memberId;
                //     $user->save();
                // }

                //////////////////////////
                return response()->json(compact('error','phone'));


            } else {
                return $this->sendFailedLoginResponse($request);
                //dd("hellog user");
            }
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
        // echo "agent";
        // dd($request->all());
        if(! is_null($request->phone)) {
            $user = User::where('phone','=',$request->phone)->first();
        }
        if(! is_null($request->email)) {
            $user = User::where('email','=',$request->email)->first();
        }
        //$user = User::where('phone','=',$request->phone)->first();
        $error = false;

        //dd($user->otp);

        //TODO::Enable
        //if($user->otp == (int)$request->otp) {
        if(1) {
            // if($user->email_verified_at == NULL && ($user->type == 3 || $user->type == 4)) {
            //     $this->_sendRegisterSuccessEmail($user);
            // }
            auth()->login($user);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->otp = null;
            $user->save();

            //dd($user->otp);
            $type = $user->type;
            //Create default profile here
            if($type == 3) {
                $escort = new Escort();
                $escort->user_id = auth()->user()->id;
                $escort->enabled = 1;
                $escort->default_setting = 1;
                $escort->save();
            }
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


    protected function _sendRegisterSuccessEmail($user) {
        $Name = '';
        $mobileNumber = $user->phone;
        $emailBody = "<p>Dear [Name],<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; We are pleased to confirm your Registration has now been entered into the E4U database and you can now log into the Escort Console and proceed to create Profiles and Tours.</p>
                        <p><strong>Logging in</strong><br />The following information will assist you when logging in:<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Web address: www.e4u.com.au<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Username: [mobileNumber] (Your mobile number)<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Password: (please note passwords are case sensitive)<br />Note: Your logging-in process is also subject to SMS 2FA verification. It is a good idea to bookmark the<br />Website.</p>
                        <p><strong>My Account</strong><br />Now that you have completed your Registration, before you can create any Profiles or<br />Tours, you need to spend a little time setting up your Account information. This will make<br />your experience when creating a Profile or Tour much easier and quicker for you.<br />Simply log in and go to &lsquo;My Account&rsquo; and complete the following important settings:<br />&bull; Edit my Account - &lsquo;About me&rsquo; and &lsquo;Profile and Tour Options&rsquo;<br />&bull; Profile Information - &lsquo;Additional information about me&rsquo;, &lsquo;My rates&rsquo;, &lsquo;My available times&rsquo;,<br />&lsquo;My Service (tags)&rsquo; and &lsquo;My Social Media&rsquo;<br />&bull; Notifications &amp; Features; and<br />&bull; Playmates</p>
                        <p>Once you have completed these important settings, then go to Profiles and Archives<br />section, go to:<br />&bull; View Archives - &lsquo;Media&rsquo;. Upload and select all your Media and default Media.<br />All of these Account settings have help information to assist you. You only have to do this<br />once, but you can change any of the information by either going back to these settings, or<br />by updating them when you create a Profile.</p>
                        <p><strong>Appointing an Agent</strong><br />If you haven&rsquo;t already, you can appoint an Agent at any time. Simply log in and go to &gt;<br />Communication &gt; Request For Assistance, and complete the request form. An Agent can<br />assist you with all matters to do with your Account, Profiles, Tours and Concierge<br />Services. We highly recommend you appoint an Agent.</p>
                        <p><strong>Browsers</strong><br />For the best performance of the Website, we recommend you use the latest version of a<br />modern browser. The Website is best supported by Chrome, Firefox and Edge.</p>
                        <p><strong>How to Contact Us</strong><br />Our goal is to deliver an excellent service and user experience to you. Please don't<br />hesitate to get in touch if you require any assistance, or contact your Agent if you have<br />appointed one. You can reach the E4U Help Desk by logging a 'Support Ticket' from your<br />Dashboard, or by forwarding a message from the &lsquo;Contact Us&rsquo; page located on the Website<br />footer.</p>
                        <p>Welcome to Escorts4U, we hope your experience with us is a pleasant one.</p>
                        <p>Kind regards,<br />E4U Support Team @ Escorts4U</p>";
        $search = ['[Name]', '[mobileNumber]'];
        $replace = [$Name, $mobileNumber];
        $emailBody = str_replace($search, $replace, $emailBody);
//        $emailBody = ['path'=> 'successMail', 'variables' => []];
        $emailData = [
            'subject' => 'Confirmation of your E4U Registration',
            'to' => $user->email
        ];
        $this->_sendEmail($emailBody, $emailData, $useTemplate = 0);
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
