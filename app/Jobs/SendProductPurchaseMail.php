<?php

namespace App\Jobs;

use App\Mail\Escort\Order\OrderMailToAgent;
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
      // Log::info("working mail ");
      $mailData = [];
      $order =   ProductOrder::with(['orderAddress', 'paymentDetails', 'user', 'createdBy'])->where('id', $this->paymentObject['metadata']['order_id'])->first();
      if ($order->orderAddress) {
        $mailData['id'] = $order->id;

        $memberId = $order->user ? $order->user->member_id : '';
        $billingAddress = $order->orderAddress->where('type', 'billing')->first();
        $mailData['ref'] = $order->paymentDetails->ref_no ?? '';
        $mailData['member_id'] = $memberId;
        $mailData['order_id'] = $order->order_id ?? "";
        $mailData['billing_name'] = $order->user ? $order->user->name : "";
        $mailData['agent_name'] = $order->createdBy ? $order->createdBy->name : "";
        $mailData['escort_name'] = $order->user ? $order->user->name : "";
        // send email to e4u

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
        $mailData['member_name'] = $order->user ? $order->user->name : "";
        $mailData['email'] = $shippingAddress->email ? $shippingAddress->email : "";
        $mailData['mobile'] = $shippingAddress->phone ? $shippingAddress->phone : "";
        $mailData['delivery_address'] = $completeAddress;
        $mailData['delivery_type'] = $order->delivery_type ? $order->delivery_type : "Door";

        $products = $order->orderItems;

        $mailData['products'] = $products;
        $mailData['sub_total'] = $order->paymentDetails->amount;
        $mailData['wallet_amount'] = $order->paymentDetails->wallet_amount;
        $mailData['grand_total'] = $order->paymentDetails->paid_amount;
        $mailData['tax_amount'] = $order->paymentDetails->gst_amount;
        $mailData['delivery_charges'] = $order->paymentDetails->delivery_charge;
        $billingMail = $billingAddress->email;
        // $billingMail = "ashish.kumar+10@delimp.com";
        if ($order->createdBy &&  $order->createdBy->email &&  $order->user_id != $order->createdBy->id) {
          $agentMail = $order->createdBy->email;
          // $agentMail = "ashish.kumar+09@delimp.com";

          Mail::to($agentMail)->cc($billingMail)->send(new OrderMailToEscort($mailData));
        } else {
          Mail::to($billingMail)->send(new OrderMailToEscort($mailData));
        }

        $e4uEmail = config('app.e4u_mail');
        // $e4uEmail = "ashish.kumar+11@delimp.com";
        Mail::to($e4uEmail)->send(new OrderMailToE4U($mailData));
        // Log::info("sent mail");

        // // send mail to condom man (suppplier)
        $condommail = config('app.condom_mail');
        // $condommail = "ashish.kumar+12@delimp.com";

        Mail::to($condommail)->send(new SendOrderMailToCondomMan($mailData));
      }
    } catch (\Exception $e) {
      Log::info('', [$e->getMessage()]);
    }
  }
}
