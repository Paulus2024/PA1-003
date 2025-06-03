<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename" style="font-family: 'Cambria', Georgia, serif;">Desa</h1><span style="font-family: 'Cambria', Georgia, serif;"><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu" style="font-family: 'Cambria', Georgia, serif;">
<<<<<<< HEAD
        <ul>
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Home</a></li>
            <li><a href="{{ route('about.masyarakat') }}" class="{{ request()->is('about') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">About</a></li>
            {{--<!-- <li><a href="{{ route('pengunjung.fasilitas.index') }}">Fasilitas1 Desa</a></li> -->--}}
            <li><a href="/fasilitas" class="{{ request()->is('fasilitas') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Fasilitas Desa</a></li>
            <li><a href="/informasi" class="{{ request()->is('informasi') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Informasi</a></li>
            <li><a href="/galeri" class="{{ request()->is('galeri') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Galeri</a></li>
            <li><a href="/pengurus" class="{{ request()->is('pengurus') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Data Pengurus Desa</a></li>
            <li><a href="/alat" class="{{ request()->is('alat') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Alat Pertanian</a></li>
            <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Contact</a></li>
            <li><a href="/login" style="font-family: 'Cambria', Georgia, serif;">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
=======
    <ul>
        <li><a href="/"class="{{ request()->is('/') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Home</a></li>
        <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">About</a></li>
        {{--<!-- <li><a href="{{ route('pengunjung.fasilitas.index') }}">Fasilitas1 Desa</a></li> -->--}}
        <li><a href="/fasilitas" class="{{ request()->is('fasilitas') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Fasilitas Desa</a></li>
        <li><a href="/informasi" class="{{ request()->is('informasi') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Informasi</a></li>
        <li><a href="/galeri" class="{{ request()->is('galeri') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Galeri</a></li>
        <li><a href="/pengurus" class="{{ request()->is('pengurus') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Data Pengurus Desa</a></li>
        <li><a href="/alat" class="{{ request()->is('alat') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Alat Pertanian</a></li>
        <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Contact</a></li>
        <li><a href="/login" style="font-family: 'Cambria', Georgia, serif;">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

>>>>>>> 7c42151d7880db63d194426690a2925036976c17
    </nav>

</div>
