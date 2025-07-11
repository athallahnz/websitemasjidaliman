    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Yayasan Masjid Al Iman Surabaya</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- Custom CSS dari Laravel Mix -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        <!-- AOS (Animate on Scroll) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Laravel Mix -->
        <script src="{{ asset('js/app.js') }}" defer type="module"></script>
    </head>

    <style>
        .navbar-collapse {
            transition: height 0.3s ease-in-out;
        }

        .icon-container {
            width: 70px;
            height: 70px;
            background-color: #622200;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
        }

        .icon-image {
            width: 43px;
            height: 43px;
        }

        .icon-style {
            color: #fff;
            font-size: 30px;
        }

        .filter-buttons {
            margin-bottom: 20px;
        }

        /* Tombol Filter Default: Outline Coklat */
        .btn-outline-custom {
            background-color: transparent;
            color: #622200;
            border: 2px solid #622200;
            transition: 0.3s;
        }

        /* Tombol Filter Saat Hover */
        .btn-outline-custom:hover {
            background-color: #622200;
            color: white;
        }

        /* Tombol Filter Saat Aktif */
        .btn-outline-custom.active {
            background-color: #622200;
            color: white;
            border-color: #622200;
        }

        /* Tombol "Lihat Selengkapnya" Full Coklat */
        .btn-custom {
            background-color: #622200;
            color: white;
            border: none;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #4e1a00;
            color: white;
        }

        .container-consultation {
            position: fixed;
            top: 60px;
            /* Pastikan ini sesuai dengan tinggi navbar utama */
            left: 0;
            width: 100%;
            background: #0b5507;
            color: white;
            padding: 12px 20px;
            z-index: 1000;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper {
            margin-top: 120px;
            /* Sesuaikan dengan tinggi navbar + container konsultasi */
        }

        .consultation-header {
            color: white;
            /* Warna teks putih */
            text-align: left;
            /* Rata kiri */
            padding: 12px 15px;
            /* Padding untuk estetika */
            margin: 0;
            /* Hilangkan margin */
            font-size: 22px;
            /* Ukuran font yang sesuai */
            font-weight: bold;
            /* Tebal */
            width: 100%;
            /* Full width */
        }

        .consultation-subtext {
            color: white;
            text-align: left;
            padding: 5px 15px;
            /* Padding lebih kecil */
            font-size: 18px;
        }
    </style>

    <body>
        <div id="app">
            <!-- Navbar Umum (Tampil hanya jika bukan halaman pendidikan) -->
            @unless (request()->is('pendidikan*'))
                @include('layouts.nav')
            @endunless

            <!-- Navbar Khusus Bidang Pendidikan (jika ada) -->
            @yield('navbar_pendidikan')

            <!-- Konten Utama -->
            @yield('content')

            <!-- JavaScript -->
            @include('sweetalert::alert')
            @stack('scripts')
        </div>
    </body>

    </html>
