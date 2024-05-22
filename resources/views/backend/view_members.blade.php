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
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">View Members</h1>
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        </script>
        @endif

        <div class="row justify-content-center mb-3"> <!-- Centering the search and refresh buttons -->
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by name or email">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                        <button class="btn btn-outline-secondary" type="button" id="refreshButton">Refresh</button>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Date of Joining</th>
                                        <th>Membership Type</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($members as $member)
                                    <tr>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->email}}</td>
                                        <td>{{$member->address}}</td>
                                        <td>{{$member->phone}}</td>
                                        <td>{{$member->date_of_join}}</td>
                                        <td>{{$member->membership_type}}</td>
                                        <td>{{$member->shift}}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <a href="{{url('edit_members',$member->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <!-- Delete button with confirmation message -->
                                            <a href="{{url('delete_members',$member->id)}}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return deleteConfirmation(event, '{{url('delete_members', $member->id)}}')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="noResultMessage" class="alert alert-danger" role="alert" style="display: none;">
                                No members found with the given name or email.
                            </div>
                        </div>
                        <!-- Pagination Controls -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center" id="paginationControls"></ul>
                        </nav>
                    </div>
                </div>
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

        // Function to handle delete confirmation with SweetAlert
        function deleteConfirmation(event, url) {
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
                    window.location.href = url;
                }
            });
        }

        // Search functionality
        document.getElementById('searchButton').addEventListener('click', function () {
            var searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();
            var rows = document.querySelectorAll('.table tbody tr');
            var noResultMessage = document.getElementById('noResultMessage');
            var found = false;

            rows.forEach(function (row) {
                var name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                var email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (name.includes(searchQuery) || email.includes(searchQuery)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (!found) {
                noResultMessage.style.display = 'block';
            } else {
                noResultMessage.style.display = 'none';
            }

            paginateTable();
        });

        // Refresh button functionality
        document.getElementById('refreshButton').addEventListener('click', function () {
            window.location.reload();
        });

        // Pagination functionality
        function paginateTable() {
            var rows = document.querySelectorAll('.table tbody tr');
            var rowsPerPage = 8;
            var currentPage = 1;
            var totalPages = Math.ceil(rows.length / rowsPerPage);

            function showPage(page) {
                rows.forEach((row, index) => {
                    if (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function createPagination() {
                var paginationControls = document.getElementById('paginationControls');
                paginationControls.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    let li = document.createElement('li');
                    li.className = 'page-item' + (i === currentPage ? ' active' : '');
                    li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                    li.addEventListener('click', (e) => {
                        e.preventDefault();
                        currentPage = i;
                        showPage(currentPage);
                        createPagination();
                    });
                    paginationControls.appendChild(li);
                }
            }

            showPage(currentPage);
            createPagination();
        }

        window.onload = function () {
            paginateTable();
        };
    </script>
</body>

</html>
