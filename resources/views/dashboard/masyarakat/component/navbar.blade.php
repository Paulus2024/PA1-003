{{-- <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/index_masyarakat" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="{{ route('index.masyarakat') }}"
                    class="{{ Request::is('index_masyarakat') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about.masyarakat') }}"
                    class="{{ Request::is('about_masyarakat') ? 'active' : '' }}">About</a></li>
            <!-- (nama route) about.masyarakat akan menghasilkan URL about_masyarakat dan ini yang di buat di bagian href dan request -->
            <li><a href="{{ route('fasilitas.masyarakat') }}"
                    class="{{ Request::is('fasilitas_masyarakat') ? 'active' : '' }}">Fasilitas Desa</a></li>
            <li><a href="{{ route('informasi.masyarakat') }}"
                    class="{{ Request::is('informasi_masyarakat') ? 'active' : '' }}">Informasi</a></li>
            <li><a href="{{ route('galeri.masyarakat') }}"
                    class="{{ Request::is('galeri_masyarakat') ? 'active' : '' }}">Galeri</a></li>
            <li><a href="{{ route('data_pengurus_desa.masyarakat') }}"
                    class="{{ Request::is('data_pengurus_desa_masyarakat') }}">Data Pengurus Desa</a></li>
            <li><a href="{{ route('alat_pertanian.index_masyarakat') }}"
                    class="{{ Request::is('alat_pertanian_masyarakat') }}">Alat Pertanian</a></li>
            <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') }}">Contact</a></li>
            <!-- <li><a href="/index_masyarakat" class="{{ request()->is('index_masyarakat') ? 'active' : '' }}">Home</a></li>
        <li><a href="/about_masyarakat" class="{{ request()->is('about_masyarakat') ? 'active' : '' }}">About</a></li>
        <li><a href="/fasilitas_masyarakat" class="{{ request()->is('fasilitas_masyarakat') ? 'active' : '' }}">Fasilitas Desa</a></li>
        <li><a href="/informasi_masyarakat" class="{{ request()->is('informasi_masyarakat') ? 'active' : '' }}">Informasi</a></li>
        <li><a href="/galeri_masyarakat" class="{{ request()->is('galeri_masyarakat') ? 'active' : '' }}">Galeri</a></li>
        <li><a href="/data_pengurus_desa_masyarakat" class="{{ request()->is('data_pengurus_desa_masyarakat') ? 'active' : '' }}">Data Pengurus Desa</a></li>
        <li><a href="/alat_pertanian_masyarakat" class="{{ request()->is('alat_pertanian_masyarakat') ? 'active' : '' }}">Alat Pertanian</a></li>
        <li><a href="/contact_masyarakat" class="{{ request()->is('contact_masyarakat') ? 'active' : '' }}">Contact</a></li> -->
            @auth

                <!-- Notifikasi -->
                <a href="#" class="text-dark position-relative" data-bs-toggle="modal"
                    data-bs-target="#notificationModal" title="Notifikasi">
                    <i class="bi bi-bell fs-4"></i>
                    @php
                        $unreadNotificationsCount = auth()->user()->notifications()->whereNull('read_at')->count();
                    @endphp
                    @if ($unreadNotificationsCount > 0)
                        <span class="badge bg-danger">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                @php
                                    $notifications = Cache::remember(
                                        'user_' . auth()->id() . '_notifications',
                                        60,
                                        function () {
                                            return auth()
                                                ->user()
                                                ->notifications()
                                                ->latest()
                                                ->where('message', 'not like', 'Peminjaman baru dari%')
                                                ->get();
                                        },
                                    );
                                @endphp

                                @if ($notifications->isNotEmpty())
                                    <ul class="list-group">
                                        @foreach ($notifications as $notification)
                                            <li class="list-group-item  align-items-start">
                                                <div class="d-flex justify-content-between">
                                                    <div class="ms-2 me-auto">
                                                        <div class="fw-bold">
                                                            <a href="{{ route('peminjaman.show', $notification->peminjaman_id) }}"
                                                                class="text-decoration-none text-dark">
                                                                {{ $notification->message }}
                                                            </a>
                                                        </div>
                                                        <small
                                                            class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <i class="bi bi-info-circle text-secondary"></i>
                                                </div>
                                                @if (!$notification->read_at)
                                                    <form
                                                        action="{{ route('notifications.markAsRead', $notification->id) }}"
                                                        method="POST" class="mt-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">Tandai
                                                            Sudah
                                                            Dibaca</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center text-muted">Tidak ada notifikasi baru</div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <a href="#" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Notifikasi -->

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->photo ? asset('storage/profile_photos/' . Auth::user()->photo) : asset('img/default-profile.png') }}"
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
    </nav> --}}


