@extends('pengguna.main')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Profile</h5>
                <a href="/dashboard" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Dashboard
                </a>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="">
                    <small class="text-muted">Minimum 8 Characters</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    @if(auth()->user()->photo)
                        <div class="mt-3">
                            <img src="{{ asset('storage/profile_photos/' . auth()->user()->photo) }}"
                                 width="100" class="rounded-circle border">
                        </div>
                    @endif
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                @if(auth()->user()->photo)
                <form action="{{ route('profile.photo.delete') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-1"></i> Delete Photo
                    </button>
                </form>
                @else
                <div></div>
                @endif

                <form action="{{ route('profile.account.delete') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus akun secara permanen?')">
                        <i class="bi bi-exclamation-triangle me-1"></i> Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
