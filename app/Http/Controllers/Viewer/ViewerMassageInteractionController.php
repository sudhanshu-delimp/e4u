<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\MassageAvailability;
use App\Models\MassageProfile;
use App\Models\MassageViewerInteractions;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;
use MassageViewerInteractions as GlobalMassageViewerInteractions;

class ViewerMassageInteractionController extends Controller
{
    public function viewerUpdateMassageInteraction(Request $request)
    {
        //dd($request->all());
        $massageCenter = MassageProfile::where('id',$request->massage_id)->first();
        $userid = $massageCenter->user_id;

        $isExistAction = MassageViewerInteractions::where('massage_id',$request->massage_id)->where('user_id',$userid )->where('viewer_id',Auth::user()->id)->first();

        if($isExistAction){

            $viewer_disabled_contact = $isExistAction->viewer_disabled_contact;
            $viewer_disabled_notification = $isExistAction->viewer_disabled_notification;
            $is_blocked = $isExistAction->viewer_blocked_massage ?? false;
            $viewer_rate_massage = $isExistAction->viewer_rate_massage ?? 'no_rated';

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
                $viewer_rate_massage = $request->massage_rating;
            }

            $result  = MassageViewerInteractions::where('massage_id',$request->massage_id)
            ->where('user_id',$userid )
            ->where('viewer_id',Auth::user()->id)
            ->update([
                'viewer_disabled_contact' => $viewer_disabled_contact,
                'viewer_disabled_notification' => $viewer_disabled_notification ,
                'viewer_blocked_massage' => $is_blocked,
                'viewer_rate_massage' => $viewer_rate_massage,
            ]);

        }else{

            $massagerate = 'no_rated';
            if(isset($request->type) && $request->type == 'rate'){
                $massagerate = $request->massage_rating;
            }

            $result  = MassageViewerInteractions::create([
                'user_id' => $userid,
                'massage_id' => $request->massage_id,
                'viewer_id' => Auth::user()->id,
                'action_by' => 'viewer',
                'viewer_disabled_contact' => isset($request->viewer_disabled_contact) && $request->viewer_disabled_contact == 'enable' ? true : false ,
                'viewer_disabled_notification' => isset($request->viewer_disabled_notification) && $request->viewer_disabled_notification == 'disable' ? true : false ,
                'viewer_blocked_massage' => isset($request->is_blocked) && $request->is_blocked ? true : false ,
                'viewer_rate_massage' => $massagerate,
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

    public function viewerRemoveMassageFromLegbox(Request $request)
    {
        //dd($request->all());

        $result = false;
        if(Auth::user()){

            $massageProfile = MassageProfile::where('id',$request->massage_id)->first();
            //dd($massageProfile);
            $result1 = MyMassageLegbox::where('massage_id', $request->massage_id)->where('user_id',Auth::user()->id)->delete();
            $result = MassageViewerInteractions::where('massage_id', $request->massage_id)->where('user_id',$massageProfile->user_id)->where('viewer_id', Auth::user()->id)->delete();
            
            if($result1 || $result){
                $result = true;
            }
        }
        
        $data = array(
            "status"     => $result ? 200 : 404,
            "message"    => $result ? $request->message : 'Massage center not exist!',
            "type"    => $request->type,
            "data" => $result,
        );

        return response()->json($data);

    }

    public function dashboardMassageListAjax(Request $request)
    {
        if (auth()->user()) {
            $myMassageLegbboxIds = MyMassageLegbox::where('user_id', auth()->user()->id)->pluck('massage_id');

            $massageCenters = MassageProfile::whereIn('id',$myMassageLegbboxIds)->where('enabled',1)->with(['city','state','user','messageViewerInteraction']);

             return DataTables::of($massageCenters)
                ->filter(function ($query) use ($request) {
                        $search = $request->input('search.value'); // null-safe
                        if (!empty($search)) {
                            $query->where(function ($q) use ($search) {
                                // search by massage_id
                                $q->orWhere('id', 'like', "%{$search}%");

                                // search by business_name (massage profile name)
                                $q->orWhere('name', 'like', "%{$search}%");
                            });
                        }
                })
                ->addColumn('massage_id', function ($row) {
                    return $row->user->member_id;
                })
                ->addColumn('location', function($row){
                    $state = City::where('state_id',$row->state_id)->first();
                    $stateCode = $state->state_code ?? '-';
                    return $stateCode;
                })
                ->addColumn('business_name', function($row){  
                    return Str::title($row->name);
                 })
                ->addColumn('open_now', function($row){  

                    # get viewer location with timezone
                    $user = Auth::user();
                    if(!$user){
                        return 'No';
                    }

                    # Get massage center state & tiemzone # get massage profile opeing and closing times
                    $massageCenterStateId = $row->state_id;
                    $massageTimezone = config("escorts.profile.states.$massageCenterStateId.timeZone");
                    $massageTime = Carbon::now()->copy()->setTimezone($massageTimezone);

                    $day = strtolower($massageTime->format('l')); // massage_availability

                    $massageOpenCloseTiming = MassageAvailability::where('massage_profile_id',$row->id)->select($day.'_from',$day.'_to')->first();

                    if($massageOpenCloseTiming){
                        $massageOpenCloseTiming = $massageOpenCloseTiming->toArray();
                        $openTime = $massageOpenCloseTiming[$day."_from"];
                        $closeTime = $massageOpenCloseTiming[$day."_to"];

                        if ($openTime && $closeTime) {
                            // Convert to Carbon with timezone
                            $open = Carbon::createFromFormat('H:i:s', $openTime, $massageTimezone);
                            $close = Carbon::createFromFormat('H:i:s', $closeTime, $massageTimezone);
                            
                            // Check if current time is between open & close
                            if ($massageTime->between($open, $close)) {
                                // return 'Yes -' . $close. ' - '.$massageTime;
                                return 'Yes';
                            }
                        }
                    }
                    return 'No';
                 })

                ->addColumn('rating_label', function ($row) {

                    //dd($row)
                    $rate = 'no_rated';
                    if($row->messageViewerInteraction && $row->messageViewerInteraction->viewer_rate_massage){
                        $rate = $row->messageViewerInteraction->viewer_rate_massage;
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
                ->addColumn('is_enabled_contact', function ($row){
                    return ($row->messageViewerInteraction && $row->messageViewerInteraction->massage_disabled_contact == 1) ? 'Disabled' : 'Enabled';
                })
                ->addColumn('contact_method', function ($row) {

                    if($row->messageViewerInteraction && ($row->messageViewerInteraction->massage_disabled_contact || $row->messageViewerInteraction->massage_blocked_viewer)){
                        return $row->messageViewerInteraction->massage_blocked_viewer ? 'Blocked':'Disabled';
                    }
                    if($row->user ){
                        $viewer = User::where('id',$row->user->id)->first();
                        if($viewer->contact_type && (in_array(3, $viewer->contact_type) || in_array('3', $viewer->contact_type))){
                            return 'Email';
                        }
                        return "Text";
                    }
                    return '-';
                })

                ->addColumn('massage_communication', function ($row) {
                    if($row->messageViewerInteraction && ($row->messageViewerInteraction->massage_disabled_contact || $row->messageViewerInteraction->massage_blocked_viewer)){
                        return $row->messageViewerInteraction->massage_blocked_viewer ? 'Blocked':'Disabled';
                    }

                    if($row->user->contact_type ){
                        if(in_array(3, $row->user->contact_type) || in_array('3', $row->user->contact_type)){
                            return $row->user->email;
                        }
                    }
                    return $row->phone;
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
                    $massageViewerInteractions = MassageViewerInteractions::where('user_id',$row->user_id)->where('massage_id',$row->id)->where('viewer_id',Auth::user()->id)->first();

                    if($massageViewerInteractions && $massageViewerInteractions->viewer_disabled_contact == 1){
                        $conClass = '';
                        $conText = 'Enable';
                        $conCurrentText = 'disable';
                    }
                    
                    if($massageViewerInteractions && $massageViewerInteractions->viewer_disabled_notification == 1){
                        $notClass = '';
                        $notText = 'Enable';
                        $notCurrentText = 'disable';
                        
                    }

                    # if massage blocked viewer
                    if($massageViewerInteractions != null && $massageViewerInteractions->massage_blocked_viewer == 1){
                        $viewButton = '<a class="dropdown-item align-item-custom text-muted" href="#"
                                                    data-toggle="modal" > <i
                                                        class="fa fa-eye-slash text-muted" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text ">Access denied: This massage center has blocked you.</span>';
                    }else{
                        $viewButton = '<a class="dropdown-item align-item-custom massageProfileView"  href="#"
                                                    data-toggle="modal" data-massage-name="'.$row->name.'" data-profile-enable="'.$row->enabled.'" data-id="'.$row->id.'"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text">View the Massage Center Profile</span>';
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
                                                <a class="dropdown-item align-item-custom toggle-massage-contact" href="#" title="Click to '.Str::lower($conText).' contact" 
                                                data-id="'.$row->id.'" data-status="'.Str::lower($conCurrentText).'"> 
                                                <i class="fa fa-phone'.$conClass.' me-1"></i> <span>'.$conText.' Contact</span>
                                                </a>
                                                <span class="tooltip-text">Viewer can’t contact this massage center again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom toggle-massage-notification" href="#" title="Click to '.Str::lower($notText).' notification"
                                                data-id="'.$row->id.'" data-status="'.Str::lower($notCurrentText).'"> 
                                                <i class="fa fa-bell'.$notClass.' me-1" aria-hidden="true"></i> <span>'.$notText.' Notifications</span>
                                                <span class="tooltip-text">Viewer will not get notifications from this
                                                    massage center</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom massageRating" data-massage-name="'.$row->name.'" data-rate="'.$rate.'" data-id="'.$row->id.'" href="#" title=""> <i
                                                        class="fa fa-star" aria-hidden="true"></i>
                                                    Rate</a>
                                                <span class="tooltip-text">Rate this Massage Center</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom massageProfileRemove" href="#"
                                                    data-toggle="modal" data-massage-name="'.$row->name.'" data-id="'.$row->id.'"> <i
                                                        class="fa fa-trash" aria-hidden="true"></i>
                                                    Remove</a>
                                                <span class="tooltip-text">Viewer can’t contact this massage center again </span>
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

                ->rawColumns(['massage_id', 'massage_communication', 'action','business_name'])
                ->make(true);
        }
    }
}
