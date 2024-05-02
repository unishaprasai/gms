<div id="global-loader">
    <div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

    <div class="header">

        <div class="header-left active">
            <a href="{{ url('/home') }}" class="logo">
                <img src="backend/assets/img/logo.png" alt="">
            </a>
            <a href="{{ url('/home') }}"  class="logo-small">
                <img src="backend/assets/img/logo-small.png" alt="">
            </a>
            <a id="toggle_btn" href="javascript:void(0);">
            </a>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <ul class="nav user-menu">

            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#">
                        <div class="searchinputs">
                            <input type="text" placeholder="Search Here ...">
                            <div class="search-addon">
                                <span><img src="backend/assets/img/icons/closes.svg" alt="img"></span>
                            </div>
                        </div>
                        <a class="btn" id="searchdiv"><img src="backend/assets/img/icons/search.svg" alt="img"></a>
                    </form>
                </div>
            </li>


            <li class="nav-item dropdown">

                <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" id="notificationDropdown">
                    <img src="backend/assets/img/icons/notification-bing.svg" alt="img"> <span class="badge rounded-pill" id="unread-notifications">
                        {{ $notifications->where('read', false)->where('recipient', Auth::user()->usertype)->count() }}
                    </span>
                </a>

                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">5
                        <span class="notification-title">Notifications</span>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            @foreach($notifications as $notification)
                            @if($notification->recipient === 'admin' && Auth::user()->usertype !== 'admin')
                            @continue {{-- Skip notifications not meant for admins --}}
                            @endif
                            @if($notification->recipient === 'trainer' && Auth::user()->usertype !== 'trainer')
                            @continue {{-- Skip notifications not meant for trainers --}}
                            @endif
                            @if($notification->recipient === 'user' && Auth::user()->usertype !== 'member')
                            @continue {{-- Skip notifications not meant for members --}}
                            @endif

                            {{-- Push notification to both users and trainers --}}
                            @if($notification->recipient === 'both' && (Auth::user()->usertype === 'member' || Auth::user()->usertype === 'trainer'))
                            {{-- Place your notification logic here --}}
                            @endif

                            <li class="notification-message">
                                <a href="{{ url('view_noti') }}">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="backend/assets/img/profiles/avatar-02.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <strong>{{ $notification->title }}</strong><br> <!-- Title in bold and content on a new line -->
                                                {{ $notification->content }}
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>

                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="{{ url('view_noti') }}">View All Notifications</a>
                    </div>
                </div>
            </li>




            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-img"><img src="backend/assets/img/profiles/avator1.jpg" alt="">
                        <span class="status online"></span></span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <span class="status online"></span></span>
                            <div class="profilesets">
                                @auth <!-- Check if the user is authenticated -->
                                <h6>{{ Auth::user()->name }}</h6> 
                                <h5>{{ Auth::user()->usertype }}</h5> 
                                @else 
                                <h6>Guest</h6>
                                <h5>Guest</h5>
                                @endauth
                            </div>
                        </div>
                        <hr class="m-0">
                        <a class="dropdown-item" href="{{ url('/profile') }}"> <i class="me-2" data-feather="user"></i> My
                            Profile</a>


                        <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
                        <hr class="m-0">
                        <x-logout-button />

                    </div>
                </div>
            </li>
        </ul>


        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="generalsettings.html">Settings</a>
                <a class="dropdown-item" href="signin.html">Logout</a>
            </div>
        </div>

    </div>

    <script>
        function logoutAndClearLocalStorage(event) {
            event.preventDefault(); // Prevent the default link behavior

            // Clear local storage
            localStorage.clear();

            // Redirect to the logout route
            window.location.href = event.target.href;

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('unread-notifications').addEventListener('click', function() {
                    // Set badge count to 0
                    document.getElementById('unread-notifications').innerText = '0';
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('clear-noti-btn').addEventListener('click', function() {
                    // Example logic to remove notifications
                    let notificationList = document.querySelector('.notification-list');
                    if (notificationList) {
                        // Remove all child elements (notifications)
                        while (notificationList.firstChild) {
                            notificationList.removeChild(notificationList.firstChild);
                        }
                    }
                    // Update badge count to zero
                    document.getElementById('unread-notifications').innerText = '0';
                    console.log('All notifications cleared!');
                });
            });


        }
    </script>