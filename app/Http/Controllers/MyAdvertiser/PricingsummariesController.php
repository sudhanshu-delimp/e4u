<?php

namespace App\Http\Controllers\MyAdvertiser;

use Carbon\Carbon;
use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\PricingSummary;
use App\Models\CommissionPlaybox;
use App\Models\FeesSupportService;
use App\Http\Controllers\Controller;
use App\Models\FeesConciergeService;
use App\Models\VariablAgentOperator;
use App\Models\VariablLoyaltyProgram;
use App\Http\Controllers\BaseController;
use App\Repositories\User\UserInterface;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\Pricing\PricingInterface;

class PricingsummariesController extends BaseController
{
    //
    protected $escort;
    protected $user;
    protected $pricing;
    public function __construct(PricingInterface $pricing,EscortInterface $escort, UserInterface $user){
        $this->escort = $escort;
        $this->user = $user;
        $this->pricing = $pricing;
    }

    
    public function showPricingsummary() {
        
        $states = config('escorts.profile.states');
        //$advertings= config('agent.advertising');
        $membership_types = MembershipPlan::where('is_for_calculater','1')->get()->toArray();
        $no_of_members = config('agent.no_of_members');

        $advertings = Pricing::with('memberships')->get()->toArray();
        $fees_concierge_services = FeesConciergeService::all();
        $fees_support_services = FeesSupportService::all();
        $variablLoyaltyProgram = VariablLoyaltyProgram::all();

        
        //dd($advertings);

        return view('agent.dashboard.Advertisers.pricingsummaries',compact('advertings', 'membership_types','states','no_of_members','fees_concierge_services','fees_support_services','variablLoyaltyProgram'));
    }



    ######### Update Pricing Data ############
    public function update_fees_data(Request $request)
    {

        if(isset($request->concierge_services) && $request->concierge_services=='concierge_services')
        {
            $feesConciergeService = FeesConciergeService::where('id',$request->id)
                    ->update(['amount'=>$request->amount,'service_type'=>$request->service_type,'frequency'=>$request->frequency]);
            if($feesConciergeService)
            return $this->successResponse('Updated Successfully');
            else
            return $this->validationError('Error occred while updating');
           
        }

        if(isset($request->fee_support_services) && $request->fee_support_services=='fee_support_services')
        {
            $feesConciergeService = FeesSupportService::where('id',$request->id)->update(['amount'=>$request->amount]);
            if($feesConciergeService)
            return $this->successResponse('Updated Successfully');
            else
            return $this->validationError('Error occred while updating');
           
        }

        if(isset($request->loyalty_program_advertisers) && $request->loyalty_program_advertisers=='loyalty_program_advertisers')
        {
            $feesConciergeService = VariablLoyaltyProgram::where('id',$request->id)
                                    ->update([
                                        'type'=>$request->type,
                                        'level'=>$request->level,
                                        'discription'=>$request->decs,
                                        'amount'=>$request->amount,
                                        'reward'=>$request->reward
                                    ]);
            if($feesConciergeService)
            return $this->successResponse('Updated Successfully');
            else
            return $this->validationError('Error occred while updating');
           
        }

        if(isset($request->agent_operator_fees) && $request->agent_operator_fees=='agent_operator_fees')
        {
            $feesConciergeService = VariablAgentOperator::where('id',$request->id)
                                    ->update([
                                        'rate'=>$request->rate,
                                        'discription'=>$request->discription,
                                        'percent'=>$request->percent,
                                    ]);
            if($feesConciergeService)
            return $this->successResponse('Updated Successfully');
            else
            return $this->validationError('Error occred while updating');
           
        }

        if(isset($request->commision_playbox_fees) && $request->commision_playbox_fees=='commision_playbox_fees')
        {
            $feesConciergeService = CommissionPlaybox::where('id',$request->id)
                                    ->update([
                                        'discription'=>$request->discription,
                                        'amount'=>$request->amount,
                                        'amount_type'=>$request->amount_type,
                                    ]);
            if($feesConciergeService)
            return $this->successResponse('Updated Successfully');
            else
            return $this->validationError('Error occred while updating');
           
        }





        

    }
    ######### End Update Pricing Data ############



