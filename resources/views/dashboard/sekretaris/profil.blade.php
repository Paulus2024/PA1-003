@extends('pengguna.main')

@section('content')
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0">Profile Settings</h5>
                    </div>

                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('sekretaris.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="profile-image-container text-center">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                                 class="rounded-circle mb-3"
                                                 width="150" height="150" alt="Profile Photo">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3"
                                                 style="width: 150px; height: 150px;">
                                                <span class="text-muted">No photo</span>
                                            </div>
                                        @endif
                                        <input type="file" name="profile_photo" class="form-control form-control-sm">
                                        <small class="text-muted">JPEG or PNG, max 2MB</small>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ old('name', $user->name) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="border-top pt-4 mb-4">
                                <h6 class="mb-3">Password Settings</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control">
                                        <small class="text-muted">Leave blank to keep current password</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end pt-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .profile-image-container {
        position: relative;
    }

    .profile-image-container img,
    .profile-image-container div {
        object-fit: cover;
        border: 1px solid #dee2e6;
    }

    .card {
        border-radius: 0.375rem;
    }

    .form-control {
        border-radius: 0.375rem;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        min-width: 120px;
    }
</style>
@endpush
