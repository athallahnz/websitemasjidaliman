@extends('layouts.app')

@section('content')
    <div class="container page-offset">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4">

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="h4 mb-1 fw-bold">Daftar Slideshow</h2>
                        <div class="text-muted small">Kelola slide gambar untuk halaman beranda.</div>
                    </div>

                    <a href="{{ route('slideshow.create') }}" class="btn btn-brown d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle"></i> Tambah Slide
                    </a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success border-0 rounded-3">
                        {{ $message }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-head-brown">
                            <tr>
                                <th style="width:70px;">No</th>
                                <th style="width:140px;">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width:140px;" class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-body-soft">
                            @forelse ($slideshows as $slide)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img class="slideshow-thumb" src="{{ asset('storage/' . $slide->image) }}"
                                            alt="{{ $slide->title }}" loading="lazy">
                                    </td>
                                    <td class="fw-semibold">{{ $slide->title }}</td>
                                    <td class="text-muted">{{ \Illuminate\Support\Str::limit($slide->description, 80) }}
                                    </td>
                                    <td class="action-cell">
                                        <div class="action-group">
                                            <a href="{{ route('slideshow.edit', $slide->id) }}"
                                                class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('slideshow.destroy', $slide->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus slide ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Belum ada data slideshow.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
