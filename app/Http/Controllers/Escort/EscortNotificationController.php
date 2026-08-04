<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\MyLegbox;
use Illuminate\Http\Request;

class EscortNotificationController extends Controller
{
        public function get_all_viewers(Request $request)
        {

            $configStates = config('escorts.profile.states');
            $result = [];

            foreach ($configStates as $stateId => $state) {
                $result[$stateId] = [
                    'state_id'      => $stateId,
                    'state'         => $state['stateAbbr'],
                    'viewers'       => 0,
                    'notifications' => 0, 
                ];
            }

            $records = MyLegbox::with(['viewer_user:id,name,member_id,state_id,email,current_state_id','viewer_user.state'])->select('user_id as viewer_user_id', 'escort_id as escort_profile_id')
            ->whereIn('escort_id', function ($query) {
                $query->select('id')
                    ->from('escorts')
                    ->where('enabled', 1)
                    ->where('user_id', auth()->user()->id);
            })->get();

            foreach ($records as $record) {
                $stateId = $record->viewer_user->state_id ?? null;

                if (isset($result[$stateId])) {
                    $result[$stateId]['viewers']++;
                }
            }

            $viewers = array_values($result);

            $myStateList = array_values(array_filter($result, function ($item) {
                return $item['viewers'] > 0;
            }));

            // echo '<pre>';
            // print_r($myStateList);
            // exit;

             $myStateList = array_values(array_filter($result, function ($item) {
                return $item['viewers'] > 0;
            }));
            return view('escort.dashboard.Communication.send-notifications',compact('viewers','myStateList'));

        }
}
