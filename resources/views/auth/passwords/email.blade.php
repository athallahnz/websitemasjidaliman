<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot Password</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        #forgot-page {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        #forgot-page video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .form-container {
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
            max-width: 100%;
            z-index: 1;
            position: relative;
            background-color: white;
        }

        .custom-link {
            text-decoration: none;
            font-weight: bold;
            color: #622200;
        }

        .custom-link:hover {
            color: #a34b00;
        }
    </style>
</head>

<body id="forgot-page" class="d-flex align-items-center justify-content-center">

    <!-- Video Background -->
    <video autoplay muted loop>
        <source src="{{ asset('videos/video-background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Form Container -->
    <div class="form-container text-center">
        <a href="{{ url('/') }}">
            <img src="/images/logo.png" class="rounded-circle p-1 mb-4" alt="Logo" width="150" height="150">
        </a>

        <h2 class="fw-bold mb-1">{{ __('Reset Password') }}</h2>
        <h5 class="fw-lighter mb-4">Masjid Al Iman Surabaya</h5>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3 text-start">
                <input type="email" id="email" name="email" placeholder="Enter Your Email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                    autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn text-white" style="background-color: #622200">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>

            <div class="mt-4">
                <a href="{{ route('login') }}" class="custom-link">Back to Login</a>
            </div>
        </form>
    </div>
</body>

</html>
