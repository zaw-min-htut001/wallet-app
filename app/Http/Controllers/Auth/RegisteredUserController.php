<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'phone' => ['required', Rule::unique('users') ,'max:11'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            if ($user) {
                $user->update([
                    'ip' => $request->getClientIp(), // Update IP address
                    'user_agent' => $request->header('User-Agent'), // Update device user agent
                    'last_login' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
            Auth::login($user);

            Wallet::firstOrCreate(
                [
                    'user_id' =>  $user->id
                ],
                [
                    'account_number' => UUIDGenerate::accountNumberGenerate() ,
                    'amount' => '0' ,
                ]
            );
            DB::commit();
            return redirect(RouteServiceProvider::HOME);
        }
        catch(Exception $e) {
            DB::rollback();
            return $e;
        }

    }
}
