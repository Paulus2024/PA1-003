@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.masyarakat.component.navbar')

        <link rel="stylesheet" href="{{ asset('assets/css/fixed.css') }}">
        <!-- di head layout utama -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    </header>

    <!--Open Page Title-->
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative">
            <h1>Histori Pemesanan Alat</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.masyarakat">Home</a></li>
                    <li class="current">Histori Pemesanan</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <main class="p-4">
        <!-- Projects Section -->
        <section id="projects" class="projects section">
            <div class="container">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Alat</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Jumlah Alat Di Sewa</th>
                            <th>Status</th>
                            <th>Kontrol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $p)
                            <tr>
                                <td>{{ $p->alat->nama_alat_pertanian }}</td>
                                <td>{{ $p->nama_peminjam }}</td>
                                <td>{{ $p->tanggal_pinjam }}</td>
                                <td>{{ $p->tanggal_kembali }}</td>
                                <td>{{ $p->jumlah_alat_di_sewa }}</td>
                                {{-- <td>{{ $p->alat->status_alat }}</td> --}}
                                <td>{{ ucfirst($p->status_peminjaman) }}</td>

                                <td>
                                    @if ($p->status_peminjaman == 'menunggu')
                                        <div class="d-flex gap-2">
                                            <!-- Form Action Untuk Cancle -->
                                            <form action="{{ route('peminjaman.cancel', $p->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger">Batalkan</button>
                                            </form>

                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSewa{{ $p->alat_pertanian_id }}">
                                                    Edit
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                {{-- Di dalam loop @foreach ($peminjaman as $p) --}}
                                <td class="action-buttons">
                                    {{-- Tombol lain yang mungkin sudah ada (misal: batal jika status 'menunggu') --}}

                                    {{-- TOMBOL AJUKAN PENGEMBALIAN --}}
                                    @if (
                                        ($p->status_peminjaman == 'disetujui' || $p->status_peminjaman == 'dipinjam') /* Dipinjam atau sudah disetujui */ &&
                                            ($p->status_pengembalian == null ||
                                                $p->status_pengembalian == 'ditolak') /* Belum pernah ajukan kembali ATAU pengajuan sebelumnya ditolak */)
                                        <a href="{{ route('masyarakat.pengembalian.form', $p->id) }}"
                                            class="btn btn-warning btn-sm" title="Ajukan Pengembalian Alat Ini">
                                            <i class="bi bi-arrow-return-left"></i> Kembalikan
                                        </a>
                                    @elseif($p->status_pengembalian == 'menunggu_verifikasi')
                                        <a href="{{ route('masyarakat.pengembalian.form', $p->id) }}"
                                            class="btn btn-info btn-sm" title="Lihat Detail Pengajuan">
                                            <i class="bi bi-eye"></i> Cek Status
                                        </a>
                                    @elseif($p->status_pengembalian == 'disetujui')
                                        <span class="status-badge status-selesai">Sudah Selesai</span>
                                        <a href="{{ route('masyarakat.pengembalian.form', $p->id) }}"
                                            class="btn btn-secondary btn-sm" title="Lihat Detail Pengembalian">
                                            <i class="bi bi-info-circle"></i> Detail
                                        </a>
                                    @endif

                                    {{-- Tombol untuk melihat detail peminjaman awal (jika ada) --}}
                                    {{-- <a href="{{ route('peminjaman.show', $p->id) }}" class="btn btn-primary btn-sm">Detail</a> --}}
                                </td>
                            </tr>

                            <!-- Modal Edit Sewa Alat Pertanian -->
                            <div class="modal fade" id="editSewa{{ $p->alat_pertanian_id }}" tabindex="-1"
                                aria-labelledby="EditSewa" aria-hidden="true">
                                <div class="modal-dialog"><!-- Modal Dialog -->
                                    <div class="modal-content"><!-- Modal Content -->
                                        <div class="modal-header"><!-- Modal Header -->
                                            <h5 class="modal-title" id="editSewa">Edit Sewa Alat Pertanian
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div><!-- Modal Header -->

                                        <div class="modal-body"><!-- Modal Body -->
                                            <form action="{{ route('peminjaman.update', $p->id) }}" method="POST">
                                                <!-- Form untuk menyewa alat pertanian -->
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="alat_id" value="{{ $p->alat_pertanian_id }}">
                                                <div class="mb-3">
                                                    <label>Nama Peminjam</label>
                                                    <input type="text" name="nama_peminjam" class="form-control"
                                                        value="{{ $p->nama_peminjam }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Tanggal Pinjam</label>
                                                    <input type="date" name="tanggal_pinjam" class="form-control"
                                                        value="{{ $p->tanggal_pinjam }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Tanggal Kembali</label>
                                                    <input type="date" name="tanggal_kembali" class="form-control"
                                                        value="{{ $p->tanggal_kembali }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jumlah Alat Yang Di Sewa</label>
                                                    <input name="jumlah_alat_di_sewa" min="1" max="2"
                                                        type="number" id="typeNumber" class="form-control"
                                                        value="{{ $p->jumlah_alat_di_sewa }}" />
                                                </div>
                                                <button class="btn btn-success">Simpan</button>
                                            </form><!-- Form untuk menyewa alat pertanian -->
                                        </div><!-- Modal Body -->
                                    </div><!-- Modal Content -->
                                </div><!-- Modal Dialog -->
                            </div>
                            <!-- Modal Edit Sewa Alat Pertanian -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section><!-- End Projects Section -->

        <a href="{{ route('alat_pertanian.index_masyarakat') }}" class="btn btn-primary btn-kembali-icon"
            title="Lihat Histori Pemesanan">

            <i class="bi bi-arrow-left-circle"></i>

        </a>

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
