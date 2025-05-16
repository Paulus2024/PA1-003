@extends('pengguna.main')

@section(section:'content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>About</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="current">About</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->


  <!-- Stats Counter Section -->
  <section id="stats-counter" class="stats-counter section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Stats</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-2">

        <div class="col-lg-6 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-people color-pink flex-shrink-0"></i>
              <div>
                <p><b>Penduduk</b></p>
                <span data-purecounter-start="0" data-purecounter-end="827" data-purecounter-duration="1" class="purecounter"></span>

              </div>
            </div>
          </div><!-- End Stats Item -->

        <div class="col-lg-6 col-md-6">
          <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="fas fa-map color-green flex-shrink-0"></i>
            <div>
            <p><b>Luas Wilayah</b></p>
              <span data-purecounter-start="0" data-purecounter-end="644" data-purecounter-duration="1" class="purecounter"></span>
            </div>
          </div>
        </div><!-- End Stats Item -->

      </div>

    </div>

  </section><!-- /Stats Counter Section -->

  <!-- Alt Services Section -->
  <section id="alt-services" class="alt-services section">

    <div class="container">

      <div class="row justify-content-around gy-4">
        <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="assets/img/g1.jpg" alt=""></div>

        <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <h3>VISI & MISI</h3>
          <p>Terwujudnya desa yang mandiri sejahtera dan berbudaya melalui perbedayaan potensial lokal</p>
            <div>
              <p>Meningkatkan Kualitas Pelayanan Public Yang Transparan</p>
              <p>Meningkatkan kualitas pekayanan public yang trasparan</p>
              <p>Mengembangkan Potensi SDA dan manusia secara beruntun</p>
              <p>Mendorong partisipasi aktif masyarakat dalam pengembangan desa</p>
            </div>

        </div>
      </div>

    </div>

  </section><!-- /Alt Services Section -->

  <!-- Alt Services 2 Section -->


  </section><!-- /Alt Services 2 Section -->

<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection

