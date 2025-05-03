@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.masyarakat.component.navbar')
    </header>

    <!--Open Page Title-->
    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>Informasi Desa</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section id="blog-pagination" class="blog-pagination section mt-5">
        <div class="container">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi.masyarakat') ? 'active' : '' }}" href="{{ route('informasi.masyarakat') }}"> Berita </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pengumuman.masyarakat') ? 'active' : '' }}" href="{{ route('pengumuman.masyarakat') }}"> Pengumuman </a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4">
                <!-- Colom Di Looping Aforeach -->
                @foreach ($pengumuman_masyarakat as $item)
                    <div class="col-lg-4">
                        <article class="position-relative h-100">

                            <div class="post-img position-relative overflow-hidden">
                                {{-- <img src="{{ asset('storage/' .$item->lampiran_informasi)}}" class="img-fluid" alt=""> --}}
                                <!-- <span class="post-date">December 12</span> -->
                                <!--open-->
                                @php
                                    $path = 'storage/' . $item->lampiran_informasi;
                                    $extension = pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($path) }}" class="img-fluid" alt="Gambar Informasi">
                                @elseif($extension === 'pdf')
                                    <iframe src="{{ asset($path) }}" width="100%" height="300px"></iframe>
                                @elseif(in_array($extension, ['doc', 'docx']))
                                    <a href="{{ asset($path) }}" target="_blank">
                                        <img src="{{ asset('assets/img/icon/word-icon.png') }}" alt="Dokumen Word"
                                            style="height:100px;">
                                        <p>Lihat Dokumen Word</p>
                                    </a>
                                @else
                                    <a href="{{ asset($path) }}" target="_blank">Download File</a>
                                @endif
                                <!--close-->
                                <span class="post-date">{{ $item->created_at->format('F d') }}</span>
                            </div>

                            <div class="post-content d-flex flex-column">

                                <h3 class="post-title">{{ $item->judul_informasi }}</h3>

                                <p>
                                    {{ $item->deskripsi_informasi }}
                                </p>

                            </div>

                        </article>
                    </div><!-- End post list item -->

                    <!-- Open MODAL Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_informasi }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                        <div class="modal-dialog"> <!-- id yang ada di route {id_informasi} -->
                            <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id_informasi }}">Edit Data
                                        Informasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                        <input type="text" class="form-control" id="judul_informasi"
                                            name="judul_informasi" value="{{ $item->judul_informasi }}"
                                            required><!-- required berguna untuk mewajibkan diisi  -->
                                    </div>
                                    <div class="mb-3">
                                        <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label><br>
                                        @if ($item->lampiran_informasi)
                                            <p class="text-muted">File sebelumnya: <a
                                                    href="{{ asset('storage/lampiran_informasi/' . $item->lampiran_informasi) }}"
                                                    target="_blank">{{ $item->lampiran_informasi }}</a></p>
                                        @endif
                                        <input type="file" class="form-control" id="lampiran_informasi"
                                            name="lampiran_informasi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label><br>
                                        <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control w-100" rows="10"> {{ $item->deskripsi_informasi }} </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_informasi" class="form-label">Kategori Informasi</label><br>
                                        <input type="radio" id="berita" name="kategori_informasi" value="Berita"
                                            {{ $item->kategori_informasi == 'Berita' ? 'checked' : '' }} required>
                                        <label for="berita">Berita</label><br>
                                        <input type="radio" id="pengumuman" name="kategori_informasi"
                                            value="Pengumuman"
                                            {{ $item->kategori_informasi == 'Pengumuman' ? 'checked' : '' }} required>
                                        <label for="pengumuman">Pengumuman</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_informasi" class="form-label">Status Informasi</label><br>
                                        <input type="radio" id="draft" name="status_informasi" value="0">
                                        <label for="draft">Draft</label><br>
                                        <input type="radio" id="publish" name="status_informasi" value="1">
                                        <label for="publish">Publish</label><br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Close MODAL Edit -->
                @endforeach

            </div>
        </div>

        <!--Open MODAL Create(Tambah)-->
        <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahGambar">Tambah Data Informasi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <form action="/upload-gambar" method="POST" enctype="multipart/form-data"> -->
                        <form action="{{ route('sekretaris.informasi.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                <input type="text" class="form-control" id="judul_informasi" name="judul_informasi"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label><br>
                                <input type="file" class="form-control" id="lampiran_informasi"
                                    name="lampiran_informasi" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label><br>
                                <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control w-100" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_informasi" class="form-label">Kategori Informasi</label><br>
                                <input type="radio" id="berita" name="kategori_informasi" value="Berita" required>
                                <label for="berita">Berita</label><br>
                                <input type="radio" id="pengumuman" name="kategori_informasi" value="Pengumuman"
                                    required>
                                <label for="pengumuman">Pengumuman</label>
                            </div>
                            <div class="mb-3">
                                <label for="status_informasi" class="form-label">Status Informasi</label><br>
                                <input type="radio" id="draft" name="status_informasi" value="0">
                                <label for="draft">Draft</label><br>
                                <input type="radio" id="publish" name="status_informasi" value="1">
                                <label for="publish">Publish</label><br>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Close MODAL Create(Tambah)-->

    </section><!-- /Blog Posts Section -->

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