<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="/index_masyarakat" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
        <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
    </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="{{ route('index.masyarakat') }}"
                    class="{{ Request::is('index_masyarakat') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about.masyarakat') }}"
                    class="{{ Request::is('about_masyarakat') ? 'active' : '' }}">About</a></li>
            <!-- (nama route) about.masyarakat akan menghasilkan URL about_masyarakat dan ini yang di buat di bagian href dan request -->
            <li><a href="{{ route('fasilitas.masyarakat') }}"
                    class="{{ Request::is('fasilitas_masyarakat') ? 'active' : '' }}">Fasilitas Desa</a></li>
            <li><a href="{{ route('informasi.masyarakat') }}"
                    class="{{ Request::is('informasi_masyarakat') ? 'active' : '' }}">Informasi</a></li>
            <li><a href="{{ route('galeri.masyarakat') }}"
                    class="{{ Request::is('galeri_masyarakat') ? 'active' : '' }}">Galeri</a></li>
            <li><a href="{{ route('data_pengurus_desa.masyarakat') }}"
                    class="{{ Request::is('data_pengurus_desa_masyarakat') }}">Data Pengurus Desa</a></li>
            <li><a href="{{ route('alat_pertanian.index_masyarakat') }}"
                    class="{{ Request::is('alat_pertanian_masyarakat') }}">Alat Pertanian</a></li>
            <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') }}">Contact</a></li>
            @auth

                <!-- Notifikasi (Tombol Pembuka Modal) -->
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
                <!-- End Notifikasi -->

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


    {{-- <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

  <a href="/index_masyarakat" class="logo d-flex align-items-center">
      <img src="{{ asset('assets/img/8.png') }}" alt="Logo">
      <h1 class="sitename">Desa</h1><span><b>Taon Marisi</b></span>
  </a>

  <nav id="navmenu" class="navmenu">
    <ul>
      <li><a href="{{ route('index.masyarakat') }}"
             class="{{ Request::is('index_masyarakat') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ route('about.masyarakat') }}"
             class="{{ Request::is('about_masyarakat') ? 'active' : '' }}">About</a></li>
      <li><a href="{{ route('fasilitas.masyarakat') }}"
             class="{{ Request::is('fasilitas_masyarakat') ? 'active' : '' }}">Fasilitas Desa</a></li>
      <li><a href="{{ route('informasi.masyarakat') }}"
             class="{{ Request::is('informasi_masyarakat') ? 'active' : '' }}">Informasi</a></li>
      <li><a href="{{ route('galeri.masyarakat') }}"
             class="{{ Request::is('galeri_masyarakat') ? 'active' : '' }}">Galeri</a></li>
      <li><a href="{{ route('data_pengurus_desa.masyarakat') }}"
             class="{{ Request::is('data_pengurus_desa_masyarakat') }}">Data Pengurus Desa</a></li>
      <li><a href="{{ route('alat_pertanian.index_masyarakat') }}"
             class="{{ Request::is('alat_pertanian_masyarakat') }}">Alat Pertanian</a></li>
      <li><a href="{{ route('contact') }}"
             class="{{ Request::is('contact') }}">Contact</a></li>

      @auth
        <!-- ITEM NOTIFIKASI -->
        @php
          $unreadCount = auth()->user()
                                ->notifications()
                                ->whereNull('read_at')
                                ->count();
        @endphp
        <li class="nav-item">
          <a href="#"
             class="nav-link position-relative"
             data-bs-toggle="modal"
             data-bs-target="#notificationModal">
            <i class="bi bi-bell fs-5"></i>
            @if ($unreadCount)
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                {{ $unreadCount }}
              </span>
            @endif
          </a>
        </li>

        <!-- ITEM PROFIL & LOGOUT -->
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
            <img src="{{ Auth::user()->photo
                          ? asset('storage/profile_photos/' . Auth::user()->photo)
                          : asset('img/default-profile.png') }}"
                 alt="Profile" class="rounded-circle" width="32" height="32" style="object-fit: cover;">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profil</a></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
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

</div> --}}
