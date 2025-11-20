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
            $query = CenterNotification::query()->orderBy('created_at', 'DESC');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return sprintf('#%05d', $row->id);
                })
                ->editColumn('start_date', function ($row) {
                    return Carbon::parse($row['start_date'])->format('d-m-Y');
                })
                ->editColumn('finish_date', function ($row) {
                    return Carbon::parse($row['finish_date'])->format('d-m-Y');
                })
                ->editColumn('type', function ($row) {
                    return $row->type;
                })
                ->editColumn('status', function ($row) {
                    return $row->status;
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    // Example: you can add your own business logic for action buttons
                    if (($row->status ?? null) === 'Published') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Suspended</a>';
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

            // if ($notification->status !== 'Published') {
            //     return error_response('Only Published notifications can be modified.', 422);
            // }

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
                'start_date' => $n->start_date ? Carbon::parse($n->start_date)->format('d-m-Y') : null,
                'finish_date' => $n->finish_date ? Carbon::parse($n->finish_date)->format('d-m-Y') : null,
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
        $start = Carbon::parse($data['start_date']);
        $end =  Carbon::parse($data['end_date']);
        //Check condition 
        $notificationId = $request->edit_notification_id;
    
        if($notificationId){
            //dd($request->content);
            $update = CenterNotification::find($notificationId);
            $update->heading = $request->heading;
            $update->content = $data['content'];
            $update->template_name = $request->template_name;
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
            $pdfDetail['start_date'] = Carbon::parse($data['start_date'])->format('d-m-Y');
            $pdfDetail['finish_date'] = Carbon::parse($data['finish_date'])->format('d-m-Y');;
            $pdfDetail['template_name'] = $data['template_name'];
            return view('admin.notifications.centres.center-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $notification = CenterNotification::findOrFail($id);
            // Return raw date format for edit form
            $notificationData = $notification->toArray();
            $notificationData['start_date'] = $notification->start_date ? Carbon::parse($notification->start_date)->format('Y-m-d') : null;
            $notificationData['end_date'] = $notification->end_date ? Carbon::parse($notification->end_date)->format('Y-m-d') : null;
            $notificationData['finish_date'] = $notification->finish_date ? Carbon::parse($notification->finish_date)->format('d-m-Y') : null;
            return success_response($notificationData, 'Notification view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }

}
