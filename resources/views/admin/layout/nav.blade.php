<div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
            </ul>
        </form>
        <ul class="navbar-nav navbar-right btn-block justify-content-end">
            <li class="nav-link">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-warning">Front End</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img alt="image" src="{{ asset('uploads/'.Auth::guard('admin')->user()->photo) }}" class="rounded-circle">
                    <div class="d-sm-none d-lg-inline-block">{{ Auth::guard('admin')->user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item has-icon" href="{{ route('admin_profile') }}">
                        <i class="fa fa-user"></i> Edit Profile</a>
                    <a class="dropdown-item has-icon text-danger" href="{{ route('admin_logout') }}">
                        <i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </nav>
</div>