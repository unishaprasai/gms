<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('backend.layouts.slidebar')

<body>
    @include('backend.layouts.header')
    <h1 class="mt-5 mb-4 text-center " style="padding-top: 28px;">Gym Membership Form</h1>


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

    @if($errors->any())
    <script>
        Swal.fire({
            title: 'Error',
            html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            icon: 'error'
        });
    </script>
    @endif

    <div class="main-panel">
        <div class="content wrapper">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Membership Details</h5>
                            <form id="member_form" action="{{ url('add_members') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="mname" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="memail" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="maddress" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="mphone" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_join">Date of Joining</label>
                                    <input type="date" class="form-control" id="date_of_join" name="date_of_join" required>
                                </div>
                                <div class="form-group">
                                    <label for="membership_type">Membership Type</label>
                                    <select class="form-control" id="membership_type" name="membership_type" required>
                                        @foreach($packages as $package)
                                        <option value="{{ $package->name }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="shift">Choose Shift</label>
                                    <select class="form-control" id="shift" name="shift" required>
                                        <option value="day">Day</option>
                                        <option value="evening">Evening</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Upload Photo</label>
                                    <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                <button type="button" class="btn btn-danger btn-block" onclick="clearForm()">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('member_form');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: 'Confirm Submission',
                    text: 'Are you sure you want to submit this form?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Form submission when confirmed
                        form.submit();
                    }
                });
            });
        });

        function clearForm() {
            document.getElementById('member_form').reset();
        }
    </script>

</body>
@include('backend.layouts.footer')

</html>