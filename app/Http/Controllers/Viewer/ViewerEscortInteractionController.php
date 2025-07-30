<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\EscortViewerInteractions;
use App\Models\MyLegbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;

class ViewerEscortInteractionController extends Controller
{
    public function viewerUpdateEscortInteraction(Request $request)
    {
        $escort = Escort::where('id',$request->escort_id)->first();
        $userid = $escort->user_id;

        $isExistAction = EscortViewerInteractions::where('escort_id',$request->escort_id)->where('user_id',$userid )->where('viewer_id',Auth::user()->id)->first();

        if($isExistAction){

            $viewer_disabled_contact = $isExistAction->viewer_disabled_contact;
            $viewer_disabled_notification = $isExistAction->viewer_disabled_notification;
            $is_blocked = $isExistAction->viewer_blocked_escort ?? false;
            $viewer_rate_escort = $isExistAction->viewer_rate_escort ?? 'no_rated';

            if(isset($request->viewer_disabled_contact)){
                $viewer_disabled_contact = false;
                if($request->viewer_disabled_contact == 'disable'){
                    $viewer_disabled_contact = true;
                }
            }

            if(isset($request->viewer_disabled_notification)){
                $viewer_disabled_notification = false;
                if($request->viewer_disabled_notification == 'disable'){
                    $viewer_disabled_notification = true;
                }
                
            }

            if(isset($request->is_blocked)){
                if($request->is_blocked == true){
                    $is_blocked = true;
                }

                if($request->is_blocked == false){
                    $is_blocked = false;
                }
            }

            if(isset($request->type) && $request->type == 'rate'){
                $viewer_rate_escort = $request->escort_rating;
            }

            $result  = EscortViewerInteractions::where('escort_id',$request->escort_id)
            ->where('user_id',$userid )
            ->where('viewer_id',Auth::user()->id)
            ->update([
                'viewer_disabled_contact' => $viewer_disabled_contact,
                'viewer_disabled_notification' => $viewer_disabled_notification ,
                'viewer_blocked_escort' => $is_blocked,
                'viewer_rate_escort' => $viewer_rate_escort,
            ]);

        }else{

            $escortrate = 'no_rated';
            if(isset($request->type) && $request->type == 'rate'){
                $escortrate = $request->escort_rating;
            }

            $result  = EscortViewerInteractions::create([
                'user_id' => $userid,
                'escort_id' => $request->escort_id,
                'viewer_id' => Auth::user()->id,
                'action_by' => 'viewer',
                'viewer_disabled_contact' => isset($request->viewer_disabled_contact) && $request->viewer_disabled_contact == 'enable' ? true : false ,
                'viewer_disabled_notification' => isset($request->viewer_disabled_notification) && $request->viewer_disabled_notification == 'disable' ? true : false ,
                'viewer_blocked_escort' => isset($request->is_blocked) && $request->is_blocked ? true : false ,
                'viewer_rate_escort' => $escortrate,
            ]);
        }

        $data = array(
            "status"     => 200,
            "message"    => $request->message,
            "type"    => $request->type,
            "data" => $result,
            "previous_status" => $request->current_status,
        );

        return response()->json($data);

    }

    public function viewerRemoveEscortFromLegbox(Request $request)
    {
        $result = false;
        if(Auth::user()){
            $result = MyLegbox::where('escort_id', $request->escort_id)->where('user_id',Auth::user()->id)->delete();
            $escort = Escort::where('id',$request->escort_id)->first();
            $result = EscortViewerInteractions::where('escort_id', $request->escort_id)->where('user_id',$escort->user_id)->where('viewer_id',Auth::user()->id)->delete();
        }
        
        $data = array(
            "status"     => $result ? 200 : 404,
            "message"    => $result ? $request->message : 'Escort not exist!',
            "type"    => $request->type,
            "data" => $result,
            "previous_status" => '',
        );

        return response()->json($data);

    }

