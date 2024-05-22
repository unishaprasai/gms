<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('backend.layouts.slidebar')
@include('backend.layouts.header')

<body>
<div class="row justify-content-center mt-5">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">View Users</h1>
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                        <button class="btn btn-outline-secondary" type="button" id="refreshButton">Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                @if(auth()->user()->usertype === 'admin')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- Iterate over your users data and fill in the rows -->
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->usertype }}</td>
                                @if(auth()->user()->usertype === 'admin')
                                <td>
                                    <a href="{{url('edit_users', $user->id)}}" class="btn btn-sm btn-primary" onclick="return editUserConfirmation(event)">Edit</a>
                                    <a href="{{url('delete_users', $user->id)}}" class="btn btn-sm btn-danger" onclick="return deleteUserConfirmation(event, '{{ $user->id }}')">Delete</a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" id="prevPage">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" id="nextPage">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@include('backend.layouts.footer')

<script>
    var currentPage = 1;
    var rowsPerPage = 10;
    var rows = document.querySelectorAll('.table tbody tr');

    function displayRows() {
        var noResultMessage = document.getElementById('noResultMessage');
        var start = (currentPage - 1) * rowsPerPage;
        var end = start + rowsPerPage;
        var visibleRows = 0;

        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visibleRows === 0 && rows.length > 0) {
            document.getElementById('userTableBody').insertAdjacentHTML('beforeend', '<tr id="noResultMessage"><td colspan="5" class="text-center">No members found with the given name or email.</td></tr>');
        } else {
            var noResultRow = document.getElementById('noResultMessage');
            if (noResultRow) noResultRow.remove();
        }

        document.getElementById('prevPage').parentElement.classList.toggle('disabled', currentPage === 1);
        document.getElementById('nextPage').parentElement.classList.toggle('disabled', end >= rows.length);
    }

    document.getElementById('searchButton').addEventListener('click', function () {
        var searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();
        rows = document.querySelectorAll('.table tbody tr');
        var noResultMessage = document.getElementById('noResultMessage');
        var found = false;

        rows.forEach(function (row) {
            var name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            var email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            if (name.includes(searchQuery) || email.includes(searchQuery)) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }
        });

        if (!found) {
            if (!noResultMessage) {
                document.getElementById('userTableBody').insertAdjacentHTML('beforeend', '<tr id="noResultMessage"><td colspan="5" class="text-center">No members found with the given name or email.</td></tr>');
            }
        } else {
            if (noResultMessage) noResultMessage.remove();
        }
    });

    document.getElementById('refreshButton').addEventListener('click', function () {
        document.getElementById('searchInput').value = '';
        rows.forEach(function (row) {
            row.style.display = '';
        });
        var noResultMessage = document.getElementById('noResultMessage');
        if (noResultMessage) noResultMessage.remove();
        displayRows();
    });

    function deleteUserConfirmation(event, userId) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('delete_users') }}/" + userId;
                Swal.fire(
                    'Deleted!',
                    'The user has been deleted.',
                    'success'
                )
            }
        });
    }

    function editUserConfirmation(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Edit User',
            text: "Are you sure you want to edit this user?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = event.target.href;
            }
        });
    }

    document.getElementById('prevPage').addEventListener('click', function (event) {
        event.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            displayRows();
        }
    });

    document.getElementById('nextPage').addEventListener('click', function (event) {
        event.preventDefault();
        if (currentPage * rowsPerPage < rows.length) {
            currentPage++;
            displayRows();
        }
    });

    displayRows();
</script>
</body>
</html>
