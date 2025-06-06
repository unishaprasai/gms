@extends('frontend.layouts.main')


@section('main-container')
<script src="https://unpkg.com/sweetalert2@11"></script>


<section class="breadcrumb-section set-bg" data-setbg="{{url('frontend/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <div class="bt-option">
                        <a href="{{url('/user')}}">Home</a>
                        <span>Attendance</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="fcontainer">
    <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">My History</h1>
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: "{!! addslashes(session('success')) !!}",
            icon: 'success',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            title: 'Error',
            text: '{{ session('error', 'You have already checked in today.') }}',
            icon: 'error'
        });
    </script>
    @endif


    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <h4>View your Attendance</h4>
                <input type="date" class="form-control" id="date" name="date" required>
                <button id="searchButton" class="btn btn-primary mt-2">Search</button>
                <button id="refreshButton" class="btn btn-secondary mt-2" onclick="refreshPage()">Refresh</button>
            </div>
            <form id="checkin" action="{{ url('update_att') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success mt-2">Check In</button>
            </form>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-xl-10">
            <div class="card" style="
            margin-left: -82px;
            margin-right: 140px;
        ">
                <div class="card-body">
                    @if (count($memberData) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered mx-auto">
                            <thead>
                                <tr>
                                    <th>Member ID</th>
                                    <th>Member Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($memberData as $data)
                                <tr>
                                    <td>{{ $data->member_id }}</td>
                                    <td>{{ $data->member_name }}</td>
                                    <td>{{ $data->attendance_date }}</td>
                                    <td>{{ $data->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="message" id="noResultMessage" style="display: none;">
                            <div class="alert alert-danger" role="alert">
                                No attendance recorded ion this date.
                            </div>
                        </div>
                        @else
                        <p>No attendance records found.</p>
                        @endif
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

    function refreshPage() {
        location.reload();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkin');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Attendance Record',
                text: 'Are you sure you want to Check in?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,checked in!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Form submission when confirmed
                    form.submit();
                }
            });
        });
    });

    // Add an event listener to the search button
    document.getElementById('searchButton').addEventListener('click', function() {
        // Get the search date from the date picker
        var searchDate = document.getElementById('date').value;

        // Get all table rows
        var rows = document.querySelectorAll('.table tbody tr');
        var noResultMessage = document.getElementById('noResultMessage');

        // Flag to check if any record is found
        var found = false;

        // Loop through each row and hide/show based on the search date
        rows.forEach(function(row) {
            var attendanceDate = row.querySelector('td:nth-child(3)').textContent;

            // Check if the attendance date matches the search date
            if (attendanceDate === searchDate) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Display message if no records found for the search date
        if (!found) {
            noResultMessage.style.display = 'block';
        } else {
            noResultMessage.style.display = 'none';
        }
    });
</script>
</body>

@endsection

</html>