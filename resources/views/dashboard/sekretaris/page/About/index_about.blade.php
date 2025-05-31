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
            max-width: 80px; /* Ukuran thumbnail diperkecil */
            height: auto;
            border-radius: 4px;
        }
        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .table-responsive { /* Tambahkan class ini jika belum ada */
            overflow-x: auto;
        }
    </style>

    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <section id="abouts" class="abouts section">
        <div class="container" style="font-family: 'Cambria', serif;">
            <div class="section-title">
                <h2 class="fw-bold text-primary">Tentang Desa</h2>
                <p>Kelola informasi tentang desa</p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    @if ($abouts->isEmpty())
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahAbout">
                            <i class="bi bi-plus-circle"></i> Tambah Data
                        </button>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th width="20%">Sejarah</th>
                                    <th width="20%">Visi & Misi</th>
                                    <th width="7%">Jumlah Penduduk</th>
                                    <th width="7%">Luas Wilayah</th>
                                    <th width="7%">Jumlah Perangkat Desa</th>
                                    <th width="8%">Gambar 1</th>
                                    <th width="8%">Gambar 2</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($abouts as $index => $about)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{!! $about->sejarah !!}</td>
                                        <td>{!! $about->visi_misi !!}</td>
                                        <td class="text-center">{{ $about->jumlah_penduduk }}</td>
                                        <td class="text-center">{{ $about->luas_wilayah }}</td>
                                        <td class="text-center">{{ $about->jumlah_perangkat_desa }}</td>
                                        <td class="text-center">
                                            @if ($about->gambar_1)
                                                <img src="{{ asset('storage/' . $about->gambar_1) }}"
                                                     alt="Gambar 1"
                                                     class="img-thumbnail">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($about->gambar_2)
                                                <img src="{{ asset('storage/' . $about->gambar_2) }}"
                                                     alt="Gambar 2"
                                                     class="img-thumbnail">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2 action-buttons">
                                                 <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#editModal{{ $about->id }}">
                                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                                </button>
                                                <form action="{{ route('abouts.destroy', $about->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                     <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $about->id }}" tabindex="-1"
                                         aria-labelledby="editModalLabel{{ $about->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Edit Data Tentang Desa</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('abouts.update', $about->id) }}" method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="sejarah" class="form-label">Sejarah</label>
                                                                    <textarea class="form-control rounded-pill" id="sejarah" name="sejarah" rows="4">{!! $about->sejarah !!}</textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="luas_wilayah" class="form-label">Luas Wilayah</label>
                                                                    <input type="text" class="form-control rounded-pill" id="luas_wilayah" name="luas_wilayah" value="{{ $about->luas_wilayah }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                                                    <input type="number" class="form-control rounded-pill" id="jumlah_penduduk" name="jumlah_penduduk" value="{{ $about->jumlah_penduduk }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="jumlah_perangkat_desa" class="form-label">Jumlah Perangkat Desa</label>
                                                                    <input type="number" class="form-control rounded-pill" id="jumlah_perangkat_desa" name="jumlah_perangkat_desa" value="{{ $about->jumlah_perangkat_desa }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="visi_misi" class="form-label">Visi Misi</label>
                                                                    <textarea class="form-control rounded-pill" id="visi_misi" name="visi_misi" rows="4">{!! $about->visi_misi !!}</textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="gambar_1" class="form-label">Gambar 1</label>
                                                                    <input type="file" class="form-control" id="gambar_1" name="gambar_1" accept="image/*">
                                                                    @if($about->gambar_1)
                                                                        <img src="{{ asset('storage/' . $about->gambar_1) }}"
                                                                             alt="Gambar 1"
                                                                             class="img-thumbnail mt-2"
                                                                             width="100">
                                                                    @endif
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="gambar_2" class="form-label">Gambar 2</label>
                                                                    <input type="file" class="form-control" id="gambar_2" name="gambar_2" accept="image/*">
                                                                    @if($about->gambar_2)
                                                                        <img src="{{ asset('storage/' . $about->gambar_2) }}"
                                                                             alt="Gambar 2"
                                                                             class="img-thumbnail mt-2"
                                                                             width="100">
                                                                    @endif
                                                                </div>
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

                    @if($abouts->isEmpty())
                        <p class="text-center">Belum ada data About yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Add About Modal -->
        <div class="modal fade" id="TambahAbout" tabindex="-1" aria-labelledby="tambahAboutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="tambahAboutLabel">Tambah Data Tentang Desa</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sejarah" class="form-label">Sejarah</label>
                                        <textarea class="form-control rounded-pill" id="sejarah" name="sejarah" rows="4"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="luas_wilayah" class="form-label">Luas Wilayah</label>
                                        <input type="text" class="form-control rounded-pill" id="luas_wilayah" name="luas_wilayah">
                                    </div>

                                    <div class="mb-3">
                                        <label for="jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                        <input type="number" class="form-control rounded-pill" id="jumlah_penduduk" name="jumlah_penduduk">
                                    </div>

                                    <div class="mb-3">
                                        <label for="jumlah_perangkat_desa" class="form-label">Jumlah Perangkat Desa</label>
                                        <input type="number" class="form-control rounded-pill" id="jumlah_perangkat_desa" name="jumlah_perangkat_desa">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="visi_misi" class="form-label">Visi Misi</label>
                                        <textarea class="form-control rounded-pill" id="visi_misi" name="visi_misi" rows="4"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar_1" class="form-label">Gambar 1</label>
                                        <input type="file" class="form-control" id="gambar_1" name="gambar_1" accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar_2" class="form-label">Gambar 2</label>
                                        <input type="file" class="form-control" id="gambar_2" name="gambar_2" accept="image/*">
                                    </div>
                                </div>
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
