@extends('frontend.layouts.main')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('main-container')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hs-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="{{url('frontend/img/hero/hero-1.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="hi-text">
                            <span>Shape your body</span>
                            <h1>Be <strong>strong</strong> traning hard</h1>
                            <a href="{{url('/about')}}" class="primary-btn">Get info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="{{url('frontend/img/hero/hero-2.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="hi-text">
                            <span>Shape your body</span>
                            <h1>Be <strong>strong</strong> traning hard</h1>
                            <a href="{{url('/about')}}" class="primary-btn">Get info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- ChoseUs Section Begin -->
<section class="choseus-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Why chose us?</span>
                    <h2>PUSH YOUR LIMITS FORWARD</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="cs-item">
                    <span class="flaticon-034-stationary-bike"></span>
                    <h4>Modern equipment</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        dolore facilisis.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="cs-item">
                    <span class="flaticon-033-juice"></span>
                    <h4>Healthy nutrition plan</h4>
                    <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                        facilisis.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="cs-item">
                    <span class="flaticon-002-dumbell"></span>
                    <h4>Proffesponal training plan</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        dolore facilisis.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="cs-item">
                    <span class="flaticon-014-heart-beat"></span>
                    <h4>Unique to your needs</h4>
                    <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                        facilisis.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ChoseUs Section End -->

<!-- Classes Section Begin -->
<section class="classes-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Classes</span>
                    <h2>WHAT WE CAN OFFER</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($items as $package)
            <div class="col-lg-4 col-md-6">
                <div class="class-item">
                    <div class="ci-pic">
                        @php
                        $imageName = pathinfo($package->photo, PATHINFO_FILENAME) . '.jpg';
                        @endphp
                        <img src="{{ asset('storage/packages/' . $imageName) }}">
                    </div>
                    <div class="ci-text">
                        <h5>{{ $package->name }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ChoseUs Section End -->

<!-- Banner Section Begin -->
<section class="banner-section set-bg" data-setbg="{{url('frontend/img/banner-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="bs-text">
                    <h2>registration now to get more deals</h2>
                    <div class="bt-tips">Where health, beauty and fitness meet.</div>
                    <a href="#" class="primary-btn  btn-normal">Appointment</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Pricing Section Begin -->
<section class="pricing-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Plans</span>
                    <h2>Choose your pricing plan</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($plans as $singlePlan)
            <div class="col-lg-4 col-md-6">
                <div class="ps-item">
                    <h3>{{ $singlePlan->title }}</h3>
                    <div class="pi-price">
                        <h2>Rs.{{ number_format($singlePlan->price, 0) }}</h2>
                    </div>
                    @if (!empty($singlePlan->features))
                    <ul>
                        @php
                        $features = explode(',', $singlePlan->features);
                        @endphp
                        @foreach ($features as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <button type="button" class="btn btn-primary btn-block pricing-btn enroll-btn" data-toggle="modal" data-target="#enrollmentModal" data-plan="{{ $singlePlan->title }}">Enroll now</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="enrollmentModal" tabindex="-1" role="dialog" aria-labelledby="enrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollmentModalLabel">Enroll Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="enroll-form" action="{{ url('enrollments') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="plan_title">Plan</label>
                        <input type="text" class="form-control" id="plan_title" name="plan_title" readonly>
                    </div>
                    <div class="form-group">
                        <label for="customer_name">Your Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Eg. John Ehn" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Your Email</label>
                        <input type="text" class="form-control" id="customer_email" name="customer_email" placeholder="example@gmail.com" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Enroll</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Pricing Section End -->

<!-- Gallery Section Begin -->
<div class="gallery-section">
    <div class="gallery">
        <div class="grid-sizer"></div>
        <div class="gs-item grid-wide set-bg" data-setbg="{{url('frontend/img/gallery/gallery-1.jpg')}}">
            <a href="{{url('frontend/img/gallery/gallery-1.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
        <div class="gs-item set-bg" data-setbg="{{url('frontend/img/gallery/gallery-2.jpg')}}">
            <a href="{{url('frontend/img/gallery/gallery-2.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
        <div class="gs-item set-bg" data-setbg="{{url('frontend/img/gallery/gallery-3.jpg')}}">
            <a href="{{url('frontend/img/gallery/gallery-3.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
        <div class="gs-item set-bg" data-setbg="{{url('frontend/img/gallery/gallery-4.jpg')}}">
            <a href="{{url('frontend/img/gallery/gallery-4.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
        <div class="gs-item set-bg" data-setbg="{{url('frontend/img/gallery/gallery-5.jpg')}}">
            <a href="{{url('frontend/img/gallery/gallery-5.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
        <div class="gs-item grid-wide set-bg" data-setbg="{{url('frontend/img/gallery/gallery-6.jpg')}}">
            <a href="{{url('frontend/img/gallery/gallery-6.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
        </div>
    </div>
</div>
<!-- Gallery Section End -->

<!-- Team Section Begin -->
<section class="team-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="team-title">
                    <div class="section-title">
                        <span>Our Team</span>
                        <h2>TRAIN WITH EXPERTS</h2>
                    </div>
                    <!-- <><a href="#" class="primary-btn btn-normal appoinment-btn">appointment</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ts-slider owl-carousel">

                @if(isset($team))


                @foreach($team as $trainer)
                <div class="col-lg-4">
                    <div class="ts-item set-bg">
                        @php
                        $imageName = pathinfo($trainer->photo, PATHINFO_FILENAME) . '.jpg';
                        @endphp
                        <img src="{{ asset('trainers/' . $imageName) }}" alt="{{ $trainer->trainer_name }}">

                        <div class="ts_text">
                            <h4>{{ $trainer->trainer_name }}</h4>
                          <span>  <button class="primary-btn btn-normal appoinment-btn" data-trainer-id="{{ $trainer->id }}" data-toggle="modal" data-target="#appointmentModal">Appointment</button></span>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>Team variable is undefined</p>
                @endif
            </div>
        </div>

    </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Schedule Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="appointmentForm" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="plan_title">Plan</label>
                        <input type="text" class="form-control" id="plan_title" name="plan_title" readonly>
                    </div>

                    <input type="hidden" name="trainer_id" id="trainer_id" value="">
                    <div class="form-group">
                        <label for="customer_name">Customer Name:</label>
                        <input type="text" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>

<!-- Team Section End -->


<script>
    $(document).ready(function() {
        $('.enroll-btn').on('click', function() {
            var planTitle = $(this).data('plan');
            $('#plan_title').val(planTitle);
        });

        $('#enroll-form').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Simulate form submission (you would send the form data to your server here)
            var formData = $(this).serialize();
            // Example AJAX call to submit the form data
            $.post($(this).attr('action'), formData, function(response) {
                // Display SweetAlert success message
                Swal.fire({
                    title: 'Success!',
                    text: 'You have successfully enrolled in the plan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Optional: Reload the page or perform any other action after success message
                    if (result.isConfirmed) {
                        window.location.reload(); // Reload the page
                    }
                });
            }).fail(function() {
                // Display SweetAlert error message if AJAX request fails
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });

        $(document).ready(function() {
            $('.appoinment-btn').click(function() {
                var trainerId = $(this).data('trainer-id');
                $('#trainer_id').val(trainerId);
            });
        });

        // Optional: Clear form data when modal is closed
        $('#enrollmentModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
    });
</script>


@endsection