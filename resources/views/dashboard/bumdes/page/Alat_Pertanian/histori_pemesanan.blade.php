@extends('dashboard.bumdes.component.main')

@section('bumdes_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.bumdes.component.navbar')

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
                    <li><a href="/index_bumdes">Home</a></li>
                    <li class="current">Hisori Pemesanan</li>
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
                                        <!-- Form Action Untuk Mengubah Status -->
                                        <div class="d-flex gap-2">
                                            <!-- Form Untuk setujui -->
                                            <form action="{{ route('peminjaman.approve', $p->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-sm btn-success">Setuju</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted">
                                            -
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($p->status_peminjaman == 'menunggu')
                                    <div class="d-flex gap-2">
                                        <!-- Form Action Untuk Cancle -->
                                        <form action="{{ route('peminjaman.cancel', $p->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-danger">Batalkan</button>
                                        </form>

                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $p->alat_pertanian_id }}">
                                                Edit
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section><!-- End Projects Section -->

        <a href="{{ route('alat_pertanian.index') }}" class="btn btn-primary btn-kembali-icon"
            title="Lihat Histori Pemesanan">

            <i class="bi bi-arrow-left-circle"></i>

        </a>

    </main>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
