{{-- 1 --}}
{{-- @extends('dashboard.sekretaris.component.main')

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

                <div class="col-lg-4"><article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                    <img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt="">
                    <span class="post-date">December 12</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                    <h3 class="post-title">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia</h3>

                    <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <i class="bi bi-person"></i> <span class="ps-2">John Doe</span>
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

                <div class="col-lg-4">
                <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                    <img src="assets/img/blog/blog-2.jpg" class="img-fluid" alt="">
                    <span class="post-date">March 19</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                    <h3 class="post-title">Nisi magni odit consequatur autem nulla dolorem</h3>

                    <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-folder2"></i> <span class="ps-2">Economics</span>
                        </div>
                    </div>

                    <p>
                        Incidunt voluptate sit temporibus aperiam. Quia vitae aut sint ullam quis illum voluptatum et. Quo libero rerum voluptatem pariatur nam.
                    </p>

                    <hr>

                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </article>
                </div><!-- End post list item -->

                <div class="col-lg-4">
                <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                    <img src="assets/img/blog/blog-3.jpg" class="img-fluid" alt="">
                    <span class="post-date">June 24</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                    <h3 class="post-title">Possimus soluta ut id suscipit ea ut. In quo quia et soluta libero sit sint.</h3>

                    <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <i class="bi bi-person"></i> <span class="ps-2">Maria Doe</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-folder2"></i> <span class="ps-2">Sports</span>
                        </div>
                    </div>

                    <p>
                        Aut iste neque ut illum qui perspiciatis similique recusandae non. Fugit autem dolorem labore omnis et. Eum temporibus fugiat voluptate enim tenetur sunt omnis.
                    </p>

                    <hr>

                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </article>
                </div><!-- End post list item -->

                <div class="col-lg-4">
                <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                    <img src="assets/img/blog/blog-4.jpg" class="img-fluid" alt="">
                    <span class="post-date">August 05</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                    <h3 class="post-title">Non rem rerum nam cum quo minus. Dolor distinctio deleniti explicabo eius exercitationem.</h3>

                    <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <i class="bi bi-person"></i> <span class="ps-2">Maria Doe</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-folder2"></i> <span class="ps-2">Sports</span>
                        </div>
                    </div>

                    <p>
                        Aspernatur rerum perferendis et sint. Voluptates cupiditate voluptas atque quae. Rem veritatis rerum enim et autem. Saepe atque cum eligendi eaque iste omnis a qui.
                    </p>

                    <hr>

                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </article>
                </div><!-- End post list item -->

                <div class="col-lg-4">
                <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                    <img src="assets/img/blog/blog-5.jpg" class="img-fluid" alt="">
                    <span class="post-date">September 17</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                    <h3 class="post-title">Accusamus quaerat aliquam qui debitis facilis consequatur</h3>

                    <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <i class="bi bi-person"></i> <span class="ps-2">John Parker</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                        </div>
                    </div>

                    <p>
                        In itaque assumenda aliquam voluptatem qui temporibus iusto nisi quia. Autem vitae quas aperiam nesciunt mollitia tempora odio omnis. Ipsa odit sit ut amet necessitatibus. Quo ullam ut corrupti autem consequuntur totam dolorem.
                    </p>

                    <hr>

                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </article>
                </div><!-- End post list item -->

                <div class="col-lg-4">
                <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                    <img src="assets/img/blog/blog-6.jpg" class="img-fluid" alt="">
                    <span class="post-date">December 07</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                    <h3 class="post-title">Distinctio provident quibusdam numquam aperiam aut</h3>

                    <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                        <i class="bi bi-person"></i> <span class="ps-2">Julia White</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-folder2"></i> <span class="ps-2">Economics</span>
                        </div>
                    </div>

                    <p>
                        Expedita et temporibus eligendi enim molestiae est architecto praesentium dolores. Illo laboriosam officiis quis. Labore officia quia sit voluptatem nisi est dignissimos totam. Et voluptate et consectetur voluptatem id dolor magni impedit. Omnis dolores sit.
                    </p>

                    <hr>

                    <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </article>
                </div><!-- End post list item -->

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

@endsection --}}

{{-- 2 --}}
{{-- @extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <!-- Open Page Title -->
    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>Informasi Desa</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Informasi</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Open Blog -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4">
                @foreach ($informasi as $item)
                    <div class="col-lg-4">
                        <article class="position-relative h-100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $item->lampiran_informasi) }}" class="img-fluid" alt="">
                                <span class="post-date">{{ $item->created_at->format('F d') }}</span>
                            </div>
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $item->judul_informasi }}</h3>
                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                           <i class="bi bi-folder2"></i> <span class="ps-2">{{ $item->kategori_informasi }}</span><!-- ini  -->
                                    </div>
                                </div>
                                <p>{{ \Illuminate\Support\Str::limit($item->deskripsi_informasi, 100, '...') }}</p>
                                <hr>
                                <a href="#" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Blog -->

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection --}}

