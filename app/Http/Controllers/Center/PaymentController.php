<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Mail\PaymentMailer;
use App\Models\MassageBumpup;
use App\Models\MassagePurchase;
use App\Models\PaymentHistory;
use App\Models\PaymentProcess;
use App\Repositories\Message\MessageRepository;
use App\Services\PinPaymentService;
use App\Services\WalletService;
use Carbon\Carbon;
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

    protected $secretKey;
    protected $iv;
    protected $aes_value;

  
    
    public function __construct(WalletService $walletService,  PinPaymentService $pinService, MessageRepository $massage)
    {
        $this->massage = $massage;
        $this->walletService = $walletService;
        $this->pinService = $pinService;

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });

        $this->secretKey = config('app.aes_key');
        $this->iv = config('app.aes_iv_string');
        $this->aes_value =  'AES-256-CBC';
    }

    public function make_order_summury(Request $request)
    {
        

        $loyalty_day = $request->filled('loyalty_day') ? (int) $request->loyalty_day : 0;

        $action = $request->filled('action_type') ? $request->action_type : '';
        $checkout_number = isset($request->checkout_number) ? $request->checkout_number : "";

        $total_rate = isset($request->discountRate) ? formatToFloat($request->discountRate) : 0;
        $total_discount = isset($request->total_discount) ? formatToFloat($request->total_discount) : 0;
        $total_days = isset($request->days) ? $request->days : 0;
        $plan_rate = isset($request->normalRate) ? formatToFloat($request->normalRate): 0;
        $gstTax = isset($request->discountRate) ? getGSTAmount(formatToFloat($request->discountRate)) : 0;



        $total_rate_format = isset($request->discountRate) ? formatCurrency($total_rate) : 0;
        $total_discount_format = isset($request->total_discount) ? formatCurrency($total_discount) : 0;
        $normal_rate_format = isset($request->normalRate) ? formatCurrency($plan_rate) : 0;
        $gstTax_format = isset($request->discountRate) ? '$'.getGSTAmount($total_rate) : '$0.00';



        $wallet_amount = isset($request->wallet_discount) ? $request->wallet_discount : 0;
        $loyalty_amount = isset($request->loyalty_discount) ? $request->loyalty_discount : 0;

        $loyalty_format = formatCurrency($loyalty_amount);
        $wallet_format = formatCurrency($wallet_amount);
        

        $total_fee = $total_rate;

        ########### Total Points ################
        $loyality_amount = $plan_rate*$loyalty_day;
        $total_points = $wallet_amount + $loyality_amount;

        $total_due  = max(0, (float) $total_fee + (float)$gstTax - (float)$total_points);

        $total_fee_format = formatCurrency($total_fee);
        $total_due_format = formatCurrency($total_due);


        $order_data = [
            'paymentSubtotal' =>  $total_rate,
            'total_fee' => $total_fee,
            'total_due' => $total_due,
            'loyalty_use' => $wallet_amount,
            'wallet_use' => $loyalty_amount,
            'total_rate' =>  $total_rate,
            'total_discount' => $total_discount,
            'total_days' =>  $total_days,
            'normalRate' =>  $plan_rate,
            'gstTax' =>  $gstTax,
            'loyalty_day' => $loyalty_day,
            'checkout_number' => $checkout_number,
            'order_summry' => [
                'paymentSubtotal' => $total_rate_format,
                'total_fee' => $total_fee_format,
                'gstTax' => $gstTax_format,
                'total_due' => $total_due_format,
                'wallet_use' => $wallet_format,
                'loyalty_use' => $loyalty_format,
             ],
             'pay_data' => [
                'normalRate' =>  $plan_rate,
                'sub_total_amount' => $total_rate,
                'total_amount' =>  (float)  ($total_fee + $gstTax),
                'loyalty_amount' => $loyalty_day,
                'wallet_amount' => (float)  $wallet_amount,
                'gstTax' =>  (float)  $gstTax,
                'action' => $action,
                'checkout_number' => $checkout_number
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
            $checkAmount = $request->filled('checkAmount') ? $request->boolean('checkAmount') : true;


            $gstTax = isset($request->total_rate) ? getGSTAmount($request->total_rate) : 0.00;

            if ($checkAmount == true )
            $message = "Benifit applied succuessfully.";
            else
            $message = "Reset succuessfully.";
           
            if ($checkAmount == true &&  empty($wallet_amount) && empty($loyalty_day)) {
                return response()->json([
                    'status'  => false,
                    'message' => $action == 'listing' ? 'Please enter wallet amount or loyalty days.' : 'Please enter wallet amount.',
                ], 422);
            }

            $wallet_balance   = $this->account->wallet->balance ?? 0;
            $wallet_earn_days = $this->account->wallet->earn_days ?? 0;

            ########### Total Points ################
            $loyality_amount = $plan_rate*$loyalty_day;
            $total_points = $wallet_amount + $loyality_amount;

            ########### Amount with gst #################
            $total_final_amount = $discountRate_amount + $gstTax;

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
            

            if($total_final_amount >$total_points)
            $total_due_amount = ($total_final_amount-$total_points);    
            else
            $total_due_amount = ($total_points - $total_final_amount);

    
            if($total_points>$total_final_amount)
            return response()->json([
                'status'  => false,
                'message' => 'Wallet amount and Loyalty discount exceed total due',
            ], 422);   


            
           

            if ($total_due_amount < 0) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Wallet amount and Loyalty discount exceed subtotal',
                ], 422);
            }
            
           
            $total_due_amount = max(0, $total_due_amount);

            return response()->json([
                'status'  => true,
                'message' => $message,
                'loyality_amount' => $loyality_amount,
                'wallet_balance' => $wallet_amount,
                'loyalty_day' => $loyalty_day,
                'total_amount' =>  $total_final_amount, 
                'total_due_amount' => $total_due_amount,
                
            
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
            $encrypted = $request->benefit_token;
            $decrypted = openssl_decrypt($encrypted,$this->aes_value,$this->secretKey,0,$this->iv);
            $benefit_token = json_decode($decrypted, true);
            $payload_data  = $request->payload_data;

            $plan_rate = isset($benefit_token['normalRate']) ? $benefit_token['normalRate'] : 0; 
            $loyalty_day = isset($benefit_token['loyalty_amount']) ? $benefit_token['loyalty_amount'] : 0; 
            $wallet_amount = isset($benefit_token['wallet_amount']) ? $benefit_token['wallet_amount'] : 0; 

          
            $is_bypass = $pin_token == 'without_pay_now';

        
            $redirect_url = '';
            $gatewayResponse['status'] = true;
            $amount = $benefit_token['sub_total_amount'];

           
            $this->pinService->setAmount($benefit_token['sub_total_amount']);
            $this->pinService->setWalletAmount($benefit_token['wallet_amount']);

            $gstAmount = $this->pinService->getGSTAmount();
            $totalDueAmount = $this->pinService->getTotalDue();

            
            ########### Total Points ################
            $loyality_amount = $plan_rate*$loyalty_day;
            $total_points = $wallet_amount + $loyality_amount;

           
            if($benefit_token['sub_total_amount']>$total_points)
            $net_amount = max(0, (float) $benefit_token['sub_total_amount'] - (float) $total_points);
            else
            $net_amount = max(0, (float) $total_points) - (float) $benefit_token['sub_total_amount'];


            $total_payable_amount = $gstAmount + $benefit_token['sub_total_amount'];
            $paid_amount = $total_payable_amount - $total_points;

          

            /* Insert records for the payment history table */
            $insert = [];
            $insert['user_id'] = $this->account->id;
            $insert['completed_by'] = $request->isImpersonated ? $request->impersonatedId : $this->account->id;
            $insert['ref_no'] = generateReferenceNo(PaymentHistory::class);
            $insert['amount'] = $benefit_token['sub_total_amount'];
            $insert['wallet_amount'] = $wallet_amount;
            $insert['loyalty_amount'] = $loyality_amount;
            $insert['net_amount'] = $net_amount;
            $insert['gst_amount'] = $gstAmount;
            $insert['paid_amount'] = $paid_amount;
            $insert['total_payable_amount'] = $total_payable_amount;


            if (!$is_bypass) 
            {

                switch ($benefit_token['action']) {

                    case 'listing': 
                    $payload = session()->get('MassagePurchase');
                    break;

                    case 'extend': 
                    $payload = session()->get('MassagePurchase');
                    break;


                    case 'bumpup': 
                    $payload = session()->get('MassagePurchase');
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
                $agentResponse = $agentCommission->saveCommissionData($payment, $this->account->id, $benefit_token['sub_total_amount']);
                
            }      

            $payment_service = '';
            $mainAccount = $this->account;
            switch ($benefit_token['action']) {

                case 'listing': 
                $payment_service = 'Profile Listing';
                $result = $this->saveCheckout($benefit_token['action'], $payment);
                $redirect_url = route('center.payment-completed');
                break;

                case 'extend': 
                $result = $this->saveCheckout($benefit_token['action'], $payment);    
                $payment_service = 'Profile Extend';
                $redirect_url = route('center.current');
                break; 

                case 'bumpup': 
                $result = $this->saveCheckout($benefit_token['action'], $payment);    
                $payment_service = 'Profile Bump Up';
                $redirect_url = '';
                break;

                default:
                break;
            }

            if (!empty($benefit_token['wallet_amount']) && $benefit_token['wallet_amount'] > 0) {
                $this->walletService->debit($this->account, $benefit_token['wallet_amount'], $payment, $payment_service, []);
            }

            if (!empty($benefit_token['loyalty_day']) && $benefit_token['loyalty_day'] > 0) {
                $this->account->wallet->decrement('earn_days', $benefit_token['loyalty_day']);
            }

            if (in_array($benefit_token['action'], ['listing', 'extend'])) {
                $earn_days = floor($benefit_token['total_amount'] / 200);
                if ($earn_days > 0) {
                    $this->walletService->updateEarnDays($this->account, $earn_days, 'add');
                }
            }

            $payment->service = $payment_service;
            $payment->save();

            /* Send Payment Mail */
            if (in_array($benefit_token['action'], ['listing', 'extend'])) {
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

    public function checkPaymentSession(Request $request)
    {
        $purchase = session('MassagePurchase');
        if (!$purchase || (!isset($purchase['checkout_number'])) || (empty($purchase['checkout_number']))) {
            return response()->json([
                'success' => false,
                'message' => 'The payment session has expired. Please restart the payment process and try again.'
            ]);
        }

         $decrypted_checkout_number= openssl_decrypt($request->checkout_number,$this->aes_value,$this->secretKey,0,$this->iv);
         $decrypted_checkout_number = json_decode($decrypted_checkout_number, true);

        Log::info('decrypted_checkout_number'.$decrypted_checkout_number);

        if (isset($purchase['checkout_number']) && $purchase['checkout_number'] == $decrypted_checkout_number) {
            return response()->json([
                'success' => true,
                'message' => 'The payment session has expired. Please restart the payment process and try again.'
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Checkout number mismatch.'
            ]);
        }
    }
    


  
   public function saveCheckout($action = null, $payment = null)
    {
         

         $response = [];
         if($action == 'listing' || $action == 'extend')
         {
            $purchaseData = session()->get('MassagePurchase');
            $purchaseDetail = MassagePurchase::create($purchaseData);
            if (!empty($payment)) {
                    $purchaseDetail->paymentItems()->create([
                        'payment_history_id' => $payment->id,
                        'amount' => $purchaseDetail->paid_rate,
                    ]);
            }

         }

         if($action == 'bumpup')
         {
            $purchaseData = session()->get('MassagePurchase');
            $purchaseDetail = MassageBumpup::create($purchaseData);
            if (!empty($payment)) {
                    $purchaseDetail->paymentItems()->create([
                        'payment_history_id' => $payment->id,
                        'amount' => $purchaseDetail->paid_rate,
                    ]);
            }
         }
         

         if ($action === 'extend') 
         {
            $item = [];
            $item['start_date'] = isset($purchaseData['start_date']) ? $purchaseData['start_date'] : "";
            $item['end_date'] = isset($purchaseData['end_date']) ? $purchaseData['end_date'] : "";

            if( $item['start_date']!="" &&  $item['end_date']!="" )
            $response['extend_days'] = Carbon::parse($item['start_date'])->diffInDays(Carbon::parse($item['end_date'])) + 1;
         }

         session()->forget('MassagePurchase');
         return $response;
    }



}
