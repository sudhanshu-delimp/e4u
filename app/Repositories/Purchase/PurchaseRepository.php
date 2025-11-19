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
   
    protected function getOrderPurchase($order_key)
	{
		$columns = ['escort_id','profile_name','location','name','start_date','end_date','days_number','membership','status','fee'];
        return $columns[$order_key];
	}

    public function paginatedList($start, $limit, $order_key, $dir, $columns, $search = null, $user_id, $conditions = [])
    {
        $order_field = $this->getOrderPurchase($order_key);
        $searchables = $this->getSearchableFields($columns);
        $query = $this->model
            ->where($conditions)
            ->whereHas('escort', function($sub_query) use($user_id, $searchables, $search){
                $sub_query->where('user_id', $user_id)
                ->whereNotNull('profile_name');
                if($search) {
                    $sub_query->where(function ($q) use ($searchables, $search) {
                        foreach ($searchables as $column) {
                            $q->orWhere($column, 'LIKE', "%{$search}%");
                        }
                    });
                }
            });
        if (in_array($order_field,['profile_name','name'])) {
            $query->orderBy(
                Escort::select("{$order_field}")->whereColumn('escorts.id', 'purchase.escort_id')->limit(1),$dir
            );
        }
        else if($order_field=='days_number'){
            $query->orderByRaw("DATEDIFF(end_date, start_date) $dir");
        } 
        else {
            $query->orderBy($order_field, $dir);
        }
        $mainQuery = $query->offset($start)->limit($limit);
        $result = $this->modifyEscorts($mainQuery->get(), $start);
        $count =  $query->count();

        return [$result, $count];
    }

    protected function modifyEscorts($result, $start)
    {
        $i = 1;
        $locations = config('escorts.profile.states');
        foreach ($result as $key => $item) {
            $item->escort_id = $item->escort_id;
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
