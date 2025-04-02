<?php

namespace App\Repositories\Escort;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Escort;
use App\Models\User;
use Carbon\Carbon;
use DB;

class EscortRepository extends BaseRepository implements EscortInterface
{
    use DataTablePagination;
    protected $escort;
    protected $user;

    public function __construct(Escort $escort,User $user)
    {
        $this->model = $escort;
        $this->user = $user;
    }
    public function limit($to,$from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    public function getlinks($escort_id)
    {
        $next = $this->model
            ->where('id', '>', $escort_id)
            ->whereNotNull('membership')
            ->first();

        $previous = $this->model
            ->where('id', '<', $escort_id)
            ->whereNotNull('membership')
            ->latest()->first();

        return [
            $next ? route('profile.description', $next->id) : '#',
            $previous ? route('profile.description', $previous->id) : '#',
        ];
    }

    public function paginatedByEscortId($start, $limit, $order_key, $dir, $columns, $search = null, $escort_id,$stateId = null)
	{

        $order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);
        $query = $this->model

			->offset($start)
		    ->limit($limit)
		    ->orderBy($order,$dir);

        //$member_type = ['Free','Platinum','Silver','Gold'];
        if($search) {
			foreach ($searchables as $column) {
				if(in_array($column, $this->getColumns())) {
                    // echo "column -:".$column."</br>";
                    // echo "search -:".$search."</br>";
					$query = $query->orWhere($column, 'LIKE', "%{$search}%");
				}

			}
		}
        if($stateId != null) {
            $query = $query->where('state_id',$stateId);
            // $query = $query->where('state_id',$stateId);
        }
		$result = $query->where('user_id', $escort_id)->where('default_setting', '!=', 1)->get();


        // if($stateId != null) {
        //     $result = $this->modifyPropertiesforArchives($result,$start);
        //     $count =  $this->model->where('user_id', $escort_id)->where('city_id',$stateId)->count();

        // }
        // else {
        //     $result = $this->modifyProperties($result);
        //     $count =  $query->count();
        //     //dd($result);
        //     // $count =  $this->model->count();

        // }

	    //$result = $this->modifyProperties($result,$start);
	    $result = $this->modifyPropertiesforArchives($result,$start);
        $count =  $this->model->where('user_id', $escort_id)->where('default_setting', '!=', 1)->where('state_id',$stateId)->count();

		return [$result, $count,$start];
	}
    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id, $conditions = [])
	{

		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $this->model
			->offset($start)
		    ->limit($limit)
            ->with([
                'Brb' => function($query){
                    $query->where('brb_time', '>', date('Y-m-d H:i:s'))->where('active', 'Y')->orderBy('brb_time', 'desc');
                }
            ])
		    ->where($conditions)
		    ->orderBy($order,$dir);
            if($search) {

                foreach ($searchables as $column) {

                    		$query = $query->orWhere($column, 'LIKE', "%{$search}%");

                            // if($query) { echo "ok"; } else { echo "not ok";}
                            //echo $column."</br>";

                    	}
                // if($query->where('profile_name', '!=', null)->Where('profile_name', 'LIKE', "%{$search}%")) {
                //     $query = $query->where('profile_name', '!=', null)
                //         ->Where('profile_name', 'LIKE', "%{$search}%");
                //         //echo "1";
                // }
                // elseif($query->where('name', '!=', null)->Where('phone', 'LIKE', "%{$search}%")) {
                //     $query = $query->where('name', '!=', null)
                //         ->Where('name', 'LIKE', "%{$search}%");
                //        // echo "2";
                // } else {
                //     $query = $query->where('phone', '!=', null)
                //         ->Where('phone', 'LIKE', "%{$search}%");
                //         //echo "3";
                // }


                $result = $query->where('user_id', $user_id)
                ->where('default_setting', '!=', 1)->get();

                $result = $this->modifyEscorts($result,$start);
                $count =  $result->count();
            } else {
                $result = $query->where('user_id', $user_id)
                ->where('default_setting', '!=', 1)->get();

                $result = $this->modifyEscorts($result,$start);
                //$count =  $result->count();
                $count =  $this->model->where('user_id', $user_id)->where($conditions)->where('default_setting', '!=', 1)->count();
            }

		return [$result, $count];
	}





    protected function modifyEscorts($result,$start)
    {   $i = 1;

//        $result = $result->toArray();
        foreach($result as $key => $item) {

            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->sn = ($start+$i);
            $item->name = $item->name ? $item->name :"NA";
            $item->pro_name = $item->profile_name ? $item->profile_name :"NA";
            $item->city_name = $item->city ? $item->city->name : null;
            if($item->enabled ==1) {
                $item->enabled = "Active"; } elseif($item->enabled ==0) {
                    $item->enabled = "Inactive";} else {
                        $item->enabled = "Draft";}
            // $item->gender;
            //
           // $item->country_code = $item->state->country_code;
           // this data for agent: list Adertiser <Manage Profile
            $item->phone = $item->phone ? $item->phone :"NA";
            $item->gender = $item->gender ? $item->gender :"NA";
            $item->membership = $item->membership ? $item->membership :"NA";
            $item->homeState = $item->user ? $item->user->state->iso2 :"NA";
            $item->vaccine = $item->covidreport ? $item->covidreport :"NA";
            $item->actionAgentEscortProfile = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="'.route('profile.description', $item->id).'"  data-id="'.$item->id.'" target="_blank">View</a> <div class="dropdown-divider"></div><a class="dropdown-item" data-user_id="'.$item->user_id.'" href="profile/'.$item->id.'/'.$item->user_id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'" target="_blank">Edit</a>   </div></div>';
            //end list advertiser manage profile data
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->created_at)->format('d M Y H:i A') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";


            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="' . route('profile.description', $item->id) . '" data-id="' . $item->id . '">view</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="' . route('escort.update.profile', $item->id) . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="' . route('escort.delete.profile', $item->id) . '" data-id="' . $item->id . '">Delete </a> <div class="dropdown-divider"></div></div></div>';

            $itemArray = $item->toArray();
            //$item->custom_profile_name = ($itemArray['profile_name'] ? $itemArray['profile_name'] :"NA");
            if($itemArray['brb']) {
                $item->pro_name = $item->pro_name . " <sup title='Brb at ".date('d-m-Y h:i A', strtotime($itemArray['brb'][0]['brb_time']))."' class='brb_icon'>BRB</sup>";
                $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="' . route('profile.description', $item->id) . '" data-id="' . $item->id . '">view</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="' . route('escort.update.profile', $item->id) . '" data-id="' . $item->id . '" data-name="' . $item->name . '" data-category="' . ($item->id) . '">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item brb-inactivate" href="' . route('escort.brb.inactive', $itemArray['brb'][0]['id']) . '" data-id="' . $itemArray['brb'][0]['id'] . '" data-category="' . ($itemArray['brb'][0]['id']) . '">Cancel BRB</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="' . route('escort.delete.profile', $item->id) . '" data-id="' . $item->id . '">Delete </a> <div class="dropdown-divider"></div></div></div>';
            }
            $i++;
        }

        return $result;
    }
    protected function modifyProperties($result,$start)
    {   $i = 1;
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->sn = $i+$start;
            $item->key = $i+$start;
            $item->profile_name = $item->profile_name ? $item->profile_name :"NA";
            $item->name = $item->name ? $item->name :"NA";
            $item->enabled = $item->enabled ?  "Active" : "Inactive";
            $item->status = $item->status ?  "published" : "Draft";
            $item->gender;
            $item->membership = $item->membership ? $item->membershipType : null;
            $item->city_name = $item->city ? $item->city->name : null;
            $item->created_by_date = $item->created_at ? Carbon::parse($item->created_at)->format('d M Y') : null;
           // $item->country_code = $item->state->country_code;
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->start_date)->format('d M Y') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="../escort-profile/'.$item->id.'" data-id="'.$item->id.'">view</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="profile/'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="#" data-id="'.$item->id.'" data-name="'.$item->name.'"  data-city="'.($item->city ? $item->city->name : null).'" data-url="playmates/'.$item->id.'" data-toggle="modal" data-target="#play-mates-modal">Playmates</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete </a> <div class="dropdown-divider"></div></div></div>';
            $i++;
        }

        return $result;
    }
    protected function modifyPropertiesforArchives($result,$start)
    {   //dd($result);
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->key = $key+1+$start;
            $item->profile_name = $item->profile_name ? $item->profile_name :"NA";
            $item->created_by_date = $item->created_at ? Carbon::parse($item->created_at)->format('d M Y') : null;
            //dd( $item->membershipType);
            $item->membership = $item->membership ? $item->membershipType : null;

            $item->enabled = $item->enabled ? "<span class='text-success'>Active</span>" : "Inactive";
           // $item->country_code = $item->state->country_code;

            $item->status = $item->enabled ? "published" : "Draft";
            $item->action = '<div class="dropdown no-arrow show archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="../profile/'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a>
            <a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a>

          </div>
        </div>';
		}
       //dd($result);
        return $result;
    }
    protected function paginateWithCondition($query)
    {
        $result = $query->where('user_id', auth()->user()->id);
        return $result;
    }
    public function FindByUsers($id)
    {
        $result = $this->model->where('user_id', $id)->get();
        return $result;
    }

    public function findByPlan($count = null, $str = [], $user_id = null, $escort_id = [], $userId = null,$gen = null)
    {
        //dd($escort_id);
        $plan_type = $this->filter($this->model, $str , $user_id, $escort_id, $userId,$gen);
        //dd($plan_type->get());
        if($user_id) {
            $plan_type = $plan_type->whereHas('shortListed', function($q) use($user_id) {
                $q->where('add_to_list.user_id', $user_id);
            });
        }
        
        if(!empty($escort_id)) {
            $plan_type = $plan_type
            ->whereIn('id', $escort_id);

        }


        $plan_type = $plan_type->whereHas('user', function($q) use ($userId){

                           //$q->whereIn('plan_type', [1, 2, 3, 4]);
                           if(!empty($userId)) {

                              $q->where('id', $userId);
                           }
                           $q->orderBy('plan_type', 'asc');
                       })
                   ->with('user')
                    ->orderBy('membership', 'asc')
                    ->paginate($count);
                    // ->paginate($count ?? 25);
        //dd($plan_type);
        $collection = $plan_type->getCollection();

        $collection = $collection->map(function($item, $key) {
            return $item;
        })->collect();

        $collection = $collection->groupBy(['user' => function($item) {
            return $item->membership;
        }], $preserveKeys = true)->sortKeys();

        $pagination = $plan_type->setCollection($collection);

        return $pagination;
    }
    public function findByMyShortlist($count = null, $str = [], $user_id = null, $escort_id = [], $userId = null, $gen=null)
    {
        $plan_type = $this->filter($this->model, $str , $user_id, $escort_id, $userId, $gen);
        if($user_id) {
            $plan_type = $plan_type->whereHas('shortListed', function($q) use($user_id) {
                $q->where('add_to_list.user_id', $user_id);
            });
        }

        $pagination = $plan_type->paginate($count ?? 50);



        return $pagination;
    }

    public function filter($collection, $str = [], $user_id, $escort_id, $userId, $gen)
    {
        $age[] = explode('-',$str['age']);
        if(!empty($str['age'])) {
            $age_min = $age[0][0];
            $age_max = $age[0][1];
        }


        $mytime = Carbon::now()->format('d-m-Y');

        $collection = $collection
                   ->where('enabled', 1);
        if(!empty($gen))
        {
            $collection = $collection->where('gender','=',$gen);
            //->orWhere('name','LIKE','%'.$str)
        }

        if(!empty($escort_id)) {
            $collection = $collection
                ->whereIn('id', $escort_id);
        }

        
        if(!empty($str['duration_price']))
        {

            $duration_price = $str['duration_price'];

            $collection = $collection->where( function($q) use ($duration_price){
                $q->whereHas('durations', function($q) use ($duration_price){

                    //$q->with('pivot');
                    if($duration_price == "incall_price"){
                        $q->Where('incall_price', '!=',null);

                    }
                    if($duration_price == "outcall_price"){
                        $q->Where('outcall_price', '!=',null);

                    }
                    if($duration_price == "massage_price"){
                        $q->Where('massage_price', '!=',null);

                    }


                });
            });
        //    dd($collection->get());
        }
        
        if(!empty($str['string']))
        {
            $uid = $str['string'];
            $collection = $collection->where(function($q) use ($uid){
                $q->orWhere('name',$uid);
                $q->orWhere( function($q) use ($uid){
                    $q->whereHas('user', function($q) use ($uid){

                        $q->where('member_id', $uid);

                    });
                });
            });

        }
        
        if(!empty($str['city_id']))
        {
            $collection = $collection->where('city_id','=',$str['city_id']);
            //->orWhere('name','LIKE','%'.$str)
        }
       
        if($str['gender'] != null )
        {

            $collection = $collection->where('gender','=',$str['gender']);
            //->orWhere('name','LIKE','%'.$str)
        }
        if(!empty($str['age']) )
        {

            $collection = $collection->whereBetween('age',[$age_min, $age_max]);
            //->orWhere('name','LIKE','%'.$str)
        }
        if(!empty($str['enabled'])/* && $str['enabled'] == 1*/) {
            $collection = $collection->where('enabled', $str['enabled']);
        } else {
            //$collection = $collection->where('enabled', 0);
        }
        if($price = $str['price']) {
            $collection = $collection->whereHas('services', function($q) use($price) {
                if($price <= 500) {
                    $q->where('price','<=', $price);
                } else {
                    $q->where('price','>', 500);
                }
            });
        }

        if($services = $str['services'])
        {
            $collection = $collection->whereHas('services', function($q) use($services) {
                $q->whereIn('services.id', $services);
            });
        }
        
        return $collection;
    }
    public function findByMassageCentre($count = null,$str = null)
    {
        //dd($str['gender']);
        //dd($str['string']);
        $age[] = explode('-',$str['age']);
        //dd($age);
        if(!empty($str['age'])) {
            $age_min = $age[0][0];
            $age_max = $age[0][1];
        }


        $e4u = substr($str['string'],0,5);
        $userId = "";
        if($e4u == "E4U20") {
            $userId = substr($str['string'],5,6);
            $str['string'] = "";
        }
        $play_type = $this->model->where('enabled', 1);


        if(!empty($str['string']))
        {
            $play_type = $play_type->where('name','LIKE',"%$str[string]%");
            //->orWhere('name','LIKE','%'.$str)
        }

        if(!empty($str['city_id']))
        {
            $play_type = $play_type->where('city_id','=',$str['city_id']);
            //->orWhere('name','LIKE','%'.$str)
        }
        if($str['gender'] != null )
        {

            $play_type = $play_type->where('gender','=',$str['gender']);
            //->orWhere('name','LIKE','%'.$str)
        }
        if(!empty($str['age']) )
        {

            $play_type = $play_type->whereBetween('age',[$age_min, $age_max]);
            //->orWhere('name','LIKE','%'.$str)
        }

        if($price = $str['price']) {
            $play_type = $play_type->whereHas('services', function($q) use($price) {
                if($price <= 500) {
                    $q->where('price','<=', $price);
                } else {
                    $q->where('price','>', 500);
                }
            });
        }

        if($services = $str['services']) {
            $play_type = $play_type->whereHas('services', function($q) use($services) {
                $q->whereIn('services.id', $services);
            });
        }

        $play_type = $play_type->whereHas('user', function($q) use ($userId){

                           //$q->whereIn('plan_type', [1, 2, 3, 4]);
                           if(!empty($userId)) {

                              $q->where('id', $userId);
                           }
                           $q->orderBy('plan_type', 'asc');
                       })
                   ->with('user')
                    ->orderBy('membership', 'asc')
                    ->paginate($count ?? 50);

        // $collection = $play_type->getCollection();

        // $collection = $collection->map(function($item, $key) {
        //     return $item;
        // })->collect();

        // $collection = $collection->groupBy(['user' => function($item) {
        //     return $item->membership;
        // }], $preserveKeys = true)->sortKeys();

        // $pagination = $play_type->setCollection($collection);
        $pagination = $play_type;

        return $pagination;
    }

    public function escortCity($str)
    {
        $city = $this->model
                    ->whereHas('city', function($q) use($str) {
                       $q->where('name', 'LIKE', "%{$str}%");
                    })
                    ->get();

         return $city;
    }

    //public function escortsForPlaymates($escort_id)
    public function escortsForPlaymates($user_id, $str)
    {
        //dd($str);
        $mates = $this->model
                    ->where('name','LIKE','%'.$str.'%')
                    ->where('enabled','=',1)
//                    ->where('playmate','=','Y')
                    //->with(['city:id,name'])
                    ->where(function($query) use ($user_id) {
                        //$query->where('name', 'LIKE', "%{$str}%")
                        //->where('id', '!=', $escort_id)
                       $query ->whereHas('user', function($q) use ($user_id) {
                            $q->where('id', '!=', $user_id)
                            ->where('available_playmate', 1);
                        });
                    })
                    ->orWhere(function($query) use ($str) {
                        //$query->where('name', 'LIKE', "%{$str}%")
                        //->where('id', '!=', $escort_id)
                       $query->whereHas('user', function($q) use ($str) {
                            $q->where('member_id', $str);
                        });
                    })
                    ->whereNotNull('name')
                    ->whereNotIn('id', function($q) use($user_id) {
                        $q->select('playmate_id')
                            ->from('playmates')
                            ->where('user_id', $user_id);
                    })

                    ->get()->append(['default_image', 'member_id']);

        return $mates;
    }
    public function escortsForPlaymates__bkup($user_id, $str)
    {
        $users = $this->user->find($user_id);
        //dd($users);
        $user_id = $escort->user_id;

        $mates = $this->model
                    //->with(['city:id,name'])
                    ->whereNotIn('id', function($q) use($escort_id) {
                        $q->select('playmate_id')
                          ->from('playmates')
                          ->where('escort_id', $escort_id);
                    })
                    ->where(function($query) use ($user_id, $escort_id) {
                        //$query->where('name', 'LIKE', "%{$str}%")
                        //->where('id', '!=', $escort_id)
                       $query ->whereHas('user', function($q) use ($user_id) {
                            $q->where('id', '!=', $user_id)
                            ->where('available_playmate', 1);
                        });

                    })

                    ->get()->append(['default_image', 'member_id']);

        return $mates;
    }

    public function updateOrCreate(array $input, $user_id,$default_setting)
	{
        $result = $this->model->where('user_id',$user_id)
                        ->where('default_setting',$default_setting)
                        ->first();
                        //dd($result);
		return ! $result ? $this->create($input) : $result->update($input);
	}
    public function findDefault($user_id,$default_setting)
	{
        $result = $this->model->where('user_id',$user_id)
                        ->where('default_setting',$default_setting)
                        ->first();
		return  $result;
	}
    public function findandfill()
	{

	}
    public function latest()
	{
        $result = $this->model->latest()->first();
		return  $result;
	}

    // public function addToList($user_id)
	// {
    //     $q = $this->model
    //                 ->whereHas('user', function($q) use ($user_id) {
    //                         $q->where('id', '!=', $user_id);
    //                     });
    //                 })
	// }
}
