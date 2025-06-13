{{-- @extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <style>
        body,
        table,
        .modal,
        .btn {
            font-family: 'Cambria', serif;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .img-thumbnail {
            max-width: 80px;
            height: auto;
            border-radius: 4px;
        }

        .img-preview-modal,
        .video-preview-modal {
            /* Tambahkan kelas untuk video preview */
            max-width: 150px;
            height: auto;
            border-radius: 4px;
            margin-top: 0.5rem;
        }

        .video-thumbnail {
            /* CSS untuk thumbnail video di tabel */
            max-width: 80px;
            height: auto;
            border-radius: 4px;
        }

        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Hapus komentar jika ingin menggunakan styling validasi kustom ini */
        /*
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
                                    <th width="15%">Kata Sambutan Kepala Desa</th>
                                    <th width="10%">Media File</th>
                                    <th width="15%">Sejarah</th>
                                    <th width="15%">Visi & Misi</th>
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
                                        <td>{!! Str::limit(strip_tags($about->kata_sambutan_kepala_desa), 100) !!}</td>

                                        <td class="text-center">
                                            @if ($about->media_file)
                                                @php
                                                    $extension = pathinfo($about->media_file, PATHINFO_EXTENSION);
                                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                                    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                                @endphp

                                                @if (in_array($extension, $imageExtensions))
                                                    <img src="{{ Storage::url($about->media_file) }}" alt="Media File"
                                                        class="img-thumbnail">
                                                @elseif (in_array($extension, $videoExtensions))
                                                    <video controls width="80" height="auto" class="video-thumbnail">
                                                        <source src="{{ Storage::url($about->media_file) }}"
                                                            type="video/{{ $extension }}">
                                                        Browser Anda tidak mendukung video.
                                                    </video>
                                                @else
                                                    -
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>{!! Str::limit(strip_tags($about->sejarah), 100) !!}</td>
                                        <td>{!! Str::limit(strip_tags($about->visi_misi), 100) !!}</td>
                                        <td class="text-center">{{ $about->jumlah_penduduk }}</td>
                                        <td class="text-center">{{ $about->luas_wilayah }}</td>
                                        <td class="text-center">{{ $about->jumlah_perangkat_desa }}</td>

                                        <td class="text-center">
                                            @if ($about->gambar_1)
                                                <img src="{{ Storage::url($about->gambar_1) }}" alt="Gambar 1"
                                                    class="img-thumbnail">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($about->gambar_2)
                                                <img src="{{ Storage::url($about->gambar_2) }}" alt="Gambar 2"
                                                    class="img-thumbnail">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2 action-buttons">
                                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $about->id }}">
                                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                                </button>
                                                <form action="{{ route('abouts.destroy', $about->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- ? Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $about->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $about->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $about->id }}">Edit
                                                        Data Tentang Desa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="editAboutForm{{ $about->id }}"
                                                    action="{{ route('abouts.update', $about->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id_modal" value="{{ $about->id }}">

                                                    @if ($errors->any() && old('id_modal') == $about->id)
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
                                                            <label for="edit_kata_sambutan_kepala_desa_{{ $about->id }}"
                                                                class="form-label">Kata Sambutan Kepala Desa</label>
                                                            <textarea class="form-control @error('kata_sambutan_kepala_desa') is-invalid @enderror"
                                                                id="edit_kata_sambutan_kepala_desa_{{ $about->id }}" name="kata_sambutan_kepala_desa" rows="4" required>{{ old('kata_sambutan_kepala_desa', $about->kata_sambutan_kepala_desa ?? '') }}</textarea>
                                                            @error('kata_sambutan_kepala_desa')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_sejarah_{{ $about->id }}"
                                                                class="form-label">Sejarah</label>
                                                            <textarea class="form-control @error('sejarah') is-invalid @enderror" id="edit_sejarah_{{ $about->id }}"
                                                                name="sejarah" rows="4" required>{{ old('sejarah', $about->sejarah ?? '') }}</textarea>
                                                            @error('sejarah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_visi_misi_{{ $about->id }}"
                                                                class="form-label">Visi Misi</label>
                                                            <textarea class="form-control @error('visi_misi') is-invalid @enderror" id="edit_visi_misi_{{ $about->id }}"
                                                                name="visi_misi" rows="4" required>{{ old('visi_misi', $about->visi_misi ?? '') }}</textarea>
                                                            @error('visi_misi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_luas_wilayah_{{ $about->id }}"
                                                                class="form-label">Luas Wilayah</label>
                                                            <input type="text"
                                                                class="form-control @error('luas_wilayah') is-invalid @enderror"
                                                                id="edit_luas_wilayah_{{ $about->id }}"
                                                                name="luas_wilayah"
                                                                value="{{ old('luas_wilayah', $about->luas_wilayah ?? '') }}"
                                                                required>
                                                            @error('luas_wilayah')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_jumlah_penduduk_{{ $about->id }}"
                                                                class="form-label">Jumlah Penduduk</label>
                                                            <input type="number"
                                                                class="form-control @error('jumlah_penduduk') is-invalid @enderror"
                                                                id="edit_jumlah_penduduk_{{ $about->id }}"
                                                                name="jumlah_penduduk"
                                                                value="{{ old('jumlah_penduduk', $about->jumlah_penduduk ?? '') }}"
                                                                required>
                                                            @error('jumlah_penduduk')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_jumlah_perangkat_desa_{{ $about->id }}"
                                                                class="form-label">Jumlah Perangkat Desa</label>
                                                            <input type="number"
                                                                class="form-control @error('jumlah_perangkat_desa') is-invalid @enderror"
                                                                id="edit_jumlah_perangkat_desa_{{ $about->id }}"
                                                                name="jumlah_perangkat_desa"
                                                                value="{{ old('jumlah_perangkat_desa', $about->jumlah_perangkat_desa ?? '') }}"
                                                                required>
                                                            @error('jumlah_perangkat_desa')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_media_file_{{ $about->id }}"
                                                                class="form-label">Media File (Gambar/Video)</label>
                                                            <input type="file"
                                                                class="form-control @error('media_file') is-invalid @enderror"
                                                                id="edit_media_file_{{ $about->id }}"
                                                                name="media_file" accept="image/*,video/*">
                                                            @error('media_file')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                            @if ($about->media_file)
                                                                <p class="mt-2">Media Saat Ini:</p>
                                                                @php
                                                                    $extension = pathinfo(
                                                                        $about->media_file,
                                                                        PATHINFO_EXTENSION,
                                                                    );
                                                                    $imageExtensions = [
                                                                        'jpg',
                                                                        'jpeg',
                                                                        'png',
                                                                        'gif',
                                                                        'svg',
                                                                    ];
                                                                    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                                                @endphp

                                                                @if (in_array($extension, $imageExtensions))
                                                                    <img src="{{ Storage::url($about->media_file) }}"
                                                                        alt="Media File Saat Ini"
                                                                        class="img-preview-modal">
                                                                @elseif (in_array($extension, $videoExtensions))
                                                                    <video controls class="video-preview-modal">
                                                                        <source
                                                                            src="{{ Storage::url($about->media_file) }}"
                                                                            type="video/{{ $extension }}">
                                                                        Browser Anda tidak mendukung video.
                                                                    </video>
                                                                @endif
                                                                <div class="form-check mt-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="remove_media_file"
                                                                        id="remove_media_file_{{ $about->id }}"
                                                                        value="1">
                                                                    <label class="form-check-label"
                                                                        for="remove_media_file_{{ $about->id }}">Hapus
                                                                        Media
                                                                        File</label>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_gambar_1_{{ $about->id }}"
                                                                class="form-label">Gambar 1</label>
                                                            <input type="file"
                                                                class="form-control @error('gambar_1') is-invalid @enderror"
                                                                id="edit_gambar_1_{{ $about->id }}" name="gambar_1"
                                                                accept="image/*">
                                                            @if ($about->gambar_1)
                                                                <img src="{{ Storage::url($about->gambar_1) }}"
                                                                    alt="Gambar 1 Saat Ini" class="img-preview-modal">
                                                            @endif
                                                            @error('gambar_1')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_gambar_2_{{ $about->id }}"
                                                                class="form-label">Gambar 2</label>
                                                            <input type="file"
                                                                class="form-control @error('gambar_2') is-invalid @enderror"
                                                                id="edit_gambar_2_{{ $about->id }}" name="gambar_2"
                                                                accept="image/*">
                                                            @if ($about->gambar_2)
                                                                <img src="{{ Storage::url($about->gambar_2) }}"
                                                                    alt="Gambar 2 Saat Ini" class="img-preview-modal">
                                                            @endif
                                                            @error('gambar_2')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ? Modal Edit -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($abouts->isEmpty())
                        <p class="text-center">Belum ada data About yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- ? Modal Tambah -->
        <div class="modal fade" id="TambahAbout" tabindex="-1" aria-labelledby="tambahAboutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahAboutLabel">Tambah Data Tentang Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahAboutForm" action="{{ route('abouts.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any() && (old('_token') && old('id_modal') == null))
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
                                <label for="tambah_kata_sambutan_kepala_desa" class="form-label">Kata Sambutan Kepala
                                    Desa</label>
                                <textarea class="form-control @error('kata_sambutan_kepala_desa') is-invalid @enderror"
                                    id="tambah_kata_sambutan_kepala_desa" name="kata_sambutan_kepala_desa" rows="4" required>{{ old('kata_sambutan_kepala_desa') }}</textarea>
                                @error('kata_sambutan_kepala_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_sejarah" class="form-label">Sejarah</label>
                                <textarea class="form-control @error('sejarah') is-invalid @enderror" id="tambah_sejarah" name="sejarah"
                                    rows="4" required>{{ old('sejarah') }}</textarea>
                                @error('sejarah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_visi_misi" class="form-label">Visi Misi</label>
                                <textarea class="form-control @error('visi_misi') is-invalid @enderror" id="tambah_visi_misi" name="visi_misi"
                                    rows="4" required>{{ old('visi_misi') }}</textarea>
                                @error('visi_misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_luas_wilayah" class="form-label">Luas Wilayah</label>
                                <input type="text" class="form-control @error('luas_wilayah') is-invalid @enderror"
                                    id="tambah_luas_wilayah" name="luas_wilayah" value="{{ old('luas_wilayah') }}"
                                    required>
                                @error('luas_wilayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                <input type="number" class="form-control @error('jumlah_penduduk') is-invalid @enderror"
                                    id="tambah_jumlah_penduduk" name="jumlah_penduduk"
                                    value="{{ old('jumlah_penduduk') }}" required>
                                @error('jumlah_penduduk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_jumlah_perangkat_desa" class="form-label">Jumlah Perangkat
                                    Desa</label>
                                <input type="number"
                                    class="form-control @error('jumlah_perangkat_desa') is-invalid @enderror"
                                    id="tambah_jumlah_perangkat_desa" name="jumlah_perangkat_desa"
                                    value="{{ old('jumlah_perangkat_desa') }}" required>
                                @error('jumlah_perangkat_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_media_file" class="form-label">Media File (Gambar/Video)</label>
                                <input type="file" class="form-control @error('media_file') is-invalid @enderror"
                                    id="tambah_media_file" name="media_file" accept="image/*,video/*" required>
                                @error('media_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_gambar_1" class="form-label">Gambar 1</label>
                                <input type="file" class="form-control @error('gambar_1') is-invalid @enderror"
                                    id="tambah_gambar_1" name="gambar_1" accept="image/*" required>
                                @error('gambar_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tambah_gambar_2" class="form-label">Gambar 2</label>
                                <input type="file" class="form-control @error('gambar_2') is-invalid @enderror"
                                    id="tambah_gambar_2" name="gambar_2" accept="image/*" required>
                                @error('gambar_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
        <!-- ? Modal Tambah -->

    </section>

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                const idModal = "{{ old('id_modal', '') }}";
                if (idModal) {
                    $('#editModal' + idModal).modal('show');
                } else {
                    $('#TambahAbout').modal('show');
                }
            });
        </script>
    @endif
@endsection --}}

@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')

    {{-- TinyMCE CDN (pastikan API KEY sudah benar) --}}
    <script src="https://cdn.tiny.cloud/1/pfv8vma5vquu02hd25mu4w9t01xoma7j1rffoz1em3egdr10/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        body,
        table,
        .modal,
        .btn {
            font-family: 'Cambria', serif;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Style untuk tabel vertikal */
        .table-vertical th {
            width: 30%;
            /* Alokasikan 30% lebar untuk kolom header */
            background-color: #f8f9fa;
            font-weight: 600;
            vertical-align: middle;
        }

        .table-vertical td {
            vertical-align: middle;
        }

        .img-thumbnail {
            max-width: 200px;
            /* Atur ukuran maksimum thumbnail agar tidak terlalu besar */
            height: auto;
            border-radius: 4px;
        }

        .video-thumbnail {
            max-width: 250px;
            height: auto;
            border-radius: 4px;
        }

        .img-preview-modal,
        .video-preview-modal {
            max-width: 150px;
            height: auto;
            border-radius: 4px;
            margin-top: 0.5rem;
        }

        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .section-item {
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            position: relative;
        }

        .remove-section-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 100;
            /* Pastikan tombol di atas elemen lain */
        }

        .section-item h6 {
            margin-bottom: 15px;
            color: #333;
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

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    @if ($abouts->isEmpty())
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahAbout">
                            <i class="bi bi-plus-circle"></i> Tambah Data
                        </button>
                    @endif
                </div>
            </div>

            {{-- Menggunakan @forelse untuk menangani kasus data kosong dengan rapi --}}
            @forelse ($abouts as $about)
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-center">
                        <h5 class="mb-0 fw-bold">Informasi Profil Desa</h5>
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-bordered table-striped table-vertical">
                            <tbody>
                                <tr>
                                    <th>Kata Sambutan Kepala Desa</th>
                                    <td>{!! $about->kata_sambutan_kepala_desa !!}</td>
                                </tr>
                                <tr>
                                    <th>Media File Utama</th> {{-- Sesuaikan label --}}
                                    <td>
                                        @if ($about->media_file)
                                            @php
                                                $extension = pathinfo($about->media_file, PATHINFO_EXTENSION);
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                            @endphp

                                            @if (in_array($extension, $imageExtensions))
                                                <img src="{{ Storage::url($about->media_file) }}" alt="Media File"
                                                    class="img-thumbnail">
                                            @elseif (in_array($extension, $videoExtensions))
                                                <video controls class="video-thumbnail">
                                                    <source src="{{ Storage::url($about->media_file) }}"
                                                        type="video/{{ $extension }}">
                                                    Browser Anda tidak mendukung video.
                                                </video>
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sejarah</th>
                                    <td>{!! $about->sejarah !!}</td>
                                </tr>
                                <tr>
                                    <th>Visi</th> {{-- Perbaikan: Menampilkan Visi terpisah --}}
                                    <td>{!! $about->visi !!}</td>
                                </tr>
                                <tr>
                                    <th>Misi</th> {{-- Perbaikan: Menampilkan Misi terpisah --}}
                                    <td>{!! $about->misi !!}</td>
                                </tr>

                                <tr>
                                    <th>Jumlah Penduduk</th>
                                    <td>{{ $about->jumlah_penduduk }}</td>
                                </tr>
                                <tr>
                                    <th>Luas Wilayah</th>
                                    <td>{{ $about->luas_wilayah }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Perangkat Desa</th>
                                    <td>{{ $about->jumlah_perangkat_desa }}</td>
                                </tr>
                                <tr>
                                    <th>Gambar 1</th>
                                    <td>
                                        @if ($about->gambar_1)
                                            <img src="{{ Storage::url($about->gambar_1) }}" alt="Gambar 1"
                                                class="img-thumbnail">
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gambar 2</th>
                                    <td>
                                        @if ($about->gambar_2)
                                            <img src="{{ Storage::url($about->gambar_2) }}" alt="Gambar 2"
                                                class="img-thumbnail">
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                {{-- Menampilkan Bagian Tambahan (Additional Sections) --}}
                                @if ($about->additionalSections->isNotEmpty())
                                    <tr>
                                        <th colspan="2" class="text-center bg-light">Bagian-bagian Tambahan</th>
                                    </tr>
                                    @foreach ($about->additionalSections as $section)
                                        <tr>
                                            <th>{{ $section->title }}</th>
                                            <td>
                                                <p>{!! $section->content !!}</p>
                                                @if ($section->media_file)
                                                    @php
                                                        $extension = pathinfo($section->media_file, PATHINFO_EXTENSION);
                                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                                        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                                    @endphp
                                                    @if (in_array($extension, $imageExtensions))
                                                        <img src="{{ Storage::url($section->media_file) }}"
                                                            alt="Media Bagian" class="img-thumbnail">
                                                    @elseif (in_array($extension, $videoExtensions))
                                                        <video controls class="video-thumbnail">
                                                            <source src="{{ Storage::url($section->media_file) }}"
                                                                type="video/{{ $extension }}">
                                                            Browser tidak mendukung video.
                                                        </video>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <th>Aksi</th>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $about->id }}">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('abouts.destroy', $about->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Semua bagian tambahan juga akan terhapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ? Modal Edit --}}
                <div class="modal fade" id="editModal{{ $about->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel{{ $about->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $about->id }}">Edit Data Tentang Desa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="editAboutForm{{ $about->id }}" action="{{ route('abouts.update', $about->id) }}"
                                method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_modal" value="{{ $about->id }}">

                                @if ($errors->any() && old('id_modal') == $about->id)
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
                                        <label for="edit_kata_sambutan_kepala_desa_{{ $about->id }}"
                                            class="form-label">Kata Sambutan Kepala Desa</label>
                                        <textarea class="form-control tinymce-main @error('kata_sambutan_kepala_desa') is-invalid @enderror"
                                            id="edit_kata_sambutan_kepala_desa_{{ $about->id }}" name="kata_sambutan_kepala_desa" rows="4"
                                            required>{{ old('kata_sambutan_kepala_desa', $about->kata_sambutan_kepala_desa ?? '') }}</textarea>
                                        @error('kata_sambutan_kepala_desa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_sejarah_{{ $about->id }}" class="form-label">Sejarah</label>
                                        <textarea class="form-control tinymce-main @error('sejarah') is-invalid @enderror" id="edit_sejarah_{{ $about->id }}"
                                            name="sejarah" rows="4" required>{{ old('sejarah', $about->sejarah ?? '') }}</textarea>
                                        @error('sejarah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_visi_{{ $about->id }}" class="form-label">Visi</label> {{-- Perbaikan: Label Visi --}}
                                        <textarea class="form-control @error('visi') is-invalid @enderror" id="edit_visi_{{ $about->id }}" name="visi"
                                            rows="4" required>{{ old('visi', $about->visi ?? '') }}</textarea>
                                        @error('visi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_misi_{{ $about->id }}" class="form-label">Misi</label> {{-- Perbaikan: Label Misi --}}
                                        <textarea class="form-control @error('misi') is-invalid @enderror" id="edit_misi_{{ $about->id }}" name="misi"
                                            rows="4" required>{{ old('misi', $about->misi ?? '') }}</textarea>
                                        @error('misi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_luas_wilayah_{{ $about->id }}" class="form-label">Luas
                                            Wilayah</label>
                                        <input type="text"
                                            class="form-control @error('luas_wilayah') is-invalid @enderror"
                                            id="edit_luas_wilayah_{{ $about->id }}" name="luas_wilayah"
                                            value="{{ old('luas_wilayah', $about->luas_wilayah ?? '') }}" required>
                                        @error('luas_wilayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_jumlah_penduduk_{{ $about->id }}"
                                            class="form-label">Jumlah Penduduk</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_penduduk') is-invalid @enderror"
                                            id="edit_jumlah_penduduk_{{ $about->id }}" name="jumlah_penduduk"
                                            value="{{ old('jumlah_penduduk', $about->jumlah_penduduk ?? '') }}" required>
                                        @error('jumlah_penduduk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_jumlah_perangkat_desa_{{ $about->id }}"
                                            class="form-label">Jumlah Perangkat Desa</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_perangkat_desa') is-invalid @enderror"
                                            id="edit_jumlah_perangkat_desa_{{ $about->id }}"
                                            name="jumlah_perangkat_desa"
                                            value="{{ old('jumlah_perangkat_desa', $about->jumlah_perangkat_desa ?? '') }}"
                                            required>
                                        @error('jumlah_perangkat_desa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_media_file_{{ $about->id }}" class="form-label">Media File
                                            (Gambar/Video)
                                        </label>
                                        <input type="file"
                                            class="form-control @error('media_file') is-invalid @enderror"
                                            id="edit_media_file_{{ $about->id }}" name="media_file"
                                            accept="image/*,video/*">
                                        @error('media_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if ($about->media_file)
                                            <p class="mt-2">Media Saat Ini:</p>
                                            @php
                                                $extension = pathinfo($about->media_file, PATHINFO_EXTENSION);
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                            @endphp

                                            @if (in_array($extension, $imageExtensions))
                                                <img src="{{ Storage::url($about->media_file) }}"
                                                    alt="Media File Saat Ini" class="img-preview-modal">
                                            @elseif (in_array($extension, $videoExtensions))
                                                <video controls class="video-preview-modal">
                                                    <source src="{{ Storage::url($about->media_file) }}"
                                                        type="video/{{ $extension }}">
                                                    Browser Anda tidak mendukung video.
                                                </video>
                                            @endif
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_media_file"
                                                    id="remove_media_file_{{ $about->id }}" value="1">
                                                <label class="form-check-label"
                                                    for="remove_media_file_{{ $about->id }}">Hapus
                                                    Media
                                                    File</label>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_gambar_1_{{ $about->id }}" class="form-label">Gambar
                                            1</label>
                                        <input type="file"
                                            class="form-control @error('gambar_1') is-invalid @enderror"
                                            id="edit_gambar_1_{{ $about->id }}" name="gambar_1" accept="image/*">
                                        @if ($about->gambar_1)
                                            <img src="{{ Storage::url($about->gambar_1) }}" alt="Gambar 1 Saat Ini"
                                                class="img-preview-modal">
                                        @endif
                                        @error('gambar_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_gambar_2_{{ $about->id }}" class="form-label">Gambar
                                            2</label>
                                        <input type="file"
                                            class="form-control @error('gambar_2') is-invalid @enderror"
                                            id="edit_gambar_2_{{ $about->id }}" name="gambar_2" accept="image/*">
                                        @if ($about->gambar_2)
                                            <img src="{{ Storage::url($about->gambar_2) }}" alt="Gambar 2 Saat Ini"
                                                class="img-preview-modal">
                                        @endif
                                        @error('gambar_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr>
                                    <h5>Bagian-bagian Tambahan yang Sudah Ada</h5>
                                    <div id="existing-sections-container-{{ $about->id }}">
                                        @foreach ($about->additionalSections as $section)
                                            <div class="section-item" data-section-id="{{ $section->id }}">
                                                <input type="hidden" name="existing_sections[{{ $loop->index }}][id]"
                                                    value="{{ $section->id }}">
                                                {{-- Tombol Hapus untuk existing section, akan set _destroy flag --}}
                                                <button type="button" class="btn btn-danger btn-sm remove-section-btn">
                                                    <i class="bi bi-x-circle"></i> Hapus
                                                </button>
                                                <input type="hidden"
                                                    name="existing_sections[{{ $loop->index }}][_destroy]"
                                                    class="destroy-flag" value="0">

                                                <h6>Bagian #<span class="section-number">{{ $loop->index + 1 }}</span>:
                                                    {{ $section->title }}</h6>

                                                <div class="mb-3">
                                                    <label
                                                        for="existing_section_title_{{ $about->id }}_{{ $section->id }}"
                                                        class="form-label">Judul Bagian</label>
                                                    <input type="text" class="form-control section-title-input"
                                                        id="existing_section_title_{{ $about->id }}_{{ $section->id }}"
                                                        name="existing_sections[{{ $loop->index }}][title]"
                                                        value="{{ old('existing_sections.' . $loop->index . '.title', $section->title) }}"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="existing_section_content_{{ $about->id }}_{{ $section->id }}"
                                                        class="form-label">Konten</label>
                                                    <textarea class="form-control tinymce-dynamic"
                                                        id="existing_section_content_{{ $about->id }}_{{ $section->id }}"
                                                        name="existing_sections[{{ $loop->index }}][content]" rows="5"
                                                        required>{{ old('existing_sections.' . $loop->index . '.content', $section->content) }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="existing_section_media_{{ $about->id }}_{{ $section->id }}"
                                                        class="form-label">Media File (Opsional)</label>
                                                    <input type="file" class="form-control section-media-input"
                                                        id="existing_section_media_{{ $about->id }}_{{ $section->id }}"
                                                        name="existing_sections[{{ $loop->index }}][media_file]"
                                                        accept="image/*,video/*">

                                                    <div class="media-preview-container mt-2">
                                                        @if ($section->media_file)
                                                            <p class="mt-2">Media Saat Ini:</p>
                                                            @php
                                                                $extension = pathinfo($section->media_file, PATHINFO_EXTENSION);
                                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                                            @endphp
                                                            @if (in_array($extension, $imageExtensions))
                                                                <img src="{{ Storage::url($section->media_file) }}"
                                                                    alt="Media" class="img-preview-modal">
                                                            @elseif (in_array($extension, $videoExtensions))
                                                                <video controls class="video-preview-modal">
                                                                    <source
                                                                        src="{{ Storage::url($section->media_file) }}"
                                                                        type="video/{{ $extension }}">
                                                                    Browser tidak mendukung video.
                                                                </video>
                                                            @endif
                                                            <div class="form-check mt-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="existing_sections[{{ $loop->index }}][remove_media_file]"
                                                                    id="remove_media_file_existing_{{ $about->id }}_{{ $section->id }}"
                                                                    value="1">
                                                                <label class="form-check-label"
                                                                    for="remove_media_file_existing_{{ $about->id }}_{{ $section->id }}">Hapus
                                                                    Media</label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Bagian untuk Menambah Bagian Tambahan Baru di Modal Edit --}}
                                    <div id="new-sections-container-edit-{{ $about->id }}">
                                        {{-- Tempat untuk meletakkan bagian tambahan baru --}}
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm mt-2"
                                        id="add-new-section-btn-edit-{{ $about->id }}">
                                        <i class="bi bi-plus-circle"></i> Tambah Bagian Baru
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan
                                        Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-sm">
                    <div class="card-body text-center p-4">
                        <p class="mb-0">Belum ada data Tentang Desa yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- ? Modal Tambah --}}
        <div class="modal fade" id="TambahAbout" tabindex="-1" aria-labelledby="tambahAboutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahAboutLabel">Tambah Data Tentang Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahAboutForm" action="{{ route('abouts.store') }}" method="POST"
                        enctype="multipart/form-data" novalidate> {{-- Perbaikan: novalidate --}}
                        @csrf

                        <input type="hidden" name="id_modal" value="tambah">

                        {{-- Menampilkan pesan error jika ada --}}
                        @if ($errors->any() && (old('_token') && old('id_modal') == 'tambah'))
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
                                <label for="tambah_kata_sambutan_kepala_desa" class="form-label">Kata Sambutan Kepala
                                    Desa</label>
                                <textarea class="form-control tinymce-main @error('kata_sambutan_kepala_desa') is-invalid @enderror"
                                    id="tambah_kata_sambutan_kepala_desa" name="kata_sambutan_kepala_desa" rows="4"
                                    required>{{ old('kata_sambutan_kepala_desa') }}</textarea>
                                @error('kata_sambutan_kepala_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_sejarah" class="form-label">Sejarah</label>
                                <textarea class="form-control tinymce-main @error('sejarah') is-invalid @enderror" id="tambah_sejarah" name="sejarah"
                                    rows="4" required>{{ old('sejarah') }}</textarea>
                                @error('sejarah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_visi" class="form-label">Visi</label> {{-- Perbaikan: Label Visi --}}
                                <textarea class="form-control @error('visi') is-invalid @enderror" id="tambah_visi" name="visi" rows="4"
                                    required>{{ old('visi') }}</textarea>
                                @error('visi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_misi" class="form-label">Misi</label> {{-- Perbaikan: Label Misi --}}
                                <textarea class="form-control @error('misi') is-invalid @enderror" id="tambah_misi" name="misi" rows="4"
                                    required>{{ old('misi') }}</textarea>
                                @error('misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_luas_wilayah" class="form-label">Luas Wilayah</label>
                                <input type="text" class="form-control @error('luas_wilayah') is-invalid @enderror"
                                    id="tambah_luas_wilayah" name="luas_wilayah" value="{{ old('luas_wilayah') }}"
                                    required>
                                @error('luas_wilayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_jumlah_penduduk" class="form-label">Jumlah Penduduk</label>
                                <input type="number" class="form-control @error('jumlah_penduduk') is-invalid @enderror"
                                    id="tambah_jumlah_penduduk" name="jumlah_penduduk"
                                    value="{{ old('jumlah_penduduk') }}" required>
                                @error('jumlah_penduduk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_jumlah_perangkat_desa" class="form-label">Jumlah Perangkat
                                    Desa</label>
                                <input type="number"
                                    class="form-control @error('jumlah_perangkat_desa') is-invalid @enderror"
                                    id="tambah_jumlah_perangkat_desa" name="jumlah_perangkat_desa"
                                    value="{{ old('jumlah_perangkat_desa') }}" required>
                                @error('jumlah_perangkat_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_media_file" class="form-label">Media File (Gambar/Video)</label>
                                <input type="file" class="form-control @error('media_file') is-invalid @enderror"
                                    id="tambah_media_file" name="media_file" accept="image/*,video/*" required>
                                @error('media_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_gambar_1" class="form-label">Gambar 1</label>
                                <input type="file" class="form-control @error('gambar_1') is-invalid @enderror"
                                    id="tambah_gambar_1" name="gambar_1" accept="image/*" required>
                                @error('gambar_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tambah_gambar_2" class="form-label">Gambar 2</label>
                                <input type="file" class="form-control @error('gambar_2') is-invalid @enderror"
                                    id="tambah_gambar_2" name="gambar_2" accept="image/*" required>
                                @error('gambar_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr>
                            <h5>Bagian-bagian Tambahan Baru</h5>
                            <div id="new-sections-container-add">
                                {{-- Tempat untuk meletakkan bagian tambahan yang baru --}}
                            </div>
                            <button type="button" class="btn btn-info btn-sm mt-2" id="add-new-section-btn-add">
                                <i class="bi bi-plus-circle"></i> Tambah Bagian Baru
                            </button>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Template untuk Bagian Tambahan Baru (Hidden) --}}
        <template id="new-section-template">
            <div class="section-item new-section-item">
                <button type="button" class="btn btn-danger btn-sm remove-section-btn"><i class="bi bi-x-circle"></i>
                    Hapus</button>
                <h6>Bagian #<span class="section-number"></span></h6>

                <div class="mb-3">
                    <label class="form-label">Judul Bagian</label>
                    <input type="text" class="form-control section-title-input" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea class="form-control tinymce-dynamic" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Media File (Opsional)</label>
                    <input type="file" class="form-control section-media-input" accept="image/*,video/*">
                    <div class="media-preview-container mt-2"></div>
                </div>
            </div>
        </template>
    </section>

    {{-- Script untuk memastikan modal terbuka jika ada error validasi --}}
    {{-- Dan juga inisialisasi TinyMCE untuk elemen dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menginisialisasi TinyMCE pada elemen textarea baru
            function initializeTinyMCE(selector) {
                // Hapus instance TinyMCE yang mungkin sudah ada di selector yang sama
                // Ini penting saat re-inisialisasi setelah DOM diubah atau modal dibuka kembali
                if (tinymce.get(selector.replace('#', ''))) { // Remove '#' from selector for TinyMCE.get
                    tinymce.get(selector.replace('#', '')).remove();
                }

                tinymce.init({
                    selector: selector,
                    plugins: 'lists link image code autoresize',
                    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
                    menubar: false,
                    setup: function(editor) {
                        editor.on('OpenWindow', function(e) {
                            var dialog = e.target.activeEditor.windowManager.get(e.detail.win);
                            if (dialog && dialog._modal) {
                                dialog._modal.el.classList.remove('tox-modal');
                                dialog._modal.el.classList.add('tox-modal-in-bootstrap');
                            }
                        });
                        // Ketika editor siap, atur kontennya jika ada old data
                        editor.on('init', function() {
                            const textarea = document.querySelector(selector);
                            if (textarea && textarea.dataset.oldContent) {
                                editor.setContent(textarea.dataset.oldContent);
                            }
                        });
                    }
                });
            }

            // --- Inisialisasi TinyMCE untuk field Visi dan Misi (utama) ---
            initializeTinyMCE('#tambah_kata_sambutan_kepala_desa'); // Tambah ini
            initializeTinyMCE('#tambah_sejarah'); // Tambah ini
            initializeTinyMCE('#tambah_visi');
            initializeTinyMCE('#tambah_misi');

            // @foreach ($abouts as $about)
            //     initializeTinyMCE('#edit_visi_{{ $about->id }}');
            //     initializeTinyMCE('#edit_misi_{{ $about->id }}');
            // @endforeach
            @if ($about) // Pastikan $about ada sebelum mencoba menginisialisasi untuk modal edit
                initializeTinyMCE('#edit_kata_sambutan_kepala_desa_{{ $about->id }}'); // Tambah ini
                initializeTinyMCE('#edit_sejarah_{{ $about->id }}'); // Tambah ini
                initializeTinyMCE('#edit_visi_{{ $about->id }}');
                initializeTinyMCE('#edit_misi_{{ $about->id }}');
            @endif

            // --- Logika untuk Menambah Bagian Tambahan Baru secara Dinamis ---
            // Fungsi untuk menambahkan satu section baru
            function addDynamicSection(containerElement, isEditModal = false, existingSectionData = null, existingLoopIndex = null) {
                const template = document.getElementById('new-section-template');
                if (!template) {
                    console.error('Template not found!');
                    return;
                }

                const clone = template.content.cloneNode(true);
                const sectionItem = clone.querySelector('.section-item');
                const sectionNumberSpan = sectionItem.querySelector('.section-number');
                const titleInput = sectionItem.querySelector('.section-title-input');
                const contentTextarea = sectionItem.querySelector('.tinymce-dynamic');
                const mediaInput = sectionItem.querySelector('.section-media-input');
                const mediaPreviewContainer = sectionItem.querySelector('.media-preview-container');
                const removeBtn = sectionItem.querySelector('.remove-section-btn');

                let currentIndex;
                let sectionPrefix;

                // Tentukan indeks berdasarkan apakah ini existing, old-error, atau benar-benar baru
                if (existingSectionData && existingSectionData.id) { // Existing section dari DB
                    currentIndex = existingLoopIndex;
                    sectionPrefix = `existing_sections[${currentIndex}]`;
                    sectionItem.dataset.sectionId = existingSectionData.id;
                    // Add hidden input for ID of existing section
                    const hiddenIdInput = document.createElement('input');
                    hiddenIdInput.type = 'hidden';
                    hiddenIdInput.name = `${sectionPrefix}[id]`;
                    hiddenIdInput.value = existingSectionData.id;
                    sectionItem.insertBefore(hiddenIdInput, sectionItem.firstChild);

                    // Add hidden destroy flag for existing sections
                    const destroyFlag = document.createElement('input');
                    destroyFlag.type = 'hidden';
                    destroyFlag.name = `${sectionPrefix}[_destroy]`;
                    destroyFlag.className = 'destroy-flag';
                    destroyFlag.value = '0';
                    sectionItem.insertBefore(destroyFlag, sectionItem.firstChild);

                } else { // New section (freshly added or re-populated from old input error)
                    currentIndex = containerElement.querySelectorAll('.section-item').length; // Hitung elemen yang sudah ada
                    sectionPrefix = `new_sections[${currentIndex}]`;
                    sectionItem.dataset.sectionId = `new-${currentIndex}`;
                }

                sectionNumberSpan.textContent = currentIndex + 1; // Update angka bagian

                // Set unique names and IDs for inputs
                titleInput.name = `${sectionPrefix}[title]`;
                titleInput.id = `section_${currentIndex}_title`;
                titleInput.value = existingSectionData ? existingSectionData.title : '';

                contentTextarea.name = `${sectionPrefix}[content]`;
                contentTextarea.id = `section_${currentIndex}_content`;
                contentTextarea.dataset.oldContent = existingSectionData ? existingSectionData.content : ''; // Simpan konten di dataset untuk TinyMCE

                mediaInput.name = `${sectionPrefix}[media_file]`;
                mediaInput.id = `section_${currentIndex}_media_file`;

                // Initialize TinyMCE for the new textarea AFTER it's in the DOM
                containerElement.appendChild(sectionItem); // Tambahkan dulu ke DOM
                initializeTinyMCE(`#${contentTextarea.id}`);

                // Populate media preview for existing sections
                if (existingSectionData && existingSectionData.media_file) {
                    const existingMediaUrl = `{{ Storage::url('') }}/${existingSectionData.media_file}`;
                    const fileExtension = existingSectionData.media_file.split('.').pop().toLowerCase();
                    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                    const videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];

                    let mediaElement;
                    if (imageExtensions.includes(fileExtension)) {
                        mediaElement = document.createElement('img');
                        mediaElement.src = existingMediaUrl;
                        mediaElement.classList.add('img-preview-modal');
                    } else if (videoExtensions.includes(fileExtension)) {
                        mediaElement = document.createElement('video');
                        mediaElement.controls = true;
                        mediaElement.src = existingMediaUrl;
                        mediaElement.classList.add('video-preview-modal');
                    }
                    if (mediaElement) {
                        mediaPreviewContainer.innerHTML = '<p class="mt-2">Media Saat Ini:</p>';
                        mediaPreviewContainer.appendChild(mediaElement);

                        // Add checkbox to remove existing media
                        const removeCheckboxDiv = document.createElement('div');
                        removeCheckboxDiv.classList.add('form-check', 'mt-2');
                        removeCheckboxDiv.innerHTML = `
                            <input class="form-check-input" type="checkbox"
                                name="${sectionPrefix}[remove_media_file]"
                                id="remove_media_file_${sectionItem.dataset.sectionId}" value="1">
                            <label class="form-check-label" for="remove_media_file_${sectionItem.dataset.sectionId}">Hapus Media</label>
                        `;
                        mediaPreviewContainer.appendChild(removeCheckboxDiv);
                    }
                }

                // Add event listener for media preview for newly selected files
                mediaInput.addEventListener('change', function() {
                    mediaPreviewContainer.innerHTML = ''; // Clear previous preview
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const fileType = file.type.split('/')[0];

                        if (fileType === 'image') {
                            const img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.classList.add('img-preview-modal');
                            mediaPreviewContainer.appendChild(img);
                        } else if (fileType === 'video') {
                            const video = document.createElement('video');
                            video.controls = true;
                            video.src = URL.createObjectURL(file);
                            video.classList.add('video-preview-modal');
                            mediaPreviewContainer.appendChild(video);
                        }
                    }
                });

                // Add event listener for remove button
                removeBtn.addEventListener('click', function() {
                    const sectionId = sectionItem.dataset.sectionId;
                    const editor = tinymce.get(contentTextarea.id);
                    if (editor) {
                        editor.remove(); // Destroy TinyMCE instance
                    }

                    if (isEditModal && !sectionId.startsWith('new-')) { // Existing section from DB
                        const destroyFlag = sectionItem.querySelector('.destroy-flag');
                        if (destroyFlag) {
                            destroyFlag.value = '1';
                        }
                        sectionItem.style.display = 'none'; // Sembunyikan
                        sectionItem.classList.add('marked-for-delete');
                    } else { // New section (either from Add modal or newly added in Edit modal)
                        sectionItem.remove(); // Hapus dari DOM
                    }
                    updateSectionNumbers(containerElement.id); // Perbarui nomor
                });
            }

            // Fungsi untuk memperbarui angka bagian
            function updateSectionNumbers(containerId) {
                let currentNumber = 1;
                document.getElementById(containerId).querySelectorAll('.section-item:not(.marked-for-delete)')
                    .forEach(function(item) {
                        const sectionNumberSpan = item.querySelector('.section-number');
                        if (sectionNumberSpan) {
                            sectionNumberSpan.textContent = currentNumber;
                            currentNumber++;
                        }
                    });
            }

            // Listener untuk tombol "Tambah Bagian Baru" di modal Tambah
            document.getElementById('add-new-section-btn-add').addEventListener('click', function() {
                addDynamicSection(document.getElementById('new-sections-container-add'), false);
            });

            // Listener untuk tombol "Tambah Bagian Baru" di modal Edit (dalam loop)
            @foreach ($abouts as $about)
                document.getElementById('add-new-section-btn-edit-{{ $about->id }}').addEventListener('click',
                    function() {
                        addDynamicSection(document.getElementById('new-sections-container-edit-{{ $about->id }}'), true);
                    });
            @endforeach

            // --- Logika untuk memastikan modal terbuka jika ada error validasi ---
            const errorModalId = "{{ old('id_modal', '') }}";
            if (errorModalId) {
                if (errorModalId !== 'tambah') { // Untuk modal edit
                    const aboutId = errorModalId;
                    $('#editModal' + aboutId).modal('show');

                    // Re-inisialisasi TinyMCE untuk existing sections
                    document.querySelectorAll(`#editModal${aboutId} .tinymce-dynamic`).forEach(function(textarea) {
                        initializeTinyMCE('#' + textarea.id);
                    });

                    // Re-populate new sections that were added before validation error
                    const newSectionsOld = {!! json_encode(old('new_sections', [])) !!};
                    newSectionsOld.forEach((sectionData, index) => {
                        // Pastikan hanya tambahkan jika ada data yang diisi sebelumnya untuk menghindari bagian kosong
                        if (sectionData.title || sectionData.content || (sectionData.media_file && sectionData.media_file.name)) {
                            addDynamicSection(document.getElementById(`new-sections-container-edit-${aboutId}`), true, sectionData);
                            // Mengatur ulang konten TinyMCE harus setelah editor siap
                            const latestAddedTextareaId = `section_${document.getElementById(`new-sections-container-edit-${aboutId}`).querySelectorAll('.section-item').length - 1}_content`;
                            tinymce.get(latestAddedTextareaId).setContent(sectionData.content || '');
                        }
                    });

                } else { // Untuk modal tambah
                    $('#TambahAbout').modal('show');

                    // Re-inisialisasi TinyMCE untuk main fields
                    initializeTinyMCE('#tambah_visi');
                    initializeTinyMCE('#tambah_misi');

                    // Re-inisialisasi TinyMCE untuk new sections
                    document.querySelectorAll(`#TambahAbout .tinymce-dynamic`).forEach(function(textarea) {
                        initializeTinyMCE('#' + textarea.id);
                    });

                    const newSectionsOld = {!! json_encode(old('new_sections', [])) !!};
                    newSectionsOld.forEach((sectionData, index) => {
                         if (sectionData.title || sectionData.content || (sectionData.media_file && sectionData.media_file.name)) {
                            addDynamicSection(document.getElementById('new-sections-container-add'), false, sectionData);
                            const latestAddedTextareaId = `section_${document.getElementById('new-sections-container-add').querySelectorAll('.section-item').length - 1}_content`;
                            tinymce.get(latestAddedTextareaId).setContent(sectionData.content || '');
                        }
                    });
                }
            }

            // Ini dibutuhkan agar TinyMCE editor bisa difokuskan jika ada error validasi
            // dan juga agar form HTML5 validation tidak mencoba fokus pada textarea yang disembunyikan
            // Tambahkan 'novalidate' ke setiap form yang menggunakan TinyMCE
            document.querySelectorAll('form[id^="editAboutForm"], form[id="tambahAboutForm"]').forEach(form => {
                form.setAttribute('novalidate', '');
            });
        });
    </script>
@endsection
