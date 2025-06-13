@extends('pengguna.main')

@section(section: 'content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('pengguna.component.navbar')
    </header>

    <div class="page-title dark-background no-print"
        style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative">
            <h1>Informasi</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="blog-pagination" class="blog-pagination section mt-5 no-print">
        <div class="container">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('informasi.masyarakat') ? 'active' : '' }}"
                        href="{{ route('informasi.masyarakat') }}"> Berita </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pengumuman.masyarakat') ? 'active' : '' }}"
                        href="{{ route('pengumuman.masyarakat') }}"> Pengumuman </a>
                </li>
            </ul>
        </div>
    </section>

    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4">
                @if ($pengumuman_masyarakat->isEmpty())
                    <div class="col-12">
                        <p class="text-center">Belum ada pengumuman yang tersedia.</p>
                    </div>
                @else
                    @foreach ($pengumuman_masyarakat as $item)
                        @php
                            $lampiranAda = !empty($item->lampiran_informasi);
                            $fileUrl = null;
                            $fileName = null;
                            $fileExtension = null;

                            if ($lampiranAda) {
                                $fileUrl = asset('storage/' . $item->lampiran_informasi);
                                $fileName = basename($item->lampiran_informasi);
                                $fileExtension = strtolower(pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION));
                            }
                        @endphp
                        <div class="col-lg-4">
                            <article class="position-relative h-100 d-flex flex-column"
                                id="printable-item-{{ $item->id_informasi }}">

                                <div class="post-img position-relative overflow-hidden"
                                    style="background-color: #4a4a4a; min-height: 280px; display: flex; align-items: center; justify-content: center; padding: 10px;">
                                    @if ($lampiranAda)
                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <img src="{{ $fileUrl }}" class="img-fluid" alt="Gambar Pengumuman"
                                                style="max-height: 260px; object-fit: contain;">
                                        @elseif($fileExtension === 'pdf')
                                            <div
                                                style="width: 95%; height: 240px; background-color: #fff; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.3);">
                                                <iframe src="{{ $fileUrl }}#toolbar=0&navpanes=0&scrollbar=0&view=FitH"
                                                    width="100%" height="100%" style="border: none;" frameborder="0"
                                                    title="Preview PDF: {{ $item->judul_informasi }}">
                                                    <p class="p-3 text-center">Browser Anda tidak mendukung iframe. <a
                                                            href="{{ $fileUrl }}" target="_blank">Unduh PDF</a>.</p>
                                                </iframe>
                                            </div>
                                        @elseif(in_array($fileExtension, ['doc', 'docx']))
                                            <div class="text-center p-3">
                                                <a href="{{ $fileUrl }}" target="_blank"
                                                    style="text-decoration: none; color: #fff;">
                                                    <img src="{{ asset('assets/img/icon/word-icon.png') }}"
                                                        alt="Ikon Dokumen Word" style="height:70px; margin-bottom: 10px;">
                                                    <p style="margin-bottom:0;">Lihat Dokumen Word</p>
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-center p-3">
                                                <a href="{{ $fileUrl }}" target="_blank"
                                                    class="btn btn-outline-light btn-sm">
                                                    Lihat Lampiran ({{ strtoupper($fileExtension) }})
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/img/default-placeholder.png') }}" class="img-fluid"
                                            alt="Tidak ada lampiran" style="max-height: 260px; object-fit: cover;">
                                    @endif

                                    <span class="post-date"
                                        style="position: absolute; bottom: 15px; right: 15px; background-color: #FFC107; color: #333; padding: 4px 8px; font-size: 0.75rem; border-radius: 3px; font-weight: bold;">
                                        {{ $item->created_at->format('F d') }} {{-- Sesuai contoh gambar "JUNE 03" --}}
                                    </span>
                                </div>

                                <div class="post-content d-flex flex-column flex-grow-1 p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h3 class="post-title flex-grow-1 mb-0 me-2" style="word-break: break-word;">
                                            {{ $item->judul_informasi }}</h3>
                                        @if ($lampiranAda)
                                            <a href="{{ $fileUrl }}" download="{{ $fileName }}"
                                                class="btn btn-sm btn-success flex-shrink-0" title="Unduh Lampiran">
                                                <i class="fas fa-download"></i> Unduh File
                                            </a>
                                        @endif
                                    </div>

                                    <p class="mb-0 flex-grow-1">
                                        {{ $item->deskripsi_informasi }}
                                    </p>

                                </div>
                            </article>
                        </div>
                        <div class="modal fade no-print" id="editModal{{ $item->id_informasi }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}"
                                    method="POST" enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id_informasi }}">Edit
                                            Pengumuman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul_informasi_edit_{{ $item->id_informasi }}"
                                                class="form-label">Judul Pengumuman</label>
                                            <input type="text" class="form-control"
                                                id="judul_informasi_edit_{{ $item->id_informasi }}" name="judul_informasi"
                                                value="{{ old('judul_informasi', $item->judul_informasi) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi_informasi_edit_{{ $item->id_informasi }}"
                                                class="form-label">Deskripsi Pengumuman</label>
                                            <textarea name="deskripsi_informasi" id="deskripsi_informasi_edit_{{ $item->id_informasi }}" class="form-control"
                                                rows="5" required>{{ old('deskripsi_informasi', $item->deskripsi_informasi) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lampiran_informasi_edit_{{ $item->id_informasi }}"
                                                class="form-label">Ganti Lampiran (Opsional)</label>
                                            @if ($item->lampiran_informasi)
                                                <p class="text-muted small mb-1">File saat ini: <a
                                                        href="{{ $fileUrl }}"
                                                        target="_blank">{{ $fileName }}</a></p>
                                            @endif
                                            <input type="file" class="form-control"
                                                id="lampiran_informasi_edit_{{ $item->id_informasi }}"
                                                name="lampiran_informasi">
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti
                                                lampiran. Format yang didukung: JPG, PNG, GIF, PDF, DOC, DOCX. Maks:
                                                2MB.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label d-block">Kategori Informasi</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="kategori_berita_edit_{{ $item->id_informasi }}"
                                                    name="kategori_informasi" value="Berita"
                                                    {{ old('kategori_informasi', $item->kategori_informasi) == 'Berita' ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label"
                                                    for="kategori_berita_edit_{{ $item->id_informasi }}">Berita</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="kategori_pengumuman_edit_{{ $item->id_informasi }}"
                                                    name="kategori_informasi" value="Pengumuman"
                                                    {{ old('kategori_informasi', $item->kategori_informasi) == 'Pengumuman' ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label"
                                                    for="kategori_pengumuman_edit_{{ $item->id_informasi }}">Pengumuman</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label d-block">Status Informasi</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="status_draft_edit_{{ $item->id_informasi }}"
                                                    name="status_informasi" value="0"
                                                    {{ old('status_informasi', (string) $item->status_informasi) === '0' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="status_draft_edit_{{ $item->id_informasi }}">Draft</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    id="status_publish_edit_{{ $item->id_informasi }}"
                                                    name="status_informasi" value="1"
                                                    {{ old('status_informasi', (string) $item->status_informasi) === '1' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="status_publish_edit_{{ $item->id_informasi }}">Publish</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="modal fade no-print" id="TambahGambar" tabindex="-1" aria-labelledby="TambahGambarLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahGambarLabel">Tambah Informasi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('sekretaris.informasi.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul_informasi_tambah" class="form-label">Judul Informasi</label>
                                <input type="text" class="form-control" id="judul_informasi_tambah"
                                    name="judul_informasi" value="{{ old('judul_informasi') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_informasi_tambah" class="form-label">Deskripsi Informasi</label>
                                <textarea name="deskripsi_informasi" id="deskripsi_informasi_tambah" class="form-control" rows="5" required>{{ old('deskripsi_informasi') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="lampiran_informasi_tambah" class="form-label">Lampiran Informasi</label>
                                <input type="file" class="form-control" id="lampiran_informasi_tambah"
                                    name="lampiran_informasi" required>
                                <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF, PDF, DOC, DOCX.
                                    Maks: 2MB.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Kategori Informasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="kategori_berita_tambah"
                                        name="kategori_informasi" value="Berita"
                                        {{ old('kategori_informasi') == 'Berita' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="kategori_berita_tambah">Berita</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="kategori_pengumuman_tambah"
                                        name="kategori_informasi" value="Pengumuman"
                                        {{ old('kategori_informasi', 'Pengumuman') == 'Pengumuman' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="kategori_pengumuman_tambah">Pengumuman</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block">Status Informasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="status_draft_tambah"
                                        name="status_informasi" value="0"
                                        {{ old('status_informasi', '0') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_draft_tambah">Draft</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="status_publish_tambah"
                                        name="status_informasi" value="1"
                                        {{ old('status_informasi') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_publish_tambah">Publish</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer" class="footer dark-background no-print">
        @include('dashboard.masyarakat.component.footer') {{-- Pastikan path footer ini benar --}}
    </footer>

@endsection

@push('scripts')
    <script>
        function printSpecificInformasi(itemId) {
            // Hapus class 'print-this' dari semua artikel jika ada
            document.querySelectorAll('article.print-this').forEach(function(el) {
                el.classList.remove('print-this');
            });

            // Tambahkan class 'print-this' ke artikel yang akan dicetak
            const itemToPrint = document.getElementById('printable-item-' + itemId); // Sesuaikan ID target
            if (itemToPrint) {
                itemToPrint.classList.add('print-this');
                window.print(); // Panggil dialog cetak browser
            }
        }

        // Opsional: Membersihkan class setelah mencetak
        function handleAfterPrint() {
            document.querySelectorAll('article.print-this').forEach(function(el) {
                el.classList.remove('print-this');
            });
        }

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (!mql.matches) { // After print
                    handleAfterPrint();
                }
            });
        } else { // Fallback
            window.onafterprint = handleAfterPrint;
        }
    </script>
@endpush

@push('styles')
    <style>
        @media print {
            body {
                font-family: 'Times New Roman', Times, serif;
                color: #000;
                background-color: #fff !important;
                /* Pastikan latar belakang putih saat cetak */
            }

            body>*:not(#blog-posts),
            /* Sembunyikan semua anak langsung body kecuali section blog-posts */
            .no-print,
            header,
            footer,
            .page-title,
            #blog-pagination,
            .nav,
            /* Ini akan menyembunyikan tab Berita/Pengumuman */
            .breadcrumbs,
            .modal,
            .modal-backdrop {
                display: none !important;
                visibility: hidden !important;
            }

            #blog-posts {
                margin-top: 0 !important;
                padding-top: 0 !important;
                background-color: #fff !important;
            }

            #blog-posts .container,
            #blog-posts .row {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                display: block !important;
            }

            #blog-posts .col-lg-4 {
                display: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            #blog-posts article.print-this {
                display: block !important;
                visibility: visible !important;
                width: 100% !important;
                page-break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                /* Tambahkan border tipis untuk memisahkan dari konten lain jika ada */
                margin: 0 auto 20px auto !important;
                /* Beri margin bawah jika ada beberapa item dicetak (meskipun idealnya satu per halaman) */
                padding: 20px !important;
                height: auto !important;
                background-color: #fff !important;
            }

            article.print-this .post-img {
                background-color: #f0f0f0 !important;
                /* Latar belakang lebih terang untuk area gambar saat cetak */
                min-height: auto !important;
                /* Biarkan konten menentukan tinggi saat cetak */
                padding: 10px !important;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }

            article.print-this .post-img img,
            article.print-this .post-img iframe {
                max-width: 100% !important;
                max-height: 300px !important;
                /* Batasi tinggi preview dokumen/gambar di cetakan */
                height: auto !important;
                display: block;
                margin-left: auto;
                margin-right: auto;
                border: 1px solid #ccc;
            }

            article.print-this .post-img iframe {
                /* Pastikan iframe juga terlihat di cetakan jika itu previewnya */
                background-color: #fff;
            }

            article.print-this .post-content {
                margin-top: 10px;
            }

            article.print-this .post-title {
                font-size: 16pt !important;
                text-align: left;
                /* Atau center jika preferensi */
                margin-bottom: 10px;
                font-weight: bold;
            }

            article.print-this p {
                font-size: 11pt !important;
                line-height: 1.5 !important;
                text-align: justify;
                orphans: 3;
                widows: 3;
            }

            article.print-this .post-date {
                /* Tanggal overlay */
                font-size: 9pt !important;
                text-align: right;
                margin-top: 15px;
                margin-bottom: 0;
                font-style: italic;
                /* Untuk cetak, overlay mungkin tidak ideal, pertimbangkan menampilkannya secara inline */
                position: static !important;
                /* Hapus absolute positioning saat cetak */
                background-color: transparent !important;
                color: #555 !important;
                padding: 0 !important;
                float: right;
                /* Coba float agar tetap di kanan atas konten teks */
            }

            article.print-this .no-print-within,
            article.print-this .btn,
            /* Sembunyikan semua tombol */
            article.print-this button,
            article.print-this a[onclick] {
                display: none !important;
                visibility: hidden !important;
            }
        }
    </style>
@endpush
