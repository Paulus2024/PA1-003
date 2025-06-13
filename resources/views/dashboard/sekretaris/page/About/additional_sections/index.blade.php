@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
    <div class="container">
        <h2>Kelola Bagian Tambahan untuk About ID: {{ $about->id }}</h2>
        <a href="{{ route('abouts.additional-sections.create', $about->id) }}" class="btn btn-primary mb-3">Tambah Bagian Baru</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($additionalSections->isEmpty())
            <p>Belum ada bagian tambahan untuk About ini.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Konten Singkat</th>
                        <th>Media</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($additionalSections as $index => $section)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $section->title }}</td>
                            <td>{!! Str::limit(strip_tags($section->content), 100) !!}</td>
                            <td>
                                @if ($section->media_file)
                                    @php
                                        $extension = pathinfo($section->media_file, PATHINFO_EXTENSION);
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                                        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv'];
                                    @endphp

                                    @if (in_array($extension, $imageExtensions))
                                        <img src="{{ Storage::url($section->media_file) }}" alt="Media" class="img-thumbnail" style="max-width: 60px;">
                                    @elseif (in_array($extension, $videoExtensions))
                                        <video controls width="60" height="auto" class="video-thumbnail">
                                            <source src="{{ Storage::url($section->media_file) }}" type="video/{{ $extension }}">
                                        </video>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('abouts.additional-sections.edit', [$about->id, $section->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('abouts.additional-sections.destroy', [$about->id, $section->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
