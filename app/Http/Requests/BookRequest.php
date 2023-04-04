<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/'],
            'author' => ['required', 'string', 'max:255', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/'],
            'available' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'pages' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,img', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'نام وارد شده معتبر نیست',
            'author.regex' => 'نام نویسنده معتبر نیست',
            'available.min' => 'تعداد موجود نمیتواند منفی باشد',
            'price.min' => 'قیمت نمیتواند منفی باشد',
            'description.regex' => 'نمیتوان از حروف خاص استفاده کرد',
            'image.mimes' => 'فایل ارسالی باید یکی از این فرمت ها باشد :jpeg,png,jpg,img',
            'image.max' => 'فایل ارسالی باید کوچکتر از ۲مگابایت باشد'
        ];
    }
}
