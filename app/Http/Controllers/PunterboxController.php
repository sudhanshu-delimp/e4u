<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Punterbox;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

class PunterboxController extends Controller
{
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    /**
     * Store new report (AJAX)
     */

     public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;
            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');
        
            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
    }

    public function storePunterboxReport(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'incident_state'     => 'required|string',
            'incident_date'      => 'required|date',
            'incident_location'  => 'required|string',
            'escort_mobile'    => 'required|digits_between:8,15',
            'incident_nature'    => 'required|string',
            'profile_link'       => 'nullable|url',
            'what_happened'      => 'required|string|min:10',
            'rating'             => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $timeZone = config('escorts.profile.states')[Auth::user()->state_id] ?? ['timeZone' => 'UTC'];

        $incidentDate = Carbon::parse($request->incident_date)
            ->setTimezone($timeZone['timeZone'])
            ->format('Y-m-d');


        // Create Report
        $report = Punterbox::create([
            'user_id'           => Auth::id(),
            'incident_date'     => $incidentDate,
            'incident_state'    => $request->incident_state,
            'incident_location' => $request->incident_location,
            'escort_name'     => $request->escort_name ?? null,
            'escort_mobile'   => $request->escort_mobile,
            'escort_email'    => $request->escort_email ?? null,
            'incident_nature'   => $request->incident_nature,
            'platform'          => $request->platform ?? null,
            'profile_link'      => $request->profile_link ?? null,
            'what_happened'     => $request->what_happened,
            'rating'            => $request->rating,
            'status'            => 1, // Pending
        ]);

        // Email Body
        // $body = [
        //     'ref'         => $referenceNumber,
        //     'name'        => Auth::user()->name ?? 'User',
        //     'member_id'   => Auth::user()->member_id ?? 'MemberID',
        //     'report_date' => now()->setTimezone($timeZone['timeZone'])->format('d-m-Y'),
        //     'subject'     => 'Punterbox Report Confirmation',
        //     'status'      => 'Pending Approval',
        // ];

        // Send Confirmation Email
        // try {
        //     Mail::to(Auth::user()->email)
        //         ->send(new PunterboxConfirmationMail($body));
        // } catch (\Exception $e) {
        //     Log::info('Punterbox Email sending failed: ' . $e->getMessage());
        // }

        return response()->json([
            'status'  => true,
            'message' => 'Punterbox report submitted successfully and is pending approval.',
            'data'    => $report
        ]);
    }


    /**
     * List all reports (Admin)
     */
    public function showReportOnDashboardAjax(Request $request)
    {
        $punterbox = Punterbox::with(['state', 'user:id,member_id,name'])->orderBy('incident_date', 'desc')->get();
        $timeZone = isset(config('escorts.profile.states')[Auth::user()->state_id]) ?? 'Australia/Sydney';

        # Date Filters
        $now = Carbon::now(($timeZone['timeZone']) ?? 'Australia/Sydney');
        $today = $now->copy()->startOfDay();
        $monthStart = $now->copy()->startOfMonth();
        $yearStart = $now->copy()->startOfYear();

        # Summary Counts
        $counts = [
            'today' => Punterbox::whereDate('incident_date', $today->format('Y-m-d'))
                ->count(),

            'this_month' => Punterbox::whereBetween('incident_date', [$monthStart->format('Y-m-d'), $now->format('Y-m-d')])
                ->count(),

            'this_year' => Punterbox::whereBetween('incident_date', [$yearStart->format('Y-m-d'), $now->format('Y-m-d')])
                ->count(),

            'all_time' => Punterbox::all()->count(),
        ];

        if ($request->ajax()) {

            return DataTables::of($punterbox)
                ->addColumn('ref', fn($row) => '#' . $row->id)
                ->addColumn('member_id', fn($row) => $row->user->member_id ?? 'N/A')
                ->addColumn('member_name', fn($row) => $row->user->name ?? 'N/A')
                ->addColumn('incident_date', function ($row) {
                    return $row->incident_date;
                })
                ->addColumn('location', function ($row) {
                    if ($row->incident_state) {
                        $states = config('escorts.profile.states')[$row->incident_state] ?? null;
                        return $states['stateName'] ?? 'N/A';
                    }
                    return 'N/A';
                })

                ->addColumn('status', function ($row) {
                    $statusText = $row->status_text
                        ? Str::title(Str::replace('_', ' ', $row->status_text))
                        : 'NA';
                    $badgeClass = getStatusBadgeClass($statusText);
                    return "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
                })
                ->addColumn('actions', function ($row) {

                    // Define all possible actions
                    $actions = [
                        'pending'   => ['icon' => 'fa-pause-circle', 'label' => 'Pending'],
                        'on_hold'   => ['icon' => 'fa-pause-circle', 'label' => 'On Hold'],
                        'published' => ['icon' => 'fa-check-circle', 'label' => 'Publish'],
                        'rejected'  => ['icon' => 'fa-times-circle', 'label' => 'Reject'],
                    ];

                    $html = '<div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                                    aria-labelledby="dropdownMenuLink">';

                    // Loop through all actions except the current status
                    if ($this->editAccessEnabled) {
                        foreach ($actions as $status => $data) {
                            if ($row->status !== $status) {
                                $html .= '<a class="dropdown-item d-flex align-items-center gap-10 justify-content-start update_status"
                                        data-id="' . $row->id . '" 
                                        data-status="' . $status . '" 
                                        href="#" 
                                        data-toggle="modal" 
                                        data-target="#confirm-popup">
                                        <i class="fa ' . $data['icon'] . '"></i> ' . $data['label'] . '
                                    </a>
                                    <div class="dropdown-divider"></div>';
                            }
                        }
                    }

                    // Always show "View Report" option
                    $html .= '<a class="dropdown-item d-flex align-items-center gap-10 justify-content-start view_report" 
                                data-id="' . $row->id . '" 
                                href="#" 
                                data-toggle="modal" 
                                data-target="#reject_popup">
                                <i class="fa fa-eye"></i> View Report
                            </a>';

                    $html .= '</div></div>';

                    return $html;
                })
                ->rawColumns(['ref', 'actions', 'status']) // only 'action' needs HTML rendering
                ->with($counts)
                ->make(true);
        }

        return view('admin.reports.punterbox', ['nums' => $punterbox]);
    }
}
