@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center text-center fade-in-up">
        <div class="col-lg-6">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#EF4444" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <h1 class="display-4 fw-bold mb-3">403</h1>
            <h5 class="fw-semibold mb-2">Akses Dilarang</h5>
            <p class="text-muted mb-4">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-premium px-4 py-2">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
