<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <button class="btn btn-primary mb-3" onclick="toggleAddForm()" style="width: 153px;">Add Attendance</button>
        </div>

        <div class="fcontainer" style="width: 800px; margin-left: 313px;">
            <div class="card-body">
                <div class="card-body">
                    <div id="addForm" style="display: block;">
                        <form action="{{ url('manual_entry') }}" method="POST" id="attendanceForm">
                            @csrf
                            <div class="form-group">
                                <label for="trainerId">Trainer ID</label>
                                <input type="text" class="form-control" id="trainerId" name="trainerId">
                            </div>
                            <div class="form-group">
                                <label for="trainername">Trainer Name</label>
                                <input type="text" class="form-control" id="trainername" name="trainername">
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

        // Submit form with AJAX
        document.getElementById('attendanceForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            // Perform AJAX request to submit form data
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Reload page or perform other actions
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while processing your request.',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    });
                });
        });
    </script>
</body>

@include('backend.layouts.footer')

</html>
