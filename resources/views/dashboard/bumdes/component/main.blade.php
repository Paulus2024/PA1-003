<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - UpConstruction Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{URL:: asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL:: asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{URL:: asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{URL:: asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{URL:: asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{URL:: asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


<link href="{{URL:: asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <main class="main">
        @yield('bumdes_content')
    </main>



<!-- Vendor JS Files -->
<script src="{{URL:: asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{URL:: asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

<!-- Main JS File -->
<script src="{{URL:: asset('assets/js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });
</script>


</body>

</html>
