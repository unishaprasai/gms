
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
        <h1 class="mt-5 mb-4 text-center">View Trainers</h1>

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
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by name or email">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
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
                                        <th>Trainer Name</th>
                                        <th>Trainer Email</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Date of Joining</th>
                                        <th>Assign Exercise</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trainers as $trainer)
                                    <tr>
                                        <td>{{ $trainer->trainer_name }}</td>
                                        <td>{{ $trainer->trainer_email }}</td>
                                        <td>{{ $trainer->trainer_address }}</td>
                                        <td>{{ $trainer->phone }}</td>
                                        <td>{{ $trainer->Assign_exercise }}</td>
                                        <td>{{ $trainer->date_of_join }}</td>
                                        <td>{{ $trainer->salary }}</td>
                                        <td>
                                        
                                            <a href="{{url('edit_trainers', $trainer->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                        
                                            <a href="{{url('delete_trainers', $trainer->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
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
        <div class="message" id="noResultMessage" style="display: none;">
            <div class="alert alert-danger" role="alert">
                No trainers found with the given name or email.
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
            var trainer_name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            var trainer_email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            // Check if name or email contains the search query
            if (trainer_name.includes(searchQuery) || trainer_email.includes(searchQuery)) {
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

  @include('backend.layouts.footer')
</html>
