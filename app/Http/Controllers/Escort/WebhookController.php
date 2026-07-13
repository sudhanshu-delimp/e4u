<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Jobs\SendProductPurchaseMail;
use App\Jobs\ProcessListingFeaturesPostPayment;
use App\Models\PaymentHistory;
use App\Models\ProductOrder;
use App\Services\Massage\MassagePaymentWebhookService;
use App\Services\PinPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

  function handle(Request $request, PinPaymentService $pinPaymentService)
  {

    $signatureHeader = $request->header('Pin-Signature');




    if (!$signatureHeader)
      return response()->json(['status' => ' signature not found '], 500);

    $signingKey = config('escorts.webhook_secret_key');
    //  return "djfgdjhfg";

    // Parse header: t=timestamp,v1=signature

    $parts = [];
    foreach (explode(',', $signatureHeader) as $part) {
      [$key, $value] = explode('=', $part, 2);
      $parts[$key] = $value;
    }

    $timestamp = $parts['t'] ?? null;
    $signature = $parts['v1'] ?? null;


    if (!$timestamp || !$signature)
      return response()->json(['status' => 'timestamp or signature not found '], 500);



    // IMPORTANT: get raw body exactly as received
    $rawBody = $request->getContent();
    $payload = $timestamp . '.' . $rawBody;

    // Generate expected signature
    $expected = hash_hmac('sha256', $payload, $signingKey);


    // Constant-time comparison
    if (!hash_equals($expected, $signature))
      return response()->json(['status' => 'signature noty verified'], 500);



    // Optional: timestamp tolerance check (e.g. 5 minutes)
    $tolerance = 300; // seconds
    if (abs(time() - (int)$timestamp) > $tolerance)
      return response()->json(['status' => 'timestamp tolerance check '], 500);

    try {

      // Convert JSON after verification
      [$timestamp, $jsonPayload] = explode('.', $payload, 2);
      $data = json_decode($jsonPayload, true);
      // webhook event type
      $event = $data['type'] ?? null;
      $paymentObject = $data['data'];

      // type for identify wor what payment was made
      $type = $paymentObject['metadata']['type'] ?? '';


      // Example: payment success
      if ($event == 'charge.captured') {
        // start swithc case
        switch ($type) {
          case 'product-purchase':

            // make payment history
            $this->handlePaymentHistoryStatus($paymentObject);
            SendProductPurchaseMail::dispatch($paymentObject);
            if (isset($paymentObject['metadata']['wallet_amount']) && $paymentObject['metadata']['wallet_amount'] > 0) {
              $pinPaymentService->handleWalletAmount($paymentObject['metadata']['user_id'], $paymentObject['metadata']['wallet_amount']);
            }
            break;
          case 'escort-listing': {
              //ProcessListingFeaturesPostPayment::dispatch($paymentObject);
            }


            ############ Massage Centre ##############################
          case 'massage-listing':
            app(MassagePaymentWebhookService::class)->process($paymentObject);
            break;
          ############ End Massage Centre ##########################



          default:
            // Unknown type handling
            Log::warning('Unknown event', ['type' => $event,  'response' => $paymentObject]);
            break;
        }
      } else if ($event == 'charge.failed') {
        switch ($type) {
          case 'product-purchase':
            // make payment history
            $pinPaymentService->handlePaymentHistory($paymentObject);

            // handle payment history status
            $this->handlePaymentHistoryStatus($paymentObject);

            break;

          default:
            // Unknown type handling
            Log::warning('Unknown payment metadata type', ['type' => $type,  'response' => $paymentObject]);
            break;
        }
      }
      return response()->json(['status' => 'ok'], 200);
    } catch (\Exception $e) {
      Log::info('Webhook handle error', [$e->getMessage()]);
    }
  }


  public function handlePaymentHistoryStatus(array $paymentObject)
  {
    try {
      Log::info("handle payment status");
      $paymentHistory =  PaymentHistory::where('transaction_id', $paymentObject['token'])->first();
      if ($paymentHistory) {
        $paymentHistory->status = $paymentObject['success'] ? 'success' : 'failed';
        $paymentHistory->paid_at = $handleWalletAmount['captured_at'] ?? $paymentObject['created_at'];
        $paymentHistory->save();
      }


      Log::info("payment status update");
      // update order status
      $paymentStatus = $paymentObject['success'] == true ? 'paid' : 'failed';
      ProductOrder::where('id', $paymentObject['metadata']['order_id'])->update(['payment_status' => $paymentStatus, 'payment_message' => $paymentObject['status_message'], 'transaction_id' => $paymentObject['token']]);

      return true;
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }
  }
}
