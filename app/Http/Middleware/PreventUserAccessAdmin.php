<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventUserAccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is logged in as a regular user, redirect them to the user dashboard
        if (Auth::guard('web')->check()) {
            return redirect(route('dashboard'))->with('error', 'Access denied.');
        }
        return $next($request);
    }
}
