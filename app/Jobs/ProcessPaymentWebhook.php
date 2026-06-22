<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Purchase;
use App\Models\PaymentProcess;

use App\Services\PinPaymentService;

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
    public function handle(PinPaymentService $paymentService)
    {
        echo "Webhook processing started\n";
        $metadata = $this->payload['metadata'];

        $process = PaymentProcess::where('token', $metadata['process_token'])->first();

        $transaction = $paymentService->getTransactionDetail($this->payload['token']);

        if ($transaction) {
            $itemsCount = $transaction->items->count();
            if ($itemsCount == 0) {
                if (in_array($process->type, ['listing', 'tour', 'extend'])) {
                    $this->saveCheckout($process->type, $process->payload, $transaction);
                }
            }
            echo "Transaction Items: {$itemsCount} \n";
        } else {
            $insert = json_decode($metadata['insert']);
            $insert['currency'] = $this->payload['currency'];
            $insert['transaction_id'] = $this->payload['token'];
            $insert['status'] = $this->payload['success'] ? 'success' : 'failed';
            $insert['paid_at'] = $this->payload['created_at'];
            $insert['card'] = $this->payload['card']['display_number'];
            $insert['meta'] = json_encode($this->payload);
            $payment = $paymentService->saveTransaction($insert);

            if (in_array($process->type, ['listing', 'tour', 'extend'])) {
                $this->saveCheckout($process->type, $process->payload, $payment);
            }
        }

        echo "Removing process token \n";
        PaymentProcess::where('token', $metadata['process_token'])->delete();
        echo "Webhook processed successfully\n";
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
}
