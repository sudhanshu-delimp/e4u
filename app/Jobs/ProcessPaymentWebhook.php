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

class ProcessPaymentWebhook implements ShouldQueue
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
    // public function handle(PinPaymentService $paymentService, EscortListingFeatureService $featureService)
    // {
    //     echo "Webhook processing started\n";
    //     $metadata = $this->payload['metadata'];

    //     $process = PaymentProcess::where('token', $metadata['process_token'])->first();
    //     print_this($process->type);
    //     print_this($process->payload);
    //     $transaction = $paymentService->getTransactionDetail($this->payload['token']);

    //     if ($transaction) {
    //         $itemsCount = $transaction->items->count();
    //         if ($itemsCount == 0) {
    //             if (in_array($process->type, ['listing', 'tour', 'extend'])) {
    //                 $this->saveCheckout($process->type, $process->payload, $transaction);
    //             }
    //         }
    //         echo "Transaction Items: {$itemsCount} \n";
    //     } else {
    //         $insert = json_decode($metadata['insert']);
    //         $insert['currency'] = $this->payload['currency'];
    //         $insert['transaction_id'] = $this->payload['token'];
    //         $insert['status'] = $this->payload['success'] ? 'success' : 'failed';
    //         $insert['paid_at'] = $this->payload['created_at'];
    //         $insert['card'] = $this->payload['card']['display_number'];
    //         $insert['meta'] = json_encode($this->payload);
    //         $payment = $paymentService->saveTransaction($insert);

    //         if (in_array($process->type, ['listing', 'tour', 'extend'])) {
    //             $this->saveCheckout($process->type, $process->payload, $payment);
    //         }
    //         switch ($process->type) {
    //             case 'bumpUp': {
    //                     $escortBumpUp = $featureService->registerBumpUp(null, $process->payload);
    //                     if (!empty($payment)) {
    //                         $escortBumpUp->paymentItems()->create([
    //                             'payment_history_id' => $payment->id,
    //                             'amount' => $payment->amount
    //                         ]);
    //                     }

    //                     /* Send Payment Mail */
    //                     $mailConfig = config("payment_mail_templates.bumpUp");
    //                     $mainAccount = $escortBumpUp->user;
    //                     Mail::to($mainAccount->email)->send(new PaymentMailer($mailConfig['template'], compact('mainAccount', 'payment'), $mailConfig['subject']));
    //                 }
    //                 break;

    //             default:
    //                 # code...
    //                 break;
    //         }
    //     }

    //     echo "Removing process token \n";
    //     PaymentProcess::where('token', $metadata['process_token'])->delete();
    //     echo "Webhook processed successfully\n";
    // }
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
                    if (in_array($process->type, ['listing', 'tour', 'extend'])) {
                        $this->saveCheckout($process->type, $process->payload, $transaction);
                    }

                    switch ($process->type) {

                        case 'bumpUp': {
                                $this->saveBumpUp($featureService, $process, $transaction);
                            }
                            break;
                    }
                }

                echo "Transaction Items: {$itemsCount}\n";
            } else {

                $insert = json_decode($metadata['insert'], true);

                $insert['currency']       = $this->payload['currency'];
                $insert['transaction_id'] = $this->payload['token'];
                $insert['status']         = $this->payload['success'] ? 'success' : 'failed';
                $insert['paid_at']        = $this->payload['created_at'];
                $insert['card']           = $this->payload['card']['display_number'];
                $insert['meta']           = json_encode($this->payload);

                $payment = $paymentService->saveTransaction($insert);
                /** Calulate agent commisson and save the commission */
                $agentCommission = (new \App\Models\AgentCommission);
                if ($payment) {
                    $agentCommission->saveCommissionData($payment, $payment->user->id, $payment->amount);
                }

                if (!empty($process->benefit_token['wallet_amount']) && $process->benefit_token['wallet_amount'] > 0) {
                    $walletService->debit($payment->user, $process->benefit_token['wallet_amount'], $payment, $payment->service, []);
                }

                if (!empty($process->benefit_token['loyalty_day']) && $process->benefit_token['loyalty_day'] > 0) {
                    $payment->user->wallet->decrement('earn_days', $process->benefit_token['loyalty_day']);
                }

                if (in_array($process->benefit_token['action'], ['listing', 'tour', 'extend'])) {
                    $earn_days = floor($process->benefit_token['total_amount'] / 200);
                    if ($earn_days > 0) {
                        $walletService->updateEarnDays($payment->user, $earn_days, 'add');
                    }
                }

                if (in_array($process->type, ['listing', 'tour', 'extend'])) {
                    $this->saveCheckout($process->type, $process->payload, $payment);
                }

                switch ($process->type) {

                    case 'bumpUp': {
                            $this->saveBumpUp($featureService, $process, $payment);
                        }
                        break;
                }
            }

            PaymentProcess::where('token', $metadata['process_token'])->delete();

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

        $mailConfig = config('payment_mail_templates.bumpUp');

        $mainAccount = $escortBumpUp->user;
        try {
            Mail::to($mainAccount->email)
                ->send(new PaymentMailer(
                    $mailConfig['template'],
                    compact('mainAccount', 'payment'),
                    $mailConfig['subject']
                ));
        } catch (\Throwable $e) {
            echo "Mail Error: {$e->getMessage()}\n";
        }
    }
}
