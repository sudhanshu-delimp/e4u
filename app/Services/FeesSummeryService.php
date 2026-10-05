<?php

namespace App\Services;

use App\Models\EscortPinup;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Purchase;
use App\Models\MassagePurchase;

class FeesSummeryService
{


    public function currentFYLabel(): string
    {
        $now = Carbon::now();
        $startYear = $now->month >= 7 ? $now->year : $now->year - 1;
        $endYear   = $startYear + 1;

        return "{$startYear}-{$endYear}";
    }


    public function getFYDateRange(string $fyLabel): array
    {
        [$startYear, $endYear] = explode('-', $fyLabel);

        return [
            'start' => Carbon::create((int)$startYear, 7, 1)->startOfDay(),
            'end'   => Carbon::create((int)$endYear, 6, 30)->endOfDay(),
            'label' => $fyLabel,
        ];
    }

    public function getAvailableFYs()
    {
        return PaymentHistory::query()
            ->where('status', 'success')
            ->whereIn('user_id', function ($sub) {
                $sub->select('id')
                    ->from('users')
                    ->where('assigned_agent_id', Auth::id())
                    ->whereIn('type', ['3', '4']);
            })
            // check australia financial year 7(Julay) 6(June) 
            ->selectRaw("
                CASE
                    WHEN MONTH(paid_at) >= 7                               
                        THEN CONCAT(YEAR(paid_at), '-', YEAR(paid_at) + 1)
                    ELSE
                        CONCAT(YEAR(paid_at) - 1, '-', YEAR(paid_at))
                END as fy_label
            ")
            ->groupByRaw("
                CASE
                    WHEN MONTH(paid_at) >= 7
                        THEN CONCAT(YEAR(paid_at), '-', YEAR(paid_at) + 1)
                    ELSE
                        CONCAT(YEAR(paid_at) - 1, '-', YEAR(paid_at))
                END
            ")
            ->orderByRaw("MIN(paid_at) DESC")  // Latest FY pehle
            ->pluck('fy_label');
    }

    public function resolveSelectedFY(?string $requested, Collection $availableFYs): string
    {
        $current = $this->currentFYLabel();

        // Agar requested FY available list me hai to use karo
        if ($requested && $availableFYs->contains($requested)) {
            return $requested;
        }

        // Fallback: current FY ya list ka pehla item
        return $availableFYs->contains($current)
            ? $current
            : ($availableFYs->first() ?? $current);
    }


    public function getOrderBy(string $displayType): array
    {
        return match ($displayType) {
            'membership_type' => ['column' => 'users.type',        'direction' => 'asc'],
            'highest_spend'   => ['column' => 'total_spend',       'direction' => 'desc'],
            'lowest_spend'    => ['column' => 'total_spend',       'direction' => 'asc'],
            'highest_fee'     => ['column' => 'fees',              'direction' => 'desc'],
            'lowest_fee'      => ['column' => 'fees',              'direction' => 'asc'],
            default           => ['column' => 'users.member_id',   'direction' => 'asc'],  // member_id (numerical, default)
        };
    }


    public function getEarnings( string $fyLabel, string $displayType   = 'member_id', float  $feePercentage = 5 ) {
        $fy         = $this->getFYDateRange($fyLabel);
        $orderBy    = $this->getOrderBy($displayType);

        $purchaseType    = Purchase::class;   
        $escortPinupType = EscortPinup::class; 
        $massagePurchaseType = MassagePurchase::class;
        $feeTotals = PaymentHistory::query()
            ->select('user_id')
            ->selectRaw('ROUND(SUM(net_amount * COALESCE(agent_commission_percent, 0) / 100), 2) as fees')
            ->selectRaw('ROUND(SUM(net_amount * COALESCE(agent_commission_percent, 0)) / NULLIF(SUM(net_amount), 0), 2) as fee_percentage')
            ->where('status', 'success')
            ->whereBetween('paid_at', [$fy['start'], $fy['end']])
            ->groupBy('user_id');
 
        return User::query()
            ->where('users.assigned_agent_id', Auth::id())
            ->whereIn('users.type', ['3', '4'])
            ->leftJoinSub($feeTotals, 'fee_totals', function ($join) {
                $join->on('fee_totals.user_id', '=', 'users.id');
            })
 
            ->join('payment_histories as ph', function ($join) {
                $join->on('ph.user_id', '=', 'users.id')
                     ->where('ph.status', '=', 'success');
            })
            ->join('payment_items as pi', 'pi.payment_history_id', '=', 'ph.id')

            ->leftJoin('purchase as pu', 'pu.id', '=', 'pi.item_id')
            ->leftJoin('escort_pinups as ep', 'ep.id', '=', 'pi.item_id')
            ->leftJoin('massage_purchases as mp', 'mp.id', '=', 'pi.item_id')
 
            ->whereBetween('ph.paid_at', [$fy['start'], $fy['end']])


            ->selectRaw("
                users.id as user_id,
                users.member_id as member_id,
                users.name as advertiser_name,
                CASE WHEN users.type = '3' THEN 'E' ELSE 'MC' END as membership_type,
                DATE_FORMAT(users.created_at, '%d-%m-%Y') as joined_date,

                SUM(CASE WHEN pi.item_type = ? AND pu.membership = 1 THEN ph.net_amount ELSE 0 END) as platinum_spend,
                SUM(CASE WHEN pi.item_type = ? AND pu.membership = 2 THEN ph.net_amount ELSE 0 END) as gold_spend,
                SUM(CASE WHEN pi.item_type = ? AND pu.membership = 3 THEN ph.net_amount ELSE 0 END) as silver_spend,
                SUM(CASE WHEN pi.item_type = ? THEN ph.net_amount ELSE 0 END) as pinup_spend,
                SUM(CASE WHEN (pi.item_type = ? AND pu.membership = 5) OR (pi.item_type = ? AND mp.id IS NOT NULL) THEN ph.net_amount ELSE 0 END) as fixed_spend,
 
                SUM(ph.net_amount) as total_spend,
                MAX(COALESCE(fee_totals.fees, 0)) as fees,
                MAX(COALESCE(fee_totals.fee_percentage, 0)) as fee_percentage
            ", [
                $purchaseType,  
                $purchaseType,
                $purchaseType,
                $escortPinupType,
                $purchaseType,
                $massagePurchaseType,
            ])
 
            ->groupBy('users.id','users.member_id', 'users.name', 'users.created_at', 'users.type')
            ->orderBy($orderBy['column'], $orderBy['direction'])
            ->get();
    }
    
    public function totalEarning(Collection $earnings){
        $total =  0;
        foreach($earnings as $earning){
            $total += $earning->total_spend;
        }
        return $total;
    }

    public function averageEarning(Collection $totalValue){
        $average = 0;
        foreach($totalValue as $value){
            $average += $value->total_spend;
        }
        if($average > 0){
        $averageV  = $average / $totalValue->count();
        return $averageV;
        }
        
    }

    public function totalAdvertisers(Collection $total){
        $totalAdvertiser = $total->count() ?? 0;
        return $totalAdvertiser;
    }	
 


    public function getSummeryData($requestedFY = null, string $displayType = 'member_id'): array
    {
        $availableFYs = $this->getAvailableFYs();
        $selectedFY   = $this->resolveSelectedFY($requestedFY, $availableFYs);
        $earnings     = $this->getEarnings($selectedFY, $displayType);
        //dd($earnings);
        $totalEarnings = $this->totalEarning($earnings);
        $averageEarning = $this->averageEarning($earnings);
        $totalAdvertiserCount = $this->totalAdvertisers($earnings);



        return [
            'earnings'     => $earnings,
            'availableFYs' => $availableFYs,
            'selectedFY'   => $selectedFY,
            'displayType'  => $displayType,
            'fyRange'      => $this->getFYDateRange($selectedFY),
            'totalEarning' => $totalEarnings,
            'averageEarning' => $averageEarning,
            'totalAdvertiser' => $totalAdvertiserCount

        ];
    }



    // **********************************Single Escort Value**************************************//

    protected function getStateName(?int $stateId): string
    {
        if (!$stateId) return 'Unknown';
        return getStateName($stateId) ?? 'Unknown';
    }

    protected function fyLabel(string $date): string
    {
        $carbon = Carbon::parse($date);
        $startYear = $carbon->month >= 7 ? $carbon->year : $carbon->year - 1;
        return "{$startYear}-" . ($startYear + 1);
    }

    protected function fyDisplay(string $fyLabel): string
    {
        return str_replace('-', ' / ', $fyLabel);
    }


    public function getReport(int $userId): array
    {
        $purchaseType    = Purchase::class;
        $escortPinupType = EscortPinup::class;

        // ── Fetch purchase-based rows (Platinum / Gold / Silver / Fixed) ──────
        $purchaseRows = DB::table('payment_histories as ph')
            ->join('payment_items as pi',  'pi.payment_history_id', '=', 'ph.id')
            ->join('purchase as pu',        'pu.id',                 '=', 'pi.item_id')
            ->join('escorts as e',          'e.id',                  '=', 'pu.escort_id')
            ->leftJoin('tour_locations as tl', 'tl.id', '=', 'pu.tour_location_id')
            ->where('ph.user_id',  $userId)
            ->where('ph.status',   'success')
            ->where('pi.item_type', $purchaseType)
            ->select(
                'ph.paid_at',
                'ph.net_amount',
                'pu.id as purchase_id',
                'pu.start_date',
                'pu.end_date',
                'pu.membership',
                DB::raw('COALESCE(tl.state_id, e.state_id) as state_id')
            )
            ->get();

        // ── Fetch pinup-based rows ─────────────────────────────────────────────
        $pinupRows = DB::table('payment_histories as ph')
            ->join('payment_items as pi',   'pi.payment_history_id', '=', 'ph.id')
            ->join('escort_pinups as ep',   'ep.id',                 '=', 'pi.item_id')
            ->where('ph.user_id',  $userId)
            ->where('ph.status',   'success')
            ->where('pi.item_type', $escortPinupType)
            ->select(
                'ph.paid_at',
                'ph.net_amount',
                'ep.state_id',
            )
            ->get();

        $escortIds = DB::table('escorts')->where('user_id', $userId)->select('id');
        $tourRows = DB::table('tour_profiles as tp')
            ->join('tour_locations as tl', 'tl.id', '=', 'tp.tour_location_id')
            ->join('tours as t', 't.id', '=', 'tl.tour_id')
            ->whereIn('tp.escort_id', $escortIds)
            ->where('t.user_id', $userId)
            ->where('tl.is_pinup', '0')
            ->select(
                't.id as tour_id',
                'tl.id as location_id',
                'tl.state_id',
                'tl.start_date',
                'tl.end_date'
            )
            ->distinct()
            ->get();

        // ── Also fetch advertiser info ─────────────────────────────────────────
        $user = DB::table('users')->where('id', $userId)->first();

        // ── Aggregate ─────────────────────────────────────────────────────────
        $fyData      = [];
        $grandTotals = $this->emptyTotals();
        $tourIdsByFy = [];
        $tourIdsByFyState = [];

        // Process purchase rows
        foreach ($purchaseRows as $row) {
            $fy        = $this->fyLabel($row->paid_at);
            $stateName = $this->getStateName((int) $row->state_id);
            $amount    = (float) $row->net_amount;

            $this->ensureFyState($fyData, $fy, $stateName);
            $days = $row->start_date && $row->end_date
                ? Carbon::parse($row->start_date)->diffInDays(Carbon::parse($row->end_date)) + 1
                : 0;
            $fyData[$fy]['states'][$stateName]['listings']++;
            $fyData[$fy]['states'][$stateName]['listing_days'] += $days;
            $fyData[$fy]['fy_totals']['listings']++;
            $fyData[$fy]['fy_totals']['listing_days'] += $days;
            $grandTotals['listings']++;
            $grandTotals['listing_days'] += $days;

            $col = $this->membershipColumn((int) $row->membership);
            if ($col) {
                $fyData[$fy]['states'][$stateName][$col] += $amount;
                $fyData[$fy]['states'][$stateName]['total'] += $amount;
                $fyData[$fy]['fy_totals'][$col]            += $amount;
                $fyData[$fy]['fy_totals']['total']          += $amount;
                $grandTotals[$col]                          += $amount;
                $grandTotals['total']                       += $amount;
            }
        }

        // Process escort tour locations
        foreach ($tourRows as $row) {
            $fy = $this->fyLabel($row->start_date);
            $stateName = $this->getStateName((int) $row->state_id);
            $days = Carbon::parse($row->start_date)->diffInDays(Carbon::parse($row->end_date)) + 1;

            $this->ensureFyState($fyData, $fy, $stateName);
            $tourIdsByFy[$fy][$row->tour_id] = true;
            $tourIdsByFyState[$fy][$stateName][$row->tour_id] = true;
            $fyData[$fy]['states'][$stateName]['tour_days'] += $days;
            $fyData[$fy]['fy_totals']['tour_days'] += $days;
            $grandTotals['tour_days'] += $days;
        }

        foreach ($tourIdsByFy as $fy => $tourIds) {
            $tourCount = count($tourIds);
            $fyData[$fy]['fy_totals']['tours'] = $tourCount;
            $grandTotals['tours'] += $tourCount;
        }
        foreach ($tourIdsByFyState as $fy => $states) {
            foreach ($states as $stateName => $tourIds) {
                $fyData[$fy]['states'][$stateName]['tours'] = count($tourIds);
            }
        }

        // Process pinup rows
        foreach ($pinupRows as $row) {
            $fy        = $this->fyLabel($row->paid_at);
            $stateName = $this->getStateName((int) $row->state_id);
            $amount    = (float) $row->net_amount;

            $this->ensureFyState($fyData, $fy, $stateName);

            $fyData[$fy]['states'][$stateName]['pinup'] += $amount;
            $fyData[$fy]['states'][$stateName]['total'] += $amount;
            $fyData[$fy]['fy_totals']['pinup']           += $amount;
            $fyData[$fy]['fy_totals']['total']            += $amount;
            $grandTotals['pinup']                         += $amount;
            $grandTotals['total']                         += $amount;
        }

        // Sort FYs latest first, add display label
        krsort($fyData);
        foreach ($fyData as $fy => &$data) {
            $data['fy_label'] = $this->fyDisplay($fy);
            ksort($data['states']); // sort states alphabetically
        }
        unset($data);

        return [
            'advertiser_name' => $user->name    ?? 'Unknown',
            'member_id'       => $user->member_id ?? '',
            'fy_data'         => $fyData,
            'grand_totals'    => $grandTotals,
        ];
    }


    protected function emptyTotals(): array
    {
        return [
            'platinum' => 0.0,
            'gold' => 0.0,
            'silver' => 0.0,
            'pinup' => 0.0,
            'total' => 0.0,
            'listings' => 0,
            'listing_days' => 0,
            'tours' => 0,
            'tour_days' => 0,
        ];
    }

    protected function ensureFyState(array &$fyData, string $fy, string $state): void
    {
        if (!isset($fyData[$fy])) {
            $fyData[$fy] = [
                'fy_label'  => '',
                'states'    => [],
                'fy_totals' => $this->emptyTotals(),
            ];
        }
        if (!isset($fyData[$fy]['states'][$state])) {
            $fyData[$fy]['states'][$state] = $this->emptyTotals();
        }
    }

    protected function membershipColumn(int $membership): ?string
    {
        return match ($membership) {
            1 => 'platinum',
            2 => 'gold',
            3 => 'silver',
            5 => 'silver',   // Fixed → silver; change if you want a separate "fixed" column
            default => null,
        };
    }

}
