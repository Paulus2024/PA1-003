@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<section class="section" style=" font-family: 'Cambria', serif;">
    <div class="container" style="font-family: 'Cambria', serif;">
        <div class="section-title">
            <h2 class="fw-bold text-primary">Daftar Pengurus Desa</h2>
            <p>Kelola data pengurus desa</p>
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahGambar">
                    <i class="bi bi-person-plus me-2"></i> Tambah Pengurus
                </button>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" style="font-family: 'Cambria', serif;">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Foto</th>
                                <th width="20%">Nama</th>
                                <th width="20%">Jabatan</th>
                                <th width="25%">Deskripsi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_pengurus_desas as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar_data_pengurus_desa) }}"
                                        alt="Foto {{ $item->nama_data_pengurus_desa }}"
                                        class="img-thumbnail rounded-circle"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold">{{ $item->nama_data_pengurus_desa }}</td>
                                <td>
                                    {{-- Menggunakan relasi jabatan --}}
                                    <span class="badge bg-primary rounded-pill">{{ $item->jabatan->nama_jabatan ?? 'Jabatan Tidak Ditemukan' }}</span>
                                </td>
                                <td class="text-truncate" style="max-width: 250px;" title="{{ $item->deskripsi_data_pengurus_desa }}">
                                    {{ $item->deskripsi_data_pengurus_desa }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-primary rounded-pill"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id_data_pengurus_desa }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>

                                        <form action="{{ route('data_pengurus_desa.destroy', $item->id_data_pengurus_desa) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $item->id_data_pengurus_desa }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id_data_pengurus_desa }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id_data_pengurus_desa }}"
                                                style="font-family: 'Cambria', serif;">Edit Data Pengurus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('data_pengurus_desa.update', $item->id_data_pengurus_desa) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body" style="font-family: 'Cambria', serif;">
                                                <div class="text-center mb-4">
                                                    <img src="{{ asset('storage/' . $item->gambar_data_pengurus_desa) }}" alt="Current Photo"
                                                        class="img-thumbnail rounded-circle mb-2"
                                                        style="width: 120px; height: 120px; object-fit: cover;">
                                                    <p class="text-muted small">Foto saat ini</p>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control rounded-pill" name="nama_data_pengurus_desa"
                                                        value="{{ $item->nama_data_pengurus_desa }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Jabatan</label>
                                                    <select class="form-select rounded-pill" name="jabatan_id" required>
                                                        <option value="">Pilih Jabatan</option>
                                                        {{-- Menggunakan $semua_jabatan yang dikirim dari method index --}}
                                                        @foreach ($semua_jabatan as $jabatan)
                                                            <option value="{{ $jabatan->id }}"
                                                                @selected($jabatan->id == $item->jabatan_id) {{-- Set selected jika ini jabatan pengurus saat ini --}}
                                                                {{-- Nonaktifkan jika jabatan sudah terisi oleh pengurus lain --}}
                                                                @if ($jabatan->pengurus && $jabatan->id != $item->jabatan_id) disabled @endif>
                                                                {{ $jabatan->nama_jabatan }}
                                                                {{-- Tambahkan keterangan jika terisi oleh orang lain --}}
                                                                @if ($jabatan->pengurus && $jabatan->id != $item->jabatan_id)
                                                                    (Terisi oleh {{ $jabatan->pengurus->nama_data_pengurus_desa }})
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('jabatan_id')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi_data_pengurus_desa" rows="3" required>{{ $item->deskripsi_data_pengurus_desa }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Ganti Foto</label>
                                                    <input type="file" class="form-control" name="gambar_data_pengurus_desa"
                                                        accept="image/*">
                                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto</small>
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

                    @if($data_pengurus_desas->isEmpty())
                        {{-- Ini bisa diisi dengan pesan "Tidak ada data" jika diinginkan --}}
                        <div class="text-center py-4 empty-state">
                            <i class="bi bi-person-x display-4 text-muted"></i>
                            <p class="mt-3 text-muted">Belum ada data pengurus desa.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="modalTitleTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-dark">
                    <h5 class="modal-title" id="modalTitleTambah" style="font-family: 'Cambria', serif;">Tambah Data Pengurus Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data_pengurus_desa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" style="font-family: 'Cambria', serif;">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text"
                                class="form-control rounded-pill"
                                name="nama_data_pengurus_desa"
                                placeholder="Masukkan nama lengkap"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select class="form-select rounded-pill" name="jabatan_id" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan_tersedia as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                @endforeach
                                @if ($jabatan_tersedia->isEmpty())
                                    <option value="" disabled>Semua jabatan sudah terisi atau belum ada jabatan.</option>
                                @endif
                            </select>
                            @error('jabatan_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control"
                                        name="deskripsi_data_pengurus_desa"
                                        rows="3"
                                        placeholder="Masukkan deskripsi singkat"
                                        required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Foto</label>
                            <input type="file"
                                class="form-control"
                                name="gambar_data_pengurus_desa"
                                accept="image/*"
                                required>
                            <small class="text-muted">Format yang didukung: JPG, PNG, JPEG. Maksimal 2MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    body {
        font-family: 'Cambria', serif;
        padding-top: 0px;
    }
    .img-thumbnail {
        transition: transform 0.3s ease;
        border: 2px solid #dee2e6;
    }
    .img-thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .text-truncate {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .badge {
        font-family: 'Cambria', serif;
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }
    .modal-content {
        border-radius: 12px;
    }
    .form-control, .form-select {
        font-family: 'Cambria', serif;
    }
    .btn {
        font-family: 'Cambria', serif;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    .empty-state {
        opacity: 0.7;
    }
</style>

@endsection
