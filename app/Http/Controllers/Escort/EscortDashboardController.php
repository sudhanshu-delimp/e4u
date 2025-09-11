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
        $passwirdExpire = $user->passwordSecurity;
       $passwordExpiryText = CheckExpireDate($passwirdExpire->password_expiry_days);
      
        
        return view('escort.dashboard.logs-and-status', compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire'));
    }

    public function updatePasswordDuration(UpdateEscortRequest $request)
    {   $user = Auth::user();
        $passwordExpiry = $request->input('password_expiry');

        // Normalize 'never' to 0 for consistency
        $expiryDays = ($passwordExpiry === 'never') ? 0 : (int) $passwordExpiry;

        $passwordSecurity = $user->passwordSecurity;
        if ($passwordSecurity) {
            $passwordSecurity->update([
                'password_expiry_days' => $expiryDays,
                'password_updated_at' => now(),
            ]);
        } else {
            // Optionally handle the case where passwordSecurity is missing
            return response()->json([
                'status' => false,
                'message' => 'Password security settings not found.',
            ], 404);
        }

        $passwordExpiryText = CheckExpireDate($expiryDays);

        return response()->json([
            'status' => true,
            'passwordExp' => $expiryDays,
            'text' => $passwordExpiryText,
        ]);
    }

 
}


