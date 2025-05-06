@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.masyarakat.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>About</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat')}}">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Team</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-5">
                @foreach ($data_pengurus_desas as $item)
                <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
                    <div class="member-img">
                        <img src="{{ asset('storage/' . $item->gambar_data_pengurus_desa) }}"alt="{{ $item->nama_data_pengurus_desa }}"class="img-fluid" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
                    </div>
                    <div class="member-info text-center">
                    <h4>{{ $item->nama_data_pengurus_desa }}</h4>
                    <span>{{ $item->jabatan_data_pengurus_desa }}</span>
                    <p>{{ $item->deskripsi_data_pengurus_desa }}</p>
                    </div>
                </div>
                @endforeach
            </div>

    </section><!-- /Team Section -->


    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
