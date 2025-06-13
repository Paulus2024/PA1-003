@extends('dashboard.masyarakat.component.main') {{-- Asumsi ada layout utama untuk pengguna --}}

@section('masyarakat_content')
    {{-- Menambahkan CSS khusus untuk halaman ini --}}
    <style>
        body {
            /* Pastikan background body sedikit gelap agar card putih menonjol */
            background-color: #f8f9fa;
        }

        .blog-post-card {
            background-color: #ffffff;
            /* Latar belakang putih untuk konten */
            padding: 30px 40px;
            /* Padding di dalam card (atas-bawah | kiri-kanan) */
            border-radius: 8px;
            /* Sudut yang sedikit melengkung */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            /* Bayangan halus untuk efek 3D */
            margin-bottom: 2rem;
            /* Jarak bawah */
        }

        .blog-post-title {
            font-size: 2.2rem;
            /* Ukuran judul lebih besar */
            font-weight: 700;
            /* Tebal */
            color: #2c3e50;
            /* Warna gelap yang tidak pekat */
            margin-bottom: 0.5rem;
        }

        .blog-post-meta {
            color: #7f8c8d;
            /* Warna abu-abu untuk tanggal */
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .post-body {
            line-height: 1.8;
            /* Jarak antar baris agar mudah dibaca */
            font-size: 1.1rem;
            /* Ukuran font konten */
            color: #34495e;
            /* Warna teks konten */
        }

        /* Styling untuk elemen di dalam konten yang dibuat oleh TinyMCE */
        .post-body p {
            margin-bottom: 1rem;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .attachment-box {
            background-color: #e9f7ef;
            border-left: 5px solid #28a745;
        }
    </style>

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
        <div class="container position-relative">
            <h1>Informasi Desa</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                    <li class="current">Berita</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="blog-posts" class="blog-posts section">
        <div class="container">

            {{-- Navigasi Tab (Berita / Pengumuman) --}}
            <ul class="nav nav-tabs justify-content-center border-0 mb-5">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pengumuman</a> {{-- Ganti href dengan route pengumuman jika sudah ada --}}
                </li>
            </ul>

            <div class="container my-5 pt-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <article class="blog-post-card"> {{-- Menggunakan class baru untuk styling --}}

                            {{-- Judul dan Tanggal --}}
                            <h2 class="blog-post-title mb-2">{{ $berita->judul_informasi }}</h2>
                            <p class="blog-post-meta fst-italic">
                                Dipublikasikan pada
                                {{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </p>

                            <hr class="mb-4">

                            {{-- PERBAIKAN PENTING: Cek jika lampiran ada sebelum digunakan --}}
                            @if ($berita->lampiran_informasi)
                                @php
                                    $path = 'storage/' . $berita->lampiran_informasi;
                                    $extension = strtolower(pathinfo($berita->lampiran_informasi, PATHINFO_EXTENSION));
                                @endphp

                                {{-- Tampilkan gambar/lampiran jika ada --}}
                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($path) }}" class="img-fluid rounded mb-4"
                                        alt="{{ $berita->judul_informasi }}">
                                @endif
                            @endif

                            {{-- Tampilkan deskripsi lengkap (mengizinkan HTML dari TinyMCE) --}}
                            <div class="post-body">
                                {!! $berita->deskripsi_informasi !!}
                            </div>

                            {{-- PERBAIKAN PENTING (lanjutan): Cek lagi jika lampiran ada --}}
                            @if ($berita->lampiran_informasi)
                                {{-- Link untuk download lampiran jika bukan gambar --}}
                                @if (in_array($extension, ['pdf', 'doc', 'docx']))
                                    <div class="alert attachment-box mt-4">
                                        <strong>Lampiran Dokumen:</strong>
                                        <a href="{{ asset($path) }}" target="_blank"
                                            class="text-decoration-none fw-bold ms-2">
                                            <i class="fas fa-download me-1"></i> Unduh File ({{ strtoupper($extension) }})
                                        </a>
                                    </div>
                                @endif
                            @endif

                            <hr class="mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>

                        </article>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
