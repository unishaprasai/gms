<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
  </head>
  @include('backend.layouts.slidebar')
  @include('backend.layouts.header')

<body>
<div class="row justify-content-center mt-5">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User List</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Iterate over your users data and fill in the rows -->
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->usertype }}</td>
                                <td>
                                    <!-- Add edit and delete buttons for each user -->
                                    <a href="{{url('edit_users', $user->id)}}" class="btn btn-sm btn-primary">Edit</a>


                                    <a href="{{url('delete_users', $user->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Message area -->
        <div class="message" id="noResultMessage" style="display: none;">
            <div class="alert alert-danger" role="alert">
                No members found with the given name or email.
            </div>
        </div>
    </div>
    @include('backend.layouts.footer')

    <script>
        function closeAlert() {
            var alertOverlay = document.querySelector('.alert-overlay');
            if (alertOverlay) {
                alertOverlay.remove();
            }
        }

        // Add an event listener to the search button
        document.getElementById('searchButton').addEventListener('click', function () {
            // Get the search query from the input field
            var searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();

            // Get all table rows
            var rows = document.querySelectorAll('.table tbody tr');
            var noResultMessage = document.getElementById('noResultMessage');

            // Flag to check if any member is found
            var found = false;

            // Loop through each row and hide/show based on the search query
            rows.forEach(function (row) {
                var name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                var email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                // Check if name or email contains the search query
                if (name.includes(searchQuery) || email.includes(searchQuery)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Display message if no members found
            if (!found) {
                noResultMessage.style.display = 'block';
            } else {
                noResultMessage.style.display = 'none';
            }
        });
    </script>
</body>

</html>
