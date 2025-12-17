<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Playmate\PlaymateInterface;

class GetCurrentUserGeolocationController extends Controller
{
    protected $playmate;

    public function __construct(PlaymateInterface $playmate)
    {
        $this->playmate = $playmate;
    }

    public function getRealTimeGeo(Request $request)
    {
        $lat = $request->input('data.lat');
        $lng = $request->input('data.lng');

        // Call helper function
        if(config('app.env')=='local'){
            $coordinates = explode(',',config('escorts.current_location'));
            $result = getRealTimeGeolocationOfUsers($coordinates[0], $coordinates[1]);
        }
        else{
            $result = getRealTimeGeolocationOfUsers($lat, $lng);
        }
        # update current user location in users table
        if(Auth::user()){
            $user = Auth::user();
            $profiles = $user->listedEscorts()
            ->where('state_id', '!=', $result['state'])
            ->with(['playmates:id', 'addedBy:id'])
            ->get();
            if($profiles->count() > 0){
                foreach($profiles as $profile){
                    foreach ($profile->playmates as $playmate) {
                        $this->playmate->trashPlaymateHistory($profile->id,$playmate->id);
                    }
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


    public function getCurrentState(Request $request)
    {
        $lat = $request->input('data.lat');
        $lng = $request->input('data.lng');
        $result = getRealTimeGeolocationOfUsers($lat, $lng);
       if(isset($result['state']))
       {
            return response()->json([
                'status' => true,
                'data' => $result
            ]);
       }
       else
       {
            return response()->json([
                'status' => false,
                'data' => []
            ]);
       }


        
    }

}
