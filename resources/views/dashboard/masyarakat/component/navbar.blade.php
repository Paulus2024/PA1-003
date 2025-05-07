<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/index_masyarakat" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
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
        @auth
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="{{ Auth::user()->photo ? asset('storage/profile_photos/' . Auth::user()->photo) : asset('img/default-profile.png') }}"
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
