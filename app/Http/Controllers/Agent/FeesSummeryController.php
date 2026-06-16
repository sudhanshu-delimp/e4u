<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\FeesConciergeService;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Services\FeesSummeryService;
use Illuminate\View\Component;
use Override;

use function App\View\Components\render;

class FeesSummeryController extends Controller
{

  protected $feeService;

  public function __construct(FeesSummeryService $feesSummeryService)
  {
    $this->feeService = $feesSummeryService;
  }



  public function feesSummery(Request $request)
  {
    $data = $this->feeService->getSummeryData(
      requestedFY: $request->get('fy'),
      displayType: $request->get('display_type', 'member_id')
    );




    // foreach ($data['earnings'] as $data) {
    //   dd($data);
    // }
    $availableFYs  =  $this->feeService->getAvailableFYs();
    return  view('agent.dashboard.Fees.summary', compact('availableFYs'));
  }

  public function fetchFeeSummeryAdvertiserData(Request $request)
  {
    $fy = $request->get('fy');
    $displayType = $request->display_type;

    try {
      $datas = $this->feeService->getSummeryData(
        requestedFY: $request->get('fy'),
        displayType: $request->get('display_type', 'member_id')
      );

    $html = view('agent.dashboard.Fees.fees_summery_advertiser_table_data', compact('datas'))->render();
    return success_response($html, 'OK', 200);
    //return success_response('Data fetched successfully', ['html' => $html]);

    } catch (\Exception $e) {
      return error_response('Invalid financial year format.');
    }


   

  }
}
