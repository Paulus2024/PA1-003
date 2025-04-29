@extends('dashboard.sekretaris.component.main')

@section(section:'sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
        <h1>Data Pengurus Desa</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/index_sekretaris">Home</a></li>
                <li class="current">Data Pengurus Desa</li>
            </ol>
        </nav>
    </div>
</div>

<section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div>

    <div class="container">
        <div class="row gy-5">
            @foreach ($data_pengurus_desas as $item)
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                    <img src="{{asset('storage/' . $item->gambar_data_pengurus_desa)}}" class="img-fluid" alt="">
                </div>
                <div class="member-info text-center">
                    <h4>{{ $item->nama_data_pengurus_desa }}</h4>
                    <span>{{ $item->jabatan_data_pengurus_desa }}</span>
                    <p>{{ $item->deskripsi_data_pengurus_desa }}</p>
                </div>
                <div class="d-flex gap-2">
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_data_pengurus_desa }}">
                        Edit
                    </button>
                    <!-- Form Hapus -->
                    <form action="{{ route('sekretaris.fasilitas.destroy', $item->id_data_pengurus_desa) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $item->id_data_pengurus_desa }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_data_pengurus_desa }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('sekretaris.fasilitas.update', $item->id_data_pengurus_desa) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $item->id_data_pengurus_desa }}">Edit Data Pengurus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_data_pengurus_desa" value="{{ $item->nama_data_pengurus_desa }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan_data_pengurus_desa" value="{{ $item->jabatan_data_pengurus_desa }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi_data_pengurus_desa" value="{{ $item->deskripsi_data_pengurus_desa }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar_data_pengurus_desa">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol Tambah -->
        <div class="col-12 mt-4">
            <div class="d-grid gap-2">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Data Pengurus</button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="modalTitleTambah" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('sekretaris.fasilitas.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleTambah">Tambah Data Pengurus Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_data_pengurus_desa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_data_pengurus_desa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi_data_pengurus_desa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Gambar</label>
                        <input type="file" class="form-control" name="gambar_data_pengurus_desa" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

<!-- Tambahkan Script Bootstrap jika belum -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
