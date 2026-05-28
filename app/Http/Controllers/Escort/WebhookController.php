<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Jobs\SendProductPurchaseMail;
use App\Models\PaymentHistory;
use App\Services\PinPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

  function handle(Request $request, PinPaymentService $pinPaymentService)
  {

  Log::info("webhook working");
    $signatureHeader = $request->header('Pin-Signature');

    if (!$signatureHeader)
      return false;

    $signingKey = config('escorts.webhook_secret_key');

    // Parse header: t=timestamp,v1=signature

    $parts = [];
    foreach (explode(',', $signatureHeader) as $part) {
      [$key, $value] = explode('=', $part, 2);
      $parts[$key] = $value;
    }

    $timestamp = $parts['t'] ?? null;
    $signature = $parts['v1'] ?? null;

    if (!$timestamp || !$signature)
      return false;


    // IMPORTANT: get raw body exactly as received
    $rawBody = $request->getContent();
    $payload = $timestamp . '.' . $rawBody;

    // Generate expected signature
    $expected = hash_hmac('sha256', $payload, $signingKey);

    // Constant-time comparison
    if (!hash_equals($expected, $signature))
      return false;


    // Optional: timestamp tolerance check (e.g. 5 minutes)
    $tolerance = 300; // seconds
    if (abs(time() - (int)$timestamp) > $tolerance)
      return false;

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
            $pinPaymentService->handlePaymentHistory($paymentObject);
            SendProductPurchaseMail::dispatch($paymentObject);
            if (isset($paymentObject['metadata']['wallet_amount']) && $paymentObject['metadata']['wallet_amount'] > 0) {
              $pinPaymentService->handleWalletAmount($paymentObject['metadata']['user_id'], $paymentObject['metadata']['wallet_amount']);
            }
            break;

          default:
            // Unknown type handling
            Log::warning('Unknown payment metadata type', ['type' => $type,  'response' => $paymentObject]);
            break;
        }
      } else if ($event == 'charge.failed') {
        switch ($type) {
          case 'product-purchase':
            // make payment history
            
            // $this->handlePaymentHistoryStatus($paymentObject);
            $pinPaymentService->handlePaymentHistory($paymentObject);
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


  // public function handlePaymentHistoryStatus(array $handleWalletAmount)
  // {
  //   try {

  //     $paymentHistory =  PaymentHistory::where('transaction_id', $handleWalletAmount['token'])->first();
  //     $paymentHistory->status = $handleWalletAmount['success'] ? 'success' : 'failed';
  //     $paymentHistory->paid_at = $handleWalletAmount['captured_at'] ?? $handleWalletAmount['created_at'];

  //     $paymentHistory->save();
  //     return true;
  //   } catch (\Exception $e) {
  //     Log::info('', [$e->getMessage()]);
  //   }
  // }
}
