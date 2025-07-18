<?php

namespace App\Http\Controllers\Escort;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Escort;
use App\Models\MyLegbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Str;

class EscortMyLegboxViewerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $escortIds = MyLegbox::where('user_id', $user->id)->pluck('escort_id');
        $escorts = Escort::whereIn('id', $escortIds)->where('enabled', 1)->get();
        return view('escort.dashboard.my-legbox-viewers', ['escorts' => $escorts]);
    }

    public function dashboard()
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

        // return response()->json(['error' => 'Unauthorized'], 403);

        //dd($user_type->myLegBox->pluck('id')->toArray());
        // return view('user.dashboard.legbox.escort-list',compact('user_type','escorts'));
        // $user = Auth::user();
        // $escortIds = MyLegbox::where('user_id',$user->id)->pluck('escort_id');
        // $escorts = Escort::whereIn('id',$escortIds)->where('enabled',1)->get();
        return view('user.dashboard.my-legbox',['escorts'=>$escorts]);
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
                'suspendProfile' => function ($query) {
                    $today = Carbon::now(config('app.timezone'));
                    $query->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today)
                        ->where('status', true);
                }
            ])->where('enabled', 1)->get(); // city_id

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

                ->addColumn('rating_label', function ($escort) {
                    $total = count($escort->likes);
                    $dislikes = $escort->likes->where('like', 0)->count();
                    $likes = $total - $dislikes;
                    $percentage = $total > 0 ? round(($likes / $total) * 100, 2) : 0;
                    return getRatingLabel($percentage); // custom function
                })

                ->addColumn('is_notification_enabled', function ($escort) {

                    if($escort->user->notification_features && in_array('viewer_notification', $escort->user->notification_features)){
                        $isEnabledNotificationByEscort = 'Yes';
                    }else{
                        $isEnabledNotificationByEscort = 'No';
                    }
                    // return isset($escort->myLegBox->is_notification_enabled) && $escort->myLegBox->is_notification_enabled ? 'Yes' : 'No';
                    return $isEnabledNotificationByEscort;
                })
                ->addColumn('is_enabled_contact', function ($escort){
                    return isset($escort->myLegBox->is_enabled_contact) && $escort->myLegBox->is_enabled_contact ? 'Yes' : 'No';
                })
                // ->addColumn('is_notification_enabled', fn($escort) => $escort->is_notification_enabled ? 'Yes' : 'No')
                // ->addColumn('is_enabled_contact', fn($escort) => $escort->is_enabled_contact ? 'Yes' : 'No')

                ->addColumn('contact_method', function ($escort) {
                    $methods = [];
                    $types = $escort->user->contact_type ?? [];
                    if (in_array(3, $types)) $methods[] = 'Email';
                    if (in_array(4, $types)) $methods[] = 'Call';
                    if (in_array(2, $types) || empty($methods)) $methods[] = 'Text';
                    return implode(', ', $methods);
                })

                ->addColumn('escort_communication', function ($escort) {
                    $contactType = $escort->user->contact_type ?? [];
                    $output = '';
                    if (in_array(3, $contactType)) $output .= $escort->user->email . '<br>';
                    if (in_array(4, $contactType)) $output .= $escort->phone . '<br>';
                    if (in_array(2, $contactType)) $output .= '<span>Text</span><br>';
                    if (empty($contactType)) $output .= '<span>Text</span><br>';
                    return $output;
                })

                ->addColumn('is_blocked', function ($escort) {
                    return '<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="blockEscort_' . $escort->id . '" ' . ($escort->is_blocked ? 'checked' : '') . '>
                            <label class="custom-control-label" for="blockEscort_' . $escort->id . '"></label>
                        </div>';
                })

                ->addColumn('action', function ($escort) {
                    return '
                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"> <i
                                                        class="fa fa-phone-slash"></i> Disable Contact</a>
                                                <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"> <i
                                                        class="fa fa-bell-slash" aria-hidden="true"></i>
                                                    Disable Notifications</a>
                                                <span class="tooltip-text">Viewer will not get notifications from this
                                                    escort</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#" title=""
                                                    data-toggle="modal" data-target="#rateEscortModal"> <i
                                                        class="fa fa-star" aria-hidden="true"></i>
                                                    Rate</a>
                                                <span class="tooltip-text">Rate this Escort</span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    data-toggle="modal" data-target="#removeEscort"> <i
                                                        class="fa fa-trash" aria-hidden="true"></i>
                                                    Remove</a>
                                                <span class="tooltip-text">Viewer can’t contact this escort again </span>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                            <div class="custom-tooltip-container">
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    data-toggle="modal" data-target="#escortProfileMissingModal"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View</a>
                                                <span class="tooltip-text">View the Escort’s Profile</span>
                                            </div>
                                        </div>

                                    </div>
                ';
                    //return view('components.escort_actions', ['escort' => $escort])->render();
                })

                ->rawColumns(['escort_id', 'escort_communication', 'is_blocked', 'action'])
                ->make(true);
        }

        return view('user.dashboard.my-legbox', ['escorts' => $escorts]);
    }
}
