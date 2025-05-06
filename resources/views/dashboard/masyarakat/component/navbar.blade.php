<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">UpConstruction</h1> <span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('index.masyarakat')}}" class="{{Request::is('index_masyarakat') ? 'active' : ''}}">Home</a></li>
        <li><a href="{{ route('about.masyarakat')}}" class="{{Request::is('about_masyarakat') ? 'active' : ''}}">About</a></li><!-- (nama route) about.masyarakat akan menghasilkan URL about_masyarakat dan ini yang di buat di bagian href dan request -->
        <li><a href="{{ route('fasilitas.masyarakat')}}" class="{{Request::is('fasilitas_masyarakat') ? 'active' : ''}}" >Fasilitas Desa</a></li>
        <li><a href="{{ route('informasi.masyarakat')}}" class="{{Request::is('informasi_masyarakat') ? 'active' : ''}}">Informasi</a></li>
        <li><a href="{{ route('galeri.masyarakat')}}" class="{{Request::is('galeri_masyarakat') ? 'active' : ''}}">Galeri</a></li>
        <li><a href="{{ route('data_pengurus_desa.masyarakat')}}" class="{{Request::is('data_pengurus_desa_masyarakat')}}">Data Pengurus Desa</a></li>
        <li><a href="{{ route('alat_pertanian.masyarakat')}}" class="{{Request::is('alat_pertanian_masyarakat')}}">Alat Pertanian</a></li>
        <li><a href="{{ route('contact')}}" class="{{Request::is('contact')}}">Contact</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
