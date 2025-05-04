<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/index_sekretaris" class="logo d-flex align-items-center {{ Request::is('index_sekretaris') ? 'active' : '' }}">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Desa</h1> <span>Taon Marisi</span>
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/index_sekretaris" class="{{ Request::is('index_sekretaris') ? 'active' : '' }}">Home</a></li>
        <li><a href="/about_sekretaris" class="{{ Request::is('about_sekretaris') ? 'active' : '' }}">About</a></li>
        <li><a href="/fasilitas_sekretaris" class="{{ Request::is('fasilitas_sekretaris') ? 'active' : '' }}">Fasilitas</a></li><!-- route('data_pengurus_desa.index' akan menghasilkan url route /data_pengurus_desa, maka Request::is('data_pengurus_desa_sekretaris*') akan di chek, jadi samakan dengan apa yang di hassilkan. yang dihasilkan bisa di atur dari web.php. PERHATIKAN PADA WEB>PHP INI Route::get('/data_pengurus_desa_sekretaris', [DataPengurusDesaController::class, 'index'])->name('data_pengurus_desa.index');
-->
        <li><a href="/informasi_sekretaris" class="{{ Request::is('informasi_sekretaris') ? 'active' : '' }}">Informasi</a></li>
        <li><a href="{{ route('galleries.index')}}" class="{{ Request::is('galleries*') ? 'active' : '' }}">Galeri</a></li>
        {{-- <li><a href="{{route('data_pengurus_desa_sekretaris.index')}}" class="{{ Request::is('data_pengurus_desa_sekretaris*') ? 'active' : '' }}">Data Pengurus Desa</a></li> --}}
        {{-- <li><a href="/data_pengurus_desa_sekretaris" class="{{ Request::is('data_pengurus_desa_sekretaris') ? 'active' : '' }}">Data Pengurus Desa</a></li> --}}
        <li><a href="{{ route('data_pengurus_desa.index')}}" class="{{ Request::is('data_pengurus_desa_sekretaris*') ? 'active' : '' }}">Data Pengurus Desa</a></li>
        {{-- <li><a href="{{ route('data_pengurus_desa.index') }}" class="{{ Request::is('data_pengurus_desa*') ? 'active' : '' }}">Data Pengurus Desa</a></li> --}}
        <li><a href="/alat_pertanian_sekretaris" class="{{ Request::is('alat_pertanian_sekretaris') ? 'active' : '' }}">Alat Pertanian</a></li>
        <li><a href="/contact_sekretaris" class="{{ Request::is('contact_sekretaris') ? 'active' : '' }}">Contact</a></li>
        @auth
        <li class="dropdown {{ Request::is('profile*') ? 'active' : '' }}">
            <a class="dropdown-toggle" href="#" id="navbarSekretaris" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sekretaris
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarSekretaris">
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
