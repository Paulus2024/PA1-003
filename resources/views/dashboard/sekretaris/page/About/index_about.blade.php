@extends('dashboard.sekretaris.component.main')

@section(section: 'sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative">
            <h1>About</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('dashboard.sekretaris') }}">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Projects Section -->
    <section id="projects" class="projects section">

        <div class="container">
            <h1 class="text-center mb-4">Tentang Desa Kami</h1>

            <!-- Tombol untuk menambah About baru -->
            <div class="col-12">
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal"
                        data-bs-target="#TambahAbout">Tambah Data About</button>
                </div>
            </div>

            <br><br>

            <div class="row">
                @if ($about)
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sejarah</h5>
                                <p class="card-text">{!! $about->sejarah !!}</p>

                                <h5 class="card-title">Visi Misi</h5>
                                <p class="card-text">{!! $about->visi_misi !!}</p>

                                <p class="card-text">Jumlah Penduduk: {{ $about->jumlah_penduduk }}</p>
                                <p class="card-text">Luas Wilayah: {{ $about->luas_wilayah }}</p>
                                <p class="card-text">Jumlah Perangkat Desa: {{ $about->jumlah_perangkat_desa }}</p>

                                @if ($about->gambar1)
                                    <img src="{{ asset('storage/' . $about->gambar1) }}" class="img-fluid mb-3"
                                        alt="Gambar 1">
                                @endif

                                @if ($about->gambar2)
                                    <img src="{{ asset('storage/' . $about->gambar2) }}" class="img-fluid mb-3"
                                        alt="Gambar 2">
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <!-- Tombol Edit buka modal -->
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $about->id }}">
                                            Edit
                                        </button>
                                        <!-- Form hapus -->
                                        <form action="{{ route('abouts.destroy', $about->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $about->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $about->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('abouts.update', $about->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $about->id }}">Edit Data About</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="sejarah" class="form-label">Sejarah</label>
                                        <textarea class="form-control" id="sejarah" name="sejarah" rows="3">{{ $about->sejarah }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="visi_misi" class="form-label">Visi Misi</label>
                                        <textarea class="form-control" id="visi_misi" name="visi_misi" rows="3">{{ $about->visi_misi }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                        <input type="number" class="form-control" id="jumlah_penduduk"
                                            name="jumlah_penduduk" value="{{ $about->jumlah_penduduk }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="luas_wilayah" class="form-label">Luas Wilayah</label>
                                        <input type="text" class="form-control" id="luas_wilayah" name="luas_wilayah"
                                            value="{{ $about->luas_wilayah }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="jumlah_perangkat_desa" class="form-label">Jumlah Perangkat Desa</label>
                                        <input type="number" class="form-control" id="jumlah_perangkat_desa"
                                            name="jumlah_perangkat_desa" value="{{ $about->jumlah_perangkat_desa }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar1" class="form-label">Gambar 1</label>
                                        <input type="file" class="form-control" id="gambar1" name="gambar1">
                                        @if ($about->gambar1)
                                            <img src="{{ asset('storage/' . $about->gambar1) }}" alt="Gambar 1"
                                                class="img-fluid mt-2" style="max-width: 150px;">
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar2" class="form-label">Gambar 2</label>
                                        <input type="file" class="form-control" id="gambar2" name="gambar2">
                                        @if ($about->gambar2)
                                            <img src="{{ asset('storage/' . $about->gambar2) }}" alt="Gambar 2"
                                                class="img-fluid mt-2" style="max-width: 150px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <p>Belum ada data About yang tersedia.</p>
                @endif
            </div>

            <br><br>

            <!--Open MODAL Create(Tambah)-->
            <div class="modal fade" id="TambahAbout" tabindex="-1" aria-labelledby="tambahAboutLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahAboutLabel">Tambah Data About Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="sejarah" class="form-label">Sejarah</label>
                                    <textarea class="form-control" id="sejarah" name="sejarah" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="visi_misi" class="form-label">Visi Misi</label>
                                    <textarea class="form-control" id="visi_misi" name="visi_misi" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                    <input type="number" class="form-control" id="jumlah_penduduk"
                                        name="jumlah_penduduk">
                                </div>

                                <div class="mb-3">
                                    <label for="luas_wilayah" class="form-label">Luas Wilayah</label>
                                    <input type="text" class="form-control" id="luas_wilayah" name="luas_wilayah">
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_perangkat_desa" class="form-label">Jumlah Perangkat Desa</label>
                                    <input type="number" class="form-control" id="jumlah_perangkat_desa"
                                        name="jumlah_perangkat_desa">
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
    </section>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
