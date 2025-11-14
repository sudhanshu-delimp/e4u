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
use App\Models\AgentNotification;

class AppointmentController extends Controller
{
    public function index(){
          return view('agent.dashboard.my-appointments');
    }

    public function appointmentBookingList(){
        return view('agent.dashboard.view-planner');
    }

    public function appointmentcountDayWeekMonth(){
        $today = Carbon::today('UTC');
        $weekStart = Carbon::now('UTC')->startOfWeek(Carbon::SUNDAY);
        $endOfWeek   = Carbon::now('UTC')->endOfWeek(Carbon::SATURDAY);
        
        $monthStart = Carbon::now('UTC')->startOfMonth();
        $monthend = Carbon::now('UTC')->endOfMonth();
       
        

        
        try{
         
            $result = Appointment::where('agent_id', Auth::id())
                ->selectRaw(
                    "SUM(CASE WHEN date = ? THEN 1 ELSE 0 END) as today_count, " .
                    "SUM(CASE WHEN date BETWEEN ? AND ? THEN 1 ELSE 0 END) as week_count, " .
                    "SUM(CASE WHEN date BETWEEN ? AND ? THEN 1 ELSE 0 END) as month_count",
                    [
                        $today->toDateString(),
                        $weekStart->toDateString(),
                        $endOfWeek->toDateString(),
                        $monthStart->toDateString(),
                        $monthend->toDateString()
                    ]
                )
                ->first();
        return success_response($result, 'Appointment rescheduled');
        } catch (\Throwable $e) {
            dd($e);
            return error_response('Appointment not found', 404);
        }

       

    }



    public function getSlotList(Request $request)
    {
        $date = $request->date; // Format: Y-m-d
        $currentId = $request->input('current_id');
        $mode = $request->query('mode'); // 'grid' returns all + booked

        // 1) Fetch already booked slots for the given date (GLOBAL overlap disabling)
        $appointments = Appointment::whereDate('date', $date)
            ->get(['start_time', 'end_time', 'id']);
        $bookedSlots = [];
        foreach ($appointments as $apt) {
            $start = Carbon::parse($apt->start_time);
            $end = $apt->end_time ? Carbon::parse($apt->end_time) : (clone $start)->addMinutes(30); 
            $cursor = $start->copy();
            while ($cursor < $end) {
                $bookedSlots[] = $cursor->format('H:i');
                $cursor->addMinutes(30);
            }
        }

        // 2) Generate all slots (8 AM → 8 PM, 30 mins interval)
        $slots = [];
        $start = Carbon::parse($date.' 08:00');
        $end   = Carbon::parse($date.' 20:00');

        while ($start < $end) {
            $slotTime = $start->format('H:i');
            $slots[] = $slotTime;
            $start->addMinutes(30);
        }
       
        // For legacy flows, exclude booked and optionally include current appointment's own slots
        $available = array_values(array_diff($slots, $bookedSlots));
        if (!empty($currentId)) {
            $current = Appointment::find($currentId);
            if ($current && Carbon::parse($current->date)->isSameDay(Carbon::parse($date))) {
                $cursor = Carbon::parse($current->start_time);
                $end = Carbon::parse($current->end_time);
                while ($cursor < $end) {
                    $ct = $cursor->format('H:i');
                    if (!in_array($ct, $available)) {
                        $available[] = $ct;
                    }
                    $cursor->addMinutes(30);
                }
            }
        }
       

        // 5) Sort slots for stable UI
        sort($slots, SORT_STRING);
        sort($available, SORT_STRING);
        sort($bookedSlots, SORT_STRING);

        if ($mode === 'grid') {
            return success_response([
                'all' => $slots,
                'booked' => $bookedSlots,
            ], 'get all slots');
        }

        return success_response($available, 'get all slots');
       
    }

