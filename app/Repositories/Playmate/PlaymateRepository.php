<?php
namespace App\Repositories\Playmate;
use App\Repositories\BaseRepository;
use App\Models\PlaymateHistory;
use App\Traits\DataTablePagination;

class PlaymateRepository  extends BaseRepository implements PlaymateInterface
{
   
    use DataTablePagination;
    public function __construct(PlaymateHistory $playmate)
    {
        $this->model = $playmate;
    }

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id = null, $conditions = [])
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFields($columns);
        $searchables = [];
        $query = $this->model::with('playmate');

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

        $count =  $query->count();
        
        if($order_field=='days_number'){
            $query->orderByRaw("DATEDIFF(end_date, start_date) $dir");
        } 
        else {
            $query->orderBy($order_field, $dir);
        }
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $this->modifyRecords($mainQuery->get(), $start);

        return [$result, $count, [$query->toSql(),$query->getBindings()]];
    }

    protected function modifyRecords($result, $start)
    {
        $i = 1;
        foreach ($result as $key => $item) {
            $item->stage_name = $item->playmate->name.' | '.$item->playmate->user->member_id;
            $item->current_location = config('escorts.profile.states')[$item->user->current_state_id]['stateName'];
            $item->status = $item->status;
            $action = '<div class="dropdown no-arrow archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">';
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('escort.store.tour', $item->id).'"> <i class="fa fa-eye " ></i> View</a>'; 
           
            $action .= '</div></div>';
            $item->action = $action;
            $i++;
        }
        return $result;
    }
}
