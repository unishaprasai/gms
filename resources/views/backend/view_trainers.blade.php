<!DOCTYPE html>
<html lang="en">

<head>

    @include('backend.css')
    <title>Gym Membership Details</title>
</head>
@include('backend.slidebar')
<style>
    .fcontainer {
        position: relative;
        margin-top: -580px;
    }


    .alert-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        max-width: 400px;
        z-index: 9999;
    }

    .alert-box {
        padding: 20px;
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: .25rem;
    }

    /* Style for message */
    .message {
        text-align: center;
        margin-top: 20px;
        padding: 10px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: .25rem;
        display: none;
        /* Initially hidden */
    }
</style>

<body>
    <div class="fcontainer">
        @include('backend.header')
        <h1 class="mt-5 mb-4 text-center">View Members</h1>

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

        <div class="row justify-content-center mb-3"> <!-- Centering the search button -->
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
            <!-- Membership Details Table -->
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
                                            <!-- Edit button -->
                                            <a href="{{url('edit_trainers', $trainer->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <!-- Delete button with confirmation message -->
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

        <!-- Message area -->
        <div class="message" id="noResultMessage" style="display: none;">
            <div class="alert alert-danger" role="alert">
                No trainers found with the given name or email.
            </div>
        </div>
    </div>
    @include('backend.script')

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

</html>