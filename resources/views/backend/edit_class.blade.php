<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('backend.layouts.css')
    <title>Edit Classes</title>
</head>
@include('backend.layouts.slidebar')

<body>
    @extends('backend.layouts.header')

    @section('content')
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Update Classes</h1>

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

                                <form action="{{ url('update_class/' . $class->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="ClassName">Class Name</label>
                                        <input type="text" class="form-control" id="ClassName" name="ClassName" value="{{ old('ClassName', $class->ClassName) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="trainerid">Trainer</label>
                                        <select class="form-control" id="trainerid" name="trainerid" required>
                                            @foreach ($trainers as $trainerId => $trainerName)
                                            <option value="{{ $trainerId }}" {{ $class->trainersid == $trainerId ? 'selected' : '' }}>
                                                {{ $trainerName }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="shift">Shift</label>
                                        <select class="form-control" id="shift" name="shift" required>
                                            <option value="Morning" {{ $class->shift == 'Morning' ? 'selected' : '' }}>Morning</option>
                                            <option value="Afternoon" {{ $class->shift == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                                            <option value="Evening" {{ $class->shift == 'Evening' ? 'selected' : '' }}>Evening</option>
                                            <option value="Night" {{ $class->shift == 'Night' ? 'selected' : '' }}>Night</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="class_time">Class Time</label>
                                        <input type="text" class="form-control" id="class_time" name="class_time" value="{{ old('class_time', $class->class_time) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="venue">Venue</label>
                                        <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue', $class->venue) }}" required>
                                    </div>

                                    <!-- Add other input fields for updating -->

                                    <button type="submit" class="btn btn-primary">Update</button>
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