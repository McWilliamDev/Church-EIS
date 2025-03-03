<aside id="sidebar">
    <div class=" d-flex justify-content-center align-items-center sidebar-logo">
        <img src="{{ asset('images/LogoTransparentWhite.png') }}" alt="" width="180px" height="180" mt-3>
    </div>

    <ul class="sidebar-nav">
        @if (Auth::user()->user_type == 'admin')
            <li class="sidebar-item">
                <a href="{{ url('admin/dashboard') }}" class="sidebar-link active">
                    <i class="lni lni-dashboard-square-1"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#auth" aria-expanded="false" aria-controls="#auth">
                    <i class="lni lni-user-4"></i>
                    <span>Management</span>
                </a>

                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ url('admin/admin/list') }}" class="sidebar-link">Church Administrators</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ url('admin/user/list') }}" class="sidebar-link">Admin</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('admin/member/list') }}" class="sidebar-link">
                    <i class="lni lni-user-multiple-4"></i>
                    <span>Manage Member</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#events" aria-expanded="false" aria-controls="#events">
                    <i class="lni lni-calendar-days"></i>
                    <span>Events</span>
                </a>

                <ul id="events" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ url('admin/events/list') }}" class="sidebar-link">View Events</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ url('admin/events_calendar') }}" class="sidebar-link">View Calendar Events</a>
                    </li>

                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#ministry" aria-expanded="false" aria-controls="#ministry">
                    <i class="lni lni-hierarchy-1"></i>
                    <span>Ministries</span>
                </a>

                <ul id="ministry" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ url('admin/ministry/list') }}" class="sidebar-link">Ministry Group</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ url('admin/assign_ministry/list') }}" class="sidebar-link">Assign Ministry</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#finance" aria-expanded="false" aria-controls="#finance">
                    <i class="lni lni-dollar-circle"></i>
                    <span>Finance Tracking</span>
                </a>

                <ul id="finance" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Create Finances</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ url('admin/finance/list') }}" class="sidebar-link">Generate Finance Reports</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#announcements" aria-expanded="false" aria-controls="#announcements">
                    <i class="lni lni-megaphone-1"></i>
                    <span>Announcements</span>
                </a>

                <ul id="announcements" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ url('admin/announcements') }}" class="sidebar-link">Create Announcements</a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a href="{{ url('admin/send_announcements') }}" class="sidebar-link">Send Announcements</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-folder-1"></i>
                    <span>Church Resources</span>
                </a>
            </li>
<!--------------------------------------------------------------------------------------------------------------------->
        @elseif(Auth::user()->user_type == 'user')
            <li class="sidebar-item">
                <a href="{{ url('user/dashboard') }}" class="sidebar-link">
                    <i class="lni lni-dashboard-square-1"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('user/member/list') }}" class="sidebar-link">
                    <i class="lni lni-user-multiple-4"></i>
                    <span>Manage Member</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('user/events/calendar') }}" class="sidebar-link">
                    <i class="lni lni-calendar-days"></i>
                    <span>Events</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#ministry" aria-expanded="false" aria-controls="#ministry">
                    <i class="lni lni-hierarchy-1"></i>
                    <span>Ministries</span>
                </a>
                <ul id="ministry" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ url('user/ministry/list') }}" class="sidebar-link">Ministry Group</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ url('admin/assign_ministry/list') }}" class="sidebar-link">Assign Ministry</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#finance" aria-expanded="false" aria-controls="#finance">
                    <i class="lni lni-dollar-circle"></i>
                    <span>Finance Tracking</span>
                </a>
                <ul id="finance" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Create Finances</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Generate Finance Reports</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse"
                    data-bs-target="#announcements" aria-expanded="false" aria-controls="#announcements">
                    <i class="lni lni-megaphone-1"></i>
                    <span>Announcements</span>
                </a>

                <ul id="announcements" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ url('user/announcements') }}" class="sidebar-link">Create Announcements</a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a href="{{ url('user/send_announcements') }}" class="sidebar-link">Send Announcements</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-folder-1"></i>
                    <span>Church Resources</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
