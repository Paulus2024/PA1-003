<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">UpConstruction</h1> <span>.</span>
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
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
