<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TouchLastOnline
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        // A logged-in user counts as online on every page, updated at most once a minute
        if ($user && Cache::add('last_online_touch:' . $user->id, 1, 60)) {
            DB::table('users')->where('id', $user->id)->update(['last_online_at' => now()]);
        }

        return $next($request);
    }
}