<?php

namespace App\Console\Commands;

use App\Mail\Agent\AgentMonthlyFeeEmail;
use App\Models\AgentCommission;
use App\Models\AgentMonthlyReport;
use App\Models\Notification;
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
            $notificationTitle = 'Your Monthly <span style="color:#ff0505;">Fee Report</span> for '  . $monthName . ' month is ready for approval. Please visit <a href="' . config('app.url') . '/agent-dashboard/fees/monthly-report">Fee Report</a> to acknowledge.';

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

        } catch (Exception $e) {
            Log::info("Operator monthly fee report error: " . $e->getMessage());
        }
    }
}
