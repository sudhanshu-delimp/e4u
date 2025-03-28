<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

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
        $response = $next($request);
        // ->header('Access-Control-Allow-Origin', '*')
        // ->header('Access-Control-Allow-Methods', '*')
        // ->header('Access-Control-Allow-Credentials', true)
        // ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
        // ->header('Accept', 'application/json');

        if(!$user = auth()->user()) {
            return redirect()->route('advertiser.login');
        }

        if($user->type != 4) {
            return redirect('/');
        }

        return $response;
    }
}
