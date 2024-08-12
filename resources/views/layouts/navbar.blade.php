<nav class="navbar navbar-expand-lg navbar-light sticky-top border-1"data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">
        <a href="{{ route('home.index') }}" class="logo m-0 float-start"><img
                src="{{ url('front-template/images/logo-black.png') }}" style="width: 100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('article.index') }}">Berita RSB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('programs.index') }}">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('watch.index') }}">Tonton</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('galeri.index') }}">Galeri</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link active" aria-current="page" href="{{ route('events.index') }}">Acara</a>
                </li>
                @guest
                    <div class="navbar-cta" role="search">
                        <a class="btn btn-outline-primary border-purple me-2 text-bold"
                            href="{{ route('login') }}">Masuk</a>
                        <a class="btn btn-primary border-purple me-2 text-purple" href="{{ route('register') }}">
                            <i class="fa fa-user-plus"></i>
                            Daftar</a>
                    </div>
                @endguest
                @auth
                    <div class="dropdown">
                        <button class="dd-button btn btn-primary border-purple me-2 text-purple" data-label="Dropdown">
                            Halo, {{ Auth::user()->name }}!
                        </button>
                        <ul class="dd-menu">
                            <li>
                                <a href="{{ route('profil.index') }}" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </ul>
            <a class="header__button bg-gen streaming_playing_now" href="/streaming" id="streaming_playing_now">
                <div class="default">Streaming<br><span>Radio</span><br><span class="default-button"><i
                            class="fa fa-play"></i> listening now</span></div>
            </a>
        </div>
    </div>
</nav>
