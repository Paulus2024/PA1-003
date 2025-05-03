@extends('pengguna.main')

@section('content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('pengguna.component.navbar')
</header>

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

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <form action="{{ route('contact') }}" method="POST">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <textarea name="message" class="form-control" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit"
                    style="
                      background-color: #ffc107;
                      color: black;
                      border: none;
                      padding: 12px 30px;
                      border-radius: 50px;
                      font-weight: 600;
                      font-size: 16px;
                      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                      transition: all 0.3s ease;
                    "
                    onmouseover="this.style.backgroundColor='#e0ac06'"
                    onmouseout="this.style.backgroundColor='#ffc107'">
                    Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div id="floating-message" style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #fff;
        color: #000;
        padding: 12px 18px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.15);
        z-index: 9999;
        display: none;
        font-weight: 500;
        max-width: 300px;
        font-size: 14px;
        line-height: 1.4;
        transition: opacity 0.5s ease;
    ">
    </div>

      </div>

    </section>

</main>

<footer id="footer" class="footer dark-background">
  @include('pengguna.component.footer')
</footer>

<script>
    const messages = @json(
      $allMessages->map(function($m) {
        return $m->email . " : " . $m->message;
      })
    );

    let i = 0;
    const box = document.getElementById("floating-message");

    function showMessage() {
      if (messages.length === 0) return;

      box.style.opacity = "0";
      box.style.display = "block";

      setTimeout(() => {
        box.textContent = messages[i];
        box.style.opacity = "1";
      }, 200);

      setTimeout(() => {
        box.style.opacity = "0";
      }, 2400);

      i = (i + 1) % messages.length;
    }

    showMessage();
    setInterval(showMessage, 3000);
  </script>

@endsection
