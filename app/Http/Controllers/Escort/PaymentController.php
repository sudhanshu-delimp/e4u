<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Escort\EscortInterface;
use App\Models\Purchase;
use App\Services\WalletService;
use App\Services\PinPaymentService;
use Carbon\Carbon;

class PaymentController extends Controller
{
    protected $walletService;
    protected $pinService;
    protected $user;
    public function __construct(WalletService $walletService, PinPaymentService $pinService, EscortInterface $escort)
    {
        $this->escort = $escort;
        $this->walletService = $walletService;
        $this->pinService = $pinService;
        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }
    
    protected function getAmount(){
        $amount = 0.00;
        if(session()->has('checkout')){
            $checkout = session()->get('checkout');
            foreach ($checkout as $startDate => $item) {
                $daysDiff = Carbon::parse($item['end_date'])->diffInDays(Carbon::parse($item['start_date']))+1;
                list($total_discount, $total_rate, $normalRate, $discountRate, $appiedDiscountAmount) = calculateTotalFee($item['membership'], $daysDiff, $this->account);
                $amount = $amount+$total_rate;
            }
        }
        return $amount;
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'pin_token' => 'required'
        ]);

        $amount = $this->getAmount();
        $result = $this->pinService->charge($request->pin_token, $amount, $this->account->email);

        if ($result['status']) {
            if(session()->has('checkout')){
                $this->saveCheckout();
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Payment completed successfully',
                'gateway' => $result['data']
            ]);
        }

        return response()->json([
            'status' => 'error',
            'gateway' => $result['error']
        ], 400);
    }

    public function saveCheckout(){
        if(session()->has('checkout')){
            $checkout = session()->get('checkout');
            foreach ($checkout as $startDate => $item) {
                $escortDetail = getEscortDetail($item['escort_id']);
                $start_date = Carbon::createFromFormat('d-m-Y', $item['start_date'])->format('Y-m-d').' 00:00:00';
                $end_date = Carbon::createFromFormat('d-m-Y', $item['end_date'])->format('Y-m-d').' 23:59:59';
                
                $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");
    
                $localStartDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$start_date", $profileTimezone);
                $utcSartTime = $localStartDateTime->copy()->setTimezone('UTC');
    
                $localEndDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$end_date", $profileTimezone);
                $utcEndTime = $localEndDateTime->copy()->setTimezone('UTC');
    
                $item['utc_start_time'] = $utcSartTime;
                $item['utc_end_time'] = $utcEndTime; 
                $daysDiff = Carbon::parse($item['end_date'])->diffInDays(Carbon::parse($item['start_date']))+1;
                list($total_discount, $total_rate, $normalRate, $discountRate, $appiedDiscountAmount) = calculateTotalFee($item['membership'], $daysDiff, $this->account);
                $item['rate'] = $normalRate; 
                $item['discount_rate'] = $discountRate; 
                $item['total_rate'] = $normalRate*$daysDiff; 
                $item['paid_rate'] = $total_rate;
                $purchaseDetail = Purchase::create($item);
    
                if($this->account->activeFeeDiscount){
                    $this->account->activeFeeDiscount()->increment('spend_amount', $appiedDiscountAmount);
                }
    
                if ($item['utc_start_time'] <= Carbon::now('UTC') && $item['utc_end_time'] >= Carbon::now('UTC')) {
                    $escortDetail->start_date = $item['start_date'];
                    $escortDetail->end_date = $item['end_date'];
                    $escortDetail->utc_start_time = $utcSartTime;
                    $escortDetail->utc_end_time = $utcEndTime;
                    $escortDetail->membership = $item['membership'];
                    $escortDetail->enabled = 1;
                    $escortDetail->purchase_id = $purchaseDetail->id;
                    $escortDetail->save();
    
                    $purchaseDetail->status = 'listed';
                    $purchaseDetail->save();
                }
            }
        }
    }

}
