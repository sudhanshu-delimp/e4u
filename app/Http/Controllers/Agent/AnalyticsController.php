<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnalyticsController extends Controller
{

        public function analytic_profiles_list_ajax($advertiserType)
        {
            if($advertiserType=='escort')
            $type = '3';
            else
            $type = '4';

            $userIds = User::where(['assigned_agent_id' => auth()->user()->id,'type'=> $type])->pluck('id')->toArray();

           
            $search = request()->get('search')['value'];
            $today = Carbon::now();
            switch ($advertiserType) {
                case 'escort': {
                        $escortIds = Escort::whereIn('user_id', $userIds)->where('purchase_id','!=',"")->pluck('id')->toArray();
                        $advertisers = Purchase::with('escort.pinup','paymentItems.payment')->where('status', 'listed')->whereIn('escort_id',$escortIds)->get();
                    }
                    break;
                case 'massage': {
                        $massageIds = MassageProfile::whereIn('user_id', $userIds)->where('purchase_id','!=',"")->pluck('id')->toArray();
                        $advertisers = MassagePurchase::with('paymentItems.payment')->where('status', 'listed')
                            ->whereIn('massage_profile_id',$massageIds)->get();
                            
                    }
                    break;
                default:
                    # code...
                    break;
            }


            // echo '<pre>';
            // print_r($advertisers->toArray());
            // exit;

                return DataTables::of($advertisers)
               
                ->addColumn('member_id', function ($row) {
                     return $row->advertiser->user->member_id .'--'.$row->id;
                })
                ->addColumn('name', function ($row) {
                    return $row->advertiser->profile_name ?? '';
                })
                 ->addColumn('mobile', function ($row) {
                    return $row->advertiser->phone ?? '';
                })
                ->addColumn('start_date', function ($row) {
                    return $row->start_date ?? '';
                })
                ->addColumn('end_date', function ($row) {
                    return $row->end_date ?? '';
                })
                ->addColumn('total_days', function ($row) {
                    return Carbon::parse($row->start_date)
                        ->diffInDays(Carbon::parse($row->end_date)) + 1;
                })
                ->addColumn('pin_up', function ($row) use($advertiserType) {
                    if($advertiserType=='escort')
                    return isset($row->advertiser->escort->pinup)
                    && count($row->advertiser->escort->pinup) > 0
                    ? 'Yes'
                    : 'No';
                    else
                    return '--';
                })

                ->addColumn('lsiting_fee', function ($row) use($advertiserType)  {
                    if($advertiserType=='escort')
                    {
                            
                        $fee = formatCurrency($row->paid_rate);
                    }
                    else
                    {
                        $fee = formatCurrency($row->final_amount);
                    }

                    $lsiting_fee = '<div class="num_value"><x-curFormat/><span>'.$fee .'</span></div>';
                    return $lsiting_fee;

                })
                ->addColumn('adgent_fee', function ($row) {

                    if($row->paymentItems->payment && $row->paymentItems->payment->agent_commission_percent>0)
                    $commission = calculate_agent_commission($row->paymentItems->payment->net_amount,$row->paymentItems->payment->agent_commission_percent);
                    else
                    $commission = 0.00;

                    $adgent_fee = '<div class="num_value"><x-curFormat/><span>'.formatCurrency($commission).'</span></div>';
                    return $adgent_fee;
                })

                ->addColumn('action', function ($row) use($advertiserType) {

                     if($advertiserType=='escort')
                     {
                        $state_id = $row->advertiser?->user?->current_state_id;
                        $current_state = !empty($state_id) ? (config("escorts.profile.states.{$state_id}.stateName") ?? null) : config("escorts.profile.states.{$row->advertiser?->user?->state_id}.stateName");
                     }
                     else
                     {
                        $current_state = config("escorts.profile.states.{$row->advertiser?->user?->state_id}.stateName");
                     }
                                
                    
                        $actionBtn = '
                                <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                        </a>
                                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">

                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#activity_summary">
                                                                <i class="fa fa-file-alt"></i> Activity Summary</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#current_location" data-membername="'.$row->advertiser->profile_name.'" data-memberid="'.$row->advertiser->user->member_id.'" data-location="'. $current_state.'"> <i class="fa fa-map-marker"></i> Current Location</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 open-summary-modal" href="#" data-id="'. $row->id.'" > <i class="fa fa-file-alt"></i>
                                                                Profile Summary</a>

                                                        </div>
                                </div>
                            ';

                    return $actionBtn;
                })
                ->rawColumns(['action','lsiting_fee','adgent_fee']) 
                ->make(true);


            

           
        } 
        
    public function getProfileSummary(Request $request, $id)
    {
      
        $html = view('agent.dashboard.Annalytics.profile_summary')->render();

        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }

}
