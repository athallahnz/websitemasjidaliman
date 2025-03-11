@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 800px;">
            <div class="card-header text-center" style="background-color: #8e4c28; color: white;">
                <h2 class="h4 mb-0">Detail Infaq Jamaah</h2>
            </div>
            <div class="card-body d-flex flex-column flex-md-row align-items-center gap-3 p-3">
                <!-- Bagian Informasi Jamaah -->
                <div class="w-100 w-md-50">
                    <h5 class="fw-bold">Nama:</h5>
                    <p class="mb-2">{{ $jamaahs->nama }}</p>

                    <h5 class="fw-bold">Nomor Telepon:</h5>
                    <p class="mb-2">{{ $jamaahs->nomor }}</p>

                    <h5 class="fw-bold">Tujuan Infaq:</h5>
                    <p class="mb-2">{{ $jamaahs->infaq->name }}</p>
                </div>

                <!-- Bagian Gambar -->
                <div class="w-100 w-md-50 text-center">
                    <h5 class="fw-bold">Bukti Transfer:</h5>
                    @if ($jamaahs->file_path)
                        <img src="{{ asset('storage/' . $jamaahs->file_path) }}" class="img-fluid rounded shadow-sm"
                            style="max-width: 100%; height: auto;">
                    @else
                        <p class="text-danger">Tidak ada bukti transfer.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer text-end p-3" style="background-color: #f8f9fa;">
                <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Home</a>
            </div>
        </div>
    </div>
@endsection
