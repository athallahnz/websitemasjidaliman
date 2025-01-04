@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header text-center" style="background-color: #8e4c28; color: white;">
            <h2 class="h4 mb-0">Detail Infaq Jamaah</h2>
        </div>
        <div class="card-body d-flex flex-wrap align-items-start">
            <div class="content-container flex-grow-1">
                <h5 class="card-title">Nama:</h5>
                <p class="card-text">{{ $jamaahs->nama }}</p>

                <h5 class="card-title">Nomor Telepon:</h5>
                <p class="card-text">{{ $jamaahs->nomor }}</p>

                <h5 class="card-title">Tujuan Infaq:</h5>
                <p class="card-text">{{ $jamaahs->infaq->name }}</p>

                <h5 class="card-title">Nama Pengguna:</h5>
                <p class="card-text">{{ $jamaahs->user->name }}</p>

                <div class="mt-4">
                    <h6 class="card-subtitle mb-2 text-muted">Bukti Transfer:</h6>
                    @if ($jamaahs->file_path)
                        <a href="{{ asset('storage/' . $jamaahs->file_path) }}" class="btn btn-link" target="_blank">Lihat Bukti Transfer</a>
                    @else
                        <p class="text-danger">Tidak ada bukti transfer.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer text-end" style="background-color: #f8f9fa;">
            <a href="{{ route('home') }}" class="btn btn-secondary" style="background-color: #6c757d; border-color: #6c757d;">Kembali ke Home</a>
        </div>
    </div>
</div>
@endsection
