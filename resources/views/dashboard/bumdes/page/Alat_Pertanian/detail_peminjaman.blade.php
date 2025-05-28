@extends('dashboard.bumdes.component.main')

@section('bumdes_content')

<style>
    body {
        background-color: #ffffff; /* Latar belakang gelap */
        color: #ffffff; /* Teks berwarna putih */
    }
    .card {
        background-color: #cecece; /* Warna latar belakang kartu */
        border: 1px solid #444; /* Menambahkan border pada kartu */
        border-radius: 10px; /* Membuat sudut kartu lebih bulat */
        transition: transform 0.2s, box-shadow 0.2s; /* Animasi saat hover */
    }
    .card:hover {
        transform: scale(1.02); /* Efek zoom saat hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Bayangan saat hover */
    }
    .card-title {
        color: #f0ad4e; /* Warna judul kartu */
    }
    .form-label {
        font-weight: bold; /* Membuat label lebih tebal */
    }
    .btn {
        border-radius: 20px; /* Membuat tombol lebih bulat */
        transition: background-color 0.3s, box-shadow 0.3s; /* Animasi saat hover */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Bayangan tombol */
    }
    .btn:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); /* Bayangan saat hover */
    }
    .btn-secondary {
        background-color: #6c757d; /* Warna tombol kembali */
    }
    .btn-secondary:hover {
        background-color: #5a6268; /* Warna tombol kembali saat hover */
    }
    .btn-success {
        background-color: #5cb85c; /* Warna tombol setujui */
    }
    .btn-success:hover {
        background-color: #4cae4c; /* Warna tombol setujui saat hover */
    }
    .container {
        margin-top: 50px; /* Memberikan jarak atas */
    }
    h1 {
        font-family: 'Arial', sans-serif; /* Mengubah font judul */
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7); /* Menambahkan bayangan pada teks */
    }
    .img-fluid {
        transition: transform 0.3s; /* Animasi saat hover pada gambar */
    }
    .img-fluid:hover {
        transform: scale(1.05); /* Efek zoom pada gambar saat hover */
    }
</style>

<div class="container">
    <h1 class="text-center mb-4">Detail Peminjaman</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Informasi Peminjaman</h5>

                    <div class="mb-3">
                        <label class="form-label">ID Peminjaman:</label>
                        <p>{{ $peminjaman->id }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Peminjam:</label>
                        <p>{{ $peminjaman->nama_peminjam }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alat Pertanian:</label>
                        <p>{{ $peminjaman->alat->nama_alat_pertanian }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pinjam:</label>
                        <p>{{ $peminjaman->tanggal_pinjam }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali:</label>
                        <p>{{ $peminjaman->tanggal_kembali }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Alat yang Dipinjam:</label>
                        <p>{{ $peminjaman->jumlah_alat_di_sewa }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Peminjaman:</label>
                        <p>{{ $peminjaman->status_peminjaman }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User  ID:</label>
                        <p>{{ $peminjaman->user_id }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dibuat Pada:</label>
                        <p>{{ $peminjaman->created_at }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diupdate Pada:</label>
                        <p>{{ $peminjaman->updated_at }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('alat_pertanian.index') }}" class="btn btn-secondary">Kembali ke Daftar Peminjaman</a>
                        @if($peminjaman->status_peminjaman == 'menunggu')
                        <a href="{{ route('pemesanan.history', $peminjaman->id) }}" class="btn btn-success">Kontrol</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Informasi Alat</h5>
                    <img src="{{ asset('storage/' . $peminjaman->alat->gambar_alat) }}" alt="Gambar Alat" class="img-fluid mb-3">
                    <p class="card-text"><b>Nama:</b> {{ $peminjaman->alat->nama_alat_pertanian }}</p>
                    <p class="card-text"><b>Jenis:</b> {{ $peminjaman->alat->jenis_alat_pertanian }}</p>
                    <p class="card-text"><b>Harga Sewa:</b> {{ $peminjaman->alat->harga_sewa }}</p>
                    <!-- Tambahkan informasi alat lainnya sesuai kebutuhan -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
