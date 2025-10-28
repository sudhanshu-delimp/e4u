<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EscortTourScheduleContoller extends Controller
{
    public function index()
    {
        return view('escort.dashboard.tour-schedule');
    }

    public function tourScheduleAjax(Request $request)
    {
        // Logic to handle AJAX request for tour schedule
        // This is a placeholder response
        $data = [
            'status' => 'success',
            'message' => 'Tour schedule data fetched successfully',
            'data' => [
                // Sample data
                ['date' => '2024-07-01', 'location' => 'Sydney', 'details' => 'Tour details here'],
                ['date' => '2024-07-05', 'location' => 'Melbourne', 'details' => 'Tour details here'],
            ],
        ];

        return response()->json($data);
    }   
}
