<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
Use App\Models\SupportTickets;

class HeaderInfo
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
        if(auth()->check() && in_array(auth()->user()->type, [0,3,4,5])) {
            $user_id = auth()->user()->id;
            $support_tickets = new SupportTickets();
            $support_tickets = $support_tickets->where('user_id', $user_id)
                ->where('unread', 1)->get();
            \Illuminate\Support\Facades\View::share('support_tickets', $support_tickets);
        }
        return $next($request);
    }
}
