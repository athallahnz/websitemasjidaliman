@extends('layouts.app')

@section('navbar_pendidikan')
    <!-- Navbar khusus untuk bidang pendidikan -->
    <div class="page-pendidikan">
        <nav class="navbar navbar-expand-lg navbar-light p-3" style="background-color: #622200; padding: 10px 0;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="{{ route('pendidikan.about_us.index') }}"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tentang Kami
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('pendidikan.about_us.vision') }}">Visi Misi</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('pendidikan.about_us.facility') }}">Fasilitas</a></li>
                                <li><a class="dropdown-item" href="{{ route('pendidikan.about_us.staff') }}">Guru dan
                                        Staff</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="{{ route('pendidikan.program.index') }}"
                                id="navbarDropdownProgram" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Program
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProgram">
                                <li><a class="dropdown-item" href="{{ route('pendidikan.program.tpq') }}">TPQ (Taman
                                        Pendidikan Al - Qur'an)</a></li>
                                <li><a class="dropdown-item" href="{{ route('pendidikan.program.daycare') }}">Daycare</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('pendidikan.program.kb') }}">Kelompok
                                        Bermain</a></li>
                                <li><a class="dropdown-item" href="{{ route('pendidikan.program.tk') }}">Taman
                                        Kanak-kanak</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle"
                                href="{{ route('pendidikan.registration.index') }}" id="navbarDropdownPendaftaran"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pendaftaran
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownPendaftaran">
                                <li><a class="dropdown-item"
                                        href="{{ route('pendidikan.registration.procedure') }}">Prosedur & Persyaratan</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('pendidikan.registration.online') }}">Pendaftaran Online</a></li>
                                <li><a class="dropdown-item" href="{{ route('pendidikan.registration.info') }}">Informasi
                                        Selengkapnya</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle"
                                href="{{ route('pendidikan.for_parent.index') }}" id="navbarDropdownOrtu" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Untuk Orang Tua
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownOrtu">
                                <li><a class="dropdown-item"
                                        href="{{ route('pendidikan.for_parent.protection') }}">Proteksi Anak</a></li>
                                <li><a class="dropdown-item" href="{{ route('pendidikan.for_parent.feedback') }}">Saran &
                                        Masukan</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('pendidikan.news.index') }}">Berita</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('pendidikan.contact.index') }}">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Visi & Misi Kami</h1>
        <p>Halaman ini berisi detail Visi, Misi, dan tujuan dari bidang pendidikan Yayasan Masjid Al Iman Surabaya.</p>

        <h2>Visi</h2>
        <p>Menjadi lembaga PAUD unggulan yang membentuk generasi usia dini yang berakhlakul karimah, cerdas, dan mandiri, melalui proses pembelajaran yang menyenangkan, kreatif, dan bermakna bersama guru yang kompeten dan penuh kasih sayang</p>

        <h2>Misi</h2>
        <ul>
            <li>Menanamkan nilai-nilai akhlak mulia dalam setiap kegiatan harian anak melalui keteladanan guru dan pembiasaan positif.</li>
            <li>Mengembangkan potensi kecerdasan anak secara menyeluruh (intelektual, emosional, sosial, dan spiritual) melalui pendekatan bermain sambil belajar.</li>
            <li>Membentuk kemandirian anak sejak dini dengan memberi ruang untuk mencoba, bereksplorasi, dan membuat pilihan dalam kegiatan sehari-hari.</li>
            <li>Menciptakan lingkungan belajar yang aman, menyenangkan, dan stimulatif, agar anak tumbuh menjadi pribadi yang percaya diri dan berkarakter.</li>
            <li>Meningkatkan kompetensi guru secara berkelanjutan, agar mampu menjadi fasilitator, pendidik, dan teladan yang baik bagi anak.</li>
            <li>Menjalin kolaborasi yang erat dengan orang tua dalam proses pengasuhan dan pendidikan anak usia dini.</li>
        </ul>

        <a href="{{ route('pendidikan.about_us.index') }}" class="btn btn-secondary mt-3">Kembali ke Tentang Kami</a>
    </div>
@endsection
