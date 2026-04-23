<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class PinPaymentService
{
    public function charge($token, $amount, $email = null)
    {
        try {
            $response = Http::withBasicAuth(
                config('app.payment.secret_key'),
                ''
            )->asForm()->post('https://test-api.pinpayments.com/1/charges', [
                'amount' => $amount*100,
                'currency' => 'AUD',
                'description' => 'Laravel Payment',
                'email' => $email ?? 'customer@example.com',
                'card_token' => $token
            ]);

            $response->throw();

            return [
                'status' => true,
                'data' => $response->json()
            ];

        } catch (RequestException $e) {

            return [
                'status' => false,
                'error' => $e->response->json()
            ];

        } catch (\Exception $e) {

            return [
                'status' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}