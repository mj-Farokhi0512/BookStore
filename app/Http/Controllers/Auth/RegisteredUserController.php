<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

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
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255|regex:/^[a-zA-Z0-9_-]{3,16}$/',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->user() ? $request->user()->id : null, 'id')->whereNull('deleted_at'), 'regex: /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})$/'],
                'password' => 'required|string|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            ],
            [
                'name.regex' => 'نام وارد شده معتبر نیست!',
                'email.regex' => 'ایمیل وارد شده معتبر نیست',
                'password.regex' => 'پسورد وارد شده نامعتبر است!',
            ]
        );

        $user = User::onlyTrashed()->where('email', $validated['email'])->first();

        if (isset($user)) {
            $user->restore();
            $user->update([
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
            ]);
        } else {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('USER');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
