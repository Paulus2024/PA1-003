<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/index_bumdes" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
    <h1 class="sitename">Desa</h1> <span><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        {{-- <li><a href="{{ route('galleries.index')}}" class="{{ Request::is('galleries') ? 'active' : '' }}">Galeri</a></li> --}}

        <li><a href="/index_bumdes" class="{{ Request::is('index_bumdes') ? 'active' : '' }}"></a></li>
        {{-- <li><a href="/about_bumdes">About</a></li>
        <li><a href="/fasilitas_bumdes">Fasilitas</a></li>
        <li><a href="/informasi_bumdes">Informasi</a></li>
        <li><a href="/galeri_bumdes">Galeri</a></li>
        <li><a href="/data_pengurus_desa_bumdes">Data Pengurus Desa</a></li> --}}
        {{-- <li><a href="/alat_pertanian_bumdes">Alat Pertanian</a></li> --}}
        {{-- <li> <a href="{{ route('alat_pertanian.index') }}" class="{{ Request::is('alat_pertanian_bumdes') ? 'active' : ''  }}"></a> </li> --}}
        <li><a href="/alat_pertanian_bumdes" class="{{ Request::is('alat_pertanian_bumdes') ? 'active' : '' }}">Alat Pertanian</a></li>
        {{-- <li><a href="/contact_bumdes">Contact</a></li> --}}
        @auth
        <li class="dropdown {{ Request::is('profile*') ? 'active' : '' }}">
            <a class="dropdown-toggle" href="#" id="navbarBumdes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Bumdes
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarBumdes">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
        @else
        <li><a href="/login" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
        @endauth
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

</div>
