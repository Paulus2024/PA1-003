@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')

<div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
    <div class="container position-relative">
        <h1>Data Pengurus Desa</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('index.masyarakat') }}">Home</a></li>
                <li class="current">Data Pengurus Desa</li>
            </ol>
        </nav>
    </div>
</div><section id="team" class="team section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Perangkat Desa</h2>
        <p>Bersama Membangun Masa Depan</p>
    </div>

    {{-- ========================================================== --}}
    {{-- ==    KODE BAGAN ORGANISASI (METODE STABIL & SIMETRIS)  == --}}
    {{-- ========================================================== --}}
    <div class="org-chart-container-stable">
        <div class="org-chart-stable">
            <ul>
                {{-- LEVEL 1: KEPALA DESA --}}
                <li>
                    @if($kepala_desa)
                    <div class="org-node">
                        <div class="org-node-img"><img src="{{ asset('storage/' . $kepala_desa->gambar_data_pengurus_desa) }}" alt="..."></div>
                        <div class="org-node-info"><h4>{{ $kepala_desa->nama_data_pengurus_desa }}</h4><span>{{ $kepala_desa->jabatan->nama_jabatan }}</span></div>
                    </div>
                    @endif

                    {{-- LEVEL 2: BAWAHAN LANGSUNG KEPALA DESA --}}
                    <ul>
                        {{-- CABANG 1: SEKRETARIS & BAWAHANNYA --}}
                        <li>
                            @if($sekretaris)
                            <div class="org-node">
                                <div class="org-node-img"><img src="{{ asset('storage/' . $sekretaris->gambar_data_pengurus_desa) }}" alt="..."></div>
                                <div class="org-node-info"><h4>{{ $sekretaris->nama_data_pengurus_desa }}</h4><span>{{ $sekretaris->jabatan->nama_jabatan }}</span></div>
                            </div>
                            @endif
                            {{-- LEVEL 3: KAUR DI BAWAH SEKRETARIS --}}
                            <ul>
                                @foreach($kaur_list as $kaur)
                                <li>
                                    <div class="org-node">
                                        <div class="org-node-img"><img src="{{ asset('storage/' . $kaur->gambar_data_pengurus_desa) }}" alt="..."></div>
                                        <div class="org-node-info"><h4>{{ $kaur->nama_data_pengurus_desa }}</h4><span>{{ $kaur->jabatan->nama_jabatan }}</span></div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        {{-- CABANG 2: KELOMPOK KASI --}}
                        <li>
                            <div class="org-node-group-title">Kepala Seksi</div>
                            <ul>
                                @foreach($kasi_list as $kasi)
                                <li>
                                    <div class="org-node">
                                        <div class="org-node-img"><img src="{{ asset('storage/' . $kasi->gambar_data_pengurus_desa) }}" alt="..."></div>
                                        <div class="org-node-info"><h4>{{ $kasi->nama_data_pengurus_desa }}</h4><span>{{ $kasi->jabatan->nama_jabatan }}</span></div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        {{-- CABANG 3: KELOMPOK KADUS --}}
                        <li>
                           <div class="org-node-group-title">Kepala Dusun</div>
                            <ul>
                                @foreach($kadus_list as $kadus)
                                <li>
                                    <div class="org-node">
                                        <div class="org-node-img"><img src="{{ asset('storage/' . $kadus->gambar_data_pengurus_desa) }}" alt="..."></div>
                                        <div class="org-node-info"><h4>{{ $kadus->nama_data_pengurus_desa }}</h4><span>{{ $kadus->jabatan->nama_jabatan }}</span></div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</section>

<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
