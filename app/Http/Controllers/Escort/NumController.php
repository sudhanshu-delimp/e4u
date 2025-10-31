<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Num;
use App\Models\State;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;

class NumController extends Controller
{
    public function addReport()
    {
        $states = State::where('iso2', 'NOT REGEXP', '^[0-9]+$')->get();
        return view('escort.dashboard.UglyMugsRegister.add-report',['states' => $states]);
    }

    public function storeReport(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'incident_state'    => 'required',
            'incident_date'    => 'required',
            'incident_location' => 'required',
            'offender_mobile'   => 'required|min:8',
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
       // dd( $incidentDate, Auth::user()->state_id);
        $num = Num::create([
            'user_id'    => Auth::user()->id,
            'incident_date'    => $incidentDate,
            'incident_state'    => $request->incident_state,
            'incident_location' => $request->incident_location,
            'offender_name'     => $request->offender_name,
            'offender_mobile'   => $request->offender_mobile,
            'offender_email'    => $request->offender_email,
            'incident_nature'   => $request->incident_nature,
            'platform'          => $request->platform,
            'profile_link'      => $request->profile_link,
            'what_happened'     => $request->what_happened,
            'status'            => 'reported',
            'rating'            => $request->rating,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Incident report submitted successfully!',
            'data'    => $num
        ]);
    }

    public function showReportOnDashboardAjax(Request $request)
    {
        $nums = Num::where('user_id',Auth::user()->id)->with('state')->get();

        if($request->ajax()){

           return DataTables::of($nums)
                ->addColumn('ref', fn($row) => '#' . $row->id)
                ->addColumn('offender_mobile', fn($row) => $row->offender_mobile)
                ->addColumn('incident_nature', fn($row) => $row->incident_nature)
                ->addColumn('incident_date', function($row) {
                    return $row->incident_date 
                        ? \Carbon\Carbon::parse($row->incident_date)->format('d-m-Y') 
                        : '';
                })
                ->addColumn('location', function($row) {
                    if ($row->state) {
                        return $row->state->iso2 . ' - ' . $row->state->name;
                    }
                    return '';
                })
                ->addColumn('actions', function($row) {
                    return '<a href="javascript:void(0);" class="toggle-details" data-target="details-' . $row->id . '">
                                <i class="fa fa-search" data-toggle="tooltip" title="View"></i>
                            </a>';
                })
                ->rawColumns(['ref','actions']) // only 'action' needs HTML rendering
                ->make(true);

        }

        return view('escort.dashboard.UglyMugsRegister.numdashboard',['nums'=>$nums]);
    }

    public function showMyReportByAjax(Request $request)
    {
        $userId = Auth::user()->id;
        $nums = Num::where('user_id',$userId)->with('state')->get();

        $timeZone = config('escorts.profile.states')[Auth::user()->state_id] ?? 'UTC';

        # Date Filters
        $now = Carbon::now($timeZone['timeZone']);
        $today = $now->copy()->startOfDay();
        $monthStart = $now->copy()->startOfMonth();
        $yearStart = $now->copy()->startOfYear();

        # Summary Counts
        $counts = [
            'today' => Num::where('user_id', $userId)
                ->whereDate('incident_date', $today->format('Y-m-d'))
                ->count(),

            'this_month' => Num::where('user_id', $userId)
                ->whereBetween('incident_date', [$monthStart->format('Y-m-d'), $now->format('Y-m-d')])
                ->count(),

            'this_year' => Num::where('user_id', $userId)
                ->whereBetween('incident_date', [$yearStart->format('Y-m-d'), $now->format('Y-m-d')])
                ->count(),

            'all_time' => Num::where('user_id', $userId)->count(),
        ];

        if($request->ajax()){

           return DataTables::of($nums)
                ->addColumn('ref', fn($row) => '#' . $row->id)
                ->addColumn('offender_mobile', fn($row) => $row->offender_mobile)
                ->addColumn('incident_nature', fn($row) => $row->incident_nature)
                ->addColumn('incident_date', function($row) {
                    return $row->incident_date 
                        ? Carbon::parse($row->incident_date)->format('d-m-Y') 
                        : '';
                })
                ->addColumn('location', function($row) {
                    if ($row->state) {
                        return $row->state->iso2 . ' - ' . $row->state->name;
                    }
                    return '';
                })
                ->addColumn('actions', function($row) {
                    return '<div class="dropdown no-arrow"> 
                  <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> 
                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-id="'.$row->id.'"> <i class="fa fa-pen"></i> Edit</a>
                  </div></div>';
                })
                ->rawColumns(['ref','actions']) // only 'action' needs HTML rendering
                ->with($counts)
                ->make(true);

        }

        return view('escort.dashboard.UglyMugsRegister.my-reports',['nums'=>$nums, 'counts'=>$counts]);
    }
}
