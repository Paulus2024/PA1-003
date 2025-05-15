    @extends('pengguna.main')

    @section(section:'content')
    <header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')

    <style>

    </style>
    </header>

    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
        <h1>Galeri</h1>
        <nav class="breadcrumbs">
        <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Galeri</li>
        </ol>
        </nav>
    </div>
    </div><!-- End Page Title -->

    <section class="projects section">
        <div class="container">
            <h1 class="text-center mb-4">Galeri Kami</h1>
            <div class="row">
                @foreach ($galleries as $item)
                    <div class="col-md-4 mb-4">
                        <div class="gallery-item">
                            <img src="{{ asset('storage/' . $item->gambar_galeri) }}" class="img-fluid" alt="Gambar Galeri">
                            <div class="overlay">{{ Str::limit($item->judul_galeri, 50) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    </section>


    <footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
    </footer>

    @endsection
