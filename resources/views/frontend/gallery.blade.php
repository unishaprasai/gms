@extends('frontend.layouts.main')


@section('main-container')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{url('frontend/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Gallery</h2>
                        <div class="bt-option">
                        <a href="{{ url('/') }}">Home</a>
                            <a href="#">Pages</a>
                            <span>Gallery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

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
@endsection