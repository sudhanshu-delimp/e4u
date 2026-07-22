<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\BaseController;
use App\Models\AgentCommission;
use App\Models\AgentMonthlyReport;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MonthlyReportController extends BaseController
{

  /**
   *  View the monthly fee reports list
   */
  public function monthlyReport()
  {
    $userId = auth()->user()->id;
    $reportObj = (new AgentMonthlyReport);
    try {
      //$submitedBillingPeriodFrom = [ '2026-06-01'];
      $billingStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
      $billingEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');

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
            }
          }
        }
      }
    } catch (Exception $e) {
      Log::info("Agent fee report erro: " . $e->getMessage());
    }

    $reports = AgentMonthlyReport::where('agent_id', $userId)->with('state', 'agent')->get();

    return  view('agent.dashboard.Fees.monthly-report', compact('reports'));
  }


  public function monthlyReportAjax()
  {
    $userId = auth()->user()->id;
    $reportObj = (new AgentMonthlyReport);
    try {
      $order = request()->get('order');
      $order_column = null;
      $order_dir = null;

      if (!empty($order) && isset($order[0]['column']) && isset($order[0]['dir'])) {
        $order_column = $order[0]['column'];
        $order_dir    = $order[0]['dir'];
      }

      list($result, $count) = $this->reportDataPagination(
        request()->get('start'),
        request()->get('length'),
        (request()->get('order')[0]['column']),
        request()->get('order')[0]['dir']
      );

      $data = array(
        "draw"            => intval(request()->input('draw')),
        "recordsTotal"    => intval($count),
        "recordsFiltered" => intval($count),
        "data"            => $result
      );
    } catch (Exception $e) {
      Log::info("Agent fee report erro: " . $e->getMessage());
      $data = array(
        "draw"            => intval(request()->input('draw')),
        "recordsTotal"    => 0,
        "recordsFiltered" => 0,
        "data"            => null
      );
    }

    return response()->json($data);
  }

  private function reportDataPagination($start, $limit, $order_key, $dir)
  {
    $userId = auth()->user()->id;
    $reports = AgentMonthlyReport::where('agent_id', $userId)
      ->with('state', 'agent');

    $search = request()->input('search.value');

    if (!empty($search)) {
      $reports->where(function ($query) use ($search) {
        $query->where('status', 'like', "%{$search}%");
      });
    }

    switch ($order_key) {
      case 0:
        $reports->orderBy('report_date', $dir);
        break;
      case 4:
        $reports->orderBy('status', $dir);
        break;
      default:
        $reports->orderBy('report_date', 'DESC');
        break;
    }

    $totalReport = $reports->count();
    $reports = $reports->offset($start)->limit($limit)->get();

    foreach ($reports as $item) {
      $item->reportDate = Carbon::parse($item->report_date)->format('d-m-Y');
      $fromDate = Carbon::parse($item->billing_period_from)->format('d-m-Y');
      $toDate = Carbon::parse($item->billing_period_to)->format('d-m-Y');

      $approvedDate = (!empty($item->report_approved)) ? Carbon::parse($item->report_approved)->format('d-m-Y') : null;

      $item->billing_period =  $fromDate . " to " . $toDate;
      $item->billing_period_to =  $item->billing_period_to;
      $item->agent_name =  $item->agent->business_name;
      $item->territory =  $item->state?->iso2 ?? '';
      $formattedSpend = '<div class="num_value"><span>$</span><span>' . ($item->spend) . '</span></div>';
      $formattedFees = '<div class="num_value"><span>$</span><span>' . ($item->fees) . '</span></div>';
      $item->total_spend =  $formattedSpend;
      $item->total_fees =   $formattedFees;
      $status = ucfirst($item->status);
      $item->status_name = '<span class="custom_badge ' . getStatusBadgeClass($status) . '">' . $status . ' </span>';

      $item->report_pproved_date =  $approvedDate;
      $item->approved_by =  $item->approved_by;

      $dropDown = '<div class="dropdown no-arrow"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';
      $divider = "";

      if ($item->status == 'pending') {
        //Approve
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';
        $divider = '<div class="dropdown-divider"></div>';
        //Query
        $dropDown .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Query</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'approved') {
        //Query
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Query</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'paid') {
        //Query
        //$dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Query</a>';
      } else if ($item->status == 'query') {
        //Approve
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';
        $divider = '<div class="dropdown-divider"></div>';
      }

      //View
      $dropDown .= $divider . '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-agent_id="' . $item->agent_id . '" id="getMontlyViewReportPage"> <i class="fa fa-eye"></i> View Report</a>';

      $dropDown .= '</div></div>';

      $item->action = $dropDown;
    }

    return [$reports, $totalReport];
  }

  /**
   * View the monthly fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function viewMonthlyReport(Request $request)
  {
    $data = $request->all();
    if ($data) {
      $id = $data['id'];
      $agentId = $data['agent_id'];
      $report = AgentMonthlyReport::where('id', $id)->first();
      if ($report) {
        return view('agent.dashboard.Fees.view_monthly_report', compact('report'));
      }
    }

    return "";
  }

  /**
   * Update the status
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function updateMonthlyReportStatus(Request $request)
  {
    $report = true;
    $data = $request->all();
    if ($data) {
      $id = $data['id'];
      $status = $data['status'];
      $report = AgentMonthlyReport::where('id', $id)->first();
      if ($report) {
        $report->status = $status;
        if ($report->save()) {
          return $this->successResponse('Monthly fee report status successfully updated.');
        }
      } else {
        return $this->errorResponse('Monthly fee report data not found.');
      }
    }
    return $this->errorResponse('Error occurred while updating the status.');
  }
}
