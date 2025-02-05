<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="container-fluid">
    <div class="row">
        <div class="col p-4">
            <div class="text-center m-4">
                <img src={{ Vite::asset('resources/images/logo.png')}} class="rounded-circle p-1"
                        alt="" width="150" height="150">
            </div>
            <div>
                <h2 class="fw-bold text-center">Reset Password</h2>
                <h5 class="fw-lighter text-center">Masjid Al Iman Surabaya</h5>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="row justify-content-center mt-4 mb-5">
                    <div class="p-4 bg-light rounded-3 border col-9">
                        <div class="row">
                            <div class="col mb-5">
                                <div class="mb-3">
                                    <input id="email" type="email" placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Your New Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn text-white" style="background-color: #622200">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="text-center mt-3">
                                        <a href="{{ route('login') }}">Back to Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col p-5" style="background-color: #622200">
        </div>
    </div>
</body>

</html>
