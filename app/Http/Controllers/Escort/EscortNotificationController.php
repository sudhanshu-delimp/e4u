<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Jobs\SendViewerNotificationJob;
use App\Models\Communication;
use App\Models\Escort;
use App\Models\MyLegbox;
use App\Models\Purchase;
use App\Sms\SendSms;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

            return view(
                'escort.dashboard.Communication.send-notifications',
                compact('myStateList')
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
                        ->where('enabled', 1)
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
                        'message' => 'Notification could not be sent because no active profile was found.',
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

                    foreach ($viewers as $viewer) {

                        $send_on_email = optional($viewer->viewer_settings)->escort_email ?? 0;
                        $send_on_mobile = optional($viewer->viewer_settings)->escort_text ?? 0;

                        Communication::create([
                            'profile_listing_id' => $profile_listing_id,
                            'state_id'           => $viewer->viewer_user->state_id,
                            'sender_id'          => auth()->id(),
                            'receiver_id'        => $viewer->viewer_user_id,
                            'sender_type'        => 'escort',
                            'send_on_email'      => $send_on_email,
                            'send_on_mobile'     => $send_on_mobile,
                        ]);

                        ############## Send Email ##################
                        if ($send_on_email == '1') 
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
                         }

                        ############## Send SMS ##################
                        if ($send_on_mobile == '1' && ($viewer->viewer_user->phone && $viewer->viewer_user->phone!="")) {
                             $msg = "Your favorite Escort ".$name." will arrive in your Location on the ".$start_date.". Here is a link to their Profile ".$profile_url.". Regards E4U.";
                             $output = $sendotp->send_otp_sms(removeSpaceFromString($viewer->viewer_user->phone),$msg);
                        }
                    }
                }

                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Notifications sent successfully.',
                ], 200);

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
