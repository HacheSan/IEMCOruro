<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        switch (Auth::user()->role) {
            case ('1'):
                return $next($request); //si es administrador continua al HOME
                break;
            case ('2'):
                return redirect('secre'); // si es un usuario normal redirige a la ruta USER
                break;
            case ('3'):
                return redirect('eco'); //si es administrador redirige 
                break;
        }
    }
}
