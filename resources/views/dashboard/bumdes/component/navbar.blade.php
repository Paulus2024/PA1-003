<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">UpConstruction</h1> <span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('galleries.index')}}" class="{{ Request::is('galleries.index') ? 'active' : '' }}">Galeri</a></li>

        <li><a href="/index_bumdes" class="active">Home</a></li>
        <li><a href="/about_bumdes">About</a></li>
        <li><a href="/fasilitas_bumdes">Fasilitas</a></li>
        <li><a href="/informasi_bumdes">Informasi</a></li>
        <li><a href="/galeri_bumdes">Galeri</a></li>
        <li><a href="/data_pengurus_desa_bumdes">Data Pengurus Desa</a></li>
        <li><a href="/alat_pertanian_bumdes">Alat Pertanian</a></li>
        <li><a href="/contact_bumdes">Contact</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
