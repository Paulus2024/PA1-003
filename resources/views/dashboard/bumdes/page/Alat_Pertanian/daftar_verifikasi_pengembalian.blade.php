@extends('dashboard.bumdes.component.main')

@section('bumdes_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.bumdes.component.navbar')

        <link rel="stylesheet" href="{{ asset('assets/css/fixed.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        @stack('styles')

        <style>
            body {
                font-family: 'Cambria', serif;
                color: #333;
            }

            .page-header {
                border-bottom: 1px solid #e0e0e0;
                padding-bottom: 15px;
                margin-bottom: 25px;
            }

            h1 {
                font-size: 28px;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 5px;
            }

            .breadcrumb {
                font-size: 14px;
                background: transparent;
                padding: 0;
                margin-bottom: 0;
            }

            .breadcrumb-item a {
                color: #3498db;
                text-decoration: none;
            }

            .breadcrumb-item.active {
                color: #7f8c8d;
            }

            .notification-container {
                position: fixed;
                top: 80px;
                right: 20px;
                z-index: 1050;
            }

            .card {
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                border: none;
                margin-bottom: 25px;
            }

            .card-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid rgba(0, 0, 0, .05);
                padding: 15px 20px;
                font-weight: 600;
            }

            .table {
                font-size: 14px;
                margin-bottom: 0;
            }

            .table th {
                background-color: #f8f9fa;
                font-weight: 600;
                color: #2c3e50;
                border-top: 1px solid #e0e0e0;
            }

            .table td {
                vertical-align: middle;
            }

            .badge {
                font-weight: 500;
                font-size: 12px;
                padding: 5px 8px;
            }

            .btn {
                font-weight: 500;
                padding: 6px 12px;
                font-size: 13px;
                border-radius: 4px;
            }

            .btn-outline-warning {
                color: #e67e22;
                border-color: #e67e22;
            }

            .btn-outline-warning:hover {
                background-color: #e67e22;
                color: white;
            }

            .btn-outline-danger {
                color: #e74c3c;
                border-color: #e74c3c;
            }

            .btn-outline-danger:hover {
                background-color: #e74c3c;
                color: white;
            }

            .btn-success {
                background-color: #27ae60;
                border-color: #27ae60;
            }

            .btn-success:hover {
                background-color: #219653;
                border-color: #219653;
            }

            .action-buttons {
                display: flex;
                gap: 8px;
            }

            .img-thumbnail {
                border-radius: 4px;
                border: 1px solid #e0e0e0;
                padding: 3px;
                background: white;
                /* --- Bagian yang dimodifikasi/ditambahkan --- */
                max-width: 50px;
                /* Coba perkecil ukuran gambar */
                height: auto;
                /* Pastikan rasio aspek terjaga */
                display: block;
                /* Agar gambar bisa di-tengah dan mengatur margin */
                margin: 0 auto;
                /* Agar gambar berada di tengah sel */
                /* --- Akhir modifikasi --- */
            }

            .modal-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid rgba(0, 0, 0, .05);
            }

            .modal-title {
                font-weight: 600;
                color: #2c3e50;
            }

            .form-label b {
                font-weight: 600;
                color: #2c3e50;
            }

            .form-control {
                border-radius: 4px;
                padding: 8px 12px;
                border: 1px solid #ddd;
            }

            .form-control:focus {
                border-color: #3498db;
                box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, .25);
            }

            .notification-badge {
                font-size: 10px;
                position: absolute;
                top: -5px;
                right: -5px;
            }

            .utility-icons {
                display: flex;
                gap: 15px;
                align-items: center;
            }

            .utility-icons a {
                color: #7f8c8d;
                transition: color 0.2s;
            }

            .utility-icons a:hover {
                color: #3498db;
            }
        </style>
    </header>
    <main id="main">
        <section id="projects" class="projects section mb-5 pb-5">
            <div class="container">
                <div class="container mt-4">
                    <div class="page-header mb-4">
                        <h1 class="text-primary">Verifikasi Pengembalian Alat Pertanian</h1>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            Daftar Pengajuan Pengembalian Menunggu Verifikasi
                        </div>
                        <div class="card-body p-0">
                            @if ($pengajuanPengembalian->isEmpty())
                                <p class="p-3 text-center">Tidak ada pengajuan pengembalian yang menunggu verifikasi saat
                                    ini.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID Pinjam</th>
                                                <th>Nama Peminjam</th>
                                                <th>Nama Alat</th>
                                                <th>Tgl. Diajukan</th>
                                                <th>Bukti Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuanPengembalian as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $item->alat->nama_alat_pertanian ?? 'N/A' }}</td>
                                                    {{-- Pakai relasi 'alat' --}}
                                                    <td>{{ $item->updated_at->format('d M Y H:i') }}</td>
                                                    <td>
                                                        @if ($item->bukti_pengembalian)
                                                            <a href="{{ Storage::url($item->bukti_pengembalian) }}"
                                                                target="_blank" title="Lihat Bukti">
                                                                <img src="{{ Storage::url($item->bukti_pengembalian) }}"
                                                                    alt="Bukti"
                                                                    style="max-width: 100px; max-height: 75px; border-radius: 4px; cursor: pointer;">
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                    <td class="action-buttons">
                                                        <form
                                                            action="{{ route('admin.pengembalian.verifikasi.proses', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status_verifikasi"
                                                                value="disetujui">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                title="Setujui Pengembalian">
                                                                <i class="bi bi-check-circle"></i> Setujui
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#tolakModal{{ $item->id }}"
                                                            title="Tolak Pengembalian">
                                                            <i class="bi bi-x-circle"></i> Tolak
                                                        </button>

                                                        <div class="modal fade" id="tolakModal{{ $item->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="tolakModalLabel{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <form
                                                                        action="{{ route('admin.pengembalian.verifikasi.proses', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="status_verifikasi"
                                                                            value="ditolak">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="tolakModalLabel{{ $item->id }}">
                                                                                Tolak Pengajuan
                                                                                Pengembalian (ID: {{ $item->id }})</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    for="catatan_admin{{ $item->id }}"
                                                                                    class="form-label">Alasan Penolakan
                                                                                    (Opsional)
                                                                                    :</label>
                                                                                <textarea class="form-control" id="catatan_admin{{ $item->id }}" name="catatan_admin" rows="3"
                                                                                    placeholder="Jelaskan mengapa pengembalian ditolak..."></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Kirim
                                                                                Penolakan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('alat_pertanian.index') }}" class="btn btn-secondary mt-3">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Alat
                    </a>
                </div>
            </div>
        </section>
            @endsection
