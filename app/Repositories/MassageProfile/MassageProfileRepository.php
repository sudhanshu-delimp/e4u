<?php

namespace App\Repositories\MassageProfile;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\MassageProfile;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class MassageProfileRepository extends BaseRepository implements MassageProfileInterface
{
    use DataTablePagination;
    protected $massage_profile;

    public function __construct(MassageProfile $massage_profile)
    {
        $this->model = $massage_profile;
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
            $next ? route('center.profile.description', $next->id) : '#',
            $previous ? route('center.profile.description', $previous->id) : '#',
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
    
    public function massagePaginated($start, $limit, $order_key, $dir, $columns, $search = null)
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

		$result = $query->where('user_id',Auth::user()->id)->get();
		$result = $this->modifyProperties($result,$start);
		$count =  $this->model->where('user_id',Auth::user()->id)->count();

		return [$result, $count];
	}
    protected function modifyProperties($result,$start)
    {   $i = 1;
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->key =  $start+$i;
            $item->name = $item->name ? $item->name :"NA";
            $item->enabled = $item->enabled ? "Active" : "Inactive";
            $item->gender;
            $item->location = $item->city ? $item->city->name : null;
            $item->phone_number = $item->phone ? $item->phone : null;
           // $item->country_code = $item->state->country_code;
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->start_date)->format('d M Y') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="../center-profile/'.$item->id.'" data-id="'.$item->id.'"><i class="fa fa-fw fa-eye"></i> View </a> <div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="profile/'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'"> <i class="fa fa-fw fa-pen"></i> Edit</a>  <div class="dropdown-divider"></div><a class="dropdown-item delete-center d-flex align-items-center justify-content-start gap-10" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'"> <i class="fa fa-fw fa-trash"></i> Delete</a></div></div>';
            $i++;
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
    public function findByMassageCentre($count = null,$str = null , $userId = null, $gen=null)
    {
        // //dd($str['gender']);
        // $age[] = explode('-',$str['age']);
        // //dd($age);
        // if(!empty($str['age'])) {
        //     $age_min = $age[0][0];
        //     $age_max = $age[0][1];
        // }
        
        
        
        //dd($userId);
       
            $play_type = $this->filter($this->model, $str , $userId, $gen);
        
        
        //$play_type = $this->model->where('enabled', 1);
        // if(!empty($escort_id)) {
        //     $plan_type = $plan_type
        //     ->whereIn('id', $escort_id);
        
        // }
                
        $uid = $str['string'];
        $play_type = $play_type->where(function($q) use ($uid){
            $q->orWhere('name','LIKE',"%$uid%");
            $q->orWhere( function($q) use ($uid){
                $q->whereHas('user', function($q) use ($uid){
        
                    $q->where('member_id', $uid); 
                    
                });
            });
        })
        ->with('user')
        ->paginate($count ?? 50);
        //dd($uid);
        // if(!empty($str['string']))
        // {
        //     $play_type = $play_type->where('name','LIKE',"%$str[string]%");
        //     //->orWhere('name','LIKE','%'.$str)
        // }
        
        
        

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
    
    public function filter($collection, $str = [], $userId, $gen)
    {
        $age[] = explode('-',$str['age']);
        //dd($age);
        if(!empty($str['age'])) {
            $age_min = $age[0][0];
            $age_max = $age[0][1];
        }
      
        
        $mytime = Carbon::now()->format('d-m-Y');
            //dd($mytime);

        $collection = $collection->where('enabled', 1);
        
        if(!empty($str['premises']))
        {
            $building = $str['premises'];
            if($building == 3) {
                $collection = $collection->where('building','=', 3);
            } else {
                $collection = $collection->whereIn('building',[1,2]);
            }
           
            //->orWhere('name','LIKE','%'.$str)
        }
        
        if($price = $str['prices']) {
            
            $collection = $collection->whereHas('massage_services', function($q) use($price) {
                if($price <= 200) { 
                   
                    $q->where('price','<=', $price);
                } else {
                    
                    $q->where('price','>', 200);
                }
            });
        }
        //dd($str['massage_services']);
        if($services = $str['massage_services']) {
            $collection = $collection->whereHas('massage_services', function($q) use($services) {
                //$q->where('massage_services.category_id', 1);
                $q->where('massage_services.service_id', $services);
            });
            //dd($play_type->count());
        }
        if($other_services = $str['other_services']) {
            $collection = $collection->whereHas('massage_services', function($q) use($other_services) {
                $q->where('massage_services.category_id', 2);
                $q->where('massage_services.service_id', $other_services);
            });
            
        }

        if(!empty($gen))
        {
            $collection = $collection->where('gender','=',$gen);
            //->orWhere('name','LIKE','%'.$str)
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
        // if(!empty($str['string']))
        // {
            
        //     $uid = $str['string'];
        //     $collection = $collection->where(function($q) use ($uid){
        //         $q->orWhere('name',$uid);
        //         $q->orWhere( function($q) use ($uid){
        //             $q->whereHas('user', function($q) use ($uid){
            
        //                 $q->where('member_id', $uid); 
                        
        //             });
        //         });
        //     }); 
           
            
        // }
        
        if(!empty($str['city_id']))
        {
            $collection = $collection->where('city_id','=',$str['city_id']);
            //->orWhere('name','LIKE','%'.$str)
        }
        // if($str['gender'] != null )
        // {
            
        //     $collection = $collection->where('gender','=',$str['gender']);
        //     //->orWhere('name','LIKE','%'.$str)
        // }
        // if(!empty($str['age']) )
        // {
            
        //     $collection = $collection->whereBetween('age',[$age_min, $age_max]);
        //     //->orWhere('name','LIKE','%'.$str)
        // }
        
        

        //dd($collection->get()); // massage-centres-list
        if(Auth::user() && Auth::user()->type == 0){
             $collection = $collection
                ->whereDoesntHave('messageViewerInteraction') // no interaction (include bhi karna hai)
                ->orWhereHas('messageViewerInteraction', function ($query) {
                    $query->where('massage_blocked_viewer', '!=', 1); // not blocked
                })
                ->with('messageViewerInteraction');
        }
        

        return $collection;
    }

    public function findByMyMassageShortListed($count = null, $str = [], $user_id = null, $escort_id = [], $userId = null, $gen=null)
    {
        //dd($escort_id);
        $plan_type = $this->filter($this->model, $str , $userId, $gen);
        if($user_id) {
            $plan_type = $plan_type->whereHas('massageShortListed', function($q) use($user_id) {
                $q->where('add_to_massage_sort_list.user_id', $user_id);
            });
        }
        
        if(!empty($escort_id)) {
            $plan_type = $plan_type
            ->whereIn('id', $escort_id);
        
        }
        
        $pagination = $plan_type->paginate($count ?? 50);

        // $collection = $plan_type->getCollection();

        // $collection = $collection->map(function($item, $key) {
        //     return $item;
        // })->collect();

        // $collection = $collection->groupBy(['user' => function($item) {
        //     return $item->membership;
        // }], $preserveKeys = true)->sortKeys();

        // $pagination = $play_type->setCollection($collection);

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

    public function escortsForPlaymates($escort_id, $str)
    {
        $escort = $this->model->find($escort_id);

        $user_id = $escort->user_id;

        $mates = $this->model
                    ->with(['city:id,name'])
                    ->whereNotIn('id', function($q) use($escort_id) {
                        $q->select('playmate_id')
                          ->from('playmates')
                          ->where('escort_id', $escort_id);
                    })
                    ->where(function($query) use ($user_id, $str, $escort_id) {
                        $query->where('name', 'LIKE', "%{$str}%")
                        ->where('id', '!=', $escort_id)
                        ->whereHas('user', function($q) use ($user_id) {
                            $q->where('id', '!=', $user_id);
                        });
                    })
                    ->whereHas('city', function($q) use($escort) {
                        $q->where('id', $escort->city_id);
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

    public function findbysetting($id)
	{
        $result = $this->model->where('id',$id)
                        ->where('default_setting',1)
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
