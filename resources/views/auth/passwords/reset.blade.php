<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        #reset-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        #reset-page video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        #reset-page .bg-white {
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
            max-width: 100%;
            z-index: 1;
            position: relative;
        }

        #reset-page .text-center {
            text-align: center;
        }

        #reset-page button {
            background-color: #622200;
        }

        .custom-link {
            text-decoration: none;
            font-weight: bold;
            color: #622200;
        }

        .custom-link:hover {
            color: #a34b00;
        }

        @media (max-width: 768px) {
            #reset-page .bg-white {
                padding: 1.5rem;
            }

            #reset-page .text-center {
                font-size: 16px;
            }

            #reset-page h2,
            #reset-page h5 {
                font-size: 20px;
            }

            #reset-page .form-control {
                font-size: 14px;
            }

            #reset-page button {
                padding: 0.8rem;
                font-size: 14px;
            }
        }
    </style>
</head>

<body id="reset-page" class="d-flex align-items-center justify-content-center">

    <!-- Video background -->
    <video autoplay muted loop>
        <source src="{{ asset('videos/video-background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="col-md-6 col-lg-4 p-4 bg-white rounded shadow">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="/images/logo.png" class="rounded-circle p-1" alt="Logo" width="150" height="150">
            </a>
        </div>
        <div>
            <h2 class="fw-bold text-center">Reset Password</h2>
            <h5 class="fw-lighter text-center">Masjid Al Iman Surabaya</h5>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mt-4">
                <div class="mb-3">
                    <input id="email" type="email" placeholder="Enter Your Email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Enter Your New Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm New Password">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn text-white">
                        {{ __('Reset Password') }}
                    </button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="custom-link">Back to Login</a>
                </div>
            </div>
        </form>
        @if (session('status'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('status') }}",
                    confirmButtonColor: '#622200'
                });
            </script>
        @endif

    </div>

</body>

</html>
