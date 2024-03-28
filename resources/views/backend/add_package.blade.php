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
    <h1 class="mt-5 mb-4 text-center"style="padding-top: 28px;">Add Packages</h1>


    @if(session('success'))
    <div class="alert-overlay">
        <div class="alert-box">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            <button type="button" class="btn btn-success btn-block" id="closeButton">Okay</button>
        </div>
    </div>
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
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Pacakage</h5>
                            <form action="{{ url('add_package') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="package_id">Package Id</label>
                                    <input type="number" class="form-control" id="package_id" name="package_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Package Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="assign_trainer">Assigned Trainer</label>
                                    <select class="form-control" id="assign_trainer" name="assign_trainer" required>
                                        <option value="">Select Assigned Trainer</option>
                                        @foreach ($trainers as $trainerId => $trainerName)
                                        <option value="{{ $trainerId }}">{{ $trainerName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Services</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration_in_days">Days</label>
                                    <input type="number" class="form-control" id="duration_in_days" name="duration_in_days" required>
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
        const form = document.getElementById('trainerform');

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
        document.getElementById('class_form').reset();
    }
</script>

</body>
@include('backend.layouts.footer')

</html>