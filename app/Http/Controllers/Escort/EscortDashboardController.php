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
       // dd($passwirdExpire->password_expiry_days);
       $passwordExpiryText = $this->CheckExpireDate($passwirdExpire->password_expiry_days);
      
        
        return view('escort.dashboard.logs-and-status', compact('logAndStatus', 'passwordExpiryText', 'state', 'passwirdExpire'));
    }

    public function updatePasswordDuration(UpdateEscortRequest $request)
    {
        $user = Auth::user();
        $error = true;
        $passExpire = $request->password_expiry;

        if($passExpire  ==  'never'){
            $passExpire = 0;
        }

        $user->passwordSecurity->password_expiry_days = $passExpire;
        $user->passwordSecurity->password_updated_at = Carbon::now();
        $user->passwordSecurity->save();

        // get Expiry date 
        $passwordExpiryText = $this->CheckExpireDate($passExpire);

        return response()->json(['error' => true, 'passwordExp' => $passExpire, 'text' => $passwordExpiryText]);
    }

    protected function CheckExpireDate($date) {
        $map = [
            0 => 'Never',
            30 => 'Renew every 30 days',
            60 => 'Renew every 60 days',
            90 => 'Renew every 90 days',
        ];

        return $map[$date] ?? null;
    }
}


