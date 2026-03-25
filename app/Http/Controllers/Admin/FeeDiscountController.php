<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use App\Models\User;
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
    
}