    ###### Set Fees - Advertising     #############
    public function PricingDataTable() 
    {
        
       list($pricing, $count) = $this->pricing->paginatedPricingList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            // auth()->user()->id,
        );

        //dd($pricing);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $pricing
        );

        return response()->json($data);
    }

    public function storePricingDetail(Request $request) 
    {
        
        //dd($request->all());
        $id = $request->pricingId; 
        $arr = [];
        $arr = [
                'price' => $request->price,
                'frequency' => $request->frequency,
                'discount_amount' => $request->discount_amount,
        ];
        $error = 0;
        //$data = $this->pricing->store($arr, $id);
        $data = $this->pricing->find($id);
        if(isset($request->frequency)) {
        $data->frequency = $request->frequency;
        $data->save();
        }
        // $percent = $request->price*$data->percentage/100;
        // $data->status = $request->price - $percent;

        $data->price = $request->price;
        $data->percentage = $request->percentage;
        $data->discount_amount = $request->discount_amount;
        $data->days = $request->days;
        $data->save();
       

        return response()->json(compact('error','data'));
    }
    ###### End Set Fees - Advertising     #############





    ###### Set Fees - Concierge Services    #############
    public function concierge_services_datatable()
    {
        list($result, $count) = $this->concierge_services_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
           "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function concierge_services_pagination($start, $limit, $order_key, $dir)
    {
        $fees = FeesConciergeService::query();
      
        $search = request()->input('search.value');

           if (!empty($search)) {
            $fees->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('fee', 'like', "%{$search}%");
            });
            }

            switch ($order_key) {
                case 1:
                    $fees->orderBy('id', $dir);
                    break;
                case 2:
                    $fees->orderBy('fee', $dir);
                    break;
                    
                default:
                    $fees->orderBy('id', 'Desc');
                    break;
            }

      

        $total_fees = $fees->count();
        $fees_list = $fees->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($fees_list as $key => $item) {

            $item->amount = '$'.$item->amount;
            $dropdown = '<div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit_item" href="javascript:void(0)" data-id=\'' . htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') . '\' data-toggle="modal"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                         </div>';

            $item->action = $dropdown;
            $i++;
        }

        return [$fees_list, $total_fees];
    }

    ###### End Set Fees - Concierge Services    #############




    ###### Set Fees - Support Services (E4U Staff)   #############
    public function fee_support_services_datatable()
    {
        list($result, $count) = $this->fee_support_services_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
           "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function fee_support_services_pagination($start, $limit, $order_key, $dir)
    {

        $fees = FeesSupportService::query();
        $search = request()->input('search.value');

           if (!empty($search)) {
            $fees->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('fee', 'like', "%{$search}%");
            });
            }

            switch ($order_key) {
                case 1:
                    $fees->orderBy('id', $dir);
                    break;
                case 2:
                    $fees->orderBy('fee', $dir);
                    break;
                    
                default:
                    $fees->orderBy('id', 'asc');
                    break;
            }

      

        $total_fees = $fees->count();
        $fees_list = $fees->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($fees_list as $key => $item) {
            $item->amount =  ($item->amount!="" || 0) ? '$'.$item->amount : '0.00';
            $dropdown = '<div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit_item_fee_support_services" href="javascript:void(0)" data-id=\'' . htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') . '\' data-toggle="modal"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                         </div>';

            $item->action = $dropdown;
            $i++;
        }

        return [$fees_list, $total_fees];
    }
    ###### End Set Fees - Support Services (E4U Staff)   #############




    ###### Set Variables - Loyalty Program Advertisers  #############
    public function loyalty_program_datatable()
    {
        list($result, $count) = $this->loyalty_program_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
           "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function loyalty_program_pagination($start, $limit, $order_key, $dir)
    {
        $fees = VariablLoyaltyProgram::query();
      
        $search = request()->input('search.value');

           if (!empty($search)) {
            $fees->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('fee', 'like', "%{$search}%");
            });
            }

            switch ($order_key) {
                case 1:
                    $fees->orderBy('id', $dir);
                    break;
                
                    
                default:
                    $fees->orderBy('id', 'asc');
                    break;
            }

      

        $total_fees = $fees->count();
        $fees_list = $fees->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($fees_list as $key => $item) {

            $item->amount = '$'.$item->amount;
            $dropdown = '<div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit_item_loyalty_program_advertisers" href="javascript:void(0)" data-id=\'' . htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') . '\' data-toggle="modal"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                         </div>';

            $item->action = $dropdown;
            $i++;
        }

        return [$fees_list, $total_fees];
    }
    ###### End Set Variables - Loyalty Program Advertisers  #############




    ###### Set Variables - Agent & Operator #############
    public function agent_operator_fees_datatable()
    {
        list($result, $count) = $this->agent_operator_fees_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
           "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function agent_operator_fees_pagination($start, $limit, $order_key, $dir)
    {
        $fees = VariablAgentOperator::query();
      
        $search = request()->input('search.value');

           if (!empty($search)) {
            $fees->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('rate', 'like', "%{$search}%");
            });
            }

            switch ($order_key) {
                case 1:
                    $fees->orderBy('id', $dir);
                    break;

                default:
                    $fees->orderBy('id', 'asc');
                    break;
            }

      

        $total_fees = $fees->count();
        $fees_list = $fees->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($fees_list as $key => $item) {

            $item->percent = $item->percent;
            $item->rate = $item->rate == '1' ? 'Per Day' : ($item->rate == '2' ? 'Per Week' : 'Per Registration') ;
            $dropdown = '<div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit_item_agent_operator_fees_modal" href="javascript:void(0)" data-id=\'' . htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') . '\' data-toggle="modal"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                         </div>';

            $item->action = $dropdown;
            $i++;
        }

        return [$fees_list, $total_fees];
    }
    
    ###### End Set Variables - Agent & Operator  #############




    ###### Set Commission - Playbox  #############
    public function commision_playbox_fees_datatable()
    {
        list($result, $count) = $this->commision_playbox_fees_pagination(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
           "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }


    public function commision_playbox_fees_pagination($start, $limit, $order_key, $dir)
    {
        $fees = CommissionPlaybox::query();
      
        $search = request()->input('search.value');

           if (!empty($search)) {
            $fees->where(function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                ->orWhere('discription', 'like', "%{$search}%");
            });
            }

            switch ($order_key) {
                case 1:
                    $fees->orderBy('id', $dir);
                    break;

                default:
                    $fees->orderBy('id', 'asc');
                    break;
            }

      

        $total_fees = $fees->count();
        $fees_list = $fees->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($fees_list as $key => $item) {

            $item->amount_perent = ($item->amount_type=='fixed') ? '$'.$item->amount : $item->amount.'%';
            $dropdown = '<div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit_item_commision_playbox_fees" href="javascript:void(0)" data-id=\'' . htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') . '\' data-toggle="modal"><i class="fa fa-fw fa-pen "></i> Edit </a>
                                                   
                                             </div>
                         </div>';

            $item->action = $dropdown;
            $i++;
        }

        return [$fees_list, $total_fees];
    }
    
    ###### End Set Commission - Playbox  #############




    public function calculate(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'membership_id' => 'required',
            'members' => 'required|integer|min:1'
        ]);

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        // Count days including start + end
        $days = $start->diffInDays($end) + 1;

        // Get Membership Pricing
        $ad = Pricing::where('membership_id', $request->membership_id)
                ->with('memberships')
                ->first();

        if (!$ad) {
            return response()->json(['error' => 'Membership not found'], 422);
        }

        $rate = $ad->discount_amount ?? $ad->price;

        // Calculate Fee
        if (str_contains(strtolower($ad->frequency), '1')) {
            $fee = $rate * $days * $request->members;
        } elseif (str_contains(strtolower($ad->frequency), '2')) {
            $weeks = ceil($days / 7);
            $fee = $rate * $weeks * $request->members;
        } else {
            $fee = $rate * $days * $request->members;
        }

        return response()->json([
            'days' => $days,
            'fee' => number_format($fee, 2),
            'membership_name' => $ad->memberships->name ?? 'N/A',
            'start_formatted' => $start->format('d-m-Y'),
            'end_formatted' => $end->format('d-m-Y'),
        ]);
    }

}
