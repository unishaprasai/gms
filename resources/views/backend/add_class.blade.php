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
    <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">Add Classes</h1>

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
                            <h5 class="card-title">Class Details</h5>
                            <form id="class_form" action="{{ url('add_class') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="classname">Class Name</label>
                                    <input type="text" class="form-control" id="classname" name="ClassName" required>
                                </div>
                                <div class="form-group">
                                    <label for="trainerid">Trainer Name</label>
                                    <select class="form-control" id="trainerid" name="trainerid" required>
                                        <option value="">Assign Trainer</option> <!-- Default option with the message -->
                                        @foreach($trainers as $trainer)
                                        <option value="{{ $trainer->id }}">{{ $trainer->trainer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="shift">Day</label>
                                    <select class="form-control" id="shift" name="shift" required>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thrusday">Thrusday</option>
                                        <option value="Friday">Friday</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="class_time">Class Time</label>
                                    <input type="text" class="form-control" id="class_time" name="class_time" required>
                                </div>
                                <div class="form-group">
                                    <label for="venue">Venue</label>
                                    <input type="text" class="form-control" id="venue" name="venue" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    <button type="button" class="btn btn-danger btn-block" onclick="clearForm()">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

@include('backend.layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('class_form');

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

</html>