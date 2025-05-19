@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
<style>
    body, table, .modal, .btn {
        font-family: 'Cambria', serif;
    }
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .img-thumbnail {
        max-width: 120px;
        height: auto;
        border-radius: 4px;
    }
    .action-buttons .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<section id="projects" class="projects section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold text-primary">Manajemen Galeri</h2>
                <p class="text-muted">Kelola gambar-gambar galeri kegiatan</p>
                <button class="btn btn-primary rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Gambar</button>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="30%">Judul Galeri</th>
                                <th width="25%">Gambar</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->judul_galeri }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar_galeri) }}"
                                         alt="Galeri {{ $item->judul_galeri }}"
                                         class="img-thumbnail">
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 action-buttons">
                                        <button type="button"
                                                class="btn btn-outline-primary rounded-pill"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id_galeri }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>
                                        <form action="{{ route('galleries.destroy', $item->id_galeri) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-outline-danger rounded-pill">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id_galeri }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id_galeri }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Galeri</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('galleries.update', $item->id_galeri) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="judul_galeri" class="form-label">Judul Galeri</label>
                                                    <input type="text"
                                                           class="form-control rounded-pill"
                                                           name="judul_galeri"
                                                           value="{{ $item->judul_galeri }}"
                                                           required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar_galeri" class="form-label">Ganti Gambar</label>
                                                    <input type="file"
                                                           class="form-control"
                                                           name="gambar_galeri"
                                                           accept="image/*">
                                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $item->gambar_galeri) }}"
                                                             alt="Current Image"
                                                             class="img-thumbnail mt-2"
                                                             width="150">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary rounded-pill">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($galleries->isEmpty())
                @endif
            </div>
        </div>
    </div>

    <!-- Add Gallery Modal -->
    <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Galeri Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul_galeri" class="form-label">Judul Galeri</label>
                            <input type="text"
                                   class="form-control rounded-pill"
                                   name="judul_galeri"
                                   placeholder="Masukkan judul galeri"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_galeri" class="form-label">Pilih Gambar</label>
                            <input type="file"
                                   class="form-control"
                                   name="gambar_galeri"
                                   accept="image/*"
                                   required>
                            <small class="text-muted">Format yang didukung: JPG, PNG, JPEG. Maksimal 2MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
