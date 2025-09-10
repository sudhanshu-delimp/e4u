<?php

namespace App\Repositories\User;

use Schema;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Escort;
use App\Models\MassageProfile;
use App\Traits\DataTablePagination;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserInterface
{
    use DataTablePagination;
    public $response = [];

    public function __construct(User $model, Escort $escort ,MassageProfile $massage_profile)
    {
        $this->model = $model;
        $this->escort = $escort;
        $this->massage_profile = $massage_profile;
        $this->response = ['status' => false,'message' => ''];
    }
    public function paginatedByUsers($start, $limit, $order_key, $dir, $columns, $search = null)
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

		$result = $this->modifyPropertiesByUsers($result);
		$count =  $this->model->count();

		return [$result, $count];
	}
    public function paginatedByConsole($start, $limit, $order_key, $dir, $columns, $search = null)
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
                    $search_result = $query->orWhere($column, 'LIKE', "%{$search}%");

                    // dd($search_result->count());
					// if(!$search_result) {
                    //     dd("helsdjflk");
                    // }
				}
                // dd($this->getColumns());
			}
		}

		$result = $query->get();

		$result = $this->modifyPropertiesByConsole($result);
		$count =  $this->model->count();

		return [$result, $count];
	}

	// protected function getOrderUser(int $key)
	// {
	// 	$columns = $this->getColumns();

	// 	return $columns[$key];
	// }


    protected function modifyPropertiesByConsole($result)
    {
        //dd($result);
        foreach($result as $key => $item) {
            $item->memberId = $item->member_id ? $item->member_id : 'NA';
            $item->name = $item->name ? $item->name : 'NA';
            $item->usertype = $item->userType ? $item->userType : "NA";
            $item->location = $item->state ? $item->state->name : 'NA';
            $item->sLevel = $item->levelType ? $item->levelType : "NA";
            $item->status = $item->enabled ==1 ? "E" : 'D';

            //$item->time = Carbon::parse($item->created_at)->format('d M Y');
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-id="'.$item->id.'"> <i class="fa-pen fa"></i> Edit</a> <div class="dropdown-divider"></div> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-id="'.$item->id.'"> <i class="fa fa-print"></i> Print Report </a> ';
        }

        return $result;
    }
    protected function modifyPropertiesByUsers($result)
    {
        //dd($result);
        foreach($result as $key => $item) {
            $item->memberId = $item->memberId ? $item->memberId : 'NA';
            $item->name = $item->name ? $item->name : 'NA';
            $item->usertype = $item->UserType ? $item->UserType : "NA";
            $item->location = $item->state ? $item->state->name : 'NA';
            $item->sLevel = $item->LevelType ? $item->LevelType : "NA";
            $item->status = $item->enabled ==1 ? "E" : 'D';

            //$item->time = Carbon::parse($item->created_at)->format('d M Y');
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="/admin-dashboard/change-security-level/'.$item->id.'" data-id="'.$item->id.'"> <i class="fa fa-pen"></i> Change-security-level</a> ';
        }

        return $result;
    }
    // <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <img src="../assets/app/img/delete.png" style="float: right;"></a> <div class="dropdown-divider"></div></div></div>
    public function onlineUser()
    {
        $date = Carbon::now();
        return $this->model->where('last_online_at', '>', $date->modify("-5 minutes")->toDateTimeString())->get();

    }

    public function paginated2($start, $limit, $order_key, $dir, $columns, $search = null)
	{
        $date = Carbon::now();
		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $this->model
            ->where('last_online_at', '>', $date->modify("-5 minutes")->toDateTimeString())
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
		$result = $this->modifyProperties($result);
		$count =  $this->model->count();

		return [$result, $count];
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
		$result = $this->modifyProperties($result);
		$count =  $this->model->count();

		return [$result, $count];
	}

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
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="/escort-profile/'.$item->id.'" data-id="'.$item->id.'"> <i class="fa fa-pen "></i> Edit Escort Profile </a> <div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10 delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'"> <i class="fa fa-trash "></i> Delete</a> <div class="dropdown-divider"></div></div></div>';
        }

        return $result;
    }
    public function paginatedAgentUserEscort($start, $limit, $order_key, $dir, $columns, $search = null, $user)
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
        //$result = $query->where('type', 3)->get();
		$result = $query->get();
		$result = $this->modifyPropertiesUserEscort($result);
		$count =  $query->get()->count();

		return [$result, $count];
	}

    protected function modifyPropertiesUserEscort($result)
    {


        foreach($result as $key => $item) {
            $item->memberId = $item->member_id ? $item->member_id : null;
            $item->name = $item->name ? $item->name : null;
            $item->phone = $item->phone ? $item->phone : null;
            $item->email = $item->email ? $item->email : null;
            $item->contact = $item->contact_type ? $item->ContactType($item->contact_type) : null;
            $item->homeState = $item->homeState ? $item->homeState : null;
            $item->dateEngage = Carbon::parse($item->created_at)->format('d M Y');
            $item->Appointed = Carbon::parse($item->created_at)->format('d M Y');
            $item->earnings =  '200';
            $item->gender = $item->gender ? $item->gender : 'Other';
            $item->plan_type = $item->plan_type ? $item->plan_type : null;
            $item->age = $item->age ? $item->age : null;
            //$item->email = $item->email ? $item->email : null;
            $item->vaccine = "Vaccinated, up to date";
            //$item->dateEngage = Carbon::parse($item->created_at)->format('d M Y');
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
            <a class="dropdown-item" data-name="'.$item->name.'" data-id="'.$item->id.'" id="manage-profile" href="#">Manage Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-name="'.$item->name.'" data-id="'.$item->id.'" id="manage-tour" href="#">Manage Tour</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-id="'.$item->id.'" href="#">Manage Media</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-id="'.$item->id.'" href="#" id="manage-concierge">Manage Concierge &amp; Services</a><div class="dropdown-divider"></div>
            <a class="dropdown-item" data-id="'.$item->id.'" href="#" data-toggle="modal" data-target="#viewticket">Print Report</a>
         </div></div>';
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
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="../escort-profile/'.$item->id.'" data-id="'.$item->id.'" target="_blank">view<i class="fa fa-fw fa-eye" style="float: right;"></i></a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" data-confirm="Are you sure to delete this item?" href="delete-legbox/'.$item->id.'" data-id="'.$item->id.'">Delete <img src="../assets/app/img/delete.png" style="float: right;"></a> <div class="dropdown-divider"></div></div></div>';
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
    public function massageLegboxPaginated($start, $limit, $order_key, $dir, $columns, $search = null ,$user)
	{

		$order = $this->getOrderMassage($order_key);
		$searchables = $this->getSearchableFields($columns);
        //dd($order_key);
		$query = $user->massageCenterLegBox()
			->offset($start)
		    ->limit($limit)
		    ->orderBy($order,$dir);

		if($search) {
			foreach ($searchables as $column) {
				if(in_array($column, $this->getColumnsMassage())) {
					$query->orWhere($column, 'LIKE', "%{$search}%");
				}
			}
		}
        //dd( $this->getColumnsMassage());
		$result = $query->get();
		$result = $this->modifyLegboxProperties($result,$start);
		$count =  $user->massageCenterLegBox->count();

		return [$result, $count];
	}
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
    protected function modifyLegboxProperties($result,$start)
    {   $i = 1;
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->key =  $start+$i;
            $item->name = $item->name ? $item->name :"NA";
            $item->enabled = $item->enabled ? "Active" : "Inactive";
            //$item->gender;
            $item->location = $item->city ? $item->city->name : null;
            //$item->phone_number = $item->phone ? $item->phone : null;
           // $item->country_code = $item->state->country_code;
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->start_date)->format('d M Y') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="../center-profile/'.$item->id.'" data-id="'.$item->id.'" target="_blank">View <i class="fa fa-fw fa-eye" style="float: right;"></i></a> <div class="dropdown-divider"></div><a class="dropdown-item" href="profile/'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a>  <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a> <div class="dropdown-divider"></div></div></div>';
            $i++;
        }
        return $result;
    }


    public function changeUserPassword($data)
    {
        if(auth()->user())
        {
            $user = auth()->user();
            if($user->account_setting && $user->account_setting->is_first_login=='1')
            {
            $user->account_setting->is_first_login = '0';
            
            }    

            $user->account_setting->password_updated_date = date('Y-m-d H:i:s');
            $user->account_setting->save();

            $user->password = Hash::make($data['new_password']);
            $user->save();
            return $this->response = ['status' => true,'message' => 'Password changed successfully!'];
        }
        else
        {
            return $this->response = ['status' => false,'message' => 'Error occured while updating password!'];
        }
    
    }
}
