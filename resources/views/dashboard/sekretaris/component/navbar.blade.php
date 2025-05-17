<!-- Sidebar -->
<div class="sidebar position-fixed">
    <div class="text-center mb-4">
        <a href="/index_sekretaris" class="d-flex align-items-center justify-content-center text-white text-decoration-none">
            <img src="{{ asset('assets/img/8.png') }}" alt="Logo" style="width: 40px; height: auto; margin-right: 10px;">
            <div>
                <h5 class="mb-0">Desa</h5>
                <span><b>Taon Marisi</b></span>
            </div>
        </a>
    </div>

    <a href="/index_sekretaris" class="{{ Request::is('index_sekretaris') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-house-door"></i> Home
    </a>
    <a href="/about_sekretaris" class="{{ Request::is('about_sekretaris') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-info-circle"></i> About
    </a>
    <a href="/fasilitas_sekretaris" class="{{ Request::is('fasilitas_sekretaris') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-building"></i> Fasilitas
    </a>
    <a href="/informasi_sekretaris" class="{{ Request::is('informasi_sekretaris') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-bell"></i> Informasi
    </a>
    <a href="{{ route('galleries.index')}}" class="{{ Request::is('galleries*') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-image"></i> Galeri
    </a>
    <a href="{{ route('data_pengurus_desa.index')}}" class="{{ Request::is('data_pengurus_desa_sekretaris*') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-people"></i> Data Pengurus Desa
    </a>
    <a href="/alat_pertanian_sekretaris" class="{{ Request::is('alat_pertanian_sekretaris') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-tools"></i> Alat Pertanian
    </a>
    <a href="/contact_sekretaris" class="{{ Request::is('contact_sekretaris') ? 'bg-secondary text-white' : '' }}">
        <i class="bi bi-telephone"></i> Contact
    </a>

    @auth
        <hr class="bg-light">
        <div class="px-3 text-light">Akun</div>
        <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> Sekretaris
        </a>
        <div class="dropdown-menu p-0" style="background-color: #343a40; border: none;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item text-danger bg-dark text-white">Logout</button>
            </form>
        </div>
    @else
        <a href="/login" class="{{ Request::is('login') ? 'bg-secondary text-white' : '' }}">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
    @endauth
</div>
