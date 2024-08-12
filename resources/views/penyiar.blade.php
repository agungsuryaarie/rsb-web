@extends('layouts.app')


@section('content')
    <section class="about spad">
        <div class="container">
            <div class="row">
                @foreach ($penyiar as $pr)
                    <div class="col-lg-6">
                        <div class="about__pic">
                            <img src="{{ url('storage/userUpload', $pr->picture) }}" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="about__text">
                            <div class="section-title">
                                <h2>{{ $pr->real_name }}</h2>
                                <h1>{{ $pr->real_name }}</h1>
                            </div>
                            <p>{!! $pr->tentang !!}</p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
