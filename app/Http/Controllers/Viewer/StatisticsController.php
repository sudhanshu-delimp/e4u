<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {

        $userId = Auth::id();
         $legEscort = MyLegbox::where('user_id', $userId)->count() ?? 0;
         $legMassage  = MyMassageLegbox::where('user_id', $userId)->count() ?? 0;
         $MyLegbox = $legEscort + $legMassage;
       return view('user.dashboard.my-statistics');
    }
}
