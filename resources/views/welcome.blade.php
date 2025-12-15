@extends('layouts.app')

@section('title', 'Beranda')

@php
    $jadwal = $jadwalDefault['data']['jadwal'][0] ?? null;
    $timesLeft = ['Imsak' => 'imsak', 'Shubuh' => 'subuh', 'Terbit' => 'terbit', 'Dhuha' => 'dhuha'];
    $timesRight = ['Dzuhur' => 'dzuhur', 'Ashar' => 'ashar', 'Maghrib' => 'maghrib', "Isya'" => 'isya'];
@endphp

@section('content')

    {{-- ================= CAROUSEL ================= --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-pause="hover">
        <div class="carousel-inner">
            @foreach ($slideshows as $slide)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" loading="lazy"
                        class="d-block w-100 rounded-3">

                    <div class="carousel-caption d-none d-md-block text-start">
                        <h5 class="fw-bold">{{ $slide->title }}</h5>
                        <p class="mb-0">{{ $slide->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ================= KAJIAN TERDEKAT ================= --}}
    @if ($nextKajian)
        <div class="container my-5">
            <div class="row justify-content-between align-items-center bg-brown-gradient rounded-3 shadow p-4 glass lift">
                <div class="col-md-6 text-md-start text-center">
                    <h3 class="text-white mb-2">Kajian Terdekat</h3>
                    <div class="divider mx-auto mx-md-0"></div>

                    <h2 class="fw-bold text-white mt-3 mb-2">
                        {{ $nextKajian->jeniskajian->name }} {{ $nextKajian->title }}
                    </h2>

                    <p class="text-white mb-0">
                        Oleh <strong>{{ $nextKajian->ustadz->name }}</strong>
                    </p>

                    <small class="text-white-50 d-block mt-2">
                        Mulai: {{ \Carbon\Carbon::parse($nextKajian->start_time)->translatedFormat('d F Y, H:i') }} WIB
                    </small>
                </div>

                <div class="col-md-6 text-md-end text-center mt-4 mt-md-0">
                    <p class="text-white mb-2">InsyaAllah akan dimulai dalam:</p>
                    <div id="timer" class="fw-bold text-white fs-2"></div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-4 text-white shadow-sm" style="background-color:#854321;">
            <h2 class="section-heading mb-2 text-white animate-fadein">Tidak ada Kajian untuk saat ini.</h2>
            <div class="divider mx-auto"></div>
        </div>
    @endif

    {{-- ======= Wave separator sebelum Jadwal Sholat ======= --}}
    <div class="wave">
        <svg viewBox="0 0 1440 120" width="100%" height="120" preserveAspectRatio="none">
            <path d="M0,64 C240,128 480,0 720,48 C960,96 1200,96 1440,48 L1440,120 L0,120 Z" fill="#622200"></path>
        </svg>
    </div>

    {{-- ================= JADWAL SHOLAT ================= --}}
    <section id="jadwalsholat" class="bg-brown text-white" role="region" aria-labelledby="jadwal-heading">
        <div class="container py-5">
            <div class="row align-items-start justify-content-between gy-4">

                <div class="col-12 col-md-4">
                    <header class="mb-4 text-center text-md-start">
                        <h3 id="jadwal-heading" class="section-heading fw-bold mb-2 text-white d-inline-block">
                            Jadwal Shalat
                        </h3>
                        <div class="divider mx-auto mx-md-0"></div>

                        <p class="fw-bold mt-2 mb-1">
                            <i class="bi bi-geo-fill"></i>
                            Surabaya, {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y') }}
                        </p>

                        <small class="text-white-50 d-block">
                            Data jadwal sholat mengikuti sumber yang tersedia.
                        </small>
                    </header>
                </div>

                <div class="col-12 col-md-4">
                    <article class="p-3 rounded-3 glass lift" aria-label="Imsak hingga Dhuha">
                        @if ($jadwal)
                            <dl class="pray-times m-0">
                                @foreach ($timesLeft as $label => $key)
                                    <div class="pray-item">
                                        <dt>{{ $label }}</dt>
                                        <dd><span class="badge">{{ $jadwal[$key] ?? '-' }}</span></dd>
                                    </div>
                                @endforeach
                            </dl>
                        @else
                            <div class="text-white-50">Data tidak tersedia.</div>
                        @endif
                    </article>
                </div>

                <div class="col-12 col-md-4">
                    <article class="p-3 rounded-3 glass lift" aria-label="Dzuhur hingga Isya">
                        @if ($jadwal)
                            <dl class="pray-times m-0">
                                @foreach ($timesRight as $label => $key)
                                    <div class="pray-item">
                                        <dt>{{ $label }}</dt>
                                        <dd><span class="badge">{{ $jadwal[$key] ?? '-' }}</span></dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif
                    </article>
                </div>

            </div>
        </div>
    </section>

    {{-- ======= Wave separator sesudah Jadwal Sholat ======= --}}
    <div class="wave-reverse" style="background-color:#622200;">
        <svg viewBox="0 0 1440 120" width="100%" height="120" preserveAspectRatio="none">
            <path d="M0,64 C240,128 480,0 720,48 C960,96 1200,96 1440,48 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>

    {{-- ================= BIDANG & LAYANAN ================= --}}
    <section class="section section-bidang text-center" data-aos="fade-up">
        <div class="container">
            <h3 class="section-heading fw-bold mb-2">Bidang & Layanan</h3>
            <div class="divider mx-auto"></div>
        </div>
    </section>

    <div id="divisioncard" class="container my-5" data-aos="fade-up">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3">
                <a href="{{ url('/') }}" class="division-item text-decoration-none" aria-label="Kemasjidan">
                    <div class="division-icon"><i class="bi bi-moon-stars"></i></div>
                    <h5 class="division-label mt-2">Kemasjidan</h5>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="{{ route('pendidikan') }}" target="_blank" class="division-item text-decoration-none"
                    aria-label="Pendidikan">
                    <div class="division-icon"><i class="bi bi-mortarboard"></i></div>
                    <h5 class="division-label mt-2">Pendidikan</h5>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="https://example.com/sosial" target="_blank" class="division-item text-decoration-none"
                    aria-label="Sosial">
                    <div class="division-icon"><i class="bi bi-people"></i></div>
                    <h5 class="division-label mt-2">Sosial</h5>
                </a>
            </div>

            <div class="col-6 col-md-3">
                <a href="https://example.com/usaha" target="_blank" class="division-item text-decoration-none"
                    aria-label="Usaha">
                    <div class="division-icon"><i class="bi bi-bank"></i></div>
                    <h5 class="division-label mt-2">Usaha</h5>
                </a>
            </div>
        </div>
    </div>

    {{-- ================= TOTAL INFAQ ================= --}}
    <section class="section section-bidang text-center" data-aos="fade-up">
        <div class="container">
            <h3 class="section-heading fw-bold mb-2">Total Infaq Masuk</h3>
            <div class="divider mx-auto"></div>
        </div>
    </section>

    <div id="totalinfaq" class="container-sm mt-4">
        <div class="row g-4 align-items-stretch">

            {{-- KIRI: LIST INFAQ TERBARU --}}
            <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1000">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <h4 class="fs-5 mb-0">Daftar Infaq Terbaru</h4>
                        <span class="badge rounded-pill bg-brown-light text-white fw-semibold">Update</span>
                    </div>

                    <div class="card-body pt-3">
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tujuan Infaq</th>
                                        <th class="text-end">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentJamaah as $jamaah)
                                        <tr>
                                            <td class="text-nowrap">{{ $jamaah->nama }}</td>
                                            <td>{{ $jamaah->Infaq->name ?? 'N/A' }}</td>
                                            <td class="text-end fw-semibold text-nowrap">
                                                Rp {{ number_format($jamaah->nominal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">
                                                Belum ada data infaq.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: TOTAL + REKENING --}}
            <div class="col-lg-5" data-aos="fade-left" data-aos-duration="1000">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header border-0">
                        <h4 class="fs-5 mb-0">Total Infaq Masuk</h4>
                    </div>

                    <div class="card-body">
                        <span class="text-muted d-block small mb-2">Total terkumpul</span>
                        <h2 class="fw-bold mb-2">
                            Rp {{ number_format($totalInfaq, 0, ',', '.') }}
                        </h2>

                        <p class="small text-muted mb-3">
                            Last Update:
                            {{ $lastUpdate ? $lastUpdate->format('d-m-Y H:i:s') : 'Belum ada data' }}
                        </p>

                        <hr class="my-3">

                        <div class="row align-items-center g-3">
                            <div class="col-4 text-center">
                                <img src="/images/logobsi.png" alt="Logo Bank" class="img-fluid"
                                    style="max-width: 140px;">
                            </div>
                            <div class="col-8">
                                <p class="small text-muted mb-1">Informasi No. Rekening</p>
                                <h6 class="mb-1">Bank Syariah Indonesia</h6>
                                <div class="h4 fw-bold mb-1">6011333336</div>
                                <p class="mb-0 small text-muted">A/N YYS Masjid Al Iman Sutorejo Indah</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= FORM INFAQ ================= --}}
    <section class="section section-bidang text-center" data-aos="fade-up">
        <div class="container">
            <h3 class="section-heading fw-bold mb-2">Siapkan Infaq Terbaikmu</h3>
            <div class="divider mx-auto"></div>
        </div>
    </section>

    <div id="infaq" class="container-sm mt-2" data-aos="fade-in" data-aos-duration="1000">
        <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold mb-1">Form Pencatatan Infaq</h4>
                                <small class="text-muted">Data pribadi jamaah kami pastikan tidak terpublikasikan.</small>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text"
                                        name="nama" id="nama"
                                        value="{{ Auth::check() ? Auth::user()->name : old('nama') }}"
                                        placeholder="Masukkan Nama">
                                    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() : '' }}">
                                    @error('nama')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="nomor" class="form-label">No. Handphone</label>
                                    <input class="form-control @error('nomor') is-invalid @enderror" type="text"
                                        name="nomor" id="nomor"
                                        value="{{ Auth::check() ? Auth::user()->nomor : old('nomor') }}"
                                        placeholder="Masukkan No. HP">
                                    @error('nomor')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input class="form-control @error('alamat') is-invalid @enderror" type="text"
                                        name="alamat" id="alamat" value="{{ old('alamat') }}"
                                        placeholder="Masukkan Alamat">
                                    @error('alamat')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="nominal" class="form-label">Nominal Infaq</label>
                                    <input class="form-control @error('nominal') is-invalid @enderror" type="number"
                                        name="nominal" id="nominal" value="{{ old('nominal') }}"
                                        placeholder="Masukkan Nominal Infaq">
                                    @error('nominal')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="infaq" class="form-label">Tentukan tujuan Infaqmu</label>
                                    <select name="infaq" id="infaq"
                                        class="form-select @error('infaq') is-invalid @enderror">
                                        @foreach ($infaqs as $Infaq)
                                            <option value="{{ $Infaq->id }}"
                                                {{ old('infaq') == $Infaq->id ? 'selected' : '' }}>
                                                {{ $Infaq->code . ' - ' . $Infaq->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('infaq')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="formFile" class="form-label">Upload Bukti Transfer</label>
                                    <input class="form-control @error('file') is-invalid @enderror" type="file"
                                        id="formFile" name="file">
                                    @error('file')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 d-grid mt-2">
                                    <button type="submit" class="btn btn-brown">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- ================= FEEDBACK ================= --}}
    <section class="section section-bidang text-center" data-aos="fade-up">
        <div class="container">
            <h3 class="section-heading fw-bold mb-2">Layanan Kritik & Saran</h3>
            <div class="divider mx-auto"></div>
        </div>
    </section>

    <div id="feedback" class="container-sm mt-2 mb-5" data-aos="fade-up">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <div class="mb-4">
                    <h4 class="fw-bold mb-1">Silahkan isi Masukan/Saran</h4>
                    <small class="text-muted">Masukan jamaah sangat kami harapkan untuk kemakmuran masjid.</small>
                </div>

                <form action="{{ route('feedback.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control"
                            value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Nama" required>
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" name="nomor" class="form-control"
                            value="{{ Auth::check() ? Auth::user()->nomor : '' }}" placeholder="Masukkan Nomor HP"
                            required>
                        @error('nomor')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <textarea name="message" class="form-control" rows="5" placeholder="Sampaikan saran & pesan untuk kami."
                            required></textarea>
                        @error('message')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-whatsapp"></i> Kirim Saran & Masukan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= FOOTER ================= --}}
    <div class="wave-reverse" style="background-color: white">
        <svg viewBox="0 0 1440 120" width="100%" height="120" preserveAspectRatio="none">
            <path d="M0,64 C240,128 480,0 720,48 C960,96 1200,96 1440,48 L1440,120 L0,120 Z" fill="#854321"></path>
        </svg>
    </div>

    <footer id="footer" class="footer text-white" style="background-color: #854321">
        <div class="container py-5">
            <div class="row g-4">

                <div class="col-lg-4">
                    <img src="/images/logowhite.png" alt="Logo Masjid Al Iman Sutorejo Indah" class="mb-4"
                        style="max-width: 100px;">

                    <ul class="list-unstyled footer-list">
                        <li class="mb-2 d-flex gap-2">
                            <i class="bi bi-map"></i>
                            <span>JL. Sutorejo Tengah X/2-4 Dukuh Sutorejo - Mulyorejo, Surabaya, Jawa Timur 60113</span>
                        </li>
                        <li class="mb-2 d-flex gap-2">
                            <i class="bi bi-telephone"></i>
                            <span>0853 6936 9517</span>
                        </li>
                        <li class="mb-2 d-flex gap-2">
                            <i class="bi bi-envelope-paper-heart"></i>
                            <span>masjidalimansurabaya@gmail.com</span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h5 class="mb-3">Kajian</h5>
                    <ul class="list-unstyled footer-list">
                        <li class="mb-2">Kajian Hari Besar Islam</li>
                        <li class="mb-2">Kajian Rutin Ahad Pagi</li>
                        <li class="mb-2">Kajian Tafsir Qur'an</li>
                    </ul>

                    <h5 class="mt-4 mb-3">Kegiatan</h5>
                    <ul class="list-unstyled footer-list">
                        <li class="mb-2">Pesantren Mahasiswa</li>
                        <li class="mb-2">Tadarus Al Qur'an</li>
                        <li class="mb-2">Syabab Rimayah Community Al Iman</li>
                        <li class="mb-2">Panitia Ramadhan 1446 H</li>
                        <li class="mb-2">Panitia Idul Adha 1446 H <strong>Coming Soon</strong></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h5 class="mb-3">Profil</h5>
                    <ul class="list-unstyled footer-list">
                        <li class="mb-2">Sejarah</li>
                        <li class="mb-2">Struktur Organisasi</li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>

    <div class="wave-reverse" style="transform: rotate(180deg);">
        <svg viewBox="0 0 1440 120" width="100%" height="120" preserveAspectRatio="none">
            <path d="M0,64 C240,128 480,0 720,48 C960,96 1200,96 1440,48 L1440,120 L0,120 Z" fill="#854321"></path>
        </svg>
    </div>

    <div id="copyright" class="container-fluid py-3" style="background-color: #622200">
        <div class="container">
            <div class="text-center text-white small">
                © 2025 Yayasan Masjid Al Iman Sutorejo Indah Surabaya. All rights reserved
            </div>
        </div>
    </div>

    {{-- Floating WhatsApp + Back to Top --}}
    <a href="https://wa.me/6285369369517" target="_blank"
        class="btn btn-success fab-top lift d-flex align-items-center gap-2">
        <i class="bi bi-whatsapp fs-5"></i><span class="d-none d-md-inline">Hubungi Kami</span>
    </a>

    <button id="toTop" type="button" class="btn btn-success fab-top lift">
        <i class="bi bi-arrow-up"></i>
    </button>

    @if (request()->has('verified') && request('verified') == 1)
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Verifikasi Berhasil!',
                        text: 'Email Anda berhasil diverifikasi.',
                        confirmButtonColor: '#622200'
                    });
                });
            </script>
        @endpush
    @endif

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Countdown kajian
                (function() {
                    const timer = document.getElementById('timer');
                    if (!timer) return;

                    @if ($nextKajian)
                        const countDownDate = new Date(@json($nextKajian->start_time)).getTime();

                        const interval = setInterval(() => {
                            const now = Date.now();
                            const distance = countDownDate - now;

                            if (distance < 0) {
                                clearInterval(interval);
                                timer.textContent = "Kajian telah dimulai";
                                return;
                            }

                            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            timer.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                        }, 1000);
                    @else
                        timer.textContent = "";
                    @endif
                })();

                // Back to top
                (function() {
                    const toTop = document.getElementById('toTop');
                    if (!toTop) return;

                    window.addEventListener('scroll', () => {
                        toTop.style.display = (window.scrollY > 320) ? 'inline-block' : 'none';
                    });

                    toTop.addEventListener('click', () => {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                })();

                // Carousel pause/cycle
                (function() {
                    const el = document.getElementById('carouselExampleSlidesOnly');
                    if (!el) return;

                    // Pastikan bootstrap sudah ada
                    if (typeof bootstrap === 'undefined' || !bootstrap.Carousel) return;

                    const carousel = bootstrap.Carousel.getInstance(el) || new bootstrap.Carousel(el);

                    el.addEventListener('mouseenter', () => carousel.pause());
                    el.addEventListener('mouseleave', () => carousel.cycle());
                })();

            });
        </script>
    @endpush
