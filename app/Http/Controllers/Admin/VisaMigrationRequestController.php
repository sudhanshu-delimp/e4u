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
    $query = VisaMigration::query()->orderBy('id','asc');

    return DataTables::of($query)
      ->addIndexColumn()

      ->editColumn('business_name', function ($row) {
        return $row->business_name ?? '-';
      })

      ->editColumn('contact_preference', function ($row) {
        return   collect(json_decode($row->contact_preference, true) ?? [])->map(fn($method) => ucfirst($method))->implode(' and ');
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
        else
          $status =  '<span class="custom_badge badge_pending">Pending</span>';

        return $status;
      })

      ->addColumn('action', function ($row) {
        $actions = [];

        // If suspended -> offer publish and remove
        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-publish" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Publish</a>';
        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
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
      ->rawColumns(['action', 'status'])

      // ->editColumn('visa_enquiry_type', function ($row) {
      //   return $row->visa_enquiry_type
      //     ? config(
      //       'escorts.visa_types.' . $row->visa_enquiry_type,
      //       $row->visa_enquiry_type
      //     )
      //     : '-';
      // })

      //   ->editColumn('comments', function ($row) {
      // return $row->comments ? Str::limit($row->comments, 30) : '-';
      //   })

      // ->editColumn('created_at', function ($row) {
      //   return $row->created_at
      //     ? $row->created_at->format('d-m-Y H:i')
      //     : '-';
      // })

      // ->editColumn('updated_at', function ($row) {
      //   return $row->updated_at
      //     ? $row->updated_at->format('d-m-Y H:i')
      //     : '-';
      // })



      ->make(true);
  }
}
