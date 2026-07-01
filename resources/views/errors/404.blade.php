@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center text-center fade-in-up">
        <div class="col-lg-6">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#f59e0b" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
            </div>
            <h1 class="display-4 fw-bold mb-3">404</h1>
            <h5 class="fw-semibold mb-2">Halaman Tidak Ditemukan</h5>
            <p class="text-muted mb-4">Halaman yang Anda cari tidak ada atau telah dipindahkan.</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-premium px-4 py-2">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
