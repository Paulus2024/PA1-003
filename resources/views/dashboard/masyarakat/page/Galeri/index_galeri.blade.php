    @extends('dashboard.masyarakat.component.main')

    @section('masyarakat_content')

    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
            <div class="container position-relative">
                <h1>Galeri</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                        <li class="current">Galeri</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section id="projects" class="projects section">
            <div class="container">
                <h1 class="text-center mb-4">Galeri Kami</h1>
                <div class="row">
                    @php
                        $modalIdCounter = 0; // Inisialisasi counter untuk ID modal yang unik
                    @endphp
                    @forelse ($galleries as $item)
                        @php
                            $modalId = 'galleryModal' . $modalIdCounter++; // Buat ID unik untuk setiap modal
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4"> {{-- Menggunakan col-lg-4 dan col-md-6 untuk responsivitas lebih baik --}}
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="{{ $item->judul_galeri }}">
                                <div class="overlay">
                                    <span class="overlay-title">{{ Str::limit($item->judul_galeri, 30) }}</span>
                                    <button type="button" class="btn btn-sm btn-outline-light zoom-button" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                        {{-- Ganti dengan tag <i> jika menggunakan Font Awesome atau icon library lain --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                            <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                            <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        Zoom
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered"> {{-- modal-xl untuk gambar besar --}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{ $modalId }}Label">{{ $item->judul_galeri }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center"> {{-- text-center untuk gambar di tengah modal-body --}}
                                        <img src="{{ asset('storage/' . $item->gambar_galeri) }}" class="img-fluid" alt="{{ $item->judul_galeri }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Belum ada galeri yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <footer id="footer" class="footer dark-background">
            @include('pengguna.component.footer')
        </footer>

        {{-- CSS Kustom --}}
        <style>
            .gallery-item {
                position: relative;
                overflow: hidden;
                height: 250px; /* Tinggi default untuk item galeri */
                background-color: #e9ecef; /* Warna placeholder jika gambar lambat dimuat */
                border-radius: 0.375rem; /* Sedikit rounded corner, sesuaikan dengan tema Bootstrap */
                box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Bayangan halus */
            }

            .gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover; /* Memastikan gambar mengisi tanpa distorsi */
                display: block;
                transition: transform 0.35s ease-in-out;
            }

            .gallery-item:hover img {
                transform: scale(1.1); /* Efek zoom halus pada gambar thumbnail saat hover */
            }

            .gallery-item .overlay {
                position: absolute;
                top: 0; /* Ubah dari bottom ke top */
                left: 0;
                right: 0;
                bottom: 0; /* Memastikan overlay menutupi seluruh item */
                background-color: rgba(0, 0, 0, 0.6);
                color: white;
                opacity: 0; /* Sembunyikan secara default */
                transition: opacity 0.35s ease-in-out;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                padding: 15px;
            }

            .gallery-item:hover .overlay {
                opacity: 1; /* Tampilkan saat hover */
            }

            .gallery-item .overlay .overlay-title {
                font-size: 1rem;
                font-weight: 500;
                margin-bottom: 10px;
            }

            .gallery-item .overlay .zoom-button {
                /* Style untuk tombol zoom jika diperlukan */
                /* Misalnya, menambahkan border atau mengubah padding */
                /* Bootstrap class btn-sm dan btn-outline-light sudah cukup baik */
                display: inline-flex; /* Agar ikon dan teks sejajar */
                align-items: center;
            }

            .gallery-item .overlay .zoom-button svg {
                margin-right: 5px; /* Jarak antara ikon dan teks "Zoom" */
            }

            /* Styling untuk Modal (Bootstrap sudah menangani sebagian besar) */
            .modal-header {
                border-bottom: 1px solid #dee2e6;
            }
            .modal-title {
                color: #212529; /* Warna teks default Bootstrap */
            }
            .modal-body img {
                max-height: 80vh; /* Batasi tinggi gambar di modal agar tidak terlalu panjang */
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            /* Responsif untuk tinggi item galeri */
            @media (max-width: 991.98px) { /* Medium devices (tablet) */
                .gallery-item {
                    height: 220px;
                }
            }

            @media (max-width: 767.98px) { /* Small devices (landscape phones) */
                .gallery-item {
                    height: 200px;
                }
                .gallery-item .overlay .overlay-title {
                    font-size: 0.9rem;
                }
                .gallery-item .overlay .zoom-button {
                    font-size: 0.8rem;
                    padding: 0.25rem 0.5rem;
                }
            }

            @media (max-width: 575.98px) { /* Extra small devices (portrait phones) */
                .gallery-item {
                    height: 180px; /* Tinggi lebih kecil untuk mobile */
                }
            }
        </style>

    @endsection
