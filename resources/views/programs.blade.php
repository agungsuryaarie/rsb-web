@extends('layouts.app')
@section('content')
    <section class="section posts-entry posts-entry-sm bg-body-tertiary">
        <div class="container">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">Program Unggulan</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($programs as $p)
                    <div class="col-md-6 col-lg-3">
                        <div class="blog-entry">
                            <a href="{{ route('programs.show', $p->slug) }}">
                                <div class="container-image">
                                    <img src="{{ url('storage/program', $p->cover) }}" class="image">
                                    <div class="overlay">
                                        <div class="text-program">{{ $p->name }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
