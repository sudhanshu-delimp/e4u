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
            ->where($conditions)
            ->whereHas('escort', function($sub_query) use($user_id, $searchables, $search){
                $sub_query->where('user_id', $user_id);
                $sub_query->whereNotNull('profile_name');
                if($search) {
                    $sub_query->where('id', 'like', "%{$search}%");
                    foreach ($searchables as $column) {
                        if ($column == 'stage_name') {
                            $column = 'profile_name';
                        }
                        $sub_query->orWhere($column, 'LIKE', "%{$search}%");
                    }
                }
            });
        $result = $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $result = $this->modifyEscorts($result, $start);
            $count =  $query->count();

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
            $item->days_number = $item->days_number;
            $item->status = $item->escort->enabled == 1 ?'Current':'Upcoming';
            $item->location = $locations[$item->escort->state_id]['stateName'];
            [$discount, $rate, $totalAmount] = calculateTotalFee($item->membership, $item->days_number);
            $item->membership = getMembershipType($item->membership);
            $item->fee = formatCurrency($totalAmount);
            $i++;
        }

        return $result;
    }
}
