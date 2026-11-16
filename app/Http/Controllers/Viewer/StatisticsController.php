<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use App\Models\Notebox;
use App\Models\Punterbox;
use App\Models\ReportEscortProfile;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {

        $userId = Auth::id();
        $statistics = [];
        // $statistics['legEscort'] = MyLegbox::where('user_id', $userId)->count() ?? 0;
        // $statistics['legMassage']  = MyMassageLegbox::where('user_id', $userId)->count() ?? 0;

        // $statistics['MyLegbox'] = ($statistics['legEscort'] + $statistics['legMassage']);

        // $statistics['notBox'] = Notebox::where('user_id', $userId)->count() ?? 0;
        // $statistics['reviewPosted'] = Reviews::where('user_id', $userId)->count() ?? 0;

        // $statistics['report'] = ReportEscortProfile::where('viewer_id', $userId)->where('advertiser_type', 'escort')->count() ?? 0;
        // $statistics['penterBox'] = Punterbox::where('user_id', $userId)->where('status', 'published')->count() ?? 0;


        $statistics['MyLegbox'] = MyLegbox::where('user_id', $userId)->count() ?? 0;
        $statistics['report'] = ReportEscortProfile::where('viewer_id', $userId)->where('advertiser_type', 'escort')->count() ?? 0;
        $statistics['reviewPosted'] = Reviews::where('user_id', $userId)->where('advertiser_type', 'escort')->count() ?? 0;

        $statistics['penterBox'] = Punterbox::where('user_id', $userId)->where('status', 'published')->count() ?? 0;
        $statistics['notBox'] = Notebox::where('user_id', $userId)->count() ?? 0;


       return view('user.dashboard.my-statistics', compact('statistics'));
    }
}
