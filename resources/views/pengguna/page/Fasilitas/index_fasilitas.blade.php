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
    <!-- Projects Section -->
    <section id="projects" class="projects section">

        <div class="container">

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/remodeling-1.jpg" title="App 1"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="/detail_galeri" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/construction-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/construction-1.jpg" title="Product 1"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/repairs-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/repairs-1.jpg" title="Branding 1"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/design-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Books 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/design-1.jpg" title="Branding 1"
                                data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/remodeling-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/remodeling-2.jpg" title="App 2"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/construction-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/construction-2.jpg" title="Product 2"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/repairs-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/repairs-2.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Books 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/design-2.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/remodeling-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/remodeling-3.jpg" title="App 3"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/construction-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/construction-3.jpg" title="Product 3"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/repairs-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/repairs-3.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                    <div class="portfolio-content h-100">
                        <img src="assets/img/projects/design-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Books 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assets/img/projects/design-3.jpg" title="Branding 3"
                                data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="project-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Portfolio Item -->

            </div><!-- End Portfolio Container -->

        </div>

    </section><!-- /Projects Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
