<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/index_masyarakat" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/index_masyarakat" class="{{ request()->is('index_masyarakat') ? 'active' : '' }}">Home</a></li>
        <li><a href="/about_masyarakat" class="{{ request()->is('about_masyarakat') ? 'active' : '' }}">About</a></li>
        <li><a href="/fasilitas_masyarakat" class="{{ request()->is('fasilitas_masyarakat') ? 'active' : '' }}">Fasilitas Desa</a></li>
        <li><a href="/informasi_masyarakat" class="{{ request()->is('informasi_masyarakat') ? 'active' : '' }}">Informasi</a></li>
        <li><a href="/galeri_masyarakat" class="{{ request()->is('galeri_masyarakat') ? 'active' : '' }}">Galeri</a></li>
        <li><a href="/data_pengurus_desa_masyarakat" class="{{ request()->is('data_pengurus_desa_masyarakat') ? 'active' : '' }}">Data Pengurus Desa</a></li>
        <li><a href="/alat_pertanian_masyarakat" class="{{ request()->is('alat_pertanian_masyarakat') ? 'active' : '' }}">Alat Pertanian</a></li>
        <li><a href="/contact_masyarakat" class="{{ request()->is('contact_masyarakat') ? 'active' : '' }}">Contact</a></li>
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
