<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        // $validated = $request->validate([
        //     'current_password' => ['required', 'string', 'current_password'],
        //     'new_password' => ['required', Password::defaults(), 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
        // ], [
        //     'new_password.regex' => 'رمز عبور وارد شده نامعتبر است'
        // ]);

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
        ]);
        // return $validated['new_password'];

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first()
                ])
            );
        }

        $data = $validator->validated();
        $request->user()->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return ['message' => 'رمزعبور با موفقیت تغییر یافت'];
        // return back()->with('status', 'رمرعبور با موفقیت تغییر یافت');
    }
}
