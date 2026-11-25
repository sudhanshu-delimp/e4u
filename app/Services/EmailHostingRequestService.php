<?php

namespace App\Services;

use App\Models\EmailHostingRequest;
use App\Models\EmailHostingSubscriptionPayment;
use App\Models\FeesConciergeService;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class EmailHostingRequestService
{
  protected PinPaymentService $pinPayments;

  public function __construct(PinPaymentService $pinPayments)
  {
    $this->pinPayments = $pinPayments;
  }

  // public function createRequest(array $data): array
  // {
  //   // Fetch price from server-side database, not from submitted form.
  //   $monthlyFee = (float) FeesConciergeService::where('service_type', 'Email Account')->value('amount');

  //   if ($monthlyFee <= 0) {
  //     throw new \RuntimeException('Email hosting price is not configured.');
  //   }

  //   $duration = (int) $data['period_required'];
  //   $gstRate = config('app.payment.gst_percentage'); // Replace with your actual GST configuration if required.

  //   $monthlyGst = round($monthlyFee * $gstRate / 100, 2);
  //   $monthlyTotal = round($monthlyFee + $monthlyGst, 2);
  //   $hostingRequest = "";
  //   $request = DB::transaction(function () use ($data, $monthlyFee, $duration, $gstRate, $monthlyGst, $monthlyTotal,$hostingRequest) {
  //     $hostingRequest = EmailHostingRequest::create([
  //       'user_id'                 => $data['user_id'] ?? null,
  //       'user_type'               => $data['user_type'],
  //       'email'                    => $data['email'],
  //       'first_name'               => $data['first_name'],
  //       'last_name'                => $data['last_name'],
  //       'mobile'                   => $data['mobile'] ?? null,
  //       'contact_preference'        => $data['contact_preference'] ?? [],
  //       'term_condition'            => $data['term_condition'],
  //       'auth'                     => $data['auth'] ?? false,
  //       'period_required'           => $duration,
  //       'request_status'             => 'pending',
  //       'monthly_fee'               => $monthlyFee,
  //       'total_subscription_cost'   => round($monthlyFee * $duration, 2),
  //       'gst_rate'                  => $gstRate,
  //       'total_gst'                 => round($monthlyGst * $duration, 2),
  //       'currency'                  => 'AUD',
  //       'start_date'                => Carbon::today(),
  //       'end_date'                  => Carbon::today()->addMonths($duration),
  //       'next_payment_date'         => Carbon::today()->addMonth(),
  //       'payment_gateway'            => 'pinpayments',
  //       'pin_customer_token'        => $data['pin_customer_token'],
  //       'pin_card_token'            => $data['pin_card_token'] ?? null,
  //       'subscription_status'        => 'pending',
  //       'auto_renew'                => true,
  //       'comments'                   => $data['comments'] ?? null,
  //     ]);

  //     for ($month = 1; $month <= $duration; $month++) {
  //       EmailHostingSubscriptionPayment::create([
  //         'email_hosting_request_id' => $hostingRequest->id,
  //         'installment_number'        => $month,
  //         'due_date'                  => Carbon::today()->addMonths($month - 1),
  //         'amount'                    => $monthlyFee,
  //         'gst_amount'                => $monthlyGst,
  //         'total_amount'               => $monthlyTotal,
  //         'paid_amount'                => 0,
  //         'payment_status'             => $month === 1 ? 'processing' : 'scheduled',
  //         'idempotency_key'            => (string) Str::uuid(),
  //       ]);
  //     }
  //     return $hostingRequest;
  //   });

  //   // Request and schedule are already persisted at this point.
  //   // Even if Pin Payments fails, we will retain the request.
  //   try {
  //     $firstPayment = EmailHostingSubscriptionPayment::where('user_id', auth()->user()->id)
  //     ->where(['email_hosting_request_id'=> $hostingRequest->id,])->first();
  //     $description = "Product Purchase";
  //     if ($firstPayment->total_amount > 0) {
  //       $metadata['metadata'] = [
  //         'email_hosting_request_id' => (string) $request->id,
  //         'payment_id' => (string) $firstPayment->id,
  //         'installment_number' => '1',
  //       ];
  //       // make payment using charge method
  //       $response = $this->pinPayments->charge($data['pin_token'], $firstPayment->total_amount, $data['email'], $description, $metadata);
  //       if ($response['status'] === false) {
  //         DB::rollBack();

  //         // return response()->json(['status' => false, 'message' => $response['error'], 'errors' => $response['errors']], 400);
  //       } else if ($response['status'] === true) {
  //         // store payment history 
  //         DB::commit();
  //         $this->pinPayments->handlePaymentHistory($response['data']['response']);
  //         // return response()->json(['status' => true, 'message' => "Order Placed Successfully."]);
  //       }
  //     }


  //     return [
  //       'success' => true,
  //       'request' => $request->fresh(),
  //       'subscription' => $subscription ?? "",
  //       'message' => 'Request created and subscription payment initiated. Awaiting payment confirmation.',
  //     ];
  //   } catch (Throwable $e) {
  //     $request->subscriptionPayments()
  //       ->where('installment_number', 1)
  //       ->update([
  //         'payment_status' => 'failed',
  //         'failure_reason' => $e->getMessage(),
  //       ]);

  //     Log::error('Email hosting Pin Payments subscription error', [
  //       'request_id' => $request->id,
  //       'error' => $e->getMessage(),
  //     ]);

  //     return [
  //       'success' => false,
  //       'request' => $request->fresh(),
  //       'message' => 'Request was saved but payment initiation failed.',
  //       'error' => $e->getMessage(),
  //     ];
  //   }
  // }

  public function createRequest(array $data): array
  {
    // Fetch monthly email hosting price
    $monthlyFee = (float) FeesConciergeService::where(
      'service_type',
      'Email Account'
    )->value('amount');

    if ($monthlyFee <= 0) {
      throw new \RuntimeException('Email hosting price is not configured.');
    }

    // Pricing calculations
    $duration = max(1, (int) $data['period_required']);
    $gstRate = (float) config('app.payment.gst_percentage', 0);

    $totalBaseAmount = round($monthlyFee * $duration, 2);
    $totalGst = round(($totalBaseAmount * $gstRate) / 100, 2);
    $totalAmount = round($totalBaseAmount + $totalGst, 2);

    $frontendAmount = isset($data['total_amount'])? round((float) $data['total_amount'], 2): null;

    if ($frontendAmount === null || $frontendAmount <= 0) {
      throw new \InvalidArgumentException(
        'Invalid payment amount. Please refresh and try again.'
      );
    }

    // Compare frontend amount with backend calculated amount
    if (abs($frontendAmount - $totalAmount) > 0.009) {

      Log::warning('Email hosting payment amount mismatch', [
        'user_id' => $data['user_id'] ?? null,
        'frontend_amount' => $frontendAmount,
        'backend_amount' => $totalAmount,
        'monthly_fee' => $monthlyFee,
        'duration' => $duration,
        'gst_rate' => $gstRate,
      ]);

      throw new \InvalidArgumentException(
        'Payment amount verification failed. Please refresh the page and try again.'
      );
    }




    $today = Carbon::today();

    /*
    |--------------------------------------------------------------------------
    | STEP 1: Create email hosting request
    |--------------------------------------------------------------------------
    */

    $request = EmailHostingRequest::create([
      'user_id'              => $data['user_id'] ?? null,
      'user_type'             => $data['user_type'],
      'email'                 => $data['email'],
      'first_name'            => $data['first_name'],
      'last_name'             => $data['last_name'],
      'mobile'                => $data['mobile'] ?? null,
      'contact_preference'     => $data['contact_preference'] ?? [],
      'term_condition'         => $data['term_condition'] ?? false,
      'payment_authorized'    => $data['auth'] ?? false,
      'period_required'        => $duration,

      // Request status
      'request_status'         => 'pending',

      // Payment / pricing details
      'payment_status'         => 'pending',
      'monthly_fee'            => $monthlyFee,
      'total_subscription_cost' => $totalBaseAmount,
      'gst_rate'                => $gstRate,
      'total_gst'               => $totalGst,
      'total_amount'             => $totalAmount,
      'amount_paid'              => 0,
      'currency'                  => 'AUD',

      // Service dates - set once payment succeeds
      'start_date'              => null,
      'end_date'                => null,

      // Gateway
      'payment_gateway'          => 'pinpayments',

      // Optional gateway customer/card references
      'gateway_customer_id'      => $data['pin_customer_token'] ?? null,
      'payment_method_id'         => $data['pin_card_token'] ?? null,

      'comments'                  => $data['comments'] ?? null,
    ]);

    /*
    |--------------------------------------------------------------------------
    | STEP 2: Charge full amount through Pin Payments (one-time payment)
    |--------------------------------------------------------------------------
    */

    try {

      $description = 'Email Hosting - One-Time Payment';

      $metadata = [
        'email_hosting_request_id' => (string) $request->id,
        'period_required'            => (string) $duration,
        'payment_type'               => 'one_time',
      ];

      $response = $this->pinPayments->charge($data['pin_token'], $totalAmount,$data['email'],$description,$metadata);

      /*
        |--------------------------------------------------------------------------
        | STEP 3: Handle unsuccessful charge
        |--------------------------------------------------------------------------
        */

      if (empty($response['status'])) {

        $errorMessage = $response['error']
          ?? $response['message']
          ?? 'Pin Payments charge failed.';

        $request->update([
          'payment_status'         => 'failed',
          'payment_error_message'  => $errorMessage,
        ]);

        Log::warning('Email hosting one-time payment failed', [
          'request_id' => $request->id,
          'amount' => $totalAmount,
          'response' => $response,
        ]);

        return [
          'success' => false,
          'request' => $request->fresh(),
          'message' => $errorMessage,
        ];
      }

      /*
        |--------------------------------------------------------------------------
        | STEP 4: Extract gateway charge response
        |--------------------------------------------------------------------------
        */

      $chargeData = $response['data']['response'] ?? null;

      if (empty($chargeData)) {

        // Gateway reported success, but charge details are missing.
        // Keep it in processing for reconciliation.
        $request->update([
          'payment_status' => 'processing',
          'payment_error_message' =>
          'Payment reported successful but transaction details are missing. Reconciliation required.',
        ]);

        Log::error('Pin Payments success response missing charge data', [
          'request_id' => $request->id,
          'response' => $response,
        ]);

        return [
          'success' => false,
          'request' => $request->fresh(),
          'message' => 'Payment requires verification. The request has been saved.',
        ];
      }

      /*
        |--------------------------------------------------------------------------
        | STEP 5: Extract transaction details
        |--------------------------------------------------------------------------
        |
        | Verify the transaction ID key against your Pin Payments response.
        | Adjust the key below if your charge service returns a different format.
        |--------------------------------------------------------------------------
        */

      $transactionId = $chargeData['token']
        ?? $chargeData['id']
        ?? $chargeData['transaction_id']
        ?? null;

      /*
        |--------------------------------------------------------------------------
        | STEP 6: Update request after successful charge
        |--------------------------------------------------------------------------
        */

    DB::transaction(function () use (
    $request,
    $totalAmount,
    $totalBaseAmount,
    $totalGst,
    $transactionId,
    $today,
    $duration,
    $monthlyFee,
    $gstRate,
    $chargeData
) {
    $request->update([
        'request_status'         => 'active',
        'payment_status'         => 'paid',
        'amount_paid'            => $totalAmount,
        'payment_transaction_id' => $transactionId,
        'payment_reference'      => $transactionId,
        'payment_date'           => now(),
        'payment_error_message'  => null,
        'start_date'             => $today,
        'end_date'               => $today->copy()->addMonths($duration),
    ]);

    PaymentHistory::create([
        'user_id'              => $request->user_id,
        'completed_by'         => $request->user_id,
        'ref_no'               => now()->format('Ymd') . rand(100, 999),
        'amount'               => $totalBaseAmount,
        'gst_amount'           => $totalGst,
        'paid_amount'          => $totalAmount,
        'wallet_amount'        => 0,
        'net_amount'           => $totalAmount,
        'delivery_charge'      => 0,
        'total_payable_amount' => $totalAmount,
        'currency'             => 'AUD',
        'transaction_id'       => $transactionId,
        'service'              => 'Email Hosting',
        'status'               => 'success',
        'paid_at'              => now(),
        'card'                 => $chargeData['card']['display_number'] ?? null,
        'meta'                 => json_encode([
            'email_hosting_request_id' => $request->id,
            'period_required' => $duration,
            'monthly_fee' => $monthlyFee,
            'payment_gateway' => 'pinpayments',
            'gateway_response' => $chargeData,
        ]),
    ]);
});

     
      /*
        |--------------------------------------------------------------------------
        | STEP 7: Return success
        |--------------------------------------------------------------------------
        */

      return [
        'success' => true,
        'request' => $request->fresh(),
        'message' => 'Email hosting request created and full payment successfully processed.',
      ];
    } catch (\Throwable $e) {

      /*
        |--------------------------------------------------------------------------
        | STEP 9: Handle payment exception
        |--------------------------------------------------------------------------
        |
        | Do not delete the request. Keep it available for retry/reconciliation.
        |--------------------------------------------------------------------------
        */

      $request->update([
        'payment_status'         => 'failed',
        'payment_error_message'  => $e->getMessage(),
      ]);

      Log::error('Email hosting Pin Payments exception', [
        'request_id' => $request->id,
        'amount' => $totalAmount,
        'error' => $e->getMessage(),
      ]);

      return [
        'success' => false,
        'request' => $request->fresh(),
        'message' => 'Email hosting request was saved but payment failed.',
        'error' => $e->getMessage(),
      ];
    }
  }
}
