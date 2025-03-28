<?php

namespace App\Repositories\Escort;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Escort;
use Carbon\Carbon;
use DB;

class EscortRepository extends BaseRepository implements EscortInterface
{
    use DataTablePagination;
    protected $escort;

    public function __construct(Escort $escort)
    {
        $this->model = $escort;
    }
    public function limit($to,$from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    public function getlinks($escort_id)
    {
        $next = $this->model
            ->where('id', '>', $escort_id)
            ->first();

        $previous = $this->model
            ->where('id', '<', $escort_id)
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
			->where('user_id', $escort_id)
			->offset($start)
		    ->limit($limit)
		    ->orderBy($order,$dir);
            if($stateId != null) {
                $query = $query->where('state_id',$stateId);
            }

		if($search) {
			foreach ($searchables as $column) {
				if(in_array($column, $this->getColumns())) {
					$query->orWhere($column, 'LIKE', "%{$search}%");
				}
			}
		}

		$result = $query->get();  
       
        
        if($stateId != null) {
            $result = $this->modifyPropertiesforArchives($result);
            $count =  $this->model->where('user_id', $escort_id)->where('state_id',$stateId)->count();

        }
        else {
            $result = $this->modifyProperties($result);
            $count =  $this->model->count();

        }
		
        
		return [$result, $count];
	}

    protected function modifyProperties($result)
    {   
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->key = $key+1;
            $item->profile_name = $item->profile_name ? $item->profile_name :"NA";
            $item->enabled = $item->enabled ? "Active" : "Inactive";
            $item->gender;
            $item->city_name = $item->city ? $item->city->name : null;
           // $item->country_code = $item->state->country_code;
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->start_date)->format('d M Y') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="../escort-profile/'.$item->id.'" data-id="'.$item->id.'">view</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="profile/'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="#" data-id="'.$item->id.'" data-name="'.$item->name.'"  data-city="'.($item->city ? $item->city->name : null).'" data-url="playmates/'.$item->id.'" data-toggle="modal" data-target="#play-mates-modal">Playmates</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete </a> <div class="dropdown-divider"></div></div></div>';
		}
        return $result;
    }
    protected function modifyPropertiesforArchives($result)
    {   
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->key = $key+1;
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
            <a class="dropdown-item delete-center" href="../delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a>
            
          </div>
        </div>';
		}
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

    public function findByPlan($count = null, $str = [], $user_id = null, $escort_id = [])
    {
        //dd($escort_id);
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
        

            
        $play_type = $this->model
                   ->where('enabled', 1);

        if(!empty($escort_id)) {
            $play_type = $play_type
            ->whereIn('id', $escort_id);
        
        }
        
        if($user_id) {
            $play_type = $play_type->whereHas('shortListed', function($q) use($user_id) {
                $q->where('add_to_list.user_id', $user_id);
            });
        }

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
            
                           $q->whereIn('plan_type', [1, 2, 3, 4]);
                           if(!empty($userId)) {
                           
                              $q->where('id', $userId); 
                           }
                           $q->orderBy('plan_type', 'asc');
                       })
                   ->with('user')
                    ->orderBy('membership', 'asc')
                    ->paginate($count ?? 50);

        $collection = $play_type->getCollection();

        $collection = $collection->map(function($item, $key) {
            return $item;
        })->collect();

        $collection = $collection->groupBy(['user' => function($item) {
            return $item->membership;
        }], $preserveKeys = true)->sortKeys();

        $pagination = $play_type->setCollection($collection);

        return $pagination;
    }
    public function findByMassageCentre($count = null,$str = null)
    {
        //dd($str['gender']);
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
        $play_type = $this->model
                   ->where('enabled', 1);
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

    //public function escortsForPlaymates($escort_id, $str)
    public function escortsForPlaymates($escort_id)
    {
        $escort = $this->model->find($escort_id);

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
