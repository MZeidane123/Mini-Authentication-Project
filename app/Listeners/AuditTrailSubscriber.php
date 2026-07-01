<?php

namespace App\Listeners;

use App\Models\AuditTrail;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;

class AuditTrailSubscriber
{
    public function __construct(protected Request $request) {}

    public function handleLogin(Login $event): void
    {
        AuditTrail::create([
            'user_id'    => $event->user->id,
            'action'     => 'Login Berhasil',
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
        ]);
    }

    public function handleFailed(Failed $event): void
    {
        AuditTrail::create([
            'user_id'    => optional($event->user)->id ?? null,
            'action'     => 'Login Gagal',
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
            'properties' => ['email' => $event->credentials['email'] ?? null],
        ]);
    }

    public function handleLogout(Logout $event): void
    {
        AuditTrail::create([
            'user_id'    => $event->user->id,
            'action'     => 'Logout',
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
        ]);
    }

    public function handlePasswordReset(PasswordReset $event): void
    {
        AuditTrail::create([
            'user_id'    => $event->user->id,
            'action'     => 'Reset Password Berhasil',
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
        ]);
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class         => 'handleLogin',
            Failed::class        => 'handleFailed',
            Logout::class        => 'handleLogout',
            PasswordReset::class => 'handlePasswordReset',
        ];
    }
}
