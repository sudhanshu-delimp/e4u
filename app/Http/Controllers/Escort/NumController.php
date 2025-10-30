<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Num;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'offender_mobile'   => 'required',
            'incident_nature'   => 'required',
            'profile_link'      => 'nullable',
            'what_happend'     => 'required|string',
            'rating'            => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
            ], 422);
        }
       
        $num = Num::create([
            'user_id'    => Auth::user()->id,
            'incident_date'    => $request->incident_date,
            'incident_state'    => $request->incident_state,
            'incident_location' => $request->incident_location,
            'offender_name'     => $request->offender_name,
            'offender_mobile'   => $request->offender_mobile,
            'offender_email'    => $request->offender_email,
            'incident_nature'   => $request->incident_nature,
            'platform'          => $request->platform,
            'profile_link'      => $request->profile_link,
            'what_happened'     => $request->what_happened,
            'statue'            => true,
            'rating'            => $request->rating,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Incident report submitted successfully!',
            'data'    => $num
        ]);
    }

    public function showReportOnDashboard(Request $request)
    {
        $states = State::where('iso2', 'NOT REGEXP', '^[0-9]+$')->get();
        return view('escort.dashboard.UglyMugsRegister.add-report',['states' => $states]);
    }
}
