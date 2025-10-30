<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\EscortStatistics;
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
            # today according to server timezone
            $today     = Carbon::now(config('app.escort_server_timezone'));

            # Last week (start and end of previous week)
            $lastWeekStart = $today->copy()->startOfWeek();
            $lastWeekEnd   = $today->copy()->endOfWeek();

            # Last year (start and end)
            $lastYearStart = $today->copy()->startOfYear();
            $lastYearEnd   = $today->copy()->endOfYear(); 

<<<<<<< Updated upstream
=======
            //dd($lastWeekStart, $lastWeekEnd, $lastYearStart, $lastYearEnd);   

>>>>>>> Stashed changes
            # profile views statistics
            $escortStatistics = EscortStatistics::where('user_id', $user->id)
                ->get();
            
            $myStatistics['critical_information_upcoming_profile'] = Escort::where('user_id', $user->id)->where('utc_end_time', '>', $today->toDateString())
            ->count();

            $myStatistics['critical_information_profile_currenlty_posted'] = Escort::where('profile_name', '!=', null)->where('user_id', $user->id)->where('enabled',1)->count();

            $myStatistics['mystatistics_profile_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('profile_views_count');

            $myStatistics['profile_statistics_profile_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('profile_views_count');

            $myStatistics['profile_statistics_profile_views_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('profile_views_count');
            $myStatistics['mystatistics_recommendations_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('recommendation_count');

            

            $myStatistics['profile_statistics_profile_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('profile_views_count');

            # reviews statistics
            $myStatistics['feedback_reviews_today'] = $escortStatistics->where('date', $today->toDateString())->sum('reviews_count');
            $myStatistics['feedback_reviews_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('reviews_count');
            $myStatistics['feedback_reviews_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('reviews_count');
            $myStatistics['mystatistics_reviews_posted_this_week'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('reviews_count');

            # Media statistics
            $myStatistics['media_statistics_media_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('media_views_count');
            $myStatistics['mystatistics_media_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('media_views_count');
            $myStatistics['media_statistics_media_views_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('media_views_count');
            $myStatistics['media_statistics_media_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('media_views_count');

            # Recommendation statistics - waynes ( reviews + likes from logged in users only)
            $myStatistics['feedback_recommendations_today'] = $escortStatistics->where('date', $today->toDateString())->sum('recommendation_count');
            $myStatistics['feedback_recommendations_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('recommendation_count');
            $myStatistics['feedback_recommendations_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('recommendation_count');

            $myStatistics['mystatistics_profile_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('profile_views_count');

            $myStatistics['profile_statistics_profile_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('profile_views_count');

            $myStatistics['profile_statistics_profile_views_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('profile_views_count');

            $myStatistics['profile_statistics_profile_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('profile_views_count');

            # reviews statistics
            $myStatistics['feedback_reviews_today'] = $escortStatistics->where('date', $today->toDateString())->sum('reviews_count');
            $myStatistics['feedback_reviews_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('reviews_count');
            $myStatistics['feedback_reviews_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('reviews_count');
            $myStatistics['mystatistics_reviews_posted_this_week'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('reviews_count');

            # Media statistics
            $myStatistics['media_statistics_media_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('media_views_count');
            $myStatistics['mystatistics_media_views_today'] = $escortStatistics->where('date', $today->toDateString())->sum('media_views_count');
            $myStatistics['media_statistics_media_views_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('media_views_count');
            $myStatistics['media_statistics_media_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('media_views_count');

            // dd($myStatistics['media_statistics_media_views_today']);

            # Recommendation statistics - waynes ( reviews + likes from logged in users only)
            $myStatistics['feedback_recommendations_today'] = $escortStatistics->where('date', $today->toDateString())->sum('recommendation_count');
            $myStatistics['feedback_recommendations_this_week'] = $escortStatistics->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])->sum('recommendation_count');
            $myStatistics['feedback_recommendations_year_to_date'] = $escortStatistics->whereBetween('date', [$lastYearStart->toDateString(), $lastYearEnd->toDateString()])->sum('recommendation_count');

        }

        return view('escort.dashboard.my-statistics', ['myStatistics'=>$myStatistics]);
    }
}
