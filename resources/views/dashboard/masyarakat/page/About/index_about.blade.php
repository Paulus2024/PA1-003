@extends('dashboard.masyarakat.component.main')
@section('masyarakat_content')
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
        <div class="container position-relative">
            <h1>About</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                    <li class="current">About</li>
                </ol>
            </nav>
        </div>
    </div>

    @if ($about)
        {{-- BAGIAN 1: KATA SAMBUTAN --}}
        <section id="about" class="about section">
            <div class="container">
                <div class="row position-relative align-items-center">
                    {{-- PERUBAHAN TIDAK ADA DI SINI --}}
                    <div class="col-lg-6 about-img" data-aos="zoom-out" data-aos-delay="200">
                        @if ($about->media_file)
                            @php
                                $extension = pathinfo($about->media_file, PATHINFO_EXTENSION);
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                            @endphp
                            @if (in_array($extension, $imageExtensions))
                                <img src="{{ Storage::url($about->media_file) }}" class="img-fluid" alt="Media Utama">
                            @elseif (in_array($extension, $videoExtensions))
                                <video controls class="img-fluid" style="max-height: 400px;">
                                    <source src="{{ Storage::url($about->media_file) }}" type="video/{{ $extension }}">
                                    Browser Anda tidak mendukung video.
                                </video>
                            @else
                                <img src="{{ asset('assets/img/about.jpg') }}" alt="Gambar Default" class="img-fluid">
                            @endif
                        @else
                            <img src="{{ asset('assets/img/about.jpg') }}" alt="Gambar Default" class="img-fluid">
                        @endif
                    </div>
                    {{-- PERUBAHAN TIDAK ADA DI SINI --}}
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="inner-title">Kata Sambutan Kepala Desa</h2>

                        <div class="our-story text-justify expandable-text">
                            {!! $about->kata_sambutan_kepala_desa !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- BAGIAN 2: SEJARAH DESA --}}
        <section id="sejarah" class="sejarah-khusus section">
            <div class="container">
                <div class="row position-relative align-items-center">

                    <div class="col-lg-6 about-img" data-aos="zoom-out" data-aos-delay="200">
                        @if ($about->gambar_1)
                            <img src="{{ Storage::url($about->gambar_1) }}" class="img-fluid" alt="Gambar Sejarah">
                        @else
                            <img src="{{ asset('assets/img/about.jpg') }}" alt="Gambar Default" class="img-fluid">
                        @endif
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="inner-title">Sejarah Desa</h2>
                        <div class="our-story text-justify expandable-text">
                            {!! $about->sejarah !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- BAGIAN STATS COUNTER (TIDAK ADA PERUBAHAN) --}}
        <section id="stats-counter" class="stats-counter section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-people color-pink flex-shrink-0"></i>
                            <div>
                                <p><b>Penduduk</b></p>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $about->jumlah_penduduk }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="fas fa-map color-green flex-shrink-0"></i>
                            <div>
                                <p><b>Luas Wilayah</b></p>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $about->luas_wilayah }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-people color-pink flex-shrink-0"></i>
                            <div>
                                <p><b>Perangkat Desa</b></p>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $about->jumlah_perangkat_desa }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- BAGIAN 3: VISI & MISI --}}
        <section id="visi-misi" class="alt-services section">
            <div class="container">
                <div class="row justify-content-around gy-4 align-items-center">
                    {{-- PERUBAHAN TIDAK ADA DI SINI --}}
                    <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        @if ($about->gambar_2)
                            <img src="{{ Storage::url($about->gambar_2) }}" alt="Gambar Visi Misi" class="img-fluid">
                        @else
                            <img src="{{ asset('assets/img/alt-services.jpg') }}" alt="Placeholder Gambar"
                                class="img-fluid">
                        @endif
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <h3>VISI & MISI</h3>
                        <h4>Visi:</h4>
                        <div class="expandable-text">{!! $about->visi !!}</div>

                        <h4>Misi:</h4>
                        <div class="expandable-text">{!! $about->misi !!}</div>
                    </div>
                </div>
            </div>
        </section>


        {{-- BAGIAN 4: ADDITIONAL SECTIONS --}}
        @if ($about->additionalSections->isNotEmpty())
            <section id="additional-sections" class="section">
                <div class="container">
                    @foreach ($about->additionalSections as $index => $section)
                        <div class="row align-items-center gy-4 mb-5" data-aos="fade-up">
                            @php
                                // Membuat variabel untuk konten teks
                                $textContent =
                                    '
                            <div class="col-lg-6">
                                <h3>' .
                                    e($section->title) .
                                    '</h3>
                                <div class="text-justify expandable-text">' .
                                    $section->content .
                                    '</div>
                            </div>';

                                // Membuat variabel untuk konten media (gambar/video)
                                $mediaContent = '';
                                if ($section->media_file) {
                                    $extension = pathinfo($section->media_file, PATHINFO_EXTENSION);
                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                    $mediaUrl = Storage::url($section->media_file);
                                    $mediaTitle = e($section->title);
                                    $mediaElement = '<p class="text-muted">File media tidak dapat ditampilkan.</p>';
                                    if (in_array($extension, $imageExtensions)) {
                                        $mediaElement =
                                            '<img src="' .
                                            $mediaUrl .
                                            '" alt="' .
                                            $mediaTitle .
                                            '" class="img-fluid rounded">';
                                    } elseif (in_array($extension, $videoExtensions)) {
                                        $mediaElement =
                                            '<video controls class="img-fluid rounded"><source src="' .
                                            $mediaUrl .
                                            '" type="video/' .
                                            $extension .
                                            '">Browser Anda tidak mendukung video.</video>';
                                    }
                                    $mediaContent = '<div class="col-lg-6">' . $mediaElement . '</div>';
                                } else {
                                    $mediaContent =
                                        '<div class="col-lg-6"><img src="' .
                                        asset('assets/img/alt-services.jpg') .
                                        '" alt="Placeholder Gambar" class="img-fluid rounded"></div>';
                                }
                            @endphp

                            {{-- UBAH DI SINI: Hapus logika @if dan selalu tampilkan teks terlebih dahulu --}}
                            {!! $textContent !!}
                            {!! $mediaContent !!}

                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- BAGIAN 5: Fasilitas --}}
        @if ($fasilitas_terbaru && $fasilitas_terbaru->isNotEmpty())
            <section id="fasilitas-unggulan" class="projects section">
                <div class="container" data-aos="fade-up">

                    <div class="section-header">
                        <h2>Fasilitas</h2>
                    </div>

                    <div class="row gy-4">
                        {{-- Lakukan perulangan untuk setiap item fasilitas --}}
                        @foreach ($fasilitas_terbaru as $fasilitas)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up"
                                data-aos-delay="{{ $loop->iteration * 100 }}">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $fasilitas->gambar_fasilitas) }}"
                                        class="card-img-top" alt="{{ $fasilitas->nama_fasilitas }}"
                                        style="height: 250px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $fasilitas->nama_fasilitas }}</h5>
                                        {{-- Anda bisa tambahkan deskripsi singkat jika mau --}}
                                        {{-- <p class="card-text">{{ Str::limit($fasilitas->deskripsi_fasilitas, 50) }}</p> --}}
                                    </div>
                                    {{-- Jika ingin ada link ke detail (opsional) --}}
                                    {{-- <div class="card-footer">
                                <a href="#" class="btn btn-sm btn-primary">Lihat Detail</a>
                            </div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Tombol untuk melihat semua fasilitas --}}
                    <div class="text-center mt-5">
                        {{-- Pastikan route 'fasilitas.masyarakat' sudah ada di file web.php Anda --}}
                        <a href="{{ route('fasilitas.masyarakat') }}" class="btn btn-primary">Lihat Semua Fasilitas</a>
                    </div>

                </div>
            </section>
        @endif

        {{-- ! Bagian 6: Galeri --}}
        @if ($gallery_terbaru && $gallery_terbaru->isNotEmpty())
        <section id="gallery-preview" class="projects section bg-light">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Galeri Kegiatan</h2>
                    <p>Dokumentasi visual dari berbagai kegiatan dan momen berharga di desa kami.</p>
                </div>

                <div class="row gy-4">
                    {{-- Perulangan untuk setiap item galeri --}}
                    @foreach ($gallery_terbaru as $item)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                            {{-- INI ADALAH "BINGKAI" ATAU KONTAINER GAMBAR --}}
                            <div class="gallery-preview-item">
                                {{-- DAN INI ADALAH GAMBARNYA --}}
                                <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="{{ $item->judul_galeri }}">
                                <div class="preview-overlay">
                                    <span>{{ Str::limit($item->judul_galeri, 40) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('galeri.masyarakat') }}" class="btn btn-primary">Lihat Galeri Lengkap</a>
                </div>

            </div>
        </section>
    @endif
    @else
        {{-- PERUBAHAN TIDAK ADA DI SINI --}}
        <section class="section">
            <div class="container">
                <p class="text-center">Informasi profil desa belum tersedia.</p>
            </div>
        </section>
    @endif

    {{-- PERUBAHAN TIDAK ADA DI SINI --}}
    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>

