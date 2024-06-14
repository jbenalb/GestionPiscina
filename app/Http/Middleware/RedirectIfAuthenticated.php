<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use App\Models\User; // Importar la clase User
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
    
        // Si la URL es /register
        if ($request->is('register')) {
            // Si el usuario está autenticado
            if (Auth::check()) {
                // Obtener el usuario actual
                $user = $request->user();
                if ($user->hasRole(Role::ADMIN)) {
                    // Si es un administrador, permitir el acceso a la página de registro
                    return $next($request);
                } else {
                    // Si no es un administrador, redirigirlo a la página de inicio
                    return redirect('/home');
                }
            } else {
                // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
                return redirect('/login');
            }
        }
    
        return $next($request);
    }
} 