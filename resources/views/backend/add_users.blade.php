<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.css')
    <title>Register Your User</title>
</head>
@include('backend.slidebar')
<style>
    .fcontainer {
        position: relative;
        margin-top: -580px;
    }
    .password-toggle {
        display: none;
    }
</style>

<body>
    <div class="fcontainer">
        @include('backend.header')
        <h1 class="mt-5 mb-4 text-center">Add your Users</h1>

        <div class="main-panel">  
            <div class="row justify-content-center">
                <!-- User Details -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Details</h5>
                            <form id="userForm" action="{{ url('store_users') }}" method="post" enctype="multipart/form-data">
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
                                    <input type="password" class="form-control" id="confirm" name="confirm_password" required>
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
    @include('backend.script')

    <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User added successfully!');
                    form.reset(); // Reset the form fields after successful submission
                } else {
                    alert('Failed to add user. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });
        });

        document.getElementById('password').addEventListener('focus', function() {
            document.querySelector('.password-toggle').style.display = 'block';
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var icon = this.querySelector('i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('mdi-eye');
                icon.classList.add('mdi-eye-off');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('mdi-eye-off');
                icon.classList.add('mdi-eye');
            }
        });
    </script>
</body>

</html>
