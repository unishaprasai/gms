<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
</head>
@include('backend.layouts.slidebar')

<body>


    <div class="fcontainer">
        @include('backend.layouts.header')
        <h1 class="mt-5 mb-4 text-center">View Classes</h1>

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
                    <input type="text" class="form-control" id="searchInput" placeholder="Search Classes">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
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
                                        <th>Class Name</th>
                                        <th>Trainers Name</th>
                                        <th>Shift</th>
                                        <th>Time</th>
                                        <th>Venue</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $class)
                                    <tr>
                                        <td>{{ $class->ClassName }}</td>
                                        <td>{{ $class->trainer->trainer_name ?? 'No Trainer' }}</td>
                                        <td>{{ $class->shift }}</td>
                                        <td>{{ $class->class_time }}</td>
                                        <td>{{ $class->venue }}</td>
                                        <td>

                                            <a href="{{url('edit_class', $class->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{url('delete_class', $class->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this class?')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="message" id="noResultMessage" style="display: none;">
                            <div class="alert alert-danger" role="alert">
                                No classes found.
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

        // Add an event listener to the refresh button
        document.getElementById('refreshButton').addEventListener('click', function() {
            location.reload();
        });

        // Add an event listener to the search button
        document.getElementById('searchButton').addEventListener('click', function() {
            // Get the search query from the input field
            var searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();

            // Get all table rows
            var rows = document.querySelectorAll('.table tbody tr');
            var noResultMessage = document.getElementById('noResultMessage');

            // Flag to check if any member is found
            var found = false;

            // Loop through each row and hide/show based on the search query
            rows.forEach(function(row) {
                var class_name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                var trainer_name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                // Check if name or email contains the search query
                if (class_name.includes(searchQuery) || trainer_name.includes(searchQuery)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Display message if no classes found
            if (!found) {
                noResultMessage.style.display = 'block';
            } else {
                noResultMessage.style.display = 'none';
            }
        });
    </script>
</body>

@include('backend.layouts.footer')

</html>