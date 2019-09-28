<?php

namespace App\Http\Middleware;

use Closure;

class CheckActiveSeason
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
        return redirect()->route('home')->with('warning', 'Acceso bloqueado, la temporada todavía no está configurada');
    }
}
