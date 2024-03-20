<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
</head>
@include('backend.layouts.slidebar')

<body>
    @include('backend.layouts.header')
    <h1 class="mt-5 mb-4 text-center">Add Classes</h1>


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
                            <h5 class="card-title">Class Details</h5>
                            <form action="{{ url('add_class') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="classname">Class Name</label>
                                    <input type="text" class="form-control" id="classname" name="ClassName" required>
                                </div>
                                <div class="form-group">
                                    <label for="trainerid">Trainer ID</label>
                                    <input type="number" class="form-control" id="trainerid" name="trainerid" required>
                                </div>
                                <div class="form-group">
                                    <label for="shift">Shift</label>
                                    <select class="form-control" id="shift" name="shift" required>
                                        <option value="Morning">Morning</option>
                                        <option value="Evening">Evening</option>
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
    </script>

</body>
@include('backend.layouts.footer')

</html>