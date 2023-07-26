<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado === 'INACTIVO') {
            Auth::logout(); // Cerrar sesión del usuario inactivo
            return redirect()->route('login')->with('error', 'Tu cuenta está inactiva. Contacta al administrador.');
        }

        return $next($request);
    }
}
