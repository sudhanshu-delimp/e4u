<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
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
        $currentId = $request->input('current_id');
        

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
       
        // 4) Ensure current appointment's slot is present if provided
        if (!empty($currentId)) {
            $current = Appointment::find($currentId);
            if ($current && $current->advertiser_id == $advertiserId && Carbon::parse($current->date)->isSameDay(Carbon::parse($date))) {
                $currentTime = Carbon::parse($current->time)->format('H:i');
                if (!in_array($currentTime, $slots)) {
                    $slots[] = $currentTime;
                }
            }
        }
       

        // 5) Sort slots for stable UI
        sort($slots, SORT_STRING);
        
       

        return success_response($slots, 'get all slots');
       
    }

    public function datatable(Request $request)
    {
        $query = Appointment::query()
            ->select(['appointments.*'])
            ->with(['advertiser:id,name,member_id']);

        return DataTables::of($query)
            ->addColumn('appointment_list', function ($row) {
                $source = strtolower($row->source ?? 'database');
                $color = '#ff0000';
                if ($source === 'referral') { $color = '#ff8c00'; }
                if ($source === 'cold') { $color = '#8b4513'; }

                $name = $row->advertiser->name ?? null;
                $label = $name ? ($name.' ('.$row->advertiser->member_id.')') : $row->advertiser->member_id;
                $dateTime = (Carbon::parse($row->time)->format('h:i a')).' | '.(Carbon::parse($row->date)->format('d-m-Y'));
                return '<label class="mb-0 cursor-pointer"><i class="fas fa-circle mr-2" style="color: '.$color.'"></i>'.e($label).'</label> <small class="text-muted"> ( '.$dateTime.' ) </small>';
            })
            ->addColumn('map', function ($row) {
                return view('agent.dashboard.partials.datatable-map', ['appointment' => $row])->render();
            })
            ->addColumn('status_badge', function ($row) {
                $status = $row->status;
                $map = [
                    'in_progress' => ['label' => 'In Progress', 'bg' => '#36b9cc'],   // Blue for in progress
                    'over_due'    => ['label' => 'Overdue',     'bg' => '#e74a3b'],   // Red for overdue
                    'completed'   => ['label' => 'Completed',   'bg' => '#1cc88a'],   // Green for completed
                ];
                $cfg = $map[$status];
                return '<span class="badge badge-danger-lighten task-1" style="background: '.$cfg['bg'].'; padding:5px 10px; max-width:120px; width:100%;">'.e($cfg['label']).'</span>';
            })
            ->addColumn('actions', function ($row) {
                return view('agent.dashboard.partials.datatable-actions', ['appointment' => $row])->render();
            })
            ->rawColumns(['appointment_list', 'map', 'status_badge', 'actions'])
            ->make(true);

        
    }

    public function show($id)
    {
        // Custom query for the 'time' column example:
        $appointment = Appointment::with(['advertiser:id,name'])
            ->select([
                'appointments.*', // select all columns
                DB::raw("DATE_FORMAT(appointments.time, '%H:%i') as formatted_time"),
                DB::raw("DATE_FORMAT(appointments.created_at, '%m-%d-%Y') as created_at_formatted")
            ])
            ->find($id);
        if (!$appointment) {
            return error_response('Appointment not found', 404);
        }
        return success_response($appointment, 'Appointment details');
    }

    public function update(Request $request, $id)
    {
       // dd($request->all());
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return error_response('Appointment not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required',
            'advertiser_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'source' => 'required|in:database,referral,cold',
            'importance' => 'required|in:high,medium,low',
            'point_of_contact' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:30',
            'summary' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return error_response($validator->errors()->first(), 422, $validator->errors());
        }

        $data = $validator->validated();

        // Normalize time to canonical format HH:mm
        try {
            $data['time'] = Carbon::parse($data['time'])->format('H:i');
        } catch (\Throwable $e) {
            return error_response('Invalid time format.', 422);
        }

        // Short-circuit: if no change in advertiser/date/time, skip availability check
        // $noOpTime = (
        //     (int)$appointment->advertiser_id === (int)$data['advertiser_id'] &&
        //     Carbon::parse($appointment->date)->isSameDay(Carbon::parse($data['date'])) &&
        //     Carbon::parse($appointment->time)->format('H:i') === $data['time']
        // );

       
        DB::beginTransaction();
        try {
            // if (!$noOpTime) {
            //     // prevent duplicate for same advertiser/date/time (excluding current)
            //     $exists = Appointment::where('advertiser_id', $data['advertiser_id'])
            //         ->whereDate('date', $data['date'])
            //         ->where('time', $data['time'])
            //         ->where('id', '!=', $appointment->id)
            //         ->lockForUpdate()
            //         ->exists();
            //     if ($exists) {
            //         DB::rollBack();
            //         return error_response('An appointment already exists for this advertiser at the selected date and time.', 422);
            //     }
            // }

            $appointment->fill($data);
            $appointment->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return error_response('Failed to update appointment.', 500);
        }

        return success_response($appointment, 'Appointment updated');
    }

    public function reschedule(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return error_response('Appointment not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required',
        ]);
        if ($validator->fails()) {
            return error_response($validator->errors()->first(), 422, $validator->errors());
        }
        $data = $validator->validated();

        $exists = Appointment::where('advertiser_id', $appointment->advertiser_id)
            ->whereDate('date', $data['date'])
            ->where('time', $data['time'])
            ->where('id', '!=', $appointment->id)
            ->exists();
        if ($exists) {
            return error_response('Another appointment exists at the selected date and time.', 422);
        }

        $appointment->date = $data['date'];
        $appointment->time = $data['time'];
        $appointment->status = 'rescheduled';
        $appointment->save();

        return success_response($appointment, 'Appointment rescheduled');
    }

    public function complete($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return error_response('Appointment not found', 404);
        }
        // enum has a typo 'comleted' in migration; use the same to avoid SQL error
        $appointment->status = 'comleted';
        $appointment->save();
        return success_response($appointment, 'Appointment marked as completed');
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
