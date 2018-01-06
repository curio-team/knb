<?php

namespace App\Http\Middleware;

use Closure;

class Editor
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
        if ( !$request->user()->isHeadMaster() && !$request->user()->isEditor() )
        {
            return back()->with('error', 'This feature is only available for headmasters and editors.');
        }
        return $next($request);
    }
}