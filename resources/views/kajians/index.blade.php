@extends('layouts.app')

@section('content')
    <div class="container page-offset">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4">

                {{-- Header --}}
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h2 class="h4 fw-bold mb-1">Daftar Kajian</h2>
                        <div class="text-muted small">Kelola jadwal kajian, pemateri, dan tautan YouTube.</div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">

                        <button type="button" class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#addUstadzModal">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Ustadz
                        </button>

                        <a href="{{ route('kajians.create') }}" class="btn btn-brown">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Kajian
                        </a>
                    </div>
                </div>

                {{-- Flash --}}
                @if ($message = Session::get('success'))
                    <div class="alert alert-success border-0 rounded-3 mb-3">
                        {{ $message }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 dashboard-table">
                        <thead>
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Judul Kajian</th>
                                <th>Jenis Kajian</th>
                                <th>Pemateri</th>
                                <th style="width:170px;">Waktu Mulai</th>
                                <th style="width:170px;">Countdown</th>
                                <th style="width:220px;" class="text-end">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kajians as $kajian)
                                @php
                                    $startIso = $kajian->start_time
                                        ? \Carbon\Carbon::parse($kajian->start_time)->toIso8601String()
                                        : null;
                                @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $kajian->title }}</td>
                                    <td>{{ $kajian->jeniskajian->name ?? '-' }}</td>
                                    <td>{{ $kajian->ustadz->name ?? '-' }}</td>

                                    <td class="text-nowrap">
                                        @if ($kajian->start_time)
                                            {{ \Carbon\Carbon::parse($kajian->start_time)->format('d M Y H:i') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-nowrap">
                                        @if ($startIso)
                                            <span class="countdown" data-start="{{ $startIso }}">-</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-1 justify-content-end">
                                            @if (!empty($kajian->youtube_link))
                                                <a href="{{ $kajian->youtube_link }}" target="_blank"
                                                    class="btn btn-outline-danger btn-sm" title="YouTube">
                                                    <i class="bi bi-youtube"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('kajians.show', $kajian->id) }}"
                                                class="btn btn-outline-info btn-sm" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('kajians.edit', $kajian->id) }}"
                                                class="btn btn-outline-primary btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('kajians.destroy', $kajian->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus kajian ini?');">
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
                                    <td colspan="7" class="text-center text-muted py-5">Belum ada data kajian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Modal Tambah Ustadz --}}
        <div class="modal fade" id="addUstadzModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Tambah Ustadz</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="formTambahUstadz" action="{{ route('ustadzs.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <label class="form-label">Nama Ustadz</label>
                            <input type="text" class="form-control" name="name" required
                                placeholder="Contoh: Ustadz Ahmad">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-brown">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            function fmt(ms) {
                const d = Math.floor(ms / (1000 * 60 * 60 * 24));
                const h = Math.floor((ms % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((ms % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((ms % (1000 * 60)) / 1000);
                return `${d}d ${h}h ${m}m ${s}s`;
            }

            function tick() {
                const now = Date.now();
                document.querySelectorAll('.countdown[data-start]').forEach(el => {
                    const start = new Date(el.dataset.start).getTime();
                    if (isNaN(start)) return el.textContent = '-';

                    const dist = start - now;
                    el.textContent = dist <= 0 ? 'Kajian Dimulai!' : fmt(dist);
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                tick();
                setInterval(tick, 1000);
            });
        })();
    </script>
@endpush
