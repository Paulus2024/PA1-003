@extends('pengguna.main')

@section('content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-6 text-center">
                <h2 class="cambria-font">Welcome To Desa Taonmarisi</h2>
                <p class="cambria-font">In the heart of Taonmarisi, where the land meets the sky, hard work and tradition weave a story of unity and resilience.</p>
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

    <style>
        /* Cambria Font */
        .cambria-font {
            font-family: Cambria, Georgia, serif;
            font-weight: normal;
            letter-spacing: 0.5px;
        }

        h2.cambria-font {
            font-size: 2.5rem;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        p.cambria-font {
            font-size: 1.2rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h2.cambria-font {
                font-size: 2rem;
            }
            p.cambria-font {
                font-size: 1.1rem;
                padding: 0 20px;
            }
        }
    </style>
@endsection
