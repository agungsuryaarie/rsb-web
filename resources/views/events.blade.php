@extends('layouts.app')
@section('content')
    <section class="events bg-body-tertiary posts-entry">
        <div class="container">
            <div class="section-title center-title">
                <h2>Events</h2>
                <h1>Events</h1>
            </div>
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="row g-3">
                        @foreach ($events as $e)
                            <div class="col-md-3">
                                <div class="blog-entry">
                                    <a href="{{ route('events.show', $e->slug) }}"class="img-link">
                                        <img src="{{ url('storage/event', $e->cover) }}" alt="Image" class="img-events">

                                        <h2><a class="nav-link active"
                                                href="{{ route('events.show', $e->slug) }}">{{ $e->title }} </a></h2>
                                        <span class="date">{{ $e->created_at }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
