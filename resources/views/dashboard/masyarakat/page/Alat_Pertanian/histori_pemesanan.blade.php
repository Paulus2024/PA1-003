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
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Fasilitas</li>
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
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Status Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamanMasyarakat as $p)
                            <!-- Perulangan  -->
                            <tr>
                                <td>{{ $p->alat->nama_alat_pertanian }}</td>
                                <td>{{ $p->peminjam }}</td>
                                <td>{{ $p->tanggal_pinjam }}</td>
                                <td>{{ $p->tanggal_kembali }}</td>
                                <td>{{ $p->status }}</td>
                                {{-- <td>
                                    @if ($p->status == 'menunggu')
                                        <a href="{{ route('alat_pertanian.masyarakat.show', $p->id) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    @elseif ($p->status == 'diterima')
                                        <a href="{{ route('alat_pertanian.masyarakat.show', $p->id) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    @else
                                        <span class="badge bg-secondary">Selesai</span>
                                    @endif
                                </td> --}}
                                <td>
                                    @if($p->status == 'menunggu')<!-- jika status masih menunggu maka kontrol untuk di edit dan dihapus akan muncul -->
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $p->alat_pertanian_id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('sekretaris.fasilitas.destroy', $p->alat_pertanian_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section><!-- End Projects Section -->

        <a href="{{ route('alat_pertanian.masyarakat') }}" class="btn btn-primary btn-kembali-icon"
            title="Lihat Histori Pemesanan">

            <i class="bi bi-arrow-left-circle"></i>

        </a>

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
