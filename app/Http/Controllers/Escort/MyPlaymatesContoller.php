<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPlaymatesContoller extends Controller
{
    public function index()
    {

        if(!Auth::user()){
            return redirect()->route('advertiser.login');
        }
        
        $playmates = Auth::user()
            ->playmates()
            ->with('user','user.state') // eager load user relation
            ->get()
            ->groupBy('user_id');

            $usersWithPlaymates = $playmates->map(function ($group) {
                return [
                    'user' => $group->first()->user, // related user
                    'playmates' => $group->pluck('id') // saare playmates of that user
                ];
            });

            //dd($usersWithPlaymates);
        return view('escort.dashboard.my-playmates',[
            'usersWithPlaymates' => $usersWithPlaymates]);
    }

    public function dashboardUserPlaymatesListAjax(Request $request)
    {
        if (auth()->user()) {

            $playmates = Auth::user()
            ->playmates()
            ->with('user','user.state') // eager load user relation
            ->get()
            ->groupBy('user_id');

            $usersWithPlaymates = $playmates->map(function ($group) {
                return [
                    'user' => $group->first()->user, // related user
                    'playmates' => $group->pluck('id') // saare playmates of that user
                ];
            });

            dd($usersWithPlaymates);

             return DataTables::of($usersWithPlaymates)
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search.value'); // null-safe
                    if (!empty($search)) {
                        $query->where(function ($q) use ($search) {
                            // search viewer_id from relation
                            $q->orWhereHas('messageViewerLegbox', function ($q2) use ($search) {
                                $q2->where('user_id', 'like', "%{$search}%");
                            });
                            // search business_name from massage profile name
                            $q->orWhere('name', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('viewer_id', function ($row) {
                    return $row->messageViewerLegbox ? $row->messageViewerLegbox->user_id : '-';
                })
                ->addColumn('business_name', function($row){
                    return Str::title($row->name);
                })
                ->addColumn('home_state', function($row){
                    return config("escorts.profile.states.$row->state_id.stateName") ?? '-';
                })
                ->addColumn('is_enabled_contact', function ($row){
                    return ($row->messageViewerInteraction && $row->messageViewerInteraction->viewer_disabled_contact == 0) ? 'Yes' : 'No';
                })
                ->addColumn('contact_method', function ($row) {
                    if($row->messageViewerInteraction && $row->messageViewerInteraction->viewer_disabled_contact){
                        return 'Disabled';
                    }
                    if($row->messageViewerLegbox ){
                        $viewer = User::where('id',$row->messageViewerLegbox->user_id)->first();
                        if($viewer->contact_type && (in_array(3, $viewer->contact_type) || in_array('3', $viewer->contact_type))){
                            return 'Email';
                        }
                        return "Text";
                    }
                    return '-';
                })

                ->addColumn('viewer_communication', function ($row) {
                    if($row->messageViewerInteraction && $row->messageViewerInteraction->viewer_disabled_contact){
                        return 'Disabled';
                    }

                    if($row->messageViewerLegbox ){
                        $viewer = User::where('id',$row->messageViewerLegbox->user_id)->first();
                        if($viewer->contact_type && (in_array(3, $viewer->contact_type) || in_array('3', $viewer->contact_type))){
                            return $row->user->email;
                        }
                        return $viewer->phone;
                    }
                    return '-';
                })
                ->addColumn('block_viewer', function($row) {

                    $isChecked = '';

                    $esvi = MassageViewerInteractions::where('massage_id',$row->id)->where('viewer_id',$row->messageViewerLegbox->user_id)->where('user_id',Auth::user()->id)->first('massage_blocked_viewer');

                    if($esvi && $esvi->massage_blocked_viewer){
                        $isChecked = 'checked';
                    }
                    

                    $isBlocked = '<div class="custom-control custom-switch">
                                            <input type="checkbox" '.$isChecked.' class="custom-control-input isBlockedButton" id="customSwitch'.$row->messageViewerLegbox->user_id.$row->id.'" data-id="'.$row->messageViewerLegbox->user_id.'" data-massage-id="'.$row->id.'">
                                            <label class="custom-control-label" for="customSwitch'.$row->messageViewerLegbox->user_id.$row->id.'"></label>
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
                    $contactTooltip = 'not';
                    $notifiTooltip = "can't";


                    # If massage blocked viewer
                    $massageViewerInteractions = MassageViewerInteractions::where('user_id',Auth::user()->id)->where('massage_id',$row->id)->where('viewer_id',$row->messageViewerLegbox->user_id)->first();

                    if($massageViewerInteractions && $massageViewerInteractions->massage_disabled_contact == 1){
                        $conClass = '';
                        $contactTooltip = '';
                        $conText = 'Enable';
                        $conCurrentText = 'disable';
                    }
                    
                    if($massageViewerInteractions && $massageViewerInteractions->massage_disabled_notification == 1){
                        $notClass = '';
                        $notText = 'Enable';
                        $notifiTooltip = '';
                        $notCurrentText = 'disable';
                        
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
                                                data-id="'.$row->messageViewerLegbox->user_id.'" data-massage-id="'.$row->id.'" data-status="'.Str::lower($conCurrentText).'"> 
                                                <i class="fa fa-phone'.$conClass.' me-1"></i> <span>'.$conText.' Contact</span>
                                                </a>
                                                <span class="tooltip-text">Massage center '.$contactTooltip.' contact this viewer again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom toggle-massage-notification" href="#" title="Click to '.Str::lower($notText).' notification"
                                                data-id="'.$row->messageViewerLegbox->user_id.'" data-massage-id="'.$row->id.'" data-status="'.Str::lower($notCurrentText).'"> 
                                                <i class="fa fa-bell'.$notClass.' me-1" aria-hidden="true"></i> <span>'.$notText.' Notifications</span>
                                                <span class="tooltip-text">Massage center will '.$notifiTooltip.' get notifications from this viewer</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            
                                        </div>

                                    </div>
                    ';

                    return $actionButtons;
                })

                ->rawColumns(['block_viewer', 'viewer_communication', 'action'])
                ->make(true);
        }

        return view('center.dashboard.Communication.legbox-viewers');
    }

    public function getPlaymatesDataByAjax(Request $request)
    {
        if(!Auth::user()){
            return redirect()->route('advertiser.login');
        }

        
        $escortIds = json_decode($request->escort_ids);
        
        $playmates = Escort::whereIn('id',$escortIds)->select('id','profile_name','user_id')->with('user')->get();

        //dd($playmates);

            // $usersWithPlaymates = $playmates->map(function ($group) {
            //     return [
            //         'user' => $group->first()->user, // related user
            //         'playmates' => $group->pluck('id') // saare playmates of that user
            //     ];
            // });

        //dd($playmates);

        return response([
            'status'=>200,
            'success'=>true,
            'message'=>'Playmates fetched successfully',
            'data'=>$playmates,
        ]);
    }
}
