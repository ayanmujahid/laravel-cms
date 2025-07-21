<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
  public function handle(Request $request, Closure $next, $roleId): Response
    {
        if (!auth()->check() || auth()->user()->role_id != $roleId) {
            return redirect()->route('home') // or any route you prefer
                ->with('notify_error', 'Access denied. You are not authorized to view this page.');
        }

        return $next($request);
    }
}