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
        $agentMemberId = "";
        $billingEndDate = "";
        try {
            $report = AgentMonthlyReport::where('id', $reportId)->first();
            if ($report) {

                $billingStartDate = $report->billing_period_from;
                $billingEndDate = $report->billing_period_to;
                $agentMemberId = $report->agent?->member_id ?? '';

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
                    ->whereBetween('commission_date', [$billingStartDate." 00:00:00", $billingEndDate." 23:59:59"])
                    ->get();

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
        if ($result->isNotEmpty()) {

            $result = $result->groupBy('user_type');
            $feeDetails = $this->calculateFeeDetails($commissions);
            foreach ($result as $userType => $rows) {
                foreach ($rows as $index => $row) {
                    if (isset($row['user_id'])) {
                        $userId = $row['user_id'];
                        if (isset($feeDetails[$userId])) {
                            $details = $feeDetails->get($userId);

                            unset($details['user_id']);
                            unset($details['user_type']);
                            unset($details['user_name']);

                            $feeDetails->put($userId, $details);

                            $row['details'] = $feeDetails[$userId] ?? [];
                        } else {
                            $row['details'] = [];
                        }
                        $rows->put($index, $row);
                    }
                }
                $result->put($userType, $rows);
            }
            $result['report_end_date'] = Carbon::parse($billingEndDate)->format('d-m-Y');
            $result['agent_member_id'] = $agentMemberId;
        }

        return $result;
    }

    private function calculateFeeDetails($reports)
    {
        //dd($reports->toArray());
        $result = $reports->groupBy('user_id')->map(function ($rows) {

            $summary = [
                'P' => ['days' => 0, 'purchase' => 0, 'commission' => 0],
                'G' => ['days' => 0, 'purchase' => 0, 'commission' => 0],
                'S' => ['days' => 0, 'purchase' => 0, 'commission' => 0],
                'PU' => ['days' => 0, 'purchase' => 0, 'commission' => 0],
                'EBU' => ['days' => 0, 'purchase' => 0, 'commission' => 0],
                'MBU' => ['days' => 0, 'purchase' => 0, 'commission' => 0],
            ];

            foreach ($rows as $row) {

                $itemType = $row->items['item_type'] ?? null;
                $item     = $row->items['item'] ?? null;

                if (!$item) {
                    continue;
                }

                $purchase   = (float)$row->purchase_amount;
                $commission = (float)$row->total_commission_amount;



                // Calculate days
                $days = 0;

                if (!empty($item['start_date']) && !empty($item['end_date'])) {

                    $start = str_contains($item['start_date'], '-')
                        && strlen(explode('-', $item['start_date'])[0]) == 2
                        ? Carbon::createFromFormat('d-m-Y', $item['start_date'])
                        : Carbon::parse($item['start_date']);

                    $end = str_contains($item['end_date'], '-')
                        && strlen(explode('-', $item['end_date'])[0]) == 2
                        ? Carbon::createFromFormat('d-m-Y', $item['end_date'])
                        : Carbon::parse($item['end_date']);

                    $days = $start->diffInDays($end) + 1;
                }

                /* Escort Membership */

                if ($row->user_type == 3 && $itemType == "App\Models\Purchase") {

                    switch ($item['membership']) {

                        case 1:
                            $key = 'P';
                            break;

                        case 2:
                            $key = 'G';
                            break;

                        case 3:
                            $key = 'S';
                            break;

                        default:
                            $key = null;
                    }

                    if ($key) {
                        $summary[$key]['days'] += $days;
                        $summary[$key]['purchase'] += number_format($purchase, 2, '.', '');
                        $summary[$key]['commission'] +=  number_format($commission, 2, '.', '');
                    }

                    /* Escort Pinup */
                } elseif ($row->user_type == 3 && $itemType == "App\Models\EscortPinup") {

                    $summary['PU']['days'] += $days;
                    $summary['PU']['purchase'] +=  number_format($purchase, 2, '.', '');
                    $summary['PU']['commission'] +=  number_format($commission, 2, '.', '');

                    /* Escort Bumpup */
                } elseif ($row->user_type == 3 && $itemType == "App\Models\EscortBumpup") {
                    $summary['EBU']['days'] = 0;
                    $summary['EBU']['purchase'] +=  number_format($purchase, 2, '.', '');
                    $summary['EBU']['commission'] +=  number_format($commission, 2, '.', '');

                    /* Massage Pinup */
                } elseif ($row->user_type == 4 && $itemType == "App\Models\MassagePinup") {

                    $summary['PU']['days'] += $days;
                    $summary['PU']['purchase'] +=  number_format($purchase, 2, '.', '');
                    $summary['PU']['commission'] +=  number_format($commission, 2, '.', '');

                    /* Massage Bumpup */
                } elseif (
                    $row->user_type == 4 && $itemType == "App\Models\MassageBumpup"
                ) {
                    $summary['PU']['days'] = 0;
                    $summary['MBU']['purchase'] +=  number_format($purchase, 2, '.', '');
                    $summary['MBU']['commission'] +=  number_format($commission, 2, '.', '');
                }
            }
            //dd( $summary);
            return [
                'user_id' => $rows->first()->user_id,
                'user_type' => $rows->first()->user_type,
                'user_name' => $rows->first()->user['name'] ?: $rows->first()->user['business_name'],

                'P'   => $summary['P'],
                'G'   => $summary['G'],
                'S'   => $summary['S'],
                'PU'  => $summary['PU'],
                'EBU' => $summary['EBU'],
                'MBU' => $summary['MBU'],
            ];
        });
        return  $result;
    }
}
