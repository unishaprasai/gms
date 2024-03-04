<!DOCTYPE html>
<html lang="en">

<head>
<base href="/public">
    @include('backend.css')
    <title>Gym Membership Form</title>
</head>
@include('backend.slidebar')
<style>
    .fcontainer {
        position: relative;
        margin-top: -650px;
    }

    .alert-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        max-width: 400px;
        z-index: 9999;
    }

    .alert-box {
        padding: 20px;
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: .25rem;
    }
</style>

<body>
    <div class="fcontainer">
        @include('backend.header')
        <h1 class="mt-5 mb-4 text-center">Update Trainers</h1>


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
                                <h5 class="card-title">Update Trainer Details</h5>

                                <form action="{{ url('/update_trainers' . $trainer->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="tname">Trainer Name</label>
                                        <input type="text" class="form-control" id="tname" name="tname" 
                                        value="{{ $trainer->trainer_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="temail">Email</label>
                                        <input type="email" class="form-control" id="temail" name="temail"
                                        value="{{ $trainer->trainer_email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="taddress">Address</label>
                                        <input type="text" class="form-control" id="taddress" name="taddress"
                                        value="{{ $trainer->trainer_address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tphone">Phone Number</label>
                                        <input type="tel" class="form-control" id="tphone" name="tphone"
                                        value="{{ $trainer->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salary</label>
                                        <input type="number" class="form-control" id="salary" name="salary" 
                                        value="{{ $trainer->salary}}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="trainer_date_of_join">Date of Joining</label>
                                        <input type="date" class="form-control" id="trainer_date_of_join" name="trainer_date_of_join" 
                                        value="{{ $trainer->date_of_join }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="assign_exercise">Assign Exercise</label>
                                        <select class="form-control" id="assign_exercise" name="assign_exercise"
                                        value="{{ $trainer->Assign_exercise }}" required>
                                            <option value="basic">Basic</option>
                                            <option value="premium">Premium</option>
                                            <option value="gold">Gold</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        <a href="{{ url('/view_trainers') }}" class="btn btn-lg btn-danger ml-2">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var closeButton = document.getElementById('closeButton');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
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
        function closeAlert() {
            var alertOverlay = document.querySelector('.alert-overlay');
            if (alertOverlay) {
                alertOverlay.remove();
            }
            // Redirect to the view members page
            window.location.href = "{{ url('/view_tariners') }}";
        }
    </script>
</body>

</html>