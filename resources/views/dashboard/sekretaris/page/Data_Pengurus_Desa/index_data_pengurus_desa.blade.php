@extends('dashboard.sekretaris.component.main')

@section(section:'sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>About</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="current">Data Pengurus Desa</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Team Section -->
  <section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Team</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">
@foreach($data_pengurus_desas as $item)
      <div class="row gy-5">

        <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img">
            <img src="{{asset('storage/' . $item->gambar_data_pengurus_desa)}}" class="img-fluid" alt="">
          </div>
          <div class="member-info text-center">
            <h4>{{$item ->nama_data_pengurus_desa}}</h4>
            <span>{{$item ->jabatan_data_pengurus_desa}}</span>
            <p>{{$item ->deskripsi_data_pengurus_desa}}</p>
          </div>
        </div><!-- End Team Member -->
        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_data_pengurus_desa }}">
            Edit
        </button>

        <form action="{{ route('sekretaris.fasilitas.destroy', $item->id_data_pengurus_desa) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Hapus</button>
        </form>
    </div>

    </div>
    <!DOCTYPE html>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Edit Data Pengurus Desa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sekretaris.fasilitas.update', $item->id_data_pengurus_desa) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $item->id_data_pengurus_desa }}">Edit Data Pengurus Desa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pengurus Desa</label>
                                <input type="text" class="form-control" id="nama" value="{{$item ->nama_data_pengurus_desa}}">
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" value="{{$item ->jabatan_data_pengurus_desa}}">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3">Deskripsi tentang pengurus desa.</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar">
                                <small class="form-text text-muted">Upload gambar baru jika ingin mengubah.</small>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div> {{-- TUTUP TAG DIV ROW --}}

<!-- Tombol untuk menambah fasilitas baru -->
<div class="col-12">
    <div class="d-grid gap-2">
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#TambahData">Tambah Data Pengurus Desa</button>
        </div>
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
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label for="nama_data_pengurus_desa" class="form-label">Nama Pengurus</label>
                    <input type="text" class="form-control" id="nama_data_pengurus_desa" name="nama_data_pengurus_desa" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan_data_pengurus_desa" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan_data_pengurus_desa" name="jabatan_data_pengurus_desa" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_data_pengurus_desa" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi_data_pengurus_desa" name="deskripsi_data_pengurus_desa" required>
                </div>
                <div class="mb-3">
                    <label for="gambar_data_pengurus_desa" class="form-label">Upload Gambar</label>
                    <input type="file" class="form-control" id="gambar_data_pengurus_desa" name="gambar_data_pengurus_desa"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
<!--Close MODAL Create(Tambah)-->
</section><!-- /Team Section -->


  <footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
