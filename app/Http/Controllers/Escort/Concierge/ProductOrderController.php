<?php

namespace App\Http\Controllers\Escort\Concierge;

use App\Http\Controllers\Controller;
use App\Jobs\SendProductPurchaseMail;
use App\Models\OrderAddress;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductOrderItem;
use App\Services\PinPaymentService;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

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


      $calculatedSubtotal = 0;
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
          return response()->json(['status' => false, 'message' => 'something went wrong!'],422);

        if ($product->price != $details['price'])
          return response()->json(['status' => false, 'message' => 'something went wrong!'],422);

        $calculatedSubtotal += $product->price * $details['qty'];
      }
      if ($data['deliveryDetails']['delivery_type'] == 'post') {
        $deliveryCharges = config('escorts.delivery_charge_post');
      } else {
        $deliveryCharges = config('escorts.delivery_charge_delivery');
      }

      $subtotal       = floatval($data['paymentDetails']['subtotal_payble']);
      $walletAmount   = floatval($data['paymentDetails']['wallet_amount'] ?? 0);
      $totalPayable   = floatval($data['paymentDetails']['total_payble']);
      $deliveryCharges = $deliveryCharges ?? 0; // ensure defined

      // 2. Check subtotal mismatch
      if (number_format($calculatedSubtotal, 2) != number_format($subtotal, 2)) {
        return response()->json([
          'status'  => false,
          'message' => 'Subtotal mismatch after applying wallet amount'
        ],422);
      }



      $gst_amount = ($calculatedSubtotal * $tax) / 100;



      // 3. Calculate final total
      $calculatedTotal = $calculatedSubtotal + $deliveryCharges;
      $netAmount = 0;
      if ($walletAmount > 0) {
        $netAmount = $calculatedSubtotal - $walletAmount;
        $calculatedTotal -= $walletAmount;
        // gst on wallet amount
        // $calculatedTotal += $walletAmount * $tax / 100;
      }

      $calculatedTotal += $gst_amount+67;

      // 4. Check final total mismatch
      if (number_format($calculatedTotal, 2) != number_format($totalPayable, 2)) {
        return response()->json([
          'status'  => false,
          'message' => "The final payable amount is incorrect. Please recheck and continue."
        ],422);
      }
      //  dd();
      //  [LocationPrefix]


      $stateId = $this->account->current_state_id ? $this->account->current_state_id : $this->account->state_id;
      $currentLocationId = "";
      $locationPrefix = "";
      if ($stateId) {
        $stateName  = config("escorts.profile.states.$stateId.stateName");
        $currentLocationId  = config("escorts.profile.statesName.$stateName");
      }

      $nextNumber = sprintf('%04d', ProductOrder::max('id') + 1);

      if (!empty($currentLocationId))
        $locationPrefix = sprintf('%02d', $currentLocationId);

      $orderId = $this->account->member_id . " " . date('dmY') . " " . $locationPrefix . " " . $nextNumber;
      $orderData = [
        'order_id' => $orderId,
        'type' => 'EC',
        'user_id' => Auth::user()->id,
        'order_date' => date('Y-m-d H:i:s'),
        'order_status' => 'pending',
        'payment_status' => 'pending',
        'payment_method' => 'Card',
        // 'total_amount' => $totalPayable,
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

      // prepare metdata for product order
      $order = ProductOrder::with('orderItems', 'orderAddress')->where('id', $order->id)->first();
      $biilingAddress = $order->orderAddress()->where('type', 'billing')->first();
      if (empty($order))
        return response()->json(['status' => false, 'message' => "Something went wrong"],422);

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
        'net_amount' => $netAmount,
        'sub_total_amount' => $subtotal,
        'delivery_charge' => $deliveryCharges,
        'gst_amount' => $gst_amount,
        'wallet_amount' => $walletAmount,
        'products' => json_encode($products)
      ];
      $description = "Product Purchase";
      if ($totalPayable > 0) {
        // make payment using charge method
        $response = $pinPaymentService->charge($data['pin_token'], $totalPayable, $biilingAddress->email, $description, $metadata);
        if ($response['status'] === false) {
          DB::rollBack();
          return response()->json(['status' => false, 'message' => $response['error'], 'errors' => $response['errors']], 400);
        } else if ($response['status'] === true) {
          // store payment history 
          DB::commit();
          $pinPaymentService->handlePaymentHistory($response['data']['response']);
          return response()->json(['status' => true, 'message' => "Order Placed Successfully."]);
        }
      } else {

        // Log::info("wallet transaction");
        $customTransactionId = Str::random(20); // 20-character random string
        PaymentHistory::create(
          [
            'user_id' => $this->account->id,
            'completed_by' => $request->isImpersonated ? $request->impersonatedId : $this->account->id,
            'ref_no'          => now()->format('Ymd') . rand(100, 999),
            'amount'          => $calculatedSubtotal,
            'gst_amount' => $gst_amount,
            'paid_amount'          => $calculatedTotal,
            'wallet_amount'  => $walletAmount,
            'net_amount'  => $netAmount,
            'delivery_charge'  => $deliveryCharges,
            'currency'        => "AUD",
            'transaction_id'  => $customTransactionId,
            'service'  =>  'Product Purchase',
            'status'          =>  'success',
            'paid_at'         => null,
            'card'            =>   null,
            'meta'            => null,
          ]
        );

        // update amount in wallet balance
        $pinPaymentService->handleWalletAmount($this->account->id, $walletAmount);
        // update order payment status
        ProductOrder::where('id', $order->id)->update(['payment_status' => "paid", 'transaction_id' => $customTransactionId, 'payment_method' => 'Wallet']);
        // dispatch job to send product order related mail 
        $customPaymentObject['metadata']['order_id'] = $order->id;
        SendProductPurchaseMail::dispatch($customPaymentObject);
        DB::commit();

        return response()->json(['status' => true, 'message' => "Order Placed Successfully."]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['status' => false, 'message' => $e->getMessage()],422);
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
    $id = session('parent_agent_id') ?? Auth::user()->id;
    $query = ProductOrder::with(['paymentDetails', 'user', 'createdBy'])->where('created_by', $id)->orderBy('created_at', 'DESC');
    $classes = config('escorts.payment_status');
    $classesOrder = config('escorts.order_status');
    $orderStatus = config('escorts.order_status_labels');
    return DataTables::of($query)

      ->addColumn('order_date', function ($row) {
        return date('d-m-y, h:i A', strtotime($row->order_date));
      })
      ->addColumn('agent', function ($row) {
        return  $row->createdBy ? $row->createdBy->member_id : '--';
      })
      ->addColumn('total_amount', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->paid_amount : '0.00';
      })
      ->addColumn('gst_amount', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->gst_amount : '0.00';
      })
      ->addColumn('sub_total', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->amount : '0.00';
      })
      ->addColumn('wallet_amount', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->wallet_amount : '0.00';
      })
      ->addColumn('user', function ($row) {
        return   $row->user ? $row->user->name : '0.00';
      })
      ->editColumn('order_status', function ($row) use ($classesOrder, $orderStatus) {
        $class = $classesOrder[$row->order_status] ?? '';

        return '<span class="custom_badge ' . $class . '">' . $orderStatus[$row->order_status] . '</span>';
      })
      ->editColumn('payment_status', function ($row) use ($classes) {
        $class = $classes[$row->payment_status] ?? '';
        return '<span class="custom_badge ' . $class . '">' . ucfirst($row->payment_status) . '</span>';
      })
      ->addColumn('action', function ($row) {
        return '<div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dot-dropdown dropdown-menu dropdown-menu-right  " aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-order-details" href="#" data-toggle="modal" data-item="' . $row->id . '" data-orderid="' . $row->order_id . '"   > <i class="fa fa-eye"></i> View Details </a></div></div>';
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


  public function printOrderDetail(Request $request)
  {

    $order = ProductOrder::with(['orderAddress', 'paymentDetails', 'orderItems', 'orderItems.product'])->where('id', Crypt::decrypt($request->id))->first();
    $print = true;
    $pdf = FacadePdf::loadView('escort.dashboard.Concierge.product-order-details', compact('order', 'print'));
    return $pdf->stream($order->user->member_id . '_Order_Summary_' . $order->id . '.pdf');
  }
}
