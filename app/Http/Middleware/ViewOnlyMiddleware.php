<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ViewOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        $exceptRoutes = [
             'center.current-listing',
             'center.past-listing',
             'center.all-massager-list',
        ];

        if ($request->routeIs($exceptRoutes)) {
            return $next($request);
        }

        if (auth()->check() && !canManage()) 
        {
                if (!$request->isMethod('get')) {

                    if ($request->ajax()) {

                        return response()->json([
                            'success' => false,
                            'message' => 'You are not authorized to perform this action.'
                        ], 403);

                    }
                   abort(403, 'Unauthorized access.');
                }
        }

        return $next($request);
    }
}
