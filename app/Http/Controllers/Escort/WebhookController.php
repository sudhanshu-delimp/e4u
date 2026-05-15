<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Mail\Escort\Order\OrderMailToE4U;
use App\Mail\Escort\Order\OrderMailToEscort;
use App\Mail\Escort\Order\SendOrderMailToCondomMan;
use App\Models\ProductOrder;
use App\Models\User;
use App\Services\PinPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{

  function handle(Request $request, PinPaymentService $pinPaymentService)
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

            // send mail regarding mail
            $this->sendProductOrderMail($paymentObject);
            break;

          default:
            // Unknown type handling
            Log::warning('Unknown payment metadata type', ['type' => $type,  'response' => $paymentObject]);
            break;
        }
        // end swich case

      } else if ($event == 'charge.failed') {
        switch ($type) {
          case 'escort-product-order':
            // make payment history
            $pinPaymentService->handlePaymentHistory($paymentObject);
            break;

          default:
            // Unknown type handling
            Log::warning('Unknown payment metadata type', ['type' => $type,  'response' => $paymentObject]);
            break;
        }
      }

      return response()->json(['status' => 'ok']);
    } catch (\Exception $e) {
      Log::info('Webhook handle error', [$e->getMessage()]);
      return false;
    }
  }

  protected function sendProductOrderMail(array $response)
  {

    try {
      $mailData = [];
      $order =   ProductOrder::with(['orderAddress', 'paymentDetails', 'user'])->where('id', $response['metadata']['order_id'])->first();
      if ($order->orderAddress) {
        $billingAddress = $order->orderAddress->where('type', 'billing')->first();
        $mailData['ref'] = $order->paymentDetails->ref_no ?? '';
        $mailData['member_id'] = $order->user ? $order->user->member_id : '';
        $mailData['order_id'] = $order->order_id ?? "";
        $mailData['billing_name'] = $order->user ? $order->user->name : "";

        // send email to escort
        Mail::to($billingAddress->email)->send(new OrderMailToEscort($mailData));


        // send email to e4u
        $user = User::where('id', $order->user_id)->first();
        $memberId = "";
        if ($user) {
          $memberId = $user->member_id ?? '';
        }

        $shippingAddress = $order->orderAddress->where('type', 'shipping')->first();
        $address1 = $shippingAddress->address_line1 ?? '';
        $address2 = $shippingAddress->address_line2 ?? '';
        $city     = $shippingAddress->city ?? '';
        $state    = $shippingAddress->state ?? '';
        $country  = $shippingAddress->country ?? '';

        $completeAddress = trim(
          implode(', ', array_filter([
            $address1 . ' ' . $address2,
            $city,
            $state,
            $country
          ]))
        );
        $mailData['member_id'] = $memberId;
        $mailData['member_name'] = $shippingAddress ? $shippingAddress->name : "example@gmail.com";
        $mailData['email'] = $shippingAddress->email ? $shippingAddress->email : "example@gmail.com";
        $mailData['mobile'] = $shippingAddress->phone ? $shippingAddress->phone : "999999999999";
        $mailData['delivery_address'] = $completeAddress;
        $mailData['delivery_type'] = $order->delivery_type ? $order->delivery_type : "Door";
        $e4uEmail = "ashish.kumar@delimp.com";
        Mail::to($e4uEmail)->send(new OrderMailToE4U($mailData));

        // // send mail to condom man
        $products = $order->orderItems;
        $condommail = "ashish120897maurya@gmail.com";
        $mailData['member_name'] = $user->name;
        $mailData['products'] = $products;
        Mail::to($condommail)->send(new SendOrderMailToCondomMan($mailData));

        Log::info('succes mail send');
      } else Log::warning('send email issue', ['message' => "Order address was not found"]);
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }
  }
}
