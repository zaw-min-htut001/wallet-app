<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function create(): View
    {
        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if(! Auth::guard('admin_user')->attempt($request->only('email', 'password'), $request->boolean('remember')))
        {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Fetch the authenticated admin user
        $user = Auth::guard('admin_user')->user();
        if ($user) {
            $user->update([
                'ip' => $request->getClientIp(), // Update IP address
                'user_agent' => $request->header('User-Agent'), // Update device user agent
            ]);
        }
        return redirect()->intended(RouteServiceProvider::ADMINPANEL);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin_user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
