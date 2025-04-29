@extends('pengguna.main')

@section('content')
<div class="container mt-5">
    <h2>Pengaturan Profil</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
        </div>
        <div class="mb-3">
            <label>Password Baru (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <hr>

    <form method="POST" action="{{ route('profile.photo') }}" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="mb-3">
            <label>Upload Foto Profil Baru</label>
            <input type="file" name="profile_photo" class="form-control">
        </div>
        <button class="btn btn-secondary">Upload Foto</button>
    </form>

    @if (Auth::user()->profile_photo)
        <form method="POST" action="{{ route('profile.delete.photo') }}" class="mb-3">
            @csrf
            <button class="btn btn-warning">Hapus Foto Profil</button>
        </form>
    @endif

    <form method="POST" action="{{ route('profile.delete.account') }}">
        @csrf
        <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus akun?')">Hapus Akun</button>
    </form>
</div>
@endsection
