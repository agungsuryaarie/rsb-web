@extends('layouts.app')


@section('content')
    <section class="section bg-body-tertiary">
        <div class="container">
            <div class="row align-items-stretch retro-layout">
                @foreach ($article as $a)
                    <div class="col-md-6">
                        <a href="{{ route('article.show', $a->slug) }}" class="h-entry img-5 b-height gradient">
                            <div class="featured-img" style="background-image: url('{{ url('storage/post', $a->image) }}');">
                            </div>
                            <div class="videos__large__item__text">
                                <h4>{{ $a->title }}</h4>
                                <ul class="article-info" style="padding-left: 0">
                                    <li><i class="bi bi-calendar"></i> {{ $a->created_at }}</li>
                                    <li><i class="bi bi-clock"></i> {{ $a->jam }} WIB</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="col-md-3">
                    @foreach ($article1 as $a1)
                        <a href="{{ route('article.show', $a1->slug) }}" class="h-entry mb-30 v-height gradient">
                            <div class="featured-img"
                                style="background-image: url('{{ url('storage/post', $a1->image) }}');">
                            </div>
                            <div class="text">
                                <span class="date">{{ $a1->created_at }}</span>
                                <h2>{{ $a1->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="col-md-3">
                    @foreach ($article2 as $a2)
                        <a href="{{ route('article.show', $a2->slug) }}" class="h-entry mb-30 v-height gradient">
                            <div class="featured-img"
                                style="background-image: url('{{ url('storage/post', $a2->image) }}');">
                            </div>
                            <div class="text">
                                <span class="date">{{ $a2->created_at }}</span>
                                <h2>{{ $a2->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section track spad youtube spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="section-title">
                        <h2>Program Unggulan</h2>
                        <h1>Program Unggulan</h1>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="track__all">
                        <a href="{{ route('programs.index') }}" class="primary-btn border-btn">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 col-sm-6 mb-100">
                    <div class="title-entry">
                        <h5>RSB menyediakan beragam program untuk menemani hari-hari anda</h5>
                    </div>
                    <div class="track__content nice-scroll" tabindex="1" style="overflow-y: hidden; outline: none;">
                        @foreach ($programs as $p)
                            <a href="{{ route('programs.show', $p->slug) }}">
                                <div class="program__item">
                                    <img src="{{ url('storage/program', $p->cover) }}">
                                    <div class="youtube__item__text">
                                        <h4>{{ $p->name }}</h4>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 p-0 order-lg-2">
                    <div class="tours__item__pic">
                        <img src="{{ 'front-template/images/tour-1.jpg' }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section posts-entry posts-entry-sm ">
        <div class="container">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">Penyiar Radio</h2>
                </div>
            </div>
            <div class="row">
                <div class="videos__slider owl-carousel">
                    @foreach ($penyiar as $pr)
                        <div class="col-videos">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    @if (isset($pr->profile->picture))
                                        <img src="{{ asset('storage/userUpload/' . $pr->profile->picture) }}"
                                            alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Berita --}}
    {{-- <section class="section posts-entry posts-entry-sm bg-body-tertiary">
        <div class="container">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">Berita Terbaru</h2>
                    <p>Update Kegiatan Pemerintah</p>
                </div>
                <div class="col-sm-6 text-sm-end"><a href="https://batubarakab.go.id/kategori/pemerintahan"
                        class="read-more">Lihat Semua</a></div>
            </div>
            <div class="row retro-layout">
                <div class="news__slider owl-carousel">
                    @foreach ($berita['results'] as $b)
                        <div class="col-md-11">
                            <a href="#" class="h-entry mb-30 p-height gradient">
                                <div class="featured-img" style="background-image: url('{{ $b['gambar'] }}');"> </div>
                                <div class="text">
                                    <h5 class="text-white">{{ $b['judul'] }}</h5>
                                    <div class="d-flex">
                                        <span class="text-white mr-3"><i class="bi bi-calendar"></i>
                                            {{ $b['tanggal'] }}</span> &nbsp;
                                        <span class="text-white"><i class="bi bi-eye"></i> {{ $b['dilihat'] }}x
                                            dilihat</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section> --}}

    <div class="section bg-primary-50">
        <div class="container">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">Tonton Video</h2>
                </div>
                <div class="col-sm-6 text-sm-end"><a href="{{ route('watch.index') }}" class="read-more">Lihat Semua</a>
                </div>
            </div>

            <div class="row align-items-stretch retro-layout-alt">
                @foreach ($video as $v)
                    @php
                        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $v->link, $matches);
                        $youtubeVideoId = $matches[1] ?? null;
                    @endphp
                    <div class="col-sm-6">
                        <div class="videos__large__item set-bg"
                            data-setbg="https://img.youtube.com/vi/{{ $youtubeVideoId }}/0.jpg">
                            <a href="{{ $v->link }}" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                            <div class="videos__large__item__text">
                                <h4>{{ $v->title }}</h4>
                                <ul style="padding-left: 0">
                                    <li>{{ \Carbon\Carbon::parse($v->created_at)->format('H:i:s') }}</li>
                                    <li>{{ \Carbon\Carbon::parse($v->created_at)->format('Y-m-d') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-6">
                    <div class="two-col d-block d-md-flex justify-content-between">
                        @foreach ($video1 as $v1)
                            @php
                                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $v1->link, $matches);
                                $youtubeVideoId = $matches[1] ?? null;
                            @endphp
                            <div class="col-lg-6">
                                <div class="videos__item">
                                    <div class="videos__item__pic set-bg"
                                        data-setbg="https://img.youtube.com/vi/{{ $youtubeVideoId }}/0.jpg">
                                        <a href="{{ $v1->link }}" class="play-btn video-popup"><i
                                                class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>{{ $v1->title }}</h5>
                                        <ul style="padding-left: 0">
                                            <li>{{ \Carbon\Carbon::parse($v1->created_at)->format('H:i:s') }}</li>
                                            <li>{{ \Carbon\Carbon::parse($v1->created_at)->format('Y-m-d') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
