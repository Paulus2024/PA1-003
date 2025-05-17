@extends('dashboard.sekretaris.component.main')

<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

@section('admin_content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0">Tentang Desa</h5>
                    </div>
                    <div class="card-body">
                        @if ($about)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr class="text-center">
                                            <th>Sejarah</th>
                                            <th>Visi & Misi</th>
                                            <th>Jumlah Penduduk</th>
                                            <th>Luas Wilayah</th>
                                            <th>Jumlah Perangkat Desa</th>
                                            <th>Gambar 1</th>
                                            <th>Gambar 2</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{!! $about->sejarah !!}</td>
                                            <td>{!! $about->visi_misi !!}</td>
                                            <td class="text-center">{{ $about->jumlah_penduduk }}</td>
                                            <td class="text-center">{{ $about->luas_wilayah }}</td>
                                            <td class="text-center">{{ $about->jumlah_perangkat_desa }}</td>
                                            <td class="text-center">
                                                @if ($about->gambar1)
                                                    <img src="{{ asset('storage/' . $about->gambar1) }}" alt="Gambar 1" class="img-thumbnail" style="max-width: 120px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($about->gambar2)
                                                    <img src="{{ asset('storage/' . $about->gambar2) }}" alt="Gambar 2" class="img-thumbnail" style="max-width: 120px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column gap-2">
                                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $about->id }}">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                Belum ada data About yang tersedia.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit disisipkan di bawah jika ada --}}
    {{-- @include('dashboard.admin.about.modal-edit') --}}
@endsection
