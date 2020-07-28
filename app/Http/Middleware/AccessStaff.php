<?php

namespace App\Http\Middleware;

use Closure;

class AccessStaff
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
        if(Auth::user()->hasAnyRole('Staff')){
            return $next($request);
        }
        return response('You are not admin', 403);
    }
}
