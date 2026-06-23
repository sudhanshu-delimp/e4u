<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Mail\PaymentMailer;
use App\Models\PaymentHistory;
use App\Models\PaymentProcess;
use App\Repositories\Message\MessageRepository;
use App\Services\PinPaymentService;
use App\Services\WalletService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends BaseController
{
  
    protected $account;
    protected $walletService;
    protected $pinService;
    protected $user;
    protected $massage;

  
    
    public function __construct(WalletService $walletService,  PinPaymentService $pinService, MessageRepository $massage)
    {
        $this->massage = $massage;
        $this->walletService = $walletService;
        $this->pinService = $pinService;
     
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    public function make_order_summury(Request $request)
    {
        $discountRate_amount = isset($request->total_rate) ? $request->total_rate : 0;
        $discountRate = isset($request->total_rate) ? formatCurrency($request->total_rate) : 0;
        $loyalty_day = $request->filled('loyalty_day') ? (int) $request->loyalty_day : 0;
        $action = $request->filled('action_type') ? $request->action_type : '';


        $total_rate = isset($request->total_rate) ? formatCurrency($request->total_rate) : 0;
        $total_discount = isset($request->total_discount) ? formatCurrency($request->total_discount) : 0;
        $total_days = isset($request->days) ? $request->days : 0;
        $normalRate = isset($request->normalRate) ? formatCurrency($request->normalRate) : 0;
        $gstTax = isset($request->total_rate) ? getGSTAmount($request->total_rate) : '$0.00';

        $wallet_discount_amount = isset($request->wallet_discount) ? $request->wallet_discount : 0;
        $loyalty_discount_amount = isset($request->loyalty_discount) ? $request->loyalty_discount : 0;

        $loyalty_use = formatCurrency($wallet_discount_amount);
        $wallet_use = formatCurrency($loyalty_discount_amount);

        $total_fee_amount = $discountRate_amount - $wallet_discount_amount + $loyalty_discount_amount;
        $total_due_amount = $total_fee_amount + $gstTax;

        $total_fee = formatCurrency($total_fee_amount);
        $total_due = formatCurrency($total_due_amount);


        $order_data = [
            'paymentSubtotal' =>  $discountRate,
            'total_fee' => $total_fee,
            'total_due' => $total_due,
            'loyalty_use' => $loyalty_use,
            'wallet_use' => $wallet_use,
            'total_rate' =>  $total_rate,
            'total_discount' => $total_discount,
            'total_days' =>  $total_days,
            'normalRate' =>  $normalRate,
            'gstTax' =>  $gstTax,
            'loyalty_day' => $loyalty_day,
             'pay_data' => [
                'sub_total_amount' => $discountRate_amount,
                'total_amount' =>  (float)  $total_due_amount,
                'loyalty_amount' => $loyalty_day,
                'wallet_amount' => (float)  $wallet_discount_amount,
                'gstTax' =>  (float)  $gstTax,
                'action' => $action,
             ],
        ];




      return  response()->json([
            'success' => true,
            'data' => $order_data,
            'message' => "order summury"
        ]);
        
    }


    public function paymentAdjustment(Request $request)
    {
      try 
       {
        
            $action = $request->filled('action_type') ? $request->action_type : '';
            $wallet_amount = $request->filled('wallet_amount') ? (float) $request->wallet_amount : 0;
            $loyalty_day = $request->filled('loyalty_day') ? (int) $request->loyalty_day : 0;
            $discountRate_amount = isset($request->total_rate) ? $request->total_rate : 0;
            $plan_rate = isset($request->normalRate) ? $request->normalRate : 0;

            
            $gstTax = isset($request->total_rate) ? getGSTAmount($request->total_rate) : 0.00;
           
            if (empty($wallet_amount) && empty($loyalty_day)) {
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

            ########### Total Points ################
            $loyality_amount = $plan_rate*$loyalty_day;
            $total_points = $wallet_amount + $loyality_amount;

            ########### Amount with gst #################
            $total_due_amount = $discountRate_amount + $gstTax;
            
        

            if($total_points>=$total_due_amount)
             {
                return response()->json([
                    'status'  => false,
                    'message' => 'Yout Loyalty and wallet amount exceed the due amount.',
                ], 422);
             }


            return response()->json([
                'status'  => true,
                'message' => 'Benifit applied succuessfully.',
                'loyality_amount' => $loyality_amount,
                'wallet_balance' => $wallet_amount,
                'loyalty_day' => $loyalty_day,
              
            ],200);

            
        } 
        catch (Exception $e) {
           return response()->json([
                    'status'  => false,
                    'message' => 'Error occured while applying benifit.',
           ], 422);
        }
    }
        
        
    public function processPayment(Request $request)
    {

        try 
        {
    
            $request->validate([
                'pin_token' => 'required'
            ]);

            $pin_token = str_contains($request->pin_token, 'card') ? $request->pin_token : decrypt($request->pin_token);

            $secretKey = config('app.aes_key');
            $iv        = config('app.aes_iv_string');
            $encrypted = $request->benefit_token;
            $decrypted = openssl_decrypt($encrypted,'AES-256-CBC',$secretKey,0,$iv);
            $benefit_token = json_decode($decrypted, true);
            $payload_data  = $request->payload_data;


            $is_bypass = $pin_token == 'without_pay_now';

            $redirect_url = '';
            $gatewayResponse['status'] = true;
            $amount = $benefit_token['sub_total_amount'];

           
            $this->pinService->setAmount($benefit_token['total_amount']);
            $this->pinService->setWalletAmount($benefit_token['wallet_amount']);

            $gstAmount = $this->pinService->getGSTAmount();
            $totalDueAmount = $this->pinService->getTotalDue();

            /* Insert records for the payment history table */
            $insert = [];
            $insert['user_id'] = $this->account->id;
            $insert['completed_by'] = $request->isImpersonated ? $request->impersonatedId : $this->account->id;
            $insert['ref_no'] = generateReferenceNo(PaymentHistory::class);
            $insert['amount'] = $benefit_token['sub_total_amount'];
            $insert['wallet_amount'] = $benefit_token['wallet_amount'];
            $insert['loyalty_amount'] = $benefit_token['loyalty_amount'];
            $insert['net_amount'] = $benefit_token['total_amount'];
            $insert['gst_amount'] = $gstAmount;
            $insert['paid_amount'] = $totalDueAmount;


            if (!$is_bypass) 
            {

                switch ($benefit_token['action']) {
                    case 'listing': {
                            $payload = $payload_data;
                        }
                        break;
                    case 'tour': {
                            $payload = $payload_data;
                        }
                        break;
                    case 'extend': {
                            $payload = $payload_data;
                        }
                        break;
                    case 'pinup': {
                        }
                        break;
                    case 'bumpUp': {
                        }
                        break;
                    case 'upgrade': {
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
                ]);

                $metaData = [
                    'type' => 'massage-listing',
                    'action' => $benefit_token['action'],
                    'insert' => json_encode($insert),
                    'process_token' => (string) $paymentProcess->token,
                ];

                $gatewayResponse = $this->pinService->charge($pin_token, $totalDueAmount, $this->account->email, null, $metaData);
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
                        $payment_service = 'Profile Listing';
                        $redirect_url = route('center.payment-completed');
                    }
                    break;
                case 'tour': {
                        $payment_service = 'Tour';
                        $redirect_url = route('center.payment-completed');
                    }
                    break;
                case 'extend': {
                        $payment_service = 'Profile Extend';
                        $redirect_url = route('center.payment-completed');
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

            $payment->service = $payment_service;
            $payment->save();

            /* Send Payment Mail */
            if (in_array($benefit_token['action'], ['listing', 'tour', 'extend'])) {
                $extend_days = empty($result['extend_days']) ? 0 : $result['extend_days'];
                $mailConfig = config("payment_mail_templates.{$benefit_token['action']}");
                Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment', 'extend_days'), $mailConfig['subject']));
            }

            DB::commit();
            //Artisan::queue('profile:sync-status');
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
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Payment Processing Error', [
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


    public function SSprocessPayment(Request $request)
    {
        try {

            $request->validate([
                'pin_token' => 'required'
            ]);

            $pin_token = str_contains($request->pin_token, 'card') ? $request->pin_token : decrypt($request->pin_token);

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

            $this->pinService->setAmount($benefit_token['total_amount']);
            $this->pinService->setWalletAmount($benefit_token['wallet_amount']);

            $gstAmount = $this->pinService->getGSTAmount();
            $totalDueAmount = $this->pinService->getTotalDue();

            /* Insert records for the payment history table */
            $insert = [];
            $insert['user_id'] = $this->account->id;
            $insert['completed_by'] = $request->isImpersonated ? $request->impersonatedId : $this->account->id;
            $insert['ref_no'] = generateReferenceNo(PaymentHistory::class);
            $insert['amount'] = $benefit_token['sub_total_amount'];
            $insert['wallet_amount'] = $benefit_token['wallet_amount'];
            $insert['loyalty_amount'] = $benefit_token['loyalty_amount'];
            $insert['net_amount'] = $benefit_token['total_amount'];
            $insert['gst_amount'] = $gstAmount;
            $insert['paid_amount'] = $totalDueAmount;

            if (!$is_bypass) {

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
                        }
                        break;
                    case 'bumpUp': {
                        }
                        break;
                    case 'upgrade': {
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
                ]);

                $metaData = [
                    'type' => 'escort-listing',
                    'action' => $benefit_token['action'],
                    'insert' => json_encode($insert),
                    'process_token' => (string) $paymentProcess->token,
                ];

                $gatewayResponse = $this->pinService->charge($pin_token, $totalDueAmount, $this->account->email, null, $metaData);
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
                        $payment_service = 'Profile Listing';
                        $redirect_url = route('center.payment-completed');
                    }
                    break;
                case 'tour': {
                        $result = $this->saveCheckout($benefit_token['action'], $payment);
                        $payment_service = 'Tour';
                        $redirect_url = route('center.payment-completed');
                    }
                    break;
                case 'extend': {
                        $result = $this->saveCheckout($benefit_token['action'], $payment);
                        $payment_service = 'Profile Extend';
                        $redirect_url = route('center.payment-completed');
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

            $payment->service = $payment_service;
            $payment->save();

            /* Send Payment Mail */
            if (in_array($benefit_token['action'], ['listing', 'tour', 'extend'])) {
                $extend_days = empty($result['extend_days']) ? 0 : $result['extend_days'];
                $mailConfig = config("payment_mail_templates.{$benefit_token['action']}");
                Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment', 'extend_days'), $mailConfig['subject']));
            }

            DB::commit();
            //Artisan::queue('profile:sync-status');
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



}
