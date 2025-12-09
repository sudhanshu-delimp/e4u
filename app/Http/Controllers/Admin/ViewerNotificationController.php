<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ViewerNotification;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ViewerNotificationController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $query = ViewerNotification::query();
            $clientOrder = $request->input('order');

            if (empty($clientOrder)) {
                $query->orderBy('created_at', 'DESC');
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return sprintf('#%05d', $row->id);
                })
                ->editColumn('start_date', function ($row) {
                    return basicDateFormat($row->start_date);
                })
                ->orderColumn('start_date', function ($query, $order) {
                    $query->orderBy('start_date', $order);
                })
                ->editColumn('type', function ($row) {
                    $type = $row->type;
                    if ($type === 'Scheduled') {
                        $recurringRange = $row->recurring_type;
                        return $type . ($recurringRange ? ' (' . $recurringRange . ')' : '');
                    }
                    return $type;
                })
                ->orderColumn('type', function ($query, $order) {
                    $query->orderBy('type', $order);
                })
                ->editColumn('end_date', function ($row) {
                    return $row->end_date ? basicDateFormat($row->end_date) : '';
                })
                ->orderColumn('end_date', function ($query, $order) {
                    $query->orderBy('end_date', $order);
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    // Example: you can add your own business logic for action buttons
                    if (($row->status ?? null) === 'Published') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Suspend</a>';
                    } elseif (in_array($row->status ?? null, ['Suspended'])) {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-publish" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Publish</a>';
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
                    }
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-view" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-edit" data-id="' . $row->id . '"><i class="fa fa-fw fa-edit"></i> Edit</a>';

                    $dropdown = '<div class="dropdown no-arrow">'
                        . '<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                        . '<i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>'
                        . '</a>'
                        . '<div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">'
                        . implode('<div class="dropdown-divider"></div>', $actions)
                        . '</div>'
                        . '</div>';

                    return $dropdown;
                })
                ->rawColumns(['action', 'start_date', 'end_date'])
                ->make(true);
        }
        return view('admin.notifications.viewers.index');
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $notification = ViewerNotification::findOrFail($id);
            if ($notification->status !== 'Published') {
                return error_response('Only Published notifications can be removed.', 422);
            }
            $notification->status = 'Suspended';
            $notification->save();
            return success_response(['id' => $notification->id, 'status' => $notification->status], 'Notification removed Successfully.');
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $notification = ViewerNotification::findOrFail($id);
            $allowed = ['Published', 'Suspended', 'Suspended', 'Removed'];
            $status = $request->input('status');
            if ($status == 'Removed') {
                $notification->delete();
                return success_response(['id' => $notification->id, 'status' => $notification->status], 'Notification delete Successfylly!!.');
            }

            if (!in_array($status, $allowed)) {
                return response()->json(['success' => false, 'message' => 'Invalid status'], 422);
            }
            $notification->status = $status;
            $notification->save();
            return success_response(['id' => $notification->id, 'status' => $notification->status], 'Status updated Successfully.');
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $n = ViewerNotification::findOrFail($id);
            // Format recurring day/month range
            $recurringRange = null;
            if (in_array($n->recurring_type, ['weekly', 'monthly', 'yearly'])) {
                $recurringRange = basicDateFormat($n['start_date']) . ' - ' . basicDateFormat($n['end_date']);
            } elseif ($n->recurring_type === 'forever') {
                $recurringRange = "Forever";
            }

            return success_response([
                'id' => $n->id,
                'ref' => sprintf('#%05d', $n->id),
                'current_day' => $n->current_day ? basicDateFormat($n->current_day) : null,
                'heading' => $n->heading,
                'type' => $n->type,
                'start_date' => $n->start_date ? basicDateFormat($n->start_date) : null,
                'end_date' => $n->end_date ? basicDateFormat($n->end_date) : null,
                'member_id' => $n->member_id,
                'status' => $n->status,
                'recurring_type' => $n->recurring_type,
                'recurring_range' => $recurringRange,
                'num_recurring' => $n->num_recurring,
                'content' => $n->content,
                'created_at' => $n->created_at ? $n->created_at->format('d-m-Y H:i:s') : null,
                'updated_at' => $n->updated_at ? $n->updated_at->format('d-m-Y H:i:s') : null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch notification: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $isUpdate = !empty($request->notificationId);
            $data = [
                'current_day' => Carbon::createFromFormat('d-m-Y', $request->current_day)->toDateString(),
                'heading' => $request->heading,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'content' => $request->content,
            ];

            if ($request->type === 'Notice') {
                $data['member_id'] = $request->member_id;
            }

            if ($request->type === 'Scheduled') {
                $data['recurring_type'] = $request->recurring_type;
                $data['num_recurring'] = $request->recurring;

                switch ($request->recurring_type) {
                    case 'weekly':
                        $data['start_day'] = $request->start_day_week;
                        $data['end_day'] = $request->end_day_week;
                        $weekStartDay = (int) $request->start_day_week;
                        $weekEndDay = (int) $request->end_day_week;
                        $numRecurring = $request->recurring;
                        $startDate = Carbon::today()->startOfWeek(Carbon::SUNDAY);
                        $actualStartDate = $startDate->copy()->addDays($weekStartDay - 1);
                        $data['start_date'] = $actualStartDate->toDateString();
                        $dates = [];
                        for ($weekIndex = 0; $weekIndex < $numRecurring; $weekIndex++) {
                            $weekStartDate = $startDate->copy()->addWeeks($weekIndex);
                            for ($day = $weekStartDay; $day <= $weekEndDay; $day++) {
                                $date = $weekStartDate->copy()->addDays($day - 1);
                                $dates[] = $date->toDateString();
                            }
                        }
                        $data['scheduled_days'] = implode(',', $dates);
                        $data['end_date'] = $startDate->copy()->addWeeks($numRecurring)->subDay()->toDateString();
                        break;
                    case 'monthly':
                        $monthStartDay = (int) $request->start_day_monthly;
                        $monthEndDay = (int) $request->end_day_monthly;
                        $data['start_day'] = $monthStartDay;
                        $data['end_day'] = $monthEndDay;
                        $numRecurring = $data['num_recurring'];
                        $baseDate = isset($request->start_date) ? Carbon::parse($request->start_date) : Carbon::now();
                        $startDateDay = min($monthStartDay, $baseDate->daysInMonth);
                        $startDate = $baseDate->copy()->startOfMonth()->day($startDateDay);
                        $dates = [];
                        for ($monthIndex = 0; $monthIndex < $numRecurring; $monthIndex++) {
                            $monthStartDate = $startDate->copy()->addMonthsNoOverflow($monthIndex);
                            for ($day = $monthStartDay; $day <= $monthEndDay; $day++) {
                                if ($monthStartDate->copy()->day($day)->month == $monthStartDate->month) {
                                    $dates[] = $monthStartDate->copy()->day($day)->toDateString();
                                }
                            }
                        }
                        $data['scheduled_days'] = implode(',', $dates);
                        $lastMonthDate = $startDate->copy()->addMonthsNoOverflow($numRecurring - 1);
                        $endDayValid = min($monthEndDay, $lastMonthDate->daysInMonth);
                        $data['end_date'] = $lastMonthDate->copy()->day($endDayValid)->toDateString();
                        $data['start_date'] = $startDate->toDateString();
                        break;
                    case 'yearly':
                        $startMonth = (int) $request->start_month_yearly;
                        $startDay = (int) $request->start_day_yearly;
                        $endMonth = (int) $request->end_month_yearly;
                        $endDay = (int) $request->end_day_yearly;
                        $numRecurring = $data['num_recurring'];
                        $baseYear = isset($request->start_date) ? Carbon::parse($request->start_date)->year : Carbon::now()->year;
                        $startDate = Carbon::create($baseYear, $startMonth, min($startDay, Carbon::create($baseYear, $startMonth)->daysInMonth));
                        $data['start_date'] = $startDate->toDateString();
                        $dates = [];
                        for ($yearIndex = 0; $yearIndex < $numRecurring; $yearIndex++) {
                            $currentYear = $baseYear + $yearIndex;
                            $carbonStart = Carbon::create($currentYear, $startMonth, min($startDay, Carbon::create($currentYear, $startMonth)->daysInMonth));
                            $carbonEnd = Carbon::create($currentYear, $endMonth, min($endDay, Carbon::create($currentYear, $endMonth)->daysInMonth));
                            if ($endMonth < $startMonth) {
                                $decEnd = Carbon::create($currentYear, 12, 31);
                                $janStartNext = Carbon::create($currentYear + 1, 1, 1);
                                $janEndNext = Carbon::create($currentYear + 1, $endMonth, min($endDay, Carbon::create($currentYear + 1, $endMonth)->daysInMonth));
                                while ($carbonStart->lessThanOrEqualTo($decEnd)) {
                                    $dates[] = $carbonStart->toDateString();
                                    $carbonStart->addDay();
                                }
                                $carbonStart = $janStartNext;
                                while ($carbonStart->lessThanOrEqualTo($janEndNext)) {
                                    $dates[] = $carbonStart->toDateString();
                                    $carbonStart->addDay();
                                }
                            } else {
                                while ($carbonStart->lessThanOrEqualTo($carbonEnd)) {
                                    $dates[] = $carbonStart->toDateString();
                                    $carbonStart->addDay();
                                }
                            }
                        }
                        $data['scheduled_days'] = implode(',', $dates);
                        $data['start_month'] = $startMonth;
                        $data['start_day'] = $startDay;
                        $data['end_month'] = $endMonth;
                        $data['end_day'] = $endDay;
                        $lastYear = $baseYear + $numRecurring - 1;
                        $endDateYear = $lastYear;
                        $endDateMonth = $endMonth;
                        $endDateDay = min($endDay, Carbon::create($lastYear, $endMonth)->daysInMonth);
                        $data['end_date'] = Carbon::create($endDateYear, $endDateMonth, $endDateDay)->toDateString();
                        break;
                    case 'forever':
                        $data['scheduled_days'] = null;
                        $data['end_date'] = null;
                        break;
                }
            }

            if ($isUpdate) {
                $notification = ViewerNotification::findOrFail($request->notificationId);
                if($data['end_date'] > date('Y-m-d')){
                    $data['status'] = 'Published';
                }
                $notification->update($data);
                return success_response($notification, 'Notification updated successfully');
            } else {
                $notification = ViewerNotification::create($data);
                return success_response($notification, 'Notification saved successfully');
            }
        } catch (\Exception $e) {
            return error_response('Failed to create/update notification: ' . $e->getMessage(), 500);
        }
    }





    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = ViewerNotification::find($decodedId);


            $recurringRange = null;
            if (in_array($data->recurring_type, ['weekly', 'monthly', 'yearly'])) {
                $recurringRange = basicDateFormat($data['start_date']) . ' - ' . basicDateFormat($data['end_date']);
            } elseif ($data->recurring_type === 'forever') {
                $recurringRange = "Forever";
            }

            if (is_null($data)) {
                abort(404); // Throws a NotFoundHttpException
            }
            $pdfDetail['ref'] = $data['id'];
            $pdfDetail['current_day'] = $data['current_day'] ? basicDateFormat($data['current_day']) : null;
            $pdfDetail['heading'] = $data['heading'];
            $pdfDetail['type'] = $data['type'];
            $pdfDetail['status'] = $data['status'];
            $pdfDetail['start_date'] = basicDateFormat($data['start_date']);
            $pdfDetail['end_date'] = basicDateFormat($data['end_date']);
            $pdfDetail['member_id'] = $data['member_id'];
            $pdfDetail['recurring_type'] = $data['recurring_type'];
            $pdfDetail['recurring_range'] = $recurringRange;
            $pdfDetail['num_recurring'] = $data['num_recurring'];
            $pdfDetail['content'] = $data['content'];

            return view('admin.notifications.viewers.viewer-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $notification = ViewerNotification::findOrFail($id);
            $notification->current_day = basicDateFormat($notification->current_day);
           
            return success_response($notification, 'Notification saved successfully');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }

    public function update(Request  $request, $id)
    {
        try {
            $notification = ViewerNotification::findOrFail($id);
            $data = $request->all();
            $notification->update($data);
            return success_response($notification, 'Notification updated successfully.');
        } catch (\Exception $e) {
            return error_response('Faild to update Notification: ' . $e->getMessage(), 500);
        }
    }
}
