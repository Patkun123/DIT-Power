<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
       if (Auth::check()) {
            // Check if the authenticated user's role matches the required role
            if (Auth::user()->role === $role) {
                return $next($request);
            }
            // User is authenticated but does not have the required role
            return redirect()->route('home');
        }

        // User is not authenticated
        abort(401, 'Unauthenticated.');
    }
}

