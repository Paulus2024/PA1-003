{{-- @extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <style>
        body {
            font-family: 'Cambria', serif;
        }
        .blog-posts .post-img {
            height: 200px;
            overflow: hidden;
            border-radius: 8px 8px 0 0;
        }
        .blog-posts .post-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .blog-posts .post-img:hover img {
            transform: scale(1.05);
        }
        .post-date {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        .post-content {
            background: white;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 8px 8px;
            height: calc(100% - 200px);
            display: flex;
            flex-direction: column;
        }
        .post-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .post-content p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }
        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 500;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            background: transparent;
        }
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        textarea.form-control {
            min-height: 150px;
        }
        .file-preview {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>

    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <section id="blog-pagination" class="blog-pagination section mt-5 pt-4">
        <div class="container">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_sekretaris') ? 'active' : '' }}" href="{{ route('informasi.berita') }}">
                        <i class=""></i>Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_pengumuman') ? 'active' : '' }}" href="{{ route('informasi.pengumuman') }}">
                        <i class=""></i>Pengumuman
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <section id="blog-posts" class="blog-posts section pb-5">
        <div class="container">
            <div class="row gy-4">
                @foreach ($pengumuman as $item)
                    <div class="col-lg-4">
                        <article class="position-relative h-100 shadow-sm">
                            <div class="post-img position-relative overflow-hidden">
                                @php
                                    $path = 'storage/' . $item->lampiran_informasi;
                                    $extension = pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($path) }}" class="img-fluid" alt="Gambar Informasi">
                                @elseif($extension === 'pdf')
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="far fa-file-pdf fa-4x text-danger"></i>
                                    </div>
                                @elseif(in_array($extension, ['doc', 'docx']))
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="far fa-file-word fa-4x text-primary"></i>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="far fa-file-alt fa-4x text-secondary"></i>
                                    </div>
                                @endif
                                <span class="post-date">{{ $item->created_at->format('d M') }}</span>
                            </div>

                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $item->judul_informasi }}</h3>
                                <p>{{ Str::limit($item->deskripsi_informasi, 120) }}</p>

                                <div class="d-flex gap-2 mt-auto">
                                    <button type="button" class="btn btn-outline-warning w-50" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_informasi }}">
                                        <i class="far fa-edit me-1"></i> Edit
                                    </button>

                                    <form action="{{ route('sekretaris.informasi.destroy', $item->id_informasi) }}"
                                          method="POST"
                                          class="w-50"
                                          onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="far fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $item->id_informasi }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id_informasi }}">
                                        <i class="fas fa-edit me-2"></i>Edit Data Informasi
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                        <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" value="{{ $item->judul_informasi }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label>
                                        @if ($item->lampiran_informasi)
                                            <div class="file-preview mb-2">
                                                <p class="mb-1">File sebelumnya:</p>
                                                <a href="{{ asset('storage/' . $item->lampiran_informasi) }}" target="_blank" class="text-decoration-none">
                                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <i class="far fa-image text-primary me-1"></i>
                                                    @elseif($extension === 'pdf')
                                                        <i class="far fa-file-pdf text-danger me-1"></i>
                                                    @elseif(in_array($extension, ['doc', 'docx']))
                                                        <i class="far fa-file-word text-primary me-1"></i>
                                                    @else
                                                        <i class="far fa-file-alt me-1"></i>
                                                    @endif
                                                    {{ $item->lampiran_informasi }}
                                                </a>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi">
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label>
                                        <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control" rows="5">{{ $item->deskripsi_informasi }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kategori Informasi</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="berita{{ $item->id_informasi }}"
                                                       name="kategori_informasi" value="Berita"
                                                       {{ $item->kategori_informasi == 'Berita' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="berita{{ $item->id_informasi }}">Berita</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="pengumuman{{ $item->id_informasi }}"
                                                       name="kategori_informasi" value="Pengumuman"
                                                       {{ $item->kategori_informasi == 'Pengumuman' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="pengumuman{{ $item->id_informasi }}">Pengumuman</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status Informasi</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="draft{{ $item->id_informasi }}"
                                                       name="status_informasi" value="0"
                                                       {{ $item->status_informasi == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="draft{{ $item->id_informasi }}">Draft</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="publish{{ $item->id_informasi }}"
                                                       name="status_informasi" value="1"
                                                       {{ $item->status_informasi == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="publish{{ $item->id_informasi }}">Publish</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-1"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="col-12 mt-4">
                    <div class="d-grid">
                        <button class="btn btn-primary py-2" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Informasi Desa
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahGambar">
                            <i class="fas me-2"></i>Tambah Data Informasi Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('sekretaris.informasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" required>
                            </div>

                            <div class="mb-3">
                                <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label>
                                <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label>
                                <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control" rows="5" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori Informasi</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="berita_new" name="kategori_informasi" value="Berita" required>
                                        <label class="form-check-label" for="berita_new">Berita</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="pengumuman_new" name="kategori_informasi" value="Pengumuman" required>
                                        <label class="form-check-label" for="pengumuman_new">Pengumuman</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Informasi</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="draft_new" name="status_informasi" value="0">
                                        <label class="form-check-label" for="draft_new">Draft</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="publish_new" name="status_informasi" value="1" checked>
                                        <label class="form-check-label" for="publish_new">Publish</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class=""></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class=""></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection --}}


@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <style>
        /* Mengatur font dasar untuk seluruh body */
        body {
            font-family: 'Cambria', serif;
        }

        /* Styling untuk tab navigasi */
        .nav-tabs {
            border-bottom: 2px solid #dee2e6; /* Garis bawah untuk tab */
        }

        .nav-tabs .nav-link {
            color: #495057; /* Warna teks default */
            font-weight: 500; /* Ketebalan font */
            border: none; /* Tanpa border */
            padding: 10px 20px; /* Padding */
            margin: 0 5px; /* Margin antar tab */
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd; /* Warna teks untuk tab aktif */
            border-bottom: 3px solid #0d6efd; /* Garis bawah tebal untuk tab aktif */
            background: transparent; /* Latar belakang transparan */
        }

        /* Styling untuk modal */
        .modal-content {
            border-radius: 10px; /* Sudut membulat */
        }

        .modal-header {
            background: #f8f9fa; /* Latar belakang header modal */
            border-bottom: 1px solid #dee2e6; /* Garis bawah header modal */
        }

        /* Styling untuk textarea di form */
        textarea.form-control {
            min-height: 150px; /* Tinggi minimum textarea */
        }

        /* Styling untuk gambar di dalam tabel */
        .table img {
            max-width: 80px; /* Lebar maksimum gambar */
            max-height: 80px; /* Tinggi maksimum gambar */
            object-fit: cover; /* Memastikan gambar mengisi area tanpa terdistorsi */
            border-radius: 4px; /* Sudut membulat pada gambar */
        }

        /* Styling untuk ikon file (PDF, Word, umum) di dalam tabel */
        .table .fa-file-pdf,
        .table .fa-file-word,
        .table .fa-file-alt {
            font-size: 2.5rem; /* Ukuran ikon */
        }

        .table .fa-file-pdf {
            color: #dc3545; /* Warna merah untuk PDF */
        }

        .table .fa-file-word {
            color: #007bff; /* Warna biru untuk Word */
        }

        .table .fa-file-alt {
            color: #6c757d; /* Warna abu-abu untuk file umum */
        }
    </style>

    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <section id="informasi-desa" class="informasi-desa section mt-5 pt-4">
        <div class="container">
            <h2 class="mb-4">Informasi Desa</h2>
            <p class="text-muted">Kelola data informasi dan pengumuman desa.</p>

            <!-- Tab navigasi untuk Berita dan Pengumuman -->
            <ul class="nav nav-tabs justify-content-start mb-4">
                <li class="nav-item">
                    <!-- Link ke halaman Berita -->
                    <a class="nav-link {{ Request::is('informasi_sekretaris') ? 'active' : '' }}" href="{{ route('informasi.berita') }}"> Berita </a>
                </li>
                <li class="nav-item">
                    <!-- Link ke halaman Pengumuman (aktif jika di halaman ini) -->
                    <a class="nav-link {{ Request::is('informasi_pengumuman') ? 'active' : '' }}" href="{{ route('informasi.pengumuman') }}"> Pengumuman </a>
                </li>
            </ul>

            <!-- Tombol untuk menambah informasi baru -->
            <div class="mb-3">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                    <i class="fas fa-plus-circle"></i> Tambah Informasi
                </button>
            </div>

            <!-- Tabel responsif untuk menampilkan data pengumuman -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Informasi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Lampiran</th>
                            <th scope="col">Tanggal Publikasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop melalui setiap item pengumuman -->
                        @forelse ($pengumuman as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->judul_informasi }}</td>
                                <td>{{ $item->kategori_informasi }}</td>
                                <td>{{ Str::limit($item->deskripsi_informasi, 100) }}</td>
                                <td>
                                    @php
                                        $path = 'storage/' . $item->lampiran_informasi;
                                        $extension = pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION);
                                    @endphp

                                    <!-- Menampilkan lampiran berdasarkan jenis file -->
                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <a href="{{ asset($path) }}" target="_blank">
                                            <img src="{{ asset($path) }}" alt="Lampiran">
                                        </a>
                                    @elseif($extension === 'pdf')
                                        <a href="{{ asset($path) }}" target="_blank" class="d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="far fa-file-pdf"></i>
                                        </a>
                                    @elseif(in_array($extension, ['doc', 'docx']))
                                        <a href="{{ asset($path) }}" target="_blank" class="d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="far fa-file-word"></i>
                                        </a>
                                    @else
                                        <a href="{{ asset($path) }}" target="_blank" class="d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="far fa-file-alt"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <!-- Menampilkan status informasi (Publish/Draft) -->
                                    @if($item->status_informasi == 1)
                                        <span class="badge bg-success">Publish</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol aksi (Edit dan Hapus) -->
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_informasi }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('sekretaris.informasi.destroy', $item->id_informasi) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $item->id_informasi }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id_informasi }}">Edit Data Informasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                                <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" value="{{ $item->judul_informasi }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label><br>
                                                @if ($item->lampiran_informasi)
                                                    <p class="text-muted">File sebelumnya:
                                                        <a href="{{ asset('storage/' . $item->lampiran_informasi) }}" target="_blank" class="text-decoration-none">
                                                            <i class="far fa-file"></i> {{ basename($item->lampiran_informasi) }}
                                                        </a>
                                                    </p>
                                                @endif
                                                <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi">
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label>
                                                <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control" rows="5">{{ $item->deskripsi_informasi }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori Informasi</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="berita{{ $item->id_informasi }}" name="kategori_informasi" value="Berita" {{ $item->kategori_informasi == 'Berita' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="berita{{ $item->id_informasi }}">Berita</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="pengumuman{{ $item->id_informasi }}" name="kategori_informasi" value="Pengumuman" {{ $item->kategori_informasi == 'Pengumuman' ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="pengumuman{{ $item->id_informasi }}">Pengumuman</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status Informasi</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="draft{{ $item->id_informasi }}" name="status_informasi" value="0" {{ $item->status_informasi == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="draft{{ $item->id_informasi }}">Draft</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="publish{{ $item->id_informasi }}" name="status_informasi" value="1" {{ $item->status_informasi == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="publish{{ $item->id_informasi }}">Publish</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pengumuman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahGambar">Tambah Data Informasi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('sekretaris.informasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" required>
                            </div>
                            <div class="mb-3">
                                <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label>
                                <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label>
                                <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori Informasi</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="berita_new" name="kategori_informasi" value="Berita" required>
                                    <label class="form-check-label" for="berita_new">Berita</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="pengumuman_new" name="kategori_informasi" value="Pengumuman" required>
                                    <label class="form-check-label" for="pengumuman_new">Pengumuman</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status Informasi</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="draft_new" name="status_informasi" value="0">
                                    <label class="form-check-label" for="draft_new">Draft</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="publish_new" name="status_informasi" value="1" checked>
                                    <label class="form-check-label" for="publish_new">Publish</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
