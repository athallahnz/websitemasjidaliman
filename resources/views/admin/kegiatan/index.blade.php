@extends('layouts.app')

@section('content')
    <div class="container page-offset">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4">

                {{-- Header --}}
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

                    <div>
                        <h2 class="h4 fw-bold mb-1">Daftar Kegiatan</h2>
                        <div class="text-muted small">Kelola kegiatan dan kategori kegiatan.</div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-brown d-inline-flex align-items-center gap-2"
                            data-bs-toggle="modal" data-bs-target="#addKategori">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori
                        </button>

                        <a href="{{ route('admin.kegiatan.create') }}"
                            class="btn btn-brown d-inline-flex align-items-center gap-2">
                            <i class="bi bi-plus-circle"></i> Tambah Kegiatan
                        </a>
                    </div>
                </div>

                {{-- Alerts --}}
                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3">
                        <div class="fw-semibold mb-2">Periksa kembali input Anda:</div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success border-0 rounded-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:70px;">No</th>
                                <th>Judul</th>
                                <th style="width:160px;">Kategori</th>
                                <th style="width:140px;">Tanggal</th>
                                <th>Deskripsi</th>
                                <th style="width:140px;">Gambar</th>
                                <th style="width:120px;">Link</th>
                                <th style="width:140px;" class="text-end">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="table-body-soft">
                            @forelse ($kegiatan as $key => $item)
                                <tr>
                                    <td class="fw-semibold">{{ $key + 1 }}</td>
                                    <td class="fw-semibold">{{ $item->judul }}</td>
                                    <td>
                                        <span class="badge text-bg-light border">
                                            {{ $item->kategori->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        {{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="text-muted">
                                        {{ Str::limit($item->deskripsi, 60) }}
                                    </td>

                                    <td class="text-nowrap">
                                        @if ($item->gambar)
                                            <a href="{{ asset('storage/' . $item->gambar) }}"
                                                class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-2"
                                                target="_blank" rel="noopener">
                                                <i class="bi bi-image"></i> Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-nowrap">
                                        @if ($item->link)
                                            <a href="{{ $item->link }}" class="btn btn-sm btn-outline-success"
                                                target="_blank" rel="noopener">
                                                Kunjungi
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-end text-nowrap">
                                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus kegiatan ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        Belum ada data kegiatan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Tambah Kategori --}}
    <div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="addKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <form id="formTambahKategori" action="{{ route('kategoris.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Contoh: Ramadhan, Sosial, Pendidikan" required>
                        </div>

                        <div class="mb-0">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                placeholder="Deskripsi singkat kategori..." required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-brown rounded-pill px-4">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addKategori');
            if (!modal) return;

            modal.addEventListener('hidden.bs.modal', function() {
                const form = document.getElementById('formTambahKategori');
                if (form) form.reset();
            });
        });
    </script>
@endpush
