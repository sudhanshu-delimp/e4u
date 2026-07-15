<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class AdvertiserReviewsController extends Controller
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
    public function index(Request $request)
    {
        [$advertiserReports, $reports] = $this->getAdvertiserReviews();

        return view('admin.advertiser-reviews', [
            'advertiserReports' => $advertiserReports,
            'reports' => $reports
        ]);
    }

    public function getReviewsByAjax()
    {
        [$advertiserReviews, $reports] = $this->getAdvertiserReviews();

        return DataTables::of($advertiserReviews)

            ->addColumn('ref', function ($row) {

                if ($row->advertiser_type == 'escort') {
                    return $row->id . (optional($row->escort)->id ?? '');
                }

                if ($row->advertiser_type == 'massage') {
                    return $row->id . (optional($row->massage)->id ?? '');
                }

                return $row->id;
            })

            ->addColumn('date', fn($row) => date('d-m-Y', strtotime($row->created_at)))

            ->addColumn('escort_id', function ($row) {

                if ($row->advertiser_type == 'escort') {
                    return optional(optional($row->escort)->user)->member_id ?? '-';
                }

                if ($row->advertiser_type == 'massage') {
                    return optional(optional($row->massage)->user)->member_id ?? '-';
                }

                return '-';
            })

            ->addColumn('viewer_id', fn($row) => $row->user->member_id ?? '-')

            ->addColumn('mobile', fn($row) => $row->user->phone ?? '-')

            ->addColumn('status', function ($row) {

                $statusText = $row->status ? Str::title($row->status) : 'Pending';
                $badgeClass = getStatusBadgeClass($statusText);

                return "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
            })

            ->addColumn('action', function ($row) {

                $advertiserMemberId = '-';

                if ($row->advertiser_type == 'escort') {
                    $advertiserMemberId = optional(optional($row->escort)->user)->member_id ?? '-';
                }

                if ($row->advertiser_type == 'massage') {
                    $advertiserMemberId = optional(optional($row->massage)->user)->member_id ?? '-';
                }

                $statusActionHtml = '
                <div class="dropdown no-arrow ml-3">
                    <a class="dropdown-toggle update-review-status" href="#" role="button"
                        data-toggle="dropdown">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>

                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">';

                if ($this->editAccessEnabled) {

                    if ($row->status !== 'pending') {
                        $statusActionHtml .= '
                        <a class="dropdown-item update-review-status"
                            data-id="' . $row->id . '" 
                            data-ref="' . $row->id . $advertiserMemberId . '"
                            data-value="pending"
                            data-toggle="modal"
                            data-target="#confirm-popup">
                            <i class="fa fa-hourglass-half text-dark"></i> Pending
                        </a>
                        <div class="dropdown-divider"></div>';
                    }

                    if ($row->status !== 'published') {
                        $statusActionHtml .= '
                        <a class="dropdown-item update-review-status"
                            data-id="' . $row->id . '"
                            data-ref="' . $row->id . $advertiserMemberId . '"
                            data-value="published"
                            data-toggle="modal"
                            data-target="#confirm-popup">
                            <i class="fa fa-check-circle text-dark"></i> Publish
                        </a>
                        <div class="dropdown-divider"></div>';
                    }

                    if ($row->status !== 'rejected') {
                        $statusActionHtml .= '
                        <a class="dropdown-item update-review-status"
                            data-id="' . $row->id . '"
                            data-ref="' . $row->id . $advertiserMemberId . '"
                            data-value="rejected"
                            data-toggle="modal"
                            data-target="#confirm-popup">
                            <i class="fa fa-ban text-dark"></i> Reject
                        </a>
                        <div class="dropdown-divider"></div>';
                    }
                }

                $statusActionHtml .= '
                    <a class="dropdown-item view_member_report"
                        href="#" data-id="' . $row->id . '">
                        <i class="fa fa-eye text-dark"></i> View
                    </a>
                    </div>
                </div>';

                return $statusActionHtml;
            })->rawColumns(['action', 'status'])
            ->with([
                'reports' => $reports,
                'server_up_time' => $this->getAppUptime(),
                'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
            ])
            ->make(true);
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

    private function getAdvertiserReviews()
    {
        $timezone   = $this->getUserTimezone();

        $today      = Carbon::now($timezone)->startOfDay();
        $monthStart = Carbon::now($timezone)->startOfMonth();
        $yearStart  = Carbon::now($timezone)->startOfYear();

        # Use query filters instead of collection filters
        $todayCount = Reviews::whereDate('created_at', $today)->count();
        $monthCount = Reviews::where('created_at', '>=', $monthStart)->count();
        $yearCount  = Reviews::where('created_at', '>=', $yearStart)->count();
        $allCount   = Reviews::count();

        # If you still want to return reviews with relations

        /*  $advertiserReviews = Reviews::with(['escort','massage','user'])
        ->orderByRaw("FIELD(status, 'pending','published','rejected','suspended')")
        ->orderBy('updated_at', 'desc')
        ->get(); */

        $advertiserReviews = Reviews::with(['escort', 'massage', 'user'])
            ->orderByRaw("
                    CASE
                        WHEN status = 'pending' THEN 1
                        WHEN status = 'published' THEN 2
                        WHEN status = 'rejected' THEN 3
                        ELSE 4
                    END
                ")
            ->orderByRaw("
                    CASE
                        WHEN status = 'pending' THEN created_at
                    END ASC
                ")
            ->orderByRaw("
                    CASE
                        WHEN status IN ('published', 'rejected') THEN created_at
                    END DESC
                ")
            ->get();


        //$advertiserReviews = Reviews::with(['escort','user'])->orderByRaw("FIELD(status, 'pending','published','rejected','suspended')")->orderBy('updated_at', 'desc')->get();

        $reports = [
            'today'    => $todayCount,
            'month'    => $monthCount,
            'year'     => $yearCount,
            'all_time' => $allCount,
        ];

        return [$advertiserReviews, $reports];
    }


    /**
     * Determine timezone based on user or fallback.
     */
    private function getUserTimezone()
    {
        $user = Auth::user();
        if ($user && $user->state_id) {
            //return config("escorts.profile.states.$user->state_id.timeZone");
        }
        return config('app.escort_server_timezone');
    }

    public function getSingleMemberEscortReviews(Request $request)
    {
        $user = Auth::user();
        if (!($user && $user->id)) {
            $data = array(
                "status"     => 404,
                "error"     => true,
                "message"    => "You are not authorized user!",
                "data" => [],
            );
        } else {

            $report = Reviews::where('id', $request->review_id)
                ->with([
                    'escort:id,user_id,city_id,state_id,name',
                    'escort.user:id,member_id',
                    'user:id,email,phone,state_id,member_id',
                ])
                ->first();

            //dd($report);

            if ($report) {
                $report->formatted_created_at = $report->created_at->format('d-m-Y');
                $report->user->state_id = $report->user->home_state;
            }

            $data = array(
                "status"     => 200,
                "error"     => false,
                "message"    => "Reviews report successfully fetched.",
                "data" => $report != null ? $report : null,
            );
        }

        return response()->json($data);
    }

    public function printSingleMemberEscortReviews(Request $request)
    {
        $report_id = $request->report_id;
        $user = Auth::user();
        if (!($user && $user->id)) {
            $data = array(
                "status"     => 404,
                "error"     => true,
                "message"    => "You are not authorized user!",
                "data" => [],
            );

            return $data;
        } else {
            $report = Reviews::where('id', $request->report_id)
                ->with([
                    'escort:id,user_id,city_id,state_id,name',
                    'escort.user:id,member_id',
                    'user:id,email,phone,state_id,member_id',
                ])
                ->first();

            if ($report) {
                $report->formatted_created_at = $report->created_at->format('d-m-Y');
                $report->user->state_id = $report->user->home_state;
            }

            return view('admin.prints_file.advertiser_review_report_print', ['report' => $report]);
        }
    }

    public function updateMemberReviewsStatus(Request $request)
    {
        $review_id = $request->review_id;
        $status = $request->status;

        $user = Auth::user();
        if (!($user && $user->id)) {
            $data = array(
                "status"     => 404,
                "error"     => true,
                "message"    => "You are not authorized user!",
                "data" => [],
            );

            return $data;
        } else {

            $reportStatus = Reviews::where('id', $review_id)->update([
                'status' => $status
            ]);

            $data = array(
                "status"     => 200,
                "member_status"     => $status,
                "error"     => false,
                "message"    => "Review status updated successfully.",
                "data" => $reportStatus != null ? $reportStatus : null,
            );
        }

        return response()->json($data);
    }
}
