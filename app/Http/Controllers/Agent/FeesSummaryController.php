<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\FeesConciergeService;
use App\Models\MassagePurchase;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\Purchase;
use App\Models\User;
use App\Services\FeesSummeryService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Override;

use function App\View\Components\render;

class FeesSummaryController extends Controller
{

  protected $feeService;


  public function __construct(FeesSummeryService $feesSummeryService, )
  {
    $this->feeService = $feesSummeryService;

  }



  public function feesSummary(Request $request)
  {

    $fy = $request->get('fee_summery_advertiser_fy') ?? $this->feeService->currentFYLabel();
    $displayType =  $request->get('display_type') ?? 'member_id';
  
    $feeSummery = $this->feeService->getSummeryData(
      requestedFY: $fy,
      displayType: $displayType
    );

    //dd($feeSummery);

    // $feeSummery = $this->feeSummary->getSummaryData(
    //     $request->get('fee_summery_advertiser_fy'),
    //     $request->get('display_type', 'member_id')
    // );

    //$singleSummery =  $this->feeService->getReport(6); //for single 


     $listing = MassagePurchase::with('paymentItems.payment')->where('status', 'listed')->where('id', 9)->first();
     //dd($listing);

 


    return  view('agent.dashboard.Fees.fees_summary.summary', compact('feeSummery'));
  }

  public function singleAdvertiserFeeSummary(Request $request){
      $type = strtoupper((string) $request->input('type'));
      $advertiserId = (int) $request->input('advertiser_id');
      //dd($type,$advertiserId);

      abort_unless($advertiserId > 0, 422, 'Advertiser is required.');
      abort_unless(in_array($type, ['E', 'MS', 'MC'], true), 422, 'Invalid advertiser type.');

      $datas = $this->feeService->getReport($advertiserId);
    
      $view = $type === 'E'  ? 'agent.dashboard.Fees.fees_summary.single_escort_summery' : 'agent.dashboard.Fees.fees_summary.single_massage_summery';
      $html = view($view, compact('datas'))->render();

      return success_response(['html' => $html], 'OK', 200);

  }

  public function printAdvertiserFeeSummary(Request $request)
  {
      $type = strtoupper((string) $request->input('type'));
      $advertiserId = (int) $request->input('advertiser_id');

      abort_unless($advertiserId > 0, 422, 'Advertiser is required.');
      abort_unless(in_array($type, ['E', 'MS', 'MC'], true), 422, 'Invalid advertiser type.');

      $advertiser = User::query()
          ->whereKey($advertiserId)
          ->where('assigned_agent_id', Auth::id())
          ->whereIn('type', ['3', '4'])
          ->firstOrFail();

      $datas = $this->feeService->getReport($advertiserId);

      $pdf = Pdf::loadView(
          'agent.dashboard.Fees.fees_summary.print_advertiser_summary',
          compact('datas')
      )->setPaper('a4', 'landscape');

      return $pdf->stream('advertiser-report-' . $advertiserId . '.pdf');
  }


}
