<?php

namespace App\Http\Middleware;

use App\Models\SeoMeta;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class ShareSeoData
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
       // return $next($request);
       $routeName = Route::currentRouteName();
       if($routeName){
            $seo = SeoMeta::where('route_name', $routeName)->first();
            if($seo){
                view()->share('seo', $seo);
            }
       }

        return $next($request);
    }
}
