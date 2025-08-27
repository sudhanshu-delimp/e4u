<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HowIsItDoneController extends Controller
{
    public function profile()
    {
        return view('escort.dashboard.HowDone.profile');
    }

    public function listing()
    {
        return view('escort.dashboard.HowDone.listing');
    }
}
