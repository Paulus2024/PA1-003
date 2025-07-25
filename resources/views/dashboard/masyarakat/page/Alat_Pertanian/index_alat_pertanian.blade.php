@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')
<div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
        <div class="container position-relative">
            <h1>Alat Pertanian</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                    <li class="current">Alat Pertanian</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->


    <main id="main">
        <section id="projects" class="projects section mb-5 pb-5"><!-- Projects Section -->
            <!-- Kenapa Harus Ada mb-5, padahal sebelumnya tidak ada pada file view lain -->

            <div class="container"><!-- Open Projects Container -->

                <!-- <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200"> -->


                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <!-- Open Isotope Layout -->

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <!-- Open Portfolio Filters -->
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-Olah_Lahan">Olah Lahan</li>
                        <li data-filter=".filter-Pascapanen">Pascapanen</li>
                        <li data-filter=".filter-Lainnya">Lainnya</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        <!-- Open Row Isotope Container -->

                        {{-- @if ($alat_pertanian->isEmpty())
                            <div class="col-12">
                            <p class="text-danger text-center">Tidak ada data alat pertanian.</p>
                            </div>
                            @endif --}}

                        @foreach ($alat_pertanian as $item)
                            <!-- Looping Alat Pertanian -->
                            <!-- Open Content -->
                            <div
                                class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $item->jenis_alat_pertanian }}">
                                <article class="position-relative">

                                    <!-- Wrapper konten gambar -->
                                    <div class="portfolio-content">

                                        <!-- 🔽 Gambar dengan efek hover -->
                                        <div class="img-hover-zoom ratio-box">
                                            <div class="image-container">
                                                <!-- <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="Foto Galeri">-->
                                                <img src="{{ asset('storage/' . $item->gambar_alat) }}" class="img-fluid"
                                                    alt="Foto {{ $item->nama_alat_pertanian }}">
                                            </div>
                                        </div>

                                        <!-- Informasi yang tampil saat hover (jika ada) -->
                                        <div class="portfolio-info">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4> {{ $item->jenis_alat_pertanian }} </h4>
                                                <!-- jenis alat pertanian -->

                                            </div>
                                            <p>{{ $item->catatan }}</p><!-- Catatan Khusus -->
                                            <a href="{{ asset('storage/' . $item->gambar_alat) }}"
                                                title="{{ $item->jenis_alat_pertanian }}"
                                                data-gallery="portfolio-gallery-app" class="glightbox preview-link">
                                                <i class="bi bi-zoom-in"></i>
                                            </a>
                                            <a href="/detail_galeri" title="More Details" class="details-link">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Status Alat Pertanian dan Jumlah Alat Tersedia -->
                                    <div class="mt-3 p-3 bg-white shadow-sm rounded-0">
                                        <h5 class="fw-bold text-warning">{{ $item->nama_alat_pertanian }}</h5>
                                        <p class="text-secondary">{{ $item->harga_sewa }}</p>

                                        <p class="text-secondary">
                                            Status:
                                            @if ($item->status_alat == 'tersedia')
                                                <span class="badge bg-success">Tersedia</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Tersedia</span>
                                            @endif
                                            | Tersedia: {{ $item->jumlah_tersedia }} / {{ $item->jumlah_alat }}
                                        </p>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                                data-bs-target="#SewaAlatPertanian{{ $item->id_alat_pertanian }}">
                                                Sewa Alat
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Status Alat Pertanian dan Jumlah Alat Tersedia -->
                                </article>
                            </div>
                            <!-- Close Content -->


                            <!-- Modal Sewa Alat Pertanian -->
                            <div class="modal fade" id="SewaAlatPertanian{{ $item->id_alat_pertanian }}" tabindex="-1"
                                aria-labelledby="TambahAlatPertanian" aria-hidden="true">
                                <div class="modal-dialog"><!-- Modal Dialog -->
                                    <div class="modal-content"><!-- Modal Content -->
                                        <div class="modal-header"><!-- Modal Header -->
                                            <h5 class="modal-title" id="SewaAlatPertanian">Sewa Alat Pertanian
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div><!-- Modal Header -->

                                        <div class="modal-body"><!-- Modal Body -->
                                            <form action="{{ route('alat_pertanian.pinjam') }}" method="POST">
                                                <!-- Form untuk menyewa alat pertanian -->
                                                @csrf
                                                <input type="hidden" name="alat_id"
                                                    value="{{ $item->id_alat_pertanian }}">
                                                <div class="mb-3">
                                                    <label>Nama Peminjam</label>
                                                    <input type="text" name="nama_peminjam" class="form-control"
                                                        placeholder="Nama Peminjam" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Tanggal Pinjam</label>
                                                    <input type="date" name="tanggal_pinjam" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Tanggal Kembali</label>
                                                    <input type="date" name="tanggal_kembali" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jumlah Alat Yang Di Sewa</label>
                                                    <input name="jumlah_alat_di_sewa" min="1" max="2"
                                                        type="number" id="typeNumber" class="form-control"
                                                        placeholder="Min 1 & Max 2" />
                                                </div>
                                                <button class="btn btn-success">Pinjam</button>
                                            </form><!-- Form untuk menyewa alat pertanian -->

                                        </div><!-- Modal Body -->
                                    </div><!-- Modal Content -->
                                </div><!-- Modal Dialog -->
                            </div>
                            <!-- Modal Sewa Alat Pertanian -->
                        @endforeach
                        <!-- Looping Alat Pertanian -->

                    </div><!-- Close Row Isotope Container -->

                </div><!-- Open Isotope Layout -->

            </div><!-- End Projects Container -->



        </section><!-- /Projects Section -->

        <!-- Tombol Histori Pemesanan (Fixed) -->
        {{-- <a href="{{ route('pemesanan.history.masyarakat') }}" class="btn btn-primary btn-historipemesanan-icon"
            title="Lihat Histori Pemesanan">

            <i class="bi bi-clock-history"></i>

        </a> --}}


    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
