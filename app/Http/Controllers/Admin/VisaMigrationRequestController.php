<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaMigration;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class VisaMigrationRequestController extends Controller
{
  public function index()
  {
    return view('admin.Concierge.visa-migration-request');
  }

  public function lists(Request $request)
  {
    $query = VisaMigration::with('user')->orderByRaw("
            CASE status
                WHEN 'pending' THEN 1
                WHEN 'on_hold' THEN 2
                WHEN 'in_progress' THEN 3
                WHEN 'completed' THEN 4
                ELSE 5
            END
        ");

    return DataTables::of($query)
      ->addIndexColumn()
      ->filterColumn('member_id', function ($query, $keyword) {
        $query->whereHas('user', function ($q) use ($keyword) {
          $q->where('member_id', 'like', "%{$keyword}%");
        });
      })
      ->filterColumn('visa_type', function ($query, $keyword) {
        $query->where('visa_type', 'like', "%{$keyword}%");
      })
      ->filterColumn('origin', function ($query, $keyword) {
        $query->where('origin', 'like', "%{$keyword}%");
      })
      ->addColumn('name', function ($row) {
        return $row->business_name ? $row->business_name : $row->first_name . " " . $row->last_name;
      })
      ->editColumn('contact_preference', function ($row) {
        return   collect(json_decode($row->contact_preference, true) ?? [])->map(fn($method) => ucfirst($method))->implode(' and ');
      })
      ->addColumn('order_date', function ($row) {
        return $row->created_at ? date('d-m-Y', strtotime($row->created_at)) : '--';
      })
      ->editColumn('member_id', function ($row) {
        return $row->user ? $row->user->member_id : '--';
      })
      ->editColumn('passport_country', function ($row) {
        return $row->passport_country ?? '-';
      })

      ->editColumn('area_type', function ($row) {
        return $row->area_type
          ? ucwords(str_replace('_', ' ', $row->area_type))
          : '-';
      })
      ->editColumn('status', function ($row) {
        if ($row->status == 'completed')
          $status =  '<span class="custom_badge badge_completed">Completed</span>';
        else if ($row->status == 'in_progress')
          $status =  '<span class="custom_badge badge_inProgress">In progress</span>';
        else if ($row->status == 'on_hold')
          $status =  '<span class="custom_badge badge_onHold">On Hold</span>';
        else
          $status =  '<span class="custom_badge badge_pending">Pending</span>';

        return $status;
      })

      ->addColumn('action', function ($row) {

        $actions = [];

        $actions[] = '<a href="#" 
        class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-status"
        data-id="' . $row->id . '"
        data-status="pending">
        <i class="fa fa-clock"></i> Pending
    </a>';

        $actions[] = '<a href="#" 
        class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-status"
        data-id="' . $row->id . '"
        data-status="on_hold">
        <i class="fa fa-pause"></i> On Hold
    </a>';

        $actions[] = '<a href="#" 
        class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-status"
        data-id="' . $row->id . '"
        data-status="in_progress">
        <i class="fa fa-spinner"></i> In Progress
    </a>';

        $actions[] = '<a href="#" 
        class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-status"
        data-id="' . $row->id . '"
        data-status="completed">
        <i class="fa fa-check"></i> Completed
    </a>';

        return '<div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>

        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">'
          . implode('<div class="dropdown-divider"></div>', $actions) .
          '</div>
    </div>';
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
  }
  public function updateStatus(Request $request)
  {
    $request->validate([
      'id' => 'required|integer|exists:visa_migrations,id',
      'status' => 'required|in:pending,in_progress,completed,on_hold',
    ]);

    try {

      $visaMigration = VisaMigration::findOrFail($request->id);

      $visaMigration->status = $request->status;
      $visaMigration->save();

      return response()->json([
        'success' => true,
        'message' => 'Status updated successfully.',
      ]);
    } catch (\Exception $e) {

      return response()->json([
        'success' => false,
        'message' => 'Unable to update status.',
      ], 500);
    }
  }
}
