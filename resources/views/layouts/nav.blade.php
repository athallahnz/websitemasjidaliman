<nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" width="62" height="62">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item px-3">
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <a class="nav-link" href="{{ url('/home') }}">Dashboard Infaq</a>
                    @else
                        <a class="nav-link" href="{{ url('/homeuser') }}">Infaqku</a>
                    @endif
                </li>
                <li class="nav-item px-3">
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <a class="nav-link" href="{{ url('/kajians') }}">Dashboard Kajian</a>
                    @else
                        <a class="nav-link" href="{{ url('user/kajians') }}">Kajian</a>
                    @endif
                </li>
                <li class="nav-item px-3">
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <a class="nav-link" href="{{ url('/slideshow') }}">Dashboard Slideshow</a>
                    @else
                        <a class="nav-link" href="#">Kegiatan</a>
                    @endif
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <strong>Sejarah</strong>
                                <p class="small mb-0">Pembangunan yang berkesinambungan mengharuskan adanya suatu
                                    perencanaan jangka panjang.</p>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="https://drive.google.com/file/d/1mlKAQmGScW1LiuNoznt4NKvKXQBRfe-a/view?usp=sharing"
                                target="_blank">
                                <strong>Struktur Organisasi</strong>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn m-2 px-4 text-white" style="background-color: #622200"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn m-2 px-4 text-white" style="background-color: #622200"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown px-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
