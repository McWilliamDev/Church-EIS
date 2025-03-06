<nav class="navbar navbar-expand px-4 py-3 shadow-sm">
    @include('layouts.greetings')

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->profile_pic ? asset('upload/profile/' . Auth::user()->profile_pic) : asset('images/account.png') }}" class="avatar img-fluid rounded-circle" alt="">
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
