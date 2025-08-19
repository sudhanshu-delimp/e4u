<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\MassageProfile;
use App\Models\MassageViewerInteractions;
use App\Models\MyLegbox;
use App\Models\MyMassageLegbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;
use MassageViewerInteractions as GlobalMassageViewerInteractions;

class ViewerMassageInteractionController extends Controller
{
    public function viewerUpdateMassageInteraction(Request $request)
    {
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

            $massageCenters = MassageProfile::whereIn('id',$myMassageLegbboxIds)->with(['city','state','user','messageViewerInteraction'])->get();

            // dd($massageCenters);

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
                    return Str::title($row->name);
                 })
                ->addColumn('open_now', function($row){  

                    return 'Yes';
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

                    $viewButton = '<a class="dropdown-item align-item-custom massageProfileView"  href="#"
                                                    data-toggle="modal" data-massage-name="'.$row->name.'" data-profile-enable="'.$row->enabled.'" data-id="'.$row->id.'"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text">View the Massage Center Profile</span>';

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
                                                <span class="tooltip-text">Viewer can’t contact this massage center again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom toggle-notification" href="#" title="Click to '.Str::lower($notText).' notification"
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
