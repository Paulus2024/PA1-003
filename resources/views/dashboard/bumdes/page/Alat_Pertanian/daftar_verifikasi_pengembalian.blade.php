@extends('dashboard.bumdes.component.main')

@section('bumdes_content')
<div class="container mt-4">
    <div class="page-header mb-4">
        <h1 class="text-primary">Verifikasi Pengembalian Alat Pertanian</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            Daftar Pengajuan Pengembalian Menunggu Verifikasi
        </div>
        <div class="card-body p-0">
            @if($pengajuanPengembalian->isEmpty())
                <p class="p-3 text-center">Tidak ada pengajuan pengembalian yang menunggu verifikasi saat ini.</p>
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
                            @foreach($pengajuanPengembalian as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name ?? 'N/A' }}</td>
                                <td>{{ $item->alat->nama_alat_pertanian ?? 'N/A' }}</td> {{-- Pakai relasi 'alat' --}}
                                <td>{{ $item->updated_at->format('d M Y H:i') }}</td>
                                <td>
                                    @if($item->bukti_pengembalian)
                                        <a href="{{ Storage::url($item->bukti_pengembalian) }}" target="_blank" title="Lihat Bukti">
                                            <img src="{{ Storage::url($item->bukti_pengembalian) }}" alt="Bukti" style="max-width: 100px; max-height: 75px; border-radius: 4px; cursor: pointer;">
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="action-buttons">
                                    <form action="{{ route('admin.pengembalian.verifikasi.proses', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status_verifikasi" value="disetujui">
                                        <button type="submit" class="btn btn-success btn-sm" title="Setujui Pengembalian">
                                            <i class="bi bi-check-circle"></i> Setujui
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $item->id }}" title="Tolak Pengembalian">
                                        <i class="bi bi-x-circle"></i> Tolak
                                    </button>

                                    <div class="modal fade" id="tolakModal{{ $item->id }}" tabindex="-1" aria-labelledby="tolakModalLabel{{ $item->id }}" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                          <form action="{{ route('admin.pengembalian.verifikasi.proses', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status_verifikasi" value="ditolak">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="tolakModalLabel{{ $item->id }}">Tolak Pengajuan Pengembalian (ID: {{ $item->id }})</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <label for="catatan_admin{{ $item->id }}" class="form-label">Alasan Penolakan (Opsional):</label>
                                                <textarea class="form-control" id="catatan_admin{{ $item->id }}" name="catatan_admin" rows="3" placeholder="Jelaskan mengapa pengembalian ditolak..."></textarea>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
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
@endsection
