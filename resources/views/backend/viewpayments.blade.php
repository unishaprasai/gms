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
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">Payment History</h1>

        @if(session('success'))
        <div class="alert-overlay" style="margin-left: 389px; width: 748px;">
            <div class="alert-box">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
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
            <button class="btn btn-primary mb-3" onclick="toggleAddForm()" style="width: 153px;">Add Payments</button>
        </div>

        <div class="fcontainer" style="width: 800px; margin-left: 313px;">
            <div class="card-body">
                <div id="addForm" style="display: none;">
                    <form action="{{ url('manualpayment') }}" method="POST" id="paymentForm">
                        @csrf
                        <div class="form-group">
                            <label for="memberid">Member ID</label>
                            <input type="text" class="form-control" id="memberid" name="memberid" required>
                        </div>
                        <div class="form-group">
                            <label for="membername">Member Name</label>
                            <input type="text" class="form-control" id="membername" name="membername" required>
                        </div>
                        <div class="form-group">
                            <label for="PaymentDate">Payment Date</label>
                            <input type="date" class="form-control" id="PaymentDate" name="PaymentDate" max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paymentmode">Payment Mode</label>
                            <select class="form-control" id="paymentmode" name="paymentmode" required>
                                <option value="khalti">Khalti</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="membershiptype">Membership Type</label>
                            <select class="form-control" id="membershiptype" name="membershiptype" required>
                                @foreach($plans as $plan)
                                <option value="{{ $plan->title }}">{{ $plan->title }}</option>
                                @endforeach
                            </select>
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
                                        <th>Member Id</th>
                                        <th>Member Name</th>
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Mode</th>
                                        <th>Membership Type</th>
                                    </tr>
                                </thead>
                                <tbody id="PaymentTableBody">
                                    @foreach ($payment as $paymentData)
                                    <tr>
                                        <td>{{ $paymentData->member_id }}</td>
                                        <td>{{ $paymentData->member_name }}</td>
                                        <td>{{ $paymentData->payment_date }}</td>
                                        <td>{{ $paymentData->amount }}</td>
                                        <td>{{ $paymentData->status }}</td>
                                        <td>{{ $paymentData->payment_mode }}</td>
                                        <td>{{ $paymentData->membership_type }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="message" id="noResultMessage" style="display: none;">
                            <div class="alert alert-danger" role="alert">
                                No payments found for the given date.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set the max attribute of the input field to the current date
        document.getElementById('PaymentDate').setAttribute('max', new Date().toISOString().split('T')[0]);

        function closeAlert() {
            var alertOverlay = document.querySelector('.alert-overlay');
            if (alertOverlay) {
                alertOverlay.remove();
            }
        }

        function toggleAddForm() {
            var addForm = document.getElementById('addForm');
            addForm.style.display = addForm.style.display === 'none' ? 'block' : 'none';
        }

        // Submit form with AJAX
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

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
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
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