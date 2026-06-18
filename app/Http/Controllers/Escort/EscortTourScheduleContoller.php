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
use App\Services\WalletService;

class EscortTourScheduleContoller extends Controller
{
    protected $tour;
    protected $walletService;

    public function __construct(TourInterface $tour, WalletService $walletService)
    {
        $this->tour = $tour;
        $this->walletService = $walletService;
    }

    public function index()
    {
        $tourIds =  Tour::where('user_id', auth()->id())->pluck('id')->toArray();
        $tours = TourLocation::whereIn('tour_id', $tourIds)
            ->with('state', 'tour')
            ->get()
            ->sortBy(function ($tour) {
                $today = Carbon::today()->toDateString();

                if ($tour->start_date <= $today && $tour->end_date >= $today && $tour->status != 'cancelled') {
                    // Current tours
                    return 1;
                } elseif ($tour->start_date > $today && $tour->status != 'cancelled') {
                    // Upcoming tours
                    return 2;
                } elseif ($tour->start_date < $today && $tour->status != 'cancelled') {
                    // Completed tours
                    return 3;
                } else {
                    // cancelled tours
                    return 4;
                }
            })
            ->values();
        return view('escort.dashboard.tourSchedule.index', ['tours' => $tours]);
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
        try {
            $response['success'] = false;
            $tourId = $request->tourId;
            $tourDetail = $this->tour->find($tourId);
            $html = view('escort.dashboard.tourSchedule.modal.summary', compact('tourDetail'))->render();
            $response['success'] = true;
            $response['tourDetail'] = $tourDetail;
            $response['html'] = $html;
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getTourLocationListing(Request $request)
    {
        try {
            $response['success'] = false;
            $tourId = $request->tour_id;
            $conditions = ['tour_id' => $tourId];
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

    public function cancelTourLocation(Request $request)
    {
        try {
            $response['success'] = false;
            $user = auth()->user();
            $itemId = $request->item_id;
            $tourLocation = TourLocation::find($itemId);

            $tourLocationProfiles = $tourLocation->profiles();
            $items = $tourLocationProfiles->with('escort')->get();
            $refundAmount = 0.00;
            if ($tourLocation->left_listing_days < $tourLocation->days_total) {
                foreach ($items as $item) {
                    $escortDetail = $item->escort;
                    $localEndDateTime = Carbon::today($escortDetail->time_zone)->endOfDay();
                    $utcEndTime = $localEndDateTime->copy()->setTimezone('UTC');
                    $purchase = $escortDetail->mainPurchase;

                    $refundAmount  += $purchase->refund_amount;

                    $purchase->end_date = $localEndDateTime->format('d-m-Y');
                    $purchase->utc_end_time = $utcEndTime;
                    $purchase->save();
                    Escort::where(['id' => $escortDetail->id])->update(['end_date' => $localEndDateTime->format('Y-m-d'), 'utc_end_time' => $utcEndTime]);
                    if (!empty($item->is_pinup)) {
                        EscortPinup::where('id', $item->is_pinup)->whereDate('end_date', '>', $localEndDateTime->format('Y-m-d'))->update(['end_date' => $localEndDateTime->format('Y-m-d'), 'utc_end_time' => $utcEndTime]);
                    }
                }
                $tourLocation->update(['end_date' => $localEndDateTime->format('d-m-Y')]);
                $response['refundAmount'] = $refundAmount;
            } else {
                foreach ($items as $item) {
                    $escortDetail = $item->escort;
                    $purchase = Purchase::where(['tour_location_id' => $item->tour_location_id, 'escort_id' => $escortDetail->id])->first();

                    $refundAmount  += $purchase->refund_amount;

                    $purchase->status = 'cancel';
                    $purchase->utc_start_time = NULL;
                    $purchase->utc_end_time = NULL;
                    $purchase->save();

                    if (!empty($item->is_pinup)) {
                        EscortPinup::where('id', $item->is_pinup)->update(['utc_start_time' => NULL, 'utc_end_time' => NULL]);
                    }
                }
                $response['refundAmount'] = $refundAmount;
                $tourLocation->delete();
                $tourLocationProfiles->delete();
            }

            /* Update tour end date according to the last tour location */
            $tour = $tourLocation->tour;
            $tourEndDate = $tour->locations()->max('end_date');
            if ($tourEndDate) {
                $tour->update(['end_date' => $tourEndDate]);
            }

            $this->walletService->credit(
                $user,
                $refundAmount,
                $tourLocation,
                'Cancel tour location.',
                [
                    'user_id' => $user->id,
                    'tour_location_id' => $tourLocation->id
                ]
            );

            $response['success'] = true;
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelTour(Request $request)
    {
        try {
            $response['success'] = false;
            $user = auth()->user();
            $itemId = $request->item_id;
            $tour = Tour::find($itemId);
            $tourLocations = $tour->locations();
            $items = $tourLocations->get();
            $refundAmount = 0.00;
            foreach ($items as $item) {
                $tourLocationProfiles = $item->profiles();
                foreach ($tourLocationProfiles->with('escort')->get() as $locationProfile) {
                    $escortDetail = $locationProfile->escort;
                    $purchase = Purchase::where(['tour_location_id' => $locationProfile->tour_location_id, 'escort_id' => $escortDetail->id])->first();

                    $refundAmount  += $purchase->refund_amount;

                    $purchase->status = 'expire';
                    $purchase->save();

                    if (!empty($locationProfile->is_pinup)) {
                        EscortPinup::where('id', $locationProfile->is_pinup)->update(['utc_start_time' => NULL, 'utc_end_time' => NULL]);
                    }
                }
                $tourLocationProfiles->delete();
            }
            $response['refundAmount'] = $refundAmount;
            $this->walletService->credit(
                $user,
                $refundAmount,
                $tour,
                'Cancel tour.',
                [
                    'user_id' => $user->id,
                    'tour_id' => $tour->id
                ]
            );
            $tourLocations->delete();
            $tour->delete();

            $response['success'] = true;
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
