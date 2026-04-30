<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductOrderItem;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductOrderController extends Controller
{
  public function makeOrder(Request $request)
  {


    try {

      $data = $request->all();

      $states = config('escorts.profile.states');
      $state = $states[Auth::user()->state_id] ?? null;


      $subtotal = 0;
      $total = 0;
      $tax = 0;
      $deliveryCharges = 0;
      foreach ($data['itemDetails'] as $productId => $details) {
        $product = Product::find($productId);
        if (empty($product)) {
          return response()->json(['status' => false, 'message' => 'something went wrong!']);
        }
        if ($product->price != $details['price']) {
          return response()->json(['status' => false, 'message' => 'something went wrong!']);
        }

        $subtotal += $product->price * $details['qty'];
      }
      if ($data['deliverDetails']['delivery_type'] == 'post') {
        $deliveryCharges = config('escorts.delivery_charge_post');
      } else {
        $deliveryCharges = config('escorts.delivery_charge_post');
      }
      if ($total == $data['paymentDetails']['subtotal_payble']) {
        return response()->json(['status' => false, 'message' => 'mismatch price calculation']);
      }

      $total += $subtotal * $tax + $deliveryCharges;
      if ($total == $data['paymentDetails']['total_payble']) {
        return response()->json(['status' => false, 'message' => 'mismatch price calculation']);
      }

      $orderData = [
        'order_id' => 'B001',
        'user_id' => Auth::user()->id,
        'order_date' => Carbon::now('UTC'),
        'order_status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => $total,
        'tax_amount' => $tax,
        'delivery_charges' => $deliveryCharges,
        'notes' => $data['special_instructions']
      ];
      DB::transaction(function () use ($orderData, $data, $state) {

        $order = ProductOrder::create($orderData);
        if ($order) {
          // prepare data for order item
          foreach ($data['itemDetails'] as $productId => $details) {
            $orderItem = [
              'order_id' => $order->id,
              'product_id' => $productId,
              'quantity' => $details['qty'],
              'price' => $details['price'],
              'subtotal' => $details['price'] * $details['qty'],
            ];
            ProductOrderItem::create($orderItem);
          }
          // prepare data for delivery details like billing & shipping address
          config('escorts.states');
          $orderAddress = [
            'order_id' => $order->id,
            'type' => 'shipping',
            'email' => $data['deliveryDetails']['email'],
            'phone' => $data['deliveryDetails']['phone'],
            'address_line1' => $data['deliveryDetails']['address'],
            'state' => $state['stateName'],
            'city' => !empty(Auth::user()->city_id) ? $state['cities'][Auth::user()->city_id] : '',
            'country' => 'Australia'
          ];

          OrderAddress::create($orderAddress);
        }
      });
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }
}
