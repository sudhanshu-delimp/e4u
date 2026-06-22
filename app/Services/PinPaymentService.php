<?php

namespace App\Services;

use App\Mail\Escort\Order\OrderMailToE4U;
use App\Mail\Escort\Order\OrderMailToEscort;
use App\Mail\Escort\Order\SendOrderMailToCondomMan;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use App\Models\PaymentHistory;
use App\Models\ProductOrder;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\DataTablePagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PinPaymentService
{
  use DataTablePagination;
  protected $walletAmount = 0.00;
  protected $totalAmount = 0.00;
  protected $gstAmount = 0.00;
  protected $totalDueAmount = 0.00;

  public function setAmount($amount)
  {
    $this->totalAmount = $amount;
    return $this;
  }

  public function setWalletAmount($amount)
  {
    $this->walletAmount = $amount;
    return $this;
  }

  public function getGSTAmount()
  {
    $this->gstAmount = (($this->totalAmount + $this->walletAmount) * config('app.payment.gst_percentage')) / 100;
    return number_format($this->gstAmount, 2, '.', '');
  }

  public function getTotalDue()
  {
    $this->totalDueAmount = $this->totalAmount + $this->gstAmount;
    return number_format($this->totalDueAmount, 2, '.', '');
  }

  public function charge(string $token, float $amount, $email = null, $description = null, $metadata = [])
  {
    try {
      $url = config("app.payment.base_url");
      $secretKey = config('app.payment.secret_key');

      // validate some meta data fileds that's required for make payment 
      if (!empty($metadata)) {
        $validationResponse =  $this->validateMetadata($metadata);

        if ($validationResponse['status'] == false)
          return ['status' => false, 'error' => $validationResponse['error']];
      }

      $response = Http::withBasicAuth($secretKey,  '')->asForm()->post($url . '/1/charges', [
        'amount' => $amount * 100,
        'currency' => 'AUD',
        'description' => $description ?? 'E4U Service',
        'email' => $email ?? 'customer@example.com',
        'card_token' => $token,
        'metadata' => $metadata,
      ]);

      $response->throw();
      return ['status' => true,  'data' => $response->json()];
    } catch (RequestException $e) {
      return ['status' => false,  'error' => $e->response->json()['error_description'], 'errors' => $e->response->json()['messages'] ?? []];
    } catch (\Exception $e) {
      return ['status' => false,  'error' => $e->getMessage()];
    }
  }


  protected function validateMetadata(array $metadata)
  {
    $requiredFields = ['type'];
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

  public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user = null)
  {
    $order_field = $columns[$order_key]['name'];
    $searchables = $this->getSearchableFieldsName($columns);
    $query = PaymentHistory::query();
    if (!empty($user)) {
      $query->where('user_id', $user->id);
    }
    if ($search) {
      $query->where(function ($q) use ($searchables, $search) {
        foreach ($searchables as $column) {
          $q->orWhere($column, 'LIKE', "%{$search}%");
        }
      });
    }
    $count =  $query->count();
    $query->orderBy($order_field, $dir);
    $mainQuery = $query->offset($start)->limit($limit);
    return [$mainQuery->get(), $count, [$query->toSql(), $searchables]];
  }

  public function modifyRecords($result)
  {
    foreach ($result as $key => $item) {
      $item->completed_by_member_id = isset($item->createdBy->member_id) ? $item->createdBy->member_id : $item->completedByUser->member_id;
      $item->transaction_at = convert_aus_date_time_format($item->created_at);
      $item->type = ucfirst($item->type);
      $item->amount = formatCurrency($item->paid_amount);
      $action = '<div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">';
      $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-item="' . encrypt($item->id) . '" data-target="#view-listing" > <i class="fa fa-eye"></i> View </a>';
      $action .= '</div></div>';
      $item->action = $action;
    }
    return $result;
  }

  public function handlePaymentHistory(array $response)
  {
    try {
      // update order status
      $paymentStatus = $response['success'] == true ? 'paid' : 'failed';
      ProductOrder::where('id', $response['metadata']['order_id'])->update(['payment_status' => $paymentStatus, 'payment_message' => $response['status_message'], 'transaction_id' => $response['token']]);

      // make history of payment
      PaymentHistory::create(
        [
          'user_id'  => $response['metadata']['user_id'],
          'completed_by'  => $response['metadata']['user_id'],
          'ref_no'          => now()->format('Ymd') . rand(100, 999),
          'amount'          => $response['metadata']['sub_total_amount'],
          'gst_amount' => $response['metadata']['gst_amount'],
          'paid_amount'          => $response['amount'] / 100,
          'wallet_amount'  => $response['metadata']['wallet_amount'],
          'net_amount'  => $response['metadata']['net_amount'],
          'delivery_charge'  => $response['metadata']['delivery_charge'],
          'currency'        => $response['currency'],
          'transaction_id'  => $response['token'],
          'service'  => !empty($response['metadata']['type']) ? ucwords(str_replace('-', ' ', $response['metadata']['type'])) : '',
          'status'          => $response['success'] ? 'success' : 'failed',
          'paid_at'         => $response['captured_at'] ?? $response['created_at'],
          'card'            => $response['card']['display_number'] ?? null,
          'meta'            => json_encode($response),
        ]
      );
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }
  }

  public function handleWalletAmount(int $userId, $walletAmount)
  {
    try {
      $wallet = Wallet::where('user_id', $userId)->first();
      $newBalance = $wallet->balance - $walletAmount;
      $wallet->balance = $newBalance;
      $wallet->save();
      return true;
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }
  }

  public function paymentHistoryDetail(int $id)
  {
    return PaymentHistory::findOrFail($id);
  }

  public function getTransactionDetail($transaction_id = null)
  {
    if (!empty($transaction_id)) {
      return PaymentHistory::where('transaction_id', $transaction_id)->first();
    } else {
      return false;
    }
  }

  public function saveTransaction(array $insert)
  {
    $payment = PaymentHistory::create($insert);
    return $payment;
  }
}
