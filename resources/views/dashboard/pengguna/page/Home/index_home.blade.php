@extends('pengguna.main')

@section(section:'content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-6 text-center">
                <h2>Welcome To Desa Taonmarisi</h2>
                <p>In the heart of Taonmarisi, where the land meets the sky, hard work and tradition weave a story of unity and resilience.</p>

            </div>
            </div>
        </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="">
            </div>

            <div class="carousel-item active">
            <img src="assets/img/hero-carousel/hero-carousel-2.jpg" alt="">
            </div>

            <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-3.jpg" alt="">
            </div>

            <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-4.jpg" alt="">
            </div>

            <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-5.jpg" alt="">
            </div>

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>

    </section><!-- /Hero Section -->


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>
@endsection
