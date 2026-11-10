<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SuspendProfile;
use App\Models\MassageSuspendProfile;
use Illuminate\Http\Request;
use DataTables;

class CommonController extends Controller
{
    public function __construct()
    {
    
    }

    public function getAdvertiser(Request $request)
    {
       try {
            $advertiser  = User::getAdvertiserrByMemberId($request->member_id);
            if ($advertiser === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Advertiser not found.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'advertiser' => $advertiser,
            ], 200);

        } catch (\Throwable $e) {
            report($e);
            return response()->json([
            'success' => false,
            'message' => app()->environment('local')
                ? $e->getMessage()
                : 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function advertiserSuspensionHistoryAjax($advertiserType, $profile_id){

        switch ($advertiserType) {
            case 'escort': {
                    $suspentions = SuspendProfile::with(['user','advertiser'])
                    ->where('escort_profile_id', $profile_id);
                }
                break;
            case 'massage': {
                    $suspentions = MassageSuspendProfile::with(['user','advertiser'])
                    ->where('massage_profile_id', $profile_id);
                }
                break;
        }

        return DataTables::of($suspentions)
            ->addColumn('created_at', fn($row) => $row->created_at->format('d-m-Y'))
            ->addColumn('start_date', fn($row) =>  date('d-m-Y', strtotime($row->start_date)))
            ->addColumn('end_date', fn($row) => date('d-m-Y', strtotime($row->end_date)))
            // ->addColumn('status', fn($row) => 'status')
            ->addColumn('status', function ($row) {
            $today = Carbon::today('UTC');

            $startDate = Carbon::parse($row->utc_start_date, 'UTC');
            $endDate   = Carbon::parse($row->utc_end_date, 'UTC');

            if ($today->lt($startDate)) {
            $listingStatus = 'Upcoming';
            } elseif ($today->gt($endDate)) {
            $listingStatus = 'Expired';
            }
            else{
                $listingStatus = 'Current';
            }
            $listingStatusClass = getStatusBadgeClass(strtolower($listingStatus));
            return "<span class='custom_badge {$listingStatusClass}'>{$listingStatus}</span>";
            
            })
            ->addColumn('status_order', function ($row) {
            $today = Carbon::today('UTC');

            $startDate = Carbon::parse($row->utc_start_date, 'UTC');
            $endDate   = Carbon::parse($row->utc_end_date, 'UTC');

            if ($today->lt($startDate)) {
                return 'Upcoming';
            } elseif ($today->gt($endDate)) {
                return 'Expired';
            }

                return 'Current';
            })
            ->orderColumn('status_order', function ($query, $order) {
            $today = Carbon::today('UTC')->toDateString();

            $query->orderByRaw("
            CASE
            WHEN utc_start_date <= ? AND utc_end_date >= ? THEN 1
            WHEN utc_start_date > ? THEN 2
            WHEN utc_end_date < ? THEN 3
            ELSE 4
            END {$order}
            ", [$today, $today, $today, $today]);
            })
            ->addColumn('days', function ($row) {
                $startDate = Carbon::parse($row->utc_start_date);
                $endDate   = Carbon::parse($row->utc_end_date);
                return $startDate->diffInDays($endDate) + 1; // inclusive of first day
            })
            ->rawColumns(['status'])
            ->make(true);

    }
}
