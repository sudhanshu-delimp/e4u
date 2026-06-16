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
use Override;

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
            requestedFY:  $request->get('fy'),       
            displayType:  $request->get('display_type', 'member_id')
        );
      $availableFYs  =  $this->feeService->getAvailableFYs();
    return  view('agent.dashboard.Fees.summary', compact('availableFYs'));
  }
}
