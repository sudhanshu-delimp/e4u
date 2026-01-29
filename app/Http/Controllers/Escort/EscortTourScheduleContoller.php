<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Models\Tour;
use App\Models\TourLocation;
use App\Models\TourProfile;
use App\Models\Purchase;
use App\Models\Escort;
use App\Models\EscortPinup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Tour\TourInterface;

class EscortTourScheduleContoller extends Controller
{
    protected $tour;

    public function __construct(TourInterface $tour)
    {
       
        $this->tour = $tour;
    }

    public function index()
    {
        $tourIds =  Tour::where('user_id', auth()->id())->pluck('id')->toArray();
        $tours = TourLocation::whereIn('tour_id', $tourIds)
            ->with('state','tour')
            ->get()
            ->sortBy(function ($tour) {
                $today = Carbon::today()->toDateString();

                if ($tour->start_date <= $today && $tour->end_date >= $today && $tour->status != 'cancelled') {
                    // Current tours
                    return 1;
                } elseif ($tour->start_date > $today && $tour->status != 'cancelled') {
                    // Upcoming tours
                    return 2;
                } elseif($tour->start_date < $today && $tour->status != 'cancelled') {
                    // Completed tours
                    return 3;
                }else{
                    // cancelled tours
                    return 4;
                }
            })
            ->values();
        return view('escort.dashboard.tour-schedule',['tours' => $tours]);
    }

    public function getTourScheduleByAjax(Request $request)
    {
        $tourIds = Tour::where('user_id', auth()->id())->pluck('id')->toArray();

        $tourSchedules = TourLocation::whereIn('tour_id', $tourIds)
            ->with(['state', 'tour'])
            ->get()
            ->sortBy(function ($tour) {
                $today = Carbon::today()->toDateString();

                if ($tour->start_date <= $today && $tour->end_date >= $today && $tour->status != 'cancelled') {
                    return 1; // Current
                } elseif ($tour->start_date > $today && $tour->status != 'cancelled') {
                    return 2; // Upcoming
                } elseif ($tour->start_date < $today && $tour->status != 'cancelled') {
                    return 3; // Completed
                } else {
                    return 4; // Cancelled
                }
            })
            ->values();

        return datatables()->of($tourSchedules)
            ->addColumn('state_name', fn($tour) => '<i class="fas fa-circle mr-2" style="color:' . sprintf('#%06X', mt_rand(0, 0xFFFFFF)) . '"></i>' . e($tour->state->name))
            ->addColumn('tour_name', fn($tour) => e(optional($tour->tour)->name ?? 'N/A'))
            ->addColumn('days', fn($tour) => Carbon::parse($tour->end_date)->diffInDays(Carbon::parse($tour->start_date)) + 1)
            ->addColumn('start_date', fn($tour) => Carbon::parse($tour->start_date)->format('d-m-Y'))
            ->addColumn('end_date', fn($tour) => Carbon::parse($tour->end_date)->format('d-m-Y'))
            ->addColumn('status_badge', function ($tour) {
                $today = Carbon::today();
                $start = Carbon::parse($tour->start_date);
                $end = Carbon::parse($tour->end_date);

                if ($tour->status === 'cancelled') {
                    return '<span class="badge bg-danger task-1 w-75">Cancelled</span>';
                } elseif ($today->between($start, $end)) {
                    return '<span class="badge bg-warning task-1 w-75">Current</span>';
                } elseif ($today->lt($start)) {
                    return '<span class="badge bg-info task-1 w-75">Upcoming</span>';
                } else {
                    return '<span class="badge bg-success task-1 w-75">Completed</span>';
                }
            })
            ->addColumn('actions', function ($tour) {
                $today = Carbon::today();
                $start = Carbon::parse($tour->start_date);
                $end = Carbon::parse($tour->end_date);

                $tourStatus = 'past';
                if ($today->between($start, $end)) $tourStatus = 'current';
                elseif ($today->lt($start)) $tourStatus = 'upcoming';

                $actions = '<div class="dropdown no-arrow text-center">
                                <a class="dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">';

                $actions .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 " href="' . route('escort.view.tour.list', $tourStatus) . '"><i class="fa fa-eye"></i> View</a>';

                if ($tourStatus != 'past') {
                    $actions .= '<div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="' . route('escort.view.tour.list', $tourStatus) . '"><i class="fa fa-pen"></i> Edit</a>';
                }

                if ($tour->status != 'cancelled') {
                    $actions .= '<div class="dropdown-divider"></div>
                                <a class="dropdown-item cancelTour d-flex align-items-center justify-content-start gap-10" href="#" data-tour-id="' . $tour->id . '" data-toggle="modal" data-target="#new-ban-3">
                                    <i class="fa fa-times"></i> Cancel
                                </a>';
                } else {
                    $actions .= '<div class="dropdown-divider"></div>
                                <a class="dropdown-item text-muted d-flex align-items-center justify-content-start gap-10" href="#" style="background:#e7e7e7;cursor:not-allowed;">
                                    <i class="fa fa-times text-muted"></i> Cancel
                                </a>';
                }

                $actions .= '<div class="dropdown-divider"></div>
                            <a class="dropdown-item showTourSummary d-flex align-items-center justify-content-start gap-10" href="#" data-tour-id="' . $tour->id . '">
                                <i class="fa fa-list"></i> Tour Summary
                            </a>
                        </div></div>';

                return $actions;
            })
            ->rawColumns(['state_name', 'status_badge', 'actions'])
            ->make(true);
    }


