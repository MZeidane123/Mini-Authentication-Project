# Mini-Auth-Project

Aplikasi autentikasi **Laravel 13 + Bootstrap 5** dengan fitur login, register, forgot/reset password, MFA, audit trail, dan reCAPTCHA.

## Fitur

| Fitur | Keterangan |
|-------|-----------|
| **Login** | Validasi email + password + reCAPTCHA v2, rate limited 5x/menit |
| **Register** | Daftar akun baru dengan password strength indicator |
| **Lupa Password** | Kirim link reset via Gmail SMTP, anti-user-enumeration |
| **MFA (2FA)** | Google Authenticator, QR code, recovery codes |
| **Audit Trail** | Catat login/logout/reset password + IP address |
| **Dark Mode** | Toggle theme, persist ke localStorage |
| **Dashboard** | Statistik login, histori aktivitas, manajemen MFA |
| **Profile** | Edit nama/email, ubah password, logout |
| **reCAPTCHA** | Google reCAPTCHA v2 di login + forgot password |
| **Error Pages** | Custom 403, 404, 500 |

## Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 13, PHP 8.3 |
| Frontend | Bootstrap 5, SCSS |
| Database | MySQL 8.0 |
| Auth | Laravel Fortify |
| Assets | Vite |
| Email | Gmail SMTP / Mailpit |
| Security | reCAPTCHA v2 |
| Container | Docker (Laravel Sail) |

## Struktur Project

```
app/
├── Actions/Fortify/
│   ├── CreateNewUser.php
│   ├── ResetUserPassword.php
│   ├── UpdateUserPassword.php
│   ├── UpdateUserProfileInformation.php
│   └── PasswordValidationRules.php
├── Http/
│   ├── Controllers/Controller.php
│   └── Requests/
│       ├── LoginRequest.php
│       └── ForgotPasswordRequest.php
├── Listeners/
│   └── AuditTrailSubscriber.php
├── Models/
│   ├── User.php
│   └── AuditTrail.php
├── Notifications/
│   └── ResetPasswordNotification.php
├── Providers/
│   ├── AppServiceProvider.php
│   └── FortifyServiceProvider.php
└── Rules/
    └── Recaptcha.php

config/
├── fortify.php
├── mail.php
├── services.php
└── ...

database/
├── factories/
├── migrations/
│   ├── create_users_table.php
│   ├── add_two_factor_columns_to_users_table.php
│   ├── create_audit_trails_table.php
│   └── drop_unused_tables.php
└── seeders/

resources/
├── sass/
│   └── app.scss
├── js/
│   ├── app.js
│   └── bootstrap.js
└── views/
    ├── layouts/
    │   └── app.blade.php
    ├── auth/
    │   ├── login.blade.php
    │   ├── register.blade.php
    │   ├── forgot-password.blade.php
    │   ├── reset-password.blade.php
    │   ├── two-factor-challenge.blade.php
    │   └── confirm-password.blade.php
    ├── errors/
    │   ├── 403.blade.php
    │   ├── 404.blade.php
    │   └── 500.blade.php
    ├── home.blade.php
    ├── landing.blade.php
    └── profile.blade.php

routes/
├── web.php
└── console.php

tests/
├── Feature/
│   └── AuthTest.php
├── Unit/
└── TestCase.php
```

## Setup

### Persyaratan

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [WSL 2](https://learn.microsoft.com/en-us/windows/wsl/install) (Windows)

### Instalasi

```bash
# Clone project
git clone <url-repo>
cd mini-project-auth

# Install dependencies
docker run --rm -v ${PWD}:/app composer:latest composer install

# Copy environment
copy .env.example .env

# Jalankan container
vendor/bin/sail up -d

# Generate key
vendor/bin/sail artisan key:generate

# Jalankan migrasi
vendor/bin/sail artisan migrate

# Build assets
vendor/bin/sail npm install
vendor/bin/sail npm run build
```

Akses:
| URL | Keterangan |
|-----|-----------|
| http://localhost/ | Landing page |
| http://localhost/register | Daftar akun baru |
| http://localhost/login | Login |
| http://localhost/home | Dashboard (setelah login) |
| http://localhost/profile | Profil |
| http://localhost:8080 | phpMyAdmin |
| http://localhost:8025 | Mailpit (email lokal) |

## Testing

```bash
docker exec mini-project-auth-laravel.test-1 php artisan test
```

13 test (40 assertions) — login, register, forgot/reset password, 2FA, logout.

## Email Configuration

### Lokal (Mailpit — default)
```
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_ENCRYPTION=null
```

### Gmail SMTP
```
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailkamu@gmail.com
MAIL_PASSWORD=abcd1234efgh5678
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=emailkamu@gmail.com
MAIL_FROM_NAME="Mini-Auth-Project"
```

> App Password: https://myaccount.google.com/apppasswords  
> (wajib aktifkan 2-Step Verification)

## Dark Mode

Klik ikon bulan/matahari di navbar. Tersimpan otomatis ke localStorage.


## Flow Instalasi
1. Clone repo
   git clone https://github.com/MZeidane123/Mini-Authentication-Project.git
   cd Mini-Authentication-Project

2. Buat .env dari template
   copy .env.example .env

3. Install dependencies PHP (via Docker)
   docker run --rm -v ${PWD}:/app composer:latest composer install

4. Jalankan container
   vendor/bin/sail up -d

5. Generate key
   vendor/bin/sail artisan key:generate

6. Jalankan migrasi
   vendor/bin/sail artisan migrate

7. Install & build frontend
   vendor/bin/sail npm install
   vendor/bin/sail npm run build
