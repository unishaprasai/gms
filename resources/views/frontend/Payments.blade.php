@extends('frontend.layouts.main')
<!-- Khalti -->
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@section('main-container')
<script src="https://unpkg.com/sweetalert2@11"></script>

<section class="breadcrumb-section set-bg" data-setbg="{{ url('frontend/img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <div class="bt-option">
                        <a href="{{ url('/user') }}">Home</a>
                        <span>Payments</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="fcontainer">
    <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">My Payments</h1>
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: "{!! addslashes(session('success')) !!}",
            icon: 'success',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
       Swal.fire({
    title: 'Error',
    text: '{{ session('error', 'There was an error processing your request.') }}',
    icon: 'error'
});

    </script>
    @endif

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <h4>View your Payments</h4>
                <input type="date" class="form-control" id="date" name="date" required>
                <button id="searchButton" class="btn btn-primary mt-2">Search</button>
                <button id="refreshButton" class="btn btn-secondary mt-2" onclick="refreshPage()">Refresh</button>
            </div>
            <div class="col-lg-2">
                <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                    <button id="payment-button" class="btn btn-success mt-2"  style="width: 158px;  height: 53px; background-color: #8c208c;">Pay with Khalti</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="
            margin-left: 48px;
            margin-right: 68px;
        ">
                <div class="card-body">
                    @if (!empty($paymentData) && count($paymentData) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered mx-auto">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment mode</th>
                                    <th>Membership</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentData as $data)
                                <tr>
                                    <td>{{ $data->member_name }}</td>
                                    <td>{{ $data->payment_date }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->payment_mode }}</td>
                                    <td>{{ $data->membership_type}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-danger" role="alert">
                        No payment records found.
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    var config = {
        "publicKey": "{{ config('services.khalti.public_key') }}",
        "productIdentity": "1234567890",
        "productName": "SmartGym",
        "productUrl": "http://127.0.0.1:8000/",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
        ],
        "eventHandler": {
            onSuccess(payload) {
                console.log('Khalti onSuccess payload:', payload);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('khalti.verifyPayment') }}",
                    data: {
                        token: payload.token,
                        amount: payload.amount,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        console.log('Payment verification response:', res);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('khalti.storePayment') }}",
                            data: {
                                response: res,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                console.log('Transaction stored successfully:', res);
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Transaction successful!',
                                    icon: 'success'
                                });
                            },
                            error: function(err) {
                                console.error('Error storing transaction:', err);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to store payment!' + err.responseJSON.message,
                                    icon: 'error'
                                });
                            }
                        });
                    },
                    error: function(err) {
                        console.error('Payment verification failed:', err);
                        Swal.fire({
                            title: 'Error',
                            text: 'Verification failed!',
                            icon: 'error'
                        });
                    }
                });
            },
            onError(error) {
                console.error('Khalti payment error:', error);
            },
            onClose() {
                console.log('Khalti widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function() {
        checkout.show({
            amount: 1000
        });
    }

    function refreshPage() {
        location.reload();
    }

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
</script>
</body>

@endsection

</html>