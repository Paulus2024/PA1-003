<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="{{ route('index.masyarakat') }}" class="logo d-flex align-items-center me-auto me-lg-0">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navbar navmenu"> {{-- Tambahkan kelas 'navbar' di sini --}}
        <ul>
            <li><a href="{{ route('index.masyarakat') }}"
                    class="{{ Request::is('index_masyarakat') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about.masyarakat') }}"
                    class="{{ Request::is('about-masyarakat') ? 'active' : '' }}">About</a></li>

            {{-- MULAI: Dropdown "Layanan" untuk mengelompokkan item menu panjang --}}
            <li class="dropdown"><a href="#"><span>Layanan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="{{ route('fasilitas.masyarakat') }}"
                            class="{{ Request::is('fasilitas_masyarakat') ? 'active' : '' }}">Fasilitas Desa</a></li>
                    <li><a href="{{ route('data_pengurus_desa.masyarakat') }}"
                            class="{{ Request::is('data_pengurus_desa_masyarakat') ? 'active' : '' }}">Data Pengurus Desa</a></li>
                    <li><a href="{{ route('alat_pertanian.index_masyarakat') }}"
                            class="{{ Request::is('alat_pertanian_masyarakat') ? 'active' : '' }}">Alat Pertanian</a></li>
                </ul>
            </li>
            {{-- AKHIR: Dropdown "Layanan" --}}

            <li><a href="{{ route('informasi.masyarakat') }}"
                    class="{{ Request::is('informasi_masyarakat') ? 'active' : '' }}">Informasi</a></li>
            <li><a href="{{ route('galeri.masyarakat') }}"
                    class="{{ Request::is('galeri_masyarakat') ? 'active' : '' }}">Galeri</a></li>
            <li><a href="{{ route('contact_masyarakat') }}" class="{{ Request::is('contact_masyarakat') ? 'active' : '' }}">Contact</a></li>

            @auth
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#notificationModal"
                        title="Notifikasi">
                        <i class="bi bi-bell fs-4"></i>
                        @php
                            $unreadNotificationsCount = auth()->user()->notifications()->whereNull('read_at')->count();
                        @endphp
                        @if ($unreadNotificationsCount > 0)
                            <span class="badge bg-danger">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->photo ? asset('storage/profile_photos/' . Auth::user()->photo) : asset('assets/img/default-profile.JPG') }}"
                            alt="Profile" class="rounded-circle" width="32" height="32" style="object-fit: cover;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
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
</div>
