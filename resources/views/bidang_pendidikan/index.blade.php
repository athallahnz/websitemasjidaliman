@extends('layouts.app')

@section('navbar_pendidikan')
    <!-- Navbar khusus untuk bidang pendidikan -->
    <div class="page-pendidikan">
        <nav class="navbar navbar-expand-lg navbar-light p-3" style="background-color: #622200; padding: 10px 0;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Tentang Kami Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="#">Fasilitas</a></li>
                            <li><a class="dropdown-item" href="#">Guru dan Staff</a></li>
                        </ul>
                    </li>

                    <!-- Program Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="#" id="navbarDropdownProgram" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Program
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownProgram">
                            <li><a class="dropdown-item" href="#">TPQ (Taman Pendidikan Al - Qur'an)</a></li>
                            <li><a class="dropdown-item" href="#">Daycare</a></li>
                            <li><a class="dropdown-item" href="#">Kelompok Bermain</a></li>
                            <li><a class="dropdown-item" href="#">Taman Kanak-kanak</a></li>
                        </ul>
                    </li>

                    <!-- Pendaftaran Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="#" id="navbarDropdownPendaftaran" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pendaftaran
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPendaftaran">
                            <li><a class="dropdown-item" href="#">Prosedur & Persyaratan</a></li>
                            <li><a class="dropdown-item" href="#">Pendaftaran Online</a></li>
                            <li><a class="dropdown-item" href="#">Informasi Selengkapnya</a></li>
                        </ul>
                    </li>

                    <!-- Untuk Orang Tua Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="#" id="navbarDropdownOrtu" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Untuk Orang Tua
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownOrtu">
                            <li><a class="dropdown-item" href="#">Proteksi Anak</a></li>
                            <li><a class="dropdown-item" href="#">Saran & Masukan</a></li>
                        </ul>
                    </li>

                    <!-- Berita -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Berita</a>
                    </li>

                    <!-- Kontak -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
@endsection

@section('content')
    <div class="page-pendidikan">
        <header class="header-banner">
            <video autoplay muted loop class="video-background">
                <source src={{ asset('videos/video-background.mp4') }} type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="header-content">
                <h1 class="h1 header-title">Selamat datang di Pendidikan</h1>
                <h3 class="h3 header-title">Yayasan Masjid Al Iman Surabaya</h3>
                <div class="header-buttons mt-4">
                    <a href="#" class="btn btn-primary btn-lg">Pelajari lebih lanjut</a>
                    <a href="#pendaftaran" class="btn btn-secondary btn-lg">Pendaftaran</a>
                </div>
            </div>
        </header>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Modal di tengah layar -->
                <div class="modal-content">
                    <div class="modal-header">
                        <strong class="modal-title" id="exampleModalLabel">Informasi Penting</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <img src="{{ asset('images/poster-ppdb-2425.jpg') }}" class="img-fluid" alt="poster"
                            style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>

        <div id="stats" class="stats-section py-5" style="background-color: #FBC02D;">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-3">
                        <h1 class="display-4 fw-bold text-white counter" data-target="31"></h1>
                        <p class="text-white">Tahun Pendidikan Berkualitas</p>
                    </div>
                    <div class="col-md-3">
                        <h1 class="display-4 fw-bold text-white counter" data-target="100"></h1>
                        <p class="text-white">Alumni</p>
                    </div>
                    <div class="col-md-3">
                        <h1 class="display-4 fw-bold text-white counter" data-target="4"></h1>
                        <p class="text-white">Program Pendidikan</p>
                    </div>
                    <div class="col-md-3">
                        <h1 class="display-4 fw-bold text-white counter" data-target="50"></h1>
                        <p class="text-white">m2 Fasilitas Kelas Exclusive</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="isi konten" class="container mt-5">
            <!-- Profil Sub Bidang Pendidikan -->
            <section data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200" id="profil" class="my-5">
                <h2 class="text-center mb-4 fw-bold">Gambaran Pendidikan</h2>
                <p class="text-center mb-5 px-5">Melalui berbagai program pendidikan berkualitas, kami berkomitmen untuk
                    menciptakan generasi penerus yang cerdas, berakhlak mulia, dan berdaya saing global dengan pendekatan
                    holistik yang berbasis nilai keislaman dan kearifan lokal.</p>
                <div class="row">
                    <!-- TPQ -->
                    <div class="col-md-3" data-aos="fade-in" data-aos-duration="2000" data-aos-delay="200">
                        <div class="card">
                            <img src={{ asset('images/sholat-ied.JPG') }} class="card-img-top" alt="TPQ">
                            <div class="card-body">
                                <h5 class="card-title">TPQ</h5>
                                <p class="card-text">Taman Pendidikan Al-Qur'an sebagai pengajaran dasar untuk anak-anak.
                                </p>
                                <a href="#" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!-- Daycare -->
                    <div class="col-md-3" data-aos="fade-in" data-aos-duration="3000" data-aos-delay="300">
                        <div class="card">
                            <img src={{ asset('images/sholat-ied.JPG') }} class="card-img-top" alt="Daycare">
                            <div class="card-body">
                                <h5 class="card-title">Daycare</h5>
                                <p class="card-text">Fasilitas perawatan anak yang aman dan nyaman.</p>
                                <a href="#" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!-- Kelompok Bermain -->
                    <div class="col-md-3" data-aos="fade-in" data-aos-duration="4000" data-aos-delay="400">
                        <div class="card">
                            <img src={{ asset('images/sholat-ied.JPG') }} class="card-img-top" alt="Kelompok Bermain">
                            <div class="card-body">
                                <h5 class="card-title">Kelompok Bermain</h5>
                                <p class="card-text">Aktivitas edukatif dan sosial untuk anak usia dini.</p>
                                <a href="#" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!-- Taman Kanak-kanak -->
                    <div class="col-md-3" data-aos="fade-in" data-aos-duration="5000" data-aos-delay="500">
                        <div class="card">
                            <img src={{ asset('images/sholat-ied.JPG') }} class="card-img-top" alt="Taman Kanak-kanak">
                            <div class="card-body">
                                <h5 class="card-title">Taman Kanak-kanak</h5>
                                <p class="card-text">Pendidikan dasar sebelum anak memasuki sekolah dasar.</p>
                                <a href="#" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Pendaftaran Online -->
            <section id="pendaftaran" class="my-5 text-center">
                <h2 class="mb-4 fw-bold">Informasi Pendaftaran</h2>
                {{-- <a href="{{ route('pendaftaran.informasi') }}" class="btn btn-primary btn-lg">Informasi Pendaftaran</a> --}}
                <a href="#" class="btn btn-primary">Informasi Pendaftaran</a>
            </section>

            <!-- Galeri Kegiatan -->
            <section id="galeri" class="my-5">
                <h2 class="text-center mb-4 fw-bold">Galeri Kegiatan</h2>
                <div class="row">
                    <div class="col-md-4">
                        <img src={{ asset('images/sholat-ied.JPG') }} class="img-fluid" alt="Kegiatan 1">
                    </div>
                    <div class="col-md-4">
                        <img src={{ asset('images/sholat-ied.JPG') }} class="img-fluid" alt="Kegiatan 2">
                    </div>
                    <div class="col-md-4">
                        <img src={{ asset('images/sholat-ied.JPG') }} class="img-fluid" alt="Kegiatan 3">
                    </div>
                </div>
            </section>

            <!-- Kontak -->
            <section id="kontak" class="my-5">
                <div class="container py-5 px-4">
                    <div class="row py-2 px-4">
                        <div class="container">
                            <div class="row align-items-start">
                                <!-- Kolom Kiri: Logo dan Kontak -->
                                <div class="col-md-6">
                                    <a href="#" class="logo text-decoration-none">
                                        <div class="d-flex align-items-start">
                                            <img class="img-fluid mb-4"
                                                src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo Al Iman"
                                                width="90">
                                        </div>
                                    </a>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                                <div class="col">
                                                    Jl. Pendidikan No. 12, Surabaya
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                                <div class="col">
                                                    <a href="tel:+62311234567">(031) 1234567</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <i class="bi bi-envelope"></i>
                                                </div>
                                                <div class="col">
                                                    <a href="mailto:info@alimansurabaya.com">info@alimansurabaya.com</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Kolom Kanan: Informasi Navbar -->
                                <div class="col-md-6">
                                    <h5 class="mb-4">Informasi Selengkapnya</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-3"><a href="#">Pendaftaran</a></li>
                                        <li class="mb-3"><a href="#">Kegiatan</a></li>
                                        <li class="mb-3"><a href="#">Galeri</a></li>
                                        <li class="mb-3"><a href="#">Profil</a></li>
                                        <li class="mb-3"><a href="#">Kontak Kami</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <div id="copyright" class="container-fluid py-3" style="background-color: #622200">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 text-center" style="color: white;">Yayasan Masjid Al Iman Sutorejo
                        Indah
                        Surabaya | ©2024</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // JavaScript Animation NavBar

        document.querySelectorAll('.nav-item.dropdown').forEach(item => {
            item.addEventListener('mouseenter', () => {
                const dropdownMenu = item.querySelector('.dropdown-menu');
                dropdownMenu.style.display = 'block';
                dropdownMenu.style.opacity = '0';
                dropdownMenu.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    dropdownMenu.style.opacity = '1';
                    dropdownMenu.style.transform = 'translateY(0)';
                    dropdownMenu.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                }, 10);
            });

            item.addEventListener('mouseleave', () => {
                const dropdownMenu = item.querySelector('.dropdown-menu');
                dropdownMenu.style.opacity = '0';
                dropdownMenu.style.transform = 'translateY(20px)';
                dropdownMenu.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                setTimeout(() => {
                    dropdownMenu.style.display = 'none';
                }, 300);
            });
        });

        // JavaScript Animation Counter
        const counters = document.querySelectorAll('.counter');
        const speed = 100;

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const increment = target / speed;

            const updateCounter = () => {
                const current = +counter.innerText;
                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(updateCounter, 10);
                } else {
                    counter.innerText = target;
                }
            };

            updateCounter();
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        });

        counters.forEach(counter => observer.observe(counter));

        // JavaScript Modal

        window.addEventListener('load', function () {
        setTimeout(function () {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        }, 1500);  
    });

        // Javascript Animation AOS

        AOS.init();
    </script>
@endpush
