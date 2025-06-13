<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller as BaseController;
use App\Models\User;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = User::find(2);
        return response()->json($user);
        //return view('dev.dashboard');
    }
}