@endsection

{{-- UBAH: Seluruh blok @push('styles') di bawah ini adalah TAMBAHAN BARU. --}}
@push('styles')
    <style>
        /* CSS untuk styling link "Baca Selengkapnya" */
        .read-more-link {
            color: #007bff;
            /* Warna biru, bisa disesuaikan */
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
            /* Agar margin-top berfungsi */
            margin-top: 10px;
        }

        .read-more-link:hover {
            text-decoration: underline;
            color: #0056b3;
            /* Warna biru lebih gelap saat hover */
        }
    </style>
@endpush

{{-- UBAH: Seluruh blok @push('scripts') di bawah ini adalah TAMBAHAN BARU. --}}
@push('scripts')
    <script>
        // UBAH: Event listener ini ditambahkan untuk memastikan skrip berjalan setelah semua elemen HTML dimuat.
        document.addEventListener("DOMContentLoaded", function() {
            // UBAH: Variabel WORD_LIMIT ditambahkan untuk mengatur batas kata dengan mudah.
            // Di sinilah Anda mengatur batas kata. Ubah angka 30 jika perlu.
            const WORD_LIMIT = 75;

            // UBAH: Logika perulangan ini ditambahkan untuk mencari semua elemen yang perlu fitur "Baca Selengkapnya".
            document.querySelectorAll('.expandable-text').forEach(container => {
                // UBAH: Variabel ini ditambahkan untuk mendapatkan teks bersih (tanpa HTML) untuk perhitungan kata.
                const textForCounting = container.textContent || container.innerText;
                const words = textForCounting.trim().split(/\s+/).filter(Boolean);

                // UBAH: Kondisi 'if' ini ditambahkan untuk memeriksa apakah teks melebihi batas kata.
                if (words.length > WORD_LIMIT) {
                    // UBAH: Menyimpan HTML asli dari elemen.
                    const originalHtml = container.innerHTML;

                    // UBAH: Membuat versi singkat dari teks.
                    const shortText = words.slice(0, WORD_LIMIT).join(' ') + '...';

                    // UBAH: Mengubah konten elemen menjadi versi singkat.
                    container.innerHTML = `<div>${shortText}</div>`;

                    // UBAH: Membuat elemen <a> baru untuk link "Baca Selengkapnya".
                    const readMoreLink = document.createElement('a');
                    readMoreLink.href = '#';
                    readMoreLink.className = 'read-more-link';
                    readMoreLink.innerText = 'Baca Selengkapnya';

                    // UBAH: Menempatkan link setelah elemen teks.
                    container.insertAdjacentElement('afterend', readMoreLink);

                    // UBAH: Menambahkan variabel 'flag' untuk melacak status (diperluas/diciutkan).
                    let isExpanded = false;

                    // UBAH: Event listener klik ditambahkan ke link.
                    readMoreLink.addEventListener('click', (e) => {
                        e.preventDefault(); // Mencegah perilaku default link.
                        isExpanded = !isExpanded; // Toggle status.

                        if (isExpanded) {
                            // UBAH: Mengembalikan HTML asli dan mengubah teks link.
                            container.innerHTML = originalHtml;
                            readMoreLink.innerText = 'Baca Lebih Sedikit';
                        } else {
                            // UBAH: Mengembalikan teks singkat dan mengubah teks link.
                            container.innerHTML = `<div>${shortText}</div>`;
                            readMoreLink.innerText = 'Baca Selengkapnya';
                        }
                    });
                }
            });
        });
    </script>
@endpush


{{--! Galeri --}}
@push('styles')
<style>
    .gallery-preview-item {
        position: relative;
        display: block;
        overflow: hidden; /* Penting untuk memotong bagian gambar yang berlebih */
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);

        /* * KUNCI #1: Menetapkan Tinggi yang Seragam untuk "Bingkai".
         * Semua bingkai akan memiliki tinggi 250px.
        */
        height: 250px;
    }

    .gallery-preview-item img {
        /*
         * KUNCI #2: Membuat Gambar Mengisi Penuh Bingkai.
         * width & height 100% membuat gambar berusaha mengisi bingkai.
         * object-fit: cover adalah "sihir"-nya. Ia menjaga rasio aspek gambar
         * dan memotong bagian yang tidak perlu agar bingkai terisi penuh tanpa distorsi.
        */
        width: 100%;
        height: 100%;
        object-fit: cover;

        transition: transform 0.4s ease;
    }

    .gallery-preview-item:hover img {
        transform: scale(1.1);
    }

    .gallery-preview-item .preview-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        color: #fff;
        padding: 2rem 1rem 1rem 1rem;
        font-weight: 500;
        transition: opacity 0.4s ease;
    }
</style>
@endpush
