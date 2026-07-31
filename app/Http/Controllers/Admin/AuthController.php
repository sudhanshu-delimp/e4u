<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Sms\SendSms;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Mockery\Expectation;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::AdminDashboard;
    protected $redirectTo = RouteServiceProvider::Dashboard;
    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    /**
     * Show the admin's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function showOperatorLoginForm()
    {
        return view('operator.auth.login');
    }

    public function showShareholderLoginForm()
    {
        return view('shareholder.auth.login');
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function generateOTP()
    {
        $otp = mt_rand(1000, 9999);
        return $otp;
    }

    public function login(Request $request)
    {
      
        try {
            //print_r($request->all());die;

            /*  if (! is_null($request->phone)) {
            //$user = User::where('phone','=',$request->phone)->first();
            $user  =  User::whereRaw("REPLACE(phone, ' ', '') = ?", [$request->phone])->first();
            if ($user == null) {
                return $this->sendFailedLoginResponse($request);
            }
        } */
            $wrongConsoleLoginMsg = config('constants.wrong_console_login_msg');
            $loginUrlEndpoint = config('constants.login_url_endpoint');
            $webUrlEndPoint = strtolower($request->segment(1));
            $userType =  $request->input('type', "");
            if (! is_null($request->email)) {
                $user = User::where('email', '=', $request->email)
                    ->where('type', '!=', '7')
                    ->first();

                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid email or password.',
                    ], 401);
                }

                if ($user->type != $userType) {
                    return response()->json([
                        'status' => false,
                        'message' => isset($wrongConsoleLoginMsg[$userType]) ? $wrongConsoleLoginMsg[$userType] : "You are not authorized to login this console."
                    ], 401);
                }
                /* $endPoint = isset($loginUrlEndpoint[$user->type]) ? $loginUrlEndpoint[$user->type] : $webUrlEndPoint;
                if ($webUrlEndPoint != $endPoint) {
                    return response()->json([
                        'status' => false,
                        'message' => isset($wrongConsoleLoginMsg[$userType]) ? $wrongConsoleLoginMsg[$userType] : "You are not authorized to login this console."
                    ], 401);
                } */

                if (!Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid email or password.',
                    ], 401);
                }


                if ($user->status == 'Pending') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Your account is currently pending approval. You will be notified via email once it has been approved.',
                    ], 401);
                } else if ($user->status == 'Suspended') {
                    return response()->json([
                        'status' => false,
                        'message' => "Your account has been suspended until further notice."
                    ], 401);
                } else if ($user->status != 'Active') {
                    return response()->json([
                        'status' => false,
                        'message' => "Your account has been " . strtolower($user->status) . ". Please contact to admin."
                    ], 401);
                }
            }

            if ($user->type == 9) {
                $opStatus = $user->operator->status;
                if ($opStatus != 'Active') {
                    if ($opStatus == 'Pending') {
                        return response()->json([
                            'status' => false,
                            'message' => 'Your operator account is currently pending approval. You operator will be notified via email once it has been approved.',
                        ], 401);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => "Your operator account has been suspended until further notice."
                        ], 401);
                    }
                }
            }

            /**
             * 1 for Admin
             * 8 for shareholder
             * 9 for Operator Staff
             */
            if ($user->type == 1 || $user->type == 8 || $user->type == 9) {
                $hasher = app('hash');
                $error = 0;

                session()->forget(['parent_user_id','is_impersonated','switch_for']);

                $user->current_state_id = $request->current_state_id;

                //            if (Hash::check($request->password, $user->password)) { //TODO::Enable
                if (true) {
                    $error = 1;
                    $phone = removeSpaceFromString($user->phone);
                    $otp = $this->user->generateOTP();
                    $user->otp = $otp;
                    $user->save();

                    // $msg = "Hello! Your one time user code is ".$otp.". If you did not request this, you can ignore this text message.";
                    // $sendotp = new SendSms();
                    // $output = $sendotp->send($phone,$msg);
                    // $id = $user->id;

                    $this->user->sendOtpNotification($user->id, $otp);
                    //TODO:: Don't send otp in the response object so remove from bellow
                    return response()->json(compact('error', 'phone', 'otp'));
                } else {
                    return $this->sendFailedLoginResponse($request);
                    //dd("hellog user");
                }
            } else {
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
        } catch (\Expectation $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    protected function checkOTP(Request $request)
    {
        //dd($request->all());
        if (! is_null($request->phone)) {
            $user = User::where('phone', '=', $request->phone)->first();
        }
        if (! is_null($request->email)) {
            $user = User::where('email', '=', $request->email)->first();
        }
        //$user = User::where('phone','=',$request->phone)->first();
        $error = false;
        if ($user->otp == $request->otp) {

            auth()->login($user);
            $user->otp = null;
            $user->save();
            $error = true;
            $this->guard()->user();
            return response()->json(compact('error'));
            //return $this->sendLoginResponse($request);Staff@123 // Staff@123
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
        return $request->only($this->username(), 'password', 'type');
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $input = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'type' => $request->get('user_type')
        ];
        if (!empty($request->get('type_admin'))) {
            $input['type'] = 1;
        }
        if (!empty($request->get('type_staff'))) {
            $input['type'] = 2;
        }
        //Operator staff
        if (!empty($request->get('type_operator'))) {
            $input['type'] = 9;
        }
        //Shareholder
        if (!empty($request->get('type_shareholder'))) {
            $input['type'] = 8;
        }



        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $cart = session()->get('cart');
        //session()->put('cart', $cart);
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        session()->put('cart', $cart);
        if ($response = $this->loggedOut($request)) {

            return $response;
        }

        // return $request->wantsJson()
        //     ? new JsonResponse([], 204)
        //     : redirect()->route('admin.index');
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('home');
    }

    protected function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
