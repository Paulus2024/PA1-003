@extends('dashboard.bumdes.component.main')

@section('bumdes_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.bumdes.component.navbar')

        <style>
            :root {
                --primary-color: #3498db;
                --success-color: #2ecc71;
                --danger-color: #e74c3c;
                --warning-color: #f39c12;
                --info-color: #1abc9c;
                --dark-color: #2c3e50;
                --light-color: #ecf0f1;
                --gray-color: #95a5a6;
            }

            body {
                font-family: 'Cambria';
                color: #333;
                background-color: #f5f7fa;
            }

            .page-header {
                padding: 40px 0 20px;
                margin-bottom: 30px;
                border-bottom: 1px solid #e0e0e0;
            }

            .page-header h1 {
                font-size: 28px;
                font-weight: 700;
                color: var(--dark-color);
                margin-bottom: 10px;
            }

            .breadcrumb {
                padding: 0;
                margin: 0;
                background: transparent;
                font-size: 14px;
            }

            .breadcrumb-item {
                display: inline-flex;
                align-items: center;
            }

            .breadcrumb-item a {
                color: var(--primary-color);
                text-decoration: none;
                transition: all 0.3s;
            }

            .breadcrumb-item a:hover {
                color: #2980b9;
                text-decoration: underline;
            }

            .breadcrumb-item.active {
                color: var(--gray-color);
            }

            .breadcrumb-item + .breadcrumb-item::before {
                content: "›";
                padding: 0 8px;
                color: var(--gray-color);
            }

            .card {
                border: none;
                border-radius: 8px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
                margin-bottom: 30px;
                overflow: hidden;
            }

            .card-header {
                background-color: white;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                padding: 15px 20px;
                font-weight: 600;
                color: var(--dark-color);
            }

            .table {
                width: 100%;
                margin-bottom: 0;
                font-size: 14px;
            }

            .table th {
                background-color: #f8f9fa;
                font-weight: 600;
                color: var(--dark-color);
                padding: 12px 15px;
                border-top: none;
                white-space: nowrap;
            }

            .table td {
                padding: 12px 15px;
                vertical-align: middle;
                border-top: 1px solid #f0f0f0;
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.02);
            }

            .status-badge {
                display: inline-block;
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
                text-transform: capitalize;
            }

            .status-menunggu {
                background-color: #fff3cd;
                color: #856404;
            }

            .status-disetujui {
                background-color: #d4edda;
                color: #155724;
            }

            .status-ditolak {
                background-color: #f8d7da;
                color: #721c24;
            }

            .status-selesai {
                background-color: #e2e3e5;
                color: #383d41;
            }

            .btn {
                font-weight: 500;
                padding: 6px 12px;
                font-size: 13px;
                border-radius: 4px;
                transition: all 0.2s;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 5px;
            }

            .btn-sm {
                padding: 5px 10px;
                font-size: 12px;
            }

            .btn-success {
                background-color: var(--success-color);
                border-color: var(--success-color);
            }

            .btn-danger {
                background-color: var(--danger-color);
                border-color: var(--danger-color);
            }

            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .btn-kembali {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                z-index: 99;
                transition: all 0.3s;
            }

            .btn-kembali:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            }

            .action-buttons {
                display: flex;
                gap: 8px;
                flex-wrap: nowrap;
            }

            .text-muted {
                color: #95a5a6 !important;
            }

            .modal-header {
                border-bottom: 1px solid #e9ecef;
                padding: 15px 20px;
            }

            .modal-title {
                font-weight: 600;
                color: var(--dark-color);
            }

            .form-label {
                font-weight: 500;
                margin-bottom: 8px;
                color: var(--dark-color);
            }

            .form-control {
                border-radius: 4px;
                padding: 8px 12px;
                border: 1px solid #ddd;
                transition: all 0.3s;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            }

            @media (max-width: 768px) {
                .table-responsive {
                    border: none;
                }

                .action-buttons {
                    flex-direction: column;
                    gap: 5px;
                }
            }
        </style>
    </header>

    <div class="container">
        <div class="page-header">
            <h1 class="text-primary">Histori Pemesanan Alat</h1>
            <nav aria-label="breadcrumb">
            </nav>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Alat</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjaman as $p)
                                <tr>
                                    <td>{{ $p->alat->nama_alat_pertanian }}</td>
                                    <td>{{ $p->nama_peminjam }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                                    <td>{{ $p->jumlah_alat_di_sewa }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($p->status_peminjaman) }}">
                                            {{ ucfirst($p->status_peminjaman) }}
                                        </span>
                                    </td>
                                    <td class="action-buttons">
                                        @if ($p->status_peminjaman == 'menunggu')
                                            <form action="{{ route('peminjaman.approve', $p->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-success btn-sm" title="Setujui">
                                                    <i class="bi bi-check-lg"></i> Setuju
                                                </button>
                                            </form>

                                            <form action="{{ route('peminjaman.reject', $p->id) }}" method="POST" class="d-inline">
                                                @csrf @method('POST')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menolak peminjaman ini?')"
                                                    title="Tolak">
                                                    <i class="bi bi-x-lg"></i> Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal Edit Sewa -->
                                <div class="modal fade" id="editSewa{{ $p->alat_pertanian_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Sewa Alat Pertanian</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('peminjaman.update', $p->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="alat_id" value="{{ $p->alat_pertanian_id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Peminjam</label>
                                                        <input type="text" name="nama_peminjam" class="form-control" value="{{ $p->nama_peminjam }}" required>
                                                    </div>

                                                    <div class="row g-2">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Tanggal Pinjam</label>
                                                            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $p->tanggal_pinjam }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Tanggal Kembali</label>
                                                            <input type="date" name="tanggal_kembali" class="form-control" value="{{ $p->tanggal_kembali }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Jumlah Alat</label>
                                                        <input name="jumlah_alat_di_sewa" min="1" max="2" type="number" class="form-control" value="{{ $p->jumlah_alat_di_sewa }}" required>
                                                    </div>

                                                    <div class="d-grid gap-2 mt-4">
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="{{ route('alat_pertanian.index') }}" class="btn btn-primary btn-kembali" title="Kembali">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>
@endsection
