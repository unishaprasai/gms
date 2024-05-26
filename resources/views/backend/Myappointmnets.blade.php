<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
    <script src="https://unpkg.com/sweetalert2@11"></script>
</head>

@include('backend.layouts.slidebar')

<body>
    <h1>Appoinments</h1>

    <div class="fcontainer">
        @include('backend.layouts.header')
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">My Appoinments</h1>


        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <h4>View your Appoinments</h4>
                    <input type="date" class="form-control" id="date" name="date" required>
                    <button id="searchButton" class="btn btn-primary mt-2">Search</button>
                    <button id="refreshButton" class="btn btn-secondary mt-2" onclick="refreshPage()">Refresh</button>
                </div>

                <div class="row justify-content-end">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body">
                                @if ($appointments !== null && !$appointments->isEmpty())
                                <div class="table-responsive">
                                    <table class="table table-bordered mx-auto">
                                        <thead>
                                            <tr>
                                                <th>Trainer's Id</th>
                                                <th>Customer name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->trainer_id }}</td>
                                                <td>{{ $appointment->customer_name }}</td>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->time }}</td>
                                                <td>{{ $appointment->status }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="message" id="noResultMessage" style="display: none;">
                                        <div class="alert alert-danger" role="alert">
                                            No appointments in this date.
                                        </div>
                                    </div>
                                </div>
                                @else
                                <p>No appointments found.</p>
                                @endif
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

            @include('backend.layouts.footer')
</body>

</html>