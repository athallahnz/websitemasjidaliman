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
        <h1 class="mb-4">Semua Program Pendidikan</h1>
        <p>Jelajahi berbagai program pendidikan yang kami tawarkan, mulai dari TPQ hingga Taman Kanak-kanak.</p>

        <div class="list-group">
            <a href="{{ route('pendidikan.program.tpq') }}" class="list-group-item list-group-item-action">TPQ (Taman
                Pendidikan Al - Qur'an)</a>
            <a href="{{ route('pendidikan.program.daycare') }}" class="list-group-item list-group-item-action">Daycare</a>
            <a href="{{ route('pendidikan.program.kb') }}" class="list-group-item list-group-item-action">Kelompok
                Bermain</a>
            <a href="{{ route('pendidikan.program.tk') }}" class="list-group-item list-group-item-action">Taman
                Kanak-kanak</a>
        </div>
    </div>
@endsection
