@extends('frontend.layouts.main')


@section('main-container')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Services</h2>
                    <div class="bt-option">
                        <a href="{{ url('/user') }}">Home</a>
                        <span>Services</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Services Section Begin -->
<section class="services-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>What we do?</span>
                    <h2>PUSH YOUR LIMITS FORWARD</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 order-lg-1 col-md-6 p-0">
                <div class="ss-pic">
                    <img src="img/services/services-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-3 order-lg-2 col-md-6 p-0">
                <div class="ss-text">
                    <h4>Personal training</h4>
                    <p>

                        Personal training: Tailored fitness sessions with a certified trainer for customized workouts, exercise guidance, nutrition advice, and motivation toward fitness goals. </p>
                    <a href="#">Explore</a>
                </div>
            </div>
            <div class="col-lg-3 order-lg-3 col-md-6 p-0">
                <div class="ss-pic">
                    <img src="img/services/services-2.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-3 order-lg-4 col-md-6 p-0">
                <div class="ss-text">
                    <h4>Group fitness classes</h4>
                    <p>Group fitness classes involve structured workouts led by instructors in a group setting, offering a variety of exercises such to tailored to participants' fitness levels and goals.</p>
                    <a href="#">Explore</a>
                </div>
            </div>
            <div class="col-lg-3 order-lg-8 col-md-6 p-0">
                <div class="ss-pic">
                    <img src="img/services/services-4.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-3 order-lg-7 col-md-6 p-0">
                <div class="ss-text second-row">
                    <h4>Body building</h4>
                    <p>Bodybuilding focuses on maximizing muscle hypertrophy through targeted resistance training, nutrition, and recovery strategies to achieve a well-defined and muscular physique.</p>
                    <a href="#">Explore</a>
                </div>
            </div>
            <div class="col-lg-3 order-lg-6 col-md-6 p-0">
                <div class="ss-pic">
                    <img src="img/services/services-3.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-3 order-lg-5 col-md-6 p-0">
                <div class="ss-text second-row">
                    <h4>Strength training</h4>
                    <p>
                        Strength training involves exercises using resistance (weights, body weight, bands) to build muscle strength, improve performance, and enhance overall fitness.
                    <p>
                        <a href="#">Explore</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Banner Section Begin -->
<section class="banner-section set-bg" data-setbg="frontend/img/banner-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="bs-text service-banner">
                    <h2>Exercise until the body obeys.</h2>
                    <div class="bt-tips">Where health, beauty and fitness meet.</div>
                    <a href="https://www.youtube.com/watch?v=EzKkl64rRbM" class="play-btn video-popup"><i class="fa fa-caret-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Pricing Section Begin -->
<section class="pricing-section service-pricing spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Plan</span>
                    <h2>Choose your pricing plan</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
                <div class="ps-item">
                    <h3>Class drop-in</h3>
                    <div class="pi-price">
                        <h2>$ 39.0</h2>
                        <span>SINGLE CLASS</span>
                    </div>
                    <ul>
                        <li>Free riding</li>
                        <li>Unlimited equipments</li>
                        <li>Personal trainer</li>
                        <li>Weight losing classes</li>
                        <li>Month to mouth</li>
                        <li>No time restriction</li>
                    </ul>
                    <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                    <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="ps-item">
                    <h3>12 Month unlimited</h3>
                    <div class="pi-price">
                        <h2>$ 99.0</h2>
                        <span>SINGLE CLASS</span>
                    </div>
                    <ul>
                        <li>Free riding</li>
                        <li>Unlimited equipments</li>
                        <li>Personal trainer</li>
                        <li>Weight losing classes</li>
                        <li>Month to mouth</li>
                        <li>No time restriction</li>
                    </ul>
                    <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                    <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="ps-item">
                    <h3>6 Month unlimited</h3>
                    <div class="pi-price">
                        <h2>$ 59.0</h2>
                        <span>SINGLE CLASS</span>
                    </div>
                    <ul>
                        <li>Free riding</li>
                        <li>Unlimited equipments</li>
                        <li>Personal trainer</li>
                        <li>Weight losing classes</li>
                        <li>Month to mouth</li>
                        <li>No time restriction</li>
                    </ul>
                    <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                    <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Pricing Section End -->
@endsection