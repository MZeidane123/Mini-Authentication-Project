<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password - Mini-Auth-Project')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini akan kadaluwarsa dalam ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Salam, ' . config('app.name'));
    }
}