{{-- 3 --}}
{{-- @extends('dashboard.sekretaris.component.main')
@section('sekretaris_content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.sekretaris.component.navbar')
    </header>

    <div class="page-title dark-background" style="background-img: url(assets/img/page-title-bg.jpg);">


    </div> --}}

    {{-- 4 --}}
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
            <li class="current">Berita</li>
            </ol>
        </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4">
    <!-- Colom Di Looping Aforeach -->
                @foreach ($berita as $item)
                    <div class="col-lg-4">
                        <article class="position-relative h-100">

                            <div class="post-img position-relative overflow-hidden">
                                {{-- <img src="{{ asset('storage/' .$item->lampiran_informasi)}}" class="img-fluid" alt=""> --}}
                                <!-- <span class="post-date">December 12</span> -->
                                <!--open-->
                                @php
                                    $path = 'storage/' . $item->lampiran_informasi;
                                    $extension = pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($path) }}" class="img-fluid" alt="Gambar Informasi">
                                @elseif($extension === 'pdf')
                                    <iframe src="{{ asset($path) }}" width="100%" height="300px"></iframe>
                                @elseif(in_array($extension, ['doc', 'docx']))
                                    <a href="{{ asset($path) }}" target="_blank">
                                        <img src="{{ asset('assets/img/icon/word-icon.png') }}" alt="Dokumen Word" style="height:100px;">
                                        <p>Lihat Dokumen Word</p>
                                    </a>
                                @else
                                    <a href="{{ asset($path) }}" target="_blank">Download File</a>
                                @endif
                                <!--close-->
                                <span class="post-date">{{ $item->created_at->format('F d') }}</span>
                            </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">{{ $item->judul_informasi }}</h3>

                            <p>
                                {{ $item->deskripsi_informasi }}
                            </p>

                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_informasi }}">
                                Edit
                            </button>

                        </div>

                    </article>
                    </div><!-- End post list item -->

                    <!-- Open MODAL Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_informasi }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('sekretaris.informasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                    <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label><br>
                                    <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label><br>
                                    <textarea name="deskripsi_informasi" id="deskripsi_informasi" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_informasi" class="form-label">Kategori Informasi</label><br>
                                    <input type="radio" id="berita" name="kategori_informasi" value="Berita" required>
                                    <label for="berita">Berita</label><br>
                                    <input type="radio" id="pengumuman" name="kategori_informasi" value="Pengumuman" required>
                                    <label for="pengumuman">Pengumuman</label>
                                </div>
                                <div class="mb-3">
                                    <label for="status_informasi" class="form-label">Status Informasi</label><br>
                                    <input type="radio" id="draft" name="status_informasi" value="0">
                                    <label for="draft">Draft</label><br>
                                    <input type="radio" id="publish" name="status_informasi" value="1">
                                    <label for="publish">Publish</label><br>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Close MODAL Edit -->
                @endforeach
                <!-- End Colom Di Looping Aforeach -->

                <!-- Open Button To Modal -->
                <div class="col-12">
                    <div class="d-grid gap-2">
                                                    <!-- A (sesuaikan dengan nama route di web.php) -->
                    {{-- <a href="{{ route('sekretaris.fasilitas.create') }}" class="btn btn-success" type="button">Tambah Gambar Fasilitas Desa</a> --}}
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Informasi Desa</button>
                    </div>
                </div>
                <!-- End Button To Modal -->

            </div>
        </div>

        <!--Open MODAL Create(Tambah)-->
    <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahGambar">Tambah Data Informasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <form action="/upload-gambar" method="POST" enctype="multipart/form-data"> -->
                    <form action="{{ route('sekretaris.informasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mb-3">
                            <label for="judul_informasi" class="form-label">Judul Informasi</label>
                            <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label><br>
                            <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label><br>
                            <textarea name="deskripsi_informasi" id="deskripsi_informasi" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_informasi" class="form-label">Kategori Informasi</label><br>
                            <input type="radio" id="berita" name="kategori_informasi" value="Berita" required>
                            <label for="berita">Berita</label><br>
                            <input type="radio" id="pengumuman" name="kategori_informasi" value="Pengumuman" required>
                            <label for="pengumuman">Pengumuman</label>
                        </div>
                        <div class="mb-3">
                            <label for="status_informasi" class="form-label">Status Informasi</label><br>
                            <input type="radio" id="draft" name="status_informasi" value="0">
                            <label for="draft">Draft</label><br>
                            <input type="radio" id="publish" name="status_informasi" value="1">
                            <label for="publish">Publish</label><br>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--Close MODAL Create(Tambah)-->

    </section><!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

        <div class="container">
        <div class="d-flex justify-content-center">
            <ul>
                <li><a href="{{ route('informasi.berita')}}" class="{{ Request::is('informasi_sekretaris') ? 'active' : '' }}">Berita</a></li>
                <li><a href="{{ route('informasi.pengumuman')}}" class="{{ Request::is('informasi_pengumuman') ? 'active' : '' }}">Pengumuman</a></li>
            </ul>
        </div>
        </div>

    </section><!-- /Blog Pagination Section -->

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>

@endsection
