@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Daftar Kegiatan</h2>
                <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary btn-block" style="background-color: #622200; border-color: #622200;">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Kegiatan
                </a>
            </div>

            @if(session('success'))
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
                        @foreach($kegiatan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>
                                @if($item->gambar)
                                    <a href="{{ asset('storage/' . $item->gambar) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat Gambar</a>
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td>
                                @if($item->link)
                                    <a href="{{ $item->link }}" class="btn btn-sm btn-outline-success" target="_blank">Kunjungi</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.kegiatan.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus kegiatan ini?')">
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
