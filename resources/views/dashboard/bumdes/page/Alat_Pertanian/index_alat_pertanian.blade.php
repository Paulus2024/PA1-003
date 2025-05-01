@extends('dashboard.bumdes.component.main')

@section('bumdes_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.bumdes.component.navbar')
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
                                        <div class="img-hover-zoom">
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
                                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
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

                                    <!-- 🔽 Keterangan Tambahan di Bawah Gambar -->
                                    <div class="mt-3 p-3 bg-white shadow-sm rounded-0">
                                        <h5 class="fw-bold text-warning"> {{ $item->nama_alat_pertanian }} </h5>
                                        <!-- Nama Alat -->
                                        <p class="text-secondary"> {{ $item->harga_sewa }} </p><!-- Harga Sewa -->
                                        <p class="text-secondary">{{ $item->status_alat }}|{{ $item->jumlah_alat }}
                                        </p>
                                        <!-- Status -->

                                        {{-- <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<!{{ $item->id_fasilitas }}"> --}}
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                                data-bs-target="#SewaAlatPertanian{{ $item->id_alat_pertanian }}">
                                                Sewa Alat
                                            </button>
                                        </div>
                                        {{-- <div class="d-flex gap-2">
                                            <a href="/edit" class="btn btn-outline-warning">Edit</a>
                                            <form action="/hapus" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                            </form>
                                        </div> --}}
                                    </div>

                                </article>
                            </div>
                            <!-- Close Content -->


                            <!-- Modal Sewa Alat Pertanian -->
                            <div class="modal fade" id="SewaAlatPertanian{{ $item->id_alat_pertanian }}" tabindex="-1"
                                aria-labelledby="TambahAlatPertanian" aria-hidden="true">
                                <div class="modal-dialog"><!-- Modal Dialog -->
                                    <div class="modal-content"><!-- Modal Content -->
                                        <div class="modal-header"><!-- Modal Header -->
                                            <h5 class="modal-title" id="SewaAlatPertanian">Tambah Data Alat Pertanian Baru
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
                                                    <label>Peminjam</label>
                                                    <input type="text" name="peminjam" class="form-control" required>
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
                                                <button class="btn btn-success">Pinjam</button>
                                            </form><!-- Form untuk menyewa alat pertanian -->

                                        </div><!-- Modal Body -->
                                    </div><!-- Modal Content -->
                                </div><!-- Modal Dialog -->
                            </div>
                            <!-- Modal Sewa Alat Pertanian -->

                            <!-- Modal Edit Alat Pertanian -->
                            <div class="modal fade" id="EditAlatPertanian{{ $item->id_alat_pertanian }}" tabindex="-1"
                                aria-labelledby="TambahAlatPertanian" aria-hidden="true">
                                <div class="modal-dialog"><!-- Modal Dialog -->
                                    <div class="modal-content"><!-- Modal Content -->
                                        <div class="modal-header"><!-- Modal Header -->
                                            <h5 class="modal-title" id="EditAlatPertanian">Tambah Data Alat Pertanian Baru
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div><!-- Modal Header -->

                                        <div class="modal-body"><!-- Modal Body -->
                                            <form action="{{ route('alat_pertanian.pinjam') }}" method="POST">
                                                <!-- Form untuk menyewa alat pertanian -->
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="nama_alat_pertanian" class="form-lable"> <b> Nama Alat
                                                            Pertanian
                                                        </b>
                                                    </label>
                                                    <input type="text" class="form-control" name="nama_alat_pertanian"
                                                        id="nama_alat_pertanian" value="{{ $item->nama_alat_pertanian }}"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="jenis_alat_pertanian" class="form-lable"> <b> Jenis Alat
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
                                                <!-- <div class="mb-3">
                                                        <label for="gambar_alat" class="form-lable  "> <b> Upload Gambar Alat
                                                            </b>
                                                        </label>
                                                        <input type="file" class="form-control" name="gambar_alat"
                                                            id="gambar_alat" value="{{ $item->gambar_alat }}" required>
                                                    </div> -->
                                                <div class="mb-3">
                                                    <label for="gambar_alat" class="form-label"><b>Gambar Alat
                                                            Lama</b></label><br>
                                                    <img src="{{ asset('storage/gambar_alat/' . $item->gambar_alat) }}"
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
                <div class="modal fade" id="TambahAlatPertanian" tabindex="-1" aria-labelledby="TambahAlatPertanian"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TambahAlatPertanian">Tambah Data Alat Pertanian Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                {{-- <form action="/upload-gambar" method="POST" enctype="multipart/form-data"> --}}
                                <form action="{{ route('bumdes.alat_pertanian.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama_alat_pertanian" class="form-lable"> <b> Nama Alat Pertanian
                                            </b>
                                        </label>
                                        <input type="text" class="form-control" name="nama_alat_pertanian"
                                            id="nama_alat_pertanian" placeholder="Nama Alat Pertanian" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis_alat_pertanian" class="form-lable"> <b> Jenis Alat Pertanian
                                            </b>
                                        </label><br>
                                        <input type="radio" id="jenis_alat_pertanian" name="jenis_alat_pertanian"
                                            value="Olah_Lahan" required>
                                        <label for="jenis_alat_pertanian">Olah Lahan</label><br>
                                        <input type="radio" id="jenis_alat_pertanian" name="jenis_alat_pertanian"
                                            value="Pascapanen" required>
                                        <label for="jenis_alat_pertanian">Pascapanen</label><br>
                                        <input type="radio" id="jenis_alat_pertanian" name="jenis_alat_pertanian"
                                            value="Lainnya" required>
                                        <label for="jenis_alat_pertanian">Lainnya</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga_sewa" class="form-lable"> <b> Harga Sewa </b> </label>
                                        <input type="text" class="form-control" name="harga_sewa" id="harga_sewa"
                                            placeholder="Harga Sewa" required>
                                    </div>

                                    <!-- <div class="mb-3">
                                                                <label for="status_alat" class="form-lable">Status Alat</label>
                                                                <input type="text" class="form-control" name="status_alat" id="status_alat"
                                                                    placeholder="Status Alat" required>
                                                            </div> -->

                                    <div class="mb-3">
                                        <label for="jumlah_alat" class="form-lable"> <b> Jumlah Alat </b> </label>
                                        <input type="text" class="form-control" name="jumlah_alat" id="jumlah_alat"
                                            placeholder="Jumlah Alat" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="catatan" class="form-lable"> <b> Catatan Khusus </b> </label>
                                        <input type="text" class="form-control" name="catatan" id="catatan"
                                            placeholder="Catatan Khusus">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar_alat" class="form-lable  "> <b> Upload Gambar Alat </b>
                                        </label>
                                        <input type="file" class="form-control" name="gambar_alat" id="gambar_alat"
                                            placeholder="Upload Gambar Alat" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>


                                {{-- <form action="{{ route('alat_pertanian.pinjam') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="alat_id" value="{{ $item->id_alat_pertanian }}">
                                        <div class="mb-3">
                                            <label>Peminjam</label>
                                            <input type="text" name="peminjam" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal Pinjam</label>
                                            <input type="date" name="tanggal_pinjam" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal Kembali</label>
                                            <input type="date" name="tanggal_kembali" class="form-control" required>
                                        </div>
                                        <button class="btn btn-success">Pinjam</button>
                                    </form> --}}

                            </div>
                        </div>
                    </div>
                </div>
                <!-- close modal tambah -->

                <!-- </div> -->

            </div><!-- End Projects Container -->



        </section><!-- /Projects Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
