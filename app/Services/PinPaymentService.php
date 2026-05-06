<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class PinPaymentService
{
  public function charge($token, $amount, $email = null, $description = null)
  {
    try {
      $url=config("app.payment.test_url");
      $response = Http::withBasicAuth(
        config('app.payment.secret_key'),
        ''
      )->asForm()->post($url, [
        'amount' => $amount * 100,
        'currency' => 'AUD', 
        'description' => $description ?? 'E4U Service',
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
