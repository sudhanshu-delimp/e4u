<?php

namespace App\Repositories\AgentBank;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\AgentBankDetail;
use Carbon\Carbon;
use DB;

class AgentBankDetailRepository extends BaseRepository implements AgentBankDetailInterface
{
    use DataTablePagination;
    protected $agentBankDetail;

    public function __construct(AgentBankDetail $agentBankDetail)
    {
        $this->model = $agentBankDetail;
    }
    public function limit($to,$from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    public function paginatedByAgentBankDetail($start, $limit, $order_key, $dir, $columns, $search = null, $user_id)
	{

        $order = $this->getOrder($order_key);

		$searchables = $this->getSearchableFields($columns);
        $query = $this->model
			->where('user_id', $user_id)
			->offset($start)
		    ->limit($limit)
		    ->orderBy('state',$dir);

		if($search) {
			foreach ($searchables as $column) {
				if(in_array($column, $this->getColumns())) {
					$query->orWhere($column, 'LIKE', "%{$search}%");
				}
			}
		}

		$result = $query->get();
       //dd($result);
        $result = $this->modifyProperties($result,$start);
		$count =  $this->model->where('user_id', $user_id)->get()->count();


		return [$result, $count];
	}

    protected function modifyProperties($result,$start)
    {   $i = 1;
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            // $item->sn = ($i+$start);
            $item->bank_name = $item->bank_name ? $item->bank_name : "NA";
            $item->account_name = $item->account_name ? $item->account_name : "NA";
            $item->bsb = $item->bsb ? $item->bsb : 'NA';
            $item->account_numbers = $item->account_number ?  str_pad(substr($item->account_number, -3), strlen($item->account_number), '*', STR_PAD_LEFT) : "NA";
            $item->states = $item->state == 1 ? "Primary Account" : "Secondary Account";
            $item->action = '<div class="dropdown no-arrow"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"><a class="dropdown-item editModal" href="#" data-id="'.$item->id.'" data-bank_name="'.$item->bank_name.'" data-bsb="'.$item->bsb.'" data-ac_number="'.$item->account_number.'" data-state="'.$item->state.'"data-url="bank_account/'.$item->id.'" data-toggle="modal" data-target="#commission-report" data-ac_name="'.$item->account_name.'" id="edit_'.$item->id.'">Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item delete_bankModal" href="delete-agent-bank/'.$item->id.'" data-id="'.$item->id.'" data-target="#delete_bnak">Delete </a> <div class="dropdown-divider"></div></div></div>';
            $i++;
		}
        return $result;
    }
    public function updatebyState($user_id,$id)
	{
        $result = $this->model->where('user_id',$user_id)
                        ->where('id','!=',$id)
                        ->update(['state'=>2]);
                        //dd($result);
		return $result;
		// return ! $result ? $this->create($input) : $result->update($input);
	}
    public function findByState($user_id)
	{
        $result = $this->model->where('user_id',$user_id)
                        ->where('state',1)->count();
                        //dd($result);
		return $result;
		// return ! $result ? $this->create($input) : $result->update($input);
	}

}
