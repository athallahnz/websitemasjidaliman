@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="card shadow-sm border-0" style="max-width: 600px; width: 100%;">
            <div class="card-body">
                <h2 class="fw-bold text-center mb-4">Edit Infaq Jamaah</h2>
                <form action="{{ route('infaq.update', $jamaah->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ old('nama', $jamaah->nama) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor" class="form-label">Nomor Telepon:</label>
                        <input type="text" class="form-control" id="nomor" name="nomor"
                            value="{{ old('nomor', $jamaah->nomor) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="infaq_id" class="form-label">Tujuan Infaq:</label>
                        <select name="infaq" id="infaq" class="form-select">
                            @foreach ($infaqs as $Infaq)
                                <option value="{{ $Infaq->id }}"
                                    {{ old('infaq', $jamaah->infaq_id) == $Infaq->id ? 'selected' : '' }}>
                                    {{ $Infaq->code . ' - ' . $Infaq->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('infaq')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file_path" class="form-label">Bukti Transfer:</label>
                        <input type="file" class="form-control" id="file_path" name="file_path">

                        @if ($jamaah->file_path)
                            <p class="mt-2">File saat ini:</p>
                            <a href="{{ asset('storage/' . $jamaah->file_path) }}" class="btn btn-sm btn-outline-primary"
                                target="_blank">
                                <i class="fas fa-file-alt"></i> Lihat Bukti
                            </a>
                        @else
                            Tidak ada bukti
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
