<?php

namespace App\Repositories\EscortBank;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\EscortBankDetail;
use Carbon\Carbon;
use DB;

class EscortBankDetailRepository extends BaseRepository implements EscortBankDetailInterface
{
    use DataTablePagination;
    protected $escortBankDetail;

    public function __construct(EscortBankDetail $escortBankDetail)
    {
        $this->model = $escortBankDetail;
    }
    public function limit($to,$from)
    {
        return $this->model->offset($to)->limit($from)->get();
    }

    public function paginatedByEscortBankDetail($start, $limit, $order_key, $dir, $columns, $search = null, $user_id)
	{
        $order = $this->getOrder($order_key);
       

		$searchables = $this->getSearchableFields($columns);
       
        $query = $this->model
			->where('user_id', $user_id)
			->offset($start)
		    ->limit($limit)
		    ->orderBy('state',$dir);
        
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $search = (str_replace('-', '', $search) ?? $search);
            $q->orWhere('bank_name', 'LIKE', "%{$search}%")
            ->orWhere('account_name', 'LIKE', "%{$search}%")
            ->orWhere('bsb', 'LIKE', "%{$search}%")
            ->orWhereRaw(
                "CAST(account_number AS CHAR) LIKE ?",
                ["%{$search}%"]
            );
        });
    }

		$result = $query->get();
      // dd($result);
        $result = $this->modifyProperties($result,$start);
		$count =  $this->model->where('user_id', $user_id)->get()->count();

        // Primary account info (can stay separate)
        $primaryBank = $this->model->where('user_id', $user_id)->where('state', 1)->first();
        $primary_account = $primaryBank ? 1 : 0;
        $primary_bank_acc_id = $primaryBank->id ?? null;
        $bankDetails['primary_bank_bsb'] = $primaryBank->bsb ? formatAccountNumber($primaryBank->bsb ,'bsb') : 'N/A';
        $bankDetails['primary_bank_ac_no'] = $primaryBank->account_number ? formatAccountNumber($primaryBank->account_number ,null) : 'N/A';

		return [$result, $count, $primary_account,$primary_bank_acc_id,$bankDetails];
	}

    protected function modifyProperties($result,$start)
    {   $i = 1;
        foreach($result as $key => $item) {
            $s = explode('/',$_SERVER['REQUEST_URI']);
            // $item->sn = ($i+$start);
            $item->bank_name = $item->bank_name ? $item->bank_name : "NA";
            $item->account_name = $item->account_name ? $item->account_name : "NA";
            $ac = $item->account_number ? $item->account_number : "NA";
            $acBsb = $item->bsb ? $item->bsb : "NA";
            $item->bsb = $item->bsb ? formatAccountNumber($item->bsb ,'bsb') : 'NA';

            $item->account_numbers = $item->account_number ?  str_pad(substr($item->account_number, -3), strlen($item->account_number), '*', STR_PAD_LEFT) : "NA";
            // $item->account_numbers = $item->account_number;
            $item->states = $item->state == 1 ? "Primary Account" : "Secondary Account";
            $item->action = '<div class="dropdown no-arrow text-center"> <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"><a class="dropdown-item d-flex align-items-center gap-10 justify-content-start editModal" href="#" data-id="'.$item->id.'" data-bank_name="'.$item->bank_name.'" data-bsb="'.$acBsb.'" data-ac_number="'.$ac.'"
  data-state="'.$item->state.'"data-url="bank_account/'.$item->id.'" data-toggle="modal" data-target="#commission-report" data-ac_name="'.$item->account_name.'" id="edit_'.$item->id.'"> <i class="fa fa-pen "></i> Edit</a> <div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center gap-10 justify-content-start delete_bankModal" href="delete-escort-bank/'.$item->id.'" data-id="'.$item->id.'" data-target="#delete_bnak"> <i class="fa fa-trash "></i></i> Delete </a><div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start eftClientOption" href="javascript:void(0)"data-target="#EnterPinModal" data-toggle="modal" data-d-id="'.$item->id.'"><i class="fa fa-credit-card" ></i> EFT Client </a></div></div>';
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
