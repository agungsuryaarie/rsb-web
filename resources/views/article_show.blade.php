@extends('layouts.app')
@section('content')
    <section class="section bg-body-tertiary">
        <div class="container">
            <div class="row blog-entries element-animate">
                <div class="col-md-12 col-lg-8 main-content">
                    <div class="post-content-body">
                        <div class="row my-4">
                            <div class="col-md-12 mb-4">
                                <img src="{{ url('storage/post/' . $article->image) }}" alt="Image placeholder"
                                    class="img-post rounded">
                            </div>
                            <h3>{{ $article->title }}</h3>
                            {{-- <span class="date"><i class="fa fa-calendar"></i> {{ $article->created_at }}</span> --}}
                            <ul class="article-info">
                                <li><i class="bi bi-calendar"></i> {{ $article->created_at }}</li> | &nbsp;
                                <li><i class="bi bi-clock"></i> {{ $article->jam }} WIB</li>
                            </ul>
                        </div>
                        <p>{!! $article->content !!}</p>
                    </div>
                </div>


                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box">
                        <h3 class="heading">Other Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @foreach ($other_post as $op)
                                    <li>
                                        <a href="{{ route('article.show', $op->slug) }}">
                                            <img src="{{ url('storage/post/' . $op->image) }}" alt="Image placeholder"
                                                class="me-4 rounded">
                                            <div class="text">
                                                <h4>{{ $op->title }}</h4>
                                                <div class="post-meta">
                                                    <span class="mr-2">{{ $op->created_at }}</span>
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
