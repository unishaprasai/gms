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

                                <form action="{{ url('update_trainers/' . $trainer->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="tname">Trainer Name</label>
                                        <input type="text" class="form-control" id="tname" name="tname" value="{{ $trainer->trainer_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="temail">Email</label>
                                        <input type="email" class="form-control" id="temail" name="temail" value="{{ $trainer->trainer_email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="taddress">Address</label>
                                        <input type="text" class="form-control" id="taddress" name="taddress" value="{{ $trainer->trainer_address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tphone">Phone Number</label>
                                        <input type="tel" class="form-control" id="tphone" name="tphone" value="{{ $trainer->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salary</label>
                                        <input type="number" class="form-control" id="salary" name="salary" value="{{ $trainer->salary}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="trainer_date_of_join">Date of Joining</label>
                                        <input type="date" class="form-control" id="trainer_date_of_join" name="trainer_date_of_join" value="{{ $trainer->date_of_join }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="assign_exercise">Assign Exercise </label>
                                        <select class="form-control" id="assign_exercise" name="assign_exercise" value="{{ $trainer->Assign_exercise }}" required>
                                            @foreach($packages as $package)
                                            <option value="{{ $package->name }}">{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        <a href="{{ url('/view_trainers') }}" class="btn btn-lg btn-danger ml-2">Cancel</a>
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