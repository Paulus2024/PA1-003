    {{-- 1 --}}
    {{-- @extends('dashboard.sekretaris.component.main')

    @section('sekretaris_content')
        <header id="header" class="header d-flex align-items-center fixed-top">
            @include('dashboard.sekretaris.component.navbar')
        </header>

        <!--Open Page Title-->
        <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
            <div class="container position-relative">
            <h1>Informasi</h1>
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
    <!-- End Page Title -->

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
                    <li><a href="/index_sekretaris">Home</a></li>
                    <li class="current">Informasi</li>
                    <li class="current">Pengumuman</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section id="blog-pagination" class="blog-pagination section mt-5">
        <div class="container">
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_sekretaris') ? 'active' : '' }}" href="{{ route('informasi.berita') }}"> Berita </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informasi_pengumuman') ? 'active' : '' }}" href="{{ route('informasi.pengumuman') }}"> Pengumuman </a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Blog Posts Section (Tabel) -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Judul Informasi</th>
                            <th>Deskripsi</th>
                            <th>Lampiran</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengumuman as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->judul_informasi }}</td>
                            <td>{{ Str::limit($item->deskripsi_informasi, 100, '...') }}</td>
                            <td>
                                @php
                                    $path = 'storage/' . $item->lampiran_informasi;
                                    $extension = pathinfo($item->lampiran_informasi, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset($path) }}" alt="Gambar Informasi" style="max-height: 80px;">
                                @elseif($extension === 'pdf')
                                    <a href="{{ asset($path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat PDF</a>
                                @elseif(in_array($extension, ['doc', 'docx']))
                                    <a href="{{ asset($path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <img src="{{ asset('assets/img/icon/word-icon.png') }}" alt="Dokumen Word" style="height:20px;"> Word File
                                    </a>
                                @else
                                    <a href="{{ asset($path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Download File</a>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->kategori_informasi }}</td>
                            <td>
                                @if($item->status_informasi == 1)
                                    <span class="badge bg-success">Publish</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_informasi }}">
                                    Edit
                                </button>
                                <form action="{{ route('sekretaris.informasi.destroy', $item->id_informasi) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL Edit -->
                        <div class="modal fade" id="editModal{{ $item->id_informasi }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_informasi }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('sekretaris.informasi.update', $item->id_informasi) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id_informasi }}">Edit Data Informasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul_informasi" class="form-label">Judul Informasi</label>
                                            <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" value="{{ $item->judul_informasi }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lampiran_informasi" class="form-label">Lampiran Informasi</label><br>
                                            @if ($item->lampiran_informasi)
                                                <p class="text-muted">File sebelumnya: <a href="{{ asset('storage/lampiran_informasi/' . $item->lampiran_informasi) }}" target="_blank">{{ $item->lampiran_informasi }}</a></p>
                                            @endif
                                            <input type="file" class="form-control" id="lampiran_informasi" name="lampiran_informasi">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi_informasi" class="form-label">Deskripsi Informasi</label><br>
                                            <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control w-100" rows="10">{{ $item->deskripsi_informasi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori_informasi" class="form-label">Kategori Informasi</label><br>
                                            <input type="radio" id="berita{{ $item->id_informasi }}" name="kategori_informasi" value="Berita" {{ $item->kategori_informasi == 'Berita' ? 'checked' : '' }} required>
                                            <label for="berita{{ $item->id_informasi }}">Berita</label><br>
                                            <input type="radio" id="pengumuman{{ $item->id_informasi }}" name="kategori_informasi" value="Pengumuman" {{ $item->kategori_informasi == 'Pengumuman' ? 'checked' : '' }} required>
                                            <label for="pengumuman{{ $item->id_informasi }}">Pengumuman</label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_informasi" class="form-label">Status Informasi</label><br>
                                            <input type="radio" id="draft{{ $item->id_informasi }}" name="status_informasi" value="0" {{ $item->status_informasi == 0 ? 'checked' : '' }}>
                                            <label for="draft{{ $item->id_informasi }}">Draft</label><br>
                                            <input type="radio" id="publish{{ $item->id_informasi }}" name="status_informasi" value="1" {{ $item->status_informasi == 1 ? 'checked' : '' }}>
                                            <label for="publish{{ $item->id_informasi }}">Publish</label><br>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END MODAL Edit -->
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Button Tambah -->
            <div class="col-12 mt-3">
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Informasi Desa</button>
                </div>
            </div>

            <!-- MODAL Tambah -->
            <div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('sekretaris.informasi.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="TambahGambar">Tambah Data Informasi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                <textarea name="deskripsi_informasi" id="deskripsi_informasi" class="form-control w-100" rows="10"></textarea>
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
                                <input type="radio" id="draft" name="status_informasi" value="0" checked>
                                <label for="draft">Draft</label><br>
                                <input type="radio" id="publish" name="status_informasi" value="1">
                                <label for="publish">Publish</label><br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END MODAL Tambah -->

        </div>
    </section>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
