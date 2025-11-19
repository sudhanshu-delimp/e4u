<?php

namespace App\Repositories\Purchase;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Escort;
use App\Models\Purchase;
use Illuminate\Support\Arr;
use App\Traits\DataTablePagination;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;

class PurchaseRepository extends BaseRepository implements PurchaseInterface
{
    use DataTablePagination;
    protected $escort;
    protected $purchase;
    protected $user;

    public function __construct(Purchase $purchase, Escort $escort, User $user)
    {
        $this->model = $purchase;
        $this->escort = $escort;
        $this->user = $user;
    }
    public function limit($to, $from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    


   
    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id, $conditions = [])
    {

        $order = $this->getOrder($order_key);
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model
            ->offset($start)
            ->limit($limit)
            // ->with([
            //     'latestActivePinup',
            //     'activeUpcomingSuspend',
            //     'brb' => function ($query) {
            //         $query->where('brb_time', '>', Carbon::now('UTC'))->where('active', 'Y')->orderBy('brb_time', 'desc');
            //     },
            // ])
            ->orderBy($order, $dir);

        if ($search) {
            // $query = $query->where($conditions)
            //     ->where('user_id', $user_id)
            //     ->where('default_setting', '!=', 1)
            //     ->where('profile_name', '!=', null)
            //     ->where(function ($query) use ($searchables, $search) {
            //         $query->where('id', 'like', "%{$search}%");
            //         foreach ($searchables as $column) {
            //             if ($column == 'pro_name') {
            //                 $column = 'profile_name';
            //             }
            //             $query = $query->orWhere($column, 'LIKE', "%{$search}%");
            //         }
            //     });
            $result = $query->get();

            $result = $this->modifyEscorts($result, $start);
            $count =  $result->count();
        } else {
            $query = $this->model
            ->where($conditions)
            ->whereHas('escort', function($sub_query) use($user_id){
                $sub_query->where('user_id', $user_id);
                $sub_query->whereNotNull('profile_name');
            });
            $result = $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $result = $this->modifyEscorts($result, $start);
            $count =  $query->count();
        }

        return [$result, $count];
    }

    protected function modifyEscorts($result, $start)
    {
        $i = 1;
        $locations = config('escorts.profile.states');
        foreach ($result as $key => $item) {
            $item->id = $item->escort_id;
            $item->profile_name = $item->escort->profile_name;
            $item->stage_name = $item->escort->gender=='Transgender'?'TS - '.$item->escort->name:$item->escort->name;
            $item->membership = $item->escort->membership ? $item->escort->membershipType : "NA";
            $item->days_number = $item->days_number;
            $item->status = $item->escort->enabled == 1 ?'Current':'Upcoming';
            $item->location = $locations[$item->escort->state_id]['stateName'];
            $i++;
        }

        return $result;
    }
}