    public function dashboardEscortListAjax(Request $request)
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
                'myLegBox',
                'escortViewerInteraction',
                'suspendProfile' => function ($query) {
                    $today = Carbon::now(config('app.timezone'));
                    $query->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today)
                        ->where('status', true);
                }
            ])->get(); // city_id

            // dd($escorts->toArray());

             return DataTables::of($escorts)
                ->addColumn('escort_id', function ($escort) {
                    return $escort->id;
                })
                ->addColumn('location', function($escort){
                    $state = City::where('state_id',$escort->state_id)->first();
                    $stateCode = $state->state_code ?? '-';
                    return $stateCode;
                })
                ->addColumn('name', function($escort){ 
                    $suspendedBadge = isset($escort->suspendProfile[0]->created_at);
                    $suspendedText = $suspendedBadge
                        ? '<sup title="Suspended on ' . \Carbon\Carbon::parse($escort->suspendProfile[0]->created_at)->format('d-m-Y h:i A') . '" class="brb_icon" style="background-color: #d2730a;">SUS</sup>'
                        : '';
                    return $escort->name ?? '-' . ' ' . $suspendedText;
                    
                 })
                ->addColumn('gender', fn($escort) => Str::substr($escort->gender, 0, 1))

                ->addColumn('rating_label', function ($row) {

                    $rate = 'no_rated';
                    if($row->escortViewerInteraction && $row->escortViewerInteraction->viewer_rate_escort){
                        $rate = $row->escortViewerInteraction->viewer_rate_escort;
                    }

                    switch ($rate) {
                        case 'verygood':
                            $rateText = 'Very Good';
                            break;
                        case 'great':
                            $rateText = 'Great';
                            break;
                        case 'good':
                            $rateText = 'Good';
                            break;
                        
                        default:
                            $rateText = 'Not Rated';
                            break;
                    }

                    return $rateText;
                })

                ->addColumn('is_notification_enabled', function ($escort) {

                    $isEnabledNotificationByEscort = EscortViewerInteractions::where('user_id',$escort->user_id)->where('escort_id',$escort->id)->where('viewer_id',Auth::user()->id)->first();

                    if($isEnabledNotificationByEscort != null){
                        $status = $isEnabledNotificationByEscort->escort_disabled_notification == 0 ? 'Yes' : 'No';
                    }else{
                        $status = 'Yes';
                    }
                    
                    return $status;

                    // if($escort->user->notification_features && in_array('viewer_notification', $escort->user->notification_features)){
                    //     $isEnabledNotificationByEscort = 'Yes';
                    // }else{
                    //     $isEnabledNotificationByEscort = 'No';
                    // }
                    // // return isset($escort->myLegBox->is_notification_enabled) && $escort->myLegBox->is_notification_enabled ? 'Yes' : 'No';
                    // return $isEnabledNotificationByEscort;
                })
                ->addColumn('is_enabled_contact', function ($escort){
                    $escortViewerInteractions = EscortViewerInteractions::where('user_id',$escort->user_id)->where('escort_id',$escort->id)->where('viewer_id',Auth::user()->id)->first();

                    if($escortViewerInteractions != null){
                        $status = $escortViewerInteractions && $escortViewerInteractions->escort_disabled_contact == 0 ? 'Yes' : 'No';
                    }else{
                        $status = 'Yes';
                    }
                    
                    return $status;
                })
                // ->addColumn('is_notification_enabled', fn($escort) => $escort->is_notification_enabled ? 'Yes' : 'No')
                // ->addColumn('is_enabled_contact', fn($escort) => $escort->is_enabled_contact ? 'Yes' : 'No')

                ->addColumn('contact_method', function ($escort) {

                    $escortViewerInteractions = EscortViewerInteractions::where('user_id',$escort->user_id)->where('escort_id',$escort->id)->where('viewer_id',Auth::user()->id)->first();

                     # If escort blocked viewer
                    if($escortViewerInteractions && $escortViewerInteractions->escort_blocked_viewer){
                        return 'Blocked';
                    }

                    # if escort disabled contact setting for this viewer
                    if($escortViewerInteractions != null && $escortViewerInteractions->escort_disabled_contact == 1){
                        return 'Disabled';
                    }

                    $methods = [];
                    if($escort->contact != null){
                        $methods = [];
                        # get value from escort setting
                        switch ($escort->contact) {
                            case 1:
                                $methods[] = 'Email';
                                break;
                            case 2:
                                $methods[] = 'Text';
                                break;
                            case 4:
                                $methods[] = 'Call';
                                break;
                            case 5:
                                $methods[] = 'Call, Text';
                                break;
                                
                        }
                    }else{
                        # get value from member settings
                        $userSettingMethods = [];
                        $types = $escort->user->contact_type ?? [];
                        if (in_array(3, $types)) $userSettingMethods[] = 'Email';
                        if (in_array(4, $types)) $userSettingMethods[] = 'Call';
                        if (in_array(2, $types) || empty($userSettingMethods)) $userSettingMethods[] = 'Text';
                        return implode(', ', $userSettingMethods);
                    }
                    return implode(', ', $methods);
                })

                ->addColumn('escort_communication', function ($escort) {

                    $escortViewerInteractions = EscortViewerInteractions::where('user_id',$escort->user_id)->where('escort_id',$escort->id)->where('viewer_id',Auth::user()->id)->first();

                    # If escort blocked viewer
                    if($escortViewerInteractions && $escortViewerInteractions->escort_blocked_viewer){
                        return 'Blocked';
                    }

                    # if escort disabled contact setting for this viewer
                    if($escortViewerInteractions != null && $escortViewerInteractions->escort_disabled_contact == 1){
                        return 'Disabled';
                    }

                    $methods = [];
                    if($escort->contact != null){
                        $methods = [];
                        # get value from escort setting
                        switch ($escort->contact) {
                            case 1:
                                # if Email
                                $methods[] = $escort->user->email;
                                break;
                            case 2:
                                # if Text
                                $methods[] = $escort->phone;
                                break;
                            case 4:
                                # if call
                                $methods[] = $escort->phone;
                                break;
                            case 5:
                                # if call, Text
                                $methods[] = $escort->phone;
                                break;
                        }
                    
                    }else{
                        # get value from member settings
                        $contactType = $escort->user->contact_type ?? [];
                        $output = '-';
                        if (in_array(3, $contactType)) $output = $escort->user->email;
                        if (in_array(4, $contactType)) $output = $escort->phone ;
                        if (in_array(2, $contactType)) $output = $escort->phone;
                        if (empty($contactType)) $output = '-';
                        return $output;
                    }
                    return $methods;
                })

                ->addColumn('is_blocked', function ($escort) {
                    
                    # If escort blocked viewer
                    $escortViewerInteractions = EscortViewerInteractions::where('user_id',$escort->user_id)->where('escort_id',$escort->id)->where('viewer_id',Auth::user()->id)->first();

                    if($escortViewerInteractions){
                        $isChecked = $escortViewerInteractions->viewer_blocked_escort ? 'checked' : '';
                    }else{
                        $isChecked = '';
                    }

                    $isBlocked = '<div class="custom-control custom-switch">
                                        <input type="checkbox" '.$isChecked.' class="custom-control-input isBlockedButton" id="customSwitch'.$escort->id.'">
                                        <label class="custom-control-label" for="customSwitch'.$escort->id.'"></label>
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
                    $rate = 'no_rated';

                    # If escort blocked viewer
                    $escortViewerInteractions = EscortViewerInteractions::where('user_id',$row->user_id)->where('escort_id',$row->id)->where('viewer_id',Auth::user()->id)->first();

                    if($escortViewerInteractions && $escortViewerInteractions->viewer_disabled_contact == 1){
                        $conClass = '';
                        $conText = 'Enable';
                        $conCurrentText = 'disable';
                    }
                    
                    if($escortViewerInteractions && $escortViewerInteractions->viewer_disabled_notification == 1){
                        $notClass = '';
                        $notText = 'Enable';
                        $notCurrentText = 'disable';
                        
                    }

                    if($escortViewerInteractions && $escortViewerInteractions->viewer_rate_escort){
                        $rate = $escortViewerInteractions->viewer_rate_escort;
                    }

                    $iconFontColor = '';
                    switch ($rate) {
                        case 'verygood':
                            // $iconFontColor = 'text-primary';
                            break;
                        case 'great':
                            // $iconFontColor = 'text-success';
                            break;
                        case 'good':
                            // $iconFontColor = 'text-danger';
                            break;
                        
                        default:
                            // $iconFontColor = 'text-dark';
                            break;
                    }

                    # if escort disabled contact setting for this viewer
                    if($escortViewerInteractions != null && $escortViewerInteractions->escort_blocked_viewer == 1){
                        $viewButton = '<a class="dropdown-item align-item-custom text-muted" href="#"
                                                    data-toggle="modal" > <i
                                                        class="fa fa-eye-slash text-muted" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text ">Access denied: This escort has blocked you.</span>';
                    }else{
                        $viewButton = '<a class="dropdown-item align-item-custom escortProfileView"  href="#"
                                                    data-toggle="modal" data-escort-name="'.$row->name.'" data-profile-enable="'.$row->enabled.'" data-id="'.$row->id.'"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text">View the Escort’s Profile</span>';
                    }

                    $actionButtons = '
                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom toggle-contact" href="#" title="Click to '.Str::lower($conText).' contact" 
                                                data-id="'.$row->id.'" data-status="'.Str::lower($conCurrentText).'"> 
                                                <i class="fa fa-phone'.$conClass.' me-1"></i> <span>'.$conText.' Contact</span>
                                                </a>
                                                <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom toggle-notification" href="#" title="Click to '.Str::lower($notText).' notification"
                                                data-id="'.$row->id.'" data-status="'.Str::lower($notCurrentText).'"> 
                                                <i class="fa fa-bell'.$notClass.' me-1" aria-hidden="true"></i> <span>'.$notText.' Notifications</span>
                                                <span class="tooltip-text">Viewer will not get notifications from this
                                                    escort</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom escortRating" data-escort-name="'.$row->name.'" data-rate="'.$rate.'" data-id="'.$row->id.'" href="#" title=""> <i
                                                        class="fa fa-star '.$iconFontColor.'" aria-hidden="true"></i>
                                                    Rate</a>
                                                <span class="tooltip-text">Rate this Escort</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom escortProfileRemove" href="#"
                                                    data-toggle="modal" data-escort-name="'.$row->name.'" data-id="'.$row->id.'"> <i
                                                        class="fa fa-trash" aria-hidden="true"></i>
                                                    Remove</a>
                                                <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                '.$viewButton.'
                                            </div>
                                        </div>

                                    </div>
                    ';

                    return $actionButtons;
                })

                ->rawColumns(['escort_id', 'escort_communication', 'is_blocked', 'action'])
                ->make(true);
        }

        return view('user.dashboard.my-legbox', ['escorts' => $escorts]);
    }
}
