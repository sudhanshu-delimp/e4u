<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCenterNotification;
use App\Models\LegboxNotificationForEscrt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LegboxNotificationforEscortController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = LegboxNotificationForEscrt::query();
            $clientOrder = $request->input('order');
            if (empty($clientOrder)) {
                $query->orderBy('created_at', 'DESC');
            }
            $query->where('create_by', auth()->user()->id);


            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return  $row->id;
                })
                ->filterColumn('ref', function ($query, $keyword) {
                    if ($keyword !== '') {
                        $query->where('id', '=', $keyword);
                    }
                })
                ->editColumn('start_date', function ($row) {
                    return basicDateFormat($row['start_date']);
                })
                ->orderColumn('start_date', function ($query, $order) {
                    $query->orderBy('start_date', $order);
                })
                ->editColumn('end_date', function ($row) {
                    return basicDateFormat($row['end_date']);
                })
                ->orderColumn('end_date', function ($query, $order) {
                    $query->orderBy('end_date', $order);
                })
                ->editColumn('status', function ($row) {
                    $start_date = $row->start_date;
                    $status = $row->status;
                    if ($status === 'Published' && $start_date > date('Y-m-d')) {
                        $statusText = 'Upcoming';
                    } else {
                        $statusText = $status ?? 'NA';
                    }
                    $badgeClass = getStatusBadgeClass($statusText);
                    return "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
                })
                ->editColumn('type', function ($row) {
                    return $row->type;
                })
                ->orderColumn('type', function ($query, $order) {
                    $query->orderBy('type', $order);
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $status = $row->status ?? null;
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-edit" data-id="' . $row->id . '"><i class="fa fa-fw fa-edit"></i> Edit</a>';

                    // If published -> offer suspend
                    if ($status === 'Published') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Suspend</a>';
                    }

                    // If suspended -> offer publish and remove
                    if ($status === 'Suspended') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-publish" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Publish</a>';
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
                    }

                    // If completed -> offer remove
                    if ($status === 'Completed') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
                    }

                    // Common actions
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-view" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';


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
                ->rawColumns(['action', 'start_date', 'end_date', 'status'])
                ->make(true);
        }

        return view('escort.dashboard.Communication.legbox_notification.index');
    }

    public function updateStatus(Request $request, $id)
    {

        try {
            $notification = LegboxNotificationForEscrt::findOrFail($id);
            $status = $request->input('status');
            $allowedStatuses = ['Published', 'Suspended', 'Removed', 'Suspended'];

            if (!in_array($status, $allowedStatuses)) {
                return error_response('Invalid status', 422);
            }

            if ($status === 'Removed') {
                $notification->delete();
                return success_response(
                    ['id' => $notification->id, 'status' => 'Removed'],
                    'Legbox Notification deleted successfully.'
                );
            }

            $notification->update(['status' => $status]);

            return success_response(
                ['id' => $notification->id, 'status' => $status],
                'Status updated successfully.'
            );
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $n = LegboxNotificationForEscrt::findOrFail($id);
            return success_response([
                'id' => $n->id,
                'ref' => sprintf('#%05d', $n->id),
                'heading' => $n->heading,
                'start_date' => basicDateFormat($n->start_date),
                'end_date' => basicDateFormat($n->end_date),
                'type' => $n->type,
                'status' => $n->status,
                'content' => $n->content,
                'template_name' => $n->template_name,
                'member_id' => $n->member_id,
            ]);
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }

    public function store(StoreCenterNotification $request)
    {

        $data =  $request->only(['heading', 'start_date', 'end_date', 'type', 'content', 'member_id', 'template_name', 'edit_notification_id']);
        $user = auth()->user();
        $start = sqlDateFormat($data['start_date']);
        $end =  sqlDateFormat($data['end_date']);
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        $data['create_by'] = $user->id;
        $data['create_by_member_id'] = $user->member_id;

        //Check condition 
        $notificationId = $request->edit_notification_id;

        //check date range for update
        $dateRange = $this->chckDateRange($start, $end, $notificationId);
        if ($dateRange) {
            return error_response('A Legbox Notification already exists in the selected date range!', 422);
        }

        if ($notificationId) {

            $update = LegboxNotificationForEscrt::find($notificationId);
            $update->heading = $request->heading;
            $update->content = $data['content'];
            $update->template_name = $request->template_name;
            $update->start_date = sqlDateFormat($data['start_date']);
            $update->end_date = sqlDateFormat($data['end_date']);
            $update->type = $request->type;
            $update->create_by = auth()->user()->id;

            /* Reset all type-based fields */
            $update->content       = null;
            $update->template_name = null;
            $update->member_id     = null;

            if ($request->type == 'Ad hoc') {
                $update->content = $data['content'];
            } elseif ($request->type == 'Template') {
                $update->template_name = $request->template_name;
            } elseif ($request->type == 'Notice') {
                $update->member_id = $request->member_id;
                $update->content = $data['content'];
            }

            $update->save();
            return success_response($data, 'Legbox Notification update successfully!!');
        }

        try {
            LegboxNotificationForEscrt::create($data);
            return success_response($data, 'Legbox Notification create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }

    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = LegboxNotificationForEscrt::find($decodedId);
            if (is_null($data)) {
                abort(404); // Throws a NotFoundHttpException
            }
            $pdfDetail['ref'] = $data['id'];
            $pdfDetail['heading'] = $data['heading'];
            $pdfDetail['type'] = $data['type'];
            $pdfDetail['status'] = $data['status'];
            $pdfDetail['member_id'] = $data['member_id'];
            $pdfDetail['start_date'] = basicDateFormat($data['start_date']);
            $pdfDetail['end_date'] = basicDateFormat($data['end_date']);
            if ($data['type'] == 'Template') {
                $pdfDetail['template_name'] = $data['template_name'];
            } else {
                $pdfDetail['content'] = $data['content'];
            }

            return view('escort.dashboard.Communication.legbox_notification.legbox-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $notification = LegboxNotificationForEscrt::findOrFail($id);
            $notification->start_date = basicDateFormat($notification->start_date);
            $notification->end_date = basicDateFormat($notification->end_date);
            $notification->current_date = $notification->created_at->format('d-m-Y');


            // Return formatted date values for edit form
            $notificationData = $notification->toArray();
            return success_response($notificationData, 'Legbox Notification view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }


    public function chckDateRange($start, $end, $id = null)
    {
        $query = LegboxNotificationForEscrt::where('status', '=', 'Published')
            ->where('id', '!=', $id)
            ->where('create_by', '=', auth()->user()->id)
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($q2) use ($start, $end) {
                        $q2->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                    });
            });

        if ($query->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
