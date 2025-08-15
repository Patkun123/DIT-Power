<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Checker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If logged in and user profile is incomplete
        if ($user && (empty($user->firstname) || empty($user->lastname))) {
            // Allow access to profile completion page
            if (!$request->is('complete-profile')) {
                return redirect()->route('register');
            }
        }

        return $next($request);
    }
}
