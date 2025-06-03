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
            max-width: 80px; /* Ukuran tetap untuk list */
            height: auto;
            border-radius: 4px;
        }
        .img-preview-modal { /* Kelas baru untuk preview di modal */
            max-width: 150px; /* Ukuran lebih besar untuk preview di modal */
            height: auto;
            border-radius: 4px;
            margin-top: 0.5rem;
        }
        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .table-responsive {
            overflow-x: auto;
        }

        /* CSS kustom untuk validasi :invalid/:valid bisa dipertimbangkan untuk dihapus
           jika menggunakan styling Bootstrap is-invalid/is-valid sepenuhnya.
           Untuk saat ini, saya biarkan ter-comment jika Anda ingin mengaktifkannya kembali.
        input:invalid,
        textarea:invalid {
            border-color: red;
            box-shadow: 0 0 5px red;
        }

        input:valid,
        textarea:valid {
            border-color: green;
        }

        input:invalid:focus,
        textarea:invalid:focus {
            border-color: red;
            box-shadow: 0 0 5px red;
        }
        */

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
                                        <td>{!! Str::limit(strip_tags($about->sejarah), 100) !!}</td> {{-- Batasi teks & hapus HTML untuk tabel --}}
                                        <td>{!! Str::limit(strip_tags($about->visi_misi), 100) !!}</td> {{-- Batasi teks & hapus HTML untuk tabel --}}
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
                                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#editModal{{ $about->id }}"> {{-- hapus rounded-pill --}}
                                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                                </button>
                                                <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"> {{-- hapus rounded-pill --}}
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal{{ $about->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $about->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header"> {{-- Header standar --}}
                                                    <h5 class="modal-title" id="editModalLabel{{ $about->id }}">Edit Data Tentang Desa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="editAboutForm{{ $about->id }}" action="{{ route('abouts.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    @if ($errors->any())
                                                        <div class="alert alert-danger mx-3 mt-3">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_sejarah_{{ $about->id }}" class="form-label">Sejarah</label>
                                                            <textarea class="form-control @error('sejarah') is-invalid @enderror" id="edit_sejarah_{{ $about->id }}" name="sejarah" rows="4" required>{!! old('sejarah', $about->sejarah ?? '') !!}</textarea>
                                                            @error('sejarah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_visi_misi_{{ $about->id }}" class="form-label">Visi Misi</label>
                                                            <textarea class="form-control @error('visi_misi') is-invalid @enderror" id="edit_visi_misi_{{ $about->id }}" name="visi_misi" rows="4" required>{!! old('visi_misi', $about->visi_misi ?? '') !!}</textarea>
                                                            @error('visi_misi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_luas_wilayah_{{ $about->id }}" class="form-label">Luas Wilayah</label>
                                                            <input type="text" class="form-control @error('luas_wilayah') is-invalid @enderror" id="edit_luas_wilayah_{{ $about->id }}" name="luas_wilayah" value="{{ old('luas_wilayah', $about->luas_wilayah ?? '') }}" required>
                                                            @error('luas_wilayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_jumlah_penduduk_{{ $about->id }}" class="form-label">Jumlah Penduduk</label>
                                                            <input type="number" class="form-control @error('jumlah_penduduk') is-invalid @enderror" id="edit_jumlah_penduduk_{{ $about->id }}" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $about->jumlah_penduduk ?? '') }}" required>
                                                            @error('jumlah_penduduk')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_jumlah_perangkat_desa_{{ $about->id }}" class="form-label">Jumlah Perangkat Desa</label>
                                                            <input type="number" class="form-control @error('jumlah_perangkat_desa') is-invalid @enderror" id="edit_jumlah_perangkat_desa_{{ $about->id }}" name="jumlah_perangkat_desa" value="{{ old('jumlah_perangkat_desa', $about->jumlah_perangkat_desa ?? '') }}" required>
                                                            @error('jumlah_perangkat_desa')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_gambar_1_{{ $about->id }}" class="form-label">Gambar 1</label>
                                                            <input type="file" class="form-control @error('gambar_1') is-invalid @enderror" id="edit_gambar_1_{{ $about->id }}" name="gambar_1" accept="image/*">
                                                            @if($about->gambar_1)
                                                                <img src="{{ asset('storage/' . $about->gambar_1) }}" alt="Gambar 1 Saat Ini" class="img-preview-modal">
                                                            @endif
                                                            @error('gambar_1')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_gambar_2_{{ $about->id }}" class="form-label">Gambar 2</label>
                                                            <input type="file" class="form-control @error('gambar_2') is-invalid @enderror" id="edit_gambar_2_{{ $about->id }}" name="gambar_2" accept="image/*">
                                                            @if($about->gambar_2)
                                                                <img src="{{ asset('storage/' . $about->gambar_2) }}" alt="Gambar 2 Saat Ini" class="img-preview-modal">
                                                            @endif
                                                            @error('gambar_2')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> {{-- hapus rounded-pill --}}
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button> {{-- hapus rounded-pill --}}
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

        <div class="modal fade" id="TambahAbout" tabindex="-1" aria-labelledby="tambahAboutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header"> {{-- Header standar --}}
                        <h5 class="modal-title" id="tambahAboutLabel">Tambah Data Tentang Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahAboutForm" action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger mx-3 mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="tambah_sejarah" class="form-label">Sejarah</label>
                                <textarea class="form-control @error('sejarah') is-invalid @enderror" id="tambah_sejarah" name="sejarah" rows="4" required>{{ old('sejarah') }}</textarea>
                                @error('sejarah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_visi_misi" class="form-label">Visi Misi</label>
                                <textarea class="form-control @error('visi_misi') is-invalid @enderror" id="tambah_visi_misi" name="visi_misi" rows="4" required>{{ old('visi_misi') }}</textarea>
                                @error('visi_misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_luas_wilayah" class="form-label">Luas Wilayah</label>
                                <input type="text" class="form-control @error('luas_wilayah') is-invalid @enderror" id="tambah_luas_wilayah" name="luas_wilayah" value="{{ old('luas_wilayah') }}" required>
                                @error('luas_wilayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                <input type="number" class="form-control @error('jumlah_penduduk') is-invalid @enderror" id="tambah_jumlah_penduduk" name="jumlah_penduduk" value="{{ old('jumlah_penduduk') }}" required>
                                @error('jumlah_penduduk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_jumlah_perangkat_desa" class="form-label">Jumlah Perangkat Desa</label>
                                <input type="number" class="form-control @error('jumlah_perangkat_desa') is-invalid @enderror" id="tambah_jumlah_perangkat_desa" name="jumlah_perangkat_desa" value="{{ old('jumlah_perangkat_desa') }}" required>
                                @error('jumlah_perangkat_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_gambar_1" class="form-label">Gambar 1</label>
                                <input type="file" class="form-control @error('gambar_1') is-invalid @enderror" id="tambah_gambar_1" name="gambar_1" accept="image/*" required>
                                @error('gambar_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_gambar_2" class="form-label">Gambar 2</label>
                                <input type="file" class="form-control @error('gambar_2') is-invalid @enderror" id="tambah_gambar_2" name="gambar_2" accept="image/*" required>
                                @error('gambar_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> {{-- hapus rounded-pill --}}
                            <button type="submit" class="btn btn-primary">Simpan</button> {{-- hapus rounded-pill --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
