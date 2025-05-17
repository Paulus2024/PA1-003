@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')

        <link rel="stylesheet" href="{{ asset('assets/css/fixed.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        @stack('styles')
    </header>

    <main id="main">
        <section id="projects" class="projects section mb-5 pb-5">
            <div class="container">

                <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Alat</th>
                                <th>Jenis</th>
                                <th>Harga Sewa</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Jumlah Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alat_pertanian as $item)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $item->gambar_alat) }}"
                                             alt="{{ $item->nama_alat_pertanian }}"
                                             width="100">
                                    </td>
                                    <td>{{ $item->nama_alat_pertanian }}</td>
                                    <td>{{ $item->jenis_alat_pertanian }}</td>
                                    <td>{{ $item->harga_sewa }}</td>
                                    <td>{{ $item->catatan }}</td>
                                    <td class="text-center">
                                        @if ($item->status_alat == 'tersedia')
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $item->jumlah_tersedia }} / {{ $item->jumlah_alat }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#SewaAlatPertanian{{ $item->id_alat_pertanian }}">
                                            Sewa
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Sewa Alat Pertanian -->
                                <div class="modal fade" id="SewaAlatPertanian{{ $item->id_alat_pertanian }}" tabindex="-1"
                                    aria-labelledby="SewaAlatPertanian" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Sewa Alat Pertanian</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('alat_pertanian.pinjam') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="alat_id"
                                                        value="{{ $item->id_alat_pertanian }}">
                                                    <div class="mb-3">
                                                        <label>Nama Peminjam</label>
                                                        <input type="text" name="nama_peminjam" class="form-control"
                                                            placeholder="Nama Peminjam" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tanggal Pinjam</label>
                                                        <input type="date" name="tanggal_pinjam" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tanggal Kembali</label>
                                                        <input type="date" name="tanggal_kembali" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Jumlah Alat Yang Disewa</label>
                                                        <input name="jumlah_alat_di_sewa" min="1" max="2"
                                                            type="number" class="form-control"
                                                            placeholder="Min 1 & Max 2" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Pinjam</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Tidak ada data alat pertanian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <a href="{{ route('pemesanan.history.sekretaris') }}" class="btn btn-primary btn-historipemesanan-icon"
            title="Lihat Histori Pemesanan">
            <i class="bi bi-clock-history"></i>
        </a>
    </main>

@endsection
