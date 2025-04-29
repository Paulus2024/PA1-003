@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url({{ asset('assets/img/page-title-bg.jpg') }});">
    <div class="container position-relative">
        <h1>Alat Pertanian</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/index_sekretaris">Home</a></li>
                <li class="current">Alat Pertanian</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<section id="projects" class="projects section">
    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-ringan">Alat Ringan</li>
                <li data-filter=".filter-berat">Alat Berat</li>
            </ul>

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach ($alat_pertanians as $item)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $item->kategori }}">
                    <div class="portfolio-content h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" onerror="this.src='{{ asset('path/to/default-image.jpg') }}'">
                        <div class="portfolio-info">
                            <h4>{{ $alat->nama }}</h4>
                            <p>{{ Str::limit($item->deskripsi, 50) }}</p>
                            <a href="{{ asset('storage/' . $item->gambar) }}" title="{{ $item->nama }}" data-gallery="portfolio-gallery" class="glightbox preview-link">
                                <i class="bi bi-zoom-in"></i>
                            </a>
                            <a href="{{ route('alat-pertanian.show', $item->slug) }}" title="More Details" class="details-link">
                                <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>
@endsection
