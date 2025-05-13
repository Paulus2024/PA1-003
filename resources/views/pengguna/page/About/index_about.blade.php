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

  <!-- About Section -->
  <section id="about" class="about section">

    <div class="container">

      <div class="row position-relative">

        <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200"><img src="assets/img/about.jpg"></div>

        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
          <h2 class="inner-title">Desa Taonmarisi</h2>
          <div class="our-story">
            <h4>Tahun Berdiri</h4>
            <h3>History</h3>
            <p>history</p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commo</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea</span></li>
            </ul>
            <p>Vitae autem velit excepturi fugit. Animi ad non. Eligendi et non nesciunt suscipit repellendus porro in quo eveniet. Molestias in maxime doloremque.</p>


          </div>
        </div>

      </div>

    </div>

  </section><!-- /About Section -->

  <!-- Stats Counter Section -->
  <section id="stats-counter" class="stats-counter section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Stats</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">

        <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-people color-pink flex-shrink-0"></i>
              <div>
                <p><b>Penduduk</b></p>
                <span data-purecounter-start="0" data-purecounter-end="15000" data-purecounter-duration="1" class="purecounter"></span>

              </div>
            </div>
          </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="fas fa-map color-green flex-shrink-0"></i>
            <div>
            <p><b>Luas Wilayah</b></p>
              <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
            </div>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="bi bi-people color-pink flex-shrink-0"></i>
            <div>
                <p><b>Perangkat Desa</b></p>
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
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
        <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="assets/img/alt-services.jpg" alt=""></div>

        <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <h3>VISI & MISI</h3>
          <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>

          <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-easel flex-shrink-0"></i>
            <div>
              <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-patch-check flex-shrink-0"></i>
            <div>
              <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-brightness-high flex-shrink-0"></i>
            <div>
              <h4><a href="" class="stretched-link">Dine Pad</a></h4>
              <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
            <i class="bi bi-brightness-high flex-shrink-0"></i>
            <div>
              <h4><a href="" class="stretched-link">Tride clov</a></h4>
              <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet. Et eligendi</p>
            </div>
          </div><!-- End Icon Box -->

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

