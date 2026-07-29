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

    $result->transform(function ($item) {
      $item->completed_by_member_id = optional($item->completedByUser)->member_id ?? 'NA';
      $item->user_member_id = optional($item->user)->member_id ?? 'NA';
      return $item;
    });

    return response()->json([
      "draw" => intval(request()->input('draw')),
      "recordsTotal" => intval($count),
      "recordsFiltered" => intval($count),
      "other" => $other,
      "data" => $result,
    ]);
  }
  public function paymentDetail(Request $request)
  {
    try {

      $id = decrypt($request->id);
      $payment = PaymentHistory::findOrFail($id);
      $html = view('escort.dashboard.Bookkeeping.modal.transaction-summary', compact('payment'))->render();
      
      return response()->json([
        'status' => true,
        'html'   => $html,
        'print_url' => route('admin.payment.detail.print', $payment->id),
        'message' => 'Listing fetched successfully'
      ]);

    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {

      return response()->json([
        'status' => false,
        'message' => 'Invalid listing id'
      ], 400);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

      return response()->json([
        'status' => false,
        'message' => 'Listing not found'
      ], 404);
    } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'message' => 'Something went wrong'
      ], 500);
    }
  }
  public function printPaymentDetail(PaymentHistory $payment)
  {
    $print = true;
    $pdf = PDF::loadView('escort.dashboard.Bookkeeping.modal.transaction-summary', compact('payment', 'print'));
    return $pdf->stream($payment->user->member_id . '_Payment_Summary_' . $payment->ref_no . '.pdf');
  }
}
