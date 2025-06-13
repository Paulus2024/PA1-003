@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
        <div class="container position-relative">
            <h1>Fasilitas</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                    <li class="current">Fasilitas</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="projects" class="projects section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">

                @forelse ($fasilitas_masyarakat as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ $item->video_url ?? asset('storage/' . $item->gambar_fasilitas) }}"
                           data-fancybox="fasilitas-gallery"
                           data-caption="<h4>{{ $item->nama_fasilitas }}</h4><p>{{ e($item->deskripsi_fasilitas) }}</p>"
                           class="gallery-item-link">

                            <img src="{{ asset('storage/' . $item->gambar_fasilitas) }}" alt="{{ $item->nama_fasilitas }}" class="gallery-image">

                            <div class="overlay">
                                <h4 class="overlay-title">{{ Str::limit($item->nama_fasilitas, 30) }}</h4>
                                <div class="zoom-icon">
                                    <i class="bi bi-arrows-fullscreen"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Belum ada fasilitas yang tersedia.
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>

@endsection
