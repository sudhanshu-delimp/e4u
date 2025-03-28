<?php

namespace App\Http\Controllers\Escort\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
    protected $redirectTo = RouteServiceProvider::Dashboard;
    // protected $redirectTo = RouteServiceProvider::Dashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('escort.login');
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
        dd("hiiii");

         $this->guard()->logout();

         $request->session()->invalidate();

         $request->session()->regenerateToken();

         if ($response = $this->loggedOut($request)) {
             return $response;
         }

         return $request->wantsJson()
             ? new JsonResponse([], 204)
             //: redirect('/escort-login');
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
