<?php

namespace App\Http\Middleware;

use Closure;

class ActiveSeason
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
        if (active_season()) {
            return $next($request);
        }
        return redirect('admin')->with('warning', 'No existe ninguna temporada activa');
    }
}
