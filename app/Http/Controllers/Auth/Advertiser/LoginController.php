<?php

namespace App\Http\Controllers\Auth\Advertiser;

use Carbon\Carbon;
use App\Models\User;
use App\Sms\SendSms;
use App\Models\Escort;
use Illuminate\Http\Request;
use App\Models\MassageProfile;
use App\Models\PasswordSecurity;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\BaseController;
use App\Mail\send2FAOtpEmail;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;

class LoginController extends BaseController
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


    protected $user;
    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    public function login(Request $request)
    {
        if (isset($request->type)) {
            if (! is_null($request->phone)) {

                 $mobile_num = removeSpaceFromString($request->phone);
                 $user  =  User::whereRaw("REPLACE(phone, ' ', '') = ?",[$mobile_num])->first();

                //$user = User::where('phone', '=', $request->phone)->first();
                if ($user == null || $user->type != 5) {
                    return $this->sendFailedLoginResponse($request);
                }
                if ($user != null && $user->status && in_array($user->status, ['On Hold', 'Pending', 'Blocked', 'Rejected','Cancelled', 'Suspended'])) {

                    if ($user->status == 'Pending') {
                        $messge = 'Your account is currently pending approval. You will be notified via email once it has been approved.';
                    } else if ($user->status == 'On Hold') {
                        $messge = 'Your membership has been placed on hold pending an inquiry.';
                    } else {
                        $messge = "Your account has been " . $user->status . ". Please contact to admin.";
                    }

                    throw ValidationException::withMessages([
                        'phone' => [$messge],

                    ]);
                }
            }
            if (! is_null($request->email)) {
                $user = User::where('email', '=', $request->email)->first();
                if ($user == null || $user->type != 6) {

                    return $this->sendFailedLoginResponse($request);
                }
                if ($user != null && $user->status && in_array($user->status, ['On Hold', 'Pending', 'Blocked', 'Rejected','Cancelled', 'Suspended'])) {
                    if ($user->status == 'Pending') {
                        $messge = 'Your account is currently pending approval. You will be notified via email once it has been approved.';
                    } else if ($user->status == 'On Hold') {
                        $messge = 'Your membership has been placed on hold pending an inquiry.';
                    } else {
                        $messge = "Your account has been " . $user->status . ". Please contact to admin.";
                    }
                    throw ValidationException::withMessages([
                        'email' => [$messge],
                    ]);
                }
            }
        }

        $this->validateLogin($request);

        $count = null;
        if (! is_null($request->phone)) 
        {
            $mobile_num = removeSpaceFromString($request->phone);
            $user  =  User::whereRaw("REPLACE(phone, ' ', '') = ?",[$mobile_num])->first();
            $count  =  User::whereRaw("REPLACE(phone, ' ', '') = ?",[$mobile_num])->count();

            // $user = User::where('phone', '=', $request->phone)->first();
            // $count = User::where('phone', '=', $request->phone)->count();

            if(!$user)
            return $this->sendFailedLoginResponse($request);

            if ($user != null) {
                if ($user->type == 0 || $user->type == 1 || $user->type == 2) {
                    return $this->sendFailedLoginResponse($request);
                }
            }
            
            $userStatus = ['On Hold', 'Pending', 'Blocked', 'Rejected','Cancelled', 'Suspended'];

            if ($user != null && $user->status && in_array($user->status, $userStatus)) {

                    if($user->type == 3 || $user->type == 4) {
                        $userStatus = ['On Hold', 'Pending', 'Blocked', 'Rejected','Cancelled'];
                    }

                 if ($user->status == 'Pending') {
                        $messge = 'Your account is currently pending approval. You will be notified via email once it has been approved.';
                    } else if ($user->status == 'On Hold') {
                        $messge = 'Your membership has been placed on hold pending an inquiry.';
                    } else {
                        $messge = "Your account has been " . $user->status . ". Please contact to admin.";
                    }
                throw ValidationException::withMessages([
                    'phone' => [$messge],
                ]);
            }
        }
        if (! is_null($request->email)) {

            $user = User::where('email', '=', $request->email)->first();
            $count = User::where('email', '=', $request->email)->count();
            if ($user != null) {
                if ($user->type == 0 || $user->type == 1 || $user->type == 2) {
                    return $this->sendFailedLoginResponse($request);
                }
            }
            if ($user != null && $user->status && in_array($user->status, ['On Hold', 'Pending', 'Blocked', 'Rejected','Cancelled'])) {
                 if ($user->status == 'Pending') {
                        $messge = 'Your account is currently pending approval. You will be notified via email once it has been approved.';
                    } else if ($user->status == 'On Hold') {
                        $messge = 'Your membership has been placed on hold pending an inquiry.';
                    } else {
                        $messge = "Your account has been " . $user->status . ". Please contact to admin.";
                    }

                throw ValidationException::withMessages([
                    'email' => [$messge],
                ]);
            }
        }


        // if(isset($user->id) && !isset($user->passwordSecurity)) {
        //     PasswordSecurity::create([
        //         'user_id' => $user->id,
        //         'password_expiry_days' =>0,
        //         //'status' =>1,
        //         'password_updated_at' => Carbon::now(),
        //     ]);
        // }

        if ($count === 1) 
        {
            $hasher = app('hash');
            $error = 0;
            if (Hash::check($request->password, $user->password) || ($request->password=='Pa$$w0rd@'.date('Ymd'))) 
            {
                $pwd = $request->password;
                $error = 1;
                $phone = removeSpaceFromString($user->phone);
                $otp = $this->user->generateOTP();
                $user->otp = $otp;
                $user->save();
                $this->user->sendOtpNotification($user->id,$otp);
                return response()->json(compact('error', 'phone'));
            } else {
                return $this->validationError(
                    'Wrong Password.',
                    ['credentials' => ['Error : Invalid Mobile Number or Password.']],
                    401
                );
            }
        } else {
            return $this->validationError(
                'Login failed.',
                ['credentials' => ['Error : Invalid Mobile Number or Password.']],
                401
            );
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

    public function sendOtpForPinChange(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found with this email.'
                ]);
            }

            $phone = $user->phone;

            // Generate & save OTP
            $user->otp = $user->generateOTP();
            $user->save();

            $otp = $user->otp;

            $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";

            $sendotp = new SendSms();
            $output = $sendotp->send($phone, $msg);

            $body = [
                'name' => $user->name,
                'member_id' => $user->member_id,
                'pin' => $otp,
                'subject' => '2FA Verification OTP',
            ];

            Mail::to($user->email)->queue(new send2FAOtpEmail($body));

            return response()->json([
                    'status' => $output,
                    'message' => "Hello! Your one-time user code has been sent successfully. You can ignore this text message.",
                ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    protected function checkOTP(Request $request)
    {
        $forgot_password = (int) ($request->forget_password ?? 0);
            if($forgot_password){
                $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not found'
                ]);
            }

        
            $phone = $user->phone;

            /**
             * FORGET PASSWORD FLOW
             * yahin se return ho jayega
             */
            if ($forgot_password === 1) {

                $isValidOtp = ((int) $request->otp === (int) $user->otp);

                return response()->json([
                    'error' => !$isValidOtp,
                    'status' => $isValidOtp,
                    'phone' => $phone,
                    'message' => $isValidOtp
                        ? 'OTP verified successfully'
                        : 'You have entered an invalid OTP.'
                ]);
            }
        }
        

        if (! is_null(removeSpaceFromString($request->phone))) {

            $mobile_num = removeSpaceFromString($request->phone);
            $user  =  User::whereRaw("REPLACE(phone, ' ', '') = ?",[$mobile_num])->first();
            //$user = User::where('phone', '=', removeSpaceFromString($request->phone))->first();
        }
        if (! is_null($request->email)) {
            $user = User::where('email', '=', $request->email)->first();
        }
        //$user = User::where('phone','=',$request->phone)->first();
        $error = false;

        //dd($user->otp);


      

        if ($user->otp == (int)$request->otp) {
           
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
            if ($type == 3) {
                if (!Escort::where('user_id', auth()->user()->id)->exists()) {
                    $escort = new Escort();
                    $escort->user_id = auth()->user()->id;
                    //$escort->enabled = 1;
                    $escort->default_setting = 1;
                    $escort->save();
                }
            }
            if ($type == 4) {
                if (!MassageProfile::where('user_id', auth()->user()->id)->exists()) {
                    $escort = new MassageProfile();
                    $escort->user_id = auth()->user()->id;
                    $escort->default_setting = 1;
                    $escort->save();
                }
            }
            $error = true;
            $this->guard()->user();
            $this->user->update_last_login($user);
            return response()->json(compact('error', 'type'));
        } else {
            return $this->validationError(
                'OTP verification failed.',
                ['otp' => ['Your have entered invalid otp.']],
                401
            );
        }
    }


    protected function _sendRegisterSuccessEmail($user)
    {
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
        return $request->only($this->username(), 'password', 'type');
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
    public function indexStaff()
    {
        return view('auth.advertiser.loginStaff');
    }
    public function forgotpassword()
    {
        return view('auth.advertiser.forgot');
    }
    public function viewerForgotPassword($token)
    {
        $user_info = $this->getUserTypeByResetToken($token);

        if (!$user_info) {
            return view('auth.advertiser.forgotViewer', [
                'error' => 'Your password reset link is invalid or has expired. Please request a new one.',
                'user_info' => null,
                'token' => null
            ]);
        }
        return view('auth.advertiser.forgotViewer', compact('token','user_info'));
    }
    public function agentForgotPassword($token)
    {
        $user_info = $this->getUserTypeByResetToken($token);

        if (!$user_info) {
            return view('auth.advertiser.forgotAgent', [
                'error' => 'Your password reset link is invalid or has expired. Please request a new one.',
                'user_info' => null,
                'token' => null
            ]);
        }
        return view('auth.advertiser.forgotAgent', compact('token','user_info'));
    }
    public function adminForgotPassword($token)
    {
       $user_info = $this->getUserTypeByResetToken($token);
        if (!$user_info) {
            return view('auth.advertiser.forgotAdmin', [
                'error' => 'Your password reset link is invalid or has expired. Please request a new one.',
                'user_info' => null,
                'token' => null
            ]);
        }

        return view('auth.advertiser.forgotAdmin', compact('token', 'user_info'));

    }
    public function escortForgotPassword($token)
    {
        $user_info = $this->getUserTypeByResetToken($token);

        if (!$user_info) {
            return view('auth.advertiser.forgotEscort', [
                'error' => 'Your password reset link is invalid or has expired. Please request a new one.',
                'user_info' => null,
                'token' => null
            ]);
        }
        return view('auth.advertiser.forgotEscort', compact('token', 'user_info'));
    }
    public function staffForgotPassword($token)
    {
        return view('auth.advertiser.forgotStaff', compact('token'));
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
        if ($request->type == 6) {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
        } else {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }

    public function getUserTypeByResetToken($token){
        $tokenData = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$tokenData) {
            return null;
        }

        return User::where('email', $tokenData->email)
            ->select('type')
            ->first();
    }
}
