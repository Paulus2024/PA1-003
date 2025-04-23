@extends('pengguna.main')

@section('content')
<div class="nature-gradient-bg">
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm bg-white bg-opacity-90">
                        <div class="card-header bg-transparent border-bottom py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-dark">Profile Settings</h5>
                            <a href="/index_sekretaris" class="text-dark {{ Request::is('index_sekretaris') ? 'active' : '' }}">← Dashboard</a>
                        </div>

                        <div class="card-body p-4">
                            @if(session('success'))
                                <div class="alert alert-success mb-4 border-0 shadow-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mb-4 border-0 shadow-sm">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('sekretaris.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-4 align-items-center">
                                    <div class="col-md-4 text-center mb-3 mb-md-0">
                                        <div class="profile-image-container mx-auto">
                                            @if($user->profile_photo)
                                                <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                                    class="rounded-circle shadow-sm mb-3"
                                                    width="150" height="150" alt="Profile Photo">
                                            @else
                                                <div class="rounded-circle bg-light bg-opacity-50 d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                                    style="width: 150px; height: 150px;">
                                                    <span class="text-muted">No photo</span>
                                                </div>
                                            @endif
                                            <label class="btn btn-sm btn-outline-primary w-100">
                                                Change Photo
                                                <input type="file" name="profile_photo" class="d-none" accept="image/*">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label text-dark">Full Name</label>
                                            <input type="text" name="name" class="form-control shadow-sm"
                                                   value="{{ old('name', $user->name) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label text-dark">Email Address</label>
                                            <input type="email" name="email" class="form-control shadow-sm"
                                                   value="{{ old('email', $user->email) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top pt-4 mb-4">
                                    <h6 class="mb-3 text-dark">Password Settings</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-dark">New Password</label>
                                            <input type="password" name="password" class="form-control shadow-sm">
                                            <small class="text-muted">Leave blank to keep current password</small>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-dark">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control shadow-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end pt-3">
                                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
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
</div>
@endsection

@push('styles')
<style>
    .nature-gradient-bg {
        background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 25%, #80deea 50%, #4dd0e1 75%, #26c6da 100%);
        min-height: 100vh;
    }

    .profile-image-container {
        position: relative;
        max-width: 150px;
    }

    .profile-image-container img,
    .profile-image-container div {
        object-fit: cover;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .card {
        border-radius: 12px;
        backdrop-filter: blur(5px);
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid rgba(0,0,0,0.1);
        background-color: rgba(255,255,255,0.8);
    }

    .form-control:focus {
        background-color: white;
        box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
    }

    .btn-primary {
        background-color: #26c6da;
        border-color: #00acc1;
        border-radius: 8px;
        min-width: 120px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #00acc1;
        transform: translateY(-1px);
    }

    .btn-outline-primary {
        border-color: #26c6da;
        color: #26c6da;
    }

    .btn-outline-primary:hover {
        background-color: #26c6da;
        color: white;
    }

    .alert {
        border-radius: 8px;
    }
</style>
@endpush