    public function datatable(Request $request)
    {
		$query = Appointment::query()
			->where('agent_id', Auth::id())
			->select(['appointments.*'])
			->orderByRaw("FIELD(importance, 'high','medium','low')")
			->orderBy('created_at', 'DESC');

        return DataTables::of($query)
			// Disable server-side filtering for the computed HTML column
			->filterColumn('appointment_list', function ($query, $keyword) {
				// no-op: do not change the query for this column
			})
            ->addColumn('appointment_list', function ($row) {
                $importance = strtolower($row->importance ?? 'high');
                $color = '#F31818';
                if ($importance === 'medium') { $color = '#FFA113'; }
                if ($importance === 'low') { $color = '#87632C'; }

				$label = $row->advertiser_name ?? 'Appointment';
                $dateTime = (Carbon::parse($row->start_time)->format('h:i a')).'-'.(Carbon::parse($row->end_time)->format('h:i a')).' | '.(Carbon::parse($row->date)->format('d-m-Y'));
                return '<label class="mb-0 cursor-pointer"><i class="fas fa-circle mr-2" style="color: '.$color.'"></i>'.e($label).'</label> <small class="text-muted"> ( '.$dateTime.' ) </small>';
            })
            ->addColumn('map', function ($row) {
                return view('agent.dashboard.partials.datatable-map', ['appointment' => $row])->render();
            })
            ->addColumn('status_badge', function ($row) {
                $status = $row->status;
                $map = [
                    'in_progress' => ['label' => 'In Progress', 'bg' => '#4e73df'],   // Blue for in progress
                    'over_due'    => ['label' => 'Overdue',     'bg' => '#9d1d08'],   // Red for overdue
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
        $appointment = Appointment::query()
            ->select([
                'appointments.*', // select all columns
                // NEW: Formatted Start Time (e.g., 10:00 AM)
                DB::raw("DATE_FORMAT(appointments.start_time, '%h:%i %p') as formatted_start_time"),
                DB::raw("DATE_FORMAT(appointments.end_time, '%h:%i %p') as formatted_end_time"),
                DB::raw("DATE_FORMAT(appointments.created_at, '%d-%m-%Y') as created_at_formatted")
            ])
            ->find($id);
        if (!$appointment) {
            return error_response('Appointment not found', 404);
        }
        return success_response($appointment, 'Appointment details');
    }

    public function update(Request $request, $id)
    {

        $appointment = Appointment::find($id);
        if (!$appointment) {
            return error_response('Appointment not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i', 
            'end_time' => 'required|date_format:H:i|after:start_time',
            'advertiser_name' => 'required|string|max:255',
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
       
        DB::beginTransaction();
        try {
           
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
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        if ($validator->fails()) {
            return error_response($validator->errors()->first(), 422, $validator->errors());
        }
        $data = $validator->validated();

        $startTime = $data['start_time'];
        $endTime = $data['end_time'];

         $overlapExists = Appointment::whereDate('date', $data['date'])
            ->where('id', '!=', $appointment->id) 
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->exists();
        if ($overlapExists) {
            return error_response('Another appointment exists at the selected date and time.', 422);
        }

        $appointment->date = $data['date'];
        $appointment->start_time = $startTime;
        $appointment->end_time = $endTime;
        $appointment->status = 'in_progress';
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
        $appointment->status = 'completed';
        $appointment->save();
        return success_response($appointment, 'Appointment marked as completed');
    }

    public function store(Request $request)
    {
		try {
            $validator = Validator::make($request->all(), [
                'new_advertiser_name' => 'required|string|max:255',
				'new_appointment_date' => 'required|date',
				//'new_appointment_time_slot' => 'nullable',
				'new_start_time' => 'nullable|date_format:H:i',
				'new_end_time' => 'nullable|date_format:H:i|after:new_start_time',
				'new_address' => 'required|string|max:255',
				'new_latitude' => 'nullable|numeric',
				'new_longitude' => 'nullable|numeric',
				'new_source' => 'required|string|in:database,referral,cold',
				'new_task_priority' => 'nullable|in:high,medium,low',
			]);

			if ($validator->fails()) {
				return error_response($validator->errors()->first(), 422, $validator->errors());
			}

			$validated = $validator->validated();
            
			// Determine start/end based on provided fields
			$startTime = $validated['new_start_time'];
			$endTime = $validated['new_end_time'];
			$startTime = Carbon::parse($startTime)->format('H:i');
			$endTime = Carbon::parse($endTime)->format('H:i');

			// Overlap check on the same date [time, end_time) (GLOBAL)
			 $overlapExists = Appointment::whereDate('date', $validated['new_appointment_date'])
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                })
                ->exists();
			if ($overlapExists) {
				return error_response('Selected time overlaps with an existing appointment.', 422);
			}

			$appointment = Appointment::create([
				'advertiser_name' => $validated['new_advertiser_name'],
				'date' => $validated['new_appointment_date'],
				'start_time' => $startTime,
				'end_time' => $endTime,
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
            dd($e);
			return error_response('Something went wrong while creating the appointment.', 500);
		}
    }

    public function appointmentCount()
    {
        try {
            $agentId = Auth::id();
            
            $today = Carbon::today()->toDateString();
            $result = Appointment::where('agent_id', $agentId)
                ->selectRaw(
                    "COALESCE(SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END), 0) AS in_progress,\n" .
                    "COALESCE(SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END), 0) AS completed,\n" .
                    "COALESCE(SUM(CASE WHEN status = 'over_due'THEN 1 ELSE 0 END), 0) AS overdue",
                   
                )
                ->first();

            $data = [
                'in_progress' => (int) ($result->in_progress ?? 0),
                'completed' => (int) ($result->completed ?? 0),
                'overdue' => (int) ($result->overdue ?? 0),
            ];

            return success_response($data, 'Appointment counts fetched successfully');
        } catch (\Throwable $e) {
            return error_response('Failed to fetch appointment counts.', 500);
        }
    }


	public function appointmentPdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
			$data = Appointment::find($decodedId);
            if (is_null($data)) {
                abort(404); // Throws a NotFoundHttpException
            }
            $pdfDetail['date'] = Carbon::parse($data->date)->format('d-m-Y');
            $pdfDetail['time'] = Carbon::parse($data->start_time)->format('h:i A') . ' - ' . Carbon::parse($data->end_time)->format('h:i A');
			$pdfDetail['advertiser'] = $data->advertiser_name;
            $pdfDetail['address'] = $data->address;
            $pdfDetail['point_of_contact'] = $data->point_of_contact;
            $pdfDetail['mobile'] = $data->mobile;
            $pdfDetail['summary'] = $data->summary;
            $pdfDetail['source'] = $data->source;
            $pdfDetail['importance'] = $data->importance;
            $pdfDetail['map'] = $data->address;
            $pdfDetail['create_date'] = Carbon::parse($data->created_at)->format('M d, Y');

            return view('agent.dashboard.partials.appointment-pdf-download', compact('data', 'pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

	public function calendarEvents(Request $request)
	{
		$start = $request->query('start'); // ISO date
		$end = $request->query('end');     // ISO date
		$agentId = Auth::id();

		$query = Appointment::query()
			->where('agent_id', $agentId)
			->when($start, function ($q) use ($start) {
				$q->whereDate('date', '>=', $start);
			})
			->when($end, function ($q) use ($end) {
				$q->whereDate('date', '<=', $end);
			})
			->select(['id','date','start_time','end_time','importance','status','address','advertiser_name']);

		$events = $query->get()->map(function ($apt) {
            $importance = strtolower($apt->importance ?? 'high');
            $color = '#F31818';
            if ($importance == 'medium') { $color = '#FFA113'; }
            if ($importance == 'low') { $color = '#87632C'; }

            // FIX 1: Use start_time and end_time for FullCalendar
            $startDateTime = Carbon::parse($apt->date.' '.$apt->start_time)->format('Y-m-d\TH:i:s');
            $endDateTime = Carbon::parse($apt->date.' '.$apt->end_time)->format('Y-m-d\TH:i:s'); // CRITICAL: Add end time

            // FIX 2: Create a proper title using start_time and end_time
            $startTimeFormatted = Carbon::parse($apt->start_time)->format('h:i A');
            $endTimeFormatted = Carbon::parse($apt->end_time)->format('h:i A');
            
			$titleName = $apt->advertiser_name ?: 'Appointment';
            $title = $titleName.' ('.$this->returnStatus($apt->status).') ' . $startTimeFormatted . ' - ' . $endTimeFormatted; // Added status to title for clarity
			return  [
                'id' => $apt->id,
                'title' => $title,
                'start' => $startDateTime,
                'end' => $endDateTime, 
                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'importance' => $apt->importance,
                    'status' => $apt->status,
                ],
            ];
		});

      //  dd($events);

		return response()->json($events);
	}

	public function appointmentDetails($id)
	{
		$appointment = Appointment::find($id);
        //dd($appointment);
		if (!$appointment) {
			return error_response('Appointment not found', 404);
		}
		$detail = [
			'date' => Carbon::parse($appointment->date)->format('d-m-Y'),
			'time' => Carbon::parse($appointment->start_time)->format('h:i A') . ' - ' . Carbon::parse($appointment->end_time)->format('h:i A'),
			'advertiser' => ($appointment->advertiser_name ?? ''),
			'address' => $appointment->address,
			'point_of_contact' => $appointment->point_of_contact,
			'mobile' => $appointment->mobile,
			'summary' => $appointment->summary,
			'source' => $appointment->source,
			'importance' => $appointment->importance,
            'status' => ucfirst(str_replace("_", " ",$appointment->status)),
			'create_date' => Carbon::parse($appointment->created_at)->format('d-m-Y'),
		];
		return success_response($detail, 'Appointment details');
	}

    public function returnStatus($status){
                $map = [
                    'in_progress' => 'In Progress',   
                    'over_due'    =>'Overdue',   
                    'completed'   =>'Completed',
                ];
                return $map[$status];
    }


}
