<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

use App\Repositories\Message\MessageRepository;
use App\Services\WalletService;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
  
    protected $account;
    protected $walletService;
    protected $pinService;
    protected $user;
    protected $massage;
    
    public function __construct(WalletService $walletService,  MessageRepository $massage)
    {
        $this->massage = $massage;
        $this->walletService = $walletService;
     
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    public function make_order_summury(Request $request)
    {
        $discountRate_amount = isset($request->total_rate) ? $request->total_rate : 0;
        $discountRate = isset($request->total_rate) ? formatCurrency($request->total_rate) : 0;


        $total_rate = isset($request->total_rate) ? formatCurrency($request->total_rate) : 0;
        $total_discount = isset($request->total_discount) ? formatCurrency($request->total_discount) : 0;
        $total_days = isset($request->days) ? $request->days : 0;
        $normalRate = isset($request->normalRate) ? formatCurrency($request->normalRate) : 0;
        $gstTax = isset($request->total_rate) ? getGSTAmount($request->total_rate) : '$0.00';

        $wallet_discount_amount = isset($request->wallet_discount) ? $request->wallet_discount : 0;
        $loyalty_discount_amount = isset($request->loyalty_discount) ? $request->loyalty_discount : 0;

        $loyalty_use = formatCurrency($wallet_discount_amount);
        $wallet_use = formatCurrency($loyalty_discount_amount);

        $total_fee_amount = $discountRate_amount - $wallet_discount_amount + $loyalty_discount_amount;
        $total_due_amount = $total_fee_amount + $gstTax;

        $total_fee = formatCurrency($total_fee_amount);
        $total_due = formatCurrency($total_due_amount);


        $order_data = [
            'paymentSubtotal' =>  $discountRate,
            'total_fee' => $total_fee,
            'total_due' => $total_due,
            'loyalty_use' => $loyalty_use,
            'wallet_use' => $wallet_use,
            'total_rate' =>  $total_rate,
            'total_discount' => $total_discount,
            'total_days' =>  $total_days,
            'normalRate' =>  $normalRate,
            'gstTax' =>  $gstTax,
        ];

      return  response()->json([
            'success' => false,
            'data' => $order_data,
            'message' => "order summury"
        ]);
        
    }


    public function paymentAdjustment(Request $request)
    {

     echo 'hello';
            exit;
        ///try 
       // {
           

        //     $action = $request->filled('action') ? $request->action : '';
        //     $wallet_amount = $request->filled('wallet_amount') ? (float) $request->wallet_amount : 0;
        //     $loyalty_day = $request->filled('loyalty_day') ? (int) $request->loyalty_day : 0;
           
        //     if (empty($wallet_amount) && empty($loyalty_day)) {
        //         return response()->json([
        //             'status'  => false,
        //             'message' => $action == 'listing' ? 'Please enter wallet amount or loyalty days.' : 'Please enter wallet amount.',
        //         ], 422);
        //     }

        //     $wallet_balance   = $this->account->wallet->balance ?? 0;
        //     $wallet_earn_days = $this->account->wallet->earn_days ?? 0;
        //     // Validate wallet amount
        //     if ($wallet_amount > $wallet_balance) {
        //         return response()->json([
        //             'status'  => false,
        //             'message' => 'Wallet amount exceeds available balance',
        //         ], 422);
        //     }
        //     // Validate loyalty days
        //     if ($loyalty_day > $wallet_earn_days) {
        //         return response()->json([
        //             'status'  => false,
        //             'message' => 'Loyalty days exceed available days',
        //         ], 422);
        //     }

        //     $sub_total_amount = match ($action) {
        //         'listing' => $this->getAmount($action),
        //         'extend' => $this->getAmount($action),
        //         'tour' => $this->getAmount($action),
        //         'pinup' => getPinupFee(),
        //         'bumpUp' => getBumpupFee(),
        //         'upgrade' => $feeAmount,
        //         default => null,
        //     };

        //     $loyalty_amount = 0;

        //     if (session()->has('checkout')) {
        //         $checkout = session()->get('checkout');
        //         $lowestPlan = collect($checkout)->max('membership');
        //         $planFee = getPlanFee($lowestPlan);
        //         $loyalty_amount = ($planFee * $loyalty_day);
        //     }

        //     if (session()->has('tour_checkout')) {
        //         $checkout = session()->get('tour_checkout');
        //         $lowestPlan = collect($checkout)->max('membership');
        //         $planFee = getPlanFee($lowestPlan);
        //         $loyalty_amount = ($planFee * $loyalty_day);
        //     }

        //     $total_amount = ($sub_total_amount - $wallet_amount - $loyalty_amount);

        //     $this->pinService->setAmount($total_amount);
        //     $this->pinService->setWalletAmount($wallet_amount);

        //     $gstAmount = $this->pinService->getGSTAmount();
        //     $totalDueAmount = $this->pinService->getTotalDue();

        //     if ($total_amount < 0) {
        //         return response()->json([
        //             'status'  => false,
        //             'message' => 'Wallet amount and Loyalty discount exceed subtotal',
        //         ], 422);
        //     }

        //     $total_amount = max(0, $total_amount);

        //     $html = view('escort.dashboard.modal.order_summary_adjustment', compact('action', 'sub_total_amount', 'wallet_amount', 'loyalty_amount', 'total_amount', 'gstAmount', 'totalDueAmount'))->render();
        //     $benefit_token = encrypt(compact('action', 'loyalty_day', 'sub_total_amount', 'wallet_amount', 'loyalty_amount', 'total_amount'));
        //     return response()->json([
        //         'status'         => true,
        //         'lowest_plan' => $lowestPlan ?? 0,
        //         'total_amount' => $total_amount,
        //         'benefit_token' => $benefit_token,
        //         'message' => 'Applied successfully',
        //         'html' => $html,
        //     ]);
        // } catch (\Exception $e) {

        //     return response()->json([
        //         'status'  => false,
        //         'message' => 'Something went wrong' . '[' . $e->getMessage() . '] [' . $e->getLine() . ']',
        //         'error'   => $e->getMessage()
        //     ], 500);
        // }
    //}
        
        }
    

}
