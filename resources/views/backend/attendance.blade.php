<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
</head>
@include('backend.layouts.slidebar')
@include('backend.layouts.header')

<body>
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Attendance Log</h1>

        <!-- Date and Shift Selection -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-4">
                <label for="attendance_date" class="form-label">Select Date:</label>
                <input type="date" class="form-control" id="attendance_date" name="attendance_date">
            </div>
            <div class="col-md-4">
                <label for="attendance_shift" class="form-label">Select Shift:</label>
                <select class="form-select" id="attendance_shift" name="attendance_shift">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </select>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-overlay">
            <div class="alert-box">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn btn-success btn-block" onclick="closeAlert()">Okay</button>
            </div>
        </div>
        @endif

        <!-- Membership Details Table -->
        <form id="attendanceForm" action="/save_attendance" method="post" >
            @csrf <!-- CSRF token -->
            <div class="row justify-content-end">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mx-auto">
                                    <thead>
                                        <tr class="heading">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Membership Type</th>
                                            <th>Shift</th>
                                            <th>Present/Absent</th>
                                            <th>Percentage</th> <!-- Added column for percentage -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $member)
                                        <tr>
                                            <td>{{$member->id}}
                                        <input type="hidden" name="id[]" value="{{ $member->id }}"/></td>
                                            <td>{{$member->name}}</td>
                                            <td>{{$member->email}}</td>
                                            <td>{{$member->phone}}</td>
                                            <td>{{$member->membership_type}}</td>
                                            <td>{{$member->shift}}</td>
                                            <input type="hidden" name="shift[]" value="{{ $member->shift }}"/></td>
                                            <td>
                                                <select class="form-control" name="present_absent[]">
                                                    <option value="present">Present</option>
                                                    <option value="absent">Absent</option>
                                                    <option value="late">Late</option>
                                                </select>
                                            </td>
                                            <td>
                                                <!-- Input field for percentage -->
                                                <input type="number" class="form-control" name="percentage[]" value="{{$member->percentage}}" min="0" max="100">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-center mb-12">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary mx-2">Save & Submit</button>
                                    <button type="button" class="btn btn-danger mx-2" onclick="window.history.back()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('backend.layouts.footer')
</body>

</html>
