@extends('layouts.app')
@section('content')
    <div class="section search-result-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($article as $a)
                            <div class="blog-posts hfeed index-post-wrap">
                                <article class="blog-post hentry index-post post-0">
                                    <a class="entry-image-wrap is-image" href="{{ route('article.show', $a->slug) }}"><span
                                            class="entry-thumb lazy-ify" data-image="{{ url('storage/post', $a->image) }}"
                                            style="background-image:url('{{ url('storage/post', $a->image) }}')"></span>
                                    </a>
                                    <div class="entry-header">
                                        <h2 class="entry-title">
                                            <a class="entry-title-link"
                                                href="{{ route('article.show', $a->slug) }}">{{ $a->title }}
                                            </a>
                                        </h2>
                                        <p class="entry-excerpt excerpt">
                                            {{ substr(strip_tags($a->content), 0, 120) . '....' }}</p>
                                        <div class="entry-meta">
                                            <span class="entry-author mi"><span class="by sp">by</span><span
                                                    class="author-name">indeveloper</span></span>
                                            <span class="entry-time mi"><span class="sp">•</span><time class="published"
                                                    datetime="2020-10-25T03:27:00+07:00">{{ $a->created_at }}</time></span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
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

                    {{-- <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            <li><a href="#">Food <span>(12)</span></a></li>
                            <li><a href="#">Travel <span>(22)</span></a></li>
                            <li><a href="#">Lifestyle <span>(37)</span></a></li>
                            <li><a href="#">Business <span>(42)</span></a></li>
                            <li><a href="#">Adventure <span>(14)</span></a></li>
                        </ul>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
@endsection
