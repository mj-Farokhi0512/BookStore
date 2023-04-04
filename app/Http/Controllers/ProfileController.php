<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): View
    {
        return view('dashboard.profile.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $path = null;
        $file = $request->file('profile');
        if (isset($file)) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/profiles', $filename, 'public');
            $user->profile = $path;
        }


        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }


        $user->update([
            'name' => $user->name,
            'email' => $user->email,
            'profile' => $user->profile
        ]);

        return ['message' => 'پروفایل با موفقیت آپدیت شد', 'user' => ['name' => $user->name, 'email' => $user->email, 'profile' => $user->profile]];
        // return Redirect::route('profile')->with('message', $path);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse|string
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'رمزعبور وارد شده نادرست است'
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
