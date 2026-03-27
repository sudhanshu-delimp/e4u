<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AdvertiserDiscount;
use Exception;

class FeeDiscountController extends Controller
{
    protected $user;
    protected $account;
    
    public function __construct(UserInterface $user)
    {
        $this->user = $user;

        $this->middleware(function ($request, $next) {
            $this->account = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.management.fee_discount.index');
    }

    public function getAdvertiserDetail(Request $request){
        try {
            // Validate request
            $request->validate([
                'keyword' => 'required'
            ]);

            $value = $request->keyword;

            // Fetch user by id OR member_id
            $user = User::with(['my_agent','state'])->where('id', $value)
                ->orWhere('member_id', $value)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Advertiser not found.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Advertiser found.',
                'data' => $user
            ]);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() 
            ], 500);
        }
    }

    public function applyFeeDiscount(Request $request){
        try {
            // Validate request
            $request->validate([
                'advertiser_id' => 'required',
                'discount' => 'required',
                'end_date' => 'required',
            ]);

            $nowLocal = Carbon::now();
            $localStart = $nowLocal->startOfDay();
            $localEnd   = Carbon::parse($request->end_date)->endOfDay();
            $utcStart = $localStart->copy()->setTimezone('UTC');
            // $utcEnd = $localEnd->copy()->setTimezone('UTC');

            // AdvertiserDiscount::create([
            //     'user_id' => auth()->user()->id,
            //     'escort_id' => $escortDetail->id,
            //     'start_date' => $localStart->format('Y-m-d'),
            //     'end_date' => $localEnd->format('Y-m-d'),
            //     'utc_start_time' => $utcStart,
            //     'utc_end_time' => $utcEnd,
            // ]);

            return response()->json([
                'status' => true,
                'message' => 'Advertiser found.'.$nowLocal.'|'.$localEnd,
                'data' => $nowLocal
            ]);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    
}
