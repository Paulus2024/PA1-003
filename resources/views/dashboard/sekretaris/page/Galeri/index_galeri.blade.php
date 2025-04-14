@extends('dashboard.sekretaris.component.main')

@section(section:'sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>Projects</h1>
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
    @foreach($galleries as $item)
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="{{asset('storage/' . $item->image_path)}}" class="img-fluid" alt="Gambar 1">
                <div class="overlay">{{STR::limit(value: $item->title, limit: 50)}}</div>
                <div class="d-flex gap-2">
                    <!-- Tautan ke halaman edit -->
                    <!-- Tombol Edit buka modal -->
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_galeri }}">
                        Edit
                    </button>

                    <!-- Form hapus --><!-- A (sesuaikan dengan nama route di web.php) -->
                    <form action="{{ route('sekretaris.galleries.destroy', $item->id_galeri) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Edit untuk masing-masing fasilitas - Tambah ini: Modal edit dalam loop -->
        <div class="modal fade" id="editModal{{ $item->id_galeri }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_galeri }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('sekretaris.galleries.update', $item->id_galeri) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id_galeri }}">Edit Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul_galeri" class="form-label">Judul Galeri</label>
                            <input type="text" class="form-control" name="judul_galeri" value="{{ $item->judul_galeri }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_galeri" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="gambar_galeri">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    @endforeach

    <!-- Tombol untuk menambah fasilitas baru -->
    <div class="col-12">
        <div class="d-grid gap-2">
                                            <!-- A (sesuaikan dengan nama route di web.php) -->
            {{-- <a href="{{ route('sekretaris.galleries.create') }}" class="btn btn-success" type="button">Tambah Gambar Galeri</a> --}}
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahGambar">Tambah Gambar Galeri</button>
            </div>
    </div>

    </div><!-- End Portfolio Container -->
</div>

    <!--Open MODAL Create(Tambah)-->
<div class="modal fade" id="TambahGambar" tabindex="-1" aria-labelledby="tambahgambar"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahGambar">Tambah Data Galeri Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form action="/upload-gambar" method="POST" enctype="multipart/form-data"> --}}
                    <form action="{{ route('sekretaris.galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="nama_galeri" class="form-label">Judul Galeri</label>
                        <input type="text" class="form-control" id="nama_galeri" name="nama_galeri" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_galeri" class="form-label">Upload Gambar</label>
                        <input type="file" class="form-control" id="gambar_galeri" name="gambar_galeri"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!--Close MODAL Create(Tambah)-->


<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
