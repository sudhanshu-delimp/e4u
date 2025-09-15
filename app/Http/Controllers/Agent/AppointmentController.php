<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(){
          return view('agent.dashboard.my-appointments');
    }

    public function getAdverser(){
        //type 4 means onley get Massage center
        $auth = Auth::user();
       
        $user = User::where([
            ['is_agent_assign', '=', '1'],
            ['assigned_agent_id', '=', $auth->id],
        ])->select('id', 'name', 'member_id', 'email', 'is_agent_assign', 'assigned_agent_id')->get();
       
        
        if(!$user || $user->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'No advertisers found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'get all advertisers',
            'data' => $user
        ], 200);
        
    }

    public function getSlotList(Request $request)
    {
        $advertiserId = $request->advertiser_id;
        $date = $request->date; // Format: Y-m-d

        // 1) Fetch already booked slots for that advertiser & date
        $bookedSlots = Appointment::where('advertiser_id', $advertiserId)
            ->whereDate('date', $date)
            ->pluck('time')
            ->map(function($t){ return Carbon::parse($t)->format('H:i'); })
            ->toArray();

        // 2) Generate all slots (8 AM → 8 PM, 30 mins interval)
        $slots = [];
        $start = Carbon::parse($date.' 08:00');
        $end   = Carbon::parse($date.' 20:00');

        while ($start < $end) {
            $slotTime = $start->format('H:i');
            // 3) Check if slot is booked or not
            if (!in_array($slotTime, $bookedSlots)) {
                $slots[] = $slotTime;
            }
            $start->addMinutes(30);
        }

        // 4) Return only remaining slots
        return response()->json([
            'status' => true,
            'message' => 'get all slots',
            'data' => $slots
        ], 200);
       
    }
}
