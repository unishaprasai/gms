<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('backend.layouts.slidebar')

<body>
@include('backend.layouts.header')
@section('content')
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Edit Profile</h1>

        @if(session('success'))
            <div class="alert-overlay" style="margin-left: 389px; width: 748px;">
                <div class="alert-box">
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-overlay">
                <div class="alert-box">
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn btn-success btn-block" id="closeButton">Okay</button>
                    </div>
                </div>
            </div>
        @endif

        <div class="main-panel">
            <div class="content wrapper">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Update Your Details</h5>

                                <form action="{{ url('update_profile/'.$trainer->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="tname">Trainer Name</label>
                                        <input type="text" class="form-control" id="tname" name="tname" value="{{ old('tname', $trainer->trainer_name) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="temail">Email</label>
                                        <input type="email" class="form-control" id="temail" name="temail" value="{{ old('temail', $trainer->trainer_email) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="taddress">Address</label>
                                        <input type="text" class="form-control" id="taddress" name="taddress" value="{{ old('taddress', $trainer->trainer_address) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tphone">Phone Number</label>
                                        <input type="tel" class="form-control" id="tphone" name="tphone" value="{{ old('tphone', $trainer->phone) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        <a href="{{ url('/home') }}" class="btn btn-lg btn-danger ml-2">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
        // Hide success message after 5 seconds (5000 milliseconds)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000); 
        });
    </script>

@include('backend.layouts.footer')

</html>
