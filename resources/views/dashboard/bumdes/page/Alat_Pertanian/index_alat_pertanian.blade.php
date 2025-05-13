    @extends('dashboard.bumdes.component.main')

    @section('bumdes_content')
        <header id="header" class="header d-flex align-items-center fixed-top">
            @include('dashboard.bumdes.component.navbar')

            <link rel="stylesheet" href="{{ asset('assets/css/fixed.css') }}">
            <!-- di head layout utama -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

            <link href="{{ asset('assets/css/fixed.css') }}" rel="stylesheet">
            @stack('styles')

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
                                    <article class="position-relative h-100">

                                        <!-- Wrapper konten gambar -->
                                        <div class="portfolio-content h-100">

                                            <!-- 🔽 Gambar dengan efek hover -->
                                            <div class="img-hover-zoom ratio-box">
                                                <!-- <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="Foto Galeri">-->
                                                <img src="{{ asset('storage/' . $item->gambar_alat) }}" class="img-fluid"
                                                    alt="Foto {{ $item->nama_alat_pertanian }}">
                                            </div>

                                            <!-- Informasi yang tampil saat hover (jika ada) -->
                                            <div class="portfolio-info">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4> {{ $item->jenis_alat_pertanian }} </h4>
                                                    <!-- jenis alat pertanian -->
                                                    <div class="d-flex gap-2">
                                                        <button type="button" class="btn btn-outline-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#EditAlatPertanian{{ $item->id_alat_pertanian }}">
                                                            Edit
                                                        </button>

                                                        <form
                                                            action="{{ route('bumdes.alat_pertanian.destroy', $item->id_alat_pertanian) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger">Hapus</button>
                                                        </form>
                                                    </div>
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
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal"
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

                                <!-- Modal Edit Alat Pertanian -->
                                <div class="modal fade" id="EditAlatPertanian{{ $item->id_alat_pertanian }}"
                                    tabindex="-1" aria-labelledby="TambahAlatPertanian" aria-hidden="true">
                                    <div class="modal-dialog"><!-- Modal Dialog -->
                                        <div class="modal-content"><!-- Modal Content -->
                                            <div class="modal-header"><!-- Modal Header -->
                                                <h5 class="modal-title" id="EditAlatPertanian">Edit Data Alat Pertanian
                                                    Baru
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div><!-- Modal Header -->

                                            <div class="modal-body"><!-- Modal Body -->
                                                <form
                                                    action="{{ route('alat_pertanian.update', $item->id_alat_pertanian) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    <!-- Form untuk menyewa alat pertanian -->
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nama_alat_pertanian" class="form-label"> <b> Nama Alat
                                                                Pertanian
                                                            </b>
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            name="nama_alat_pertanian" id="nama_alat_pertanian"
                                                            value="{{ $item->nama_alat_pertanian }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="jenis_alat_pertanian" class="form-lable"> <b> Jenis
                                                                Alat
                                                                Pertanian
                                                            </b>
                                                        </label><br>
                                                        <input type="radio" id="jenis_alat_pertanian"
                                                            name="jenis_alat_pertanian" value="Olah_Lahan"
                                                            {{ $item->jenis_alat_pertanian == 'Olah_Lahan' ? 'checked' : '' }}
                                                            required>
                                                        <label for="jenis_alat_pertanian">Olah Lahan</label><br>
                                                        <input type="radio" id="jenis_alat_pertanian"
                                                            name="jenis_alat_pertanian" value="Pascapanen"
                                                            {{ $item->jenis_alat_pertanian == 'Pascapanen' ? 'checked' : '' }}
                                                            required>
                                                        <label for="jenis_alat_pertanian">Pascapanen</label><br>
                                                        <input type="radio" id="jenis_alat_pertanian"
                                                            name="jenis_alat_pertanian" value="Lainnya"
                                                            {{ $item->jenis_alat_pertanian == 'Lainnya' ? 'checked' : '' }}
                                                            required>
                                                        <label for="jenis_alat_pertanian">Lainnya</label>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="harga_sewa" class="form-lable"> <b> Harga Sewa </b>
                                                        </label>
                                                        <input type="text" class="form-control" name="harga_sewa"
                                                            id="harga_sewa" value="{{ $item->harga_sewa }}" required>
                                                    </div>

                                                    <!-- <div class="mb-3">
                                                                                                            <label for="status_alat" class="form-lable">Status Alat</label>
                                                                                                            <input type="text" class="form-control" name="status_alat" id="status_alat"
                                                                                                                placeholder="Status Alat" required>
                                                                                                        </div> -->

                                                    <div class="mb-3">
                                                        <label for="jumlah_alat" class="form-lable"> <b> Jumlah Alat </b>
                                                        </label>
                                                        <input type="text" class="form-control" name="jumlah_alat"
                                                            id="jumlah_alat" value="{{ $item->jumlah_alat }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="catatan" class="form-lable"> <b> Catatan Khusus </b>
                                                        </label>
                                                        <input type="text" class="form-control" name="catatan"
                                                            id="catatan" value="{{ $item->catatan }}"">
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                                        <label for="gambar_alat" class="form-lable  "> <b> Upload Gambar Alat
                                                                            </b>
                                                                        </label>
                                                                        <input type="file" class="form-control" name="gambar_alat"
                                                                            id="gambar_alat" value="{{ $item->gambar_alat }}" required>
                                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label for="gambar_alat" class="form-label"><b>Gambar Alat
                                                                Lama</b></label><br>
                                                        <img src="{{ asset('storage/' . $item->gambar_alat) }}"
                                                            alt="Gambar Alat Lama" width="150">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="gambar_alat" class="form-label"><b>Upload Gambar Alat
                                                                Baru</b></label>
                                                        <input type="file" class="form-control" name="gambar_alat"
                                                            id="gambar_alat">
                                                    </div>

                                                    <button class="btn btn-success">Simpan</button>
                                                </form><!-- Form untuk menyewa alat pertanian -->

                                            </div><!-- Modal Body -->
                                        </div><!-- Modal Content -->
                                    </div><!-- Modal Dialog -->
                                </div>
                                <!-- Modal Edit Alat Pertanian -->
                            @endforeach
                            <!-- Looping Alat Pertanian -->

                        </div><!-- Close Row Isotope Container -->



                    </div><!-- Open Isotope Layout -->

                    <div class="row mt-4"><!-- Open Row -->
                        <div class="col-12"><!-- Open Button Tambah Alat Pertanian -->
                            <div class="d-grid gap-2">

                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target="#TambahAlatPertanian">Tambah Gambar Alat Pertanian</button>
                            </div>
                        </div><!-- Close Button Tambah Alat Pertanian -->
                    </div><!-- Close Row -->

                    <!-- open model tambah -->
                    <div class="modal fade" id="TambahAlatPertanian" tabindex="-1"
                        aria-labelledby="TambahAlatPertanianLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TambahAlatPertanianLabel">Tambah Data Alat Pertanian Baru
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('bumdes.alat_pertanian.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nama_alat_pertanian" class="form-label"><b>Nama Alat
                                                    Pertanian</b></label>
                                            <input type="text" class="form-control" name="nama_alat_pertanian"
                                                id="nama_alat_pertanian" placeholder="Nama Alat Pertanian" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="jenis_alat_pertanian" class="form-label"><b>Jenis Alat
                                                    Pertanian</b></label><br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="jenis_alat_pertanian" id="olah_lahan" value="Olah_Lahan"
                                                    required>
                                                <label class="form-check-label" for="olah_lahan">Olah Lahan</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="jenis_alat_pertanian" id="pascapanen" value="Pascapanen"
                                                    required>
                                                <label class="form-check-label" for="pascapanen">Pascapanen</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="jenis_alat_pertanian" id="lainnya" value="Lainnya" required>
                                                <label class="form-check-label" for="lainnya">Lainnya</label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga_sewa" class="form-label"><b>Harga Sewa</b></label>
                                            <input type="number" class="form-control" name="harga_sewa" id="harga_sewa"
                                                placeholder="Harga Sewa" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="jumlah_alat" class="form-label"><b>Jumlah Alat</b></label>
                                            <input type="number" class="form-control" name="jumlah_alat"
                                                id="jumlah_alat" placeholder="Jumlah Alat" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="catatan" class="form-label"><b>Catatan Khusus</b></label>
                                            <textarea class="form-control" name="catatan" id="catatan" rows="3" placeholder="Catatan Khusus"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gambar_alat" class="form-label"><b>Upload Gambar Alat</b></label>
                                            <input type="file" class="form-control" name="gambar_alat"
                                                id="gambar_alat" required>
                                        </div>

                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close modal tambah -->

                    <!-- </div> -->

                </div><!-- End Projects Container -->



            </section><!-- /Projects Section -->

            <!-- Tombol Histori Pemesanan (Fixed) -->
            <a href="{{ route('pemesanan.history') }}" class="btn btn-primary btn-historipemesanan-icon"
                title="Lihat Histori Pemesanan">

                <i class="bi bi-clock-history"></i>

            </a>


        </main>

        <footer id="footer" class="footer dark-background">
            @include('pengguna.component.footer')
        </footer>
    @endsection
