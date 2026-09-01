<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\AgentCommission;
use App\Models\OperatorMonthlyReport;
use App\Models\OperatorMonthlyReportQuery;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\State;
use App\Models\User;
use App\Models\Country;
use App\Models\Operator;
use App\Services\CalculateAgentFeeService;
use App\Services\CalculateOperatorFeeService;
use App\Models\VariablAgentOperator;
use App\Models\Notification;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;

class OperatorMonthlyReportController extends BaseController
{

  /**
   *  View the monthly fee reports list
   */
  public function monthlyReport()
  {
    //$calculateServiceObj = (new CalculateOperatorFeeService);
    //$feeData = $calculateServiceObj->getOperatorFeeDetails(3);
    //dd($feeData);
    return view('admin.management.operator.fees.monthly-fee-reports');
  }


  public function monthlyReportAjax()
  {
    $userId = auth()->user()->id;
    $reportObj = (new OperatorMonthlyReport);
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
      Log::info("Operator fee report erro: " . $e->getMessage());
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
    $reports = OperatorMonthlyReport::with('operator', 'operatorMonthlyReportQuery');

    $search = request()->input('search.value');

    if (!empty($search)) {
      $reports->where(function ($query) use ($search) {
        //$query->where('status', 'like', "%{$search}%");
        $query->orWhereHas('operator', function ($q) use ($search) {
          $q->where('member_id', 'like', "%{$search}%");
        });
      });
    }

    switch ($order_key) {
      case 0:
        $reports->orderBy('billing_period_from', $dir);
        break;
      case 4:
        $reports->orderBy('status', $dir);
        break;
      default:
        $reports->orderBy('billing_period_from', 'DESC');
        break;
    }

    $totalReport = $reports->count();
    $reports = $reports->offset($start)->limit($limit)->get();

    foreach ($reports as $item) {
      $approvedDate = "";
      $queryCount = $item->operatorMonthlyReportQuery->where('status', 'query')->where('notes', '!=', "")->count();
      $item->reportDate = Carbon::parse($item->report_date)->format('d-m-Y');
      $fromDate = Carbon::parse($item->billing_period_from)->format('d-m-Y');
      $toDate = Carbon::parse($item->billing_period_to)->format('d-m-Y');

      $item->billing_period =  $fromDate . " to " . $toDate;
      $item->billing_period_to =  $item->billing_period_to;
      $item->agent_id =  $item->operator->member_id;
      $item->agent_name =  $item->operator->business_name;
      $item->territory =  $item->operator->country?->iso3 ?? '';
      $formattedSpend = '<div class="num_value"><span>$</span><span>' . number_format($item->spend, 2, '.', '') . '</span></div>';
      $formattedFees = '<div class="num_value"><span>$</span><span>' . number_format($item->fees, 2, '.', '') . '</span></div>';
      $item->total_spend =  $formattedSpend;
      $item->total_fees =   $formattedFees;
      $status = ucfirst($item->status);
      $statusName = str_replace('_', " ", $status);
      $item->status_name = '<span class="custom_badge ' . getStatusBadgeClass($status) . '">' . ucwords($statusName) . ' </span>';

      $item->report_pproved_date = "N/A";
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
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="paid"  id="viewPayOperatorRreport"><i class="fa fa-star"></i>Pay</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'paid') {
        //pending
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="pending"  id="updateMonthlyReportStatus"><i class="fa fa-search-minus"></i>Pending</a>';
      } else if ($item->status == 'query') {


        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query" id="openQueryModel"><i class="fa fa-search-minus"></i></i>Reply Query</a>';
        $divider = '<div class="dropdown-divider"></div>';
      } else if ($item->status == 'query_resolved') {
        //Approve
        $dropDown .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="approved"  id="updateMonthlyReportStatus"><i class="fa fa-check-circle"></i>Approve</a>';

        /*$dropDown .= '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-status="query"  id="openQueryModel"><i class="fa fa-search-minus"></i>Query</a>';
        $divider = '<div class="dropdown-divider"></div>'; */
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
      $dropDown .= $divider . '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0)" data-id="' . $item->id . '" data-operator_id="' . $item->agent_id . '" id="getMontlyViewReportPage"> <i class="fa fa-eye"></i> View Report</a>';


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
    if (isset($data['id']) && $data['id'] > 0) {
      $id = $data['id'];
      $calculateServiceObj = (new CalculateOperatorFeeService);
      //Prepare the operator monthly fee data for view detail
      $feeDatas = $calculateServiceObj->getOperatorFeeDetails($id);

      if (count($feeDatas) > 0) {
        return view('admin.management.operator.fees.view_monthly_report', compact('feeDatas'));
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
      $report = OperatorMonthlyReport::where('id', $id)->first();
      if ($report) {
        $report->status = $status;
        if ($report->save()) {
          if ($status == 'query' || $status == 'query_resolved') {
            $userId = auth()->user()->id;
            $userType = auth()->user()->type;
            $reportQueryObj = (new OperatorMonthlyReportQuery);
            $reportQueryObj->fee_report_id = $id;
            $reportQueryObj->status = $status;
            $reportQueryObj->submitted_by = $userId;
            $reportQueryObj->user_type = $userType;
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
    $report = OperatorMonthlyReport::where('id', $reportId)->first();
    if ($report) {
      $reportMonth = Carbon::parse($report->report_date)->format('F');
      $operatorMemberId = $report->operator->member_id;
      $calculateServiceObj = (new CalculateOperatorFeeService);
      $feeDatas = $calculateServiceObj->getOperatorFeeDetails($reportId);
      $reportEndDate = Carbon::parse($report->billing_period_to)->format('d-m-Y');
      //return view('admin.management.operator.fees.print_monthly_report', compact('feeDatas', 'operatorMemberId', 'reportEndDate'));
      if (count($feeDatas) > 0) {
        $pdf = PDF::loadView(
          'admin.management.operator.fees.print_monthly_report',
          [
            'feeDatas' => $feeDatas,
            'operatorMemberId' => $operatorMemberId,
            'reportEndDate' => $reportEndDate
          ]
        )->setOption(['isRemoteEnabled' => true]);

        $fileName = 'operator_monthly_fee_report_' . $operatorMemberId . '-' . $reportMonth . '.pdf';
        return $pdf->stream($fileName);
      }
    }
    return response()->redirectTo('/admin-dashboard/management/operator/monthly-fee-reports')->with('error', 'Monthly fee record not found.');
  }

  /**
   * View the monthly fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function viewQuery(Request $request)
  {
    $data = $request->all();
    if (isset($data['id']) && $data['id'] > 0) {
      $id = $data['id'];
      $queryObj = (new OperatorMonthlyReportQuery);

      $queryData = $queryObj->with('submittedBy')
        ->where('fee_report_id', $id)
        ->where('status', 'query')
        ->where('notes', '!=', "")
        ->get();

      if ($queryData->isNotEmpty()) {
        return view('admin.management.operator.fees.view_query', compact('queryData'));
      }
    }
    return "";
  }

  /**
   * View the monthly pay fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function viewPayOperatorRreport(Request $request)
  {
    $reportId  = $request->report_id;
    $response['error'] = 1;
    $response['data'] = [];

    if (!empty($reportId)) {

      $report = OperatorMonthlyReport::where('id', $reportId)->first();
      if ($report) {
        $reportDate = Carbon::parse($report->report_date)->format('d-m-Y');
        $reportMonth = Carbon::parse($report->report_date)->format('F');
        $reportData['operatorId'] = $report->operator->member_id;
        $reportData['payMonthlyReportDate'] = $reportDate;
        $reportData['payMonthlyReportMonth'] = $reportMonth;
        $reportData['payOperatorFee'] = number_format($report->fees, 2, '.', '');


        $response['error'] = 0;
        $response['data'] = $reportData;
        return response()->json($response);
      }
    }
    return response()->json($response);
  }

  /**
   * Print the monthly pay fee detail
   * 
   * @param \Illuminate\Http\Request $request
   */
  public function printPayOperatorReport(Request $request)
  {
    try {
      $reportId  = $request->monthly_report_id;
     
      if (!empty($reportId)) {

        $report = OperatorMonthlyReport::where('id', $reportId)->first();
        if ($report) {
          $reportDate = Carbon::parse($report->report_date)->format('d-m-Y');
          $reportMonth = Carbon::parse($report->report_date)->format('F');
          $reportData['payOperatorId'] = $report->operator->member_id;
          $reportData['payMonthlyReportDate'] = $reportDate;
          $reportData['payMonthlyReportMonth'] = $reportMonth;
          $reportData['payOperatorFee'] = number_format($report->fees, 2, '.', '');
          $operatorId = $report->operator_id;

          $pdf = PDF::loadView(
            'admin.management.operator.fees.print_monthly_pay_report',
            ['reportData' => $reportData]
          )->setOption(['isRemoteEnabled' => true]);
          $fileName = 'operator_monthly_payment_authorisation_report_' . $report->operator->member_id . '-' . $reportMonth . '.pdf';
          $report->status = "paid";
          
          if ($report->save()) {
        
            $notification = (new Notification);
            $notificationTitle = 'Your<span style="color:#ff0505;"> Monthly Fee </span> has been paid for ' . $reportMonth . ' month. Please visit <a href="' . config('app.url') . '/operator-dashboard/operator-monthly-report">Fee Report</a> to acknowledge.';

            $notificationIcon = $notification->notificationIcon('general');

            // Write code for email report
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

          }
          return $pdf->stream($fileName);
        }
      }
     
    } catch (Exception $e) {
       dd($e->getMessage());
      return response()->redirectTo('/admin-dashboard/management/operator/monthly-fee-reports')->with('error', 'Error occurred while fetching the report data. Please try later.');
    }
    return response()->redirectTo('/admin-dashboard/management/operator/monthly-fee-reports')->with('error', 'Monthly fee record not found.');
  }
}
