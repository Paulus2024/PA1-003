<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard Admin - Desa Taon Marisi</title>

    {{-- Font dari Google --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    {{-- Aset CSS Vendor --}}
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    {{-- Style Kustom --}}
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

    <div class="content pt-3 mt-1">
        @yield('sekretaris_content')
    </div>

    {{-- =======================================================
    * BAGIAN SKRIP JAVASCRIPT
    * Diletakkan sebelum penutup </body>
    ======================================================== --}}

    {{-- Aset JS Vendor --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Skrip TinyMCE dari CDN --}}
    {{-- Pastikan API Key ini milik Anda --}}
    <script src="https://cdn.tiny.cloud/1/pfv8vma5vquu02hd25mu4w9t01xoma7j1rffoz1em3egdr10/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    {{-- Skrip Kustom (SweetAlert & Inisialisasi TinyMCE) --}}
    <script>
        // Menjalankan skrip setelah seluruh halaman HTML selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {

            /*
            |--------------------------------------------------------------------------
            | Logika untuk Notifikasi (SweetAlert)
            |--------------------------------------------------------------------------
            */
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif


            /*
            |--------------------------------------------------------------------------
            | Logika untuk Editor TinyMCE
            |--------------------------------------------------------------------------
            */
            // Fungsi untuk menginisialisasi TinyMCE pada selector tertentu
            const initTinyMCE = (selector) => {
                tinymce.init({
                    selector: selector,
                    plugins: 'advlist autolink lists link image charmap preview anchor',
                    toolbar_mode: 'floating',
                    setup: function(editor) {
                        // Pastikan data di textarea asli selalu terupdate saat ada perubahan
                        editor.on('change', function() {
                            tinymce.triggerSave();
                        });
                    }
                });
            };

            // Inisialisasi editor untuk modal "Tambah" yang memiliki ID statis
            initTinyMCE('#deskripsi_informasi_new.tinymce-editor');

            // Dapatkan semua elemen modal yang ada di halaman
            const allModals = document.querySelectorAll('.modal');

            // Untuk setiap modal yang ditemukan, tambahkan event listener
            allModals.forEach(modal => {
                // 'shown.bs.modal' adalah event dari Bootstrap yang aktif SETELAH modal ditampilkan
                modal.addEventListener('shown.bs.modal', function(event) {

                    // Cari textarea dengan class .tinymce-editor DI DALAM modal yang sedang aktif
                    const textarea = modal.querySelector('.tinymce-editor');

                    if (textarea) {
                        const textareaId = '#' + textarea.id;

                        // Hapus instance TinyMCE sebelumnya untuk menghindari error duplikasi
                        if (tinymce.get(textarea.id)) {
                            tinymce.remove(textareaId);
                        }

                        // Inisialisasi ulang TinyMCE pada textarea di modal yang baru saja dibuka
                        initTinyMCE(textareaId);
                    }
                });
            });

        });
    </script>


    {{-- Bagian ini akan digunakan untuk menyisipkan script dari child view (jika ada) --}}
    @stack('scripts')

</body>

</html>
