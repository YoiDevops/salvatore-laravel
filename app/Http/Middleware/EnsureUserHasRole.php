<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Permite el acceso solo si el usuario autenticado tiene alguno de los
     * roles indicados (comparando contra la columna `nom_rol`).
     *
     * Uso en rutas: ->middleware('role:Administrador')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        $rol = $user ? strtolower(trim((string) $user->nom_rol)) : null;
        $rolesPermitidos = array_map('strtolower', $roles);

        if (! $rol || ! in_array($rol, $rolesPermitidos, true)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
