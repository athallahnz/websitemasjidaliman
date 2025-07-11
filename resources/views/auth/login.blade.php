<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Styling untuk video background */
        #login-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        #login-page video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Styling untuk form login */
        #login-page .bg-white {
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
            /* Menambah lebar pada form login */
            max-width: 100%;
            /* Memastikan form tetap responsif */
            z-index: 1;
            /* Menempatkan form di atas video */
            position: relative;
        }

        #login-page .text-center {
            text-align: center;
        }

        #login-page button {
            background-color: #622200;
        }

        .custom-link {
            text-decoration: none;
            font-weight: bold;
            color: #622200;
            /* Sesuai dengan preferensi warna kamu */
        }

        .custom-link:hover {
            color: #a34b00;
            /* Warna sedikit lebih terang saat hover */
        }

        /* Styling responsif untuk tablet dan mobile pada halaman login */
        @media (max-width: 992px) {

            /* Tablet */
            #login-page .col-md-6 {
                width: 90%;
            }
        }

        @media (max-width: 768px) {

            /* Mobile */
            #login-page .col-md-6 {
                width: 75%;
            }

            #login-page .bg-white {
                padding: 1.5rem;
            }

            #login-page .text-center {
                font-size: 16px;
            }

            #login-page h2,
            #login-page h5 {
                font-size: 20px;
            }

            #login-page .form-control {
                font-size: 14px;
            }

            #login-page button {
                padding: 0.8rem;
                font-size: 14px;
            }
        }
    </style>
</head>

<body id="login-page" class="d-flex align-items-center justify-content-center">

    <!-- Video background -->
    <video autoplay muted loop>
        <source src="{{ asset('videos/video-background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="login-form-container col-md-6 col-lg-4 p-4 bg-white rounded shadow">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="/images/logo.png" href="{{ url('/') }}" class="rounded-circle p-1" alt="Logo"
                    width="150" height="150">
            </a>
        </div>
        <div>
            <h2 class="fw-bold text-center">Selamat Datang di</h2>
            <h5 class="fw-lighter text-center"> Yayasan Masjid Al Iman Surabaya</h5>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mt-4">
                <div class="mb-3">
                    <input type="text" name="email" placeholder="Enter Your Email or Phone" class="form-control"
                        required>
                </div>
                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Enter Your Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="custom-link">{{ __('Forgot Your Password?') }}</a>
                        @endif
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn text-white">
                        <i class="bi-arrow-left-circle me-2"></i> {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>

        <div class="row mt-3">
            <div class="text-center">
                <p>Jamaah Baru di Al Iman?
                    <a href="{{ route('register') }}" class="custom-link">Daftar Jamaah</a>
                </p>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#622200'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#622200'
            });
        </script>
    @endif

</body>

</html>
