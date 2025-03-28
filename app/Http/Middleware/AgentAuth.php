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
        $response = $next($request);

        if(!$user = auth()->user()) {
            return redirect()->route('advertiser.login');
        }

        if($user->type != 5) {
            return redirect('/');
        }

        return $response;
    }
}
