@extends('pengguna.main')

@section(section:'content')
<section>
    <div class="container">
        <h2>Edit Profil Sekretaris</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('sekretaris.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            </div>

            <div class="mb-3">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="mb-3">
                <label>Foto Profil</label><br>
                @if($user->profile_photo)
                    <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" width="100">
                @endif
                <input type="file" name="profile_photo" class="form-control mt-2">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</section>

@endsection
