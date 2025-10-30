<?php

namespace App\Http\Controllers\MyAdvertiser;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\PricingSummary;
use App\Models\FeesSupportService;
use App\Http\Controllers\Controller;
use App\Models\FeesConciergeService;
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
        //dd($advertings);

        return view('agent.dashboard.Advertisers.pricingsummaries',compact('advertings', 'membership_types','states','no_of_members'));
    }



    public function PricingDataTable() {
        
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
    public function storePricingDetail(Request $request) {
        
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
        $data->discount_amount = $request->discount_amount;
        $data->days = $request->days;
        $data->save();
       

        return response()->json(compact('error','data'));
    }



    


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


    public function update_fees_data(Request $request)
    {

        if(isset($request->concierge_services) && $request->concierge_services=='concierge_services')
        {
            $feesConciergeService = FeesConciergeService::where('id',$request->id)->update(['amount'=>$request->amount]);
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

    }

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
                    $fees->orderBy('id', 'Desc');
                    break;
            }

      

        $total_fees = $fees->count();
        $fees_list = $fees->offset($start)->limit($limit)->get();
        $i = 1;
               
        foreach($fees_list as $key => $item) {
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


    
}
