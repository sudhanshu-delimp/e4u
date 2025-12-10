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

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id = null, $conditions = [])
    {
        $order_field = $columns[$order_key]['name'];
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model::with('playmate','escort');

        if($user_id){
            $query = $query->where('user_id',$user_id);
        }

        if(count($conditions)>0){
            $query->where($conditions);
        }
            
        if($search) {
            // $query->whereHas('playmate', function($subQuery) use ($searchables, $search){
            //     $subQuery->where(function ($q) use ($searchables, $search) {
            //         foreach ($searchables as $column) {
                    
            //             if(in_array($column,['playmate_stage_name','profile_stage_name'])){
            //                 $column = 'name';
            //             }
            //             $q->orWhere($column, 'LIKE', "%{$search}%");
            //         }
            //     });
            // });
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
            $playmateColumn = "<div class='playmate_group'>
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
                $action .= '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="'.route('profile.description',$item->playmate->id).'"  target="_blank"> <i class="fa fa-eye " ></i> View</a>'; 
           
            $action .= '</div></div>';
            $item->action = $action;
        }
        return $result;
    }
}
