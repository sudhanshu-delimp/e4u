<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\EscortViewerInteractions;
use App\Models\MassageProfile;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;

class ViewerMassageInteractionController extends Controller
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

    public function dashboardMassageListAjax(Request $request)
    {
        if (auth()->user()) {
            $myMassageLegbboxIds = MyMassageLegbox::where('user_id', auth()->user()->id)->pluck('massage_id');

            $massageCenters = MassageProfile::whereIn('id',$myMassageLegbboxIds)->with(['city','state','user'])->get();

            //dd($massageCenters->toArray());

             return DataTables::of($massageCenters)
                ->addColumn('massage_id', function ($row) {
                    return $row->id;
                })
                ->addColumn('location', function($row){
                    $state = City::where('state_id',$row->state_id)->first();
                    $stateCode = $state->state_code ?? '-';
                    return $stateCode;
                })
                ->addColumn('business_name', function($row){  
                    return $row->name;
                 })
                ->addColumn('open_now', function($row){  
                    return 'Yes';
                 })

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
                ->addColumn('is_enabled_contact', function ($row){
                    
                    return "No";
                })
                ->addColumn('contact_method', function ($row) {

                    
                    return 'Yes';
                })

                ->addColumn('massage_communication', function ($row) {

                    $methods[] = 'Text';
                    return $methods;
                })

                ->addColumn('action', function ($row) {

                    $conClass = '-slash';
                    $conText = 'Disable';
                    $conCurrentText = 'Enable';
                    $notClass = '-slash';
                    $notText = 'Disable';
                    $notCurrentText = 'Enable';
                    $rate = 'no_rated';

                    $viewButton = '<a class="dropdown-item align-item-custom escortProfileView"  href="#"
                                                    data-toggle="modal" data-escort-name="'.$row->name.'" data-profile-enable="'.$row->enabled.'" data-id="'.$row->id.'"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text">View the Escort’s Profile</span>';

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
                                                        class="fa fa-star" aria-hidden="true"></i>
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

                ->rawColumns(['massage_id', 'massage_communication', 'action','business_name'])
                ->make(true);
        }
    }
}
