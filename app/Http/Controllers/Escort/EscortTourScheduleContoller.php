<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Models\Tour;
use App\Models\TourLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EscortTourScheduleContoller extends Controller
{
    public function index()
    {
        $tourIds =  Tour::where('user_id', auth()->id())->pluck('id')->toArray();
        $tours = TourLocation::whereIn('tour_id', $tourIds)
            ->with('state')
            ->get()
            ->sortBy(function ($tour) {
                $today = Carbon::today()->toDateString();

                if ($tour->start_date <= $today && $tour->end_date >= $today && $tour->status != 'cancelled') {
                    // Current tours
                    return 1;
                } elseif ($tour->start_date > $today && $tour->status != 'cancelled') {
                    // Upcoming tours
                    return 2;
                } elseif($tour->start_date < $today && $tour->status != 'cancelled') {
                    // Completed tours
                    return 3;
                }else{
                    // cancelled tours
                    return 4;
                }
            })
            ->values();
        return view('escort.dashboard.tour-schedule',['tours' => $tours]);
    }

    public function updateTourScheduleStatus(Request $request) 
    {
        $status = TourLocation::where('id', $request->tour_id)
            ->update(['status' => $request->status]);

        return response()->json([
            'status' => $status ? 'success' : 'error', 
            'message' => 'Your Tour has been cancelled and all Profiles associated with the Tour removed from the Website', 
            'data' => $request->status,
            'type' => 'cancel_tour'
        ]);
    }   
    public function getTourSummaryAjax(Request $request) 
    {
        $tour = TourLocation::where('id', $request->tour_id)->with('tour','tour.locations','tour.user','state','profiles','profiles.escort')->first();

        $price = Pricing::where('membership_id', $tour->profiles[0]->escort->membership)->first();

        $diffDays = Carbon::parse($tour->end_date)->diffInDays(Carbon::parse($tour->start_date));

        $tourFee = $price != null ? $price->discount_amount * ($diffDays + 1) : 0.00;

        return response()->json([
            'status' => $tour != null ? 'success' : 'error', 
            'message' => 'Tour summary fetched successfully.', 
            'data' => $tour,
            'fees' => number_format($tourFee, 2),
            'type' => 'tour_summary'
        ]);
    }   
}
