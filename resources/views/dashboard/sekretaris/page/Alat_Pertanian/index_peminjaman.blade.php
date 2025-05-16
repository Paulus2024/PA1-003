@extends('dashboard.sekretaris.component.main')

@section('sekretaris_content')
<main class="p-4">
  <h1>Daftar Peminjaman Alat</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>Nama Alat</th>
        <th>Peminjam</th>
        <th>Periode</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($peminjaman as $p)
        <tr>
          <td>{{ $p->alat->nama_alat_pertanian }}</td>
          <td>{{ $p->peminjam }}</td>
          <td>{{ $p->tanggal_pinjam }} s/d {{ $p->tanggal_kembali }}</td>
          <td>{{ ucfirst($p->status) }}</td>
          <td>
            @if($p->status === 'dipinjam')
              <form action="{{ route('alat_pertanian.kembali', $p->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm btn-primary">
                  Kembalikan
                </button>
              </form>
            @else
              <span class="text-muted">Sudah dikembalikan</span>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</main>
@endsection
