@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <div class="container">
        <h2>Edit Bagian Tambahan untuk About ID: {{ $about->id }}</h2>
        <form action="{{ route('abouts.additional-sections.update', [$about->id, $section->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $section->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $section->content) }}</textarea>
                {{-- ID "content" ini yang akan ditarget oleh TinyMCE --}}
            </div>

            <div class="mb-3">
                <label for="media_file" class="form-label">Media File (Gambar/Video)</label>
                <input type="file" class="form-control" id="media_file" name="media_file" accept="image/*,video/*">
                @if ($section->media_file)
                    <p class="mt-2">Media Saat Ini:</p>
                    @php
                        $extension = pathinfo($section->media_file, PATHINFO_EXTENSION);
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                    @endphp

                    @if (in_array($extension, $imageExtensions))
                        <img src="{{ Storage::url($section->media_file) }}" alt="Media File Saat Ini" class="img-preview-modal">
                    @elseif (in_array($extension, $videoExtensions))
                        <video controls class="video-preview-modal">
                            <source src="{{ Storage::url($section->media_file) }}" type="video/{{ $extension }}">
                            Browser Anda tidak mendukung video.
                        </video>
                    @endif
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_media_file" id="remove_media_file" value="1">
                        <label class="form-check-label" for="remove_media_file">Hapus Media File</label>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('abouts.additional-sections.index', $about->id) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    {{-- TinyMCE Initialization --}}
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
