<?php

namespace App\Repositories\Pricing;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Pricing;
use App\Models\User;
use App\Models\Escort;
use App\Models\MassageProfile;
use Carbon\Carbon;
use Schema;

class PricingRepository extends BaseRepository implements PricingInterface
{
    use DataTablePagination;
    public function __construct(Pricing $pricing,User $model, Escort $escort ,MassageProfile $massage_profile)
    {
        $this->model = $pricing;

    }
    public function paginatedPricingList($start, $limit, $order_key, $dir, $columns, $search = null)
	{

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

		$result = $this->modifyPropertiesOfPricing($result,$start);

		$count =  $this->model->count();

		return [$result, $count];
	}


	// protected function getOrderUser(int $key)
	// {
	// 	$columns = $this->getColumns();

	// 	return $columns[$key];
	// }



    protected function modifyPropertiesOfPricing($result,$start)
    {
        //dd($result);member_id
        $i = 1;
        foreach($result as $key => $item) {
            $item->sn =  ($i+$start);
            $item->member_type = $item->memberships ? $item->memberships->name : 'NA';
            if($item->memberships->name == "Free") {
                $item->frequency_day = $item->frequency ? $item->frequency ." Days": 'NA';
            } else {
                $item->frequency_day = $item->frequency ? $item->frequency : 'NA';
            }
            if( $item->days == 1) {
                    $item->rate = $item->days ? "Per day" : "N/A";
            }
            elseif( $item->days == 2) {
                    $item->rate = $item->days ? "Per week" : "N/A";
            }
            else {
                    $item->rate = $item->days ? "Per Service" : "N/A";
            }

            // $item->days = $item->days == 1 ? "per day" : "per week";
            $item->prices = $item->price ? "$".$item->price : 'NA';
            $item->percentage = $item->percentage ? $item->percentage : "N/A";
            // $percent = $item->percentage*$item->price/100;
            // $item->discount_amount = $item->price - $percent;
            if($item->percentage == 'N/A' || $item->percentage == '0.00') {
                $item->discount_amounts = "$".$item->price;
            } else {
                $item->discount_amounts = $item->discount_amount ? "$".$item->discount_amount : 'N/A';
            }


            //$item->time = Carbon::parse($item->created_at)->format('d M Y');
            $item->action = '<div class="dropdown no-arrow text-center"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-id="'.$item->id.'" data-membershipName="'.$item->member_type.'" data-frequency="'.$item->frequency.'" data-days="'.$item->days.'" data-per="'.$item->percentage.'" data-price="'.$item->price.'" data-discount_amount="'.$item->discount_amount.'" data-target="#pricing-detail" data-toggle="modal"> <i class="fa fa-fw fa-pen "></i> Edit </a> ';
            $i++;
        }

        return $result;
    }
    // <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <img src="../assets/app/img/delete.png" style="float: right;"></a> <div class="dropdown-divider"></div></div></div>
    // <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <img src="../assets/app/img/delete.png" style="float: right;"></a>



    public function paginatedAgentTyeEscort($start, $limit, $order_key, $dir, $columns, $search = null, $user)
	{
        $date = Carbon::now();
		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $user->agentEscorts()
            // ->where('type', 3)
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
        $result = $query->where('type', 3)->get();
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
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="/escort-profile/'.$item->id.'" data-id="'.$item->id.'"><i class="fa fa-fw fa-pen "></i> Edit Escort Profile </a> <div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'"> <i class="fa fa-trash"></i> Delete</a> <div class="dropdown-divider"></div></div></div>';
        }

