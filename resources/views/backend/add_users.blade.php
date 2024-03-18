<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('backend.layouts.css')
</head>
@include('backend.layouts.slidebar')


<body>
    @include('backend.layouts.header')
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center">Add your Users</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        <div class="main-panel">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Details</h5>
                            <form id="userForm" action="/store_users" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="uname" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="uemail" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="upassword" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                                                <i class="mdi mdi-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm" name="upassword_confirmation" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select class="form-control" id="user_type" name="usertype" required>
                                        <option value="trainer">Trainer</option>
                                        <option value="member">Member</option>
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

    @include('backend.layouts.footer')

    <script>
        document.getElementById('password').addEventListener('focus', function() {
            document.querySelector('.password-toggle').style.display = 'block';
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var icon = this.querySelector('i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>

</body>

</html>