<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\FeesConciergeService;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Services\FeesSummeryService;
use App\Services\FeeSummaryService;
use Illuminate\View\Component;
use Override;

use function App\View\Components\render;

class FeesSummaryController extends Controller
{

  protected $feeService;
  protected $feeSummary;

  public function __construct(FeesSummeryService $feesSummeryService, FeeSummaryService $feeSummaryService )
  {
    $this->feeService = $feesSummeryService;
    $this->feeSummary = $feeSummaryService;
  }



  public function feesSummary(Request $request)
  {

    $fy = $request->get('fee_summery_advertiser_fy') ?? $this->feeService->currentFYLabel();
    $displayType =  $request->get('display_type') ?? 'member_id';
  
    // $feeSummery = $this->feeService->getSummeryData(
    //   requestedFY: $fy,
    //   displayType: $displayType
    // );

    $feeSummery = $this->feeSummary->getSummaryData(
        $request->get('fee_summery_advertiser_fy'),
        $request->get('display_type', 'member_id')
    );

    $singleSummery =  $this->feeSummary->getReport(6); //for single 

 


    return  view('agent.dashboard.Fees.fees_summary.summary', compact('feeSummery'));
  }

  public function singleAdvertiserFeeSummary(Request $request){
      $type = $request->type;
      if($type == 'escort'){
        // query path
       $html = view('agent.dashboard.Fees.fees_summary.single_escort_summery', compact('datas'))->render();
      }else{
        $html = view('agent.dashboard.Fees.fees_summary.single_massage_summery', compact('datas'))->render();
      }
      return success_response(['html' => $html], 'OK', 200);

  }

  // public function fetchFeeSummeryAdvertiserData(Request $request)
  // {
  //   $fy = $request->get('fy');
  //   $displayType = $request->display_type;

  //   try {
  //     $datas = $this->feeService->getSummeryData(
  //       requestedFY: $request->get('fy'),
  //       displayType: $request->get('display_type', 'member_id')
  //     );

  //   $html = view('agent.dashboard.Fees.fees_summery_advertiser_table_data', compact('datas'))->render();
  //   return success_response(['html' => $html, 'datas' => $datas], 'OK', 200);
  //   //return success_response('Data fetched successfully', ['html' => $html]);

  //   } catch (\Exception $e) {
  //     return error_response('Invalid financial year format.');
  //   }


  // }
}
