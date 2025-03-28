<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller as BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('dev.dashboard');
    }
}