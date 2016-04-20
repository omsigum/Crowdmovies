<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class adminverification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user = Auth::guard('api') -> user();
      if ($user -> state == 1) {
        return $next($request);
      }
        return;
    }
}
