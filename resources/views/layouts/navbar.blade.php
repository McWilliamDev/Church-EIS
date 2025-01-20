<nav class="navbar navbar-expand px-4 py-3 shadow-sm">
    <form action="#" class="d-none d-sm-inline-block">
        <div class="input-group input-group-navbar">
            <input type="text" class="form-control border-2 rounded-3 shadow-sm" placeholder="Search...">
            <button class="btn border-2 rounded-3 shadow-lg ms-1" type="button">Search</button>
        </div>
    </form>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/account.png') }}" class="avatar img-fluid" alt="">
                    <span>{{ Auth::user()->name }}</span>
                </a>

                @if (Auth::user()->user_type == 'admin')
                    <div class="dropdown-menu dropdown-menu-end rounded">
                        <a href="{{ url('admin/profile') }}" class="dropdown-item">
                            <i class="lni lni-user-4"></i>
                            <span>Profile</span>
                        </a>

                        <a href="{{ url('admin/change_password') }}" class="dropdown-item">
                            <i class="lni lni-gear-1"></i>
                            <span>Change Password</span>
                        </a>

                        <a href="{{ url('logout') }}" class="dropdown-item">
                            <i class="lni lni-exit"></i>
                            <span>Logout</span>
                        </a>

                        <div class="dropdown-divider"></div>
                    </div>

                @elseif (Auth::user()->user_type == 'user')
                    <div class="dropdown-menu dropdown-menu-end rounded">
                        <a href="{{ url('user/profile') }}" class="dropdown-item">
                            <i class="lni lni-user-4"></i>
                            <span>Profile</span>
                        </a>

                        <a href="{{ url('user/change_password') }}" class="dropdown-item">
                            <i class="lni lni-gear-1"></i>
                            <span>Change Password</span>
                        </a>

                        <a href="{{ url('logout') }}" class="dropdown-item">
                            <i class="lni lni-exit"></i>
                            <span>Logout</span>
                        </a>

                        <div class="dropdown-divider"></div>
                    </div>
                @endif
            </li>
        </ul>
    </div>
</nav>
