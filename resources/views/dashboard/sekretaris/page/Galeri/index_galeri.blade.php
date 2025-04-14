@extends('dashboard.sekretaris.component.main')

@section(section:'sekretaris_content')
<header id="header" class="header d-flex align-items-center fixed-top">
    @include('dashboard.sekretaris.component.navbar')
</header>

<div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>Projects</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="current">Galeri</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Projects Section -->
  <section id="projects" class="projects section">

    <div class="container">
        <h1 class="text-center mb-4">Galeri Kami</h1>
    @foreach($galleries as $item)
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="{{asset('storage/' . $item->image_path)}}" class="img-fluid" alt="Gambar 1">
                <div class="overlay">{{$item->title}}</div>
            </div>
        </div>

        <form action=""></form>

    @endforeach


<footer id="footer" class="footer dark-background">
    @include('pengguna.component.footer')
</footer>

@endsection
