{{-- 1 --}}
{{-- @extends('dashboard.sekretaris.component.main')

@section(section:'sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
        <h1>Fasilitas</h1>
        <nav class="breadcrumbs">
            <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Fasilitas</li>
            </ol>
        </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Projects Section -->
    <section id="projects" class="projects section">

        <div class="container">

            <!-- Open Portofolio Container -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>A</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/remodeling-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/construction-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/construction-1.jpg" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/repairs-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/repairs-1.jpg" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/design-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/design-1.jpg" title="Branding 1" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/remodeling-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/remodeling-2.jpg" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/construction-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->
                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/construction-2.jpg" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/repairs-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/repairs-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/design-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/remodeling-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/remodeling-3.jpg" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/construction-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/construction-3.jpg" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/repairs-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/repairs-3.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/design-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/design-3.jpg" title="Branding 3" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="d-grid gap-2">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Gambar Fasilitas Desa</button>
            </div>

            </div><!-- End Portfolio Container -->

        </div>
<!-- =================================================================================================== -->
        <!--Open Button Create(Tambah)-->
        <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahGambar">Tambah Gambar Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/upload-gambar" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="namaFasilitas" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" id="namaFasilitas" name="nama_fasilitas" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambarFasilitas" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" id="gambarFasilitas" name="gambar_fasilitas"
                                required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--Close Button Create(Tambah)-->
    </section><!-- /Projects Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>

@endsection --}}

{{-- 2 ============================================================================================================================================= --}}

{{-- @extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
        <h1>Projects</h1>
        <nav class="breadcrumbs">
            <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Projects</li>
            </ol>
        </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Projects Section -->
    <section id="projects" class="projects section">

        <div class="container">

            <!-- Open Portofolio Container -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>A</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/remodeling-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/construction-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/construction-1.jpg" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/repairs-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/repairs-1.jpg" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/design-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/design-1.jpg" title="Branding 1" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/remodeling-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/remodeling-2.jpg" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/construction-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->
                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/construction-2.jpg" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/repairs-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/repairs-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/design-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/remodeling-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/remodeling-3.jpg" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-construction">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/construction-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/construction-3.jpg" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-repairs">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/repairs-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/repairs-3.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-design">
                <div class="portfolio-content h-100">
                <img src="assets/img/projects/design-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <!-- Open Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Product 1</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </div>
                    <!-- Close Button -->

                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                    <a href="assets/img/projects/design-3.jpg" title="Branding 3" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
                </div>
            </div><!-- End Portfolio Item -->

            <div class="d-grid gap-2">
                <button class="btn btn-success" type="button">Tambah Gambar Fasilitas Desa</button>
            </div>

            </div><!-- End Portfolio Container -->

        </div>

    </section><!-- /Projects Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>

@endsection --}}

{{-- 3 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>


    <main id="main">
        <section id="projects" class="projects section">
            <div class="container">
                <!-- Tombol tambah -->
                <div class="mb-3">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                        Tambah Gambar Fasilitas Desa
                    </button>
                </div>

                <!-- Tabel Fasilitas -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Fasilitas</th>
                                <th>Deskripsi</th>
                                <th>Lokasi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fasilitas as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_fasilitas }}</td>
                                    <td>{{ Str::limit($item->deskripsi_fasilitas, 100) }}</td>
                                    <td>{{ $item->lokasi_fasilitas }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $item->gambar_fasilitas) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->gambar_fasilitas) }}" alt="{{ $item->nama_fasilitas }}" width="100">
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-outline-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_fasilitas }}">
                                            Edit
                                        </button>

                                        <!-- Form Hapus -->
                                        <form action="{{ route('sekretaris.fasilitas.destroy', $item->id_fasilitas) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $item->id_fasilitas }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_fasilitas }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('sekretaris.fasilitas.update', $item->id_fasilitas) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Fasilitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
                                                    <input type="text" class="form-control" name="nama_fasilitas" value="{{ $item->nama_fasilitas }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi_fasilitas" class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi_fasilitas" rows="3" required>{{ $item->deskripsi_fasilitas }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lokasi_fasilitas" class="form-label">Lokasi</label>
                                                    <input type="text" class="form-control" name="lokasi_fasilitas" value="{{ $item->lokasi_fasilitas }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar_fasilitas" class="form-label">Gambar</label>
                                                    <input type="file" class="form-control" name="gambar_fasilitas">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="TambahGambarLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('sekretaris.fasilitas.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="TambahGambarLabel">Tambah Data Fasilitas Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
                                    <input type="text" class="form-control" name="nama_fasilitas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_fasilitas" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi_fasilitas" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi_fasilitas" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi_fasilitas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_fasilitas" class="form-label">Upload Gambar</label>
                                    <input type="file" class="form-control" name="gambar_fasilitas" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
 <!-- #region -->
