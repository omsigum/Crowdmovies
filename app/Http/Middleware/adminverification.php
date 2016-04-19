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
      // get the user from Auth if the user has state = 1 then he gets through. else not.
      $user = Auth::guard('web') -> user();
      if ($user -> state != 1) {
        // throw him home
        return "not valid";
      }
        return $next($request);
    }
}
