@extends('layouts.app')

@section('content')
    <div class="container page-offset">
        <div class="card card-shell">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex flex-column gap-1 mb-4 text-center">
                    <h1 class="h5 fw-bold mb-0">Kegiatan Yayasan Masjid Al Iman Surabaya</h1>
                    <div class="text-muted small">Pilih kategori untuk memfilter kegiatan.</div>
                </div>

                <div class="text-center filter-buttons mb-4">
                    <button type="button" class="btn btn-outline-custom filter-btn active mt-2"
                        data-filter="all">Semua</button>
                    @foreach ($kategoris as $kategori)
                        <button type="button" class="btn btn-outline-custom filter-btn mt-2"
                            data-filter="{{ $kategori->id }}">
                            {{ ucfirst($kategori->nama) }}
                        </button>
                    @endforeach
                </div>

                <div class="row g-4" id="kegiatan-container">
                    @forelse ($kegiatans as $kegiatan)
                        <div class="col-md-4 kegiatan-item" data-category="{{ $kegiatan->kategori->id }}" data-aos="fade-in"
                            data-aos-duration="800">

                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                <img src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : asset('images/default.jpg') }}"
                                    alt="{{ $kegiatan->judul }}" class="img-fluid"
                                    style="width:100%; height:250px; object-fit:cover;" loading="lazy">

                                <div class="card-body d-flex flex-column p-3">
                                    <h5 class="card-title fw-bold">{{ $kegiatan->judul }}</h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 100) }}
                                    </p>

                                    <a href="{{ $kegiatan->link ?: '#' }}" class="btn btn-brown mt-auto"
                                        @if (empty($kegiatan->link)) aria-disabled="true" @endif>
                                        Lihat Selengkapnya
                                    </a>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light border text-center mb-0">
                                Belum ada kegiatan.
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.AOS) {
                AOS.init({
                    duration: 1000,
                    once: true
                });
            }

            const buttons = document.querySelectorAll('.filter-btn');
            const items = document.querySelectorAll('.kegiatan-item');

            function applyFilter(filter) {
                items.forEach(item => {
                    const cat = item.getAttribute('data-category');
                    const show = (filter === 'all' || cat === filter);
                    item.classList.toggle('d-none', !show);

                    if (show && window.AOS) item.classList.remove('aos-animate');
                });

                if (window.AOS) AOS.refreshHard();
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', function() {
                    buttons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    applyFilter(this.getAttribute('data-filter'));
                });
            });
        });
    </script>
@endpush
