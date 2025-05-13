@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>About Us</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('dashboard.sekretaris') }}">Home</a></li>
                    <li class="current">About Us</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($aboutUs)  {{-- Cek apakah ada data AboutUs --}}

            <div class="row position-relative">

                <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200">
                    @if ($aboutUs->gambar1)
                        <img src="{{ asset('storage/about_us/' . $aboutUs->gambar1) }}" alt="Gambar 1" class="img-fluid">
                    @else
                        <img src="assets/img/about.jpg" alt="Default Image" class="img-fluid">
                    @endif
                </div>

                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="inner-title">Desa Taonmarisi</h2>
                    <div class="our-story">
                        <h4>Tahun Berdiri</h4>
                        <h3>History</h3>
                        <p>{{ $aboutUs->sejarah }}</p>

                        <p><b>Jumlah Penduduk:</b> {{ $aboutUs->jumlah_penduduk }}</p>
                        <p><b>Luas Wilayah:</b> {{ $aboutUs->luas_wilayah }}</p>
                        <p><b>Jumlah Perangkat Desa:</b> {{ $aboutUs->jumlah_perangkat_desa }}</p>

                        <div class="d-flex gap-2">
                            <!-- Tombol Edit (Buka Modal) -->
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal">
                                Edit
                            </button>

                            <!-- Form Hapus -->
                            <form action="{{ route('sekretaris.about_us.destroy', session('aboutUsId')) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data About Us ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @else {{-- Jika tidak ada data AboutUs --}}

            <p>Belum ada data About Us. Silakan tambahkan data.</p>
            <a href="{{ route('sekretaris.about_us.create') }}" class="btn btn-success">Buat Data About Us</a>

            @endif

        </div>

    </section><!-- /About Section -->

    <!-- Stats Counter Section -->
    <section id="stats-counter" class="stats-counter section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Visi & Misi</h2>
            <p>{{ $aboutUs->visi_misi }}</p>  {{-- Menampilkan Visi Misi dari database --}}
        </div><!-- End Section Title -->

    </section><!-- /Stats Counter Section -->

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('sekretaris.about_us.update', session('aboutUsId')) }}" method="POST"
                enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit About Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="gambar1" class="form-label">Gambar 1</label>
                        <input type="file" class="form-control" name="gambar1">
                        @if ($aboutUs->gambar1)
                            <img src="{{ asset('storage/about_us/' . $aboutUs->gambar1) }}" alt="Current Image" width="100">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="visi_misi" class="form-label">Visi Misi</label>
                        <textarea class="form-control" name="visi_misi" rows="3" required>{{ $aboutUs->visi_misi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="gambar2" class="form-label">Gambar 2</label>
                        <input type="file" class="form-control" name="gambar2">
                        @if ($aboutUs->gambar2)
                            <img src="{{ asset('storage/about_us/' . $aboutUs->gambar2) }}" alt="Current Image" width="100">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="sejarah" class="form-label">Sejarah</label>
                        <textarea class="form-control" name="sejarah" rows="5" required>{{ $aboutUs->sejarah }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                        <input type="number" class="form-control" name="jumlah_penduduk" value="{{ $aboutUs->jumlah_penduduk }}">
                    </div>

                    <div class="mb-3">
                        <label for="luas_wilayah" class="form-label">Luas Wilayah</label>
                        <input type="text" class="form-control" name="luas_wilayah" value="{{ $aboutUs->luas_wilayah }}">
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_perangkat_desa" class="form-label">Jumlah Perangkat Desa</label>
                        <input type="number" class="form-control" name="jumlah_perangkat_desa" value="{{ $aboutUs->jumlah_perangkat_desa }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal Edit -->

    <footer id="footer" class="footer dark-background">
        @include('dashboard.sekretaris.component.footer')
    </footer>
@endsection
