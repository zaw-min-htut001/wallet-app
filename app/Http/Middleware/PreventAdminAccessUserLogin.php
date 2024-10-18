<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventAdminAccessUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the admin is logged in, prevent access to the user login route
        if (Auth::guard('admin_user')->check()) {
            return redirect(route('admin.dashboard'))->with('error', 'You are already logged in as an admin.');
        }
        return $next($request);
    }
}
