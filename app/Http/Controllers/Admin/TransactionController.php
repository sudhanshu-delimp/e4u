<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentHistory;
use App\Services\PinPaymentService;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{

  protected $account;
  protected $pinService;
  public function __construct(PinPaymentService $pinService)
  {
    $this->pinService = $pinService;
    $this->middleware(function ($request, $next) {
      $this->account = auth()->user();
      return $next($request);
    });
  }
  public function index()
  {
    return view('admin.reports.transaction-summary');
  }

  public function transactionSummaryDatatable()
  {
    list($result, $count, $other) = $this->pinService->paginatedList(
      request()->get('start'),
      request()->get('length'),
      request()->get('order')[0]['column'],
      request()->get('order')[0]['dir'],
      request()->get('columns'),
      request()->get('search')['value']
    );
    $result = $this->pinService->modifyRecords($result);
    /* 
    $result->transform(function ($item) {
      $item->completed_by_member_id = optional($item->completedByUser)->member_id ?? 'NA';
      $item->user_member_id = optional($item->user)->member_id ?? 'NA';
      return $item;
    }); */
  
    $result->transform(function ($item) {
      $item->completed_by_member_id = optional($item->completedByUser)->member_id ?? 'NA';
      $item->user_member_id = optional($item->user)->member_id ?? 'NA';
      return $item;
    });

  //print_r($result[0]->toArray());die;

    return response()->json([
      "draw" => intval(request()->input('draw')),
      "recordsTotal" => intval($count),
      "recordsFiltered" => intval($count),
      "other" => $other,
      "data" => $result,
    ]);
  }

}
