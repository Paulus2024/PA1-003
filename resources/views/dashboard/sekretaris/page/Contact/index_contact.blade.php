@extends('dashboard.sekretaris.component.main')

@section(section:'sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>Contact</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="/index_sekretaris">Home</a></li>
          <li class="current">Contact</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Contact Section -->
  <section id="contact" class="contact section">
    <div class="container contact-section">
        <h1 class="text-center mb-5">Kontak Kami</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card contact-card text-center">
                    <div class="card-body">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="card-title">Alamat</h5>
                        <p class="card-text">Jl. Contoh No. 123, Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card contact-card text-center">
                    <div class="card-body">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5 class="card-title">Telepon</h5>
                        <p class="card-text">+62 812 3456 7890</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card contact-card text-center">
                    <div class="card-body">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5 class="card-title">Email</h5>
                        <p class="card-text">info@contoh.com</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="contact-form">
                    <h3 class="text-center mb-4">Kirim Pesan</h3>
                    <form>
                        <div class="form-row d-flex gap-3">
                            <div class="form-group col-md-6">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" placeholder="Nama Anda" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email Anda" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Pesan</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  </section><!-- /Contact Section -->


  <footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
