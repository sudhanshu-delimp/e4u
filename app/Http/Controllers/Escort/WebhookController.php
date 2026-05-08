<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\PaymentHistory;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

  function handle(Request $request)
  {
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

      $event = $data['type'] ?? null;

      // Example: payment success
      if ($event == 'charge.captured') {
        $paymentObject = $data['data'];

        $type = $paymentObject['metadata']['type'] ?? '';
        Log::info($type);
        // start swithc case
        switch ($type) {

          case 'escort-product-order':
            // update payment status of orders
            $paymentStatus = $paymentObject['success'] == true ? 'paid' : 'failed';
            
            ProductOrder::where('id', $paymentObject['metadata']['order_id'])->update(['payment_status' => $paymentStatus]);
            // make payment history
            $this->handlePaymentHistory($paymentObject);
            break;

          default:
            // Unknown type handling
            Log::warning('Unknown payment metadata type', ['type' => $type,  'response' => $paymentObject]);
            break;
        }
        // end swich case

      }

      return response()->json(['status' => 'ok']);
    } catch (\Exception $e) {
      Log::info('Webhook handle error', [$e->getMessage()]);
      return false;
    }
  }


  protected function handlePaymentHistory(array $response)
  {

    // make history of payment
    PaymentHistory::create([
      'order_id'         => $response['metadata']->order_id,
      'user_id'         => $response['metadata']->user_id,
      'ref_no'          => now()->format('Ymd') . rand(100, 999),
      'amount'          => $response['amount'] / 100,
      'currency'        => $response['currency'],
      'payment_gateway' => 'pinpayments',
      'transaction_id'  => $response['token'],
      'status'          => $response['success'] ? 'success' : 'failed',
      'paid_at'         => $response['captured_at'] ?? $response['created_at'],
      'card'            => $response['card']['display_number'],
      'meta'            => json_encode($response),
    ]);
  }
}
