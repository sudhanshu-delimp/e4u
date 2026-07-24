<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEscortRequest;
use App\Models\Escort;
use App\Models\LoginAttempt;
use App\Models\MyLegbox;

class EscortDashboardController extends Controller
{
    public function LogAndStatus(){
        $user = Auth::user();
        $state = config('escorts.profile.states')[$user->state_id]['stateName'] ?? '';
        $logAndStatus = $user->LoginStatus;
       
        $getLastLoginTime = getUserWiseLastLoginTime($user);
        $passwirdExpire = $user->account_setting;
        $passwordExpiryText = CheckExpireDate($passwirdExpire->password_expiry_days);

        $authStateId = $user->current_state_id ?? $user->state_id;
        $escortIds = Escort::where('user_id', $user->id)
            ->where('enabled', 1)
            ->pluck('id');
        $legboxEscortUserIds = MyLegbox::whereIn('escort_id', $escortIds)
            ->pluck('user_id')
            ->unique();

    $result = LoginAttempt::join('users', 'login_attempts.user_id', '=', 'users.id')
        ->whereIn('users.id', $legboxEscortUserIds)
        ->where('login_attempts.type', 1)
        ->where('login_attempts.online', 'yes')
        ->selectRaw("
            COUNT(DISTINCT CASE WHEN users.state_id = ? THEN users.id END) AS same_state_count,
            COUNT(DISTINCT CASE WHEN users.state_id != ? THEN users.id END) AS outside_state_count
        ", [$authStateId, $authStateId])
        ->first();

        return view('escort.dashboard.logs-and-status', compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire', 'getLastLoginTime','result','user'));
    }


    public function updatePasswordDuration(UpdateEscortRequest $request)
    {   $user = Auth::user();
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


