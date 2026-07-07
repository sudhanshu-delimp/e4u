<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


use App\Models\Purchase;
use App\Models\PaymentProcess;

use App\Mail\PaymentMailer;

use App\Services\WalletService;
use App\Services\PinPaymentService;
use App\Services\EscortListingFeatureService;




use Carbon\Carbon;

class ProcessListingFeaturesPostPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public array $payload) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        WalletService $walletService,
        PinPaymentService $paymentService,
        EscortListingFeatureService $featureService
    ) {
        try {

            echo "Webhook processing started\n";

            $metadata = $this->payload['metadata'];

            $process = PaymentProcess::where('token', $metadata['process_token'])->first();

            if (!$process) {
                throw new \Exception("Payment process not found. Token: {$metadata['process_token']}");
            }

            $transaction = $paymentService->getTransactionDetail($this->payload['token']);

            if ($transaction) {

                $itemsCount = $transaction->items->count();

                if ($itemsCount == 0) {
                    $mainAccount = $transaction->user;
                    if (in_array($process->type, ['listing', 'tour', 'extend'])) {
                        $this->saveCheckout($process->type, $process->payload, $transaction);
                    }

                    switch ($process->type) {
                        case 'bumpUp': {
                                $this->saveBumpUp($featureService, $process, $transaction);
                            }
                            break;
                        case 'pinup': {
                                $escortPinup = $this->savePinUp($featureService, $process, $transaction);
                                $mailBodayData['escortPinup'] = $escortPinup;
                            }
                            break;
                        case 'upgrade': {
                                $escortPinup = $this->saveUpgrade($featureService, $process, $transaction);
                                $mailBodayData['escortPinup'] = $escortPinup;
                            }
                            break;
                        case 'wallet': {
                                $creditTransaction = $walletService->credit(
                                    $mainAccount,
                                    $transaction->amount,
                                    $transaction,
                                    'Add Money',
                                    [
                                        'user_id' => $mainAccount->id
                                    ]
                                );

                                $creditTransaction->paymentItems()->create([
                                    'payment_history_id' => $transaction->id,
                                    'amount' => $transaction->amount,
                                ]);
                            }
                            break;
                    }
                }

                echo "Transaction Items: {$itemsCount}\n";
            } else {
                $mailConfig = config("payment_mail_templates.{$process->type}");

                $insert = json_decode($metadata['insert'], true);

                $insert['currency']       = $this->payload['currency'];
                $insert['transaction_id'] = $this->payload['token'];
                $insert['status']         = $this->payload['success'] ? 'success' : 'failed';
                $insert['paid_at']        = $this->payload['created_at'];
                $insert['card']           = $this->payload['card']['display_number'];
                $insert['meta']           = json_encode($this->payload);

                $payment = $paymentService->saveTransaction($insert);

                $mainAccount = $payment->user;

                $mailBodayData = [];
                $mailBodayData['mainAccount'] = $mainAccount;
                $mailBodayData['payment'] = $payment;

                if ($payment && !in_array($process->type, ['wallet'])) {
                    echo "Adjustments in the Agent Commission\n";
                    $agentCommission = (new \App\Models\AgentCommission);
                    $agentCommission->saveCommissionData($payment, $payment->user->id, $payment->amount);
                }

                if (!empty($process->benefit_token['wallet_amount']) && $process->benefit_token['wallet_amount'] > 0) {
                    echo "Adjustments in the Wallet\n";
                    $walletService->debit($payment->user, $process->benefit_token['wallet_amount'], $payment, $payment->service, []);
                }

                if (!empty($process->benefit_token['loyalty_day']) && $process->benefit_token['loyalty_day'] > 0) {
                    echo "Adjustments in the Loyalty Days\n";
                    $payment->user->wallet->decrement('earn_days', $process->benefit_token['loyalty_day']);
                }

                if (in_array($process->benefit_token['action'], ['listing', 'tour', 'extend'])) {
                    $earn_days = floor($process->benefit_token['total_amount'] / 200);
                    if ($earn_days > 0) {
                        echo "Adjustments in the Loyalty Days after spend of 200 multiples\n";
                        $walletService->updateEarnDays($payment->user, $earn_days, 'add');
                    }
                }


                if (in_array($process->type, ['listing', 'tour', 'extend'])) {
                    $result = $this->saveCheckout($process->type, $process->payload, $payment);
                    $mailBodayData['extend_days'] = empty($result['extend_days']) ? 0 : $result['extend_days'];
                }
                //savePinUp
                switch ($process->type) {

                    case 'bumpUp': {
                            $this->saveBumpUp($featureService, $process, $payment);
                        }
                        break;
                    case 'pinup': {
                            $escortPinup = $this->savePinUp($featureService, $process, $payment);
                            $mailBodayData['escortPinup'] = $escortPinup;
                        }
                        break;
                    case 'upgrade': {
                            $escortPinup = $this->saveUpgrade($featureService, $process, $payment);
                            $mailBodayData['escortPinup'] = $escortPinup;
                        }
                        break;
                    case 'wallet': {
                            $creditTransaction = $walletService->credit(
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
                        break;
                }

                /* Send Mail for the payment confirmation */
                try {
                    echo "Sending Mail for the payment confirmation...\n";
                    Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], $mailBodayData, $mailConfig['subject']));
                } catch (\Throwable $e) {
                    echo "Sending Mail Error\n";
                    echo "Mail Error: {$e->getMessage()}\n";
                }
            }

            echo "Deleting the Payment Processing record\n";
            $process->delete();

            echo "Webhook processed successfully\n";
        } catch (\Throwable $e) {

            Log::error('Pin payment webhook failed.', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
                'payload' => $this->payload,
            ]);

            // Re-throw so the queued job can retry (recommended)
            throw $e;
        }
    }
    public function failed(\Throwable $exception): void
    {
        Log::critical('Webhook job permanently failed.', [
            'message' => $exception->getMessage(),
            'payload' => $this->payload,
        ]);
    }

    public function saveCheckout($action, $checkout = [], $payment = null)
    {
        $response = [];
        echo "Processing payment items and other...\n";
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
            list($total_discount, $total_rate, $normalRate, $discountRate, $appiedDiscountAmount) = calculateTotalFee($item['membership'], $daysDiff, $escortDetail->user);
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

            if ($escortDetail->user->activeFeeDiscount) {

                $purchaseDetail->special_discount_value = $escortDetail->user->activeFeeDiscount->value;
                $purchaseDetail->special_discount_type = $escortDetail->user->activeFeeDiscount->type;
                $purchaseDetail->save();

                $escortDetail->user->activeFeeDiscount()->increment('spend_amount', $appiedDiscountAmount);
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
        return $response;
    }

    public function saveBumpUp($featureService, $process, $payment)
    {
        $escortBumpUp = $featureService->registerBumpUp(null, $process->payload);

        if ($payment) {
            $escortBumpUp->paymentItems()->create([
                'payment_history_id' => $payment->id,
                'amount'             => $payment->amount,
            ]);
        }

        return $escortBumpUp;
    }

    public function savePinUp($featureService, $process, $payment)
    {
        $escortPinup = $featureService->registerPinUp(null, $process->payload);
        if ($payment) {
            $escortPinup->paymentItems()->create([
                'payment_history_id' => $payment->id,
                'amount'             => $payment->amount,
            ]);
        }
        return $escortPinup;
    }

    public function saveUpgrade($featureService, $process, $payment)
    {
        $escortPinup = $featureService->upgradeMembership(null, $process->payload);
        if ($payment) {
            $escortPinup->paymentItems()->create([
                'payment_history_id' => $payment->id,
                'amount'             => $payment->amount,
            ]);
        }
        return $escortPinup;
    }
}
