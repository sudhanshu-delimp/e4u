<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            ->addColumn('ref', fn($row) =>  $row->id . ($row->escort->id ?? ''))
            ->addColumn('date', fn($row) => date('d-m-Y', strtotime($row->created_at)))
            ->addColumn('escort_id', fn($row) => $row->escort->user->member_id ?? '-')
            ->addColumn('viewer_id', fn($row) => $row->user->member_id ?? '-')
            ->addColumn('mobile', fn($row) => $row->user->phone ?? '-')
          
            ->addColumn('status', fn($row) => Str::title($row->status) ?? 'Pending')
            // ->addColumn('review', fn($row) => $row->description != null && $row->description != '' ? Str::title($row->description) : '-')
            ->addColumn('action', function ($row) {

                $statusActionHtml = '
                    <div class="dropdown no-arrow ml-3">
                        <a class="dropdown-toggle update-review-status" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">';

                if ($this->editAccessEnabled) {
                // Pending option
                if ($row->status !== 'pending') {
                    $statusActionHtml .= '
                        <a class="dropdown-item update-review-status d-flex justify-content-start gap-10 align-items-center" data-id="'.$row->id.'" data-ref="'.$row->id.$row->escort_id.'" data-toggle="modal" data-target="#confirm-popup" href="#" data-value="pending">
                            <i class="fa fa-hourglass-half text-dark"></i> Pending
                        </a>
                        <div class="dropdown-divider"></div>';
                }

                // Published option
                if ($row->status !== 'published') {
                    $statusActionHtml .= '
                        <a class="dropdown-item update-review-status d-flex justify-content-start gap-10 align-items-center" 
                            href="#" data-toggle="modal" data-id="'.$row->id.'" data-ref="'.$row->id.$row->escort_id.'" data-value="published" data-target="#confirm-popup">
                            <i class="fa fa-check-circle text-dark"></i> Publish
                        </a>
                        <div class="dropdown-divider"></div>';
                }

                // Rejected option
                if ($row->status !== 'rejected') {
                    $statusActionHtml .= '
                        <a class="dropdown-item update-review-status d-flex justify-content-start gap-10 align-items-center" 
                            href="#" data-toggle="modal" data-id="'.$row->id.'" data-ref="'.$row->id.$row->escort_id.'" data-value="rejected" data-target="#confirm-popup">
                            <i class="fa fa-ban text-dark"></i> Reject
                        </a>
                        <div class="dropdown-divider"></div>';
                }
            }
                // Always show View option
                $statusActionHtml .= '
                        <a class="dropdown-item view_member_report d-flex justify-content-start gap-10 align-items-center"
                            href="#" data-id="'.$row->id.'">
                            <i class="fa fa-eye text-dark"></i> View
                        </a>
                    </div>
                </div>';

                return $statusActionHtml;
            })
            ->rawColumns(['action','status'])
             ->with([
                'reports' => $reports
            ])
            ->make(true);
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
        $advertiserReviews = Reviews::with(['escort','user'])->orderByRaw("FIELD(status, 'pending','published','rejected','suspended')")->orderBy('updated_at', 'desc')->get();

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
