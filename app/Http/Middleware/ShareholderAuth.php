<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ShareholderAuth
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
            //return redirect()->route('shareholder.login');
            return redirect('/');
        }

        if($user->type != 8) {
            return redirect('/');
        }

        return $response;
    }
}
