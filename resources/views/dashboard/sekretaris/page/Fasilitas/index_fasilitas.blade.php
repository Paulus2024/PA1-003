@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <main id="main">
        <section id="projects" class="projects section">
            <div class="container" style="font-family: 'Cambria', serif;">
                <div class="section-title">
                    <h2 class="fw-bold text-primary">Fasilitas Desa</h2>
                    <p>Kelola data fasilitas dan prasarana desa</p>
                </div>

                <!-- Action Buttons -->
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                            <i class="bi bi-plus-circle"></i> Tambah Fasilitas
                        </button>
                    </div>
                </div>

                <!-- Fasilitas Table -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Nama Fasilitas</th>
                                        <th width="25%">Deskripsi</th>
                                        <th width="15%">Lokasi</th>
                                        <th width="15%">Gambar</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fasilitas as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_fasilitas }}</td>
                                            <td>{{ Str::limit($item->deskripsi_fasilitas, 50) }}</td>
                                            <td>{{ $item->lokasi_fasilitas }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $item->gambar_fasilitas) }}" target="_blank" class="text-decoration-none">
                                                    <img src="{{ asset('storage/' . $item->gambar_fasilitas) }}"
                                                         alt="{{ $item->nama_fasilitas }}"
                                                         class="img-thumbnail"
                                                         style="width: 80px; height: 60px; object-fit: cover;">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id_fasilitas }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <form action="{{ route('sekretaris.fasilitas.destroy', $item->id_fasilitas) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $item->id_fasilitas }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Fasilitas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('sekretaris.fasilitas.update', $item->id_fasilitas) }}"
                                                          method="POST"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Fasilitas</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="nama_fasilitas"
                                                                       value="{{ $item->nama_fasilitas }}"
                                                                       required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea class="form-control"
                                                                          name="deskripsi_fasilitas"
                                                                          rows="3"
                                                                          required>{{ $item->deskripsi_fasilitas }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Lokasi</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="lokasi_fasilitas"
                                                                       value="{{ $item->lokasi_fasilitas }}"
                                                                       required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Gambar</label>
                                                                <input type="file"
                                                                       class="form-control"
                                                                       name="gambar_fasilitas">
                                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Modal -->
                <div class="modal fade" id="TambahGambar" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Fasilitas Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('sekretaris.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Fasilitas</label>
                                        <input type="text" class="form-control" name="nama_fasilitas" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi_fasilitas" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" name="lokasi_fasilitas" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gambar</label>
                                        <input type="file" class="form-control" name="gambar_fasilitas" required>
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
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        body {
            font-family: 'Cambria', serif;
        }
        .table {
            font-size: 0.95rem;
        }
        .img-thumbnail {
            transition: transform 0.2s;
        }
        .img-thumbnail:hover {
            transform: scale(1.05);
        }
        .card {
            border-radius: 8px;
        }
        .modal-content {
            border-radius: 10px;
        }
    </style>
@endpush
