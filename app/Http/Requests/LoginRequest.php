<?php

namespace App\Http\Requests;

use App\Rules\Recaptcha;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'               => ['required', 'string', 'email'],
            'password'            => ['required', 'string'],
            'g-recaptcha-response' => [
                'nullable',
                new Recaptcha(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'g-recaptcha-response.required' => 'Silakan selesaikan verifikasi reCAPTCHA.',
        ];
    }
}
