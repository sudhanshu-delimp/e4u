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
    $query = VisaMigration::query();

    return DataTables::of($query)
      ->addIndexColumn()

      ->editColumn('business_name', function ($row) {
        return $row->business_name ?? '-';
      })

      ->editColumn('contact_preference', function ($row) {
        return   collect(json_decode($row->contact_preference, true) ?? [])->map(fn($method) => ucfirst($method))->implode(' and ');
      })

      ->editColumn('email', function ($row) {
        return $row->email ?? '-';
      })

      ->editColumn('mobile', function ($row) {
        return $row->mobile ?? '-';
      })

      ->editColumn('passport_country', function ($row) {
        return $row->passport_country ?? '-';
      })

      ->editColumn('area_type', function ($row) {
        return $row->area_type
          ? ucwords(str_replace('_', ' ', $row->area_type))
          : '-';
      })

      ->editColumn('visa_enquiry_type', function ($row) {
        return $row->visa_enquiry_type
          ? config(
            'escorts.visa_types.' . $row->visa_enquiry_type,
            $row->visa_enquiry_type
          )
          : '-';
      })

      ->editColumn('comments', function ($row) {
    return $row->comments ? Str::limit($row->comments, 30) : '-';
      })

      ->editColumn('created_at', function ($row) {
        return $row->created_at
          ? $row->created_at->format('d-m-Y H:i')
          : '-';
      })

      ->editColumn('updated_at', function ($row) {
        return $row->updated_at
          ? $row->updated_at->format('d-m-Y H:i')
          : '-';
      })



      ->make(true);
  }
}
