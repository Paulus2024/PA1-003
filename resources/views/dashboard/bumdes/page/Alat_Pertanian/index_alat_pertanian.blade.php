@extends('dashboard.bumdes.component.main')

@section('bumdes_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.bumdes.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>Projects</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="current">Projects</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Projects Section -->
<main id="main">
  <section id="projects" class="projects section">

    <div class="container">

      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-remodeling">Olah Lahan</li>
          <li data-filter=".filter-construction">Pascapanen</li>
        </ul><!-- End Portfolio Filters -->

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

  @if($alat_pertanian->isEmpty())
    <div class="col-12">
      <p class="text-danger text-center">Tidak ada data alat pertanian.</p>
    </div>
  @endif

          @foreach ($alat_pertanian as $item)
          <!-- Open Content -->
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-remodeling">
            <article class="position-relative h-100">

                <!-- Wrapper konten gambar -->
                <div class="portfolio-content h-100">

                <!-- 🔽 Gambar dengan efek hover -->
                <div class="img-hover-zoom">
                    <!-- <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="Foto Galeri">-->
                    <img src="{{ asset('storage/' . $item->gambar_alat) }}" class="img-fluid" alt="Foto {{ $item->nama_alat_pertanian }}">
                </div>

                <!-- Informasi yang tampil saat hover (jika ada) -->
                <div class="portfolio-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4> {{$item->jenis_alat_pertanian}} </h4><!-- jenis alat pertanian -->
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_alat_pertanian}}">
                                Edit
                            </button>

                            <form action="{{ route('bumdes.alat_pertanian.destroy', $item->id_alat_pertanian) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <p>{{ $item->catatan }}</p><!-- Catatan Khusus -->
                    <a href="{{ asset('storage/' . $item->gambar_alat) }}" title="{{ $item->jenis_alat_pertanian }}" data-gallery="portfolio-gallery-app" class="glightbox preview-link">
                    <i class="bi bi-zoom-in"></i>
                    </a>
                    <a href="/detail_galeri" title="More Details" class="details-link">
                    <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
                </div>

                <!-- 🔽 Keterangan Tambahan di Bawah Gambar -->
                <div class="mt-3 p-3 bg-white shadow-sm rounded-0">
                <h5 class="fw-bold text-warning"> {{ $item->nama_alat_pertanian }} </h5><!-- Nama Alat -->
                <p class="text-secondary"> {{ $item->harga_sewa }} </p><!-- Harga Sewa -->
                <p class="text-secondary">{{ $item->status_alat }}|{{ $item->jumlah_alat }} </p><!-- Status -->

                {{--<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<!{{ $item->id_fasilitas }}">--}}
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#SewaAlatModal{{ $item->id_alat_pertanian}}">
                        Sewa Alat
                    </button>
                </div>
                {{-- <div class="d-flex gap-2">
                    <a href="/edit" class="btn btn-outline-warning">Edit</a>
                    <form action="/hapus" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div> --}}
                </div>

            </article>
          </div>
          <!-- Close Content -->
          @endforeach

            {{-- <div class="col-12">
                <div class="d-grid gap-2">
                                                    <!-- A (sesuaikan dengan nama route di web.php) -->
                    {{-- <a href="{{ route('sekretaris.fasilitas.create') }}" class="btn btn-success" type="button">Tambah Gambar Fasilitas Desa</a> --}}
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Gambar Alat Pertanian</button>
                </div>
            </div> --}}/////////////////////////////////

        </div><!-- End Portfolio Container -->

      </div>


    </div>

  </section><!-- /Projects Section -->

</main>

  <footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
