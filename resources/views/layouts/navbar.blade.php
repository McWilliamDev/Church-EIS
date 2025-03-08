<nav class="navbar navbar-expand px-2 shadow-sm">
    @include('layouts.greetings')

    <!--Modal Logout-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to logout?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" id="userDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 d-none d-lg-inline fw-medium">{{ Auth::user()->name }}</span>
                    <img src="{{ Auth::user()->profile_pic ? asset('upload/profile/' . Auth::user()->profile_pic) : asset('images/account.png') }}" 
                        class="avatar img-fluid rounded-circle" alt="">
                </a>

                <!-- Dropdown - User Information -->
                @if (Auth::user()->user_type == 'admin')
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ url('admin/profile') }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('admin/change_password') }}">
                            <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>
                            Activity Log
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            Logout
                        </a>
                    </li>

                @elseif (Auth::user()->user_type == 'user')
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ url('user/profile') }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('user/change_password') }}">
                            <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>
                            Activity Log
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            Logout
                        </a>
                    </li>
                @endif
            </li>
        </ul>
    </div>
</nav>
