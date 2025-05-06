<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span>Taon Marisi</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/" class="active">Home</a></li>
        <li><a href="/about">About</a></li>
        {{--<!-- <li><a href="{{ route('pengunjung.fasilitas.index') }}">Fasilitas1 Desa</a></li> -->--}}
        <li><a href="/fasilitas">Fasilitas Desa</a></li>
        <li><a href="/informasi">Informasi</a></li>
        <li><a href="/galeri">Galeri</a></li>
        <li><a href="/pengurus">Data Pengurus Desa</a></li>
        <li><a href="/alat">Alat Pertanian</a></li>
        <li><a href="/contact">Contact</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

    </nav>

</div>
