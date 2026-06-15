<?php

namespace App\Jobs;

use App\Mail\Escort\Order\OrderMailToE4U;
use App\Mail\Escort\Order\OrderMailToEscort;
use App\Mail\Escort\Order\SendOrderMailToCondomMan;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendProductPurchaseMail implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  private array $paymentObject;
  public function __construct(array $paymentObject)
  {
    $this->paymentObject = $paymentObject;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {

    try {
      Log::info("working mail ");
      $mailData = [];
      $order =   ProductOrder::with(['orderAddress', 'paymentDetails', 'user'])->where('id', $this->paymentObject['metadata']['order_id'])->first();
      if ($order->orderAddress) {
        $mailData['id'] = $order->id;

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
        $mailData['member_name'] = $user ? $user->name : "example@gmail.com";
        $mailData['email'] = $shippingAddress->email ? $shippingAddress->email : "example@gmail.com";
        $mailData['mobile'] = $shippingAddress->phone ? $shippingAddress->phone : "999999999999";
        $mailData['delivery_address'] = $completeAddress;
        $mailData['delivery_type'] = $order->delivery_type ? $order->delivery_type : "Door";
        $e4uEmail = config('app.e4u_mail');

        Mail::to($e4uEmail)->send(new OrderMailToE4U($mailData));

        // // send mail to condom man (suppplier)
        $products = $order->orderItems;
        $condommail = config('app.condom_mail');
        $mailData['member_name'] = $user->name;
        $mailData['products'] = $products;
        $mailData['sub_total'] = $order->paymentDetails->amount;
        $mailData['wallet_amount'] = $order->paymentDetails->wallet_amount;
        $mailData['grand_total'] = $order->paymentDetails->paid_amount;
        $mailData['tax_amount'] = $order->paymentDetails->gst_amount;
        $mailData['delivery_charges'] = $order->paymentDetails->delivery_charge;

        Mail::to($condommail)->send(new SendOrderMailToCondomMan($mailData));
      }
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }
  }
}
