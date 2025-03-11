@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="h4 mb-4">Edit Kegiatan</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex flex-wrap align-items-start">
                    <!-- Preview Gambar -->
                    <div class="image-container text-center mb-3 me-3">
                        @if ($kegiatan->gambar)
                            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid rounded"
                                style="width: 300px; height: 300px; object-fit: cover;" alt="{{ $kegiatan->judul }}">
                        @else
                            <div class="no-image bg-light d-flex justify-content-center align-items-center rounded"
                                style="width: 300px; height: 300px;">
                                <span class="text-muted">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <div class="content-container flex-grow-1">
                        <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}"
                                    class="form-control" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" class="form-select" required>
                                    <option value="kajian" {{ old('kategori', $kegiatan->kategori ?? '') == 'kajian' ? 'selected' : '' }}>Kajian</option>
                                    <option value="santunan" {{ old('kategori', $kegiatan->kategori ?? '') == 'santunan' ? 'selected' : '' }}>Santunan</option>
                                    <option value="pembangunan" {{ old('kategori', $kegiatan->kategori ?? '') == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                                    <option value="ramadhan" {{ old('kategori', $kegiatan->kategori ?? '') == 'ramadhan' ? 'selected' : '' }}>Ramadhan</option>
                                </select>
                            </div>

                            <!-- Tanggal Kegiatan -->
                            <div class="mb-3">
                                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal_kegiatan" class="form-control"
                                    value="{{ old('tanggal_kegiatan', \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('Y-m-d')) }}"
                                    required>
                            </div>

                            <!-- Link -->
                            <div class="mb-3">
                                <label for="link" class="form-label">Tautan (Opsional)</label>
                                <input type="url" name="link" class="form-control"
                                    value="{{ old('link', $kegiatan->link) }}" placeholder="Masukkan link terkait kegiatan">
                            </div>

                            <!-- Gambar -->
                            <div class="mb-4">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn" style="background-color: #622200; color: white;">
                                    <i class="bi bi-save me-2"></i>Update
                                </button>
                                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
