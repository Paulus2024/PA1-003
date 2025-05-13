@extends('pengguna.main')

@section('content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('pengguna.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>About</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">

            <!-- Tombol untuk menambah About baru -->
            <div class="col-12">
                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal"
                            data-bs-target="#TambahAbout">Tambah About</button>
                </div>
            </div>

            @if(count($abouts) > 0) <!-- Cek apakah ada data About -->
                @foreach($abouts as $about)  <!-- Loop untuk menampilkan data About -->
                    <div class="row position-relative">

                        <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200">
                            @if($about->gambar1)
                                <img src="{{ asset('storage/' . $about->gambar1) }}" class="img-fluid" alt="Gambar About">
                            @else
                                <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="Default Image">
                            @endif
                            <p>Gambar 1</p>
                            <div class="d-flex justify-content-center gap-2"><!-- Tambahkan tombol edit dan hapus di sini -->
                                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $about->id }}">Edit</button>
                                <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                            <h2 class="inner-title">Desa Taonmarisi</h2>
                            <div class="our-story">
                                <h4>Tahun Berdiri</h4>
                                <h3>History</h3>
                                <p>{{ $about->sejarah }}</p>
                                <!-- Sisipkan list jika diperlukan -->
                                <p>{{ $about->visi_misi }}</p>
                            </div>
                        </div>
                    </div>
                    <br><br>

                   <!-- Modal Edit untuk masing-masing About -->
                    <div class="modal fade" id="editModal{{ $about->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $about->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('abouts.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $about->id }}">Edit About</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="visi_misi" class="form-label">Visi Misi</label>
                                        <textarea class="form-control" name="visi_misi" rows="3" required>{{ $about->visi_misi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sejarah" class="form-label">Sejarah</label>
                                        <textarea class="form-control" name="sejarah" rows="3" required>{{ $about->sejarah }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar1" class="form-label">Gambar 1</label>
                                        <input type="file" class="form-control" name="gambar1">
                                        @if($about->gambar1)
                                            <img src="{{ asset('storage/' . $about->gambar1) }}" alt="Gambar 1" width="100">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar2" class="form-label">Gambar 2</label>
                                        <input type="file" class="form-control" name="gambar2">
                                        @if($about->gambar2)
                                            <img src="{{ asset('storage/' . $about->gambar2) }}" alt="Gambar 2" width="100">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach  <!-- End Loop -->
            @else
                <p>Tidak ada data About yang tersedia.</p>
            @endif

              <!--Open MODAL Create(Tambah)-->
            <div class="modal fade" id="TambahAbout" tabindex="-1" aria-labelledby="tambahAboutLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahAboutLabel">Tambah Data About Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="visi_misi" class="form-label">Visi Misi</label>
                                    <textarea class="form-control" id="visi_misi" name="visi_misi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="sejarah" class="form-label">Sejarah</label>
                                    <textarea class="form-control" id="sejarah" name="sejarah" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar1" class="form-label">Gambar 1</label>
                                    <input type="file" class="form-control" id="gambar1" name="gambar1">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar2" class="form-label">Gambar 2</label>
                                    <input type="file" class="form-control" id="gambar2" name="gambar2">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Close MODAL Create(Tambah)-->
        </div>
    </section><!-- /About Section -->

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
