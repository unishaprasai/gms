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
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">View New Enrollments</h1>

        @if(session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error'
            });
        </script>
        @endif

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search New Enrollments">
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
                                        <th>ID</th>
                                        <th>Plan Title</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="enrollmentsTableBody">
                                    @foreach($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->id }}</td>
                                        <td>{{ $enrollment->plan_title }}</td>
                                        <td>{{ $enrollment->customer_name }}</td>
                                        <td>{{ $enrollment->customer_email }}</td>
                                        <td>
                                            <form action="{{ route('update_enrollment_status', $enrollment->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <select class="form-control" name="status">
                                                    <option value="Pending" {{ $enrollment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Approved" {{ $enrollment->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="Rejected" {{ $enrollment->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirmAction()">Save</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="message" id="noResultMessage" style="display: none;">
                            <div class="alert alert-danger" role="alert">
                                No enrollments found with the given name or ID.
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

        function confirmAction() {
            return confirm('Are you sure you want to update this enrollment status?');
        }

        // Add an event listener to the search button
        document.getElementById('searchButton').addEventListener('click', function() {
            searchEnrollments();
        });

        // Add an event listener to the refresh button
        document.getElementById('refreshButton').addEventListener('click', function() {
            location.reload();
        });

        function searchEnrollments() {
            // Get the search query from the input field
            var searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();

            // Get all table rows
            var rows = document.querySelectorAll('#enrollmentsTableBody tr');
            var noResultMessage = document.getElementById('noResultMessage');

            // Flag to check if any enrollment is found
            var found = false;

            // Loop through each row and hide/show based on the search query
            rows.forEach(function(row) {
                var planTitle = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                var customerName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                // Check if name or ID contains the search query
                if (planTitle.includes(searchQuery) || customerName.includes(searchQuery)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Display message if no enrollments found
            if (!found) {
                noResultMessage.style.display = 'block';
            } else {
                noResultMessage.style.display = 'none';
            }
        }

        // Initial search when the page loads
        searchEnrollments();
    </script>
</body>

@include('backend.layouts.footer')

</html>
