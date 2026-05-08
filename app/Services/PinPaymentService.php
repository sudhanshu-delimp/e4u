<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class PinPaymentService
{
  public function charge(string $token, float $amount, $email = null, $description = null, $metadata = [])
  {
    try {
      $url = config("app.payment.test_url");
      $secretKey = config('app.payment.secret_key');

      // validate some meta data fileds that's required for make payment 
      if (!empty($metadata)) {
        $validationResponse =  $this->validateMetadata($metadata);

        if ($validationResponse['status'] == false)
          return ['status' => false, 'error' => $validationResponse['error']];
      }

      $response = Http::withBasicAuth($secretKey,  '')->asForm()->post($url, [
        'amount' => $amount * 100,
        'currency' => 'AUD',
        'description' => $description ?? 'E4U Service',
        'email' => $email ?? 'customer@example.com',
        'card_token' => $token,
        'metadata' => $metadata
      ]);
      $response->throw();
      return ['status' => true,  'data' => $response->json()];
    } catch (RequestException $e) {
      return ['status' => false,  'error' => $e->response->json()['error_description']];
    } catch (\Exception $e) {
      return ['status' => false,  'error' => $e->getMessage()];
    }
  }


  protected function validateMetadata(array $metadata)
  {
    $requiredFields = ['type', 'console', 'order_id', 'user_id'];

    foreach ($requiredFields as $field) {

      if (empty($metadata[$field])) {

        return [
          'status' => false,
          'error'  => "Missing required metadata field: {$field}."
        ];
      }
    }

    return ['status' => true];
  }
}
