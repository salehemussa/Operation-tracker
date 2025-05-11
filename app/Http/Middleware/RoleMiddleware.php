<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
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
        // Check if the user is authenticated
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        // Get the roles assigned to this route
        $roles = $request->route()->getAction('roles') ?? null;

        // Check if roles are defined and if the user has at least one matching role
        if ($roles && auth()->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        // User does not have permission
        abort(403, 'Unauthorized action.');
    }
}
