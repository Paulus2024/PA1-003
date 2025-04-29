<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">UpConstruction</h1> <span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/" class="active">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/fasilitas">Fasilitas</a></li>
        <li><a href="/informasi">Informasi</a></li>
        <li><a href="/galeri">Galeri</a></li>
        <li><a href="/pengurus">Data Pengurus Desa</a></li>
        <li><a href="/alat">Alat Pertanian</a></li>
        <li><a href="/contact">Contact</a></li>
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset(Auth::user()->photo ? 'storage/profile_photos/' . Auth::user()->photo : 'default.png') }}" alt="Profile" class="rounded-circle" width="30" height="30">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
        @else
        <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
