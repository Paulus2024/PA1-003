{{-- @extends('pengguna.main')

@section('pengguna_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('pengguna.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative py-5">
            <h1 class="text-white">Fasilitas Desa</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home1</a></li>
                    <li class="current">Fasilitas1</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section id="projects" class="projects section py-5">
        <div class="container">
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach ($fasilitas as $item)
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                        <div class="portfolio-content h-100 shadow-sm rounded">
                            <img src="{{ asset('storage/' . $item->gambar_fasilitas) }}" class="img-fluid rounded-top"
                                alt="{{ $item->nama_fasilitas }}">
                            <div class="portfolio-info p-3">
                                <h4 class="fw-bold">{{ $item->nama_fasilitas }}</h4>
                                <p>{{ Str::limit($item->deskripsi_fasilitas, 80) }}</p>

                                <!-- Preview Gambar -->
                                <a href="{{ asset('storage/' . $item->gambar_fasilitas) }}" class="glightbox preview-link"
                                    title="{{ $item->nama_fasilitas }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>

                                <!-- Link Detail: wajib kirimkan ID -->
                                <a href="{{ route('pengguna.fasilitas.show', $item->id_fasilitas) }}" class="details-link"
                                    title="Lihat Detail">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection --}}

@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')

    <!--Open Page Title-->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative">
            <h1>Fasilitas</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                    <li class="current">Fasilitas</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Projects Section -->
    <section id="projects" class="projects section">
        <div class="container">
            <!-- Container untuk menampilkan data fasilitas -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                <!-- Lakukan looping data fasilitas -->
                @foreach ($fasilitas_masyarakat as $item)
                    <!--(nama variable dari controller as tempat penampung sementara data dari $fasilitas)-->
                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                        <div class="portfolio-content h-100">
                            <!-- Tampilkan gambar, gunakan asset() agar path sesuai -->
                            <img src="{{ asset('storage/' . $item->gambar_fasilitas) }}" class="img-fluid"
                                alt="{{ $item->nama_fasilitas }}">
                            <div class="portfolio-info">
                                <!-- Bagian Header untuk judul dan tombol -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>{{ $item->nama_fasilitas }}</h4>

                                </div>
                                <!-- Tampilkan deskripsi singkat -->
                                <p>{{ Str::limit($item->deskripsi_fasilitas, 50) }}</p>
                                <!-- Tautan preview gambar menggunakan glightbox -->
                                <a href="{{ asset('storage/' . $item->gambar_fasilitas) }}"
                                    title="{{ $item->nama_fasilitas }}" data-gallery="portfolio-gallery"
                                    class="glightbox preview-link">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->
                @endforeach
                <!-- End Looping data fasilitas bagian edit -->

                <!-- Tombol untuk menambah fasilitas baru -->


            </div><!-- End Portfolio Container -->
        </div>

    </section><!-- End Projects Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
