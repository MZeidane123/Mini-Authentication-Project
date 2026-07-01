@extends('layouts.app')

@section('content')
<div class="container py-4">
    @php
        $user = auth()->user();
        $logs = \App\Models\AuditTrail::where('user_id', $user->id)->latest()->take(10)->get();
        $totalLogins = \App\Models\AuditTrail::where('user_id', $user->id)->where('action', 'Login Berhasil')->count();
        $failedLogins = \App\Models\AuditTrail::where('user_id', $user->id)->where('action', 'Login Gagal')->count();
        $lastLogin = \App\Models\AuditTrail::where('user_id', $user->id)->where('action', 'Login Berhasil')->latest()->first();
    @endphp

    <!-- Welcome Banner -->
    <div class="card card-premium mb-4 overflow-hidden fade-in-up">
        <div class="position-relative" style="background: linear-gradient(135deg, #6366F1, #A855F7);">
            <div class="position-absolute inset-0" style="inset:0;background:rgba(0,0,0,0.1);pointer-events:none;"></div>
            <div class="card-body p-4 p-md-5 position-relative" style="z-index:1;">
                <div class="row align-items-center">
                    <div class="col-md-8 text-white">
                        <h2 class="fw-bold mb-2" style="text-shadow:0 2px 8px rgba(0,0,0,0.25);">Selamat Datang, {{ $user->name }}! 👋</h2>
                        <p class="mb-0 opacity-90" style="text-shadow:0 1px 4px rgba(0,0,0,0.15);">{{ $lastLogin ? 'Terakhir login ' . $lastLogin->created_at->diffForHumans() : 'Selamat datang di dashboard' }}</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="badge bg-white text-primary fs-6 px-3 py-2 rounded-pill shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/></svg>
                            {{ $user->two_factor_confirmed_at ? 'MFA Aktif' : 'MFA Nonaktif' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="position-absolute end-0 top-0 opacity-10 d-none d-md-block" style="z-index:0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="white" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/></svg>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4 fade-in-up stagger-1">
            <div class="card card-premium h-100">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle rounded-3 flex-shrink-0" style="width:48px;height:48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#4F46E5" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/></svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">{{ $user->name }}</p>
                        <h6 class="fw-bold mb-0 text-truncate" style="max-width:180px;">{{ $user->email }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 fade-in-up stagger-2">
            <div class="card card-premium h-100">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle rounded-3 flex-shrink-0" style="width:48px;height:48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#10B981" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Login Berhasil</p>
                        <h6 class="fw-bold mb-0">{{ $totalLogins }}x</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 fade-in-up stagger-3">
            <div class="card card-premium h-100">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle rounded-3 flex-shrink-0" style="width:48px;height:48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#EF4444" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16m3.354-8.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708L7.293 10l-2.647 2.646a.5.5 0 0 0 .708.708L8 10.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 10z"/></svg>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Login Gagal</p>
                        <h6 class="fw-bold mb-0">{{ $failedLogins }}x</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- MFA Section -->
        <div class="col-lg-6 fade-in-up stagger-2">
            <div class="card card-premium h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-inline-flex align-items-center justify-content-center bg-info-subtle rounded-3 flex-shrink-0" style="width:40px;height:40px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0ea5e9" viewBox="0 0 16 16">
                                <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524z"/>
                            </svg>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Autentikasi Dua Faktor</h5>
                            <small class="text-muted">Lapisan keamanan ekstra untuk akun Anda</small>
                        </div>
                        @php $mfaActive = $user->two_factor_confirmed_at ? true : false; @endphp
                        <span class="badge ms-auto {{ $mfaActive ? 'bg-success' : 'bg-secondary' }}">{{ $mfaActive ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    @if ($user->two_factor_secret)
                        @if ($user->two_factor_confirmed_at)
                            <p class="text-muted small">MFA sudah aktif. Akun Anda dilindungi.</p>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-muted">Kode Pemulihan</label>
                                <div class="bg-light rounded p-3 small font-monospace" style="background:var(--bg-primary)!important;">
                                    @foreach ($user->recoveryCodes() as $code)
                                        <div>{{ $code }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-premium w-100" onclick="return confirm('Nonaktifkan MFA?')">Nonaktifkan MFA</button>
                            </form>
                        @else
                            <div class="alert alert-warning">Selesaikan aktivasi dengan memindai QR code dan masukkan kode 6 digit.</div>
                            <div class="text-center my-3 p-3 d-inline-block rounded shadow-sm d-block mx-auto" style="background:var(--bg-card);">
                                {!! $user->twoFactorQrCodeSvg() !!}
                            </div>
                            <form method="POST" action="{{ url('/user/confirmed-two-factor-authentication') }}">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="code" class="form-control form-control-lg text-center font-monospace" placeholder="123456" required>
                                    <button class="btn btn-primary btn-premium px-4" type="submit">Konfirmasi</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-secondary btn-premium w-100">Batal</button>
                            </form>
                        @endif
                    @else
                        <p class="text-muted small">Aktifkan MFA untuk melindungi akun dengan Google Authenticator.</p>
                        <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-premium w-100">Aktifkan MFA</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Audit Trail -->
        <div class="col-lg-6 fade-in-up stagger-3">
            <div class="card card-premium h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle rounded-3 flex-shrink-0" style="width:40px;height:40px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f59e0b" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Histori Aktivitas</h5>
                            <small class="text-muted">10 aktivitas terakhir</small>
                        </div>
                    </div>
                    <span class="badge bg-light text-muted">{{ $logs->count() }} item</span>
                </div>
                <div class="card-body px-4 pb-4">
                    @if ($logs->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" class="mb-2 opacity-50"><path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                            <p class="mb-0 small">Belum ada aktivitas yang tercatat.</p>
                        </div>
                    @else
                        <div class="timeline">
                            @foreach ($logs as $log)
                            <div class="d-flex gap-3 py-2 border-bottom" style="border-color:var(--border-color)!important;">
                                <div class="flex-shrink-0 mt-1">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:28px;height:28px;
                                        @if(str_contains($log->action, 'Berhasil')) background:rgba(16,185,129,0.15);color:#10B981;
                                        @elseif(str_contains($log->action, 'Gagal')) background:rgba(239,68,68,0.15);color:#EF4444;
                                        @else background:rgba(59,130,246,0.15);color:#3B82F6;
                                        @endif">
                                        @if(str_contains($log->action, 'Berhasil'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/></svg>
                                        @elseif(str_contains($log->action, 'Gagal'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                        <span class="fw-medium small">{{ $log->action }}</span>
                                        <small class="text-muted" style="font-size:0.7rem;">{{ $log->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="d-flex gap-2 mt-1">
                                        <small class="text-muted font-monospace" style="font-size:0.65rem;">{{ $log->ip_address }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
