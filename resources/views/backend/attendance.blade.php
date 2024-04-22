<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
</head>
@include('backend.layouts.slidebar')
@include('backend.layouts.header')


<body>
    <!-- resources/views/trainer/attendance.blade.php -->

    <h1>Attendance</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="main-panel">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Attendance Details</h5>

                        @if (count($trainerData) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Trainer ID</th>
                        <th>Trainer Name</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainerData as $data)
                        <tr>
                            <td>{{ $data->trainer_id }}</td>
                            <td>{{ $data->trainer_name }}</td>
                            <td>{{ $data->attendance_date }}</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No attendance records found.</p>
        @endif



                        <form action="{{ url('save') }}" method="POST">
                            @csrf
                            <button type="submit">Check In</button>
                        </form>

</body>
@include('backend.layouts.footer')


</html>