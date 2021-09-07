<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSecre
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
        switch(Auth::user()->role){
            case ('1'):
                return redirect('admin');//si es administrador redirige al HOME
            break;
            case('2'):
                return $next($request);// si es un moderador  continua ruta MODe
            break;  
            case ('3'):
                return redirect('eco');//si es administrador redirige al moderador
            break;
        }

    }
}
