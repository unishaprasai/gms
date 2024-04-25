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
    <div class="fcontainer">
        <h1 class="mt-5 mb-4 text-center" style="padding-top: 28px;">Add Announcement</h1>
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
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Announcement Details</h5>
                            <form id="announcementForm" action="/add_announcement" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="recipient">Recipient</label>
                                    <select class="form-control" id="recipient" name="recipient" required>
                                        <option value="trainer">Trainer</option>
                                        <option value="user">User</option>
                                        <option value="both">Both</option>
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

    @include('backend.layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('announcementForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: 'Confirm Submission',
                    text: 'Are you sure you want to submit this announcement?',
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
            document.getElementById('announcementForm').reset();
        }
    </script>

</body>

</html>
