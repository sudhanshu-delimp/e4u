<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductOrderItem;
use App\Models\State;
use App\Services\PinPaymentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ProductOrderController extends Controller
{



  protected $account;
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      $this->account = auth()->user();
      return $next($request);
    });
  }
  // public function makeOrder(Request $request,)
  // {


  //   try {

  //     return response()->json(['status' => true, 'message' => "Order Placed Successfully.", 'orderId' => $order->id]);
  //   } catch (\Exception $e) {
  //     DB::rollBack();
  //     return response()->json(['status' => false, 'message' => $e->getMessage()]);
  //   }
  // }


  public function makeOrderPayment(Request $request, PinPaymentService $pinPaymentService)
  {
    try {

      DB::beginTransaction();

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
      // calculate subtotal for cross check pricing and db update
      foreach ($data['itemDetails'] as $productId => $details) {
        $product = Product::find($productId);
        if (empty($product))
          return response()->json(['status' => false, 'message' => 'something went wrong!']);

        if ($product->price != $details['price'])
          return response()->json(['status' => false, 'message' => 'something went wrong!']);

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

      $total = $subtotal + $deliveryCharges;
      if (number_format($total, 2) != number_format($data['paymentDetails']['total_payble'], 2)) {
        return response()->json(['status' => false, 'message' => 'mismatch price calculation']);
      }

      $orderData = [
        'order_id' => Auth::user()->member_id . "-" . rand(111111, 999999),
        'type' => 'EC',
        'user_id' => Auth::user()->id,
        'order_date' => date('Y-m-d H:i:s'),
        'order_status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => $total,
        'sub_total' => $subtotal,
        'tax_amount' => $tax,
        'payment_method' => 'Card',
        'delivery_charges' => $deliveryCharges ?? 0,
        'delivery_type' => $data['deliveryDetails']['delivery_type'],
        'notes' => $data['deliveryDetails']['special_instructions']
      ];



      $products = [];
      $order = ProductOrder::find($request->orderId);

      if (!empty($request->orderId) && $order)
        $order->update($orderData);
      else
        $order = ProductOrder::create($orderData);


      if ($order) {
        $order->orderItems()->delete();
        $order->orderAddress()->delete();
        // prepare data for order item
        foreach ($data['itemDetails'] as $productId => $details) {
          $orderItem = [
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $details['qty'],
            'price' => $details['price'],
            'total' => $details['price'] * $details['qty'],
          ];
          array_push($products, $orderItem);
          ProductOrderItem::create($orderItem);
        }

        $delivery = $data['deliveryDetails'];
        // prepare data for delivery details like billing & shipping address
        $orderAddressShipping = [
          'order_id' => $order->id,
          'type' => 'shipping',
          'email' => $delivery['email'],
          'phone' => $delivery['phone'],
          'address_line1' => $delivery['address'],
          'state' => $state['stateName'],
          'country' => 'Australia',
          'city' => $delivery['city'] ?? '',
          'pincode' => $delivery['pincode'] ?? '',
        ];

        $stateName = $state['stateName'];
        $same = isset($delivery['sameAddress']) ? 1 : 0;
        // Prepare billing address
        if ($same == 1) {
          // Billing = Delivery
          $billing = [
            'email'         => $delivery['email'],
            'phone'         => $delivery['phone'],
            'address_line1' => $delivery['address'],
            'address_line2' => $delivery['address_2'] ?? '',
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
      DB::commit();


      // prepare metdata for product order

      $order = ProductOrder::with('orderItems', 'orderAddress')->where('id', $order->id)->first();
      $biilingAddress = $order->orderAddress()->where('type', 'billing')->first();
      if (empty($order))
        return response()->json(['status' => false, 'message' => "Something went wrong"]);

      $products = [];
      foreach ($order->orderItems as $orderItem) {
        $item = ['product_id' => $orderItem->product_id, 'quantity' => $orderItem->quantity, 'price' => $orderItem->price];
        array_push($products, $item);
      }

      $metadata = [
        'console' => 'Escort Console (E20189)',
        'type' => 'product-purchase',
        'order_id' => $order->id,
        'user_id' => Auth::user()->id,
        'total' => $order->total_amount,
        'products' => json_encode($products)
      ];
      $description = "Product Purchase";
      // make payment using charge method
      $response = $pinPaymentService->charge($data['pin_token'], $order->total_amount, $biilingAddress->email, $description, $metadata);
      if ($response['status'] === false) {
        return response()->json(['status' => false, 'message' => $response['error'], 'errors' => $response['errors']]);
      } else if ($response['status'] === true) {
        return response()->json(['status' => true, 'message' => "Order Placed Successfully."]);
      }
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }

  public function orders(Request $request)
  {
    try {
      return  view('escort.dashboard.Concierge.product-order-history');
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }

  public function orderList(Request $request)
  {
    $query = ProductOrder::orderBy('created_at', 'DESC');
    $classes = config('escorts.payment_status');

    return DataTables::of($query)

      ->addColumn('order_date', function ($row) {
        return  date('d M Y, h:i A', strtotime($row->order_date));
      })
      ->addColumn('order_status', function ($row) use ($classes) {
        $class = $classes[$row->order_status] ?? '';
        return '<span class="custom_badge ' . $class . '">' . ucfirst($row->order_status) . '</span>';
      })
      ->addColumn('payment_status', function ($row) use ($classes) {
        $class = $classes[$row->payment_status] ?? '';
        return '<span class="custom_badge ' . $class . '">' . ucfirst($row->payment_status) . '</span>';
      })
      ->addColumn('action', function ($row) {
        return '<div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dot-dropdown dropdown-menu dropdown-menu-right  " aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-order-details" href="#" data-toggle="modal" data-item="' . $row->id . '"  > <i class="fa fa-eye"></i> View Details </a></div></div>';
      })
      ->addColumn('payment_method', function ($row) {
        return $row->payment_method ?? 'Card';
      })
      ->rawColumns(['order_status', 'action', 'payment_status'])
      ->make(true);
  }

  public function getOrderDetails(Request $request)
  {
    try {
      $order = ProductOrder::with(['orderAddress', 'paymentDetails', 'orderItems', 'orderItems.product'])->where('id', $request->id)->first();

      $html = view('escort.dashboard.Concierge.product-order-details', compact('order'))->render();
      return response()->json(['status' => true, 'html' => $html]);
    } catch (Exception $e) {
      Log::error($e->getMessage());
    }
  }

  public function success()
  {
    return view('payment.success');
  }

  public function fail()
  {
    return view('payment.fail');
  }
}
