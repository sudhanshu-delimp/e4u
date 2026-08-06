<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Communication;
use App\Models\Escort;
use App\Models\MyLegbox;
use App\Models\Purchase;
use Carbon\Carbon;
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


        public function sendNotification(Request $request)
        {
            $request->validate(
                [
                    'state_id' => 'required',
                ],
                [
                    'state_id.required' => 'Please select a Home state.',
                ]
            );

            $state_id = $request->state_id;

            $viewers = MyLegbox::with([
                'viewer_user:id,name,member_id,state_id,email,current_state_id',
                'viewer_user.state',
                'viewer_settings',
                'escort:id,name,profile_name,title,business_name,enabled'
            ])->select('user_id as viewer_user_id', 'escort_id as escort_profile_id')
            ->whereIn('escort_id', function ($query) {
                $query->select('id')
                    ->from('escorts')
                    ->where('enabled', 1)
                    ->where('user_id', auth()->id());
            })->get();

            if($viewers->isEmpty())
            {
                return response()->json([
                'status'  => false,
                'message'  => 'No Viewers Found...',
                ], 200);
            }


            $purchases = Purchase::whereIn('escort_id', function ($query)  use($state_id) {
                    $query->select('id')
                        ->from('escorts')
                        ->where('enabled', 1)
                        ->where('state_id',$state_id)
                        ->where('user_id', auth()->id());
                })
                ->whereBetween('start_date', [
                    Carbon::today(),
                    Carbon::today()->addDays(3),
                ])->get();
            
            if($purchases->isEmpty())
            {
                return response()->json([
                'status'  => false,
                'message'  => 'Notification could not be sent because no active profile was found...',
                ], 200);
            }

            

            echo '<pre>';
            print_r($purchases->toArray());
            exit;


            $viewers = $viewers->filter(function ($item) use ($request) {
                return optional($item->viewer_user)->state_id == $request->state_id;
            });


            // echo '<pre>';
            // print_r($viewers->toArray());
            // exit;

            foreach ($viewers as $viewer) 
            {
                $send_on_email = $viewer->viewer_settings ? $viewer->viewer_settings->advertiser_email : 0;
                $send_on_mobile = $viewer->viewer_settings ? $viewer->viewer_settings->advertiser_text : 0;

                Communication::create([
                    'state_id'       => $viewer->viewer_user->state_id,
                    'sender_id'      => auth()->id(),
                    'receiver_id'    => $viewer->viewer_user_id,
                    'sender_type'    => 'escort',
                    'send_on_email'  => $send_on_email,
                    'send_on_mobile' => $send_on_mobile,
                ]);

                // Email
                if ($send_on_email=='1') {
                    // Mail::to($viewer->viewer_user->email)->queue(new ViewerNotificationMail(...));
                }

                // SMS
                if ($send_on_mobile=='1') {
                }
            }

            return back()->with('success', 'Notification sent successfully.');
        }




}
