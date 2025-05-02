@extends('pengguna.main')

@section('content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('pengguna.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative py-5">
            <h1 class="text-white">Fasilitas Desa</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Fasilitas</li>
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
@endsection
