<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\BaseController;
use App\Models\AgentCommission;
use App\Models\AgentMonthlyReport;
use App\Models\AgentMonthlyReportQuery;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\User;
use App\Services\CalculateAgentFeeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;

class MonthlyReportController extends BaseController
{

  /**
   *  View the monthly fee reports list
   * 
   * @return \Illuminate\View\View
   */
  public function monthlyReport()
  {
    return  view('agent.dashboard.Fees.monthly-report');
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
      ->with('state', 'agent', 'agentMonthlyReportQuery');

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

      $queryCount = $item->agentMonthlyReportQuery->where('status', 'query')->where('notes', '!=', "")->count();
      $item->reportDate = Carbon::parse($item->report_date)->format('d-m-Y');
      $fromDate = Carbon::parse($item->billing_period_from)->format('d-m-Y');
      $toDate = Carbon::parse($item->billing_period_to)->format('d-m-Y');

      $item->billing_period =  $fromDate . " to " . $toDate;
      $item->billing_period_to =  $item->billing_period_to;
      $item->agent_name =  $item->agent->business_name;
      $item->territory =  $item->state?->iso2 ?? '';
      $formattedSpend = '<div class="num_value"><span>$</span><span>' . number_format($item->spend, 2, '.', '') . '</span></div>';
      $formattedFees = '<div class="num_value"><span>$</span><span>' . number_format($item->fees, 2, '.', '') . '</span></div>';
      $item->total_spend =  $formattedSpend;
      $item->total_fees =   $formattedFees;
      $status = ucfirst($item->status);
      $statusName = str_replace('_', " ", $status);
      $item->status_name = '<span class="custom_badge ' . getStatusBadgeClass($status) . '">' . ucwords($statusName) . ' </span>';

      $item->report_pproved_date =  "";
      $item->approved_by =  $item->approved_by;

      $dropDown = '<div class="dropdown no-arrow"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';
      $divider = "";
      if (in_array($item->status, ['approved', 'paid'])) {
        $approvedDate = (!empty($item->report_approved)) ? Carbon::parse($item->report_approved)->format('d-m-Y') : null;
        $item->report_pproved_date =  $approvedDate;
      }

      if ($item->status == 'pending') {
        //Approve
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';
        $divider = '<div class="dropdown-divider"></div>';
        //Query
        $dropDown .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="openQueryModel"><i class="fa fa-search-minus"></i>Query</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'approved') {
        //Query
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="openQueryModel"><i class="fa fa-search-minus"></i>Query</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'paid') {
        //Query
        //$dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Query</a>';
      } else if ($item->status == 'query') {
        //Approve
        //$dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query_resolved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Query Resolve</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'query_resolved') {
        //Approve
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';

        $dropDown .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="openQueryModel"><i class="fa fa-search-minus"></i>Query</a>';
        $divider = '<div class="dropdown-divider"></div>';
      }

      //View Query
      if ($queryCount > 0) {
        $divider2 = "";
        if (empty($divider)) {
          $divider2 = '<div class="dropdown-divider"></div>';
        }
        $dropDown .= $divider . '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 getSubmittedQuery" href="javascript:void(0)" data-id="' . $item->id . '" > <i class="fa fa-eye"></i> View Query</a>' . $divider2;
      }

      //  View Detail
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
   * @return \Illuminate\View\View
   */
  public function viewMonthlyReport(Request $request)
  {
    $data = $request->all();
    if (isset($data['id']) && $data['id'] > 0) {
      $id = $data['id'];
      $calculateServiceObj = (new CalculateAgentFeeService);
      //Prepare the agent monthly fee data for view detail
      $feeData = $calculateServiceObj->calculateFee($id);

      if ($feeData->isNotEmpty()) {
        return view('agent.dashboard.Fees.view_monthly_report', compact('feeData'));
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
      $note = $data['note'] ?? "";
      $agentId = auth()->user()->id;
      $report = AgentMonthlyReport::where('id', $id)->first();
      if ($report) {
        $report->status = $status;
        if( $status == 'approved') {
           $report->report_approved = now();
        }
        if ($report->save()) {
          if ($status == 'query' || $status == 'query_resolved') {
            $reportQueryObj = (new AgentMonthlyReportQuery);
            $reportQueryObj->fee_report_id = $id;
            $reportQueryObj->status = $status;
            $reportQueryObj->submitted_by = $agentId;
            $reportQueryObj->user_type = 5;
            $reportQueryObj->report_date = date('Y-m-d H:i:s');;
            $reportQueryObj->notes = $note;
            $reportQueryObj->save();
          }

          return $this->successResponse('Monthly fee report status successfully updated.');
        }
      } else {
        return $this->errorResponse('Monthly fee report data not found.');
      }
    }
    return $this->errorResponse('Error occurred while updating the status.');
  }

  public function printMonthlyFee(Request $request)
  {

    $reportId  = $request->fee_print_id;
    $report = AgentMonthlyReport::where('id', $reportId)->first();
    if ($report) {
      $calculateServiceObj = (new CalculateAgentFeeService);
      $feeData = $calculateServiceObj->calculateFee($reportId);
      //return view('agent.dashboard.Fees.print_monthly_report', compact('feeData'));
      if ($feeData->isNotEmpty()) {
        $pdf = PDF::loadView(
          'agent.dashboard.Fees.print_monthly_report',
          ['feeData' => $feeData]
        )->setOption(['isRemoteEnabled' => true]);
        return $pdf->stream('monthly_agent_fee_report.pdf');
      }
    }
    return response()->redirectTo('/agent-dashboard/fees/monthly-report')->with('error', 'Monthly fee record not found.');
  }

  /**
   * View the monthly fee detail
   * 
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\View\View
   */
  public function viewQuery(Request $request)
  {
    $data = $request->all();
    if (isset($data['id']) && $data['id'] > 0) {
      $id = $data['id'];
      $queryObj = (new AgentMonthlyReportQuery);

      $queryData = $queryObj->with('submittedBy')
        ->where('fee_report_id', $id)
        ->where('status', 'query')
        ->where('notes', '!=', "")
        ->get();

      if ($queryData->isNotEmpty()) {
        return view('agent.dashboard.Fees.view_query', compact('queryData'));
      }
    }
    return "";
  }

  /**
   * Display the authenticated agent's income summary page.
   *
   * @return \Illuminate\View\View
   */
  public function myIncome()
  {
    $agentData = auth()->user();

    $agentId = $agentData->id;

    $startToday = Carbon::today()->format("Y-m-d 00:00:00");
    $endToday = Carbon::today()->format("Y-m-d 23:59:59");
    $weekStart = Carbon::now()->startOfWeek()->format("Y-m-d 00:00:00");
    $weekEnd = Carbon::now()->endOfWeek()->format("Y-m-d 23:59:59");
    $monthStart = Carbon::now()->startOfMonth()->format("Y-m-d 00:00:00");
    $monthEnd = Carbon::now()->endOfMonth()->format("Y-m-d 23:59:59");;
    $yearStart = Carbon::now()->startOfYear()->format("Y-m-d 00:00:00");;
    $yearEnd = Carbon::now()->endOfYear()->format("Y-m-d 23:59:59");;
    $commissions = AgentCommission::where('agent_id', $agentId);

    $advertisers = [
      'today' => $this->getIncome($commissions, [3, 4], $startToday, $endToday),
      'week'  => $this->getIncome($commissions, [3, 4], $weekStart, $weekEnd),
      'month' => $this->getIncome($commissions, [3, 4], $monthStart, $monthEnd),
      'year'  => $this->getIncome($commissions, [3, 4], $yearStart, $yearEnd),
    ];

    $escorts = [
      'today' => $this->getIncome($commissions, [3], $startToday, $endToday),
      'week'  => $this->getIncome($commissions, [3], $weekStart, $weekEnd),
      'month' => $this->getIncome($commissions, [3], $monthStart, $monthEnd),
      'year'  => $this->getIncome($commissions, [3], $yearStart, $yearEnd),
    ];

    $massageCentres = [
      'today' => $this->getIncome($commissions, [4], $startToday, $endToday),
      'week'  => $this->getIncome($commissions, [4], $weekStart, $weekEnd),
      'month' => $this->getIncome($commissions, [4], $monthStart, $monthEnd),
      'year'  => $this->getIncome($commissions, [4], $yearStart, $yearEnd),
    ];

    return  view('agent.dashboard.Fees.my-income', compact('advertisers', 'escorts', 'massageCentres'));
  }

  private function getIncome($query, $userTypes, $from, $to)
  {
    $sum =  (clone $query)
      ->whereIn('user_type', (array) $userTypes)
      ->whereBetween('commission_date', [$from, $to])
      ->sum('total_commission_amount');
    return number_format($sum, 2, ".", "");
  }
}
