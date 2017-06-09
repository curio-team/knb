<?php

namespace App\Http\Middleware;

use Closure;

class Headmaster
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
        if ( !$request->user()->isHeadMaster() )
        {
            return back()->with('error', 'This feature is only available for headmasters.');
        }
        return $next($request);
    }
}
