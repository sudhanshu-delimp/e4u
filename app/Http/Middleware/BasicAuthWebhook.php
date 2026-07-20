<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthWebhook
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next): Response
  {
    $username = 'meetwithme';
    $password = 'currentYear@2025';

    if ($request->getUser() !== $username ||  $request->getPassword() !== $password) {
      return response('Unauthorized', 401)
        ->header('WWW-Authenticate', 'Basic realm="Webhook"');
    }

    return $next($request);
  }
}
