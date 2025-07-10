<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscortMyLegboxViewerController extends Controller
{
    public function index()
    {
        $escorts = Auth::user();
        return view('escort.dashboard.my-legbox-viewers');
    }
}