    public function updateTourScheduleStatus(Request $request) 
    {
        $status = TourLocation::where('id', $request->tour_id)
            ->update(['status' => $request->status]);

        return response()->json([
            'status' => $status ? 'success' : 'error', 
            'message' => 'Your Tour has been cancelled and all Profiles associated with the Tour removed from the Website', 
            'data' => $request->status,
            'type' => 'cancel_tour'
        ]);
    }   
    public function getTourSummaryAjax(Request $request) 
    {
        $tour = TourLocation::where('id', $request->tour_id)->with('tour','tour.locations','tour.user','state','profiles','profiles.escort')->first();

        //dd($tour->profiles);
        // tour_plan
        $price = Pricing::where('membership_id', $tour->profiles[0]->tour_plan)->first();

        $diffDays = Carbon::parse($tour->end_date)->diffInDays(Carbon::parse($tour->start_date))+1;

        $tourFee = $price != null ? $price->discount_amount * ($diffDays + 1) : 0.00;

        return response()->json([
            'status' => $tour != null ? 'success' : 'error', 
            'message' => 'Tour summary fetched successfully.', 
            'data' => $tour,
            'fees' => number_format($tourFee, 2),
            'type' => 'tour_summary'
        ]);
    } 
    
    public function getTourLocationListing(Request $request){
        try {
            $response['success'] = false;
            $tourId = $request->tour_id;
            $conditions = ['tour_id'=>$tourId];
            $result = $this->tour->getTourLocations($conditions);
            $locations = $this->tour->modifyTourLocationsRecords($result);
            $html = view('escort.dashboard.partials.scheduled_tour_locations', compact('locations'))->render();
            $response['success'] = true;
            $response['locations'] = $locations;
            $response['html'] = $html;
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelTourLocation(Request $request){
        try {
            $response['success'] = false;
            $itemId = $request->item_id;
            $tourLocation = TourLocation::find($itemId);
            
            $tourLocationProfiles = $tourLocation->profiles();
            $items = $tourLocationProfiles->with('escort')->get();
            if($tourLocation->days_left < $tourLocation->days_total){
                foreach($items as $item){
                    $escortDetail = $item->escort;
                    $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");
                    $localEndDateTime = Carbon::today($profileTimezone)->endOfDay();
                    $utcEndTime = $localEndDateTime->copy()->setTimezone('UTC');
                    Purchase::where(['id'=>$escortDetail->purchase_id])->update(['end_date'=>$localEndDateTime,'utc_end_time'=>$utcEndTime]);
                    Escort::where(['id'=>$escortDetail->id])->update(['end_date'=>$localEndDateTime->format('Y-m-d'),'utc_end_time'=>$utcEndTime]);
                    if(!empty($item->is_pinup)){
                        EscortPinup::where('id', $item->is_pinup)->whereDate('end_date', '>', $localEndDateTime->format('Y-m-d'))->update(['end_date'=>$localEndDateTime->format('Y-m-d'),'utc_end_time'=>$utcEndTime]);
                    }
                }
            }
            else{
                foreach($items as $item){
                    $escortDetail = $item->escort;
                    Purchase::where(['id'=>$escortDetail->purchase_id])->update(['status' => 'expire']);
                    if(!empty($item->is_pinup)){
                        EscortPinup::where('id', $item->is_pinup)->update(['utc_start_time'=>NULL,'utc_end_time'=>NULL]);
                    }
                }
            }
            $response['success'] = true;
            $response['days_left'] = $tourLocation->days_left;
            $response['days_total'] = $tourLocation->days_total;
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
