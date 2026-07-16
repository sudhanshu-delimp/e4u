<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AgentAuth
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

        if (session()->has('parent_user_id') && session('switch_for') == 'admin_to_any' && session('is_impersonated') === true) {
            $request->merge([
                'impersonatedId' => session('parent_user_id'),
                'isImpersonated' => true,

            ]);
        }

        $response = $next($request);

        if(!$user = auth()->user()) {
            //return redirect()->route('advertiser.login');
              return redirect('/');
        }
        if (session()->has('parent_agent_id') && session('switch_for') == 'agent_to_massage' && session('is_impersonated') === true) {
              return $response;
        }

        if($user->type != 5) {
            return redirect('/');
        }

        return $response;
    }
}
