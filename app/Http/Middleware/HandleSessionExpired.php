<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleSessionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (TokenMismatchException $e) {

            // Cerrar sesión si existe
            if (Auth::check()) {
                Auth::logout();
            }

            // Invalidar y regenerar sesión
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirigir al login
            return redirect()
                ->route('login')
                ->with('error', 'Tu sesión expiró. Por favor inicia sesión nuevamente.');
        }
    }
}
