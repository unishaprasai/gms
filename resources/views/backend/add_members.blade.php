
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
  </head>
  @include('backend.layouts.slidebar')
  <body>
    @include('backend.layouts.header')
    <h1 class="mt-5 mb-4 text-center">Gym Membership Form</h1>
        

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
                            <h5 class="card-title">Membership Details</h5>
                            <form action="{{ url('add_members') }}" method="post" enctype="multipart/form-data">
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
                                        <option value="basic">Basic</option>
                                        <option value="premium">Premium</option>
                                        <option value="gold">Gold</option>
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
