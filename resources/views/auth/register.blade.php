<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Styling untuk video background */
        #register-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        #register-page video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Styling untuk form register */
        #register-page .bg-white {
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
            /* Menambah lebar pada form register */
            max-width: 100%;
            /* Memastikan form tetap responsif */
            z-index: 1;
            /* Menempatkan form di atas video */
            position: relative;
        }

        #register-page .text-center {
            text-align: center;
        }

        #register-page button {
            background-color: #622200;
        }

        /* Styling responsif untuk tablet dan mobile pada halaman register */
        @media (max-width: 992px) {

            /* Tablet */
            #register-page .col-md-6 {
                width: 90%;
            }
        }

        @media (max-width: 768px) {

            /* Mobile */
            #register-page .col-md-6 {
                width: 100%;
            }

            #register-page .bg-white {
                padding: 1.5rem;
            }

            #register-page .text-center {
                font-size: 16px;
            }

            #register-page h2,
            #register-page h5 {
                font-size: 20px;
            }

            #register-page .form-control {
                font-size: 14px;
            }

            #register-page button {
                padding: 0.8rem;
                font-size: 14px;
            }
        }
    </style>
</head>

<body id="register-page" class="d-flex align-items-center justify-content-center">

    <!-- Video background -->
    <video autoplay muted loop>
        <source src="{{ asset('videos/video-background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="register-form-container col-md-6 col-lg-4 p-4 bg-white rounded shadow">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded-circle p-1" alt="Logo" width="150" height="150">
            </a>
        </div>
        <div>
            <h2 class="fw-bold text-center">Selamat Datang di</h2>
            <h5 class="fw-lighter text-center">Yayasan Masjid Al Iman Surabaya</h5>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mt-4">
                <div class="mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Masukkan Nama">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required placeholder="Masukkan Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="nomor" type="text" class="form-control @error('nomor') is-invalid @enderror"
                        name="nomor" value="{{ old('nomor') }}" required placeholder="Masukkan Nomor HP">
                    @error('nomor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Masukkan Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Masukkan Ulang Password">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn text-white">
                        <i class="bi bi-box-arrow-in-left"></i> {{ __('Register') }}
                    </button>
                </div>

                <div class="row mt-3">
                    <div class="text-center">
                        <p>Sudah punya akun? <a href="{{ route('login') }}">Log in disini</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
