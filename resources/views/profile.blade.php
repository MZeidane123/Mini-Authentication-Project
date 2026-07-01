@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="fade-in-up mb-4">
                <h4 class="fw-bold">Pengaturan Profil</h4>
                <p class="text-muted small">Kelola informasi akun dan password Anda</p>
            </div>

            @if (session('password-updated'))
                <div class="alert alert-success alert-dismissible fade show">Password berhasil diperbarui.</div>
            @endif

            @if (session('profile-updated'))
                <div class="alert alert-success alert-dismissible fade show">Profil berhasil diperbarui.</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Info -->
            <div class="card card-premium mb-4 fade-in-up stagger-1">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Informasi Profil</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <form method="POST" action="{{ route('user-profile-information.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input id="name" type="text" class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name', 'updateProfileInformation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email" class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email', 'updateProfileInformation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-premium">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card card-premium mb-4 fade-in-up stagger-2">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Ubah Password</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <form method="POST" action="{{ route('user-password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
                            <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required>
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label fw-semibold">Password Baru</label>
                            <input id="new_password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required oninput="checkPasswordStrength(this.value)">
                            <div class="password-strength"><div id="password-strength-bar" class="password-strength-bar"></div></div>
                            <small id="password-strength-text" class="password-strength-text"></small>
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-premium">Ubah Password</button>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card card-premium mb-4 fade-in-up stagger-3 border border-danger border-opacity-25">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold text-danger mb-0">Zona Berbahaya</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <p class="text-muted small">Setelah logout, Anda perlu login kembali dengan password baru jika diubah.</p>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-premium"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout dari Semua Perangkat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
