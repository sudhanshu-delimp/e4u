<?php

namespace App\Services;

use App\Models\EscortPinup;
use App\Models\PaymentHistory;
use App\Models\Purchase;
use App\Models\User;
use App\Models\VariablAgentOperator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FeeSummaryService
{
    public function getSummaryData(?string $requestedFy = null, string $displayType = 'member_id'): array
    {
        $availableFys = $this->availableFinancialYears();
        $selectedFy = $this->resolveFinancialYear($requestedFy, $availableFys);
        $earnings = $this->earnings($selectedFy, $displayType);
        $total = $earnings->sum(fn ($earning) => $earning->total_spend);

        return [
            'earnings' => $earnings,
            'availableFYs' => $availableFys,
            'selectedFY' => $selectedFy,
            'displayType' => $displayType,
            'fyRange' => $this->financialYearRange($selectedFy),
            'totalEarning' => $total,
            'averageEarning' => $earnings->count() ? $total / $earnings->count() : null,
            'totalAdvertiser' => $earnings->count(),
        ];
    }

    public function getReport(int $userId): array
    {
        $user = User::query()->find($userId);
        $payments = PaymentHistory::query()
            ->where('user_id', $userId)
            ->where('status', 'success')
            ->with(['items.item' => function ($query) {
                $query->with(['escort.state']);
            }])
            ->get();

        $financialYears = [];
        $grandTotals = $this->emptyTotals();

        foreach ($payments as $payment) {
            foreach ($payment->items as $paymentItem) {
                $item = $paymentItem->item;
                if (!$item || !$item->escort) {
                    continue;
                }

                $fy = $this->financialYearLabel($payment->paid_at);
                $state = $item->escort->state_id
                    ? (getStateName((int) $item->escort->state_id) ?? 'Unknown')
                    : 'Unknown';
                $amount = (float) $payment->net_amount;
                $this->ensureFinancialYearState($financialYears, $fy, $state);

                if ($item instanceof Purchase) {
                    $column = $this->membershipColumn((int) $item->membership);
                    if (!$column) {
                        continue;
                    }
                    $this->addTotal($financialYears[$fy]['states'][$state], $column, $amount);
                    $this->addTotal($financialYears[$fy]['fy_totals'], $column, $amount);
                    $this->addTotal($grandTotals, $column, $amount);
                } elseif ($item instanceof EscortPinup) {
                    $this->addTotal($financialYears[$fy]['states'][$state], 'pinup', $amount);
                    $this->addTotal($financialYears[$fy]['fy_totals'], 'pinup', $amount);
                    $this->addTotal($grandTotals, 'pinup', $amount);
                }
            }
        }

        krsort($financialYears);
        foreach ($financialYears as $fy => &$data) {
            $data['fy_label'] = str_replace('-', ' / ', $fy);
            ksort($data['states']);
        }
        unset($data);

        return [
            'advertiser_name' => $user?->name ?? 'Unknown',
            'member_id' => $user?->member_id ?? '',
            'fy_data' => $financialYears,
            'grand_totals' => $grandTotals,
        ];
    }

    protected function availableFinancialYears(): Collection
    {
        return PaymentHistory::query()
            ->where('status', 'success')
            ->whereHas('user', function ($query) {
                $query->where('assigned_agent_id', Auth::id())
                    ->whereIn('type', ['3', '4']);
            })
            ->pluck('paid_at')
            ->filter()
            ->map(fn ($paidAt) => $this->financialYearLabel($paidAt))
            ->unique()
            ->sortDesc()
            ->values();
    }

    protected function earnings(string $financialYear, string $displayType): Collection
    {
        $range = $this->financialYearRange($financialYear);
        $feePercentage = (int) VariablAgentOperator::query()
            ->where('fee_for', 'advertising')
            ->value('amount');

        $payments = PaymentHistory::query()
            ->where('status', 'success')
            ->whereBetween('paid_at', [$range['start'], $range['end']])
            ->whereHas('user', function ($query) {
                $query->where('assigned_agent_id', Auth::id())
                    ->whereIn('type', ['3', '4']);
            })
            ->with(['user', 'items.item'])
            ->get();

        $earnings = $payments->flatMap(function (PaymentHistory $payment) {
            return $payment->items->map(function ($paymentItem) use ($payment) {
                return [
                    'user' => $payment->user,
                    'item' => $paymentItem->item,
                    'amount' => (float) $payment->net_amount,
                ];
            });
        })->groupBy(fn ($row) => $row['user']->id)
            ->map(function (Collection $rows) use ($feePercentage) {
                $user = $rows->first()['user'];
                $totals = [
                    'platinum_spend' => 0.0,
                    'gold_spend' => 0.0,
                    'silver_spend' => 0.0,
                    'pinup_spend' => 0.0,
                    'fixed_spend' => 0.0,
                ];

                foreach ($rows as $row) {
                    $item = $row['item'];
                    if ($item instanceof EscortPinup) {
                        $totals['pinup_spend'] += $row['amount'];
                        continue;
                    }
                    if (!$item instanceof Purchase) {
                        continue;
                    }
                    $column = match ((int) $item->membership) {
                        1 => 'platinum_spend',
                        2 => 'gold_spend',
                        3 => 'silver_spend',
                        5 => 'fixed_spend',
                        default => null,
                    };
                    if ($column) {
                        $totals[$column] += $row['amount'];
                    }
                }

                $totalSpend = array_sum($totals);
                return (object) array_merge([
                    'member_id' => $user->member_id,
                    'advertiser_name' => $user->name,
                    'membership_type' => $user->type === '3' ? 'E' : 'MC',
                    'joined_date' => optional($user->created_at)->format('d-m-Y'),
                    'total_spend' => $totalSpend,
                    'fees' => round($totalSpend * $feePercentage / 100, 2),
                    'fee_percentage' => $feePercentage,
                ], $totals);
            });

        return $earnings->sortBy($this->sortKey($displayType), SORT_REGULAR, $this->descending($displayType))->values();
    }

    protected function financialYearRange(string $label): array
    {
        [$startYear, $endYear] = explode('-', $label);
        return [
            'start' => Carbon::create((int) $startYear, 7, 1)->startOfDay(),
            'end' => Carbon::create((int) $endYear, 6, 30)->endOfDay(),
            'label' => $label,
        ];
    }

    protected function currentFinancialYear(): string
    {
        $year = Carbon::now()->month >= 7 ? Carbon::now()->year : Carbon::now()->year - 1;
        return $year . '-' . ($year + 1);
    }

    protected function financialYearLabel($date): string
    {
        $date = Carbon::parse($date);
        $year = $date->month >= 7 ? $date->year : $date->year - 1;
        return $year . '-' . ($year + 1);
    }

    protected function resolveFinancialYear(?string $requested, Collection $available): string
    {
        $current = $this->currentFinancialYear();
        return $requested && $available->contains($requested)
            ? $requested
            : ($available->contains($current) ? $current : ($available->first() ?? $current));
    }

    protected function sortKey(string $displayType): string
    {
        return match ($displayType) {
            'membership_type' => 'membership_type',
            'highest_spend', 'lowest_spend' => 'total_spend',
            'highest_fee', 'lowest_fee' => 'fees',
            default => 'member_id',
        };
    }

    protected function descending(string $displayType): bool
    {
        return in_array($displayType, ['highest_spend', 'highest_fee'], true);
    }

    protected function emptyTotals(): array
    {
        return ['platinum' => 0.0, 'gold' => 0.0, 'silver' => 0.0, 'pinup' => 0.0, 'total' => 0.0];
    }

    protected function ensureFinancialYearState(array &$data, string $fy, string $state): void
    {
        $data[$fy] ??= ['fy_label' => '', 'states' => [], 'fy_totals' => $this->emptyTotals()];
        $data[$fy]['states'][$state] ??= $this->emptyTotals();
    }

    protected function addTotal(array &$totals, string $column, float $amount): void
    {
        $totals[$column] += $amount;
        $totals['total'] += $amount;
    }

    protected function membershipColumn(int $membership): ?string
    {
        return match ($membership) {
            1 => 'platinum',
            2 => 'gold',
            3, 5 => 'silver',
            default => null,
        };
    }
}
