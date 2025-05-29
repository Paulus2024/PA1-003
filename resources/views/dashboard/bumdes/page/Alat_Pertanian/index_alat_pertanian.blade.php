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
                box-shadow: 0 2px 10px rgba(0,0,0,0.08);
                border: none;
                margin-bottom: 25px;
            }

            .card-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid rgba(0,0,0,.05);
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
            }

            .modal-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid rgba(0,0,0,.05);
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
                box-shadow: 0 0 0 0.2rem rgba(52,152,219,.25);
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
                <!-- Utility Bar -->
                <div class="card mb-4 p-3">
                    <div class="d-flex justify-content-end">
                        <div class="utility-icons">
                            <a href="{{ route('pemesanan.history') }}" title="Riwayat Pemesanan">
                                <i class="bi bi-clock fs-5"></i>
                            </a>

                            <a href="#" class="position-relative" data-bs-toggle="modal" data-bs-target="#notificationModal" title="Notifikasi">
                                <i class="bi bi-bell fs-5"></i>
                                @php
                                    $unreadNotificationsCount = auth()
                                        ->user()
                                        ->notifications()
                                        ->whereNull('read_at')
                                        ->count();
                                @endphp
                                @if ($unreadNotificationsCount > 0)
                                    <span class="notification-badge badge rounded-pill bg-danger">
                                        {{ $unreadNotificationsCount }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Notification Modal -->
                <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                @php
                                    $notifications = Cache::remember(
                                        'user_' . auth()->id() . '_notifications',
                                        60,
                                        function () {
                                            return auth()->user()->notifications()->latest()->get();
                                        },
                                    );
                                @endphp

                                @if ($notifications->isNotEmpty())
                                    <ul class="list-group">
                                        @foreach ($notifications as $notification)
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">{{ $notification->message }}</div>
                                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                    @if (!$notification->read_at)
                                                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-outline-primary">Tandai Sudah Dibaca</button>
                                                        </form>
                                                    @endif
                                                </div>
                                                <i class="bi bi-info-circle text-secondary"></i>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center text-muted py-3">Tidak ada notifikasi baru</div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <a href="#" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="text-primary"><b>Alat Pertanian</b></h1>
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="120">Gambar</th>
                                        <th>Nama Alat</th>
                                        <th>Jenis Alat</th>
                                        <th>Harga Sewa</th>
                                        <th>Stok</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alat_pertanian as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->gambar_alat) }}" class="img-thumbnail"
                                                    alt="{{ $item->nama_alat_pertanian }}" width="80">
                                            </td>
                                            <td>{{ $item->nama_alat_pertanian }}</td>
                                            <td>{{ $item->jenis_alat_pertanian }}</td>
                                            <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                                            <td>{{ $item->jumlah_alat }}</td>
                                            <td>{{ $item->catatan ?: '-' }}</td>
                                            <td>
                                                @if ($item->status_alat == 'tersedia')
                                                    <span class="badge bg-success">Tersedia</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                                @endif
                                            </td>
                                            <td class="action-buttons">
                                                <button type="button" class="btn btn-outline-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#EditAlatPertanian{{ $item->id_alat_pertanian }}"
                                                    title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form
                                                    action="{{ route('bumdes.alat_pertanian.destroy', $item->id_alat_pertanian) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="EditAlatPertanian{{ $item->id_alat_pertanian }}"
                                            tabindex="-1" aria-labelledby="EditAlatPertanianLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditAlatPertanianLabel">Edit Alat Pertanian</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('alat_pertanian.update', $item->id_alat_pertanian) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nama_alat_pertanian" class="form-label"><b>Nama Alat Pertanian</b></label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_alat_pertanian" id="nama_alat_pertanian"
                                                                    value="{{ $item->nama_alat_pertanian }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Jenis Alat Pertanian</b></label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jenis_alat_pertanian" id="olah_lahan_edit"
                                                                        value="Olah_Lahan"
                                                                        {{ $item->jenis_alat_pertanian == 'Olah_Lahan' ? 'checked' : '' }}
                                                                        required>
                                                                    <label class="form-check-label" for="olah_lahan_edit">Olah Lahan</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jenis_alat_pertanian" id="pascapanen_edit"
                                                                        value="Pascapanen"
                                                                        {{ $item->jenis_alat_pertanian == 'Pascapanen' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="pascapanen_edit">Pascapanen</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jenis_alat_pertanian" id="lainnya_edit"
                                                                        value="Lainnya"
                                                                        {{ $item->jenis_alat_pertanian == 'Lainnya' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="lainnya_edit">Lainnya</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="harga_sewa" class="form-label"><b>Harga Sewa</b></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Rp</span>
                                                                        <input type="text" class="form-control"
                                                                            name="harga_sewa" id="harga_sewa"
                                                                            value="{{ number_format($item->harga_sewa, 0, ',', '.') }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="jumlah_alat" class="form-label"><b>Jumlah Alat</b></label>
                                                                    <input type="number" class="form-control"
                                                                        name="jumlah_alat" id="jumlah_alat"
                                                                        value="{{ $item->jumlah_alat }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="catatan" class="form-label"><b>Catatan Khusus</b></label>
                                                                <textarea class="form-control" name="catatan" id="catatan" rows="2">{{ $item->catatan }}</textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label"><b>Gambar Saat Ini</b></label><br>
                                                                <img src="{{ asset('storage/' . $item->gambar_alat) }}"
                                                                    alt="Gambar Alat" class="img-thumbnail" width="150">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="gambar_alat" class="form-label"><b>Gambar Baru (Opsional)</b></label>
                                                                <input type="file" class="form-control"
                                                                    name="gambar_alat" id="gambar_alat">
                                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
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

                        <!-- Add New Button -->
                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-primary py-2" type="button" data-bs-toggle="modal"
                                data-bs-target="#TambahAlatPertanian">
                                <i class="bi bi-plus-circle"></i> Tambah Alat Pertanian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add New Modal -->
        <div class="modal fade" id="TambahAlatPertanian" tabindex="-1" aria-labelledby="TambahAlatPertanianLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahAlatPertanianLabel">Tambah Alat Pertanian Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('bumdes.alat_pertanian.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_alat_pertanian" class="form-label"><b>Nama Alat Pertanian</b></label>
                                <input type="text" class="form-control" name="nama_alat_pertanian"
                                    id="nama_alat_pertanian" placeholder="Masukkan nama alat" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><b>Jenis Alat Pertanian</b></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_alat_pertanian"
                                        id="olah_lahan" value="Olah_Lahan" required>
                                    <label class="form-check-label" for="olah_lahan">Olah Lahan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_alat_pertanian"
                                        id="pascapanen" value="Pascapanen">
                                    <label class="form-check-label" for="pascapanen">Pascapanen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_alat_pertanian"
                                        id="lainnya" value="Lainnya">
                                    <label class="form-check-label" for="lainnya">Lainnya</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga_sewa" class="form-label"><b>Harga Sewa</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" name="harga_sewa" id="harga_sewa"
                                            placeholder="Masukkan harga" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_alat" class="form-label"><b>Jumlah Alat</b></label>
                                    <input type="number" class="form-control" name="jumlah_alat" id="jumlah_alat"
                                        placeholder="Jumlah tersedia" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label"><b>Catatan Khusus</b></label>
                                <textarea class="form-control" name="catatan" id="catatan" rows="2" placeholder="Masukkan catatan"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="gambar_alat" class="form-label"><b>Gambar Alat</b></label>
                                <input type="file" class="form-control" name="gambar_alat" id="gambar_alat" required>
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary py-2">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
