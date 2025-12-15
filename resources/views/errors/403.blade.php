{{-- resources/views/errors/403.blade.php --}}
@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-brown">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-7">

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-md-5 text-center">

                            <div class="mb-3">
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                    Akses Ditolak
                                </span>
                            </div>

                            <div class="display-1 fw-bold lh-1 mb-2 text-brown">
                                403
                            </div>

                            <h1 class="h4 fw-semibold mb-2">
                                Anda tidak memiliki izin untuk mengakses halaman ini
                            </h1>

                            <p class="text-secondary mb-4">
                                Halaman ini hanya dapat diakses oleh pengguna dengan otorisasi tertentu.
                                Jika Anda merasa ini kesalahan, silakan hubungi administrator.
                            </p>

                            @php
                                $previous = url()->previous();
                                $current = url()->current();
                                $backUrl = $previous && $previous !== $current ? $previous : url('/');
                            @endphp

                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                <a href="{{ $backUrl }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>

                                <a href="{{ url('/') }}" class="btn btn-brown rounded-pill px-4">
                                    <i class="bi bi-house-door me-1"></i> Beranda
                                </a>
                            </div>

                            <hr class="my-4">

                            <div class="small text-secondary">
                                Kode error:
                                <code class="px-2 py-1 bg-light rounded">HTTP 403</code>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
