@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')

        <link rel="stylesheet" href="{{ asset('assets/css/fixed.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        @stack('styles')
    </header>

    <main id="main" style="font-family: 'Cambria', serif;">
        <section id="projects" class="projects section mb-5 pb-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h2 class="fw-bold text-primary">Daftar Alat Pertanian</h2>
                        <p class="text-muted">Kelola penyewaan alat pertanian desa</p>
                    </div>
                </div><br><br>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="10%" class="text-center">Gambar</th>
                                        <th width="15%">Nama Alat</th>
                                        <th width="10%">Jenis</th>
                                        <th width="10%">Harga Sewa</th>
                                        <th width="20%">Catatan</th>
                                        <th width="10%" class="text-center">Status</th>
                                        <th width="10%" class="text-center">Tersedia</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($alat_pertanian as $item)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset('storage/' . $item->gambar_alat) }}"
                                                    alt="{{ $item->nama_alat_pertanian }}"
                                                    class="img-thumbnail rounded"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td class="fw-semibold">{{ $item->nama_alat_pertanian }}</td>
                                            <td>{{ $item->jenis_alat_pertanian }}</td>
                                            <td>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                                            <td class="text-truncate" style="max-width: 250px;" title="{{ $item->catatan }}">
                                                {{ $item->catatan }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status_alat == 'tersedia')
                                                    <span class="badge bg-success rounded-pill">Tersedia</span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill">Tidak Tersedia</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $item->jumlah_tersedia }} / {{ $item->jumlah_alat }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary rounded-pill"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#SewaAlatPertanian{{ $item->id_alat_pertanian }}"
                                                    @if($item->status_alat != 'tersedia') disabled @endif>
                                                    <i class="bi bi-cart-plus me-1"></i> Sewa
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Sewa Alat Pertanian -->
                                        <div class="modal fade" id="SewaAlatPertanian{{ $item->id_alat_pertanian }}" tabindex="-1"
                                            aria-labelledby="SewaAlatPertanianLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Form Penyewaan Alat</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('alat_pertanian.pinjam') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="alat_id"
                                                                value="{{ $item->id_alat_pertanian }}">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Peminjam</label>
                                                                <input type="text" name="nama_peminjam" class="form-control rounded-pill"
                                                                    placeholder="Masukkan nama lengkap" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Pinjam</label>
                                                                <input type="date" name="tanggal_pinjam" class="form-control rounded-pill"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Kembali</label>
                                                                <input type="date" name="tanggal_kembali" class="form-control rounded-pill"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Jumlah Alat</label>
                                                                <input name="jumlah_alat_di_sewa" min="1" max="2"
                                                                    type="number" class="form-control rounded-pill"
                                                                    placeholder="Min: 1, Max: 2"
                                                                    value="1"
                                                                    required>
                                                            </div>
                                                            <div class="d-grid gap-2">
                                                                <button type="submit" class="btn btn-primary rounded-pill">
                                                                    <i class="bi bi-check-circle me-1"></i> Konfirmasi Sewa
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a href="{{ route('pemesanan.history.sekretaris') }}" class="btn btn-primary btn-floating"
           style="position: fixed; bottom: 20px; right: 20px; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;"
           title="Lihat Histori Pemesanan">
            <i class="bi bi-clock-history fs-5"></i>
        </a>
    </main>

    <style>
        body {
            font-family: 'Cambria', serif;
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
        .btn-floating {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        .btn-floating:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
    </style>

@endsection
