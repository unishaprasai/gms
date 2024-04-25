<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('backend.layouts.css')
    <title>All Notifocations</title>
</head>
@include('backend.layouts.slidebar')

<body>
    <div class="fcontainer">
        @include('backend.layouts.header')
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>All Notifications</h4>
                        <h6>View your all notifications</h6>
                    </div>
                </div>

                <div class="activity">
                    <div class="activity-box">
                        <ul class="activity-list">
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

                            <li>
                                <div class="activity-user">
                                    <a href="{{ url('view_noti') }}" title="" data-toggle="tooltip" data-original-title="Lesley Grauer">
                                        <img alt="Lesley Grauer" src="backend/assets/img/icons/notification-bing.svg" class=" img-fluid">
                                    </a>
                                </div>
                                <div class="activity-content">
                                    <div class="timeline-content">
                                    <p class="noti-details">
                                            <strong>{{ $notification->title }}</strong><br> <!-- Title in bold and content on a new line -->
                                            {{ $notification->content }}
                                        </p>
                                            <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    
                                    </div>
                                </div>
                            </li>


                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('backend.layouts.footer')


</body>

</html>