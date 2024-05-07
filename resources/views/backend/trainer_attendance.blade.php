<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('backend.layouts.slidebar')

<body>


    <div class="fcontainer">
        @include('backend.layouts.header')
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">Trainer Attendance</h1>

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

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search Attendance">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-green" type="button" id="searchButton">Search</button>
                        <button class="btn btn-outline-secondary btn-blue" type="button" id="refreshButton">Refresh</button>
                    </div>
                </div>
            </div>
            <!-- Plus Button to Add Attendance -->
            <!-- <button class="btn btn-primary mb-3" onclick="toggleAddForm()">Add Attendance</button> -->
            <button class="btn btn-primary mb-3" onclick="toggleAddForm()" style="width: 153px;">Add Attendance</button>
        </div>


        <!-- Form for Manually Adding Attendance (Initially Hidden) -->
        <div class="fcontainer" style="width: 800px; margin-left: 313px;">
            <div class="card-body">

                <div class="card-body">


                    <div id="addForm" style="display: block;">
                        <form action="http://127.0.0.1:8000/save" method="POST">
                            <input type="hidden" name="_token" value="h6muS0r73KR5Jelq8OsztPh7gbNyuMRWRnnH3LtX" autocomplete="off">
                            <div class="form-group">
                                <label for="trainerId">Trainer ID</label>
                                <input type="text" class="form-control" id="trainerId" name="trainerId">
                            </div>
                            <div class="form-group">
                                <label for="attendanceDate">Attendance Date</label>
                                <input type="date" class="form-control" id="attendanceDate" name="attendanceDate">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" name="status">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div id="addForm" style="display: none;">
            <form action="{{ url('/save') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="trainerId">Trainer ID</label>
                    <input type="text" class="form-control" id="trainerId" name="trainerId">
                </div>
                <div class="form-group">
                    <label for="attendanceDate">Attendance Date</label>
                    <input type="date" class="form-control" id="attendanceDate" name="attendanceDate">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>


    <div class="row justify-content-end">

        <div class="col-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mx-auto">
                            <thead>
                                <tr class="heading">
                                    <th>Trainers Id</th>
                                    <th>Trainer Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="AttendanceTableBody">
                                @foreach ($trainerAttendances as $attendance)
                                <tr>
                                    <td> {{ $attendance->trainer_id }}</td>
                                    <td> {{ $attendance->trainer->trainer_name }}</td>
                                    <td> {{ $attendance->attendance_date }}</td>
                                    <td> {{ $attendance->status }}</td>
                                    <td>
                                        <a href="{{url('delete_trainer_att', $attendance->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="message" id="noResultMessage" style="display: none;">
                        <div class="alert alert-danger" role="alert">
                            No attendance found with the given date or ID.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function closeAlert() {
            var alertOverlay = document.querySelector('.alert-overlay');
            if (alertOverlay) {
                alertOverlay.remove();
            }
        }

        function toggleAddForm() {
            var addForm = document.getElementById('addForm');
            if (addForm.style.display === 'none') {
                addForm.style.display = 'block';
            } else {
                addForm.style.display = 'none';
            }
        }


        // Function to confirm delete using SweetAlert
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete URL
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>
</body>

@include('backend.layouts.footer')

</html>