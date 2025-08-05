<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\AppController;
use App\Http\Requests\Escort\StorePinupRequest;
use App\Models\Escort;
use App\Models\PinUps;
use App\Models\Pricing;
use App\Models\EscortPinup;
use App\Models\EscortMedia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

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
    
    
    public function pinup_available_weeks(Escort $escort){
        try{
            $start = Carbon::parse($escort->start_date)->startOfWeek(Carbon::MONDAY);
            $end = Carbon::parse($escort->end_date)->endOfWeek(Carbon::SUNDAY);
            $weeks = collect();
            $candidateStarts = [];
            $today = Carbon::now();
            while ($start->lte($end)) {
                $weekStart = $start->copy();
                $weekEnd = $start->copy()->endOfWeek(Carbon::SUNDAY);
        
                // Only include if full week is within profile listing range
            
                if ($weekStart->gte(Carbon::parse($escort->start_date)->startOfDay()) && $weekEnd->lte(Carbon::parse($escort->end_date)->endOfDay()) && $weekEnd->gte($today->startOfDay())) {
                    $weeks->push([
                        'start' => $weekStart->toDateString(),
                        'end' => $weekEnd->toDateString()
                    ]);
                    $candidateStarts[] = $weekStart->toDateString();
                }
        
                $start->addWeek();
            }
            if (empty($candidateStarts)) {
                return response()->json([
                    'success' => false,
                    'weeks' => $weeks,
                    'message' => 'Sorry, no weeks are available during your selected profile dates.',
                ]);
            }
            
            // Fetch week starts already booked for THIS location (state_id + city_id)
            $bookedStarts = EscortPinup::query()
            ->where('state_id', $escort->state_id)
            ->where('city_id',  $escort->city_id)
            ->whereIn('start_date', $candidateStarts)   
            ->pluck('start_date')                       
            ->map(fn ($d) => Carbon::parse($d)->toDateString())
            ->all();
            $available = $weeks->reject(fn ($w) => in_array($w['start'], $bookedStarts));
            return response()->json([
                'success' => true,
                'weeks' => $available->values(),
                'message' => 'Found available weeks.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function register(StorePinupRequest $request){
        try{
            $data = $request->validated();
            $escortId = $data['pinup_profile_id'];
            $escortDetail = getEscortDetail($escortId);
            $profileTimezone = config("escorts.profile.states.$escortDetail->state_id.cities.$escortDetail->city_id.timeZone");
            [$startDate, $endDate] = explode('|', $data['pinup_week']);
            $localStart = Carbon::createFromFormat('Y-m-d', $startDate, $profileTimezone)->startOfDay();
            $localEnd = Carbon::createFromFormat('Y-m-d', $endDate, $profileTimezone)->endOfDay();
            $utcStart = $localStart->copy()->setTimezone('UTC');
            $utcEnd = $localEnd->copy()->setTimezone('UTC');
            EscortPinup::create([
                'user_id' => auth()->user()->id,
                'escort_id' => $escortDetail->id,
                'state_id' => $escortDetail->state_id,
                'city_id' => $escortDetail->city_id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'utc_start_time' => $utcStart,
                'utc_end_time' => $utcEnd,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pinup slot booked successfully!'
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while booking the Pinup.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPinupProfile(Request $request){
        try{
            $response = [];
            $response['success'] = false;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $view = $request->view?$request->view:null;
            $location = getRealTimeGeolocationOfUsers($latitude, $longitude);
            $response['location'] = $location;
            $pinupDetail = EscortPinup::latestActiveForCity($location['city']);
            if($pinupDetail){
                $profile_image = EscortMedia::where(['user_id'=>$pinupDetail->user_id,'position'=>10,'default'=>1])->orderBy('id', 'DESC')->first();
                $response['success'] = true;
                $escort = $pinupDetail->escort;
                $user = $escort->user;
                $response['escort'] = $pinupDetail->escort;
                $response['user'] = $escort->user;
                $response['profile_image'] = $profile_image;
                switch($view){
                    case 'pinup_summary':{
                        $response['html'] = view('partials.web.pinup_summary',compact('escort','user','profile_image'))->render();
                    } break;
                    case 'pinup_home':{
                        $response['html'] = view('partials.web.pinup_home',compact('profile_image'))->render();
                    } break;
                }
            }
            return response()->json($response);
        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
        return response()->json($pinupDetail);
    }

    public function pinupSummary(Escort $escort){
        try {
            $response = [];
            $response['success'] = true;
            $response['html'] = view('escort.dashboard.profile.modal.include.pinup_summary_content',compact('escort'))->render();
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
