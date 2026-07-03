<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\nums\num_on_hold_email;
use App\Mail\nums\num_published_email;
use App\Mail\nums\num_rejected_email;
use App\Models\Punterbox;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class AdminPunterBoxController extends Controller
{
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');
            $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
    }

   
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
                ->addColumn('escorts_name', fn($row) => $row->user->name ?? 'N/A')
                ->addColumn('incident_date', function ($row) {
                    return $row->incident_date
                        ? Carbon::parse($row->incident_date)->format('d-m-Y')
                        : '';
                })
                ->addColumn('location', function ($row) {
                    if ($row->incident_state) {
                        $states = config('escorts.profile.states')[$row->incident_state] ?? null;
                        return $states['stateName'] ?? 'N/A';
                    }
                    return 'N/A';
                })

                ->addColumn('status', function ($row) {
                    $statusText = $row->status
                        ? Str::title(Str::replace('_', ' ', $row->status))
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
                ->with([
                    'server_up_time' => $this->getAppUptime(),
                    'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
                    'counts' => $counts,
                ])
                ->make(true);
        }
        return view('admin.reports.punterbox', ['punterbox' => $punterbox]);
    }


    public function getAppUptime()
    {
        $startTime = Cache::get('app_start_time');
        $str = '';

        if (!$startTime) {
            return 'App start time not available.';
        }

        $start = \Carbon\Carbon::parse($startTime);
        $now = now();

        $diffInSeconds = $now->diffInSeconds($start);

        $days = floor($diffInSeconds / 86400);
        $hours = floor(($diffInSeconds % 86400) / 3600);
        $minutes = floor(($diffInSeconds % 3600) / 60);
        $str .= $days . ' days & ' . $hours . ' hours ' . $minutes . ' minutes';

        return $str;
    }

    public function updateStatus(Request $req)
    {
        $report = Punterbox::with('user')->find($req->id);

        if (!$report) {
            return response()->json(['success' => false, 'error' => true, 'message' => 'Report not found.']);
        }

        $report->status = $req->status;
        $report->admin_action = $req->action_reason;
        $report->save();

        $body = [
            'ref' => '#' . $report->id,
            'name' => $report->user->name ?? 'UserID',
            'member_id' => $report->user->member_id ?? 'MemberID',
            'report_date' => Carbon::parse($report->created_at)->format('d-m-Y') ?? date(),
            'subject' => 'NUM report On Hold',
            'status' => $req->status,
        ];

        if ($req->status == 'on_hold') {

            $body['subject'] = 'NUM Report On Hold';
            $body['on_hold'] = Carbon::now()->format('d-m-Y') ?? 'N/A';

            try {
                Mail::to($report->user->email)->send(new num_on_hold_email($body));
            } catch (\Exception $e) {
                Log::info('NUM On Hold Email sending failed: ' . $e->getMessage());
            }
        }

        if ($req->status == 'published') {
            $body['subject'] = 'NUM Report Published';
            $body['approved_date'] = Carbon::now()->format('d-m-Y') ?? 'N/A';


            try {
                Mail::to($report->user->email)->queue(new num_published_email($body));
            } catch (\Exception $e) {
                Log::info('NUM On published Email sending failed: ' . $e->getMessage());
            }
        }

        if ($req->status == 'rejected') {

            $body['subject'] = 'NUM Report Rejected';
            $body['rejected_date'] = Carbon::now()->format('d-m-Y') ?? 'N/A';
            $body['reason'] = $req->action_reason;

            try {
                Mail::to($report->user->email)->queue(new num_rejected_email($body));
            } catch (\Exception $e) {
                Log::info('NUM rejected Email sending failed: ' . $e->getMessage());
            }
        }

        return response()->json(['success' => true, 'error' => false, 'message' => 'Report status updated successfully.']);
    }

}
