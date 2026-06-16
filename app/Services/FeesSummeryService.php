<?php

namespace App\Services;

use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Purchase;

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


    public function getEarnings(string $fyLabel, string $displayType = 'member_id'): Collection
    {
        $fy      = $this->getFYDateRange($fyLabel);
        $orderBy = $this->getOrderBy($displayType);

        return User::query()
            ->where('users.assigned_agent_id', Auth::id())
            ->whereIn('users.type', ['3', '4'])  // 3 = Escort, 4 = Massage Centre

            // PaymentHistory join
            ->join('payment_histories as ph', function ($join) {
                $join->on('ph.user_id', '=', 'users.id')
                    ->where('ph.status', '=', 'success');
            })

            // PaymentItems join
            ->join('payment_items as pi', 'pi.payment_history_id', '=', 'ph.id')

            // Purchases join (polymorphic)
            ->join('purchase as pu', function ($join) {
                $join->on('pu.id', '=', 'pi.item_id')
                    ->where('pi.item_type', '=', Purchase::class);
            })

            //  Australia FY date range filter
            ->whereBetween('ph.paid_at', [$fy['start'], $fy['end']])

            ->select([
                'users.member_id as member_id',
                'users.name as advertiser_name',
                DB::raw("CASE WHEN users.type = '3' THEN 'E' ELSE 'MC' END as membership_type"),
                DB::raw('DATE_FORMAT(users.created_at, "%d-%m-%Y") as joined_date'),
                'users.type as user_type',

                // Plan-wise spend
                DB::raw('SUM(CASE WHEN pu.membership = 1 THEN ph.net_amount ELSE 0 END) as platinum_spend'),
                DB::raw('SUM(CASE WHEN pu.membership = 2 THEN ph.net_amount ELSE 0 END) as gold_spend'),
                DB::raw('SUM(CASE WHEN pu.membership = 3 THEN ph.net_amount ELSE 0 END) as silver_spend'),
                DB::raw('SUM(CASE WHEN pu.membership = 6 THEN ph.net_amount ELSE 0 END) as pinup_spend'),
                DB::raw('SUM(CASE WHEN pu.membership = 5 THEN ph.net_amount ELSE 0 END) as fixed_spend'),

                // Total & Fees (5%)
                DB::raw('SUM(ph.net_amount) as total_spend'),
                DB::raw('ROUND(SUM(ph.net_amount) * 0.05, 2) as fees'),
            ])

            ->groupBy('users.member_id', 'users.name', 'users.created_at', 'users.type')
            ->orderBy($orderBy['column'], $orderBy['direction'])
            ->get();
    }

    public function getSummeryData($requestedFY = null, string $displayType = 'member_id'): array
    {
        $availableFYs = $this->getAvailableFYs();
        $selectedFY   = $this->resolveSelectedFY($requestedFY, $availableFYs);
        $earnings     = $this->getEarnings($selectedFY, $displayType);

        return [
            'earnings'     => $earnings,
            'availableFYs' => $availableFYs,  
            'selectedFY'   => $selectedFY,    
            'displayType'  => $displayType,
            'fyRange'      => $this->getFYDateRange($selectedFY),
           
        ];
    }
}
