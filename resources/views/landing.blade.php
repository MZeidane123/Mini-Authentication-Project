@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center text-center mb-5 fade-in-up">
        <div class="col-lg-8">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 mb-3 rounded-pill fs-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1"><path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524z"/></svg>
                Mini-Auth-Project zidan
            </span>
            <h1 class="display-4 fw-bold mb-3 gradient-text">Mini Authentication Project</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width:600px;">
                Aplikasi autentikasi aman dengan login, registrasi, forgot password, MFA, audit trail, dan reCAPTCHA.
            </p>
            <div class="d-flex justify-content-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-premium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="me-1"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/></svg>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-premium px-4 py-2">Daftar Akun</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-primary btn-premium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="me-1"><path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.602-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6.1 6.1 0 0 1 .924 0 6 6 0 0 1 2.589 1.085l-5.452 5.452a6 6 0 0 1 1.94-6.537Zm-2.585 6.464 5.452-5.452a6 6 0 0 1 1.085 2.589 6.1 6.1 0 0 1 0 .924 6 6 0 0 1-1.085 2.589 6 6 0 0 1-2.589 1.085 6.1 6.1 0 0 1-.924 0 6 6 0 0 1-2.589-1.085 6 6 0 0 1-1.34-1.66z"/></svg>
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="row g-4 mt-3">
        <div class="col-md-4 fade-in-up stagger-1">
            <div class="card card-premium h-100 text-center p-4">
                <div class="card-body">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle rounded-3 mb-3" style="width:56px;height:56px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#4F46E5" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/></svg>
                    </div>
                    <h5 class="fw-bold">Login Aman</h5>
                    <p class="text-muted small mb-0">Otentikasi dengan reCAPTCHA v2 dan rate limiting untuk mencegah brute force.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 fade-in-up stagger-2">
            <div class="card card-premium h-100 text-center p-4">
                <div class="card-body">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle rounded-3 mb-3" style="width:56px;height:56px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#10B981" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 3.224 3.224zm-2.65 2.65a3.5 3.5 0 0 0 4.474-4.474l-.823.823a2.5 2.5 0 0 1-3.224 3.224zm-2.584-2.584a2.5 2.5 0 0 1 3.224-3.224l-.823-.823a3.5 3.5 0 0 0-4.474 4.474z"/><path d="M2.641 4.738a13 13 0 0 0-1.469 1.262C.34 7.197.132 7.758.045 8.003q-.078.185-.045.294c.036.125.167.377.444.737.561.73 1.411 1.647 2.537 2.447C4.828 12.582 6.609 13.5 8 13.5a7.1 7.1 0 0 0 1.653-.196l-.808-.807a6 6 0 0 1-2.438-.205c-.83-.271-1.593-.732-2.247-1.239A13 13 0 0 1 1.172 8a13 13 0 0 1 1.066-1.159l.419-.419z"/><path d="M.854 15.854a.5.5 0 0 1-.708-.708l15-15a.5.5 0 0 1 .708.708z"/></svg>
                    </div>
                    <h5 class="fw-bold">Audit Trail</h5>
                    <p class="text-muted small mb-0">Setiap aktivitas login/logout tercatat dengan IP address dan waktu.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 fade-in-up stagger-3">
            <div class="card card-premium h-100 text-center p-4">
                <div class="card-body">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle rounded-3 mb-3" style="width:56px;height:56px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#f59e0b" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>
                    </div>
                    <h5 class="fw-bold">Reset Password</h5>
                    <p class="text-muted small mb-0">Lupa password? Kirim link reset via email dengan aman dan cepat.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
