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
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">Add Trainers</h1>
        

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
                  <button type="button" class="btn btn-success btn-block" id="closeButton">Okay</button>
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
                            <h5 class="card-title">Membership Details</h5>

<form id="trainerform" action="{{ url('add_trainers') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="tname">Trainer Name</label>
        <input type="text" class="form-control" id="tname" name="tname" required>
    </div>
    <div class="form-group">
        <label for="temail">Email</label>
        <input type="email" class="form-control" id="temail" name="temail" required>
    </div>
    <div class="form-group">
        <label for="taddress">Address</label>
        <input type="text" class="form-control" id="taddress" name="taddress" required>
    </div>
    <div class="form-group">
        <label for="tphone">Phone Number</label>
        <input type="tel" class="form-control" id="tphone" name="tphone" required>
    </div>
    <div class="form-group">
        <label for="salary">Salary</label>
        <input type="number" class="form-control" id="salary" name="salary" required>
    </div>
    <div class="form-group">
        <label for="trainer_date_of_join">Date of Joining</label>
        <input type="date" class="form-control" id="trainer_date_of_join" name="trainer_date_of_join" required>
    </div>
    <div class="form-group">
        <label for="assign_exercise">Assign Exercise</label>
        <select class="form-control" id="assign_exercise" name="assign_exercise" required>
            <option value="basic">Basic</option>
            <option value="premium">Premium</option>
            <option value="gold">Gold</option>
        </select>
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
