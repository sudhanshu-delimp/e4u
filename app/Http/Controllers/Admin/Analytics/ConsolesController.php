<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserInterface;

class ConsolesController extends Controller
{
    protected $user;
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;

    public function __construct(UserInterface $user)
    {
       $this->user = $user;
       $this->middleware(function ($request, $next) {

            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');
            $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            if (isset($this->sidebar['management']['yesNo']) && $this->sidebar['management']['yesNo'] == 'no') {
                return response()->redirectTo('/admin-dashboard/dashboard')->with('error', __(accessDeniedMsg()));
            }

            return $next($request);
        });
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
            $this->editAccessEnabled
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
