@extends('layouts.app')
@section('content')
    <section class="section galeri bg-galeri">
        <div class="container" data-aos="fade-up">
            <div class="row galeri-container">
                <div class="galeri-title">
                    <h4>{{ $album->name }}</h4>
                </div>
                @foreach ($detail as $d)
                    <div class="col-lg-4 col-md-6 galeri-item filter-app">
                        <div class="galeri-wrap">
                            <img src="{{ url('storage/album', $d->image) }}" class="img-galeri" alt="">
                            <div class="galeri-links">
                                <a href="{{ url('storage/album', $d->image) }}" data-gallery="portfolioGallery"
                                    class="galeri-lightbox"><i class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
