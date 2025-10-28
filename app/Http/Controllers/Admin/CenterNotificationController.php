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
                    return optional($row->start_date)->format('Y-m-d');
                })
                ->editColumn('finish_date', function ($row) {
                    return optional($row->finish_date)->format('Y-m-d');
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
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-print" data-id="' . $row->id . '"><i class="fa fa-fw fa-print"></i> Print</a>';

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
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.notifications.centres.index');
          
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
