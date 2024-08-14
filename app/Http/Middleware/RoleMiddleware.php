<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        // Split roles by pipe symbol
        $rolesArray = explode('|', $roles);
    
        // Check if the user has any of the specified roles
        if (!$request->user() || !$request->user()->hasRole($rolesArray)) {
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
}

