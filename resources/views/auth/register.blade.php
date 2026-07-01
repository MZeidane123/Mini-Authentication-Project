@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">Mini-Auth-Project</h3>
                <p class="text-muted small">Buat akun baru untuk memulai</p>
            </div>

            <div class="card card-premium">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus
                                placeholder="Nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required
                                placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required placeholder="Minimal 8 karakter">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-password" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="eye-icon" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required placeholder="Ulangi password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid">
                            <button type="submit" id="btn-register" class="btn btn-primary btn-premium py-2 fw-semibold">
                                Daftar
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-3">
                            <span class="text-muted small">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none small fw-semibold">Masuk</a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-4 small">
                &copy; {{ date('Y') }} Mini-Auth-Project
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        const pwInput = document.getElementById('password');
        pwInput.type = pwInput.type === 'password' ? 'text' : 'password';
    });
</script>
@endpush
@endsection
