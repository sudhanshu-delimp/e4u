<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\AppController;
use App\Models\Escort;
use App\Models\PinUps;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PinUpsController extends AppController
{


    function create() {
        $escorts = Escort::where('user_id', '!=', auth()->user()->id)->where('profile_name', '!=', NULL)->get();

        return view('escort.dashboard.registerPinup.register-pin-up', compact('escorts'));
    }


    function checkout(Request $request) {
//        $escort_id = $request->escort_id;

        $checkoutData = $request->data;
        $escorts = Escort::where('user_id', '!=', auth()->user()->id)->where('profile_name', '!=', NULL)->get();
        $pricing = Pricing::where('membership_id', 6)->first();

        $reservedWeeks = $this->_getReservedPinupDates();
        $removedPinups = [];
        foreach ($checkoutData as $idx => $pinup) {
            if(in_array($pinup['week_start'], $reservedWeeks)) {
                $removedPinups[] = $pinup;
                unset($checkoutData[$idx]);
            }
        }

        //save here in session to retrieve later
        session()->put('pinUpCheckout', $checkoutData);


        return view('escort.dashboard.registerPinup.checkout', compact('checkoutData', 'escorts', 'pricing'));
    }

    //TODO::remove payment gateway not finalized hence we using this as payment testing
    function test_payment(Request $request) {
        $cart = session()->get('pinUpCheckout');
        $price = Pricing::where('membership_id', 6)->first()->price;
//        $total_fee = $request->post('total_fee');

        $pinUps = [];
        foreach ($cart as $product) {
            $product['user_id'] = auth()->user()->id;
            $product['week_start'] = date('Y-m-d', strtotime($product['week_start']));
            $product['payment_amount'] = $price;
            $product['payment_date'] = date('Y-m-d H:i:s');
            $product['payment_status'] = 'Success';
            $pinUps[] = $product;
        }
        PinUps::insert($pinUps);

        return redirect()->route('escort.dashboard.pinUpList')->with('info', 'Pin-up registered successfully');
    }

    function profile_and_week_data(Request $request) {
        $stateId = $request->input('stateId');
        $type = $request->input('type');
        $escortId = $request->input('escortId');

        if($type == 'profileList') {
            $profiles = Escort::where('state_id', $stateId)->where('user_id', '!=', auth()->user()->id)->where('profile_name', '!=', NULL)->get();
            $profiles = $profiles->pluck('NameWithProfileName', 'id');
            return response()->json($profiles);
        } elseif($type == 'weekList') {
            $reservedWeeks = $this->_getReservedPinupDates($stateId);
            return response()->json($reservedWeeks);
        }
    }

    function list($type) {
        $pinups = PinUps::select(['id', 'state_id', 'user_id', 'escort_id', 'week_start', 'payment_amount'])
            /*->with(['purchase' => function ($query) use ($type) {
                if($type == 'past') {
                    $query->where('start_date', '<=', date('Y-m-d'));
                } else {
                    $query->where('start_date', '>', date('Y-m-d'));
                }
                $query->orderBy('start_date', 'ASC');
            }])
            ->whereHas('purchase')*/
            ->where('user_id', auth()->user()->id)
            ->where('payment_status', 'Success')
            ->orderBy('week_start', 'ASC');
        if($type == 'past') {
            $pinups->where('week_start', '<', date('Y-m-d'));
        } else {
            $pinups->where('week_start', '>=', date('Y-m-d'));
        }
        $pinups = $pinups->get()->toArray();


        return view('escort.dashboard.registerPinup.list', compact('type', 'pinups'));
    }



    private function _getReservedPinupDates($stateId = NULL) {
        $reservedWeeks = PinUps::where('payment_status', 'Success')
            ->whereBetween('week_start', [date('Y-m-d'), date('Y-m-d', strtotime('+6 months'))]);
        if($stateId) {
            $reservedWeeks->where('state_id', $stateId);
        }

        return $reservedWeeks->pluck('week_start')->toArray();
    }
}
