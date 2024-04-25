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
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">View Student's Attendance</h1>

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
        </div>

        <div class="row justify-content-end">

            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mx-auto">
                                <thead>
                                    <tr class="heading">
                                        <th>Member Id</th>
                                        <th>Member Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="AttendanceTableBody">
                                    @foreach ($MemberAttendances as $attendance)
                                    <tr>
                                    <td> {{ $attendance->member_id }}</td>
                                     <td> {{ $attendance->member->name }}</td>
                                    <td> {{ $attendance->attendance_date }}</td>
                                    <td> {{ $attendance->status }}</td>
                                    <td>
                                    <a href="{{url('delete_mem_att', $attendance->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>

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
