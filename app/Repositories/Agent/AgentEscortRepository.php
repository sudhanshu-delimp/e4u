<?php

namespace App\Repositories\Agent;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\Escort;
use Carbon\Carbon;
use DB;

class AgentEscortRepository extends BaseRepository implements AgentEscortInterface
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

    public function paginatedByEscortId($start, $limit, $order_key, $dir, $columns, $search = null, array $escort_id)
	{

        $order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);
        $query = $this->model
			->whereIn('user_id', $escort_id)
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
		$count =  $this->model->whereIn('user_id', $escort_id)->get()->count();

        
		return [$result, $count];
	}

    protected function modifyProperties($result)
    {   
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            $item->key = $key+1;
            $item->enabled = $item->enabled ? "Active" : "Inactive";
            $item->gender;
            $item->city_name = $item->city ? $item->city->name : null;
            //$item->country_code = $item->state->country_code;
            $item->start_date_parsed = $item->created_at ? Carbon::parse($item->start_date)->format('d M Y') : null;
            $item->joined = $item->joined ? "<span class='times_circle_icon'><i class='far fa-check-circle'></i>
            </span>" : "<span class='check_circle_icon'><i class='far fa-times-circle'></i></span>";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="../escort-profile/'.$item->id.'" data-id="'.$item->id.'">view</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="profile/'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" data-category="'.($item->id).'">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item" href="#" data-id="'.$item->id.'" data-name="'.$item->name.'"  data-city="'.($item->city ? $item->city->name : null).'" data-url="playmates/'.$item->id.'" data-toggle="modal" data-target="#play-mates-modal">Playmates</a> <div class="dropdown-divider"></div><a class="dropdown-item delete-center" href="delete-profile/'.$item->id.'" data-id="'.$item->id.'">Delete </a> <div class="dropdown-divider"></div></div></div>';
		}
        return $result;
    }

    protected function paginateWithCondition($query)
    {
        $result = $query->where('user_id', auth()->user()->id);
        return $result;
    }

    public function findByPlan($count = null)
    {
        $play_type = $this->model
                   //->where('enabled', 1)
                   ->whereHas('user', function($q){
                       $q->whereIn('plan_type', [1, 2, 3, 4])
                       ->orderBy('plan_type', 'asc');
                   })
                   ->with('user')
                   ->paginate($count ?? 50);

        $collection = $play_type->getCollection();

        $collection = $collection->map(function($item, $key) {
            return $item;
        })->collect();

        $collection = $collection->groupBy(['user' => function($item) {
            return $item->user->plan_type;
        }], $preserveKeys = true)->sortKeys();

        $pagination = $play_type->setCollection($collection);

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
}
