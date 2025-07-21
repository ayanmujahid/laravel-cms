<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Not logged in
        }

        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized access'); // Not admin
        }

        return $next($request);
    }
}