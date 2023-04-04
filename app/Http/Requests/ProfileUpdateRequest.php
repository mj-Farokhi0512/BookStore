<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z0-9_-]{3,16}$/',
            'email' => ['required', 'string', 'email', 'max:255', 'regex: /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})$/', Rule::unique(User::class)->ignore($this->user()->id)],
            'profile' => 'nullable|file|mimes:jpeg,png,jpg,img|max:2048',
            'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', 'current_password']
        ];
    }


    public function messages(): array
    {
        return [
            'name.regex' => 'نام وارد شده معتبر نیست!',
            'email.regex' => 'ایمیل وارد شده معتبر نیست',
            'password.regex' => 'پسورد وارد شده نامعتبر است',
            'password.confirmed' => 'پسورد وارد شده درست نمی باشد'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
