@extends('dashboard.sekretaris.component.main')

@section(section: 'sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
        <h1>Galeri</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/index_sekretaris">Home</a></li>
                <li class="current">Galeri</li>
            </ol>
        </nav>
    </div>
</div>

<section id="projects" class="projects section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Galeri</h2>
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                Tambah Gambar Galeri
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Judul Galeri</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="align-middle text-center">
                @foreach ($galleries as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->judul_galeri }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="Gambar" width="120" height="80" style="object-fit: cover;">
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id_galeri }}">Edit</button>
                            <!-- Form Hapus -->
                            <form action="{{ route('galleries.destroy', $item->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $item->id_galeri }}" tabindex="-1"
                    aria-labelledby="editModalLabel{{ $item->id_galeri }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('galleries.update', $item->id_galeri) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $item->id_galeri }}">Edit Galeri</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="judul_galeri" class="form-label">Judul Galeri</label>
                                    <input type="text" class="form-control" name="judul_galeri"
                                        value="{{ $item->judul_galeri }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_galeri" class="form-label">Ganti Gambar</label>
                                    <input type="file" class="form-control" name="gambar_galeri">
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

    <!-- MODAL Tambah Gambar -->
    <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahGambar">Tambah Data Galeri Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul_galeri" class="form-label">Judul Galeri</label>
                        <input type="text" class="form-control" name="judul_galeri" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_galeri" class="form-label">Upload Gambar</label>
                        <input type="file" class="form-control" name="gambar_galeri" required>
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
@endsection
