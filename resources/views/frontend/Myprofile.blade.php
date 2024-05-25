<!-- resources/views/frontend/profile/edit.blade.php -->
@extends('frontend.layouts.main')

@section('main-container')
<section class="breadcrumb-section set-bg" data-setbg="{{ url('frontend/img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <div class="bt-option">
                        <a href="{{ url('/user') }}">Home</a>
                        <span>Edit Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-panel">
    <div class="content wrapper">
        <div class="row justify-content-center">
            <!-- Membership Details -->
            
            <div class="col-xl-6" style="margin-top: 37px;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Your Details</h5>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ url('update_myprofile/'. $member->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="mname" value="{{ old('mname', $member->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="memail" value="{{ old('memail', $member->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="maddress" value="{{ old('maddress', $member->address) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="mphone" value="{{ old('mphone', $member->phone) }}" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                <a href="" class="btn btn-lg btn-danger ml-2" onclick="return cancelConfirmation(event)">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function cancelConfirmation(event) {
        event.preventDefault();
        if (confirm("Are you sure you want to cancel? Any unsaved changes will be lost.")) {
            window.location.href = "{{ url('/user') }}"; // Redirect to the desired URL
        }
    }
</script>
@endsection