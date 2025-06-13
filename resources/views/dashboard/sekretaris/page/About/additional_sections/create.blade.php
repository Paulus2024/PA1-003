@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <div class="container">
        <h2>Tambah Bagian Tambahan Baru untuk About ID: {{ $about->id }}</h2>
        <form action="{{ route('abouts.additional-sections.store', $about->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                {{-- ID "content" ini yang akan ditarget oleh TinyMCE --}}
            </div>

            <div class="mb-3">
                <label for="media_file" class="form-label">Media File (Gambar/Video)</label>
                <input type="file" class="form-control" id="media_file" name="media_file" accept="image/*,video/*">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('abouts.additional-sections.index', $about->id) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    {{-- TinyMCE Initialization (pastikan Anda sudah menyertakan CDN TinyMCE di main.blade.php atau di sini) --}}
    <script src="https://cdn.tiny.cloud/1/YOUR_TINYMCE_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content', // Targetkan ID textarea konten
            plugins: 'lists link image code autoresize',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            menubar: false
        });
    </script>
@endsection
