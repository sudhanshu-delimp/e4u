<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            return error_response('No advertisers found', 404);
        }
        return success_response($user, 'get all advertisers');
        
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
        return success_response($slots, 'get all slots');
       
    }

    public function store(Request $request)
    {
		try {
			$validator = Validator::make($request->all(), [
				'new_advertiser' => 'required|exists:users,id',
				'new_appointment_date' => 'required|date',
				'new_appointment_time_slot' => 'required',
				'new_address' => 'required|string|max:255',
				'new_latitude' => 'nullable|numeric',
				'new_longitude' => 'nullable|numeric',
				'new_source' => 'required|string',
				'new_task_priority' => 'nullable',
			]);

			if ($validator->fails()) {
				return error_response($validator->errors()->first(), 422, $validator->errors());
			}

			$validated = $validator->validated();

			// Prevent duplicate appointment for same advertiser, date and time
			$alreadyExists = Appointment::where('advertiser_id', $validated['new_advertiser'])
				->whereDate('date', $validated['new_appointment_date'])
				->where('time', $validated['new_appointment_time_slot'])
				->exists();
			if ($alreadyExists) {
				return error_response('An appointment already exists for this advertiser at the selected date and time.', 422);
			}

			$appointment = Appointment::create([
				'advertiser_id' => $validated['new_advertiser'],
				'date' => $validated['new_appointment_date'],
				'time' => $validated['new_appointment_time_slot'],
				'address' => $validated['new_address'],
				'lat' => $request->input('new_latitude'),
				'long' => $request->input('new_longitude'),
				'source' => $validated['new_source'],
				'importance' => $validated['new_task_priority'] ?? 'medium',
				'agent_id' => Auth::id(),
				'status' => 'in_progress',
			]);

			return success_response($appointment, 'Appointment created successfully', 200);
		} catch (\Throwable $e) {
			return error_response('Something went wrong while creating the appointment.', 500);
		}
    }
}
