<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Desa Taon Marisi</title>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <style>
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body class="index-page">

    {{-- 1. INCLUDE NAVBAR --}}
    <header id="header" class="header d-flex align-items-center fixed-top">
        @include('dashboard.masyarakat.component.navbar')
    </header>
    {{-- 2. CONTENT --}}
    <main class="main">
        @yield('masyarakat_content')
    </main>

    {{-- 3. MODAL NOTIFIKASI --}}
    @if(auth()->check())
    @php
        $notes = auth()->user()->notifications()
        ->whereIn('type', ['peminjaman_disetujui', 'peminjaman_ditolak'])
        ->latest()
        ->get();
    @endphp

    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    @if ($notes->count())
                        <ul class="list-group">
                            @foreach ($notes as $note)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-bold">{{ $note->data['message'] }}</div>
                                        <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if (is_null($note->read_at))
                                        <form method="POST" action="{{ route('notifications.markAsRead', $note->id) }}">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-outline-primary">Tandai Sudah Dibaca</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center text-muted">Belum ada notifikasi</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    {{-- <a href="{{ route('notifications.index') }}" class="btn btn-primary">Lihat Semua</a> --}}
                </div>
            </div>
        </div>
    </div>
@endif

    {{-- 4. JS --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Tambahkan kode ini untuk me-load Sweetalert2 JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 2000, // Sesuaikan durasi tampilan
                    customClass: {
                        container: 'swal-custom', // Tambahkan class kustom
                        popup: 'swal-popup',
                        title: 'swal-title',
                        content: 'swal-content'
                    }
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ Session::get('error') }}',
                    customClass: {
                        container: 'swal-custom', // Tambahkan class kustom
                        popup: 'swal-popup',
                        title: 'swal-title',
                        content: 'swal-content'
                    }
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    customClass: {
                        container: 'swal-custom', // Tambahkan class kustom
                        popup: 'swal-popup',
                        title: 'swal-title',
                        content: 'swal-content'
                    }
                });
            @endif
        });
    </script>

</body>

</html>
