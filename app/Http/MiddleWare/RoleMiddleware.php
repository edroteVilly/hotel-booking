<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user has the required role
        if ($request->user()->role !== $role) {
            // You can modify the message based on the role or redirect to another page
            abort(403, 'Forbidden: You do not have access to this page.');
        }

        return $next($request);
    }
}
