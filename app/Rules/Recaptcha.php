<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip if no value provided (nullable field)
        if (empty($value)) {
            return;
        }

        // Skip validation in testing environment
        if (app()->environment('testing')) {
            return;
        }

        $secretKey = config('services.recaptcha.secret_key');

        if (empty($secretKey) || $secretKey === 'YOUR_SECRET_KEY') {
            // If no key configured, skip (dev mode)
            return;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => $secretKey,
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (! $response->successful() || ! $response->json('success')) {
            $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
        }
    }
}
