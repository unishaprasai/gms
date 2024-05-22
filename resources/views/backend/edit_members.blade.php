<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('backend.layouts.css')
    <title>Edit Gym Membership</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@include('backend.layouts.slidebar')

<body>
    <div class="fcontainer">
        @include('backend.layouts.header')
        <h1 class="mt-5 mb-4 text-center">Edit Gym Membership</h1>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/view_members') }}";
                }
            });
        </script>
        @endif

        @if($errors->any())
        <div class="alert-overlay">
            <div class="alert-box">
                <div class="alert alert-danger" role="alert">
                    <strong>Error:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="main-panel">
            <div class="content wrapper">
                <div class="row justify-content-center">
                    <!-- Membership Details -->
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit Membership Details</h5>
                                <form action="{{ url('update_member/' . $members->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="mname" value="{{ $members->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="memail" value="{{ $members->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="maddress" value="{{ $members->address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="mphone" value="{{ $members->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_of_join">Date of Joining</label>
                                        <input type="date" class="form-control" id="date_of_join" name="date_of_join" value="{{ $members->date_of_join }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="membership_type">Membership Type</label>
                                        <select class="form-control" id="membership_type" name="membership_type" required>
                                            @foreach($plan as $plans)
                                            <option value="{{ $plans->title }}">{{ $plans->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="shift">Choose Shift</label>
                                        <select class="form-control" id="shift" name="shift" required>
                                            <option value="day" {{ $members->shift == 'day' ? 'selected' : '' }}>Day</option>
                                            <option value="evening" {{ $members->shift == 'evening' ? 'selected' : '' }}>Evening</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Upload Photo</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        <a href="{{ url('/view_members') }}" class="btn btn-lg btn-danger ml-2" onclick="return cancelConfirmation(event)">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.layouts.footer')

    <script>
        function cancelConfirmation(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/view_members') }}";
                }
            });
        }

        function closeAlert() {
            var alertOverlay = document.querySelector('.alert-overlay');
            if (alertOverlay) {
                alertOverlay.remove();
            }
            window.location.href = "{{ url('/view_members') }}";
        }
    </script>
</body>

</html>
