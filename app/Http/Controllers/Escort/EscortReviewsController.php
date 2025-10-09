<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Str;

class EscortReviewsController extends Controller
{
    public function viewReviews(Request $request)
    {
        [$advertiserReports, $reports] = $this->getAdvertiserReviews();

        return view('escort.dashboard.Reviews.view-reviews', [
            'advertiserReports' => $advertiserReports,
            'reports' => $reports
        ]); 
    }

    private function getUserTimezone()
    {
        $user = Auth::user();
        if ($user && $user->state_id) {
            //return config("escorts.profile.states.$user->state_id.timeZone");
        }
        return config('app.escort_server_timezone');
    }

    private function getAdvertiserReviews()
    {
        $timezone   = $this->getUserTimezone();

        $today      = Carbon::now($timezone)->startOfDay();
        $monthStart = Carbon::now($timezone)->startOfMonth();
        $yearStart  = Carbon::now($timezone)->startOfYear();

        $userEscortsProfile = Escort::where('user_id', Auth::id())
            ->whereNotNull('profile_name')
            ->where('enabled', 1)
            ->pluck('id');

        $reviews = collect();
        $todayCount = $monthCount = $yearCount = $allCount = 0;

        if ($userEscortsProfile->isNotEmpty()) {
            $reviews = Reviews::whereIn('escort_id', $userEscortsProfile)
                ->whereIn('status', ['published','suspended'])
                ->with(['escort', 'user'])
                ->orderBy('status','desc')
                ->get();

            // Counts directly from DB instead of filtering collection
            $todayCount = Reviews::whereIn('escort_id', $userEscortsProfile)
                ->whereIn('status', ['published','suspended'])
                ->whereDate('created_at', $today)
                ->count();

            $monthCount = Reviews::whereIn('escort_id', $userEscortsProfile)
                ->whereIn('status', ['published','suspended'])
                ->where('created_at', '>=', $monthStart)
                ->count();

            $yearCount = Reviews::whereIn('escort_id', $userEscortsProfile)
                ->whereIn('status', ['published','suspended'])
                ->where('created_at', '>=', $yearStart)
                ->count();

            $allCount = $reviews->count();
        }

        $reports = [
            'today'    => $todayCount,
            'month'    => $monthCount,
            'year'     => $yearCount,
            'all_time' => $allCount,
        ];

        return [$reviews, $reports];
    }

    public function getEscortProfileReviewsByAjax()
    {
        [$advertiserReviews, $reports] = $this->getAdvertiserReviews();
            
        return DataTables::of($advertiserReviews)
            ->addColumn('ref', fn($row) =>  $row->id . ($row->escort->id ?? ''))
            ->addColumn('date', fn($row) => date('d-m-Y', strtotime($row->created_at)))
            ->addColumn('rating', function($row){

                $starRating = '<div class="escort-ratings text-center">';

                for($i=1; $i <= 5; $i++){
                    if($row->star_rating <= $i){
                        $starRating .= '<li><i class="far fa-star"></i></li>';
                    } else {
                        $starRating .= '<li><i class="fa fa-star"></i></li>';
                    }
                }

                $starRating .= '</div>';

                return $starRating;

            })
            ->addColumn('status', function($row){
                $status = '<span class="badge badge-success">Published </span>';
                if($row->status == 'suspended'){
                    $status = '<span class="badge badge-danger">Suspended</span>';
                }

                return $status;
            })
            ->addColumn('action', function ($row) {

                $statusActionHtml = '
                    <div class="dropdown no-arrow text-center">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">';

                    // Pending option
                    if ($row->status !== 'suspended') {
                        $statusActionHtml .= '
                            <a class="dropdown-item update-review-status d-flex justify-content-start gap-10 align-items-center" data-review-id="'.$row->id.'" data-ref="'.$row->id.$row->escort_id.'" data-toggle="modal"  href="#" data-status="suspended">
                                <i class="fa fa-hourglass-half text-dark"></i> Suspend
                            </a>
                            <div class="dropdown-divider"></div>';
                    }

                    // Published option
                    if ($row->status !== 'published') {
                        $statusActionHtml .= '
                            <a class="dropdown-item update-review-status d-flex justify-content-start gap-10 align-items-center" 
                                href="#" data-toggle="modal" data-review-id="'.$row->id.'" data-ref="'.$row->id.$row->escort_id.'" data-status="published"> 
                                <i class="fa fa-check-circle text-dark"></i> Publish
                            </a>
                            <div class="dropdown-divider"></div>';
                    }

                    // Always show View option
                    $statusActionHtml .= '
                            <a class="dropdown-item view_member_report toggle-report d-flex justify-content-start gap-10 align-items-center"
                                href="#" data-id="'.$row->id.'">
                                <i class="fa fa-eye text-dark"></i> View
                            </a>
                        </div>
                    </div>';

                return $statusActionHtml;
            })
            ->rawColumns(['action','rating','status'])
             ->with([
                'reports' => $reports
            ])
            ->make(true);
    }

    public function getSingleUserReviewDetails($id)
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

            $report = Reviews::where('id', $id)
                ->with([
                    'escort:id,user_id,city_id,state_id,name',
                    'escort.user:id,phone,state_id',
                    'user:id,email,phone,state_id,name',
                ])
                ->first();
                
            if ($report) {
                $report->formatted_created_at = $report->created_at->format('d-m-Y');
                $report->user->state_id = $report->user->home_state;
                $report->escort->user->state_id = $report->escort->user->home_state;
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

     public function updateUserReviewStatus(Request $request)
    {
        $user = Auth::user();

        if ($user == null) {
            return response()->json(['status' => 'error', 'message' => 'User is not authenticate.'], 400);
        }
        
        $reviews = Reviews::where('id', $request->review_id)->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => $reviews ? 'success' : 'error',
            'error' => $reviews ? false : true,
            'review_status' => $request->status,
            'message'=> 'Review '.$request->status.' successfully.'
        ],200);

    }

}
