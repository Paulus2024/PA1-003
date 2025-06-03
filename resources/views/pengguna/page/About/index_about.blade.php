@extends('pengguna.component.main')

@section('masyarakat_content')

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
        <div class="container position-relative">
            <h1>About</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            @if($abouts && count($abouts) > 0)
                @foreach($abouts as $about)
                    <div class="row position-relative">
                        <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200">
                            @if ($about->gambar_1)
                                <img src="{{ asset('storage/' . $about->gambar_1) }}" class="img-fluid" alt="Gambar 1">
                            @else
                                <img src="{{ asset('assets/img/about.jpg') }}" alt="Gambar Default" class="img-fluid">
                            @endif
                        </div>

                        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                            <h2 class="inner-title">Desa Taonmarisi</h2>
                            <div class="our-story">
                                <h3>History</h3>
                                <p>{!! $about->sejarah !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada data About yang tersedia.</p>
            @endif
        </div>
    </section><!-- /About Section -->

    <!-- Stats Counter Section -->
    <section id="stats-counter" class="stats-counter section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            @if($abouts && count($abouts) > 0)
                @foreach($abouts as $about)
                    <div class="row gy-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-item d-flex align-items-center w-100 h-100">
                                <i class="bi bi-people color-pink flex-shrink-0"></i>
                                <div>
                                    <p><b>Penduduk</b></p>
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $about->jumlah_penduduk }}" data-purecounter-duration="1"
                                        class="purecounter"></span>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-md-6">
                            <div class="stats-item d-flex align-items-center w-100 h-100">
                                <i class="fas fa-map color-green flex-shrink-0"></i>
                                <div>
                                    <p><b>Luas Wilayah</b></p>
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $about->luas_wilayah }}" data-purecounter-duration="1"
                                        class="purecounter"></span>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-md-6">
                            <div class="stats-item d-flex align-items-center w-100 h-100">
                                <i class="bi bi-people color-pink flex-shrink-0"></i>
                                <div>
                                    <p><b>Perangkat Desa</b></p>
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $about->jumlah_perangkat_desa }}" data-purecounter-duration="1"
                                        class="purecounter"></span>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->
                    </div>
                @endforeach
            @else
                <p>Tidak ada data statistik yang tersedia.</p>
            @endif
        </div>
    </section><!-- /Stats Counter Section -->

    <!-- Alt Services Section -->
    <section id="alt-services" class="alt-services section">
        <div class="container">
            @if($abouts && count($abouts) > 0)
                @foreach($abouts as $about)
                    <div class="row justify-content-around gy-4">
                        <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            @if ($about->gambar_2)
                                <img src="{{ asset('storage/' . $about->gambar_2) }}" alt="Visi Misi" class="img-fluid">
                            @else
                                <img src="{{ asset('assets/img/alt-services.jpg') }}" alt="" class="img-fluid">
                            @endif
                        </div>

                        <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos
