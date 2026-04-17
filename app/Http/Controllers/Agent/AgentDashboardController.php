<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateEscortRequest;

class AgentDashboardController extends Controller
{
    public function LogsAndStatus()
    {
        $user = Auth::user();
        $state = config('escorts.profile.states')[$user->state_id]['stateName'] ?? '';
        $logAndStatus = $user->LoginStatus;
        $passwirdExpire = $user->account_setting;
        $getLastLoginTime = getUserWiseLastLoginTime($user);
        $passwordExpiryText = CheckExpireDate($passwirdExpire->password_expiry_days);
        //Get Advertisers Online count
        $currentState = $user->state_id;


        $baseQuery = User::where('users.assigned_agent_id', auth()->user()->id)
            ->join('login_attempts', 'login_attempts.user_id', '=', 'users.id')
            ->where('login_attempts.online', 'yes')
            ->whereIn('users.type', ['3', '4']);

        // Same location: current_state_id is null (never updated = still in home state)
        // OR current_state_id matches state_id
        $sameStateCount = (clone $baseQuery)
            ->where(function ($query) {
                $query->whereNull('users.current_state_id')
                    ->orWhereColumn('users.current_state_id', '=', 'users.state_id');
            })
            ->distinct('users.email')
            ->count('users.email');

        // Outside location: current_state_id is set AND different from state_id
        $outsideStateCount = (clone $baseQuery)
            ->whereNotNull('users.current_state_id')
            ->whereColumn('users.current_state_id', '!=', 'users.state_id')
            ->distinct('users.email')
            ->count('users.email');



        return view('agent.dashboard.logs-and-status', compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire', 'sameStateCount', 'outsideStateCount', 'getLastLoginTime'));
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
