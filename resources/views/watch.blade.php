@extends('layouts.app')
@section('content')
    <!-- Video Section Begin -->
    <section class="videos spad">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-title">
                        <h2>Video Youtube</h2>
                        <h1>Latest Videos</h1>
                    </div>
                    <div class="row">
                        @foreach ($video as $v)
                            @php
                                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $v->link, $matches);
                                $youtubeVideoId = $matches[1] ?? null;
                            @endphp
                            <div class="col-lg-3">
                                <div class="videos__item">
                                    <div class="videos__item__pic set-bg"
                                        data-setbg="https://img.youtube.com/vi/{{ $youtubeVideoId }}/0.jpg">
                                        <a href="{{ $v->link }}" class="play-btn video-popup"><i
                                                class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>{{ $v->title }}</h5>
                                        <ul style="padding-left: 0">
                                            <li>{{ \Carbon\Carbon::parse($v->created_at)->format('H:i:s') }}</li>
                                            <li>{{ \Carbon\Carbon::parse($v->created_at)->format('Y-m-d') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section End -->
@endsection
