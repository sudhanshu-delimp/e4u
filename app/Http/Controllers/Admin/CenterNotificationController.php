<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CenterNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CenterNotificationController extends Controller
{
    public function index(Request $request)
    {

        
        if ($request->ajax()) {
            $query = CenterNotification::query();
            $clientOrder = $request->input('order'); 
            if (empty($clientOrder)) {
                $query->orderBy('created_at', 'DESC');
            }


            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return sprintf('#%05d', $row->id);
                })
                ->filterColumn('ref', function ($query, $keyword) {
                    $digits = ltrim($keyword, '#0');
                    if ($digits !== '') {
                        $query->where('id', 'like', "%{$digits}%");
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
                ->editColumn('type', function ($row) {
                    return $row->type;
                })
                ->orderColumn('type', function ($query, $order) {
                    $query->orderBy('type', $order);
                })
                ->editColumn('status', function ($row) {
                    return $row->status;
                })
                ->orderColumn('status', function ($query, $order) {
                    $query->orderBy('status', $order);
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $status = $row->status ?? null;

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
        return view('admin.notifications.centres.index');
    }

    public function updateStatus(Request $request, $id)
    {

        try {
            $notification = CenterNotification::findOrFail($id);
            $status = $request->input('status');
            $allowedStatuses = ['Published', 'Suspended', 'Removed'];

            if (!in_array($status, $allowedStatuses)) {
                return error_response('Invalid status', 422);
            }

            if ($status === 'Removed') {
                $notification->delete();
                return success_response(
                    ['id' => $notification->id, 'status' => 'Removed'],
                    'Notification deleted successfully.'
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
            $n = CenterNotification::findOrFail($id);
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

    public function store(Request $request)
    {
        $data =  $request->only(['heading', 'start_date', 'end_date', 'type', 'content', 'member_id', 'template_name', 'edit_notification_id']);
        $start = sqlDateFormat($data['start_date']);
        $end =  sqlDateFormat($data['end_date']);
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        //Check condition 
        $notificationId = $request->edit_notification_id;

        if ($notificationId) {

            $update = CenterNotification::find($notificationId);
            $update->heading = $request->heading;
            $update->content = $data['content'];
            $update->template_name = $request->template_name;
            $update->start_date = sqlDateFormat($data['start_date']);
            $update->end_date = sqlDateFormat($data['end_date']);
            $update->type = $request->type;

            /* Reset all type-based fields */
            $update->content       = null;
            $update->template_name = null;
            $update->member_id     = null;

            if($request->type == 'Ad hoc'){
                $update->content = $request->content;
            }elseif($request->type == 'Template'){
                $update->template_name = $request->template_name;
            }elseif($request->type == 'Notice'){
                $update->member_id = $request->member_id;
                $update->content = $request->content;
            }
      
            $update->save();
            return success_response($data, 'Notification update successfully!!');
        }
        $query = CenterNotification::where('status', '=', 'Published')->where(function ($q) use ($start, $end) {
            $q->whereBetween('start_date', [$start, $end])
                ->orWhereBetween('end_date', [$start, $end])
                ->orWhere(function ($q2) use ($start, $end) {
                    $q2->where('start_date', '<=', $start)
                        ->where('end_date', '>=', $end);
                });
        });
        if ($query->exists()) {
            return error_response('A Notification already exists in the selected date range!', 422);
        }
        try {
            CenterNotification::create($data);
            return success_response($data, 'Notification create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }

    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = CenterNotification::find($decodedId);
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


            return view('admin.notifications.centres.center-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $notification = CenterNotification::findOrFail($id);
            $notification->start_date = basicDateFormat($notification->start_date);
            $notification->end_date = basicDateFormat($notification->start_date);
            // Return raw date format for edit form
            $notificationData = $notification->toArray();
            return success_response($notificationData, 'Notification view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }
}
