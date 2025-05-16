@extends('pengguna.main')

@section('content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
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
    <div class="container">

        <!-- Section Title -->
        <div class="section-title text-center" data-aos="fade-up">
            <h2>Team</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="row gy-5">
            @foreach ($data_pengurus_desas as $item)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="member text-center w-100">
                    <div class="member-img">
                        <img src="{{ asset('storage/' . $item->gambar_data_pengurus_desa) }}"
                             alt="{{ $item->nama_data_pengurus_desa }}"
                             class="img-fluid"
                             style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
                    </div>
                    <div class="member-info mt-3">
                        <h4>{{ $item->nama_data_pengurus_desa }}</h4>
                        <span><i>{{ $item->jabatan_data_pengurus_desa }}</i></span>
                        <p>{{ $item->deskripsi_data_pengurus_desa }}</p>
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
