@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="h4 mb-4">Tambah Kegiatan</h2>
            <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="kajian">Kajian</option>
                        <option value="santunan">Santunan</option>
                        <option value="pembangunan">Pembangunan</option>
                        <option value="ramadhan">Ramadhan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" name="link" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <button type="submit" class="btn" style="background-color: #622200; color:white;">Simpan</button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
