@extends('pengguna.main')

@section(section:'content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>

<<<<<<< HEAD
<main class="main">
    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Contact</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
=======
<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>Contact</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="/">Home</a></li>
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
>>>>>>> 491effbde52a5b3152f1ebee7b02eed31c970369
    </div>

    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p>info@example.com</p>
            </div>
          </div>

        </div>

        <div class="row gy-4 mt-1">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.112121113212!2d98.60123097496523!3d2.3822116575372917!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031f1087b89306f%3A0x9b6c3b0085a0b447!2sTaonmarisi%2C%20Silaen%2C%20Toba%2C%20Sumatera%20Utara!5e0!3m2!1sen!2sid!4v1714317000000!5m2!1sen!2sid"
            frameborder="0"
            style="border:0; width: 100%; height: 400px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </section>

  </main>

  <footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
