<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Yayasan Masjid Al Iman Surabaya')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS + Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- AOS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    {{-- DataTables (opsional) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    {{-- CSS Anda --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

@php
    $noOffsetRoutes = ['/', 'infaqku'];
@endphp

<body class="{{ in_array(request()->path(), $noOffsetRoutes) ? '' : 'page-offset' }}"
    style="font-family:'Quicksand',sans-serif;">

    <div id="app">

        {{-- Navbar khusus pendidikan (jika ada) --}}
        @yield('navbar_pendidikan')

        {{-- ===== KONTEN UTAMA ===== --}}
        <main>
            @yield('content')
        </main>

        {{-- ===== NAVBAR UMUM DIPINDAH KE BAWAH ===== --}}
        @unless (request()->is('pendidikan*'))
            <div class="mt-4">
                @include('layouts.nav')
            </div>
        @endunless

    </div>

    {{-- ================= Vendor JS ================= --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js" defer></script>

    <script src="{{ asset('js/app.js') }}" defer type="module"></script>

    @include('sweetalert::alert')

    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.AOS) AOS.init();
        });
    </script>

    @stack('scripts')

</body>

</html>
