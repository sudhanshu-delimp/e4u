<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CenterNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CenterNotificationController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $query = CenterNotification::query();

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

                    // Dynamic actions based on status
                    if ($row->status === 'Published') {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Removed</a>';
                    }

                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-view" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';
                    // $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-print" data-id="' . $row->id . '"><i class="fa fa-fw fa-print"></i> Print</a>';

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
                ->rawColumns(['action','start_date','finish_date'])
                ->make(true);
        }
        return view('admin.notifications.centres.index');
          
    }

    public function updateStatus(Request $request, $id){
        try {
            $notification = CenterNotification::findOrFail($id);
            if($notification->status !== 'Published'){
                return error_response('Only Published notifications can be removed.', 422);
            }
            $notification->status = 'Removed';
            $notification->save();
            return success_response(['id' => $notification->id, 'status' => $notification->status], 'Notification removed successfully.');
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function show($id){
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

    public function store(Request $request){
        $data =  $request->only(['heading','start_date', 'finish_date', 'type', 'content', 'member_id']);
        $start = Carbon::parse($data['start_date']);
        $end =  Carbon::parse($data['finish_date']);
        //Check condition 
        $query = CenterNotification::where(function($q) use ($start, $end){
                $q->whereBetween('start_date', [$start, $end])
                ->orWhereBetween('finish_date', [$start, $end])
                ->orWhere(function($q2) use ($start, $end){
                    $q2->where('start_date', '<=', $start)
                        ->where('finish_date', '>=', $end);
                    });
        });
        if($query->exists()){
             return error_response('A Notification already exists in the selected date range!', 422);
        }
        try {
            CenterNotification::create($data);
             return success_response($data, 'Notification create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
       
    }
}
