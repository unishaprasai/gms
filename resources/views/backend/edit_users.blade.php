<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('backend.layouts.css')
    <title>Edit Gym Membership</title>
</head>
@include('backend.layouts.slidebar')

<body>
    @extends('backend.layouts.header')

    @section('content')
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Update Trainers</h1>

        @if(session('success'))
        <div class="alert-overlay">
            <div class="alert-box">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn btn-success btn-block" id="closeButton">Okay</button>
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
                                <h5 class="card-title">Update Trainer Details</h5>

                                <form action="{{ url('update_users/' . $users->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method for updating -->

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="usertype">User Type</label>
                                        <select class="form-control" id="usertype" name="usertype" required>
                                            <option value="admin" {{ $users->usertype == 'Trainer' ? 'selected' : '' }}>Trainer</option>
                                            <option value="user" {{ $users->usertype == 'Member' ? 'selected' : '' }}>Member</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <!-- Add more fields for other user details -->

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        <a href="{{ url('/view_users') }}" class="btn btn-lg btn-danger ml-2">Cancel</a>
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
@include('backend.layouts.footer')