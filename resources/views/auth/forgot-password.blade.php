@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-3" style="width:64px;height:64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold text-dark">Lupa Password?</h2>
                    <p class="text-muted small px-3">Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password.</p>
                </div>

                <div class="card card-premium">
                    <div class="card-body p-4">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" id="forgot-password-form">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Alamat Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="nama@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                @error('g-recaptcha-response')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" id="btn-submit" class="btn btn-warning btn-premium py-2 fw-semibold text-white">
                                    <span id="btn-text">Kirim Link Reset Password</span>
                                    <div id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-decoration-none text-muted small">
                                    &larr; Kembali ke halaman Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    document.getElementById('forgot-password-form').addEventListener('submit', function () {
        document.getElementById('btn-text').classList.add('d-none');
        document.getElementById('btn-spinner').classList.remove('d-none');
        document.getElementById('btn-submit').disabled = true;
    });
</script>
@endpush
@endsection
