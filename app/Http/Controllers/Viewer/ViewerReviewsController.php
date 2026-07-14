<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
//use App\Models\MassageProfile;
use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
//use Illuminate\Support\Str;

class ViewerReviewsController extends Controller
{
    public function viewReviews(Request $request)
    {
        [$advertiserReports, $reports] = $this->getAdvertiserReviews();
        //dd($advertiserReports->toArray());

        return view('user.dashboard.Reviews.view-reviews', [
            'advertiserReports' => $advertiserReports,
            'reports' => $reports
        ]);
    }

    private function getUserTimezone()
    {
        $user = Auth::user();
        return config('app.escort_server_timezone');
    }

    private function getAdvertiserReviews()
    {
        $timezone   = $this->getUserTimezone();

        $today      = Carbon::now($timezone)->startOfDay();
        $monthStart = Carbon::now($timezone)->startOfMonth();
        $yearStart  = Carbon::now($timezone)->startOfYear();
        $userId = Auth::id();
   
        $reviews = collect();
        $todayCount = $monthCount = $yearCount = $allCount = 0;

        if ($userId) {
            /* $reviews = Reviews::where('user_id', $userId)
                //->whereIn('status', ['published','pending'])
                ->with(['massage', 'user', 'escort'])
                ->orderBy('status','desc')
                ->get(); */

            $reviews = Reviews::where('user_id', $userId)
            ->with(['escort', 'massage', 'user'])
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

            // Counts directly from DB instead of filtering collection
            $todayCount = Reviews::where('user_id', $userId)
                ->whereIn('status', ['published','pending','rejected'])
                ->whereDate('created_at', $today)
                ->count();

            $monthCount = Reviews::where('user_id', $userId)
                ->whereIn('status', ['published','pending','rejected'])
                ->where('created_at', '>=', $monthStart)
                ->count();

            $yearCount = Reviews::where('user_id', $userId)
                ->whereIn('status', ['published','pending','rejected'])
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

    public function getProfileReviewsByAjax()
    {
        [$advertiserReviews, $reports] = $this->getAdvertiserReviews();
            
        return DataTables::of($advertiserReviews)
            ->addColumn('ref',  function($row){
                if($row->advertiser_type == 'escort') {
                    return $row->escort->member_id;
                }
                 return $row->massage->member_id;
            })
            ->addColumn('date', fn($row) => date('d-m-Y', strtotime($row->created_at)))
            ->addColumn('rating', function($row){

                $starRating = '<div class="escort-ratings text-center">';
                
                $rate = (int) $row->star_rating;
                for($i=1; $i <= 5; $i++){
                    if($i <= $rate){
                        $starRating .= '<li><i class="fa fa-star"></i></li>';
                    } else {
                        $starRating .= '<li><i class="far fa-star"></i></li>';
                    }
                }

                $starRating .= '</div>';

                return $starRating;

            })
            ->addColumn('status', function($row){
                $status = '<span class="custom_badge badge_published">Published </span>';
                if($row->status == 'suspended') {
                    $status = '<span class="custom_badge badge_suspended">Suspended</span>';
                } else if($row->status == 'pending') {
                    $status = '<span class="custom_badge badge_pending">Pending</span>';
                } else if($row->status == 'rejected') {
                    $status = '<span class="custom_badge badge_rejected">Rejected</span>';
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
                    'massage:id,user_id,city_id,state_id,business_name,profile_name,name',
                    'massage.user:id,phone,state_id,member_id',
                    'escort:id,user_id,city_id,state_id,name',
                    'escort.user:id,phone,state_id,member_id',
                    'user:id,email,phone,state_id,name,member_id',
                ])
                ->first();
                
            if ($report) {
                $report->formatted_created_at = $report->created_at->format('d-m-Y');
                 $report->user->state_id = $report->user->home_state;
                 if($report->advertiser_type == 'escort'){
                      $report->escort->user->state_id = $report->escort->user->home_state;
                } else {
                      $report->massage->user->state_id = $report->massage->user->home_state;
                }
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
