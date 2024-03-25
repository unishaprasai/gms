<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('backend.layouts.css')
    <title>Edit Package</title>
</head>
@include('backend.layouts.slidebar')

<body>
    @extends('backend.layouts.header')

    @section('content')
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Update Package</h1>

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
                                <h5 class="card-title">Update Package Details</h5>
                                <form action="{{ url('update_package/' . $packages->package_id) }}"  method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method for updates -->
                                    <div class="form-group">
                                        <label for="name">Package Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $packages->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="assign_trainer">Assigned Trainer</label>
                                        <select class="form-control" id="assign_trainer" name="assign_trainer" required>
                                            <option value="">Select Assigned Trainer</option>
                                            @foreach ($trainers as $trainerId => $trainerName)
                                            <option value="{{ $trainerId }}" @if($packages->assign_trainer == $trainerId) selected @endif>{{ $trainerName }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Services</label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ $packages->description }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{ $packages->price }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="duration_in_days">Days</label>
                                        <input type="number" class="form-control" id="duration_in_days" name="duration_in_days" value="{{ $packages->duration_in_days }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
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