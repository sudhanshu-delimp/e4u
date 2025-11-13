<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentNotification;
use Carbon\Carbon;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;

class AgentNotificationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AgentNotification::query()
                ->orderByRaw("FIELD(type, 'scheduled','notice','adhoc')")->orderByRaw("FIELD(status, 'Published','Completed','Suspend', 'Removed')");
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return sprintf('#%05d', $row->id);
                })
                ->editColumn('start_date', function ($row) {
                    return $row->start_date ? Carbon::parse($row->start_date)->format('d-m-Y') : '';
                })
                ->editColumn('end_date', function ($row) {
                    return $row->end_date ? Carbon::parse($row->end_date)->format('d-m-Y') : '';
                })
                ->editColumn('type', function ($row) {
                    return $row->type;
                })
                ->editColumn('status', function ($row) {
                    return $row->status ?? '';
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    // Example: you can add your own business logic for action buttons
                    if (($row->status ?? null) === 'Published') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Suspend</a>';
                    } elseif (in_array($row->status ?? null, ['Suspend'])) {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-publish" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Publish</a>';
                    }
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-view" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';
                    if (!$row->status === 'Removed') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
                    }


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
        return view('admin.notifications.agents.index');
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $notification = AgentNotification::findOrFail($id);
            if ($notification->status !== 'Published') {
                return error_response('Only Published notifications can be removed.', 422);
            }
            $notification->status = 'Suspend';
            $notification->save();
            return success_response(['id' => $notification->id, 'status' => $notification->status], 'Notification removed successfully.');
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $notification = AgentNotification::findOrFail($id);
            $allowed = ['Published', 'Suspend', 'Suspended', 'Removed'];
            $status = $request->input('status');
            if (!in_array($status, $allowed)) {
                return response()->json(['success' => false, 'message' => 'Invalid status'], 422);
            }
            $notification->status = $status;
            $notification->save();
            return success_response(['id' => $notification->id, 'status' => $notification->status], 'Status updated successfully.');
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $n = AgentNotification::findOrFail($id);
            // Format recurring day/month range
            $recurringRange = null;
            if (in_array($n->recurring_type, ['weekly', 'monthly'])) {
                $recurringRange = "{$n->start_day} - {$n->end_day}";
            } elseif ($n->recurring_type === 'yearly') {
                $recurringRange = "{$n->start_month}/{$n->start_day} - {$n->end_month}/{$n->end_day}";
            } elseif ($n->recurring_type === 'forever') {
                $recurringRange = "Forever";
            }

            return success_response([
                'id' => $n->id,
                'ref' => sprintf('#%05d', $n->id),
                'current_day' => $n->current_day ? \Carbon\Carbon::parse($n->current_day)->format('d-m-Y') : null,
                'heading' => $n->heading,
                'type' => $n->type,
                'start_date' => $n->start_date ? \Carbon\Carbon::parse($n->start_date)->format('d-m-Y') : null,
                'end_date' => $n->end_date ? \Carbon\Carbon::parse($n->end_date)->format('d-m-Y') : null,
                'member_id' => $n->member_id,
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
        // dd($request->all());
        try {
            $data = [
                'current_day' => Carbon::createFromFormat('d-m-Y', $request->current_day)->toDateString(),
                'heading' => $request->heading,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'content' => $request->content,
            ];

            if ($request->type === 'notice') {
                $data['member_id'] = $request->member_id;
            }

            if ($request->type === 'scheduled') {
                $data['recurring_type'] = $request->recurring_type;
                $data['num_recurring'] = $request->recurring;

                switch ($request->recurring_type) {
                    case 'weekly':
                        $data['start_day'] = $request->start_day_week;
                        $data['end_day'] = $request->end_day_week;

                        $startDay = (int) $request->start_day_week;
                        $endDay = (int) $request->end_day_week;
                        $days = range($startDay, $endDay);
                        $data['scheduled_days'] = implode(',', $days); // Example "5,6,7"

                        break;
                    case 'monthly':
                        $data['start_day'] = $request->start_day_monthly;
                        $data['end_day'] = $request->end_day_monthly;

                        $startDay = (int) $request->start_day_monthly;
                        $endDay = (int) $request->end_day_monthly;
                        $days = range($startDay, $endDay);
                        $data['scheduled_days'] = implode(',', $days); // Example "10,11,...,25"

                        break;
                    case 'yearly':
                        $data['start_month'] = $request->start_month_yearly;
                        $data['start_day'] = $request->start_day_yearly;
                        $data['end_month'] = $request->end_month_yearly;
                        $data['end_day'] = $request->end_day_yearly;

                        $startMonth = (int) $request->start_month_yearly;
                        $startDay = (int) $request->start_day_yearly;
                        $endMonth = (int) $request->end_month_yearly;
                        $endDay = (int) $request->end_day_yearly;

                        $carbonStart = Carbon::create(null, $startMonth, $startDay);
                        $carbonEnd = Carbon::create(null, $endMonth, $endDay);

                        $dates = [];
                        while (
                            $carbonStart->month < $carbonEnd->month ||
                            ($carbonStart->month == $carbonEnd->month && $carbonStart->day <= $carbonEnd->day)
                        ) {
                            $dates[] = $carbonStart->format('m-d');
                            $carbonStart->addDay();
                        }
                        $data['scheduled_days'] = implode(',', $dates); // Example "01-25,01-26,...,03-30"
                        
                        break;
                    case 'forever':
                        // No additional data needed for forever
                        break;
                }
            }

            $notification = AgentNotification::create($data);
            return success_response($notification, 'Notification saved successfully');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }





    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = AgentNotification::find($decodedId);


            $recurringRange = null;
            if (in_array($data->recurring_type, ['weekly', 'monthly'])) {
                $recurringRange = "{$data->start_day} - {$data->end_day}";
            } elseif ($data->recurring_type === 'yearly') {
                $recurringRange = "{$data->start_month}/{$data->start_day} - {$data->end_month}/{$data->end_day}";
            } elseif ($data->recurring_type === 'forever') {
                $recurringRange = "Forever";
            }

            if (is_null($data)) {
                abort(404); // Throws a NotFoundHttpException
            }
            $pdfDetail['ref'] = $data['id'];
            $pdfDetail['current_day'] = $data['current_day'] ? \Carbon\Carbon::parse($data['current_day'])->format('d-m-Y') : null;
            $pdfDetail['heading'] = $data['heading'];
            $pdfDetail['type'] = $data['type'];
            $pdfDetail['status'] = $data['status'];
            $pdfDetail['start_date'] = $data['start_date'] ? \Carbon\Carbon::parse($data['start_date'])->format('d-m-Y') : null;
            $pdfDetail['end_date'] = $data['end_date'] ? \Carbon\Carbon::parse($data['end_date'])->format('d-m-Y') : null;;
            $pdfDetail['member_id'] = $data['member_id'];
            $pdfDetail['recurring_type'] = $data['recurring_type'];
            $pdfDetail['recurring_range'] = $recurringRange;
            $pdfDetail['num_recurring'] = $data['num_recurring'];
            $pdfDetail['content'] = $data['content'];

            return view('admin.notifications.agents.agents-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }



    /**
     * Fetch active agent notifications for the dashboard.
     */
    public function showAgentNotifications()
    {
        // $agentId = Auth::id();
        // $date = now()->toDateString();
        // $items = AgentNotification::active($date, $agentId)->orderByDesc('created_at')->get();
        // $data = $items->map(function($n) {
        //     return [
        //         'id' => $n->id,
        //         'heading' => $n->heading,
        //         'content' => $n->content,
        //         'type' => $n->type,
        //         'recurring_type' => $n->recurring_type,
        //         'start_date' => $n->start_date,
        //         'end_date' => $n->end_date,
        //         'created_at' => $n->created_at->format('d-m-Y'),
        //     ];
        // });
        // return response()->json(['notifications' => $data]);
    }

    public function showAgentNotificationCount()
    {
        // Assume $loggedMemberId holds the logged in user's member ID
        $loggedMemberId = 'M100244:001';
        $today = Carbon::today();
        $currentWeekDay = $today->dayOfWeekIso; // 1=Monday, 7=Sunday
        $currentDay = $today->day;
        $currentMonth = $today->month;

        $query = AgentNotification::query();

        $query->where(function (Builder $query) use ($today, $loggedMemberId, $currentWeekDay, $currentDay) {
            // Adhoc type
            $query->orWhere(function (Builder $q) use ($today) {
                $q->where('type', 'adhoc')
                    ->where('start_date', '<=', $today->toDateString())
                    ->where('end_date', '>=', $today->toDateString());
            });

            // Notice type
            $query->orWhere(function (Builder $q) use ($today, $loggedMemberId) {
                $q->where('type', 'notice')
                    ->where('start_date', '<=', $today->toDateString())
                    ->where('end_date', '>=', $today->toDateString())
                    ->where('member_id', $loggedMemberId);
            });

            // Scheduled type
            $query->orWhere(function (Builder $q) use ($today, $currentWeekDay, $currentDay, $loggedMemberId) {
                $q->where('type', 'scheduled')
                    ->where('status', 'Published')
                    ->where(function (Builder $sq) use ($currentWeekDay, $currentDay, $today) {
                        // Forever recurring
                        $sq->orWhere(function (Builder $sub) {
                            $sub->where('recurring_type', 'forever');
                        });

                        // Weekly recurring
                        $sq->orWhere(function (Builder $sub) use ($currentWeekDay, $today) {
                            $sub->where('recurring_type', 'weekly')
                                ->where('start_day', '<=', $currentWeekDay)
                                ->where('end_day', '>=', $currentWeekDay)
                                ->whereRaw("TIMESTAMPDIFF(WEEK, start_date, ?) <= num_recurring", [$today->toDateString()]);
                        });

                        // Monthly recurring
                        $sq->orWhere(function (Builder $sub) use ($currentDay, $today) {
                            $sub->where('recurring_type', 'monthly')
                                ->where('start_day', '<=', $currentDay)
                                ->where('end_day', '>=', $currentDay)
                                ->whereRaw("TIMESTAMPDIFF(MONTH, start_date, ?) <= num_recurring", [$today->toDateString()]);
                        });

                        // Yearly recurring
                        $sq->orWhere(function (Builder $sub) use ($today, $currentMonth, $currentDay) {
                            $sub->where('recurring_type', 'yearly')
                                ->whereRaw('? BETWEEN start_month AND end_month', [$currentMonth])
                                ->whereRaw("TIMESTAMPDIFF(YEAR, start_date, ?) <= num_recurring", [$today->toDateString()])
                                ->where(function ($dateRange) use ($currentMonth, $currentDay) {
                                    $dateRange->where(function ($startRange) use ($currentMonth, $currentDay) {
                                        // Start month and day condition
                                        $startRange->whereRaw("(start_month < end_month OR (start_month = end_month AND start_day <= end_day))")
                                            ->where(function ($cond) use ($currentMonth, $currentDay) {
                                                $cond->whereRaw("(? > start_month OR (? = start_month AND ? >= start_day))", [$currentMonth, $currentMonth, $currentDay]);
                                            })
                                            ->where(function ($cond) use ($currentMonth, $currentDay) {
                                                $cond->whereRaw("(? < end_month OR (? = end_month AND ? <= end_day))", [$currentMonth, $currentMonth, $currentDay]);
                                            });
                                    })->orWhere(function ($endRange) use ($currentMonth, $currentDay) {
                                        // Handle year wrap (e.g. end_month < start_month)
                                        $endRange->whereRaw("(start_month > end_month)")
                                            ->where(function ($cond) use ($currentMonth, $currentDay) {
                                                $cond->whereRaw("(? > start_month OR (? = start_month AND ? >= start_day))", [$currentMonth, $currentMonth, $currentDay])
                                                    ->orWhereRaw("(? < end_month OR (? = end_month AND ? <= end_day))", [$currentMonth, $currentMonth, $currentDay]);
                                            });
                                    });
                                });
                        });
                    });
            });
        });

        $notifications = $query->get();
    }
}
