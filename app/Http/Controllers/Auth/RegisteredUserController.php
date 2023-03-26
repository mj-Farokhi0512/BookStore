<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
        $request->validate(
            [
                'name' => 'bail|required|string|max:255|regex:/^[a-zA-Z0-9_-]{3,16}$/',
                'email' => 'bail|required|string|email|max:255|unique:' . User::class . '|regex:/^[a-zA-Z0-9_-]{3,16}$/',
                'password' => 'bail|required|string|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            ],
            [
                'name.regex' => 'نام وارد شده معتبر نیست!',
                'email.regex' => 'ایمیل وارد شده معتبر نیست',
                'password.regex' => 'پسورد وارد شده نامعتبر است!',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $user->assignRole('USER');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
