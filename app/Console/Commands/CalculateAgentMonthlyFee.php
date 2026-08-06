<?php

namespace App\Console\Commands;

use App\Mail\Agent\AgentMonthlyFeeEmail;
use App\Mail\Operator\OperatorMonthlyFeeEmail;
use App\Models\AgentCommission;
use App\Models\AgentMonthlyReport;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Operator;
use App\Models\OperatorMonthlyReport;
use App\Models\OperatorMonthlyReportQuery;
use App\Models\State;
use App\Models\User;
use App\Services\CalculateAgentFeeService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
class CalculateAgentMonthlyFee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agent:calculate-fee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcuate the agent fees and total spends';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reportObj = (new AgentMonthlyReport);
        // Write code for email report
        //Current month
        //$billingStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        //$billingEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Date before current month
        $billingStartDate = Carbon::now()->subMonthNoOverflow()->startOfMonth()->format('Y-m-d');
        $billingEndDate = Carbon::now()->subMonthNoOverflow()->endOfMonth()->format('Y-m-d');
        $reportDate = Carbon::now()->subMonthNoOverflow()->startOfMonth()->format('m-Y');
        $monthName = Carbon::parse($billingStartDate)->format('F');

        try {

            $notification = (new Notification);
            $notificationTitle = 'Your Monthly <span style="color:#ff0505;">The Fee Report</span> for ' . $monthName . ' month is ready for approval. Please visit <a href="' . config('app.url') . '/agent-dashboard/fees/monthly-report">Fee Report</a> to acknowledge.';

            $notificationIcon = $notification->notificationIcon('general');

            $reports = AgentCommission::select(
                'agent_id',
                DB::raw('SUM(total_commission_amount) as total_commission'),
                DB::raw('SUM(purchase_amount) as total_purchase')
            )->with('agent', function ($query) {
                $query->select(['id', 'member_id', 'email', 'business_name', 'state_id'])
                    ->with('state', function ($queryState) {
                        $queryState->select(['id', 'name', 'iso2', 'country_id']);
                    });
            })
                ->whereBetween('commission_date', [$billingStartDate, $billingEndDate])
                ->groupBy('agent_id')
                ->get();


            if ($reports->count() > 0) {
                foreach ($reports as $report) {
                    $agentId = $report->agent_id;
                    $exitReport = AgentMonthlyReport::where('agent_id', $agentId)->where('billing_period_from', $billingStartDate)->first();
                    if (!$exitReport) {
                        $reportObj = (new AgentMonthlyReport);
                        $reportObj->report_date = date('Y-m-d H:i:s');
                        $reportObj->billing_period_from = $billingStartDate;
                        $reportObj->billing_period_to = $billingEndDate;
                        $reportObj->agent_id = $agentId;
                        $reportObj->state_id = $report->agent?->state?->id ?? null;
                        $reportObj->spend = $report->total_purchase;
                        $reportObj->fees = $report->total_commission;
                        if ($reportObj->save()) {
                            // Write code for email report
                            $notification = (new Notification);

                            $data = [];
                            $data['to_user'] = $agentId;
                            $data['notification_type'] = 'general';
                            $data['notification_icon'] = $notificationIcon;
                            $data['notification_listing_type'] = 3;
                            $data['title'] = $notificationTitle;
                            $data['message'] = '';
                            $data['created_at'] = date('Y-m-d H:i:s');
                            $data['updated_at'] = date('Y-m-d H:i:s');
                            $notification->insert($data);

                            // Send mail
                            $agentEmail = [];
                            $agentEmail['name'] = $report->agent->contact_person ?? $report->agent->business_name;
                            $agentEmail['member_id'] = $report->agent->member_id ?? "";
                            $agentEmail['report_date'] = $reportDate;
                            $to = $report->agent->email;
                            try {
                                Mail::to($to)->send(new AgentMonthlyFeeEmail($agentEmail));
                            } catch (Exception $e) {
                                Log::info("Monthly agent fee email not sent: " . $e->getMessage());
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Log::info("Agent fee report error: " . $e->getMessage());
        }

        // Generate report for operators

        try {

            $notification = (new Notification);
            $notificationTitle = 'Your Monthly <span style="color:#ff0505;">The Fee Report</span> for ' . $monthName . ' month is ready for approval. Please visit <a href="' . config('app.url') . '/operator-dashboard/operator-monthly-report">Fee Report</a> to acknowledge.';

            $notificationIcon = $notification->notificationIcon('general');


            $agentMonthlyTableName = (new AgentMonthlyReport)->getTable();
            $stateTableName = (new State)->getTable();
            $userTableName = (new User)->getTable();
            $countryTable = (new Country())->getTable();

            //$billingStartDate = '2026-06-01';
            //$billingEndDate   = '2026-06-30';

            $reports = AgentMonthlyReport::query()
                ->join($userTableName, $userTableName . '.id', '=', $agentMonthlyTableName . '.agent_id')
                ->join($stateTableName, $stateTableName . '.id', '=', $userTableName . '.state_id')
                ->join($countryTable, "$countryTable.id", '=', $stateTableName . '.country_id')
                ->whereDate($agentMonthlyTableName . '.billing_period_from', '=', $billingStartDate)
                ->whereDate($agentMonthlyTableName . '.billing_period_to', '=', $billingEndDate)
                ->select(
                    $stateTableName . '.country_id',
                    $countryTable . '.name as country_name',
                    $agentMonthlyTableName . '.billing_period_from',
                    $agentMonthlyTableName . '.billing_period_to',
                    $agentMonthlyTableName . '.status',
                    DB::raw('GROUP_CONCAT(DISTINCT ' . $agentMonthlyTableName . '.agent_id ORDER BY ' . $agentMonthlyTableName . '.agent_id) as agent_ids'),

                    DB::raw('COUNT(' . $agentMonthlyTableName . '.id) as total_reports'),
                    DB::raw('COUNT(DISTINCT ' . $agentMonthlyTableName . '.agent_id) as total_agents'),
                    DB::raw('SUM(' . $agentMonthlyTableName . '.spend) as total_spend'),
                    DB::raw('SUM(' . $agentMonthlyTableName . '.fees) as total_fees')
                )
                ->groupBy(
                    $stateTableName . '.country_id',
                    $countryTable . '.name',
                    $agentMonthlyTableName . '.billing_period_from',
                    $agentMonthlyTableName . '.billing_period_to',
                    $agentMonthlyTableName . '.status'
                )
                ->orderBy('' . $agentMonthlyTableName . '.billing_period_from')
                ->orderBy($stateTableName . '.country_id')
                ->orderBy('' . $agentMonthlyTableName . '.status')
                ->get();

            $reports = collect($reports)->groupBy('country_id');

            foreach ($reports as $key => $report) {
                $countryId = $key;
                $countryName = "";
                $totalSpend = 0.00;
                $agetnTotalFees = 0.00;
                $agentIds = "";
                $billingPeriodFrom = "";
                $billingPeriodTo = "";
                $operatorId = null;
                $agents = [];

                $operator = Operator::select(['id', 'country_id', 'business_name', 'email', 'phone', 'name', 'member_id'])->where('country_id', $countryId)->where('type', '7')->first();

                if ($operator) {
                    $operatorId =  $operator->id;

                    foreach ($report as $key2 => $reportData) {
                        $countryName = $reportData->country_name;
                        $agents[] = $reportData->agent_ids;
                        $totalSpend =  $totalSpend + $reportData->total_spend;
                        $agetnTotalFees =  $agetnTotalFees + $reportData->total_fees;
                    }

                    $exitReport = OperatorMonthlyReport::where('operator_id', $operatorId)->where('billing_period_from', $billingStartDate)->first();
                    if (!$exitReport) {
                        $operatorFees = number_format((($totalSpend * 2) / 100), '2', '.', '');
                        $agentIds = implode(",", $agents);
                        $reportObj = (new OperatorMonthlyReport);
                        $reportObj->report_date = date('Y-m-d H:i:s');
                        $reportObj->billing_period_from = $billingStartDate;
                        $reportObj->billing_period_to = $billingEndDate;
                        $reportObj->operator_id =  $operatorId;
                        $reportObj->agent_ids = $agentIds;
                        $reportObj->agent_fees = $agetnTotalFees;
                        $reportObj->country_id = $countryId;
                        $reportObj->spend = $totalSpend;
                        $reportObj->fees = $operatorFees;
                        if ($reportObj->save()) {
                            // Write code for email report
                            $notification = (new Notification);

                            $data = [];
                            $data['to_user'] = $operatorId;
                            $data['notification_type'] = 'general';
                            $data['notification_icon'] = $notificationIcon;
                            $data['notification_listing_type'] = 3;
                            $data['title'] = $notificationTitle;
                            $data['message'] = '';
                            $data['created_at'] = date('Y-m-d H:i:s');
                            $data['updated_at'] = date('Y-m-d H:i:s');
                            $notification->insert($data);

                            // Send mail
                            $opEmail = [];
                            $opEmail['name'] = $operator->business_name ?? $operator->name;
                            $opEmail['member_id'] = $operator->member_id ?? "";
                            $opEmail['report_date'] = $reportDate;
                            $to = $operator->email;
                            // Log::info("Monthly operator fee email not sent: " . json_encode($opEmail).$to);
                            try {
                              // $estatus = Mail::to($to)->send(new OperatorMonthlyFeeEmail($opEmail));
                               
                            } catch (Exception $e) {
                                Log::info("Monthly operator fee email not sent: " . $e->getMessage());
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Log::info("Operator monthly fee report error: " . $e->getMessage());
        }
    }
}
