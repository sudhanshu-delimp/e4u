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


    public function getEarnings( string $fyLabel, string $displayType   = 'member_id') {
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

                SUM(CASE WHEN pi.item_type = ? AND pu.membership = 1 THEN COALESCE(pi.amount, ph.net_amount) ELSE 0 END) as platinum_spend,
                SUM(CASE WHEN pi.item_type = ? AND pu.membership = 2 THEN COALESCE(pi.amount, ph.net_amount) ELSE 0 END) as gold_spend,
                SUM(CASE WHEN pi.item_type = ? AND pu.membership = 3 THEN COALESCE(pi.amount, ph.net_amount) ELSE 0 END) as silver_spend,
                SUM(CASE WHEN pi.item_type = ? THEN COALESCE(pi.amount, ph.net_amount) ELSE 0 END) as pinup_spend,
                SUM(CASE WHEN (pi.item_type = ? AND pu.membership = 5) OR (pi.item_type = ? AND mp.id IS NOT NULL) THEN COALESCE(pi.amount, ph.net_amount) ELSE 0 END) as fixed_spend,
                SUM(CASE WHEN (pi.item_type = ? AND pu.membership IN (1, 2, 3, 5))
                    OR pi.item_type = ?
                    OR (pi.item_type = ? AND mp.id IS NOT NULL)
                    THEN COALESCE(pi.amount, ph.net_amount) ELSE 0 END) as total_spend,

                MAX(COALESCE(fee_totals.fees, 0)) as fees,
                MAX(COALESCE(fee_totals.fee_percentage, 0)) as fee_percentage
            ", [
                $purchaseType,  
                $purchaseType,
                $purchaseType,
                $escortPinupType,
                $purchaseType,
                $massagePurchaseType,
                $purchaseType,
                $escortPinupType,
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
                DB::raw('COALESCE(pi.amount, ph.net_amount) as net_amount'),
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
                DB::raw('COALESCE(pi.amount, ph.net_amount) as net_amount'),
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
                'tp.id as tour_profile_id',
                'tl.state_id',
                'tl.start_date',
                'tl.end_date'
            )
            ->get();

        // ── Also fetch advertiser info ─────────────────────────────────────────
        $user = DB::table('users')->where('id', $userId)->first();

        // ── Aggregate ─────────────────────────────────────────────────────────
        $fyData      = [];
        $grandTotals = $this->emptyTotals();
        $tourProfileIdsByFy = [];
        $tourProfileIdsByFyState = [];


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
            $tourProfileIdsByFy[$fy][$row->tour_profile_id] = true;
            $tourProfileIdsByFyState[$fy][$stateName][$row->tour_profile_id] = true;
            $fyData[$fy]['states'][$stateName]['tour_days'] += $days;
            $fyData[$fy]['fy_totals']['tour_days'] += $days;
            $grandTotals['tour_days'] += $days;
        }


        foreach ($tourProfileIdsByFy as $fy => $tourProfileIds) {
            $tourCount = count($tourProfileIds);
            $fyData[$fy]['fy_totals']['tours'] = $tourCount;
            $grandTotals['tours'] += $tourCount;
        }
        foreach ($tourProfileIdsByFyState as $fy => $states) {
            foreach ($states as $stateName => $tourProfileIds) {
                $fyData[$fy]['states'][$stateName]['tours'] = count($tourProfileIds);
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


        $configuredStates = config('escorts.profile.states', []);
        foreach ($fyData as &$data) {
            foreach ($configuredStates as $state) {
                $stateName = $state['stateAbbr'] ?? null;
                if ($stateName !== null) {
                    $data['states'][$stateName] ??= $this->emptyTotals();
                }
            }
        }
        unset($data);

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

    public function getMassageReport(int $userId): array
    {
        $purchaseRows = DB::table('massage_purchases')
            ->where('massage_centre_id', $userId)
            ->where('status', 'listed')
            ->orderBy('created_at')
            ->get([
                'id',
                'massage_profile_id',
                'start_date',
                'end_date',
                'paid_rate',
                'created_at',
            ]);

        $purchaseIds = $purchaseRows->pluck('id')->all();
        $profileIds = $purchaseRows->pluck('massage_profile_id')->unique()->all();

        $masseurRows = collect();
        if ($profileIds) {
            $masseurRows = DB::table('massager_masseurs as mm')
                ->join('masseurs as m', 'm.id', '=', 'mm.masseur_profile_id')
                ->whereIn('mm.massage_profile_id', $profileIds)
                ->select('m.id', 'm.member_id')
                ->distinct()
                ->orderBy('m.id')
                ->get();
        }

        $availabilityRows = collect();

        if ($purchaseIds) {
            $availabilityRows = DB::table('massage_time_availabilities as mta')
                ->join('masseurs as m', 'm.id', '=', 'mta.masseur_id')
                ->whereIn('mta.purchase_id', $purchaseIds)
                ->select(
                    'mta.purchase_id',
                    'mta.masseur_id',
                    'mta.masseur_availibility',
                    'm.member_id'
                )
                ->orderBy('mta.id')
                ->get();
        }

        $masseursById = $masseurRows->keyBy('id');
        foreach ($availabilityRows as $row) {
            if (!$masseursById->has($row->masseur_id)) {
                $masseursById->put($row->masseur_id, (object) [
                    'id' => $row->masseur_id,
                    'member_id' => $row->member_id,
                ]);
            }
        }
        $masseurs = $masseursById->sortKeys()->values();

        $masseurIds = $masseurs->pluck('id')->all();

        $fyData = [];
        $grandTotals = [
            'total' => 0.0,
            'listings' => 0,
            'listing_days' => 0,
            'masseurs' => [],
        ];
        foreach ($masseurIds as $masseurId) {
            $grandTotals['masseurs'][$masseurId] = ['listings' => 0, 'days' => 0];
        }

        $fyByPurchaseId = [];
        foreach ($purchaseRows as $purchase) {
            $fy = $this->fyLabel($purchase->created_at);
            $fyByPurchaseId[$purchase->id] = $fy;
            $days = Carbon::parse($purchase->start_date)->diffInDays(Carbon::parse($purchase->end_date)) + 1;
            $amount = (float) $purchase->paid_rate;


            if (!isset($fyData[$fy])) {
                $fyData[$fy] = [
                    'fy_label' => $this->fyDisplay($fy),
                    'fy_totals' => [
                        'total' => 0.0,
                        'listings' => 0,
                        'listing_days' => 0,
                    ],
                    'masseurs' => [],
                ];
                foreach ($masseurIds as $masseurId) {
                    $fyData[$fy]['masseurs'][$masseurId] = ['listings' => 0, 'days' => 0];
                }
            }

            $fyData[$fy]['fy_totals']['total'] += $amount;
            $fyData[$fy]['fy_totals']['listings']++;
            $fyData[$fy]['fy_totals']['listing_days'] += $days;
            $grandTotals['total'] += $amount;
            $grandTotals['listings']++;
            $grandTotals['listing_days'] += $days;
        }

        $processedAvailability = [];
        foreach ($availabilityRows as $row) {
            $masseurId = $row->masseur_id;
            $purchaseId = $row->purchase_id;
            if (!isset($fyByPurchaseId[$purchaseId]) || !in_array($masseurId, $masseurIds, true)) {
                continue;
            }
            if (isset($processedAvailability[$purchaseId][$masseurId])) {
                continue;
            }
            $processedAvailability[$purchaseId][$masseurId] = true;

            $fy = $fyByPurchaseId[$purchaseId];
            $days = $row->masseur_availibility
                ? countOpenDays(
                    (string) $purchaseRows->firstWhere('id', $purchaseId)->start_date,
                    (string) $purchaseRows->firstWhere('id', $purchaseId)->end_date,
                    $row->masseur_availibility
                )
                : 0;

            $fyData[$fy]['masseurs'][$masseurId]['listings']++;
            $fyData[$fy]['masseurs'][$masseurId]['days'] += $days;
            $grandTotals['masseurs'][$masseurId]['listings']++;
            $grandTotals['masseurs'][$masseurId]['days'] += $days;
        }


        krsort($fyData);
        $user = DB::table('users')->where('id', $userId)->first(['name', 'member_id']);

        return [
            'advertiser_name' => $user->name ?? 'Unknown',
            'member_id' => $user->member_id ?? '',
            'fy_data' => $fyData,
            'grand_totals' => $grandTotals,
            'masseurs' => $masseurs->all(),
        ];
    }


    protected function emptyTotals(): array
    {
        return [
            'platinum' => 0.0,
            'gold' => 0.0,
            'silver' => 0.0,
            'pinup' => 0.0,
            'fixed' => 0.0,
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
            5 => 'fixed',
            default => null,
        };
    }

}
