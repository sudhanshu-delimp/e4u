<?php

namespace App\Repositories\AttemptLogin;

use App\Repositories\BaseRepository;
use App\Traits\DataTablePagination;
use App\Models\AttemptLogin;
use Carbon\Carbon;
use App\Repositories\User\UserInterface;
use App\Repositories\Escort\EscortInterface;

class AttemptLoginRepository extends BaseRepository implements AttemptLoginInterface
{
    use DataTablePagination;

    protected $attemptlogin;
    protected $user;
    protected $escort;

    public function __construct(AttemptLogin $attemptlogin, UserInterface $user, EscortInterface $escort)
    {
        $this->model = $attemptlogin;
        $this->user = $user;
        $this->escort = $escort;
    }


    protected function modifyProperties($result)
    {

        foreach($result as $key => $item) {
            $user = $this->user->find($item->user_id);
            $item->id = $item->id ? $item->id : null;
            $item->last_online_at = $user ? $user->last_online_at : null;
            $item->ip_address = $item->ip_address ? $item->ip_address : null;
            $item->name = $user ? $user->name : null;
            $item->email = $item->email ? $item->email : null;
            $item->type = $item->type ? "Success" : "Failed";
            $item->device = $item->device ? $item->device : null;
            $item->country = $item->country ? $item->country : null;
            $item->city = $item->city ? $item->city : null;
            $item->time = Carbon::parse($item->created_at)->format('d M Y');
            $item->staff_type =  $user ? $user->type : null;

        }

        return $result;
    }
    public function findby($id)
    {
        
        $result = $this->model->where('user_id',$id)->get();
        return $result;

    }
    public function secondLastlogin($id)
    {
        
        $result = $this->model->where('user_id',$id)->orderBy('id','DESC')->skip(1)->first();
        return $result;

    }


}
