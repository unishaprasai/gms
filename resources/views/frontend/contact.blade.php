@extends('frontend.layouts.main')


@section('main-container')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Contact Us</h2>
                    <div class="bt-option">
                        <a href="{{ url('/user') }}">Home</a>
                        <a href="#">Pages</a>
                        <span>Contact us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact-section spad">
    @if(session('status') === 'success')
    <div class="alert alert-success">
        Form submitted successfully!
    </div>
    @elseif(session('status') === 'error')
    <div class="alert alert-danger">
        Failed to submit form. {{ session('error_message') }}
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title contact-title">
                    <span>Contact Us</span>
                    <h2>GET IN TOUCH</h2>
                </div>
                <div class="contact-widget">
                    <div class="cw-text">
                        <i class="fa fa-map-marker"></i>
                        <p>Pepsicola<br /> Kathmandu</p>
                    </div>
                    <div class="cw-text">
                        <i class="fa fa-mobile"></i>
                        <ul>

                            <li>0158974315</li>
                            <li> 9866265176</li>
                        </ul>
                    </div>
                    <div class="cw-text email">
                        <i class="fa fa-envelope"></i>
                        <p>smartgymcenter@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="leave-comment">
                    <form action="/submit" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" placeholder="Comment">{{ old('comment') }}</textarea>
                            @error('comment')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56590.52926889173!2d85.3203660702142!3d27.70479859708339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19d79a20373b%3A0x98455874db8959d6!2sPepsicola%2C%20Kathmandu!5e0!3m2!1sen!2snp!4v1649200458291!5m2!1sen!2snp" height="550" style="border:0;" allowfullscreen=""></iframe>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if a status message is set
        var status = '{{ session("status") }}';
        if (status === 'success') {
            alert('Form submitted successfully!');
        } else if (status === 'error') {
            // Display the specific error message returned from the server
            alert('Failed to submit form. ' + data.error_message);
        }
    });
</script>
<!-- Contact Section End -->
@endsection