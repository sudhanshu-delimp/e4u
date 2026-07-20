<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class EscortAuth
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
        $request->merge([
            'impersonatedId' => 0,
            'isImpersonated' => false,
        ]);
        
       

        if (session()->has('parent_agent_id') && session('switch_for') == 'agent_to_massage' && session('is_impersonated') === true) {
            $allowedActions = config('escorts.impersonate_action_allowed');
             $request->merge([
                'impersonatedId' => session('parent_agent_id'),
                'isImpersonated' => true,
            ]);
            
            if (!in_array(request()->segment(2), $allowedActions) && request()->segment(2) != '') {
                //Log::info('Action: '.request()->segment(2));
                //return redirect()->route('escort.dashboard')->with('error', accessDeniedMsg());
            }
        }

        if (session()->has('parent_user_id') && session('switch_for') == 'admin_to_any' && session('is_impersonated') === true) {
            $request->merge([
                'impersonatedId' => session('parent_user_id'),
                'isImpersonated' => true,

            ]);
        }
        
        if(!$user = auth()->user()) {
            //return redirect()->route('advertiser.login');
            return redirect('/');
        }

        if($user->type != 3) {
            return redirect('/');
        }
        $response = $next($request);

        return $response;
    }
}
