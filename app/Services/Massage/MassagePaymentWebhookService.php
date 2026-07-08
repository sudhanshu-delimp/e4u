<?php

namespace App\Services\Massage;

use App\Models\MassageBumpup;
use App\Models\MassagePurchase;
use App\Models\PaymentProcess;
use App\Models\User;
use App\Services\PinPaymentService;
use App\Services\WalletService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class MassagePaymentWebhookService 
{
   
    public function __construct( protected PinPaymentService $paymentService, protected WalletService $walletService) 
    {

    }

   
    public function process(array $payload)
    {
        try 
        {
                Log::info('MassagePaymentWebhookService: Process started');
                $metadata = $payload['metadata'] ?? [];
                
                if (empty($metadata['process_token'])) {
                    Log::error('MassagePaymentWebhookService: Missing process_token in metadata');
                    return;
                }

                // Fetch process and transaction details
                $process = PaymentProcess::where('token', $metadata['process_token'])->first();

                $db_payload = $process->payload;
                foreach (['utc_start_time', 'utc_end_time'] as $key) {
                    if (!empty($db_payload[$key])) {
                        $db_payload[$key] = \Carbon\Carbon::parse($db_payload[$key])->toDateTimeString();
                    }
                }

                // Log::info($db_payload);
                // exit;
                
                if (!$process) {
                    Log::error("MassagePaymentWebhookService: PaymentProcess not found for token: {$metadata['process_token']}");
                    return;
                }

                $transaction = $this->paymentService->getTransactionDetail($payload['token']);
                $action = $process->type;
                $payment_service = '';
                $rate = $db_payload['rate'] ?? "";

                if ($transaction) {
                    $itemsCount = $transaction->items->count();
                    if ($itemsCount == 0) {
                        if (in_array($process->type, ['listing', 'bumpup', 'extend'])) {
                            $this->saveCheckout($process->type, $db_payload, $transaction);
                        }
                    }
                    Log::info("Transaction Items Count: {$itemsCount}");
                } 

                else 
                {
                    $insert = json_decode($metadata['insert'], true);
                    $insert['currency'] = $payload['currency'];
                    $insert['transaction_id'] = $payload['token'];
                    $insert['status'] = $payload['success'] ? 'success' : 'failed';
                    $insert['paid_at'] = $payload['created_at'];
                    $insert['card'] = $payload['card']['display_number'] ?? null;
                    $insert['meta'] = json_encode($payload);

                    $payment = $this->paymentService->saveTransaction($insert);

                    if ($payment) {
                        Log::info("saveCommissionData function calling from service.");
                        $agentCommission = (new \App\Models\AgentCommission);
                        $agentCommission->saveCommissionData($payment, $insert['user_id'], $insert['total_payable_amount']);
                    }  

                    if (in_array($process->type, ['listing', 'bumpup', 'extend'])) {
                        $this->saveCheckout($process->type, $db_payload, $payment);
                    }

                    switch ($action) {
                        case 'listing': 
                            $payment_service = 'Profile Listing';
                            break;
                        case 'extend':
                            $payment_service = 'Profile Extend';
                            break; 
                        case 'bumpup': 
                            $payment_service = 'Profile Bump Up';
                            break;
                        default:
                            break;
                    }

                    ############## Wallet Entries #################
                    $user = User::where('id',$insert['user_id'])->first();
                    
                    if (!empty($insert['wallet_amount']) && $insert['wallet_amount'] > 0) {
                        // Log::info("debit processed successfully");     
                        $this->walletService->debit($user, $insert['wallet_amount'], $payment, $payment_service, []);
                    }

                    $loyalty_day = 0;
                    if (!empty($insert['loyalty_amount']) && $insert['loyalty_amount'] > 0) {
                        if ($rate != "" && $rate <= $insert['loyalty_amount']) {
                            $loyalty_day = $insert['loyalty_amount'] / $rate;
                            $user->wallet->decrement('earn_days', $loyalty_day);
                        
                        }
                        // Log::info("decrement processed successfully".$rate.'===='.$insert['loyalty_amount'].$loyalty_day); 
                    }

                    if (in_array($action, ['listing', 'extend'])) {
                        // Log::info("updateEarnDays processed successfully"); 
                        $earn_days = floor($insert['net_amount'] / 200);
                        if ($earn_days > 0) {
                            $this->walletService->updateEarnDays($user, $earn_days, 'add');
                        }
                    }

                    $payment->service = $payment_service;
                    $payment->save();
                    $process->delete();
                }

                Log::info("MassagePaymentWebhookService: Webhook processed successfully");


        } 
        catch (Exception $e) {
          Log::error('Payment Processing Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
        }
    }

 
    protected function saveCheckout(string $action, $checkout = [], $payment = null)
    {
        try 
        {
            $response = [];
            Log::info("Processing payment items and other in Service...");

            $purchaseData = (!empty($checkout)) ? $checkout : [];

            if (!empty($purchaseData)) {
                if ($action == 'listing' || $action == 'extend') {
                    $purchaseDetail = MassagePurchase::create($purchaseData);
                    if (!empty($payment)) {
                        $purchaseDetail->paymentItems()->create([
                            'payment_history_id' => $payment->id,
                            'amount' => $purchaseDetail->paid_rate,
                        ]);
                    }
                }

                if ($action == 'bumpup') {
                    $purchaseDetail = MassageBumpup::create($purchaseData);
                    if (!empty($payment)) {
                        $purchaseDetail->paymentItems()->create([
                            'payment_history_id' => $payment->id,
                            'amount' => $purchaseDetail->paid_rate,
                        ]);
                    }
                }

                if ($action === 'extend') {
                    $item = [];
                    $item['start_date'] = $purchaseData['start_date'] ?? "";
                    $item['end_date'] = $purchaseData['end_date'] ?? "";

                    if ($item['start_date'] != "" &&  $item['end_date'] != "") {
                        $response['extend_days'] = Carbon::parse($item['start_date'])->diffInDays(Carbon::parse($item['end_date'])) + 1;
                    }
                }
            }

            return $response;
        }
        catch (Exception $e) {
        Log::error('Payment Processing Error', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ]);
        }
    }
}
