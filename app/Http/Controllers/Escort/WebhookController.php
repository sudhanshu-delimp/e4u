<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
  // public function handle(Request $request)
  // {

  //   $payload = $request->getContent(); // RAW body (IMPORTANT)

  //   $signature = $request->header('pin-signature');

  //   $secret = config('escorts.webhook_secret_key'); // webhook secret

  //   // 🔐 verify signature
  //   $expectedSignature = hash_hmac('sha256', $payload, $secret);
  //   // Log::info($expectedSignature);
  //   if (!hash_equals($expectedSignature, $signature)) {
  //     return response()->json(['error' => 'Invalid signature'], 403);
  //   }
  //   try {

  //     // Convert JSON after verification
  //     $data = json_decode($payload, true);

  //     $event = $data['event'] ?? null;
  //     $charge = $data['data'] ?? [];

  //     // Example: payment success
  //     if ($event === 'charge.success' && !empty($charge['captured'])) {
  //       Log::info('webhook', [$event]);
  //     }

  //     return response()->json(['status' => 'ok']);
  //   } catch (\Exception $e) {
  //     Log::info('', [$e->getMessage()]);
  //   }
  // }

  function handle(Request $request)
  {
    $signatureHeader = $request->header('Pin-Signature');

    if (!$signatureHeader) {
      return false;
    }
    $signingKey = config('escorts.webhook_secret_key'); // webhook secret

    // Parse header: t=timestamp,v1=signature
    $parts = [];
    foreach (explode(',', $signatureHeader) as $part) {
      [$key, $value] = explode('=', $part, 2);
      $parts[$key] = $value;
    }

    $timestamp = $parts['t'] ?? null;
    $signature = $parts['v1'] ?? null;

    if (!$timestamp || !$signature) {
      return false;
    }

    // IMPORTANT: get raw body exactly as received
    $rawBody = $request->getContent();

    $payload = $timestamp . '.' . $rawBody;

    // Generate expected signature
    $expected = hash_hmac('sha256', $payload, $signingKey);

    // Constant-time comparison
    if (!hash_equals($expected, $signature)) {
      return false;
    }

    // Optional: timestamp tolerance check (e.g. 5 minutes)
    $tolerance = 300; // seconds
    if (abs(time() - (int)$timestamp) > $tolerance) {
      return false;
    }

    try {

      // Convert JSON after verification
      [$timestamp, $jsonPayload] = explode('.', $payload, 2);


      $event = $jsonPayload->type ?? null;
      // $charge = $data['data'] ?? [];
      Log::info($jsonPayload);

      // Example: payment success
      if ($event == 'charge.captured') {
        Log::info('webhook', [$jsonPayload]);
      }

      return response()->json(['status' => 'ok']);
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }


    return true;
  }
}
