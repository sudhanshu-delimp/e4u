<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserInterface;

class ConsolesController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
       $this->user = $user;
    }
    public function consoles()
    {
        return view('admin.Analytics.consoles');
    }
    public function allUserDatatable()
    {
        //dd($this->user->onlineUser());
        list($user, $count) = $this->user->paginatedByConsole(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $user,
        );
        //dd($data);
        return response()->json($data);
    }
}
