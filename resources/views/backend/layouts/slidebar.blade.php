<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ url('home') }}"><img src="backend/assets/img/icons/dashboard.svg" alt="img"><span>
                            Dashboard</span> </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/users1.svg" alt="img"><span>
                            Users</span> <span class="menu-arrow"></span></a>

                    <ul>
                        @if(auth()->user()->usertype === 'admin')
                        <li><a href="{{ url('add_users') }}">New User </a></li>
                        @endif
                        <li><a href="{{ url('view_users') }}">Users List</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/member.svg" alt="img"><span>
                            Members</span> <span class="menu-arrow"></span></a>

                    <ul>
                        <li><a href="{{ url('add_members') }}">New Members </a></li>
                        <li><a href="{{ url('view_members') }}">Members List</a></li>
                    </ul>
                </li>

                @if(auth()->user()->usertype === 'admin')
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/users1.svg" alt="img"><span>
                            Trainers</span> <span class="menu-arrow"></span></a>

                    <ul>
                        @if(auth()->user()->usertype === 'admin')
                        <li><a href="{{ url('add_trainers') }}">New Trainer </a></li>
                        @endif

                        <li><a href="{{ url('view_trainers') }}">Trainers List</a></li>

                    </ul>
                </li>
                @endif

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/time.svg" alt="img"><span>
                            Classes</span> <span class="menu-arrow"></span></a>

                    <ul>
                        <li><a href="{{ url('add_classes') }}">New Class </a></li>
                        <li><a href="{{ url('view_class') }}">View Classes</a></li>
                    </ul>
                </li>


                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/product.svg" alt="img"><span>
                            Packages</span> <span class="menu-arrow"></span></a>

                    <ul>
                        <li><a href="{{ url('add_packages') }}">New Package </a></li>
                        <li><a href="{{ url('view_package') }}">View Packages</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/places.svg" alt="img"><span>
                            Attendance</span> <span class="menu-arrow"></span></a>

                    <ul>
                        @if(auth()->user()->usertype === 'admin')

                        <li><a href="{{ url('attendance_sheet') }}">Trainers Attendance </a></li>
                        @endif

                        <li><a href="{{ url('attendance_sheet') }}">Students Attendance </a></li>

                        @if(auth()->user()->usertype === 'trainer')
                        <li><a href="{{ url('attendance_sheet') }}">My Attendance </a></li>
                        @endif

                    </ul>
                </li>



                <li>
                    <a href="index.html"><img src="backend/assets/img/icons/purchase1.svg" alt="img"><span>
                            Payments</span> </a>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="backend/assets/img/icons/quotation1.svg" alt="img"><span>
                            Announcements</span> <span class="menu-arrow"></span></a>

                    <ul>
                        @if(auth()->user()->usertype === 'admin')
                        <li><a href="{{ url('add_ann') }}">New Announcements </a></li>
                        <li><a href="{{ url('view_announcement') }}">View Announcements </a></li>
                        @endif
                        <li><a href="{{ url('view_noti') }}">View Announcements </a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>