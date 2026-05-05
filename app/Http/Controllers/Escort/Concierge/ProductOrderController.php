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
use Yajra\DataTables\DataTables;

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
      $tax = config('escorts.product_tax');
      $deliveryCharges = 0;

      if (!isset($data['deliveryDetails']['delivery_type']) || (isset($data['deliveryDetails']['delivery_type']) && empty($data['deliveryDetails']['delivery_type']))) {
        return response()->json(['status' => false, 'message' => 'please select delivery type']);
      }
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
      if ($data['deliveryDetails']['delivery_type'] == 'post') {
        $deliveryCharges = config('escorts.delivery_charge_post');
      } else {
        $deliveryCharges = config('escorts.delivery_charge_delivery');
      }
      if ($total == $data['paymentDetails']['subtotal_payble']) {
        return response()->json(['status' => false, 'message' => 'mismatch price calculation']);
      }

      $total = $subtotal + $tax + $deliveryCharges;
      if (number_format($total, 2) != number_format($data['paymentDetails']['total_payble'], 2)) {
        return response()->json(['status' => false, 'message' => 'mismatch price calculation']);
      }

      $orderData = [
        'order_id' => 'B001',
        'user_id' => Auth::user()->id,
        'order_date' => Carbon::now('UTC'),
        'order_status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => $total,
        'sub_total' => $subtotal,
        'tax_amount' => $tax,
        'delivery_charges' => $deliveryCharges ?? 0,
        'notes' => $data['deliveryDetails']['special_instructions']
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
              'total' => $details['price'] * $details['qty'],
            ];
            ProductOrderItem::create($orderItem);
          }
          // prepare data for delivery details like billing & shipping address
          $orderAddressShipping = [
            'order_id' => $order->id,
            'type' => 'shipping',
            'email' => $data['deliveryDetails']['email'],
            'phone' => $data['deliveryDetails']['phone'],
            'address_line1' => $data['deliveryDetails']['address'],
            'state' => $state['stateName'],
            'country' => 'Australia',
            'city' => $data['deliveryDetails']['city'] ?? '',
            'pincode' => $data['deliveryDetails']['pincode'] ?? '',
          ];

          $delivery = $data['deliveryDetails'];
          $stateName = $state['stateName'];
          $same = isset($delivery['sameAddress']) ? 1 : 0;
          // Prepare billing address
          if ($same == 1) {
            // Billing = Delivery
            $billing = [
              'email'         => $delivery['email'],
              'phone'         => $delivery['phone'],
              'address_line1' => $delivery['address'],
              'address_line2' => $delivery['address_2']??'',
              'city'          => $delivery['city'] ?? '',
              'pincode'       => $delivery['pincode'] ?? '',
              'landmark'      => $delivery['landmark'] ?? '',
              'state'         => $stateName,
              'country'       => 'Australia',
            ];
          } else {
            // Billing different
            $billing = [
              'email'         => $delivery['billing_email'] ?? '',
              'phone'         => $delivery['billing_phone'] ?? '',
              'address_line1' => $delivery['billing_address_line1'] ?? '',
              'address_line2' => $delivery['billing_address_line2'] ?? '',
              'city'          => $delivery['billing_city'] ?? '',
              'pincode'       => $delivery['billing_pincode'] ?? '',
              'landmark'      => $delivery['billing_landmark'] ?? '',
              'state'         => $stateName,
              'country'       => 'Australia',
            ];
          }

          $orderAddressBilling = array_merge([
            'order_id' => $order->id,
            'type'     => 'billing',
          ], $billing);
          OrderAddress::create($orderAddressShipping);
          OrderAddress::create($orderAddressBilling);
        }
      });

      return response()->json(['status' => true, 'message' => "Order Placed Successfully."]);
    } catch (\Exception $e) {

      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }

  public function orders(Request $request)
  {
    try {
      $order = ProductOrder::orderby('id', 'desc')->get();
      return  view('escort.dashboard.Concierge.product-order-history');
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }

  public function orderList(Request $request)
  {
    $query = ProductOrder::query();

    return DataTables::of($query)

      ->addColumn('order_date', function ($row) {
        return $row->order_date;
      })
      ->addColumn('order_status', function ($row) {
        return '<span class="badge bg-info">' . $row->order_status . '</span>';
      })
      ->addColumn('payment_status', function ($row) {
        return '<span class="badge bg-info">' . $row->payment_status . '</span>';
      })
      ->addColumn('action', function ($row) {
        return '<a href="" class="btn btn-sm btn-primary">View</a>';
      })
      ->addColumn('payment_method', function ($row) {
        return $row->payment_method ?? 'Card';
      })
      ->rawColumns(['order_status', 'action', 'payment_status'])
      ->make(true);
  }
}
