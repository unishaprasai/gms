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
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">View Packages</h1>

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
                    <input type="text" class="form-control" id="searchInput" placeholder="Search Packages">
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
                                        <th>Package Id</th>
                                        <th>Package Name</th>
                                        <th>Assign Trainer</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Days</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="packageTableBody">
                                    @foreach($packages as $package)
                                    <tr>
                                        <td>{{ $package->package_id }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->assign_trainer }}</td>
                                        <td>{{ $package->description }}</td>
                                        <td>{{ $package->price }}</td>
                                        <td>{{ $package->duration_in_days }}</td>
                                        <td>
                                            <a href="{{url('edit_package', $package->package_id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ url('/delete_package', $package->package_id) }}')">Delete</button>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="message" id="noResultMessage" style="display: none;">
                            <div class="alert alert-danger" role="alert">
                                No packages found with the given name or ID.
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

    // Hide success message after 5 seconds (5000 milliseconds)
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    });

        // Add an event listener to the search button
        document.getElementById('searchButton').addEventListener('click', function() {
            searchPackages();
        });

        // Add an event listener to the refresh button
        document.getElementById('refreshButton').addEventListener('click', function() {
            location.reload();
        });

        function searchPackages() {
            // Get the search query from the input field
            var searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();

            // Get all table rows
            var rows = document.querySelectorAll('#packageTableBody tr');
            var noResultMessage = document.getElementById('noResultMessage');

            // Flag to check if any package is found
            var found = false;

            // Loop through each row and hide/show based on the search query
            rows.forEach(function(row) {
                var packageName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                var packageId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

                // Check if name or ID contains the search query
                if (packageName.includes(searchQuery) || packageId.includes(searchQuery)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Display message if no packages found
            if (!found) {
                noResultMessage.style.display = 'block';
            } else {
                noResultMessage.style.display = 'none';
            }
        }

        // Initial search when the page loads
        searchPackages();

        // Function to confirm delete using SweetAlert
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this package!',
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
