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

  <!-- Projects Section -->
  <section id="projects" class="projects section">

    <div class="container">
        <h1 class="text-center mb-4">Galeri Kami</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="Gambar 1">
                <div class="overlay">Deskripsi Gambar 1</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="Gambar 2">
                <div class="overlay">Deskripsi Gambar 2</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="Gambar 3">
                <div class="overlay">Deskripsi Gambar 3</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="Gambar 4">
                <div class="overlay">Deskripsi Gambar 4</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="Gambar 5">
                <div class="overlay">Deskripsi Gambar 5</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/img/projects/design-2.jpg" class="img-fluid" alt="Gambar 6">
                <div class="overlay">Deskripsi Gambar 6</div>
            </div>
        </div>
    </div>

    </div>

  </section><!-- /Projects Section -->

</main>

  <footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
