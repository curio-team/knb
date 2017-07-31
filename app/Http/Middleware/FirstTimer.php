<?php

namespace App\Http\Middleware;

use Closure;

class FirstTimer
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
        if ( !\Auth::user()->confirmed )
        {
            return redirect()->to('/profile/password');
        }
        return $next($request);
    }
}
