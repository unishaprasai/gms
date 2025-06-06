<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart Gym</title>
    <!-- Khalti -->
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/flaticon.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/barfiller.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}" type="text/css">
</head>
<style>
    .to-social .user-profile {
        font-size: 14px;
        text-transform: none;
    }

    /* .to-social .xyz {

        margin-top: -45px;
        margin-right: -4000px;

    } */
    /* .nav-menu ul li:last-child {
        margin-right: -1200px;
        margin-top: -50px;
    } */
</style>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="canvas-search search-switch">
            <i class="fa fa-search"></i>
        </div>
        <nav class="canvas-menu mobile-menu">
            <ul>
                <li><a href="{{url('/user')}}">Home</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/classtime')}}">Classes</a></li>
                <li><a href="{{url('/services')}}">Services</a></li>
                <li><a href="{{url('/team')}}">Our Team</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="{{url('/about')}}">About us</a></li>
                        <li><a href="{{url('/classtime')}}">Classes timetable</a></li>
                        <li><a href="{{url('/bmicalculator')}}">Bmi calculate</a></li>
                        <li><a href="{{url('/team')}}">Our team</a></li>
                        <li><a href="{{url('/blog')}}">Our blog</a></li>
                        <li><a href="{{url('/')}}">404</a></li>
                    </ul>
                </li>
                <li><a href="{{('/contact')}}">Contact</a></li>
            </ul>
        </nav>
    </div>
    <header class="header-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 offset-lg-1">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            <img src="{{url('frontend/img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="nav-menu">
                        <ul>
                            <li class="{{ Request::is('user/') ? 'active' : '' }}"><a href="{{ url('/user') }}">Home</a></li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}">About Us</a></li>
                            <li class="{{ Request::is('classtime') ? 'active' : '' }}"><a href="{{ url('/classtime') }}">Classes</a></li>
                            <li class="{{ Request::is('services') ? 'active' : '' }}"><a href="{{ url('/services') }}">Services</a></li>
                            <li>
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/classtime') }}">Classes timetable</a></li>
                                    <li><a href="{{ url('/bmicalculator') }}">BMI calculate</a></li>
                                    <li><a href="{{ url('/team') }}">Our team</a></li>
                                </ul>
                            </li>
                            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact</a></li>
                            @auth
                            <li class="{{ Request::is('mattendance_sheet') ? 'active' : '' }}"><a href="{{ url('/attendance') }}">My Attendance</a></li>
                            <li>
                                <a href="#"><i class="fa fa-bell"></i></a>
                                <ul class="dropdown">
                                    @foreach($notifications as $notification)
                                    @if (($notification->recipient === 'user' || $notification->recipient === 'both') && Auth::user()->usertype === 'member')
                                    <li class="notification-message">
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <strong>{{ $notification->title }}</strong><br>
                                                {{ $notification->content }}
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            <div class="to-social">


                                <li>
                                    <a href="#" class="user-profile" style="margin-left: 950px;margin-top: -41px; width: 135px;">{{ Auth::user()->name }}</a>
                                    <ul class="dropdown" style="margin-left: 950px; margin-top: -41px;width: 135px;">
                                        <li><a href="{{ url('/myprofile') }}">My Profile</a></li>
                                        <li><a href="{{ url('/payments') }}">My Payments</a></li>
                                        <li> <x-logout-button /></li>
                                </li>
                        </ul>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                </div>

                @endauth
                </ul>
                </ul>
                </nav>
            </div>
        </div>
        </div>
    </header>




    <script>
        var config = {
            "publicKey": "{{ config('services.khalti.public_key') }}",
            "productIdentity": "1234567890",
            "productName": "SmartGym",
            "productUrl": "http://127.0.0.1:8000/",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
            ],
            "eventHandler": {
                onSuccess(payload) {
                    console.log('Khalti onSuccess payload:', payload);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('khalti.verifyPayment') }}",
                        data: {
                            token: payload.token,
                            amount: payload.amount,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            console.log('Payment verification response:', res);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('khalti.storePayment') }}",
                                data: {
                                    response: res,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    console.log('Transaction stored successfully:', res);
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Transaction successful!',
                                        icon: 'success'
                                    });
                                },
                                error: function(err) {
                                    console.error('Error storing transaction:', err);
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Failed to store payment!' + err.responseJSON.message,
                                        icon: 'error'
                                    });
                                }
                            });
                        },
                        error: function(err) {
                            console.error('Payment verification failed:', err);
                            Swal.fire({
                                title: 'Error',
                                text: 'Verification failed!',
                                icon: 'error'
                            });
                        }
                    });
                },
                onError(error) {
                    console.error('Khalti payment error:', error);
                },
                onClose() {
                    console.log('Khalti widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function() {
            checkout.show({
                amount: 1000
            });
        }
    </script>



</body>

</html>