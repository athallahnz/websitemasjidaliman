<nav class="navbar navbar-expand-md navbar-light navbar-floating">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/logo.png" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <!-- Dashboard Infaq / Infaqku -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ Auth::check() && Auth::user()->hasRole('admin') ? url('/home') : url('/infaqku') }}">
                        {{ Auth::check() && Auth::user()->hasRole('admin') ? 'Dashboard Infaq' : 'Infaqku' }}
                    </a>
                </li>

                <!-- Dashboard Kajian / Kajian -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ Auth::check() && Auth::user()->hasRole('admin') ? url('/kajians') : url('user/kajians') }}">
                        {{ Auth::check() && Auth::user()->hasRole('admin') ? 'Dashboard Kajian' : 'Kajian' }}
                    </a>
                </li>

                <!-- Dashboard Kegiatan / Kegiatan -->
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ Auth::check() && Auth::user()->hasRole('admin') ? url('admin/kegiatan') : url('/kegiatan') }}">
                        {{ Auth::check() && Auth::user()->hasRole('admin') ? 'Dashboard Kegiatan' : 'Kegiatan' }}
                    </a>
                </li>

                <!-- Nav khusus admin untuk Dashboard Slideshow -->
                @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/slideshow') }}">Dashboard Slideshow</a>
                    </li>
                @endif

                <!-- Menu Konsultasi -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/konsultasi') }}">Konsultasi</a>
                </li>

                <li class="nav-item dropdown hover-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>

                    <ul class="dropdown-menu dropdown-menu-pill" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item dropdown-item-pill" href="#">
                                <i class="bi bi-clock-history me-2"></i>Sejarah Masjid
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item-pill"
                                href="https://drive.google.com/file/d/1mlKAQmGScW1LiuNoznt4NKvKXQBRfe-a/view?usp=sharing"
                                target="_blank">
                                <i class="bi bi-diagram-3 me-2"></i>Struktur Organisasi
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
                    <li class="nav-item dropdown hover-dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-pill dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item dropdown-item-pill" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
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
