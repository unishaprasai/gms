<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
  </head>
  @include('backend.layouts.slidebar')
  @include('backend.layouts.header')
  <body>

    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Add Trainers</h1>
        

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

<form action="{{ url('add_trainers') }}" method="post" enctype="multipart/form-data">
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
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    </div>
  
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var closeButton = document.getElementById('closeButton');
            if (closeButton) {
                closeButton.addEventListener('click', function () {
                    closeAlert();
                });
            }
        });

        function closeAlert() {
            var alertOverlay = document.querySelector('.alert-overlay');
            if (alertOverlay) {
                alertOverlay.remove();
            }
        }
    </script>
  </body>
  @include('backend.layouts.footer')
</html>
