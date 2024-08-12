<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RSBFM &mdash; {{ $menu }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('back-template/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('back-template/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('back-template/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('back-template/modules/chocolat/dist/css/chocolat.css') }}">



</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if (isset(Auth::user()->profile->picture))
                                <img alt="image"
                                    src="{{ url('storage/userUpload/' . Auth::user()->profile->picture) }}"
                                    class="rounded-circle mr-1">
                            @else
                                <img alt="image" src="{{ asset('back-template/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle mr-1">
                            @endif
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar sidebar-style-2">
                @include('admin.layouts.menu')
            </div>

            <div class="main-content">
                <div id="alerts"></div>
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2023 <div class="bullet"></div> Diskominfo Batu Bara
                </div>
                <div class="footer-right">
                </div>
            </footer>

            <!-- General JS Scripts -->
            <script src="{{ asset('back-template/modules/jquery.min.js') }}"></script>
            <script src="{{ asset('back-template/modules/popper.js') }}"></script>
            <script src="{{ asset('back-template/modules/tooltip.js') }}"></script>
            <script src="{{ asset('back-template/modules/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('back-template/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
            <script src="{{ asset('back-template/modules/moment.min.js') }}"></script>
            <script src="{{ asset('back-template/js/stisla.js') }}"></script>
            <script src="{{ asset('back-template/modules/datatables/datatables.min.js') }}"></script>
            <script src="{{ asset('back-template/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
            </script>
            <script src="{{ asset('back-template/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
            <script src="{{ asset('back-template/modules/jquery-ui/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('back-template/js/page/modules-datatables.js') }}"></script>
            <script src="{{ asset('back-template/js/scripts.js') }}"></script>
            <script src="{{ asset('back-template/js/custom.js') }}"></script>
            <script src="{{ asset('back-template/modules/izitoast/js/iziToast.min.js') }}"></script>
            <script src="{{ asset('back-template/modules/summernote/summernote-bs4.js') }}"></script>
            <script src="{{ asset('back-template/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
        </div>
    </div>

    @yield('script')
</body>

</html>
