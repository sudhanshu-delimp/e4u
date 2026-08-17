<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\EscortViewerInteractions;
use App\Models\MassageProfile;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

 

class EscortMyLegboxViewerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $escortIds = Escort::where('user_id', $user->id)->where('default_setting', 0)->pluck('id');
        $legboxEscortUserIds = MyLegbox::whereIn('escort_id', $escortIds)->pluck('user_id')->unique();
        $viewers = User::whereIn('id', $legboxEscortUserIds)->get();

        return view('escort.dashboard.my-legbox-viewers', ['viewers' => $viewers]);
    }

    function getMyLegbox($userId, $escortId)
    {
        return MyLegbox::where('user_id', $userId)
            ->where('escort_id', $escortId)
            ->first();
    }

    public function escortViewersAjaxList()
    {
        $user = Auth::user();
        $escortIds = Escort::where('user_id', $user->id)->where('default_setting', 0)->pluck('id'); // fetch all escort profile
        $legboxEscortUserIds = MyLegbox::whereIn('escort_id', $escortIds)->select('user_id', 'escort_id');
       
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

            $escort = $escorts[$index] ?? null;

                $legbox = $this->getMyLegbox(
                    $viewer->id,
                    $escort->id ?? null
                );

            return (object)[


                'viewer' => $viewer,
                'escort' => $escort,
                'legbox' => $legbox,
                
                
            ];
        });

        return DataTables::of($newCollect)

        
            ->addColumn('tagged_date', fn($row) => $row->legbox->created_at? \Carbon\Carbon::parse($row->legbox->created_at)->format('d-m-Y'): '-')    
            ->addColumn('viewer_name', fn($row) => $row->viewer->name)
            ->addColumn('viewer_id', fn($row) => $row->viewer->member_id)
            ->addColumn('home_state', function ($row) {
                $stateId = $row->viewer->state_id;
                return config("escorts.profile.states.$stateId.stateAbbr") ?? '-';
            })
            ->addColumn('escort_profile', fn($row) => $row->escort->id ?? '-')
            ->addColumn('notification_enabled', function ($row) {

                $isNotifcationEnabled = 'No';
                
                # Check viewer account notification setting first
                if ($row->viewer->interest && $row->viewer->interest->features) {
                    $viewerNotification = json_decode($row->viewer->interest->features);
                    $isNotifcationEnabled = in_array('alerts', $viewerNotification);
                    $isNotifcationEnabled = $isNotifcationEnabled ? 'Yes' : 'No';
                }

                # If particular escort is notification disabled
                $esvi = EscortViewerInteractions::where('escort_id', $row->escort->id)->where('viewer_id', $row->viewer->id)->where('user_id', Auth::user()->id)->first();

                if ($esvi) {
                    $isNotifcationEnabled = 'No';
                    if ($esvi->viewer_disabled_notification == 0) {
                        $isNotifcationEnabled = 'Yes';
                    }
                }

                return  $isNotifcationEnabled;
            })
            ->addColumn('contact_enabled', function ($row)  {

                    $contact_enabled = 'No';
                    
                    
                    # If particular escort is contact disabled
                    $esvi = EscortViewerInteractions::where('escort_id', $row->escort->id)->where('viewer_id', $row->viewer->id)->where('user_id', Auth::user()->id)->first();
                    if ($esvi) 
                    {
                        if ($esvi->viewer_disabled_contact == 0) 
                        $contact_enabled = 'Yes';
                       
                        
                    }


                    # Check viewer account setting first
                    if ($row->viewer->viewer_settings) 
                    {
                        if($row->viewer->viewer_settings->advertiser_email && $row->viewer->viewer_settings->advertiser_emai=='1')
                        {
                             $contact_enabled = 'Yes';
                             $viewer_contact_type[] = 'Email';
                        }
                       
                        if($row->viewer->viewer_settings->advertiser_text && $row->viewer->viewer_settings->advertiser_text=='1')
                        {
                             $contact_enabled = 'Yes';
                             $viewer_contact__type[] = 'Text';
                        }
                       
                    }

                    return  $contact_enabled;
            })
            ->addColumn('contact_method', function ($row) {

                $contact_method = "";
                $viewer_contact_type = [];

                # If particular escort is contact disabled then no contact info will be show to escort
                $esvi = EscortViewerInteractions::where('escort_id', $row->escort->id)->where('viewer_id', $row->viewer->id)->where('user_id', Auth::user()->id)->first();

                if ($esvi) {
                    if ($esvi->viewer_blocked_escort == 1) {
                        $contact_method = 'blocked';
                    }
                }

                if ($esvi) {
                    if ($esvi->viewer_disabled_contact == 1) {
                        $contact_method = 'Disabled';
                    }
                }


                if ($row->viewer->viewer_settings) 
                {
                    if($row->viewer->viewer_settings->advertiser_email && $row->viewer->viewer_settings->advertiser_email=='1')
                    $viewer_contact_type[] = 'Email';
                   
                    if($row->viewer->viewer_settings->advertiser_text && $row->viewer->viewer_settings->advertiser_text=='1')
                    $viewer_contact_type[] = 'Text';
                }

                if($contact_method=="")
                {
                   $contact_method = !empty($viewer_contact_type)? implode(', ', $viewer_contact_type): '-';

                }

                return  $contact_method;
            })
            ->addColumn('viewer_comm', function ($row) {


                $viewer_comm = "";
                $viewer_contact_type = [];

                 if($row->viewer->viewer_settings && $row->viewer->viewer_settings->advertiser_email && $row->viewer->viewer_settings->advertiser_email=='1')
                $viewer_contact_type[] = 'Email';
                
                if($row->viewer->viewer_settings && $row->viewer->viewer_settings->advertiser_text && $row->viewer->viewer_settings->advertiser_text=='1')
                $viewer_contact_type[] = 'Text';

                # If particular escort is contact disabled then no contact info will be show to escort
                $esvi = EscortViewerInteractions::where('escort_id', $row->escort->id)->where('viewer_id', $row->viewer->id)->where('user_id', Auth::user()->id)->first();

                if ($esvi) {
                    if ($esvi->viewer_blocked_escort == 1) {
                        $viewer_comm = 'blocked';
                        return $viewer_comm;
                    }
                }

                if ($esvi) {
                    if ($esvi->viewer_disabled_contact == 1) {
                        $viewer_comm = 'Disabled';
                    }
                }

                if($viewer_comm=="")
                {
                    $contact = []; 
                    if (in_array('Email', $viewer_contact_type)) 
                    $contact[] = $row->viewer->email;

                    if (in_array('Text', $viewer_contact_type)) 
                    $contact[] = $row->viewer->phone;
                    
                    $viewer_comm = !empty($contact)? implode(', ', $contact): '-';


                }

                return  $viewer_comm;
            })
            ->addColumn('playbox_subscription', fn($row) => 'Not Available')
            ->addColumn('block_viewer', function ($row) {

                $isChecked = '';

                $esvi = EscortViewerInteractions::where('escort_id', $row->escort->id)->where('viewer_id', $row->viewer->id)->where('user_id', Auth::user()->id)->first('escort_blocked_viewer');
                if ($esvi && $esvi->escort_blocked_viewer) {
                    $isChecked = 'checked';
                }


                $isBlocked = '<div class="custom-control custom-switch">
                                        <input type="checkbox" ' . $isChecked . ' class="custom-control-input isBlockedButton" id="customSwitch' . $row->viewer->id . $row->escort->id . '" data-id="' . $row->viewer->id . '" data-escort-id="' . $row->escort->id . '">
                                        <label class="custom-control-label" for="customSwitch' . $row->viewer->id . $row->escort->id . '"></label>
                                    </div>';

                return $isBlocked;
            })
            ->addColumn('action', function ($row) {

                $conClass = '-slash';
                $conText = 'Disable';
                $conCurrentText = 'Enable';
                $notClass = '-slash';
                $notText = 'Disable';
                $notCurrentText = 'Enable';

                $esvi = EscortViewerInteractions::where('escort_id', $row->escort->id)->where('viewer_id', $row->viewer->id)->where('user_id', Auth::user()->id)->first();

                if ($esvi && $esvi->escort_disabled_contact) {
                    $conClass = '';
                    $conText = 'Enable';
                    $conCurrentText = 'disable';
                }

                if ($esvi && $esvi->escort_disabled_notification) {
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
                                        <a class="dropdown-item align-item-custom toggle-contact" data-escort-id="' . $row->escort->id . '" href="#" title="Click to ' . Str::lower($conText) . ' contact" 
                                            data-id="' . $row->viewer->id . '" data-status="' . Str::lower($conCurrentText) . '"> 
                                            <i class="fa fa-phone' . $conClass . ' me-1"></i> <span>' . $conText . ' Viewer</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item align-item-custom toggle-notification" data-escort-id="' . $row->escort->id . '" href="#" title="Click to ' . Str::lower($notText) . ' notification"
                                            data-id="' . $row->viewer->id . '" data-status="' . Str::lower($notCurrentText) . '"> 
                                            <i class="fa fa-bell' . $notClass . ' me-1" aria-hidden="true"></i> <span>' . $notText . ' Notifications</span>
                                        </a>
                                    </div>
                                </div>';

                return $actionButtons;
            })
            ->rawColumns(['action', 'block_viewer']) // if you're returning HTML
            ->make(true);
    }

    public function dashboard($type = 'escort')
    {
        $user_type = null;
        if (auth()->user() && auth()->user()->type == 0) {
            $user_type = auth()->user();
        }

        $escorts =  collect();
        if ($user_type) {
            if ($type == "escort") {
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
                
            } else {
                $myLegbboxIds = MyMassageLegbox::where('user_id', auth()->user()->id)->pluck('massage_id');
                $escorts = MassageProfile::whereIn('id', $myLegbboxIds)->with([
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
                ])->get(); // ->where('enabled', 1)
            }
        }

        return view('user.dashboard.my-legbox', ['escorts' => $escorts, 'dashboardType' => $type]);
    }
}
