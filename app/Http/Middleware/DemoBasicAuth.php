<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DemoBasicAuth
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
        $username = 'meetwithme';
        $password = 'currentYear@2025';
        if(isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            return $next($request);
        }
        if ($request->getUser() !== $username || $request->getPassword() !== $password) {
            return response('Unauthorized', 401)
                ->header('WWW-Authenticate', 'Basic realm="Demo Area"');
        }
    
        return $next($request);
    }
}
