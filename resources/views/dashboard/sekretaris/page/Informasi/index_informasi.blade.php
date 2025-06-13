@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <style>
        /* PERBAIKAN CSS: Paksa background modal content menjadi solid */
        .modal-content {
            background-color: #ffffff !important;
        }

        body {
            font-family: 'Cambria', serif;
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

        .modal-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        textarea.form-control {
            min-height: 150px;
        }

        .table .attachment-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
            border-radius: 4px;
            background-color: #f8f9fa;
        }

        .table .attachment-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .table .attachment-preview .fa-file-pdf {
            color: #dc3545;
        }

        .table .attachment-preview .fa-file-word {
            color: #0d6efd;
        }

        .table .attachment-preview .fa-file-alt {
            color: #6c757d;
        }
    </style>

    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <section id="informasi-desa" class="informasi-desa section mt-5 pt-4">
        <div class="container">
            <h2 class="mb-4">Informasi Desa</h2>
            <p class="text-muted">Kelola data informasi dan pengumuman desa.</p>

            {{-- <ul class="nav nav-tabs justify-content-start mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_sekretaris') ? 'active' : '' }}"
                        href="{{ route('informasi.berita') }}"> Berita </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_pengumuman') ? 'active' : '' }}"
                        href="{{ route('informasi.pengumuman') }}"> Pengumuman </a>
                </li>
            </ul> --}}

            <div class="mb-3">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <i class="fas fa-plus-circle"></i> Tambah Informasi
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Informasi</th>
                            {{-- <th scope="col">Kategori</th> --}}
                            <th scope="col">Deskripsi</th>
                            <th scope="col" class="text-center">Lampiran</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($berita as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->judul_informasi }}</td>
                                {{-- <td>{{ $item->kategori_informasi }}</td> --}}
                                <td>{!! Str::limit(strip_tags($item->deskripsi_informasi), 100) !!}</td>
                                <td class="text-center">
                                    @if ($item->lampiran_informasi)
                                        @php
                                            $path = 'storage/' . $item->lampiran_informasi;
                                            $extension = pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION);
                                        @endphp
                                        <a href="{{ asset($path) }}" target="_blank" class="attachment-preview">
                                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($path) }}" alt="Lampiran">
                                            @elseif(strtolower($extension) === 'pdf')
                                                <i class="far fa-file-pdf"></i>
                                            @elseif(in_array(strtolower($extension), ['doc', 'docx']))
                                                <i class="far fa-file-word"></i>
                                            @else
                                                <i class="far fa-file-alt"></i>
                                            @endif
                                        </a>
                                    @else
                                        <span class="text-muted small">Tidak Ada</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    @if ($item->status_informasi == 'publish')
                                        <span class="badge bg-success">Publish</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id_informasi }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('sekretaris.informasi.destroy', $item->id_informasi) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- PERBAIKAN STRUKTUR HTML MODAL --}}
                            <div class="modal fade" id="editModal{{ $item->id_informasi }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content"> {{-- <-- .modal-content kembali ke div --}}
                                        <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id_informasi }}">Edit
                                                    Data Informasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="judul_informasi_{{ $item->id_informasi }}"
                                                        class="form-label">Judul Informasi</label>
                                                    <input type="text" class="form-control"
                                                        id="judul_informasi_{{ $item->id_informasi }}"
                                                        name="judul_informasi" value="{{ $item->judul_informasi }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lampiran_informasi_{{ $item->id_informasi }}"
                                                        class="form-label">Ganti Lampiran (Opsional)</label><br>
                                                    @if ($item->lampiran_informasi)
                                                        <p class="text-muted small">File sebelumnya:
                                                            <a href="{{ asset('storage/' . $item->lampiran_informasi) }}"
                                                                target="_blank">
                                                                {{ basename($item->lampiran_informasi) }}
                                                            </a>
                                                        </p>
                                                    @endif
                                                    <input type="file" class="form-control"
                                                        id="lampiran_informasi_{{ $item->id_informasi }}"
                                                        name="lampiran_informasi">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi_informasi_edit_{{ $item->id_informasi }}"
                                                        class="form-label">Deskripsi Informasi</label>
                                                    <textarea name="deskripsi_informasi" id="deskripsi_informasi_edit_{{ $item->id_informasi }}"
                                                        class="form-control editable-textarea" rows="5">{{ $item->deskripsi_informasi }}</textarea>
                                                </div>
                                                {{-- <div class="mb-3">
                                                    <label class="form-label">Kategori Informasi</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="berita_edit_{{ $item->id_informasi }}"
                                                            name="kategori_informasi" value="Berita"
                                                            {{ $item->kategori_informasi == 'Berita' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label"
                                                            for="berita_edit_{{ $item->id_informasi }}">Berita</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="pengumuman_edit_{{ $item->id_informasi }}"
                                                            name="kategori_informasi" value="Pengumuman"
                                                            {{ $item->kategori_informasi == 'Pengumuman' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label"
                                                            for="pengumuman_edit_{{ $item->id_informasi }}">Pengumuman</label>
                                                    </div>
                                                </div> --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Status Informasi</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="draft_edit_{{ $item->id_informasi }}"
                                                            name="status_informasi" value="draft"
                                                            {{ $item->status_informasi == 'draft' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="draft_edit_{{ $item->id_informasi }}">Draft</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            id="publish_edit_{{ $item->id_informasi }}"
                                                            name="status_informasi" value="publish"
                                                            {{ $item->status_informasi == 'publish' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="publish_edit_{{ $item->id_informasi }}">Publish</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form> {{-- <-- Tag form ditutup di sini --}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data informasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Informasi Baru
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <form action="{{ route('sekretaris.informasi.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="modal-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops! Terjadi kesalahan.</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">

                                <label for="judul_informasi_new" class="form-label">Judul
                                    Informasi</label>

                                <input type="text" class="form-control" id="judul_informasi_new"
                                    name="judul_informasi" required>

                            </div>

                            <div class="mb-3">

                                <label for="lampiran_informasi_new" class="form-label">Lampiran Informasi</label>

                                <input type="file" class="form-control" id="lampiran_informasi_new"
                                    name="lampiran_informasi">

                            </div>

                            <div class="mb-3">

                                <label for="deskripsi_informasi_new" class="form-label">Deskripsi Informasi</label>


                                <textarea name="deskripsi_informasi" id="deskripsi_informasi_new" class="form-control editable-textarea"
                                    rows="5"></textarea>


                            </div>

                            {{-- <div class="mb-3">

                                <label class="form-label">Kategori Informasi</label><br>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" id="berita_new"
                                        name="kategori_informasi" value="Berita" checked required>

                                    <label class="form-check-label" for="berita_new">Berita</label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" id="pengumuman_new"
                                        name="kategori_informasi" value="Pengumuman" required>

                                    <label class="form-check-label" for="pengumuman_new">Pengumuman</label>

                                </div>

                            </div> --}}

                            <div class="mb-3">

                                <label class="form-label">Status Informasi</label><br>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" id="draft_new"
                                        name="status_informasi" value="draft">

                                    <label class="form-check-label" for="draft_new">Draft</label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input class="form-check-input" type="radio" id="publish_new"
                                        name="status_informasi" value="publish" checked>

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

        </div>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const initTinyMCE = (selector) => {
                    tinymce.init({
                        selector: selector,
                        plugins: 'code table lists',
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                    });
                };

                const tambahModal = document.getElementById('tambahModal');
                if (tambahModal) {
                    tambahModal.addEventListener('shown.bs.modal', function() {
                        tinymce.remove('#deskripsi_informasi_new');
                        initTinyMCE('#deskripsi_informasi_new');
                    });
                }

                // PERBAIKAN JS: Hapus .fade dari selector
                const editModals = document.querySelectorAll('.modal[id^="editModal"]');
                editModals.forEach(modal => {
                    modal.addEventListener('shown.bs.modal', event => {
                        const textarea = modal.querySelector('.editable-textarea');
                        if (textarea) {
                            const textareaId = '#' + textarea.id;
                            tinymce.remove(textareaId);
                            initTinyMCE(textareaId);
                        }
                    });
                });

                document.addEventListener('hidden.bs.modal', event => {
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    if (backdrops.length > 0) {
                        backdrops.forEach(backdrop => {
                            backdrop.parentNode.removeChild(backdrop);
                        });
                    }
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                });

            });
        </script>
    @endpush
