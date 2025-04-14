@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <!--Open Page Title-->
    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
        <h1>Informasi Desa</h1>
        <nav class="breadcrumbs">
            <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="current">Informasi</li>
            </ol>
        </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4">
{{-- Colom Di Looping Aforeach --}}
                @foreach ($informasi as $item)
                    <div class="col-lg-4">
                        <article class="position-relative h-100">

                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/' .$item->lampiran_informasi)}}" class="img-fluid" alt="">
                                {{-- <span class="post-date">December 12</span> --}}
                                <span class="post-date">{{ $item->created_ad->format('F d') }}</span>
                            </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">{{ $item->judul_informasi}}</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">John Doe</span>{{-- INI  --}}
                                </div>

                                <span class="px-3 text-black-50">/</span>

                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                                </div>
                            </div>

                            <p>
                                Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                            </p>

                            <hr>

                            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </article>
                    </div><!-- End post list item -->
                @endforeach

            </div>
        </div>

    </section><!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

        <div class="container">
        <div class="d-flex justify-content-center">
            <ul>
            <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#" class="active">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li>...</li>
            <li><a href="#">10</a></li>
            <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
            </ul>
        </div>
        </div>

    </section><!-- /Blog Pagination Section -->

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>

@endsection
