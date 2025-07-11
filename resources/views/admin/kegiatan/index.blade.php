@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4">Daftar Kegiatan</h2>
                    <div class="text-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-block mt-2"
                            style="background-color: #622200; border-color: #622200;" data-bs-toggle="modal"
                            data-bs-target="#addKategori">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Kategori Kegiatan
                        </button>
                        <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary btn-block mt-2"
                            style="background-color: #622200; border-color: #622200;">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Kegiatan
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="addKategoriLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addKategoriLabel">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formTambahKategori" action="{{ route('kategoris.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan Nama Kategori.." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                            placeholder="Masukkan Deskripsi Kategori.." required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: #622200; border-color: #622200;">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background-color: #8e4c28; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Link</th>
                                <th style="width: 250px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f5e9e1;">
                            @foreach ($kegiatan as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->kategori->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</td>
                                    <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($item->gambar)
                                            <a href="{{ asset('storage/' . $item->gambar) }}"
                                                class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1"
                                                target="_blank">
                                                <i class="bi bi-image"></i> Lihat Gambar
                                            </a>
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->link)
                                            <a href="{{ $item->link }}" class="btn btn-sm btn-outline-success mt-2"
                                                target="_blank">Kunjungi</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
                                            class="btn btn-outline-primary btn-sm mt-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm mt-2"
                                                onclick="return confirm('Hapus kegiatan ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var modal = document.getElementById('addKategori');
        modal.addEventListener('hidden.bs.modal', function() {
            document.getElementById('formTambahKategori').reset();
        });
    </script>
@endpush
