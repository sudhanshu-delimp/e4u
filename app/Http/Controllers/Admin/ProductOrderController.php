<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Escort\Order\SendProductOrderCompleteConfirmationMailToEscort;
use App\Mail\Escort\Order\SendProductOrderHoldMailToEscort;
use App\Mail\Supplier\SendProductOrderCancelMailToSupplier;
use App\Mail\Supplier\SendProductOrderCompleteConfirmationMailToSupplier;
use App\Mail\Supplier\SendProductOrderHoldMailToSupplier;
use App\Models\ProductOrder;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use App\Mail\Escort\Order\SendProductOrderCancelMailToEscort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class ProductOrderController extends Controller
{


  public function orders(Request $request)
  {
    try {
      return  view('admin.Concierge.product-request');
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }

  public function orderList(Request $request)
  {
    $query = ProductOrder::with(['paymentDetails', 'user', 'createdBy'])->orderBy('created_at', 'DESC');
    $classes = config('escorts.payment_status');
    $classesOrder = config('escorts.order_status');
    $orderStatus = config('escorts.order_status_labels');
    return DataTables::of($query)

      ->addColumn('order_date', function ($row) {
        return  date('d-m-y, h:i A', strtotime($row->order_date));
      })
      ->addColumn('total_amount', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->paid_amount : '0.00';
      })
      ->addColumn('agent', function ($row) {
        return  $row->createdBy ? $row->createdBy->member_id : '--';
      })
      ->addColumn('gst_amount', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->gst_amount : '0.00';
      })
      ->addColumn('sub_total', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->amount : '0.00';
      })
      ->editColumn('wallet_amount', function ($row) {
        return   $row->paymentDetails ? $row->paymentDetails->wallet_amount : '0.00';
      })
      ->addColumn('user', function ($row) {
        return   $row->user ? $row->user->name : '';
      })
      ->addColumn('member_id', function ($row) {
        return   $row->user ? $row->user->member_id : '';
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
                               <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item open-status-modal"
   href="#"
   data-id="' . $row->id . '"
   data-status="pending">
    <i class="fa fa-hourglass-half"></i> Pending
</a>

<div class="dropdown-divider"></div>

<a class="dropdown-item open-status-modal"
   href="#"
   data-id="' . $row->id . '"
      data-delivery_type="' . $row->delivery_type . '"
   data-status="hold">
    <i class="fa fa-pause-circle"></i> On Hold
</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item open-status-modal"
   href="#"
   data-id="' . $row->id . '"
   data-status="delivered"
   data-delivery_type="' . $row->delivery_type . '"
   data-toggle="modal"
   data-target="#active_req"><i class="fa fa-check-circle"></i> Complete Order </a>
   <div class="dropdown-divider"></div>


<a class="dropdown-item view-order-details"
   href="#"
   data-toggle="modal"
   data-item="' . $row->id . '"
      data-delivery_type="' . $row->delivery_type . '"
   data-target="#view_order_modal">
   <i class="fa fa-eye"></i> View Details
</a>
   </div></div>
   

   ';


        // <a class="dropdown-item open-status-modal"
        //    href="#"
        //    data-id="' . $row->id . '"
        //    data-status="cancelled"
        //    data-toggle="modal"
        //    data-target="#active_req"><i class="fa fa-check-circle"></i> Cancel Order </a>
        //    <div class="dropdown-divider"></div>
      })
      ->addColumn('payment_method', function ($row) {
        return $row->payment_method ?? 'Card';
      })
      ->with([
        'server_up_time' => $this->getAppUptime(),
        'server_time' => Carbon::now(config('app.escort_server_timezone'))->format('h:i:s A'),
      ])
      ->rawColumns(['order_status', 'action', 'payment_status'])
      ->make(true);
  }

  public function getAppUptime()
  {
    $startTime = Cache::get('app_start_time');
    $str = '';

    if (!$startTime) {
      return 'App start time not available.';
    }

    $start = \Carbon\Carbon::parse($startTime);
    $now = now();

    $diffInSeconds = $now->diffInSeconds($start);

    $days = floor($diffInSeconds / 86400);
    $hours = floor(($diffInSeconds % 86400) / 3600);
    $minutes = floor(($diffInSeconds % 3600) / 60);
    $str .= $days . ' days & ' . $hours . ' hours ' . $minutes . ' minutes';

    return $str;
  }

  public function orderComplete(Request $request)
  {
    try {

      if (empty($request->tracking_id) &&  $request->status == 'delivered') {
        return response()->json([
          'status' => false,
          'message' =>  "Tracnking Id is required for complete order."
        ]);
      }
      if (empty($request->cancel_reason) &&  $request->status == 'cancelled') {
        return response()->json([
          'status' => false,
          'message' =>  "Cancel Reason is required for cancel order."
        ]);
      }

      if (empty($request->status)) {
        return response()->json([
          'status' => false,
          'message' =>  "Status feild are required"
        ]);
      }
      $order =   ProductOrder::with(['orderAddress', 'paymentDetails', 'user', 'createdBy'])->where('id', $request->order_id)->first();
      if (empty($order)) {
        return response()->json([
          'status' => false,
          'message' =>  "Order Not Found "
        ]);
      }
      if ($order->order_status == $request->status) {
        return response()->json([
          'status' => false,
          'message' =>  "Status already set " . $request->status
        ]);
      }
      $condommail = config('app.condom_mail');

      if (empty($condommail)) {
        return response()->json([
          'status' => false,
          'message' => 'Unable to send notification. Supplier email address is not configured.'
        ]);
      }

      DB::transaction(function () use ($request, $order, $condommail) {


        if ($request->status == 'delivered')
          $order->tracking_id = $request->tracking_id;
        if ($request->status == 'cancelled')
          $order->cancel_reason = $request->cancel_reason;


        $order->order_status = $request->status;

        $status = $order->save();
        $status = true;

        $mailData = [];


        $mailData['id'] = $order->id;
        $mailData['ref'] = $order->paymentDetails->ref_no ?? '';
        $mailData['member_id'] = $order->user ? $order->user->member_id : '';
        $mailData['order_id'] = $order->order_id ?? "";
        $mailData['member_name'] = $order->user ? $order->user->name : "";
        $mailData['cancel_reason'] = $request->cancel_reason;
        $shippingAddress = $order->orderAddress->where('type', 'shipping')->first();
        $billing = $order->orderAddress->where('type', 'billing')->first();

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
        $mailData['delivery_address'] = $completeAddress;
        $agent = null;

        if ($order->user->is_agent_assign == 1) {
          $agent = User::where('id', $order->user->assigned_agent_id)->first();
        }
        if ($status) {

          $order->refresh();

          if ($request->status == 'delivered') {

            if ($order->createdBy &&  $order->createdBy->email && $order->user_id != $order->createdBy->id) {
              Mail::to($order->createdBy->email)->cc($billing->email)->send(new SendProductOrderCompleteConfirmationMailToEscort($mailData));
            } else {
              $mail = Mail::to($billing->email);
              if (!empty($agent) && !empty($agent->email)) {
                $mail->cc($agent->email);
              }

              $mail->send(new SendProductOrderCompleteConfirmationMailToEscort($mailData));
            }

            // Send order completed mail notification to supplier
            Mail::to($condommail)->send(new SendProductOrderCompleteConfirmationMailToSupplier($mailData));
          } elseif ($request->status == 'hold') {
            if ($order->createdBy &&  $order->createdBy->email &&  $order->user_id != $order->createdBy->id) {
              Mail::to($order->createdBy->email)->cc($billing->email)->send(new SendProductOrderHoldMailToEscort($mailData));
            } else {

              $mail = Mail::to($billing->email);
              if (!empty($agent) && !empty($agent->email)) {
                $mail->cc($agent->email);
              }
              $mail->send(new SendProductOrderHoldMailToEscort($mailData));
            }
            // Send order hold notification to supplier
            Mail::to($condommail)->send(new SendProductOrderHoldMailToSupplier($mailData));
          }
          // else if ($request->status == 'cancelled') {
          //   // send order cancelletion mail notification to supplier 
          //   Mail::to($condommail)->send(new SendProductOrderCancelMailToSupplier($mailData));

          //    if ($order->createdBy &&  $order->createdBy->email &&  $order->user_id != $order->createdBy->id) {
          //     Mail::to($order->createdBy->email)->cc($billing->email)->send(new SendProductOrderCancelMailToEscort($mailData));
          //   } else {
          //     $mail = Mail::to($billing->email);
          //     if (!empty($agent) && !empty($agent->email)) {
          //       $mail->cc($agent->email);
          //     }
          //     $mail->send(new SendProductOrderCancelMailToEscort($mailData));
          //   }
          // }
        }
      });

      return response()->json([
        'status' => true,
        'message' => 'Your request has been processed successfully.'
      ]);
    } catch (Exception $e) {
      Log::info($e->getMessage(), [$e->getLine(), $e->getFile()]);
      return response()->json([
        'status' => false,
        'message' => $e->getMessage()
      ]);
    }
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
}
