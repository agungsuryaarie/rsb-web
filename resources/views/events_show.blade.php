@extends('layouts.app')
@section('content')
    <section class="section bg-body-tertiary">
        <div class="container">
            <div class="row blog-entries element-animate">
                <div class="col-md-12 col-lg-8 main-content">
                    <div class="post-content-body">
                        <div class="row my-4">
                            <div class="col-md-12 mb-4">
                                <img src="{{ url('storage/event', $events->cover) }}" alt="Image placeholder"
                                    class="img-post rounded">
                            </div>
                            <h3>{{ $events->title }}</h3>
                        </div>
                        <p>{!! $events->description !!}</p>
                    </div>
                </div>


                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box">
                        <h3 class="heading">Other Program</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach ($other_events as $oe)
                                    <li>
                                        <a href="{{ route('events.show', $oe->slug) }}">
                                            <img src="{{ url('storage/event', $oe->cover) }}" alt="Image placeholder"
                                                class="me-4 rounded">
                                            <div class="text">
                                                <h4>{{ $oe->title }}</h4>
                                                <div class="post-meta">
                                                    <span class="mr-2"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
