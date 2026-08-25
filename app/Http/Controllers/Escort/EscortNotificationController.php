<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Jobs\SendViewerNotificationJob;
use App\Models\Communication;
use App\Models\Escort;
use App\Models\EscortViewerInteractions;
use App\Models\MyLegbox;
use App\Models\Purchase;
use App\Models\User;
use App\Sms\SendSms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class EscortNotificationController extends Controller
{
        public function get_all_viewers(Request $request)
        {
            $result = $this->getViewerStateData();
            $myStateList = $result->filter(function ($item) {
                return $item['viewers'] > 0;
            })->values();

            $user = Auth::user();
            $escortIds = Escort::where('user_id', $user->id)->where('default_setting', 0)->pluck('id');
            $legboxEscortUserIds = MyLegbox::whereIn('escort_id', $escortIds)->pluck('user_id')->unique();
            $viewers = User::whereIn('id', $legboxEscortUserIds)->get();

            return view(
                'escort.dashboard.Communication.send-notifications',
                compact('myStateList','viewers')
            );

        }

        private function getViewerStateData()
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

            $escortIds = Escort::where('default_setting', 0)
            ->where('user_id', auth()->id())
            ->pluck('id');

            

            $records = MyLegbox::with([
                    'viewer_user:id,name,member_id,state_id,email,current_state_id',
                    'viewer_user.state'
                ])
                ->select('user_id as viewer_user_id', 'escort_id as escort_profile_id')
                ->whereIn('escort_id', $escortIds)->get();

            foreach ($records as $record) {
                $stateId = $record->viewer_user->state_id ?? null;

                if (isset($result[$stateId])) {
                    $result[$stateId]['viewers']++;
                }
            }

            $notificationCounts = Communication::selectRaw('state_id, COUNT(*) as total')
            ->where('sender_id', auth()->id()) 
            ->groupBy('state_id')
            ->pluck('total', 'state_id');

            foreach ($notificationCounts as $stateId => $count) {
                if (isset($result[$stateId])) {
                    $result[$stateId]['notifications'] = $count;
                }
            }


            return collect(array_values($result));
            }


        public function get_all_viewers_ajax(Request $request)
        {
             $viewers = $this->getViewerStateData();
             return DataTables::of($viewers)->make(true);
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

            try 
            {
                $stateName = config('escorts.profile.states')[$request->state_id]['stateName'];
                $sendotp = new SendSms();
                DB::beginTransaction();
                $state_id = $request->state_id;
                $viewers = MyLegbox::with([
                    'viewer_user:id,name,member_id,state_id,email,current_state_id,phone',
                    'viewer_user.state',
                    'viewer_settings',
                    'escort:id,name,profile_name,title,business_name,enabled'
                ])
                ->select('user_id as viewer_user_id', 'escort_id as escort_profile_id')
                ->whereIn('escort_id', function ($query) {
                    $query->select('id')
                        ->from('escorts')
                        ->where('default_setting', 0)
                        ->where('user_id', auth()->id());
                })
                ->get();

                if ($viewers->isEmpty()) {
                    DB::rollBack();
                    return response()->json([
                        'status'  => false,
                        'message' => 'No viewers found.',
                    ], 200);
                }


                $user_count = [];
                $notificationCount = 0;
                $purchases = Purchase::with('escort:id,name,profile_name,title,business_name,city_id')
                    ->whereIn('escort_id', function ($query) use ($state_id) {
                        $query->select('id')
                            ->from('escorts')
                            ->where('enabled', 1)
                            ->where('state_id', $state_id)
                            ->where('user_id', auth()->id());
                    })
                    ->whereDate('start_date', '<=', Carbon::today()->addDays(3))
                    ->get();

                if ($purchases->isEmpty()) {
                    DB::rollBack();
                    return response()->json([
                        'status'  => false,
                        'message' => 'Notification could not be sent because no active Profile was found.',
                    ], 200);
                }

                $viewers = $viewers->filter(function ($item) use ($request) {
                    return optional($item->viewer_user)->state_id == $request->state_id;
                });

                foreach ($purchases as $purchase) 
                {

                    $profile_url = route('profile.description', [$purchase->escort->id, $purchase->escort->city_id]) . '?list';
                    $profileLink = '<a href="'.$profile_url.'">'.$profile_url.'<a/>';
                    $name = $purchase->escort->name ?? '';
                    $start_date = $purchase->start_date ?? '';
                    $end_date = $purchase->end_date ?? '';
                    $profile_listing_id = $purchase->id;
                    //$viewer_comm = false;

                    foreach ($viewers as $viewer) {
                        $viewer_blocked  = false;
                        $send_on_email = optional($viewer->viewer_settings)->advertiser_email ?? '0';
                        $send_on_mobile = optional($viewer->viewer_settings)->advertiser_text ?? '0';

                        $esvi = EscortViewerInteractions::where('escort_id', $purchase->escort->id)
                                                            ->where('viewer_id', $viewer->id)
                                                            ->where('user_id', Auth::user()->id)
                                                            ->first();
                        

                        if ($esvi) {
                            if (
                                $esvi->escort_blocked_viewer == 1 ||
                                $esvi->viewer_blocked_escort == 1 ||
                                $esvi->viewer_disabled_contact == 1 ||
                                $esvi->escort_disabled_contact == 1 ||
                                $esvi->escort_disabled_notification == 1
                            ) {
                                $viewer_blocked = true;
                            }
                        }                              

                        $notificationSent = false;
                       

                        ############## Send Email ##################
                        if ($send_on_email == '1' && !$viewer_blocked) 
                        {
                            SendViewerNotificationJob::dispatch(
                                $viewer->viewer_user->email,
                                [
                                    'name' => $name,
                                    'viewer_name' => $viewer->viewer_user->name,
                                    'profile_url' => $profileLink,
                                    'start_date' => $start_date,
                                    'end_date' => $end_date,
                                    'member_id' => $viewer->viewer_user->member_id
                                ]
                            );

                            $notificationSent = true;
                            $user_count [$viewer->viewer_user_id] = $viewer->viewer_user_id;

                         }

                        ############## Send SMS ##################
                        if (!$viewer_blocked && $send_on_mobile == '1' && ($viewer->viewer_user->phone && $viewer->viewer_user->phone!="")) {
                             $msg = "Your favorite Escort ".$name." will arrive in your Location on the ".$start_date.". Here is a link to their Profile ".$profile_url.". Regards E4U.";
                             $output = $sendotp->send_otp_sms(removeSpaceFromString($viewer->viewer_user->phone),$msg);
                             $notificationSent = true;
                        }

                        if ($notificationSent) 
                        {

                            Communication::create([
                                'profile_listing_id' => $profile_listing_id,
                                'state_id'           => $viewer->viewer_user->state_id,
                                'sender_id'          => auth()->id(),
                                'receiver_id'        => $viewer->viewer_user_id,
                                'sender_type'        => 'escort',
                                'send_on_email'      => (string) $send_on_email,
                                'send_on_mobile'     => (string) $send_on_mobile,
                            ]);


                            $notificationCount++;
                            $user_count [$viewer->viewer_user_id] = $viewer->viewer_user_id;
                        }
                    }
                }

                DB::commit();

                if($notificationCount==0)
                {
                    return response()->json([
                    'status'  => true,
                    'message' => "No notifications were sent to viewers in ".$stateName."  because notifications or contact have been disabled",
                    ], 200);

                }

                if($notificationCount>0)
                {
                    $updated_user_count = array_values($user_count);
                    return response()->json([
                        'status'  => true,
                        'message' => "{$notificationCount} notification(s) have been sent successfully to " . count($updated_user_count) . " viewer(s).",
                    ], 200);
                }

                
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Send Notification Error', [
                    'message' => $e->getMessage(),
                    'line'    => $e->getLine(),
                    'file'    => $e->getFile(),
                ]);
                return response()->json([
                    'status'  => false,
                    'message' => 'Failed to send notifications.',
                ], 200);
            }
        }
}
