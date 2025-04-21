<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">UpConstruction</h1> <span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/index_sekretaris" class="{{ Request::is('index_sekretaris') ? 'active' : '' }}">Home</a></li>
        <li><a href="/about_sekretaris" class="{{ Request::is('about_sekretaris') ? 'active' : '' }}">About</a></li>
        <li><a href="/fasilitas_sekretaris" class="{{ Request::is('fasilitas_sekretaris') ? 'active' : '' }}">Fasilitas</a></li>
        <li><a href="/informasi_sekretaris" class="{{ Request::is('informasi_sekretaris') ? 'active' : '' }}">Informasi</a></li>
        <li><a href="{{ route('galleries.index')}}" class="{{ Request::is('galleries.index') ? 'active' : '' }}">Galeri</a></li>
        <li><a href="{{ route('data_pengurus_desa.index') }}"class="{{ Request::is('data_pengurus_desa_sekretaris*') ? 'active' : '' }}">Data Pengurus Desa</a></li>
        <li><a href="/alat_pertanian_sekretaris" class="{{ Request::is('alat_pertanian_sekretaris') ? 'active' : '' }}">Alat Pertanian</a></li>
        <li><a href="/contact_sekretaris" class="{{Request::is('contact_sekretaris') ? 'active' : '' }}">Contact</a></li>
        <li><a href="/login" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
