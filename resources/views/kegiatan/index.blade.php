@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Kegiatan</strong> Yayasan Masjid Al Iman Surabaya</h2>

        <!-- Filter Buttons -->
        <div class="text-center filter-buttons">
            <button class="btn btn-outline-custom filter-btn active mt-2" data-filter="all">Semua</button>
            @foreach ($kategoris as $kategori)
                <button class="btn btn-outline-custom filter-btn mt-2" data-filter="{{ $kategori->id }}">
                    {{ ucfirst($kategori->nama) }}
                </button>
            @endforeach
        </div>


        <!-- Data Kegiatan -->
        <div class="row" id="kegiatan-container">
            @foreach ($kegiatans as $kegiatan)
                <div class="col-md-4 mb-4 kegiatan-item" data-category="{{ $kegiatan->kategori->id }}" data-aos="fade-in"
                    data-aos-duration="800">
                    <div class="card">
                        <img src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : asset('images/default.jpg') }}"
                            class="card-img-top img-fluid" alt="{{ $kegiatan->judul }}"
                            style="width: 100%; height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kegiatan->judul }}</h5>
                            <p class="card-text">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                            <a href="{{ $kegiatan->link ?? '#' }}" class="btn btn-custom">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                let filter = this.getAttribute('data-filter');
                document.querySelectorAll('.kegiatan-item').forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Inisialisasi AOS
        AOS.init({
            duration: 1000, // Durasi default animasi (ms)
            once: true, // Animasi hanya berjalan sekali
        });

        // Script untuk filter tombol
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Hapus class active dari semua tombol
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Filter tampilan kegiatan
                let filter = this.getAttribute('data-filter');
                document.querySelectorAll('.kegiatan-item').forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        item.classList.remove('aos-init', 'aos-animate'); // Reset animasi
                        setTimeout(() => {
                            item.classList.add('aos-init',
                                'aos-animate'); // Trigger ulang animasi
                        }, 100);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
