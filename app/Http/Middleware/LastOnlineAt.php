<?php

namespace App\Http\Middleware;
use DB;
use Closure;
class LastOnlineAt
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //dd($request->ipinfo);
        if (auth()->guest()) {
            return $response;

        }

        $user = auth()->user();

        if(null == $user->last_online_at || $user->last_online_at->diffInMinutes(now()) !== 0) {
          $user->last_online_at = now();
          $user->ip = $request->ip();
          $user = $user->save();
        }

        // if ($user->last_online_at->diffInMinutes(now()) !==0) {
        //   $user->last_online_at = now();
        //   $user = $user->save();
        //
        // }

        return $response;
    }
}
