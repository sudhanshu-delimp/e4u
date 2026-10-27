<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function __construct()
    {
    
    }

    public function getAdvertiser(Request $request)
    {
       try {
            $advertiser  = User::getAdvertiserrByMemberId($request->member_id);
            if ($advertiser === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Advertiser not found.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'advertiser' => $advertiser,
            ], 200);

        } catch (\Throwable $e) {
            report($e);
            return response()->json([
            'success' => false,
            'message' => app()->environment('local')
                ? $e->getMessage()
                : 'Something went wrong. Please try again.',
            ], 500);
        }
    }
}
