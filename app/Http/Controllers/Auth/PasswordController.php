<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UpdatePassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Notification;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $title = 'Password Changed!';
        $message = 'Your password has been changed at ' . Carbon::now() . '!';
        $sourceable_id = $request->user()->id;
        $sourceable_type = User::class ;
        $web_link = url('/home');

        Notification::send($request->user(), new UpdatePassword($title, $message, $sourceable_id, $sourceable_type, $web_link));

        return back()->with('status', 'password-updated');
    }
}
