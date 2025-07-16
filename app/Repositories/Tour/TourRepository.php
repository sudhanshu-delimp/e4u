<?php

namespace App\Repositories\Tour;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Tour;
use App\Models\TourLocation;

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
        //$date = Carbon::now();

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

    public function paginatedAgentEscort($start, $limit, $order_key, $dir, $columns, $search = null)
	{
        $date = Carbon::now();
		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $this->model
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
		$result = $this->modifyProperties1($result);
		$count =  $this->model->count();

		return [$result, $count];
	}

    public function paginatedAgentTyeEscort($start, $limit, $order_key, $dir, $columns, $search = null, $user)
	{
        $date = Carbon::now();
		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $user->agentEscorts()
            ->where('type', 3)
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
		$result = $this->modifyPropertiesTypeEscort($result);
		$count =  $this->model->count();

		return [$result, $count];
	}

    protected function modifyPropertiesTypeEscort($result)
    {


        foreach($result as $key => $item) {
            $item->name = $item->name ? $item->name : null;
            $item->phone = $item->phone ? $item->phone : null;
            $item->gender = $item->gender ? $item->gender : 'Other';
            $item->plan_type = $item->plan_type ? $item->plan_type : null;
            $item->home_state ='NA';
            $item->age = $item->age ? $item->age : null;
            //$item->email = $item->email ? $item->email : null;
            $item->vaccine = "Vaccinated, up to date";
            //$item->time = Carbon::parse($item->created_at)->format('d M Y');
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="/escort-profile/'.$item->id.'" data-id="'.$item->id.'">Edit Escort Profile <img src="../assets/app/img/pencil.png" style="float: right;"></a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <img src="../assets/app/img/delete.png" style="float: right;"></a> <div class="dropdown-divider"></div></div></div>';
        }

        return $result;
    }


    public function findEscort()
    {
        return $this->model->where('type', 3)->get();
    }

    public function search($agent_id, $str = null)
	{
        $agent = $this->model->find($agent_id);

        return $agent->agentEscorts()
            ->orWhere('name',  'LIKE', "%{$str}%")
            ->orWhere('users.id',  '=', "{$str}")
            ->orWhere('phone',  'LIKE', "%{$str}%")
            ->get();
	}

}
