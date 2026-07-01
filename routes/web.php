<?php

use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

// Landing page for guests, dashboard for authenticated users
Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : view('landing');
})->name('landing');

// Override Fortify's forgot-password POST — always return success for security
Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'g-recaptcha-response' => ['nullable', new Recaptcha],
    ]);

    Password::sendResetLink($request->only('email'));

    return back()->with('status', __('passwords.sent'));
})->name('password.email');

// Dashboard + Profile — requires login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});
