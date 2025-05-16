@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
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

<section class="section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Pengurus</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Data Pengurus</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pengurus_desas as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->gambar_data_pengurus_desa) }}" alt="Foto"
                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                        </td>
                        <td>{{ $item->nama_data_pengurus_desa }}</td>
                        <td>{{ $item->jabatan_data_pengurus_desa }}</td>
                        <td>{{ $item->deskripsi_data_pengurus_desa }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_data_pengurus_desa }}">Edit</button>
                                <form action="{{ route('data_pengurus_desa.destroy', $item->id_data_pengurus_desa) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_data_pengurus_desa }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $item->id_data_pengurus_desa }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('data_pengurus_desa.update', $item->id_data_pengurus_desa) }}" method="POST" enctype="multipart/form-data" class="modal-content">
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
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="modalTitleTambah" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('data_pengurus_desa.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
