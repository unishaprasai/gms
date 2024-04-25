@extends('frontend.layouts.main')


@section('main-container')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{url('frontend/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Our Team</h2>
                    <div class="bt-option">
                        <a href="{{url('/user')}}">Home</a>
                        <span>Our team</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


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
                    <a href="#" class="primary-btn btn-normal appoinment-btn">appointment</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ts-slider owl-carousel">
                @foreach($team as $trainers)
                <div class="col-lg-4">
                    <div class="ts-item set-bg">
                        @php
                        $imageName = pathinfo($trainers->photo, PATHINFO_FILENAME) . '.jpg';
                        @endphp
                        <img src="{{ asset('trainers/' . $imageName) }}">

                        <div class="ts_text">
                            <h4>{{ $trainers->trainer_name }}</h4>
                            <span>Gym Trainer</span>
                        </div>
                    </div>
                </div>
                @endforeach
    
            </div>
        </div>
    </div>
</section>
<!-- Team Section End -->
@endsection