@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <style>
        body {
            font-family: 'Cambria', serif;
        }
        .blog-posts .post-img {
            height: 200px;
            overflow: hidden;
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
    </style>

    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <section id="blog-pagination" class="blog-pagination section mt-5 pt-4">
        <div class="container">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_sekretaris') ? 'active' : '' }}" href="{{ route('informasi.berita') }}"> Berita </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_pengumuman') ? 'active' : '' }}" href="{{ route('informasi.pengumuman') }}"> Pengumuman </a>
                </li>
            </ul>
        </div>
    </section>

    <section id="blog-posts" class="blog-posts section pb-5">
        <div class="container">
            <div class="row gy-4">
                @foreach ($berita as $item)
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
                                        <i class="far fa-file-pdf fa-3x text-danger"></i>
                                    </div>
                                @elseif(in_array($extension, ['doc', 'docx']))
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="far fa-file-word fa-3x text-primary"></i>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="far fa-file-alt fa-3x text-secondary"></i>
                                    </div>
                                @endif
                                <span class="post-date">{{ $item->created_at->format('F d') }}</span>
                            </div>

                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $item->judul_informasi }}</h3>
                                <p>{{ Str::limit($item->deskripsi_informasi, 150) }}</p>

                                <div class="mt-auto">
                                    <div class="d-flex gap-2 mt-2">
                                        <button type="button" class="btn btn-outline-warning w-50" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_informasi }}">
                                            <i class="far fa-edit"></i> Edit
                                        </button>

                                        <form action="{{ route('sekretaris.informasi.destroy', $item->id_informasi) }}" method="POST" class="w-50" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="far fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
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
                                                    <i class="far fa-file"></i> {{ $item->lampiran_informasi }}
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
                @endforeach

                <div class="col-12 mt-4">
                    <div class="d-grid">
                        <button class="btn btn-primary py-2" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                            <i class="fas fa-plus-circle"></i> Tambah Informasi Desa
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
