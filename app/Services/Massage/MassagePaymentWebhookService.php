<?php

namespace App\Services\Massage;

use App\Mail\PaymentMailer;
use App\Models\MassageBumpup;
use App\Models\MassagePurchase;
use App\Models\PaymentProcess;
use App\Models\User;
use App\Services\PinPaymentService;
use App\Services\WalletService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

                if (!$process) {
                    Log::error("MassagePaymentWebhookService: PaymentProcess not found for token: {$metadata['process_token']}");
                    return;
                }

                $transaction = $this->paymentService->getTransactionDetail($payload['token']);
                
                if ($transaction && $transaction->items->count() == 0) {
                    echo "Payment items are zero...\n";
                    $this->clearPaymentHistory($transaction);
                }


                $db_payload = $process->payload;
                foreach (['utc_start_time', 'utc_end_time'] as $key) {
                    if (!empty($db_payload[$key])) {
                        $db_payload[$key] = \Carbon\Carbon::parse($db_payload[$key])->toDateTimeString();
                    }
                }

                $action = $process->type;
                $payment_service = '';
                $rate = $db_payload['rate'] ?? "";
                $mailBodayData = [];

    
                if (!$transaction || $transaction->items->count() == 0) 
                {
                     

                    $mailConfig = "";
                    $insert = json_decode($metadata['insert'], true);
                    $insert['currency'] = $payload['currency'];
                    $insert['transaction_id'] = $payload['token'];
                    $insert['status'] = $payload['success'] ? 'success' : 'failed';
                    $insert['paid_at'] = $payload['created_at'];
                    $insert['card'] = $payload['card']['display_number'] ?? null;

                    $insert['created_by'] = $insert['completed_by'] ?? null;
                    $insert['updated_by'] = $insert['completed_by'] ?? null;
                    $insert['completed_by'] = $insert['completed_by'] ?? null;

                    $insert['meta'] = json_encode($payload);

                    $db_payload['created_by'] = $insert['completed_by'] ?? null;
                    

                    $payment = $this->paymentService->saveTransaction($insert);
                    $mainAccount = $payment->user;

                    if ($payment && !in_array($process->type, ['wallet'])) {
                        Log::info("saveCommissionData function calling from service.");
                        $agentCommission = (new \App\Models\AgentCommission);
                        $agentCommission->saveCommissionData($payment, $insert['user_id'], $insert['total_payable_amount']);
                    }  

                    if (in_array($process->type, ['listing', 'bumpup', 'extend'])) {
                        $result =  $this->saveCheckout($process->type, $db_payload, $payment);
                        $mailBodayData['extend_days'] = empty($result['extend_days']) ? 0 : $result['extend_days'];
                    }

                    

                    switch ($action) {
                        case 'listing': 
                            $payment_service = 'Profile Listing';
                             $mailConfig = config("payment_mail_templates.listing");
                            break;
                        case 'extend':
                            $payment_service = 'Profile Extend';
                            $mailConfig = config("payment_mail_templates.extend"); 
                            break; 
                        case 'bumpup': 
                            $payment_service = 'Profile Bump Up';
                            $mailConfig = config("payment_mail_templates.bumpUp");
                            break;
                        default:
                            break;
                    }

                    ############## Wallet Entries #################
                    $user = User::where('id',$insert['user_id'])->first();
                    
                    if (!empty($insert['wallet_amount']) && $insert['wallet_amount'] > 0) { 
                        $this->walletService->debit($user, $insert['wallet_amount'], $payment, $payment_service, []);
                    }

                    $loyalty_day = 0;
                    if (!empty($insert['loyalty_amount']) && $insert['loyalty_amount'] > 0) {
                        if ($rate != "" && $rate <= $insert['loyalty_amount']) {
                            $loyalty_day = $insert['loyalty_amount'] / $rate;
                            $user->wallet->decrement('earn_days', $loyalty_day);
                        
                        }
                    }

                    if (in_array($action, ['listing', 'extend'])) {
                        $earn_days = floor($insert['net_amount'] / 200);
                        if ($earn_days > 0) {
                            $this->walletService->updateEarnDays($user, $earn_days, 'add');
                        }
                    }

                    $payment->service = $payment_service;
                    $payment->save();
                    $process->delete();


                    ########## For Wallet Payment ##############           
                    if (in_array($process->type, ['wallet'])) 
                    {
                        $creditTransaction = $this->walletService->credit(
                                $mainAccount,
                                $payment->amount,
                                $payment,
                                'Add Money',
                                [
                                    'user_id' => $mainAccount->id
                                ]
                            );

                            $creditTransaction->paymentItems()->create([
                                'payment_history_id' => $payment->id,
                                'amount' => $payment->amount,
                        ]);


                    }


                    ####### Send Mail for the payment confirmation #####

                    
                    $mailBodayData['mainAccount'] = $mainAccount;
                    $mailBodayData['payment'] = $payment;   

                    try {
                        echo "Sending Mail for the payment confirmation...\n";
                        Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], $mailBodayData, $mailConfig['subject']));
                    } catch (\Throwable $e) {
                        echo "Sending Mail Error\n";
                        echo "Mail Error: {$e->getMessage()}\n";
                    }
                    ################# End Send Email ###################
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
            Log::info("Processing saveCheckout MassagePurchase item.");

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


    public function clearPaymentHistory($paymentHistory)
    {
        echo "clearPaymentHistory...\n";
        DB::transaction(function () use ($paymentHistory) {

            foreach ($paymentHistory->items as $paymentItem) {

                $modelClass = $paymentItem->item_type;

                if (class_exists($modelClass)) {

                    $model = $modelClass::find($paymentItem->item_id);

                    if ($model) {
                        $model->delete();
                    }
                }

                $paymentItem->delete();
            }

            $paymentHistory->delete();
        });
    }

}
