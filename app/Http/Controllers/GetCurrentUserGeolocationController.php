<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetCurrentUserGeolocationController extends Controller
{
    public function getRealTimeGeo(Request $request)
    {
        $lat = $request->input('data.lat');
        $lng = $request->input('data.lng');

        // Call helper function
        $result = getRealTimeGeolocationOfUsers($lat, $lng);
        //$result = getRealTimeGeolocationOfUsers('28.7041', '77.1025'); //delhi
        # update current user location in users table
        if(Auth::user()){
            $user = Auth::user();
            $profiles = $user->listedEscorts->where('state_id','!=',$result['state']);
            if($profiles->count() > 0){
                foreach($profiles as $profile){
                    $profile->playmates()->detach();
                    $profile->addedBy()->detach();
                }
            }
            # if current state exist then update otheriwse update with state_id
            if(isset($result['state'])){
                User::where('id', $user->id)->update([
                    'current_state_id' => $result['state'],
                ]);
            }else{
                User::where('id', $user->id)->update([
                    'current_state_id' => $user->state_id,
                ]);
            }
            
        }   

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}
