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
    <h1 class="mt-5 mb-4 text-center " style="padding-top: 28px;">Create Plans</h1>


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
                            <h5 class="card-title">Create Plan</h5>
                            <form id="plan_form" action="{{ url('add_plans') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Durations</label>
                                    <input type="text" class="form-control" id="duration" name="duration" required>
                                </div>
                                <div class="form-group">
                                    <label for="features">Features</label>
                                    <textarea class="form-control" id="features" name="features[]" required rows="5"></textarea>
                                    <small id="featuresHelp" class="form-text text-muted">Enter each feature on a new line.</small>
                                </div>
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('plan_form');

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
            document.getElementById('plan_form').reset();
        }
    </script>

</body>
@include('backend.layouts.footer')

</html>