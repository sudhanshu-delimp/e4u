<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\EscortViewerInteractions;
use App\Models\MyLegbox;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class EscortMyLegboxViewerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $escortIds = Escort::where('user_id', $user->id)->where('enabled', 1)->pluck('id');
        $legboxEscortUserIds = MyLegbox::whereIn('escort_id', $escortIds)->pluck('user_id')->unique();
        $viewers = User::whereIn('id',$legboxEscortUserIds)->get();

        return view('escort.dashboard.my-legbox-viewers', ['viewers' => $viewers]);
    }

    public function escortViewersAjaxList()
    {
        $user = Auth::user();
        $escortIds = Escort::where('user_id', $user->id)->where('enabled', 1)->pluck('id'); // fetch all escort profile
        $legboxEscortUserIds = MyLegbox::whereIn('escort_id', $escortIds)->select('user_id','escort_id'); 

        // Step 1: Get unique user records
        $users = User::whereIn('id', $legboxEscortUserIds->pluck('user_id'))->with(['interest'])->get()->keyBy('id');
        $escorts = Escort::whereIn('id', $legboxEscortUserIds->pluck('escort_id'))->get()->keyBy('id');

        // Step 2: Rebuild the full list, preserving duplicates
        $viewers = $legboxEscortUserIds->pluck('user_id')->map(function ($id) use ($users) {
            return $users->get($id);
        });

        //dd($legboxEscortUserIds->get()->toArray(), $viewers);

        $escorts = $legboxEscortUserIds->pluck('escort_id')->map(function ($id) use ($escorts) {
            return $escorts->get($id);
        });

        $newCollect = $viewers->values()->map(function ($viewer, $index) use ($escorts) {
            return (object)[
                'viewer' => $viewer,
                'escort' => $escorts[$index] ?? null,
            ];
        });

        return DataTables::of($newCollect)
            ->addColumn('viewer_id', fn($row) => $row->viewer->member_id)
            ->addColumn('home_state', function($row) {
                $stateId = $row->viewer->state_id;
                return config("escorts.profile.states.$stateId.stateName") ?? '-';
            })
            ->addColumn('escort_profile', fn($row) => $row->escort->id ?? '-')
            ->addColumn('notification_enabled', function($row){

                $isNotifcationEnabled = 'No';
                # Check viewer account notification setting first
                if($row->viewer->interest && $row->viewer->interest->features){
                    $viewerNotification = json_decode($row->viewer->interest->features);
                    $isNotifcationEnabled = in_array('alerts',$viewerNotification); 
                    $isNotifcationEnabled = $isNotifcationEnabled ? 'Yes' : 'No';
                }

                # If particular escort is notification disabled
                $esvi = EscortViewerInteractions::where('escort_id',$row->escort->id)->where('viewer_id',$row->viewer->id)->where('user_id',Auth::user()->id)->first();

                if($esvi){
                    $isNotifcationEnabled = 'No';
                    if($esvi->viewer_disabled_notification == 0){
                        $isNotifcationEnabled = 'Yes';
                    }
                }

                return  $isNotifcationEnabled; 
                
            })
            ->addColumn('contact_enabled', function($row){

                $contact_enabled = 'Yes';

                # Check viewer account setting first
                if($row->viewer->interest && $row->viewer->interest->features){
                    $viewerNotification = json_decode($row->viewer->interest->features);
                    $isNotifcationEnabled = in_array('alerts', $viewerNotification); 

                    if($isNotifcationEnabled && $row->viewer->interest->notifications){
                        $viewerNotificationIsEnabled = json_decode($row->viewer->interest->notifications);
                        if(in_array('email',$viewerNotificationIsEnabled) || in_array('text', $viewerNotificationIsEnabled)){
                            $contact_enabled = 'Yes';
                        }

                        $contact_enabled = 'No';
                    }
                }

                # If particular escort is contact disabled
                $esvi = EscortViewerInteractions::where('escort_id',$row->escort->id)->where('viewer_id',$row->viewer->id)->where('user_id',Auth::user()->id)->first();

                if($esvi){
                    $contact_enabled = 'No';
                    if($esvi->viewer_disabled_contact == 0){
                        $contact_enabled = 'Yes';
                    }
                }

                return  $contact_enabled; 
                
            })
            ->addColumn('contact_method', function($row){

                # If particular escort is contact disabled then no contact info will be show to escort
                $esvi = EscortViewerInteractions::where('escort_id',$row->escort->id)->where('viewer_id',$row->viewer->id)->where('user_id',Auth::user()->id)->first();

                if($esvi){
                    if($esvi->viewer_blocked_escort == 1){
                        $contact_method = 'blocked';
                        return $contact_method;
                    }
                }

                $contactMethod = '-';

                if($row->viewer->interest && $row->viewer->interest->features){
                    $viewerNotification = json_decode($row->viewer->interest->features);
                    $isNotifcationEnabled = in_array('alerts', $viewerNotification); 

                    if($isNotifcationEnabled && $row->viewer->interest->notifications){
                        $viewerNotificationIsEnabled = json_decode($row->viewer->interest->notifications);
                        if(in_array('email', $viewerNotificationIsEnabled) && in_array('text', $viewerNotificationIsEnabled)){
                            $contactMethod =  'Email, Text';
                        }

                        if(in_array('email', $viewerNotificationIsEnabled)){
                            $contactMethod =  'Email';
                        }

                        if(in_array('text', $viewerNotificationIsEnabled)){
                            $contactMethod = 'Text';
                        }
                    }
                }

                if($esvi){
                    if($esvi->viewer_disabled_contact == 1){
                        $contactMethod = 'Disabled';
                    }
                }

                return  $contactMethod; 
                
            })
            ->addColumn('viewer_comm', function($row) use (&$contactMethod){

                # If particular escort is contact disabled then no contact info will be show to escort
                $esvi = EscortViewerInteractions::where('escort_id',$row->escort->id)->where('viewer_id',$row->viewer->id)->where('user_id',Auth::user()->id)->first();

                if($esvi){
                    if($esvi->viewer_blocked_escort == 1){
                        $viewer_comm = 'blocked';
                        return $viewer_comm;
                    }
                }

                $viewer_comm = '-';
                if($row->viewer->interest && $row->viewer->interest->features){
                    $viewerNotification = json_decode($row->viewer->interest->features);
                    $isNotifcationEnabled = in_array('alerts', $viewerNotification); 

                    if($isNotifcationEnabled && $row->viewer->interest->notifications){
                        $viewerNotificationIsEnabled = json_decode($row->viewer->interest->notifications);
                        if(in_array('email', $viewerNotificationIsEnabled) && in_array('text', $viewerNotificationIsEnabled)){
                            $contactMethod = $row->viewer->email.', '.$row->viewer->phone;
                            $viewer_comm = $contactMethod;
                        }

                        if(in_array('email', $viewerNotificationIsEnabled)){
                            $contactMethod = $row->viewer->email;
                            $viewer_comm = $contactMethod;
                        }

                        if(in_array('text', $viewerNotificationIsEnabled)){
                            $contactMethod = $row->viewer->phone;
                           $viewer_comm = $contactMethod;
                        }
                    }
                }

                if($esvi){
                    if($esvi->viewer_disabled_contact == 1){
                        $viewer_comm = 'Disabled';
                    }
                }

                return  $viewer_comm; 
                
            })
            ->addColumn('playbox_subscription', fn($row) => 'Not Available')
            ->addColumn('block_viewer', function($row) {

                $isChecked = '';

                $esvi = EscortViewerInteractions::where('escort_id',$row->escort->id)->where('viewer_id',$row->viewer->id)->where('user_id',Auth::user()->id)->first('escort_blocked_viewer');
                if($esvi && $esvi->escort_blocked_viewer){
                    $isChecked = 'checked';
                }
                

                $isBlocked = '<div class="custom-control custom-switch">
                                        <input type="checkbox" '.$isChecked.' class="custom-control-input isBlockedButton" id="customSwitch'.$row->viewer->id.$row->escort->id.'" data-id="'.$row->viewer->id.'" data-escort-id="'.$row->escort->id.'">
                                        <label class="custom-control-label" for="customSwitch'.$row->viewer->id.$row->escort->id.'"></label>
                                    </div>';

                return $isBlocked;

            })
            ->addColumn('action', function($row) {

                $conClass = '-slash';
                $conText = 'Disable';
                $conCurrentText = 'Enable';
                $notClass = '-slash';
                $notText = 'Disable';
                $notCurrentText = 'Enable';

                $esvi = EscortViewerInteractions::where('escort_id',$row->escort->id)->where('viewer_id',$row->viewer->id)->where('user_id',Auth::user()->id)->first();

                if($esvi && $esvi->escort_disabled_contact){
                    $conClass = '';
                    $conText = 'Enable';
                    $conCurrentText = 'disable';
                }

                if($esvi && $esvi->escort_disabled_notification){
                    $notClass = '';
                    $notText = 'Enable';
                    $notCurrentText = 'disable';
                }

                $actionButtons = '<div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item align-item-custom toggle-contact" data-escort-id="'.$row->escort->id.'" href="#" title="Click to '.Str::lower($conText).' contact" 
                                            data-id="'.$row->viewer->id.'" data-status="'.Str::lower($conCurrentText).'"> 
                                            <i class="fa fa-phone'.$conClass.' me-1"></i> <span>'.$conText.' Contact</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item align-item-custom toggle-notification" data-escort-id="'.$row->escort->id.'" href="#" title="Click to '.Str::lower($notText).' notification"
                                            data-id="'.$row->viewer->id.'" data-status="'.Str::lower($notCurrentText).'"> 
                                            <i class="fa fa-bell'.$notClass.' me-1" aria-hidden="true"></i> <span>'.$notText.' Notifications</span>
                                        </a>
                                    </div>
                                </div>';
                
                return $actionButtons;
            })
            ->rawColumns(['action','block_viewer']) // if you're returning HTML
            ->make(true);
    }

    public function dashboard($type = 'dashbaord')
    {
        $user_type = null;
        if (auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }

        $escorts =  collect();
        if ($user_type) {
            $myLegbboxIds = MyLegbox::where('user_id', auth()->user()->id)->pluck('escort_id');
            $escorts = Escort::whereIn('id', $myLegbboxIds)->with([
                'city',
                'state',
                'likes',
                'user',
                'suspendProfile' => function ($query) {
                    $today = Carbon::now(config('app.timezone'));
                    $query->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today)
                        ->where('status', true);
                }
            ])->where('enabled', 1)->get(); // city_id 
        }
        
        return view('user.dashboard.my-legbox',['escorts'=>$escorts, 'dashboardType'=>$type]);
    }
}
