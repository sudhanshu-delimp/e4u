<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Escort\EscortInterface;
use App\Models\Purchase;
use App\Models\PaymentHistory;
use App\Models\PaymentProcess;
use App\Services\WalletService;
use App\Services\PinPaymentService;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Artisan;
use App\Mail\PaymentMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $account;
    protected $walletService;
    protected $pinService;
    protected $user;
    public function __construct(WalletService $walletService, PinPaymentService $pinService, EscortInterface $escort)
    {
        $this->escort = $escort;
        $this->walletService = $walletService;
        $this->pinService = $pinService;
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    protected function getAmount($action = null)
    {
        $amount = 0.00;

        if (in_array($action, ['listing', 'extend'])) {
            if (session()->has('checkout')) {
                $checkout = session()->get('checkout');
                foreach ($checkout as $startDate => $item) {
                    $daysDiff = Carbon::parse($item['end_date'])->diffInDays(Carbon::parse($item['start_date'])) + 1;
                    list($total_discount, $total_rate, $normalRate, $discountRate, $appiedDiscountAmount) = calculateTotalFee($item['membership'], $daysDiff, $this->account);
                    $amount = $amount + $total_rate;
                }
            }
        } else {
            if (session()->has('tour_checkout')) {
                $checkout = session()->get('tour_checkout');
                foreach ($checkout as $startDate => $item) {
                    $daysDiff = Carbon::parse($item['end_date'])->diffInDays(Carbon::parse($item['start_date'])) + 1;
                    list($total_discount, $total_rate, $normalRate, $discountRate, $appiedDiscountAmount) = calculateTotalFee($item['membership'], $daysDiff, $this->account);
                    $amount = $amount + $total_rate;
                }
            }
        }
        return $amount;
    }

    public function paymentAdjustment(Request $request)
    {
        try {

            $action = $request->filled('action') ? $request->action : '';
            $checkAmount = $request->filled('checkAmount') ? $request->boolean('checkAmount') : true;
            $wallet_amount = $request->filled('wallet_amount') ? (float) $request->wallet_amount : 0;
            $loyalty_day = $request->filled('loyalty_day') ? (int) $request->loyalty_day : 0;
            $feeAmount = $request->filled('fee_token') ? decrypt($request->fee_token) : 0;


            // At least one value is required
            if ($checkAmount == true && empty($wallet_amount) && empty($loyalty_day)) {
                return response()->json([
                    'status'  => false,
                    'message' => $action == 'listing' ? 'Please enter wallet amount or loyalty days.' : 'Please enter wallet amount.',
                ], 422);
            }

            $wallet_balance   = $this->account->wallet->balance ?? 0;
            $wallet_earn_days = $this->account->wallet->earn_days ?? 0;
            // Validate wallet amount
            if ($wallet_amount > $wallet_balance) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Wallet amount exceeds available balance',
                ], 422);
            }
            // Validate loyalty days
            if ($loyalty_day > $wallet_earn_days) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Loyalty days exceed available days',
                ], 422);
            }

            $sub_total_amount = match ($action) {
                'listing' => $this->getAmount($action),
                'extend' => $this->getAmount($action),
                'tour' => $this->getAmount($action),
                'pinup' => getPinupFee(),
                'bumpUp' => getBumpupFee(),
                'upgrade' => $feeAmount,
                'wallet' => $feeAmount,
                default => null,
            };

            $loyalty_amount = 0;

            if (session()->has('checkout')) {
                $checkout = session()->get('checkout');
                $lowestPlan = collect($checkout)->max('membership');
                $planFee = getPlanFee($lowestPlan);
                $loyalty_amount = ($planFee * $loyalty_day);
            }

            if (session()->has('tour_checkout')) {
                $checkout = session()->get('tour_checkout');
                $lowestPlan = collect($checkout)->max('membership');
                $planFee = getPlanFee($lowestPlan);
                $loyalty_amount = ($planFee * $loyalty_day);
            }

            $total_amount = ($sub_total_amount - $wallet_amount - $loyalty_amount);

            if (!in_array($action, ['wallet'])) {
                $this->pinService->setAmount($sub_total_amount);
                $this->pinService->setWalletAmount($wallet_amount);
                $this->pinService->setLoyaltyAmount($loyalty_amount);

                $gstAmount = $this->pinService->getGSTAmount();
                $totalDueAmount = $this->pinService->getTotalDue();
                $total_amount = max(0, $this->pinService->getDefaultTotalDue());
            } else {
                $gstAmount = 0;
                $totalDueAmount = $sub_total_amount;
                $total_amount = max(0, $sub_total_amount);
            }




            if ($total_amount < ($wallet_amount + $loyalty_amount)) {
                return response()->json([
                    'status'  => false,
                    'totalDefaultTotalDue' => $this->pinService->getDefaultTotalDue(),
                    'appyAmount' => ($wallet_amount + $loyalty_amount),
                    'message' => 'Wallet amount and Loyalty discount exceed total due.',
                ], 422);
            }


            $html = view('escort.dashboard.modal.order_summary_adjustment', compact('action', 'sub_total_amount', 'wallet_amount', 'loyalty_amount', 'total_amount', 'gstAmount', 'totalDueAmount'))->render();

            $benefit_token = encrypt(compact('action', 'loyalty_day', 'sub_total_amount', 'wallet_amount', 'loyalty_amount', 'total_amount', 'totalDueAmount'));
            return response()->json([
                'status'         => true,
                'lowest_plan' => $lowestPlan ?? 0,
                'total_amount' => $total_amount,
                'totalDueAmount' => $totalDueAmount,
                'benefit_token' => $benefit_token,
                'message' => 'Applied successfully',
                'html' => $html,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong' . '[' . $e->getMessage() . '] [' . $e->getLine() . ']',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function processPayment(Request $request)
    {
        try {

            $request->validate([
                'pin_token' => 'required'
            ]);

            $pin_token = str_contains($request->pin_token, 'card') ? $request->pin_token : decrypt($request->pin_token);
            $payload_token = $request->filled('payload_token') ? $request->payload_token : '';

            $is_bypass = $pin_token == 'without_pay_now';

            $redirect_url = '';
            $gatewayResponse['status'] = true;

            $amount = $this->getAmount();

            $benefit_token = $request->filled('benefit_token') ? decrypt($request->benefit_token) : [
                'action' => 'listing',
                'loyalty_day' => 0,
                'sub_total_amount' => $amount,
                'wallet_amount' => 0.00,
                'loyalty_amount' => 0.00,
                'total_amount' => $amount,
            ];

            $this->pinService->setAmount($benefit_token['sub_total_amount']);
            $this->pinService->setWalletAmount($benefit_token['wallet_amount']);
            $this->pinService->setLoyaltyAmount($benefit_token['loyalty_amount']);

            $mailConfig = config("payment_mail_templates.{$benefit_token['action']}");
            /* Insert records for the payment history table */
            $insert = [];
            $insert['user_id'] = $this->account->id;
            $insert['completed_by'] = $request->isImpersonated ? $request->impersonatedId : $this->account->id;
            $insert['ref_no'] = generateReferenceNo(PaymentHistory::class);
            $insert['service'] = $mailConfig['service_title'];
            $insert['amount'] = $benefit_token['sub_total_amount'];
            $insert['wallet_amount'] = $benefit_token['wallet_amount'];
            $insert['loyalty_amount'] = $benefit_token['loyalty_amount'];
            $insert['net_amount'] = $this->pinService->getNetAmount();
            $insert['gst_amount'] = !in_array($benefit_token['action'], ['wallet']) ? $this->pinService->getGSTAmount() : $this->pinService->getGSTAmount(0);
            $insert['paid_amount'] = $this->pinService->getTotalDue();

            if (!$is_bypass) {
                $payload = [];
                switch ($benefit_token['action']) {
                    case 'listing': {
                            $payload = session()->get('checkout');
                        }
                        break;
                    case 'tour': {
                            $payload = session()->get('tour_checkout');
                        }
                        break;
                    case 'extend': {
                            $payload = session()->get('checkout');
                        }
                        break;
                    case 'pinup': {
                            parse_str($payload_token, $payload);
                        }
                        break;
                    case 'bumpUp': {
                            parse_str($payload_token, $payload);
                        }
                        break;
                    case 'upgrade': {
                            parse_str($payload_token, $payload);
                        }
                        break;
                    case 'wallet': {
                        }
                        break;

                    default:
                        # code...
                        break;
                }

                $paymentProcess = PaymentProcess::create([
                    'token' => Str::uuid(),
                    'payload' => $payload,
                    'type' => $benefit_token['action'],
                    'benefit_token' => $benefit_token,
                ]);

                $metaData = [
                    'type' => 'escort-listing',
                    'action' => $benefit_token['action'],
                    'insert' => json_encode($insert),
                    'process_token' => (string) $paymentProcess->token,
                ];

                $gatewayResponse = $this->pinService->charge($pin_token, $this->pinService->getTotalDue(), $this->account->email, null, $metaData);

                if ($gatewayResponse['status']) {
                    $response = $gatewayResponse['data']['response'];
                } else {
                    return response()->json([
                        'status' => 'error',
                        'gateway' => $gatewayResponse['error']
                    ], 400);
                }
            }

            DB::beginTransaction();
            $insert['currency'] = $is_bypass ? 'AUD' : $response['currency'];
            $insert['transaction_id'] = $is_bypass ? null : $response['token'];
            $insert['status'] = $is_bypass ? 'success' : ($response['success'] ? 'success' : 'failed');
            $insert['paid_at'] = $is_bypass ? null : $response['created_at'];
            $insert['card'] = $is_bypass ? null : $response['card']['display_number'];
            $insert['meta'] = $is_bypass ? null : json_encode($response);
            $payment = PaymentHistory::create($insert);

            /** Calulate agent commisson and save the commission */
            $agentCommission = (new \App\Models\AgentCommission);
            if ($payment) {
                Log::info("saveCommissionData fuction calling from payment controller.");
                $agentResponse = $agentCommission->saveCommissionData($payment, $this->account->id, $benefit_token['total_amount']);
            }

            $payment_service = '';
            $mainAccount = $this->account;
            switch ($benefit_token['action']) {
                case 'listing': {
                        $result = $this->saveCheckout($benefit_token['action'], $payment);
                        $payment_service = 'Profile Listing';
                        $redirect_url = route('escort.account.listing_success');
                    }
                    break;
                case 'tour': {
                        $result = $this->saveCheckout($benefit_token['action'], $payment);
                        $payment_service = 'Tour';
                        $redirect_url = route('escort.account.listing_success');
                    }
                    break;
                case 'extend': {
                        $result = $this->saveCheckout($benefit_token['action'], $payment);
                        $payment_service = 'Profile Extend';
                        $redirect_url = route('escort.account.listing_success');
                    }
                    break;
                case 'pinup': {
                        $payment_service = 'Profile Pin Up';
                    }
                    break;
                case 'bumpUp': {
                        $payment_service = 'Profile Bump Up';
                    }
                    break;
                case 'upgrade': {
                        $payment_service = 'Profile Upgrade';
                    }
                    break;
                case 'wallet': {
                        $payment_service = 'Wallet Credit';
                        $creditTransaction = $this->walletService->credit(
                            $mainAccount,
                            $this->pinService->getTotalDue(),
                            $payment,
                            'Add Money',
                            [
                                'user_id' => $mainAccount->id
                            ]
                        );

                        $creditTransaction->paymentItems()->create([
                            'payment_history_id' => $payment->id,
                            'amount' => $payment->paid_rate,
                        ]);

                        Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment'), $mailConfig['subject']));

                        $redirect_url = route('escort.my_wallet');
                    }
                    break;

                default:
                    # code...
                    break;
            }

            if (!empty($benefit_token['wallet_amount']) && $benefit_token['wallet_amount'] > 0) {
                $this->walletService->debit($this->account, $benefit_token['wallet_amount'], $payment, $payment_service, []);
            }

            if (!empty($benefit_token['loyalty_day']) && $benefit_token['loyalty_day'] > 0) {
                $this->account->wallet->decrement('earn_days', $benefit_token['loyalty_day']);
            }

            if (in_array($benefit_token['action'], ['listing', 'tour', 'extend'])) {
                $earn_days = floor($benefit_token['total_amount'] / 200);
                if ($earn_days > 0) {
                    $this->walletService->updateEarnDays($this->account, $earn_days, 'add');
                }
            }

            /* Send Payment Mail */
            if (in_array($benefit_token['action'], ['listing', 'tour', 'extend'])) {
                $extend_days = empty($result['extend_days']) ? 0 : $result['extend_days'];
                $mailConfig = config("payment_mail_templates.{$benefit_token['action']}");
                Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment', 'extend_days'), $mailConfig['subject']));
            }

            DB::commit();
            Artisan::queue('profile:sync-status');
            return response()->json([
                'status' => 'success',
                'message' => 'Your payment has been processed successfully.',
                'netAmount' => $amount,
                'action' => $benefit_token['action'],
                'payment_id' => encrypt($payment->id),
                'redirect_url' => $redirect_url
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment Processing Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while processing payment.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function saveCheckout($action = null, $payment = null)
    {
        $response = [];
        if (session()->has('checkout') || session()->has('tour_checkout')) {
            $checkout = in_array($action, ['listing', 'extend']) ? session()->get('checkout') : session()->get('tour_checkout');
            $netPaidAmount = 0.00;
            foreach ($checkout as $startDate => $item) {
                $escortDetail = getEscortDetail($item['escort_id']);
                $start_date = Carbon::createFromFormat('d-m-Y', $item['start_date'])->format('Y-m-d') . ' 00:00:00';
                $end_date = Carbon::createFromFormat('d-m-Y', $item['end_date'])->format('Y-m-d') . ' 23:59:59';

                $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");

                $localStartDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$start_date", $profileTimezone);
                $utcSartTime = $localStartDateTime->copy()->setTimezone('UTC');

                $localEndDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$end_date", $profileTimezone);
                $utcEndTime = $localEndDateTime->copy()->setTimezone('UTC');

                $item['utc_start_time'] = $utcSartTime;
                $item['utc_end_time'] = $utcEndTime;
                $daysDiff = Carbon::parse($item['end_date'])->diffInDays(Carbon::parse($item['start_date'])) + 1;
                list($total_discount, $total_rate, $normalRate, $discountRate, $appiedDiscountAmount) = calculateTotalFee($item['membership'], $daysDiff, $this->account);
                $item['rate'] = $normalRate;
                $item['discount_rate'] = $discountRate;
                $item['total_rate'] = $normalRate * $daysDiff;
                $item['paid_rate'] = $total_rate;
                $purchaseDetail = Purchase::create($item);

                if (!empty($payment)) {
                    $purchaseDetail->paymentItems()->create([
                        'payment_history_id' => $payment->id,
                        'amount' => $purchaseDetail->paid_rate,
                    ]);
                }

                if ($this->account->activeFeeDiscount) {

                    $purchaseDetail->special_discount_value = $this->account->activeFeeDiscount->value;
                    $purchaseDetail->special_discount_type = $this->account->activeFeeDiscount->type;
                    $purchaseDetail->save();

                    $this->account->activeFeeDiscount()->increment('spend_amount', $appiedDiscountAmount);
                }

                if ($item['utc_start_time'] <= Carbon::now('UTC') && $item['utc_end_time'] >= Carbon::now('UTC')) {
                    $escortDetail->start_date = $item['start_date'];
                    $escortDetail->end_date = $item['end_date'];
                    $escortDetail->utc_start_time = $utcSartTime;
                    $escortDetail->utc_end_time = $utcEndTime;
                    $escortDetail->membership = $item['membership'];
                    $escortDetail->enabled = 1;
                    $escortDetail->purchase_id = $purchaseDetail->id;
                    $escortDetail->save();

                    $purchaseDetail->status = 'listed';
                    $purchaseDetail->save();
                }

                if ($action === 'extend') {
                    $response['extend_days'] = Carbon::parse($item['start_date'])->diffInDays(Carbon::parse($item['end_date'])) + 1;
                }
            }
        }
        return $response;
    }

    public function transactionSummary(Request $request)
    {
        return view('escort.dashboard.Bookkeeping.transaction-summary');
    }

    public function transactionSummaryDatatable()
    {
        list($result, $count, $other) = $this->pinService->paginatedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            $this->account
        );
        $result = $this->pinService->modifyRecords($result);
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "other" => $other,
            "data"            => $result
        );

        return response()->json($data);
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
                'print_url' => route('payment.detail.print', $payment->id),
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
