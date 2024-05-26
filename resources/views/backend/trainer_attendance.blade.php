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
        <div class="alert-overlay" style="margin-left: 389px; width: 748px;">
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
                    <input type="date" class="form-control" id="date" name="date" placeholder="Search Payments" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-green" type="button" id="searchButton">Search</button>
                        <button class="btn btn-outline-secondary btn-blue" type="button" id="refreshButton">Refresh</button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mb-3" onclick="toggleAddForm()" style="width: 153px;">Add Attendance</button>
        </div>

        <div class="fcontainer" style="width: 800px; margin-left: 313px;">
            <div class="card-body" >
                <div id="addForm" style="display: none;">
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
                            <input type="date" class="form-control" id="attendanceDate" name="attendanceDate" max="{{ date('Y-m-d') }}">
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
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <button class="page-link" id="prevPage">Previous</button>
                                </li>
                                <li class="page-item">
                                    <button class="page-link" id="nextPage">Next</button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPage = 1;
        const rowsPerPage = 5;
        const tableBody = document.getElementById('AttendanceTableBody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        function displayPage(page) {
            tableBody.innerHTML = '';

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedRows = rows.slice(start, end);

            paginatedRows.forEach(row => tableBody.appendChild(row));

            document.getElementById('prevPage').disabled = page === 1;
            document.getElementById('nextPage').disabled = page === totalPages;
        }

        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                displayPage(currentPage);
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                displayPage(currentPage);
            }
        });

        displayPage(currentPage);

        // Get the current date in YYYY-MM-DD format
        var currentDate = new Date().toISOString().split('T')[0];

        // Set the max attribute of the input field to the current date
        document.getElementById('attendanceDate').setAttribute('max', currentDate);

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

        document.addEventListener('DOMContentLoaded', function() {
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
                    var paymentDate = row.querySelector('td:nth-child(3)').textContent;

                    // Check if the payment date matches the search date
                    if (paymentDate === searchDate) {
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
        });

        // Hide success message after 5 seconds (5000 milliseconds)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000);
        });

        // Refresh functionality
        document.getElementById('refreshButton').addEventListener('click', function() {
            location.reload();
        });
    </script>
</body>

@include('backend.layouts.footer')

</html>
