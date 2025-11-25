<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEscortRequest;

class AgentDashboardController extends Controller
{
    public function LogsAndStatus(){
        $user = Auth::user();
        $state = config('escorts.profile.states')[$user->state_id]['stateName'] ?? '';
        $logAndStatus = $user->LoginStatus;
        $passwirdExpire = $user->account_setting;
        $passwordExpiryText = CheckExpireDate($passwirdExpire->password_expiry_days);
    
        return view('agent.dashboard.logs-and-status', compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire')); 
    }

    public function updatePasswordDuration(UpdateEscortRequest $request)
    {   
        $user = Auth::user();
        $passwordExpiry = $request->input('password_expiry');
       
        if ($user->account_setting) {
            $user->account_setting->password_expiry_days = $passwordExpiry; 
            $user->account_setting->save();
        } else {
            
          return  error_response('Password security settings not found.', 422);
        }

        $passwordExpiryText = CheckExpireDate($passwordExpiry);

       return Success_response(['passwordExp' => $passwordExpiry, 'text' => $passwordExpiryText], 'Password duration updated successfully', 200);

    }
}
