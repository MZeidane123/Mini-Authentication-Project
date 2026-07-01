@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-info rounded-circle mb-3" style="width:64px;height:64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 16 16">
                            <path d="M0 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2 1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 1v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V6z"/>
                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 4a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold text-dark">Verifikasi Dua Faktor</h2>
                    <p class="text-muted small px-3">Masukkan kode 6-digit dari aplikasi Google Authenticator Anda.</p>
                </div>

                <div class="card card-premium">
                    <div class="card-body p-4">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- OTP Code Form -->
                        <form method="POST" action="{{ route('two-factor.login') }}" id="form-otp">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label fw-semibold text-center d-block">Kode OTP</label>
                                <input id="code" type="text" inputmode="numeric" pattern="[0-9]*"
                                    class="form-control text-center fs-4 fw-bold tracking-widest @error('code') is-invalid @enderror"
                                    name="code" autofocus autocomplete="one-time-code"
                                    maxlength="6" placeholder="------" style="letter-spacing: 0.5rem;">
                                @error('code')
                                    <div class="invalid-feedback text-center">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-info btn-premium py-2 fw-semibold text-white">
                                    Verifikasi
                                </button>
                            </div>
                        </form>

                        <div class="divider text-center text-muted small my-3">
                            <span class="bg-white px-2">atau gunakan kode pemulihan</span>
                        </div>

                        <!-- Recovery Code Form -->
                        <form method="POST" action="{{ route('two-factor.login') }}" id="form-recovery">
                            @csrf
                            <div class="mb-3">
                                <label for="recovery_code" class="form-label fw-semibold text-center d-block">Kode Pemulihan</label>
                                <input id="recovery_code" type="text"
                                    class="form-control @error('recovery_code') is-invalid @enderror"
                                    name="recovery_code" autocomplete="one-time-code"
                                    placeholder="Masukkan kode pemulihan">
                                @error('recovery_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-secondary btn-premium py-2">
                                    Gunakan Kode Pemulihan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
