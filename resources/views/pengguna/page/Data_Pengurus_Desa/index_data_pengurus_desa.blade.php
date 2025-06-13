@extends('pengguna.component.main')

@section('pengguna_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/hero-carousel/5.jpg);">
    <div class="container position-relative">
        <h1>Data Pengurus Desa</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/">Home</a></li>
                <li class="current">Data Pengurus Desa</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<!-- Team Section -->
<section id="team" class="team section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Perangkat Desa</h2>
        <p>Bersama Membangun Masa Depan</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-5">
            @foreach ($data_pengurus_desas as $item)
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center">
                    <div class="member-img">
                        <img src="{{ asset('storage/' . $item->gambar_data_pengurus_desa) }}"
                             alt="{{ $item->nama_data_pengurus_desa }}"
                             class="img-fluid rounded-circle mx-auto d-block"
                             style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="member-info mt-3">
                        <h4>{{ $item->nama_data_pengurus_desa }}</h4>
                        <span class="d-block">{{ $item->jabatan_data_pengurus_desa }}</span>
                        <p class="mt-2">{{ $item->deskripsi_data_pengurus_desa }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section><!-- /Team Section -->

<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
