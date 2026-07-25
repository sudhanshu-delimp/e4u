<?php

namespace App\Services;

use App\Models\AgentCommission;
use App\Models\AgentMonthlyReport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculateAgentFeeService
{
    /**
     * Prepare the agent monthly fee data for view detail
     * 
     * @param integer $reportId
     * @param return object
     */
    public function calculateFee($reportId = 0)
    {
        $result = collect();
        try {
            $report = AgentMonthlyReport::where('id', $reportId)->first();
            if ($report) {

                $billingStartDate = $report->billing_period_from;
                $billingEndDate = $report->billing_period_to;

                $billingStartDate = Carbon::parse($billingStartDate)->format('Y-m-d');
                $billingEndDate = Carbon::parse($billingEndDate)->format('Y-m-d');
                $agentId = $report->agent_id;
                $commissions = AgentCommission::select(['id', 'agent_id', 'user_id', 'user_type', 'commissionable_id', 'purchase_amount', 'total_commission_amount', 'commission_date'])
                    ->with([

                        'user' => function ($query) {
                            $query->select(
                                'id',
                                'member_id',
                                'name',
                                'business_name',
                                'email',
                                'phone',
                                'state_id'
                            );
                        },
                        'agent' => function ($query) {
                            $query->select(
                                'id',
                                'member_id',
                                'name',
                                'business_name',
                                'email',
                                'phone',
                                'state_id'
                            );
                        },
                        'paymentHistory' => function ($query) {
                            $query->select(
                                'id',
                                'service'
                            );
                        },
                        'items.item',
                    ])
                    ->where('agent_id', $agentId)
                    ->whereBetween('commission_date', [$billingStartDate, $billingEndDate])
                    ->get();
                   // dd($commissions->toArray());
                if ($commissions->isNotEmpty()) {

                    $result = $commissions->groupBy('user_id')->map(function ($records) {

                        $first = $records->first();

                        return [
                            'user_id' => $first->user_id,
                            'user_type' => $first->user_type,
                            'user_name' => filled($first->user->name)
                                ? $first->user->name
                                : $first->user->business_name,
                            'user_member_id' => filled($first->user->member_id)
                                ? $first->user->member_id
                                : '',
                            'user_state_name' => filled($first->user->state_id)
                                ? $first->user->state->iso2
                                : '',


                            'agent_name' => filled($first->agent->name)
                                ? $first->agent->name
                                : $first->agent->business_name,

                            'total_purchase_amount' => number_format($records->sum('purchase_amount'), 2, '.', ''),
                            'total_commission_amount' => number_format($records->sum('total_commission_amount'), 2, '.', ''),
                            'total_days' => $records->sum(function ($record) {

                                if (in_array($record->items->item_type, [
                                    \App\Models\MassageBumpup::class,
                                    \App\Models\EscortBumpup::class,
                                ])) {
                                    return 0;
                                }

                                $item = $record->items->item ?? null;

                                if (!$item || empty($item->start_date) || empty($item->end_date)) {
                                    return 0;
                                }

                                $format = preg_match('/^\d{2}-\d{2}-\d{4}$/', $item->start_date)
                                    ? 'd-m-Y'
                                    : 'Y-m-d';

                                $start = Carbon::createFromFormat($format, $item->start_date);
                                $end   = Carbon::createFromFormat($format, $item->end_date);

                                return $start->diffInDays($end) + 1;
                            }),
                        ];
                    })->values();
                }
            }
        } catch (Exception $e) {
            Log::info("Faile to calculate agent fee from service: " . $e->getMessage());
        }
        if($result->isNotEmpty()) {
            $result = $result->groupBy('user_type');
            $result['report_end_date'] = Carbon::parse($billingEndDate)->format('d-m-Y');

        }

        return $result;
    }
}
