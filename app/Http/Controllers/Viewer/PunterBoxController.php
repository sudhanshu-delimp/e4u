<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Mail\punterbox\punterbox_confirmation_email;
use App\Models\Punterbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PunterBoxController extends Controller
{
    public function addReport()
    {
        $states = config('escorts.profile.states');

        return view('user.dashboard.punterbox.add-report', ['states' => $states]);
    }

    public function storeReport(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'incident_state'    => 'required',
            'incident_date'    => 'required',
            'incident_location' => 'required',
            'escorts_mobile'   => 'required|min:8|max:10',
            'incident_nature'   => 'required',
            'profile_link'      => 'nullable',
            'what_happened'     => 'required|string',
            'rating'            => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $timeZone = config('escorts.profile.states')[Auth::user()->state_id] ?? 'UTC';

        $incidentDate = Carbon::parse($request->incident_date)->setTimezone($timeZone['timeZone'])->format('Y-m-d');

        $punterbox = Punterbox::create([
            'user_id'    => Auth::user()->id,
            'incident_date'    => $incidentDate,
            'incident_state'    => $request->incident_state,
            'incident_location' => $request->incident_location,
            'escorts_name'     => $request->escorts_name,
            'escorts_mobile'   => $request->escorts_mobile,
            'escorts_name'    => $request->escorts_name,
            'escorts_email'    => $request->escorts_email,
            'incident_nature'   => $request->incident_nature,
            'platform'          => $request->platform ?? null, // remove this field after discussion with wayne
            'profile_link'      => $request->profile_link ?? null, // remove this field after discussion with wayne
            'what_happened'     => $request->what_happened,
            'status'            => 'pending',
            'rating'            => $request->rating,
        ]);

        $body = [
            'ref' => '#' . $punterbox->id,
            'name' => Auth::user()->name ?? Auth::user()->email,
            'member_id' => Auth::user()->member_id ?? 'MemberID',
            'report_date' => now()->setTimezone($timeZone['timeZone'])->format('d-m-Y'),
            'subject' => 'Confirmation of New Report - Punterbox',
            'status' => 'pending',
        ];

        if ($punterbox->status == 'pending') {
            try {
                Mail::to(Auth::user()->email)
                    ->queue(new punterbox_confirmation_email($body));
            } catch (\Exception $e) {
                Log::error('Email Queue Failed: ' . $e->getMessage());
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Incident report submitted successfully!',
            'data'    => $punterbox
        ]);
    }

    public function showReportOnDashboardAjax(Request $request)
    {
        $punterbox = PunterBox::where('status', 'published')->with('state')->orderBy('incident_date', 'desc')->get();

        if ($request->ajax()) {

            return DataTables::of($punterbox)
                ->addColumn('ref', fn($row) => '#' . $row->id)
                ->addColumn('escorts_mobile', function ($row) {
                    return formatPhone($row->escorts_mobile);
                })
                ->addColumn('incident_nature', fn($row) => formatLabelAttribute($row->incident_nature))
                ->addColumn('status', fn($row) => formatLabelAttribute($row->status))
                ->addColumn('rating', fn($row) => formatLabelAttribute($row->rating))
                ->addColumn('incident_date', function ($row) {
                    return $row->incident_date;
                })
                ->addColumn('location', function ($row) {
                    if ($row->incident_state) {
                        $states = config('escorts.profile.states')[$row->incident_state] ?? null;
                        return $states['stateName'] ?? 'N/A';
                    }
                    return '';
                })

                ->addColumn('actions', function ($row) {
                    return ' <a href="javascript:void(0);" class="toggle-details">
                                <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i>
                            </a>';
                })
                ->rawColumns(['ref', 'status', 'actions'])
                ->make(true);
        }

        return view('user.dashboard.punterbox.dashboard', ['punterbox' => $punterbox]);
    }

    public function showMyReportByAjax(Request $request)
    {
        $userId = Auth::user()->id;
        // $punterbox = Punterbox::where('user_id', $userId)->whereNotIn('status', ['pending'])->with('state')->orderBy('incident_date', 'desc')->get();
        $punterbox = Punterbox::where('user_id', $userId)
                ->whereNotIn('status', ['pending'])
                ->with('state')
                ->orderByRaw("
                    CASE status
                        WHEN 'on_hold' THEN 1
                        WHEN 'published' THEN 2
                        WHEN 'rejected' THEN 3
                        ELSE 4
                    END ASC
                ")
                ->orderByDesc('incident_date')
                ->get();
        $timeZone = config('escorts.profile.states')[Auth::user()->state_id] ?? 'UTC';

        # Date Filters
        $now = Carbon::now($timeZone['timeZone']);
        $today = $now->copy()->startOfDay();
        $monthStart = $now->copy()->startOfMonth();
        $yearStart = $now->copy()->startOfYear();

        # Summary Counts
        $counts = [
            'today' => Punterbox::where('user_id', $userId)->whereNotIn('status', ['pending'])
                ->whereDate('incident_date', $today->format('Y-m-d'))
                ->count(),

            'this_month' => Punterbox::where('user_id', $userId)->whereNotIn('status', ['pending'])
                ->whereBetween('incident_date', [$monthStart->format('Y-m-d'), $now->format('Y-m-d')])
                ->count(),

            'this_year' => Punterbox::where('user_id', $userId)->whereNotIn('status', ['pending'])
                ->whereYear('incident_date', $now->year)
                ->count(),

            'all_time' => Punterbox::where('user_id', $userId)->whereNotIn('status', ['pending'])->count(),
        ];

        if ($request->ajax()) {

            return DataTables::of($punterbox)
                ->addColumn('ref', fn($row) => '#' . $row->id)
                ->addColumn('escorts_mobile', function ($row) {
                    return formatPhone($row->escorts_mobile);
                })
                ->addColumn('incident_nature', fn($row) => formatLabelAttribute($row->incident_nature))
                ->addColumn('status', fn($row) => formatLabelAttribute($row->status))
                ->addColumn('rating', fn($row) => formatLabelAttribute($row->rating))
                ->addColumn('incident_date', function ($row) {
                    return $row->incident_date;
                })
                ->addColumn('location', function ($row) {
                    if ($row->incident_state) {
                        $states = config('escorts.profile.states')[$row->incident_state] ?? null;
                        return $states['stateName'] ?? 'N/A';
                    }
                    return '';
                })

                ->addColumn('status', function ($row) {
                    $statusText = $row->status
                        ? Str::title(Str::replace('_', ' ', $row->status))
                        : 'NA';
                    $badgeClass = getStatusBadgeClass($statusText);
                    return "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
                })

                ->addColumn('actions', function ($row) {
                    return '<div class="dropdown no-arrow"> 
                  <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> 
                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 edit_report" href="' . route('user.edit-my-reports', $row->id) . '" data-id="' . $row->id . '"> <i class="fa fa-pen"></i> Edit</a>
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 delete_report" href="#" data-id="' . $row->id . '"> <i class="fa fa-trash"></i> Delete</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view_report" href="#" data-id="' . $row->id . '"> <i class="fa fa-eye"></i> View</a>
                  </div></div>';
                })
                ->rawColumns(['ref', 'actions', 'status'])
                ->with($counts)
                ->make(true);
        }
    }

    public function editMyReport(Request $request, $id)
    {
        $states = config('escorts.profile.states');
        $punterbox = Punterbox::where('id', $id)->where('user_id', Auth::user()->id)->with('state')->first();

        return view('user.dashboard.punterbox.edit-report', ['punterbox' => $punterbox, 'states' => $states]);
    }

    public function updateMyReportByAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'incident_state'    => 'required',
            'incident_date'    => 'required',
            'incident_location' => 'required',
            'escorts_mobile'   => 'required|min:8|max:10',
            'incident_nature'   => 'required',
            'profile_link'      => 'nullable',
            'what_happened'     => 'required|string',
            'rating'            => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $punterbox = Punterbox::where('id', $request->id)->where('user_id', Auth::user()->id)
            ->update([
                'incident_state'    => $request->incident_state,
                'incident_date'    => $request->incident_date,
                'incident_location' => $request->incident_location,
                'escorts_name'     => $request->escorts_name,
                'escorts_mobile'   => $request->escorts_mobile,
                'escorts_email'    => $request->escorts_email,
                'incident_nature'   => $request->incident_nature,
                'platform'          => $request->platform ?? null,
                'profile_link'      => $request->profile_link ?? null,
                'what_happened'     => $request->what_happened,
                'rating'            => $request->rating,
                'status'            => 'pending',
            ]);

        return response()->json([
            'status'  => true,
            'message' => 'Incident report updated successfully!',
            'data'    => $punterbox
        ]);
    }


    public function destroy($id)
    {
        $report = PunterBox::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found.'
            ], 404);
        }

        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Report deleted successfully.'
        ]);
    }
}
