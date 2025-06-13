<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Desa Taon Marisi</title>

    {{-- ASET CSS VENDOR --}}
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- ASET CSS FANCYBOX --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    {{-- CSS UTAMA ANDA --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    {{-- CSS KUSTOM UNTUK GALERI & PERBAIKAN FANCYBOX --}}
    <style>
        /* ==================================================================
           STYLING UNTUK THUMBNAIL GALERI (DI HALAMAN UTAMA)
           ================================================================== */
        .gallery-item-link {
            display: block;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #f0f0f0;
        }

        .gallery-item-link .gallery-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .gallery-item-link:hover .gallery-image {
            transform: scale(1.1);
        }

        .gallery-item-link .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
        }

        .gallery-item-link:hover .overlay {
            opacity: 1;
        }

        .overlay-title {
            font-size: 1.2rem;
            font-weight: 600;
            transform: translateY(10px);
            transition: transform 0.3s ease;
        }

        .zoom-icon {
            font-size: 1.5rem;
            margin-top: 10px;
            transform: translateY(10px);
            transition: transform 0.3s ease 0.1s;
        }

        .gallery-item-link:hover .overlay-title,
        .gallery-item-link:hover .zoom-icon {
            transform: translateY(0);
        }

        /* ==================================================================
           MEMBUAT UKURAN LIGHTBOX (ZOOM) KONSISTEN - VERSI FANCYBOX
           ================================================================== */
        .fancybox__slide {
            max-width: 85vw;
            max-height: 85vh;
            padding: 2rem;
        }

        .fancybox__image,
        .fancybox-image {
            /* Menargetkan dua kemungkinan nama class */
            width: 100%;
            height: 100%;
            object-fit: cover !important;
            /* Memaksa gambar menutupi bingkai */
            border-radius: 8px;
        }
    </style>

    <!-- Data Pengurus Desa -->
    <style>
        /* ========================================================== */
        /* ==   KODE CSS BAGAN ORGANISASI (METODE STABIL FINAL)    == */
        /* ========================================================== */

        /* WADAH UTAMA */
        .org-chart-container-stable {
            width: 100%;
            overflow-x: auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .org-chart-stable {
            display: inline-block; /* Agar container bisa di-scroll */
            min-width: 100%;
        }

        /* STRUKTUR DASAR UL/LI */
        .org-chart-stable ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            list-style-type: none;
        }
        .org-chart-stable li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
            transition: all 0.5s;
        }

        /* MENGGAMBAR GARIS PENGHUBUNG DENGAN PSEUDO-ELEMENT */
        .org-chart-stable li::before, .org-chart-stable li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #ccc;
            width: 50%;
            height: 20px;
        }
        .org-chart-stable li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #ccc;
        }

        /* Sembunyikan garis yang tidak perlu */
        .org-chart-stable li:only-child::after, .org-chart-stable li:only-child::before {
            display: none;
        }
        .org-chart-stable li:first-child::before, .org-chart-stable li:last-child::after {
            border: 0 none;
        }
        .org-chart-stable li:last-child::before {
            border-right: 2px solid #ccc;
            border-radius: 0 5px 0 0;
        }
        .org-chart-stable li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        /* Atur posisi anak */
        .org-chart-stable ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #ccc;
            width: 0;
            height: 20px;
        }
        .org-chart-stable li > div {
            margin-bottom: 20px;
        }

        /* Mengatur agar elemen LI tidak float dan menggunakan FLEXBOX */
        .org-chart-stable ul {
            display: flex;
            justify-content: center;
        }
        .org-chart-stable li {
            float: none; /* Matikan float */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* STYLING NODE (TETAP SAMA) */
        .org-node { width: 180px; text-align: center; }
        .org-node-img { width: 90px; height: 90px; border-radius: 50%; border: 4px solid #007bff; overflow: hidden; background-color: #f0f0f0; position: relative; z-index: 10; margin: 0 auto; }
        .org-node-img img { width: 100%; height: 100%; object-fit: cover; }
        .org-node-info { background-color: #0d47a1; color: #fff; padding: 55px 10px 10px 10px; border-radius: 10px; margin-top: -45px; width: 100%; min-height: 80px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; justify-content: center; }
        .org-node-info h4 { font-size: 1rem; font-weight: bold; margin: 0; color: #fff; }
        .org-node-info span { font-size: 0.85rem; color: #ddd; }

        /* Styling untuk judul grup (Kasi & Kadus) */
        .org-node-group-title {
            font-weight: bold;
            font-size: 1.1rem;
            color: #555;
            margin-bottom: -15px; /* Tarik ke atas agar lebih dekat dengan garis */
        }

    </style>

    @stack('styles')

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.masyarakat.component.navbar')
    </header>

    <main class="main">
        @yield('masyarakat_content')
    </main>

    @if (auth()->check())
        {{-- Kode modal notifikasi Anda bisa ditaruh di sini jika ada --}}
    @endif

    {{-- ASET JS VENDOR --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>

    {{-- ASET JS FANCYBOX --}}
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    {{-- JS UTAMA ANDA (JANGAN LUPA HAPUS KODE GLIGHTBOX DI DALAM FILE INI) --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- SCRIPT GLOBAL & INISIALISASI --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi FancyBox
            Fancybox.bind("[data-fancybox]", {
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: [],
                        right: ["thumbs", "close"],
                    },
                },
            });

            // Inisialisasi SweetAlert
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 2000,
                });
            @endif
        });
    </script>

    @stack('scripts')
</body>

</html>
