@extends('layouts.app')
@section('content')
    <section class="section about-services spad bg-body-tertiary">
        <div class="container">
            <div class="section-title center-title">
                <h2>Album Foto</h2>
                <h1>Album Foto</h1>
            </div>
            <div class="row-image">
                @foreach ($album as $a)
                    <div class="card-image">
                        <a href="{{ route('galeri.show', $a->id) }}">
                            <img src="{{ url('storage/album', $a->cover) }}">
                            <div class="d-flex mb-3">
                                <span class="mr-3"><i class="bi bi-calendar"> {{ $a->created_at }}</i></span> &nbsp;
                                <span class=""><i class="bi bi-image"></i></span>
                            </div>
                            <h3>{{ $a->name }} </h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