        return $result;
    }
    protected function modifyProperties($result)
    {

        foreach($result as $key => $item) {
            $item->staff_status = $item->enabled ? "Acitve " : "Inactive";
            $item->id = $item->id ? $item->id : null;
            $item->last_online_at = $item->last_online_at ? $item->last_online_at : null;
            $item->ip_address = $item->ip ? $item->ip : null;
            $item->staff_name = $item->name ? $item->name : null;
            //$item->email = $item->email ? $item->email : null;
            $item->staff_type = $item->role_type ? $item->role_type : null;
            $item->device = $item->device ? $item->device : null;
            // $item->country = $item->country ? $item->country : null;
            // $item->city = $item->city ? $item->city : null;
            $item->time = Carbon::parse($item->created_at)->format('d M Y');

        }

        return $result;
    }
    public function paginatedLegboxEscort($start, $limit, $order_key, $dir, $columns, $search = null, $user)
	{
        $date = Carbon::now();
		$order = $this->getOrderEscorts($order_key);
		$searchables = $this->getSearchableFields($columns);
        //dd($searchables);
        $query = $user->myLegBox()
            //->where('type', 3)
            ->offset($start)
		    ->limit($limit)
		    ->orderBy($order,$dir);

		if($search) {
			foreach ($searchables as $column) {

				if(in_array($column, $this->getColumnsEscort())) {
                    //echo "co-:".$column."<pre>";
                    //print_r($this->getColumnsEscort());
				// if(in_array($column, $this->getColumnsEscort())) {
					$query->orWhere($column, 'LIKE', "%{$search}%");
				}
			}
            //dd($this->getColumnsEscort());
		}
        //dd("skdfjlk");
		$result = $query->get();
        //dd($result);
		$result = $this->modifyPropertiesLegbox($result);
		$count =  $result->count();

		return [$result, $count];
	}
    protected function getColumnsEscort()
	{
		//dd(Schema::getColumnListing($this->escort->getTable()));
		return Schema::getColumnListing($this->escort->getTable());
	}
    protected function getOrderEscorts(int $key)
	{
		$columns = $this->getColumnsEscort();

		return $columns[$key];
	}
    protected function modifyPropertiesLegbox($result)
    {
        $i =1;
        //dd($result);
        foreach($result as $key => $item) {
            $item->key = $i;
            $item->name = $item->name ? $item->name : null;
            $item->city_name = $item->city ? $item->city->name : null;
            $item->type = $item->gender;
            $item->phone = $item->phone ? $item->phone : null;
            $item->email = $item->user ? $item->user->email : null;
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="../escort-profile/'.$item->id.'" data-id="'.$item->id.'" target="_blank"><i class="fa fa-fw fa-eye"></i> view</a> <div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center delete-center" data-confirm="Are you sure to delete this item?" href="delete-legbox/'.$item->id.'" data-id="'.$item->id.'"> <i class="fa fa-trash"></i> Delete</a> <div class="dropdown-divider"></div></div></div>';
            // $item->country = $item->country ? $item->country : null;
            // $item->city = $item->city ? $item->city : null;
            //$item->time = Carbon::parse($item->created_at)->format('d M Y');
            $i++;

        }

        return $result;
    }

    public function findEscort()
    {
        return $this->model->where('type', 3)->get();
    }
    public function findPlaymates($id)
    {
        return $this->model
                        ->where('available_playmate', 1)
                        ->where('id','!=', $id)
                        ->get();
    }
    // public function findPlaymates($available_playmate,$id)
    // {
    //     return $this->model->where('type', 3)->get();
    // }

    public function search($agent_id, $str = null)
	{
        $agent = $this->model->find($agent_id);

        return $agent->agentEscorts()
            ->orWhere('name',  'LIKE', "%{$str}%")
            ->orWhere('users.id',  '=', "{$str}")
            ->orWhere('phone',  'LIKE', "%{$str}%")
            ->get();
	}
    // public function escortsForPlaymates($escort_id, $str)
    // {
    //     $escort = $this->model->find($escort_id);

    //     $user_id = $escort->user_id;

    //     $mates = $this->model
    //                 //->with(['city:id,name'])
    //                 ->whereNotIn('id', function($q) use($escort_id) {
    //                     $q->select('playmate_id')
    //                       ->from('playmates')
    //                       ->where('escort_id', $escort_id);
    //                 })
    //                 ->where(function($query) use ($user_id, $str, $escort_id) {
    //                     $query->where('name', 'LIKE', "%{$str}%")
    //                     //->where('id', '!=', $escort_id)
    //                     ->whereHas('user', function($q) use ($user_id) {
    //                         $q->where('id', '!=', $user_id);
    //                     });
    //                 })

    //                 ->get()->append(['default_image', 'member_id']);

    //     return $mates;
    // }

    protected function getColumnsMassage()
	{
		//dd(Schema::getColumnListing($this->massage_profile->getTable()));
		return [
            0 => 'id',
            1 => 'name',
        ];
	}
    protected function getOrderMassage(int $key)
	{
		$columns = $this->getColumnsMassage();

		return $columns[$key];
	}

}
