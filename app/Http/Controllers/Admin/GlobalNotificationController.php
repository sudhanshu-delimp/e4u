<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\GlobalNotification;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class GlobalNotificationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = GlobalNotification::query();
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
                ->rawColumns(['action', 'start_date', 'end_date', 'ref'])
                ->make(true);
        }
        return view('admin.notifications.global.index');
        // return view('admin.notifications.global');
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $notification = GlobalNotification::findOrFail($id);
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
            $n = GlobalNotification::findOrFail($id);
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
            ]);
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $data =  $request->only(['heading', 'start_date', 'end_date', 'type', 'content', 'template_name', 'edit_notification_id']);
        $start = Carbon::parse($data['start_date']);
        $end =  Carbon::parse($data['end_date']);
        //Check condition 
        $notificationId = $request->edit_notification_id;

        if ($notificationId) {
            //dd($request->content);
            $update = GlobalNotification::find($notificationId);
            $update->heading = $request->heading;
            $update->content = $data['content'];
            $update->template_name = $request->template_name;
            $update->save();
            return success_response($data, 'Notification update successfully!!');
        }
        $query = GlobalNotification::where('status', '=', 'Published')->where(function ($q) use ($start, $end) {
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
            GlobalNotification::create($data);
            return success_response($data, 'Notification create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }

    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = GlobalNotification::find($decodedId);
            if (is_null($data)) {
                abort(404); // Throws a NotFoundHttpException
            }
            $pdfDetail['ref'] = $data['id'];
            $pdfDetail['heading'] = $data['heading'];
            $pdfDetail['type'] = $data['type'];
            $pdfDetail['status'] = $data['status'];
            $pdfDetail['start_date'] = basicDateFormat($data['start_date']);
            $pdfDetail['end_date'] = basicDateFormat($data['end_date']);
            if ($data['type'] == 'Template') {
                $pdfDetail['template_name'] = $data['template_name'];
            } else {
                $pdfDetail['content'] = $data['content'];
            }


            return view('admin.notifications.global.global-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $notification = GlobalNotification::findOrFail($id);
            // Return raw date format for edit form
            $notificationData = $notification->toArray();
            //$notificationData['start_date'] = basicDateFormat($notification->start_date);
            //$notificationData['end_date'] = basicDateFormat($notification->end_date);
            return success_response($notificationData, 'Notification view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }
}
