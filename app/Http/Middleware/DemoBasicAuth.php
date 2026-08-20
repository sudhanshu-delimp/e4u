<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Log::info('DemoBasicAuth', [
        //     'url' => $request->fullUrl(),
        //     'user' => $request->getUser(),
        //     'password' => $request->getPassword(),
        // ]);

        // $username = 'meetwithme';
        // $password = 'currentYear@2025';

        // if ($request->getUser() !== $username || $request->getPassword() !== $password) {
        //     return response('Unauthorized', 401)
        //         ->header('WWW-Authenticate', 'Basic realm="Demo Area"');
        // }

        // return $next($request);

        if (session()->get('demo_authenticated') === true) {
            return $next($request);
        }

        $username = 'meetwithme';
        $password = 'currentYear@2025';

        // Check Basic Auth credentials
        if (
            $request->getUser() === $username &&
            $request->getPassword() === $password
        ) {
            session()->put('demo_authenticated', true);

            return $next($request);
        }

        return response('Unauthorized', 401)
            ->header('WWW-Authenticate', 'Basic realm="Demo Area"');
    }
}
