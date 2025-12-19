<?php
namespace App\Repositories\Playmate;
use App\Repositories\BaseRepository;
use App\Models\PlaymateHistory;
use App\Models\Escort;
use App\Traits\DataTablePagination;

class PlaymateRepository  extends BaseRepository implements PlaymateInterface
{
   
    use DataTablePagination;
    public function __construct(PlaymateHistory $playmate)
    {
        $this->model = $playmate;
    }
    
    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $escort_id = null, $conditions = [])
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model::with('playmate','escort');

        if($escort_id){
            $query = $query->where('escort_id',$escort_id);
        }

        if(count($conditions)>0){
            $query->where($conditions);
        }
            
        if($search) {
            $query->where(function ($query) use ($searchables, $search) {

                // Search in playmate relation
                $query->whereHas('playmate', function ($subQuery) use ($searchables, $search) {
                    $subQuery->where(function ($q) use ($searchables, $search) {
                        foreach ($searchables as $column) {
            
                            if (in_array($column, ['playmate_stage_name', 'profile_stage_name'])) {
                                $column = 'name';
                            }
            
                            $q->orWhere($column, 'LIKE', "%{$search}%");
                        }
                    });
                });
            
            });
        }

        $count =  $query->count();
        
        if (in_array($order_field,['name'])) {
            $query->orderBy(
                Escort::select("{$order_field}")->whereColumn('escorts.id', 'playmate_history.playmate_id')->limit(1),$dir
            );
        }
        else {
            $query->orderBy($order_field, $dir);
        }
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $this->modifyRecords($mainQuery->get(), $start);

        return [$result, $count, [$query->toSql(),$query->getBindings()]];
    }

    protected function modifyRecords($result)
    {
        foreach ($result as $key => $item) {
            $playmateImage = $item->playmate->DefaultImage ? asset($item->playmate->DefaultImage) : asset('avatars/default/default_escort.png');
            $playmateColumn = "
            <div class='playmate_group'>
            <div class='playmate_col'>
            <div class='playmate_avatart'>
            <img src='".$playmateImage."'>
            <span class='playmate_tooltip'>Membership ID: {$item->playmate->user->member_id}</span>
            </div>
            <div class='playmate_link'>
            <a href='".route('profile.description',$item->playmate->id)."' target='_blank'>{$item->playmate->name}</a>
            <span class='playmate_tooltip'>Click here to view Playmate detail.</span>
            </div>
            </div>
            </div>";
            $item->playmate_stage_name = $playmateColumn;
            $profileImage = $item->escort->DefaultImage ? asset($item->escort->DefaultImage) : asset('avatars/default/default_escort.png');
            $profileColumn = "<div class='playmate_group'>
            <div class='playmate_col'>
            <div class='playmate_avatart'>
            <img src='".$profileImage."'>
            </div>
            <div class='playmate_link'>
            <a href='".route('escort.update.profile', $item->escort->id)."' target='_blank'>{$item->escort->name}</a>
            <span class='playmate_tooltip'>Click here to update you Profile detail.</span>
            </div>
            </div>
            </div>";
            $item->profile_stage_name = $profileColumn;
            $item->current_location = config('escorts.profile.states')[$item->playmate->user->current_state_id]['stateName'];
            $item->status = $item->status;
            $action = '<div class="dropdown no-arrow archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">';
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 trash-playmate" id="cdTour" href="#" data-id="'.$item->id.'"> <i class="fa fa-trash " ></i> Remove</a>'; 
           
            $action .= '</div></div>';
            $item->action = $action;
        }
        return $result;
    }

    public function paginatedGroupedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id = null, $conditions = [])
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model::select('escort_id')->groupBy('escort_id');

        if($user_id){
            $query = $query->where('user_id',$user_id)->whereHas('escort.playmates');
        }

        if(count($conditions)>0){
            $query->where($conditions);
        }
            
        if($search) {
            $query->where(function ($query) use ($searchables, $search) {
                // Search in playmate relation
                $query->whereHas('escort', function ($subQuery) use ($searchables, $search) {
                    $subQuery->where(function ($q) use ($searchables, $search) {
                        foreach ($searchables as $column) {
                            if (in_array($column, ['playmate_stage_name', 'profile_stage_name'])) {
                                $column = 'name';
                            }
                            $q->orWhere($column, 'LIKE', "%{$search}%");
                        }
                    });
                });
            
            });
        }

        $count =  $query->count();
        
        if (in_array($order_field,['name'])) {
            $query->orderBy(
                Escort::select("{$order_field}")->whereColumn('escorts.id', 'playmate_history.escort_id')->limit(1),$dir
            );
        }
        else {
            $query->orderBy($order_field, $dir);
        }
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $this->modifyGroupedRecords($mainQuery->get(), $start);
        return [$result, $count, [$query->toSql(),$query->getBindings()]];
    }

    protected function modifyGroupedRecords($result)
    {
        foreach ($result as $key => $item) {
            $item->playmates = $this->getPlaymates($item->escort->id);
            $profileImage = $item->escort->DefaultImage ? asset($item->escort->DefaultImage) : asset('avatars/default/default_escort.png');
            $profileColumn = "<div class='playmate_group'>
            <div class='playmate_col'>
            <div class='playmate_avatart'>
            <img src='".$profileImage."'>
            </div>
            <div class='playmate_link'>
            <a href='".route('escort.update.profile', $item->escort->id)."' target='_blank'>{$item->escort->name}</a>
            <span class='playmate_tooltip'>Click here to update you Profile detail.</span>
            </div>
            </div>
            </div>";
            $item->profile_stage_name = $profileColumn;
            $action = '<div class="dropdown no-arrow archive-dropdown">
            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'; 
            $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="#" data-toggle="modal" data-target="#playmates_operations" data-escort-id="'.$item->escort->id.'"  data-state-id="'.$item->escort->state_id.'"> <i class="fa fa-plus" ></i> Add Playmates</a>';     
            $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="#" data-toggle="modal" data-target="#playmates_listings" data-escort-id="'.$item->escort->id.'"> <i class="fa fa-eye" ></i> Playmates List</a>'; 
            $action .= '</div></div>';
            $item->action = $action;
        }
        return $result;
    }

    public function getPlaymates($escort_id){
        $escort = Escort::find($escort_id);
        $playmateColumn = "<div class='d-flex justify-content-start gap-10 align-items-center flex-wrap'>";
        $items = $escort->playmateHistory->where('is_deleted','0');
        if($items->count() > 0){
            foreach($items as $history){
            $playmateImage = $history->playmate->DefaultImage ? asset($history->playmate->DefaultImage) : asset('avatars/default/default_escort.png');
            $playmateColumn .= "<div class='playmate_group'>
            <div class='playmate_col'>
            <div class='playmate_avatart'>
            <img src='".$playmateImage."'>
            <span class='playmate_tooltip'>Membership ID: {$history->playmate->user->member_id}</span>
            </div>
            <div class='playmate_link'>
            <a href='".route('profile.description',$history->playmate_id)."' target='_blank'>{$history->playmate->name}</a>
            <span class='playmate_tooltip'>Click here to view Playmate detail.</span>
            </div>
            </div>
            </div>";
            }
        }
        $playmateColumn .= "</div>";
        return $playmateColumn;
    }

    public function trashPlaymateHistory(int $escortId, int $playmateId): void
    {
        $this->model::where(function ($q) use ($escortId, $playmateId) {
                $q->where('escort_id', $escortId)
                ->where('playmate_id', $playmateId);
            })
            ->orWhere(function ($q) use ($escortId, $playmateId) {
                $q->where('escort_id', $playmateId)
                ->where('playmate_id', $escortId);
            })
            ->update(['is_deleted' => '1']);
    }
}
