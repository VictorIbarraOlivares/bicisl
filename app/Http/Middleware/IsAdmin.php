<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Laracasts\Flash\Flash;

class IsAdmin
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
        //dd(Auth::user()); para ver si esta bien, usar esto primero
        if(Auth::user()->type_id != 2){
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                //flash('No tienes permiso para acceder','warning');
                Flash::warning(Auth::user()->name. ' no tienes permiso para acceder !');
                return redirect()->to('home');//cierra la sesion del usuario si intenta ingresar a las partes de admin
            }
        }   
        return $next($request);
    }

}
