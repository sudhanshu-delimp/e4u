<?php

namespace App\Http\Controllers\Escort;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEscortRequest;

class EscortDashboardController extends Controller
{
    public function LogAndStatus(){
        $user = Auth::user();
        $state = config('escorts.profile.states')[$user->state_id]['stateName'] ?? '';
        $logAndStatus = $user->LoginStatus;
        $passwirdExpire = $user->account_setting;
       $passwordExpiryText = CheckExpireDate($passwirdExpire->password_expiry_days);
      
        
        return view('escort.dashboard.logs-and-status', compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire'));
    }

    public function updatePasswordDuration(UpdateEscortRequest $request)
    {   $user = Auth::user();
        $passwordExpiry = $request->input('password_expiry');
       
        if ($user->account_setting) {
            $user->account_setting->password_expiry_days = $passwordExpiry; 
            $user->account_setting->save();
        } else {
            // Optionally handle the case where passwordSecurity is missing
            return response()->json([
                'status' => false,
                'message' => 'Password security settings not found.',
            ], 404);
        }

        $passwordExpiryText = CheckExpireDate($passwordExpiry);
       // dd($passwordExpiryText);

        return response()->json([
            'status' => true,
            'passwordExp' => $passwordExpiry,
            'text' => $passwordExpiryText,
        ]);
    }

 
}


