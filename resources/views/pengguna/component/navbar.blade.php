<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename" style="font-family: 'Cambria', Georgia, serif;">Desa</h1><span style="font-family: 'Cambria', Georgia, serif;"><b>Taonmarisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu" style="font-family: 'Cambria', Georgia, serif;">
        <ul>
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">About</a></li>
            <li><a href="/fasilitas" class="{{ request()->is('fasilitas') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Fasilitas Desa</a></li>

            <li><a href="{{ route('informasi.pengguna')}}" class="{{ request()->is('informasi_pengguna') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Informasi</a></li>

            <li><a href="{{ route('galeri') }}" class="{{ request()->is('galeri') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Galeri</a></li>
            <li><a href="{{ route('pengurus.index') }}" class="{{ request()->is('pengurus') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Data Pengurus Desa</a></li>

            <a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Alat Pertanian</a>

            <li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}" style="font-family: 'Cambria', Georgia, serif;">Contact</a></li>
            <li><a href="{{ route('login') }}" style="font-family: 'Cambria', Georgia, serif;">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
