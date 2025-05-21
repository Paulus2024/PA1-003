<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard Admin - Desa Taon Marisi</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
    }
    .sidebar {
        height: 100vh;
        background-color: #343a40;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 60px;
        width: 240px;
    }
    .sidebar a {
        color: #adb5bd;
        padding: 12px;
        display: block;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #495057;
        color: #fff;
    }
    .content {
        margin-left: 240px;
        padding: 20px;
    }
    .navbar {
        margin-left: 240px;
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
    }
  </style>
</head>

<body>

    <!-- Main Content -->
    <div class="content pt-3 mt-1">
        @yield('sekretaris_content')
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
