<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('about.showPublic') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
        {{--<!-- <li><a href="{{ route('pengunjung.fasilitas.index') }}">Fasilitas1 Desa</a></li> -->--}}
        <li><a href="/fasilitas" class="{{ request()->is('fasilitas') ? 'active' : '' }}">Fasilitas Desa</a></li>
        <li><a href="/informasi" class="{{ request()->is('informasi') ? 'active' : '' }}">Informasi</a></li>
        <li><a href="/galeri" class="{{ request()->is('galeri') ? 'active' : '' }}">Galeri</a></li>
        <li><a href="/pengurus" class="{{ request()->is('pengurus') ? 'active' : '' }}">Data Pengurus Desa</a></li>
        <li><a href="/alat" class="{{ request()->is('alat') ? 'active' : '' }}">Alat Pertanian</a></li>
        <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

    </nav>

</div>
