<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserAuth
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
        
        if(!$user = auth()->user()) {
            //return redirect()->route('advertiser.login');
              return redirect('/');
        }

        if($user->type != 0) {
            
            return redirect('/');
        }

        $response = $next($request);
        return $response;
    }
}
