@extends('pengguna.main')

@section('content')
<div class="profile-edit-container">
    <!-- Animated background elements -->
    <div class="bg-animation">
        <div class="stars">
            @for($i = 0; $i < 30; $i++)
                <div class="star" style="
                    top: {{ rand(0, 100) }}%;
                    left: {{ rand(0, 100) }}%;
                    width: {{ rand(1, 3) }}px;
                    height: {{ rand(1, 3) }}px;
                    animation-delay: {{ rand(0, 5) }}s;
                "></div>
            @endfor
        </div>
        <div class="meteors">
            @for($i = 0; $i < 5; $i++)
                <div class="meteor" style="
                    top: {{ rand(0, 30) }}%;
                    left: {{ rand(0, 30) }}%;
                    animation-delay: {{ rand(0, 10) }}s;
                "></div>
            @endfor
        </div>
        <div class="floating-elements">
            <div class="floating-circle" style="
                top: 15%;
                left: 5%;
                width: 100px;
                height: 100px;
                animation-delay: 0s;
            "></div>
            <div class="floating-circle" style="
                top: 70%;
                left: 80%;
                width: 150px;
                height: 150px;
                animation-delay: 2s;
            "></div>
            <div class="floating-triangle" style="
                top: 30%;
                left: 85%;
                animation-delay: 4s;
            "></div>
            <div class="floating-square" style="
                top: 75%;
                left: 10%;
                animation-delay: 1s;
            "></div>
        </div>
    </div>

    <div class="profile-card glassmorphism">
        <div class="profile-header">
            <h3 class="profile-title">
                <i class="bi bi-person-gear"></i> Edit Profil
            </h3>

            <a href="/dashboard" class="btn btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success animate-pop">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="profile-form">
            @csrf

            <div class="form-group floating-input">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" placeholder=" ">
                <label for="name">Nama Lengkap</label>
                <i class="bi bi-person input-icon"></i>
            </div>

            <div class="form-group floating-input">
                <input type="password" name="password" id="password" class="form-control" placeholder=" ">
                <label for="password">Password Baru</label>
                <i class="bi bi-lock input-icon"></i>
                <small class="form-text">(Kosongkan jika tidak ingin mengubah)</small>
            </div>

            <div class="form-group floating-input">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder=" ">
                <label for="password_confirmation">Konfirmasi Password</label>
                <i class="bi bi-lock-fill input-icon"></i>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="bi bi-image"></i> Foto Profil
                </label>
                <div class="photo-upload-box" id="photoUploadBox">
                    <input type="file" name="photo" id="photo" class="file-upload">
                    <label for="photo" class="upload-label">
                        <div class="upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <span class="upload-text">Pilih atau tarik file ke sini</span>
                        @if(auth()->user()->photo)
                            <div class="current-photo-preview">
                                <img src="{{ asset('storage/profile_photos/' . auth()->user()->photo) }}" alt="Current Photo">
                            </div>
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save animate-hover">
                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                </button>
            </div>
        </form>

        <div class="danger-zone">
            <h4><i class="bi bi-exclamation-triangle-fill"></i> Zona Berbahaya</h4>
            <div class="danger-actions">
                @if(auth()->user()->photo)
                <form action="{{ route('profile.photo.delete') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning animate-hover">
                        <i class="bi bi-trash-fill"></i> Hapus Foto Profil
                    </button>
                </form>
                @endif

                <form action="{{ route('profile.account.delete') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger animate-hover" onclick="return confirm('Apakah Anda yakin ingin menghapus akun secara permanen? Semua data akan hilang!')">
                        <i class="bi bi-exclamation-octagon-fill"></i> Hapus Akun
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Base Styles */
    .profile-edit-container {
        position: relative;
        min-height: 100vh;
        padding: 2rem;
        overflow: hidden;
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Animated Background Elements */
    .bg-animation {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    /* Stars */
    .star {
        position: absolute;
        background-color: #fff;
        border-radius: 50%;
        animation: twinkle 5s infinite ease-in-out;
    }

    @keyframes twinkle {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 1; }
    }

    /* Meteors */
    .meteor {
        position: absolute;
        width: 300px;
        height: 1px;
        background: linear-gradient(90deg, rgba(255,255,255,0.8), rgba(255,255,255,0));
        transform: rotate(-45deg);
        animation: meteor-fall 10s linear infinite;
    }

    @keyframes meteor-fall {
        0% {
            transform: translateX(0) translateY(0) rotate(-45deg);
            opacity: 1;
        }
        70% {
            opacity: 1;
        }
        100% {
            transform: translateX(1000px) translateY(1000px) rotate(-45deg);
            opacity: 0;
        }
    }

    /* Floating Shapes */
    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(100, 200, 255, 0.1);
        border: 1px solid rgba(100, 200, 255, 0.3);
        animation: float 15s infinite ease-in-out;
    }

    .floating-triangle {
        position: absolute;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-bottom: 100px solid rgba(255, 100, 100, 0.1);
        animation: float 12s infinite ease-in-out reverse;
    }

    .floating-square {
        position: absolute;
        width: 80px;
        height: 80px;
        background: rgba(100, 255, 200, 0.1);
        border: 1px solid rgba(100, 255, 200, 0.3);
        animation: float 18s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-50px) rotate(5deg);
        }
    }

    /* Glassmorphism Card */
    .glassmorphism {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    /* Profile Card */
    .profile-card {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        padding: 2.5rem;
        color: #fff;
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .profile-title {
        font-weight: 600;
        font-size: 1.8rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(-5px);
    }

    /* Form Styles */
    .profile-form {
        margin-top: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.8rem;
        position: relative;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.8rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Floating Input */
    .floating-input {
        position: relative;
    }

    .floating-input .form-control {
        width: 100%;
        padding: 1.2rem 1rem 0.8rem 2.5rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        color: #fff;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .floating-input .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.5);
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    }

    .floating-input label {
        position: absolute;
        top: 1rem;
        left: 2.5rem;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .floating-input .input-icon {
        position: absolute;
        left: 1rem;
        top: 1.1rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .floating-input .form-control:focus + label,
    .floating-input .form-control:not(:placeholder-shown) + label {
        top: 0.4rem;
        left: 2.5rem;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .form-text {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Photo Upload */
    .photo-upload-box {
        position: relative;
        border: 2px dashed rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .photo-upload-box:hover {
        border-color: rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.05);
    }

    .file-upload {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }

    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .upload-icon {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .upload-text {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1rem;
    }

    .current-photo-preview {
        margin-top: 1rem;
    }

    .current-photo-preview img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Buttons */
    .btn-save {
        background: linear-gradient(135deg, #00b4db, #0083b0);
        color: white;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #0083b0, #00b4db);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 131, 176, 0.4);
    }

    /* Danger Zone */
    .danger-zone {
        margin-top: 3rem;
        padding: 1.5rem;
        background: rgba(255, 0, 0, 0.1);
        border-radius: 10px;
        border-left: 4px solid #ff6b6b;
    }

    .danger-zone h4 {
        color: #ff6b6b;
        margin-top: 0;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .danger-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ff9a00, #ff6b00);
        color: white;
        padding: 0.7rem 1.5rem;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #ff6b00, #ff9a00);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 107, 0, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
        color: white;
        padding: 0.7rem 1.5rem;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #ff4b2b, #ff416c);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
    }

    /* Animations */
    .animate-pop {
        animation: popIn 0.5s ease-out;
    }

    @keyframes popIn {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        80% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-hover {
        transition: all 0.3s ease;
    }

    .animate-hover:hover {
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-card {
            padding: 1.5rem;
        }

        .profile-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .danger-actions {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>

<script>
    // Add animation when file is selected
    document.getElementById('photo').addEventListener('change', function(e) {
        const uploadBox = document.getElementById('photoUploadBox');
        if (this.files.length > 0) {
            uploadBox.style.borderColor = '#4CAF50';
            uploadBox.style.boxShadow = '0 0 0 3px rgba(76, 175, 80, 0.3)';

            setTimeout(() => {
                uploadBox.style.borderColor = 'rgba(255, 255, 255, 0.5)';
                uploadBox.style.boxShadow = 'none';
            }, 1000);
        }
    });
</script>
@endsection
