<?php

namespace App\Repositories\Tour;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Tour;

use Carbon\Carbon;


class TourRepository extends BaseRepository implements TourInterface
{
    use DataTablePagination;
    public function __construct(Tour $model)
    {
        $this->model = $model;
    }


    public function paginated($start, $limit, $order_key, $dir, $columns, $search = null,$user_id, $conditions = NULL)
	{
		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $this->model
            //->where("transaction_Status_Code","Completed")
            ->where(function($query) use ($user_id) {
                $query = $query ->whereHas('tour_location', function($q) use ($user_id) {
                    $q->where('user_id', $user_id);
                });

            })
            ->where($conditions)
            ->where("transaction_Status_Code","=","Completed")
            ->offset($start)
		    ->limit($limit)
		    ->orderBy($order,$dir);

		if($search) {
			foreach ($searchables as $column) {
				if(in_array($column, $this->getColumns())) {
					$query->orWhere($column, 'LIKE', "%{$search}%");
				}
			}
		}

		$result = $query->get();

		$result = $this->modifyProperties($result,$start);
		$count =  $query->count();

		return [$result, $count];
	}
    protected function modifyProperties($result ,$start)
    {
        //dd($result);
        $location = [];
        $i = 1;

        foreach($result as $key => $item) {
            // $item->sn = $i+$start;
            //dd($item->profiles);
            $item->sn = $item->id;

            $item->name = $item->name ? '<a href="/escort-dashboard/archive-tour-'.strtolower(str_replace(' ','-',$item->name)).'/'.$item->id.'">'.$item->name.' </a>': "NA";
            $item->start_dates = Carbon::parse($item->start_date)->format('d/M/Y');
            $item->end_dates = Carbon::parse($item->end_date)->format('d/M/Y');
            $item->days = Carbon::parse($item->end_date)->diffInDays(Carbon::parse($item->start_date));
            $item->total_cost = $item->price ? $item->price : "NA";
            $item->transaction_Status_Code = $item->transaction_Status_Code ? $item->transaction_Status_Code : "NA";
            foreach(config('escorts.profile.states') as $key => $states) {
                if(in_array($key,$item->location)) {
                    $location[] =  $states['stateName'];
                    $item->locations =  $location;
                }
            }
            foreach($item->profiles as $key => $name) {

                    $profileName[] =  $name['profile_name'];
                    $escortName[] =  $name['name'];
                    $item->pro_name =  $profileName;
                    $item->escort_name = $escortName;

            }
            //dd($item->escort_name);
            // foreach(config('escorts.profile.cities') as $key => $city) {
            //     if(in_array($key,$item->location)) {
            //         $location[] =  $city;
            //         $item->locations =  $location;
            //     }
            // }
           if(!empty(auth()->user()->tour_permissition_type) && in_array(2,auth()->user()->tour_permissition_type)) {
                //$item->action = '<div class="dropdown no-arrow archive-dropdown">
                //<a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                //<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item editTour" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#exampleModal22">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a> <a class="dropdown-item deleteTour" href="#" id="openDeleteTour" data-id='.$item->id.' data-toggle="modal" data-target="#deleteModal22">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a></div>';
               $item->action = '<div class="dropdown no-arrow archive-dropdown">
                    <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 editTour" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#exampleModal22"> <i class="fa fa-fw fa-pen"></i> Edit </a> </div>';
           } else {

                $item->action = '<div class="dropdown no-arrow archive-dropdown">
                <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item  d-flex align-items-center justify-content-start gap-10" id="TourPermission" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#exampleModal22"> <i class="fa fa-fw fa-pen"></i> Edit </a> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 deleteTour" href="#" id="openDeleteTour" data-id='.$item->id.' data-toggle="modal" data-target="#deleteModal22"><i class="fa fa-fw fa-trash"></i> Delete  </a></div>';
           }

            ////////// agentmanage tour list profile_name
            //$item->pro_name = $item->profiles->profile_name ? $item->profiles->profile_name : "N/A";

            $item->agentManage = '<div class="dropdown no-arrow archive-dropdown">
                <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 editTour" id="cdTour" href="#" data-toggle="modal" data-id='.$item->id.' data-target="#exampleModal22"> <i class="fa fa-fw fa-pen"></i> Edit </a> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 deleteTour" href="#" id="openDeleteTour" data-id='.$item->id.' data-toggle="modal" data-target="#deleteModal22"><i class="fa fa-fw fa-trash"></i> Delete  </a></div>';


            ///////end
            $i++;
            $location = [];
            $profileName = [];
            $escortName = [];

        }

        return $result;
    }


    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id = null, $conditions = [])
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model;

        if($user_id){
            $query = $query->where('user_id',$user_id);
        }

        if(count($conditions)>0){
            $query->where($conditions);
        }
            
        if($search) {
            $query->where(function ($q) use ($searchables, $search) {
                foreach ($searchables as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }
            });
        }
        if($order_field=='days_number'){
            $query->orderByRaw("DATEDIFF(end_date, start_date) $dir");
        } 
        else {
            $query->orderBy($order_field, $dir);
        }
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $this->modifyRecords($mainQuery->get(), $start);
        $count =  $query->count();

        return [$result, $count, [$query->toSql(),$query->getBindings()]];
    }

    protected function modifyRecords($result, $start)
    {
        $i = 1;
        $today = Carbon::today()->format('d-m-Y');
        foreach ($result as $key => $item) {
            $item->days_number = $item->days_number;
            $item->status = $item->start_date < $today ?'Current':'Upcoming';
            $is_checkout = $item->tourPurchase->count();
            $action = '<div class="dropdown no-arrow archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">';
            if(empty($is_checkout)){
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('account.checkout_tour', $item->id).'"> <i class="fa fa-location-arrow " ></i> Checkout</a><div class="dropdown-divider"></div>';
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 tourDelete" href="'.route('escort.delete.tour', $item->id).'"> <i class="fa fa-trash" ></i> Delete</a><div class="dropdown-divider"></div>';
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('escort.store.tour', $item->id).'"> <i class="fa fa-pen " ></i> Edit</a>'; 
            }
            else{
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('escort.store.tour', $item->id).'"> <i class="fa fa-eye " ></i> View</a>'; 
            }
            $action .= '</div></div>';
            $item->action = $action;
            $i++;
        }
        return $result;
    }

}
