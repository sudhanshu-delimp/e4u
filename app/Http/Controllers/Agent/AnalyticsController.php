<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\EscortPinup;
use App\Models\MassageProfile;
use App\Models\MassagePurchase;
use App\Models\MassageTimeAvailability;
use App\Models\Masseur;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\Purchase;
use App\Models\Tour;
use App\Models\User;
use App\Services\LogService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class AnalyticsController extends Controller
{

        public $logService;

        public function __construct( LogService $logService)
        {
            $this->logService = $logService;

        }

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
                        $advertisers = MassagePurchase::with('paymentItems.payment')->where('status', 'listed')->whereIn('massage_profile_id',$massageIds)->get();  
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
                     return $row->advertiser->user->member_id; //.'--'.$row->id.'--'.$row->advertiser->id;
                })
                ->addColumn('name', function ($row) use($advertiserType) {

                    if($advertiserType=='escort')
                    return $row->advertiser->name ?? '';
                    else
                    return $row->advertiser->business_name ?? '';    
                    
                })
                 ->addColumn('mobile', function ($row) {
                    return $row->advertiser->phone ?? '';
                })
                ->addColumn('start_date', function ($row) {
                    return !empty($row->start_date) 
                        ? \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') 
                        : '';
                })
                ->addColumn('end_date', function ($row) {
                    return !empty($row->end_date) 
                        ? \Carbon\Carbon::parse($row->end_date)->format('d-m-Y') 
                        : '';
                })
                
                ->addColumn('total_days', function ($row) {
                    return Carbon::parse($row->start_date)
                        ->diffInDays(Carbon::parse($row->end_date)) + 1;
                })
                ->addColumn('pin_up', function ($row) use($advertiserType) {
                    if($advertiserType=='escort')
                    return isset($row->advertiser->escort->pinup)
                    && count($row->advertiser->escort->pinup) > 0 ? 'Yes' : 'No';
                    else
                    return 'NA';
                })

                ->addColumn('lsiting_fee', function ($row) use($advertiserType)  {
                   
                    $fee = formatCurrency($row->paid_rate,'');
                    $lsiting_fee = '<div class="num_value">$<span>'.$fee .'</span></div>';
                    return $lsiting_fee;

                })
                ->addColumn('adgent_fee', function ($row) {

                    $payment = $row->paymentItems?->payment;
                    if ($payment && $payment->agent_commission_percent > 0) 
                    $commission = calculate_agent_commission($payment->net_amount,$payment->agent_commission_percent);
                    else
                    $commission = 0.00;

                    // if($row->paymentItems->payment && $row->paymentItems->payment->agent_commission_percent>0)
                    // $commission = calculate_agent_commission($row->paymentItems->payment->net_amount,$row->paymentItems->payment->agent_commission_percent);
                    // else
                    // $commission = 0.00;

                    $adgent_fee = '<div class="num_value">$<span>'.formatCurrency($commission,'').'</span></div>';
                    return $adgent_fee;
                })

                ->addColumn('action', function ($row) use($advertiserType) {

                     if($advertiserType=='escort')
                     {
                        $member_name = $row->advertiser->name;
                        $massager_masseures ="";
                        $profile_id = $row->escort_id;
                        $state_id = $row->advertiser?->user?->current_state_id;
                        $current_state = !empty($state_id) ? (config("escorts.profile.states.{$state_id}.stateName") ?? null) : config("escorts.profile.states.{$row->advertiser?->user?->state_id}.stateName");
                     }
                     else
                     {
                         $member_name = $row->advertiser->business_name;
                        $profile_id = $row->massage_profile_id;
                        $current_state = config("escorts.profile.states.{$row->advertiser?->user?->state_id}.stateName");
                         $massager_masseures = ' <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 open-summary-modal" href="#" data-id="'. $row->id.'" > <i class="fa fa-file-alt"></i>
                                                                Profile Summary</a>';
                     }
                                

                       
                        $actionBtn = '
                                <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                        </a>
                                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">

                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 open-activity-modal" data-advertiser_type="'.$advertiserType.'" data-profile_id="'.$profile_id.'" href="#"   data-id="'. $row->id.'" >
                                                                <i class="fa fa-file-alt"></i> Activity Summary</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#current_location" data-membername="'.$member_name.'" data-memberid="'.$row->advertiser->user->member_id.'" data-location="'. $current_state.'"> <i class="fa fa-map-marker"></i> Current Location</a>
                                                            '. $massager_masseures.'</div>
                                </div>';

                    return $actionBtn;
                })
                ->rawColumns(['action','lsiting_fee','adgent_fee']) 
                ->make(true);

        } 
        
        public function getProfileSummary(Request $request, $id)
        {
        
            $listing = MassagePurchase::with('paymentItems.payment')->where('status', 'listed')
                                ->where('id',$id)->first();

            $start_date = strtotime($listing['start_date']);
            $end_date = strtotime($listing['end_date']);      
            $days = round(abs($end_date - $start_date) / 86400) + 1; 
            $masseures = false;   
            
            if($listing)
            {
                $masseures  = MassageTimeAvailability::with('masseur')
                ->where('purchase_id',$listing['id'])
                ->whereNotNUll('masseur_id')
                ->get();
                
                //Log::info($masseures);
            
            }        


            $html = view('agent.dashboard.Annalytics.profile_summary',compact('listing','days','masseures'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $html
            ]);
        }

        public function getActivitySummary(Request $request, $id)
        {
        
            $advertiserType = $request->advertiser_type;
            $profile_id     = $request->profile_id;
            
            $views = [] ;
            $advertiserType = strtolower(trim($advertiserType));
            if (in_array($advertiserType, ['massage', 'escort'])) 
            $views = $this->logService->getProfileViews($advertiserType,$profile_id);
            $html = view('agent.dashboard.Annalytics.profile_activity_summury', compact('views'))->render();

            // Log::info('views========');
            // Log::info($views);

            return response()->json([
                'status' => 'success',
                'html' => $html
            ])->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
        }




    public function getProfilePdf(Request $request, $advertiserType)
    {
        $request->validate([
            'from_date' => ['required', 'date'],
            'to_date'   => ['required', 'date', 'after_or_equal:from_date'],
        ]);

        if (!in_array($advertiserType, ['escort', 'massage'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid advertiser type.'
            ], 422);
        }

        $fromDate = date('Y-m-d', strtotime($request->from_date));
        $toDate   = date('Y-m-d', strtotime($request->to_date));
        $type     = $advertiserType == 'escort' ? '3' : '4';

        $userIds = User::where([
            'assigned_agent_id' => auth()->id(),
            'type'              => $type
        ])->pluck('id')->toArray();

        if ($advertiserType == 'escort') {
            $escortIds = Escort::whereIn('user_id', $userIds)
                ->whereNotNull('purchase_id')
                ->where('purchase_id', '!=', '')
                ->pluck('id')
                ->toArray();

            $advertisers = Purchase::with([
                    'escort.pinup',
                    'paymentItems.payment'
                ])
                ->where('status', 'listed')
                ->whereIn('escort_id', $escortIds)
                ->whereDate('start_date', '>=', $fromDate)
                ->whereDate('end_date', '<=', $toDate)
                ->get();
        } else {
            $massageIds = MassageProfile::whereIn('user_id', $userIds)
                ->whereNotNull('purchase_id')
                ->where('purchase_id', '!=', '')
                ->pluck('id')
                ->toArray();

            $advertisers = MassagePurchase::with([
                    'paymentItems.payment'
                ])
                ->where('status', 'listed')
                ->whereIn('massage_profile_id', $massageIds)
                ->whereDate('start_date', '>=', $fromDate)
                ->whereDate('end_date', '<=', $toDate)
                ->get();
        }

        if ($advertisers->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'No listing found between the given date range.'
            ], 404);
        }

        foreach ($advertisers as $item) {
            if (!empty($item->start_date) && !empty($item->end_date)) {
                $item->total_days = \Carbon\Carbon::parse($item->start_date)
                    ->diffInDays(\Carbon\Carbon::parse($item->end_date)) + 1;
            } else {
                $item->total_days = 0;
            }

            $item->member_id = $item->advertiser->user->member_id ?? '';

            if($advertiserType=='escort')
            $item->member_name = $item->advertiser->name ?? ''; 
            else
            $item->member_name = $item->advertiser->business_name ?? ''; 

            //$item->member_name = $item->advertiser->name ?? '';
            $item->member_mobile = $item->advertiser->phone ?? '';

            $item->start_date =  !empty($item->start_date) ? \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') : '';
            $item->end_date =  !empty($item->end_date) ? \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') : '';

        }

        
        $formattedType = ucfirst($advertiserType);
        if (strtolower($advertiserType) === 'massage') {
            $formattedType .= ' Centre';
        }

       
        if ($request->get('format') === 'json') {
            return response()->json([
                'status'         => true,
                'advertiserType' => $formattedType,
                'data'           => $advertisers
            ]);
        }



        
        $pdf = Pdf::loadView('agent.pdf.advertiser-profiles-report', [
            'advertisers'    => $advertisers,
            'advertiserType' => $advertiserType,
            'fromDate'       => $fromDate,
            'toDate'         => $toDate,
        ])->setPaper('a4', 'landscape');

        $disposition = $request->get('action') === 'download' ? 'attachment' : 'inline';
        $filename    = 'profile-report-' . $advertiserType . '.pdf';

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "{$disposition}; filename=\"{$filename}\"");
    }




    ############## Tour Section ##########################################

    public function analytic_tour_list_ajax()
    {
           
        $userIds = User::where(['assigned_agent_id' => auth()->user()->id])->pluck('id')->toArray();
        $search = request()->get('search')['value'];
        $today = Carbon::now();
        $tours = Tour::with('user','locations','tourProfiles','tourPurchase')->whereIn('user_id', $userIds)->get();

            
            return DataTables::of($tours)
               
                ->addColumn('member_id', function ($row) {
                     return $row->user->member_id;
                })
                ->addColumn('name', function ($row)  {
                  return $row->user->name ?? '';
                })
                 ->addColumn('mobile', function ($row) {
                    return $row->user->phone ?? '';
                })

                ->addColumn('tour_name', function ($row)  {
                  return $row->name ?? '';
                })

               ->addColumn('no_of_location', function ($row)  {
                    return $row->locations->count(); 
                })

                ->addColumn('start_date', function ($row) {
                    return !empty($row->start_date) 
                        ? \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') 
                        : '';
                })
                ->addColumn('end_date', function ($row) {
                    return !empty($row->end_date) 
                        ? \Carbon\Carbon::parse($row->end_date)->format('d-m-Y') 
                        : '';
                })
                
                ->addColumn('total_days', function ($row) {
                    return Carbon::parse($row->start_date)
                        ->diffInDays(Carbon::parse($row->end_date)) + 1;
                })
                ->addColumn('pin_up', function ($row) {

                     $pinup = $this->getPinup($row);
                     return ($pinup) ? 'Yes' : 'No';
                
                })

                ->addColumn('listing_fee', function ($row)  {

                      
                        $pin_up_amount = $this->getPinupAmount($row);
                        $sum_listing_fees = $this->getPaymentAmount($row);
                        $totalFee  = $pin_up_amount + $sum_listing_fees;
                        $fee = formatCurrency($totalFee, '');
                        return '<div class="num_value">$<span>' . $fee . '</span></div>';
                })
                                        
                ->addColumn('adgent_fee', function ($row) {

                    $paymentHistory = $this->getPaymentHistoryData($row);
                    $comm_fee = ($paymentHistory && $paymentHistory->commissions) ? $paymentHistory->commissions->sum('total_commission_amount') : 0;
                    $adgent_fee = '<div class="num_value">$<span>'.formatCurrency($comm_fee, '').'</span></div>';
                    return $adgent_fee;

                   
                })

                ->addColumn('action', function ($row)  {

                     $member_name = $row->user?->name;
                     $profile_id = $row->id;
                     $state_id = $row->user?->current_state_id;
                     $current_state = !empty($state_id) ? (config("escorts.profile.states.{$state_id}.stateName") ?? null) : config("escorts.profile.states.{$row->user?->state_id}.stateName");

                   
                    $massager_masseures = ' <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 open-summary-modal" href="#" data-member_id="'.$row->user->member_id.'" data-id="'. $row->id.'" > <i class="fa fa-file-alt"></i>
                                                                Tour Summary</a>';
                                

                       
                        $actionBtn = '
                                <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                        </a>
                                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">

                                                          
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#current_location" data-membername="'.$member_name.'" data-memberid="'.$row->user->member_id.'" data-location="'. $current_state.'"> <i class="fa fa-map-marker"></i> Current Location</a>
                                                            '. $massager_masseures.'</div>
                                </div>';

                    return $actionBtn;
                })
                ->rawColumns(['action','listing_fee','adgent_fee']) 
                ->make(true);

    } 


    private function getPaymentAmount($row)
    {
        $totalAmount = 0;
        $purchaseIds = collect($row->tourPurchase)->pluck('id')->filter()->unique();

        //  Log::info($row->id.'========'.$row->name);
        //  Log::info($purchaseIds);
        //  Log::info('========');

        if ($purchaseIds->isEmpty()) {
            return $totalAmount;
        }

        $totalAmount = PaymentItem::whereIn('item_id', $purchaseIds)
        ->where('item_type', 'App\Models\Purchase')
        ->sum('amount');
        return  $totalAmount;
    }

    private function getPaymentHistoryData($row)
    {
        $purchaseIds = collect($row->tourPurchase)->pluck('id')->filter()->unique();

        //  Log::info($row->id.'========'.$row->name);
        //  Log::info($purchaseIds);
        //  Log::info('========');


        if ($purchaseIds->isEmpty()) {
            return null;
        }

        $paymentHistoryIds = PaymentItem::
             whereIn('item_id', $purchaseIds)
            ->where('item_type', 'App\Models\Purchase')
            ->pluck('payment_history_id')
            ->unique();

        return PaymentHistory::with('commissions')->whereIn('id', $paymentHistoryIds)->first();
    }

    private function getPinupAmount($row)
    {
       
        $pinup_amount = 0; 
        if(!empty($row->locations))
        {
           foreach($row->locations as $location) 
            {
                if($location->is_pinup=='1')
                {
                    $pinup_profiles = $location->profiles->whereNotNull('is_pinup');
                    $pinup_data = $pinup_profiles[0] ?? null;

                    if ($pinup_data && !empty($pinup_data['is_pinup'])) 
                    {
                        $PaymentItem = PaymentItem::where('item_id', $pinup_data['is_pinup'])
                            ->where('item_type', 'App\Models\EscortPinup')
                            ->first();

                        $pinup_amount  += $PaymentItem ? $PaymentItem->amount : 0;
                    }
                }
            }
        }
      
        return $pinup_amount;
    }


    private function getPinup($row)
    {
        $pinup = false;

        if(!empty($row->locations))
        {
           foreach($row->locations as $location) 
            {
                if($location->is_pinup=='1')
                {
                    $pinup  = true;
                    break;
                }
            }
        }
      
        return $pinup;
    }
        
    public function getTourPdf(Request $request)
    {
        $request->validate([
            'from_date' => ['required', 'date'],
            'to_date'   => ['required', 'date', 'after_or_equal:from_date'],
        ]);

        $fromDate = date('Y-m-d', strtotime($request->from_date));
        $toDate   = date('Y-m-d', strtotime($request->to_date));
        
        $userIds = User::where(['assigned_agent_id' => auth()->user()->id])->pluck('id')->toArray();
        $tours = Tour::with('user','locations','tourProfiles','tourPurchase')->whereIn('user_id', $userIds)
                        ->whereDate('start_date', '>=', $fromDate)
                        ->whereDate('end_date', '<=', $toDate)
                        ->get();


        if ($tours->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'No Tour found between the given date range.'
            ], 404);
        }

        $alltours = $tours->map(function ($row, $index) {

            $paymentHistory = $this->getPaymentHistoryData($row);
            $pin_up_amount = $this->getPinupAmount($row);
            $sum_listing_fees = $this->getPaymentAmount($row);
            $totalFee  = $pin_up_amount + $sum_listing_fees;

            $comm_fee = ($paymentHistory && $paymentHistory->commissions) 
                ? $paymentHistory->commissions->sum('total_commission_amount') 
                : 0;

            return [
                's_no'           => $index + 1,
                'id'             => $row->id,
                'member_id'      => optional($row->user)->member_id,
                'name'           => optional($row->user)->name ?? '',
                'mobile'         => optional($row->user)->phone ?? '',
                'tour_name'      => $row->name ?? '',
                'no_of_location' => $row->locations ? $row->locations->count() : 0,
                'start_date'     => !empty($row->start_date) 
                                    ? \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') 
                                    : '',
                'end_date'       => !empty($row->end_date) 
                                    ? \Carbon\Carbon::parse($row->end_date)->format('d-m-Y') 
                                    : '',
                'total_days'     => (!empty($row->start_date) && !empty($row->end_date)) 
                                    ? \Carbon\Carbon::parse($row->start_date)->diffInDays(\Carbon\Carbon::parse($row->end_date)) + 1 
                                    : 0,
                'pin_up'         => $this->getPinup($row) ? 'Yes' : 'No',
                'listing_fee'    => formatCurrency($totalFee, ''),
                'agent_fee'     =>  formatCurrency($comm_fee, ''),
            ];
        });


        if ($request->get('format') === 'json') {
           return response()->json([
            'status' => true,
            'data'   => $alltours
            ]);
        }

        $pdf = Pdf::loadView('agent.pdf.advertiser-tour-report', [
            'alltours'       => $alltours,
            'fromDate'       => $fromDate,
            'toDate'         => $toDate,
        ])->setPaper('a4', 'landscape');

        $disposition = $request->get('action') === 'download' ? 'attachment' : 'inline';
        $filename    = 'tour-report.pdf';

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "{$disposition}; filename=\"{$filename}\"");
    }


    public function getTourSummaryDetail(Request $request)
    {
        $tourId = $request->get('tour_id');
        $tour = Tour::with([
            'locations',
            'locations.Purchase',
            'locations.Purchase.membershipPlan' 
        ])->find($tourId);

        // dd($tour->toArray());

        if (!$tour) {
            return response()->json([
                'status' => false,
                'message' => 'Tour summary not found.'
            ], 404);
        }

        $summaryData = [];
        $totalDaysSum = 0;
        $totalFeeSum = 0;

        foreach ($tour->locations as $location) {
          
            $start = $location->start_date ? Carbon::parse($location->start_date) : null;
            $end   = $location->end_date ? Carbon::parse($location->end_date) : null;

           
            $days = ($start && $end) ? $start->diffInDays($end) + 1 : 0;
            $totalDaysSum += $days;

            $startDate = $start ? $start->format('d-m-Y') : '';
            $endDate   = $end ? $end->format('d-m-Y') : '';


            $listingFee = 0;
            $membership = [];
            $i=0;
            foreach ($location->purchase as $purc) {
            $listingFee += $purc->paid_rate ? $purc->paid_rate : 0.00;
            
            $escort =  $purc->escort->slug ?  $purc->escort->slug : 'NA';
            $plan = $purc->membershipPlan->name ? $purc->membershipPlan->name : 'NA';
            $membership[$i]['member_id'] = $escort;
            $membership[$i]['plan'] = $plan;
            $i++;
            }

            $is_pinup = 0;
            $total_pinup_amount = 0;
            $pinup_data = [];
            $pinup_array = [];
  
            if($location->is_pinup =='1')
            {
                $is_pinup = 1;
                $pinup_profiles = $location->profiles->whereNotNull('is_pinup');
                $pinup_data = $pinup_profiles[0] ?? null;

                if ($pinup_data && !empty($pinup_data['is_pinup'])) 
                {
                    $PaymentItem = PaymentItem::where('item_id', $pinup_data['is_pinup'])
                        ->where('item_type', 'App\Models\EscortPinup')
                        ->first();

                    $escort_pinup = EscortPinup::with('escort')->where('id', $pinup_data['is_pinup'])->first();
                    if($escort_pinup)
                    {
                        $escort_start = $escort_pinup->start_date ? Carbon::parse($escort_pinup->start_date) : null;
                        $escort_end   = $escort_pinup->end_date ? Carbon::parse($escort_pinup->end_date) : null;
                        $pin_days = ($escort_start && $escort_end) ? $escort_start->diffInDays($escort_end) + 1 : 0;
                    }

                    $membership_pinup = isset($escort_pinup->escort->slug) ?  'Pin Up (' .$escort_pinup->escort->slug.')' : 'Pin Up';
                    $pinup_array['location'] = optional($location->state)->iso2 ?? optional($location->state)->iso2 ?? 'N/A';
                    $pinup_array['membership'] = $membership_pinup;
                    $pinup_array['start_date'] = date('d-m-Y',strtotime($escort_pinup->start_date));
                    $pinup_array['end_date'] = date('d-m-Y',strtotime($escort_pinup->end_date));  
                    $pinup_array['days'] = '(1 week)';
                    $pinup_array['listing_fee'] = $PaymentItem ? $PaymentItem->amount: 0;
                    $total_pinup_amount += $PaymentItem->amount;
                }

            }
            
            $totalFeeSum += $listingFee+$total_pinup_amount;
            $summaryData[] = [
                'location'        => optional($location->state)->iso2 ?? optional($location->state)->iso2 ?? 'N/A',
                'start_date'      => $startDate,
                'end_date'        => $endDate,
                'days'            => $days,
                'listing_fee'     => formatAmount($listingFee),
                'membership'      => $membership,
                'is_pinup'        => $is_pinup,
                'pinup_data'      => $pinup_array,
            ];
        }

        return response()->json([
            'status'     => true,
            'member_id'  => optional($tour->user)->member_id ?? '',
            'tour_id'    => $tour->id,
            'data'       => $summaryData,
            'total_days' => $totalDaysSum,
            'total_fee'  => number_format($totalFeeSum, 2)
        ]);
    }


    public function downloadTourSummaryPdf(Request $request)
    {
        $response = $this->getTourSummaryDetail($request);
        $data = $response->getData(true);

        if (empty($data['status'])) {
            abort(404, $data['message'] ?? 'Tour summary not found.');
        }

        $pdf = Pdf::loadView('agent.pdf.tour_summary', $data)
                ->setPaper('a4', 'portrait');

        return $pdf->stream('tour_summary_' . $data['member_id'] . '.pdf');
    }

}
