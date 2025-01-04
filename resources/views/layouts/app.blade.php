<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masjid Al Iman Surabaya</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

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
        @vite('resources/js/app.js')
        @include('sweetalert::alert')
        @stack('scripts')
    </div>
</body>

</html>
