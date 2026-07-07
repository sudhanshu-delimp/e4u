<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class CenterAuth
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
       
        // ->header('Access-Control-Allow-Origin', '*')
        // ->header('Access-Control-Allow-Methods', '*')
        // ->header('Access-Control-Allow-Credentials', true)
        // ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
        // ->header('Accept', 'application/json');
        // assign value
        $request->merge([
            'impersonatedId' => 0,
            'isImpersonated' => false,
        ]);
      
        if (session()->has('parent_agent_id') && session('switch_for') == 'agent_to_massage' && session('is_impersonated') === true) {
            $allowedActions = config('center.impersonate_action_allowed');
             $request->merge([
            'impersonatedId' => session('parent_agent_id'),
            'isImpersonated' => true,
            
        ]);


        if (session()->has('parent_massage_id') && session('switch_for') == 'massage_to_massage' && session('is_impersonated') === true) {
            $allowedActions = config('center.impersonate_action_allowed');
             $request->merge([
            'impersonatedId' => session('parent_massage_id'),
            'isImpersonated' => true,
            
        ]);
            
            if (!in_array(request()->segment(2), $allowedActions) && request()->segment(2) != '') {
                //Log::info('Action: '.request()->segment(2));
                //return redirect()->route('center.dashboard')->with('error', accessDeniedMsg());
            }
        }
        if (!$user = auth()->user()) {
            //return redirect()->route('advertiser.login');
            return redirect('/');
        }

        if ($user->type != 4) {
            return redirect('/');
        }
         $response = $next($request);

        return $response;
    }
}
