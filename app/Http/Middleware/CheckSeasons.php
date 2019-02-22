<?php

namespace App\Http\Middleware;

use Closure;
use App\Season;

class CheckSeasons
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
        $seasons = Season::all();
        if ($seasons->isNotEmpty()) {
            return $next($request);
        }
        return redirect('admin')->with('warning', 'No se puede acceder a la página ya que no existen temporadas');
    }
}
