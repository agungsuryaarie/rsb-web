<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}">RSB</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('home') }}">RSB</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->segment(2) == 'home' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="menu-header">Menu</li>
        <li
            class="dropdown {{ request()->segment(2) == 'post' || request()->segment(2) == 'category' ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-paper-plane"></i>
                <span>Post</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->segment(2) == 'post' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('post.index') }}">Post</a></li>
                <li class="{{ request()->segment(2) == 'category' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('category.index') }}">Kategori</a></li>
            </ul>
        </li>
        <li class="{{ request()->segment(2) == 'event' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('event.index') }}"><i class="fas fa-calendar"></i>
                <span>Event</span></a>
        </li>
        <li class="{{ request()->segment(2) == 'program' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('program.index') }}"><i class="fas fa-sliders-h"></i>
                <span>Program</span></a>
        </li>
        <li class="{{ request()->segment(2) == 'album' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('album.index') }}"><i class="fas fa-images"></i>
                <span>Album</span></a>
        </li>
        <li class="{{ request()->segment(2) == 'video' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('video.index') }}"><i class="fas fa-video"></i>
                <span>Video</span></a>
        </li>
        @if (Auth::user()->role == 1 && Auth::user()->host == 0)
            <li class="{{ request()->segment(2) == 'user' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-users"></i>
                    <span>User</span></a>
            </li>
        @endif
        <li class="{{ request()->segment(2) == 'profile' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.index') }}"><i class="far fa-user"></i>
                <span>Profile</span></a>
        </li>
    </ul>
</aside>
