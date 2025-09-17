<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscortStatisticsController extends Controller
{
    public function index()
    {
        $myStatistics = [
            'mystatistics_profile_views_today' => 0,
            'mystatistics_media_views_today' => 0,
            'mystatistics_recommendations_this_week' => 0,
            'mystatistics_reviews_posted_this_week' => 0,

            'critical_information_profile_currenlty_posted' => 0,
            'critical_information_upcoming_profile' => 0,
            'critical_information_my_playbox_subscription' => 0,

            'profile_statistics_profile_views_today' => 0,
            'profile_statistics_profile_views_this_week' => 0,
            'profile_statistics_profile_year_to_date' => 0,
            'profile_statistics_playbox_views_today' => 0,
            'profile_statistics_playbox_views_this_week' => 0,
            'profile_statistics_playbox_year_to_date' => 0,

            'media_statistics_media_views_today' => 0,
            'media_statistics_media_views_this_week' => 0,
            'media_statistics_media_year_to_date' => 0,

            'feedback_reviews_today' => 0,
            'feedback_reviews_this_week' => 0,
            'feedback_reviews_year_to_date' => 0,
            'feedback_recommendations_today' => 0,
            'feedback_recommendations_this_week' => 0,
            'feedback_recommendations_year_to_date' => 0,
        ];

        $user = Auth::user();
        if($user != null){
            $today = Carbon::now();
            
            $myStatistics['critical_information_upcoming_profile'] = Escort::where('user_id', $user->id)->where('start_date', '>', $today)
            ->count();

            $myStatistics['critical_information_profile_currenlty_posted'] = Escort::where('user_id', $user->id)->where('enabled',1)->count();

        }

        return view('escort.dashboard.my-statistics', ['myStatistics'=>$myStatistics]);
    }
}
