<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">UpConstruction</h1> <span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/index_masyarakat" class="active">Home</a></li>
        <li><a href="/about_masyarakat">About</a></li>
        <li><a href="/fasilitas_masyarakat">Fasilitas Desa</a></li>
        <li><a href="/informasi_masyarakat">Informasi</a></li>
        <li><a href="/galeri_masyarakat">Galeri</a></li>
        <li><a href="/data_pengurus_desa_masyarakat">Data Pengurus Desa</a></li>
        <li><a href="/alat_pertanian_masyarakat">Alat Pertanian</a></li>
        <li><a href="/contact_masyarakat">Contact</a></li>
        <li><a href="/login">Login</a></li>
        @auth
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}"
                     alt="Profile" class="rounded-circle" width="32" height="32" style="object-fit: cover;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profil</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>
        @else
        <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
