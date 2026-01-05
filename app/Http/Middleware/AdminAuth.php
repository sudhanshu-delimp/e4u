<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!$user = auth()->user()) {
            return redirect()->route('admin.login');
        }

        //if ($user->type != 1 &&  $user->type != 2) {
        if ($user->type != 1 ) {
            return redirect('/');
        }
        /** You should not access the Admin Sidebar Management tab link */

        if (in_array(request()->segment(2), ["management", "shareholders"]) && in_array($request->segment(3), config('staff.admin_management_url_endpoint'))) {
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;
        
            $sidebar = staffPageAccessPermission($securityLevel, 'sidebar');
            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');
    
            $viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';
            if (isset($sidebar['management']['yesNo']) && $sidebar['management']['yesNo'] == 'no') {
                return redirect()->route('admin.index')->with('error', accessDeniedMsg());
            }
        }

        return $response;
    }
}
