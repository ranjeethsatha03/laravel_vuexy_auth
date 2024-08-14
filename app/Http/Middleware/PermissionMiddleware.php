<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
{
    if (!Auth::check()) {
        abort(403, 'Unauthorized.');
    }

    $user = Auth::user();

    if (!$user->hasPermission($permission)) {
        abort(403, 'Unauthorized.');
    }

    return $next($request);
}
}

