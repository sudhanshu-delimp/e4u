<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    use AuthenticatesUsers, ThrottlesLogins;

    protected $redirectTo = '/dev/dashboard';

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
        return view('dev.login');
    }
    
    /* override maxAttempts */
    protected function maxAttempts()
    {
        return 3;
    }
}