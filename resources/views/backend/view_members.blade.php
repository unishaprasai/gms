<!DOCTYPE html>
<html lang="en">

<head>
   
    @include('backend.css')
    <title>Gym Membership Details</title>
</head>
@include('backend.slidebar')
<style>
    .fcontainer {
        position: relative;
        margin-top: -580px;
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
        <h1 class="mt-5 mb-4 text-center">View Members</h1>

        @if(session('success'))
        <div class="alert-overlay">
            <div class="alert-box">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn btn-success btn-block" onclick="closeAlert()">Okay</button>
            </div>
        </div>
        @endif

        <div class="row justify-content-end">
            <!-- Membership Details Table -->
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mx-auto">
                                <thead>
                                    <tr class="heading">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Date of Joining</th>
                                        <th>Membership Type</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                    <tr>
                                        <td>
                                            <!-- Display image -->
                                            <!-- <img src="/photos/{{$member->photo}}" alt="Member Image"> -->
                                        </td>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->email}}</td>
                                        <td>{{$member->address}}</td>
                                        <td>{{$member->phone}}</td>
                                        <td>{{$member->date_of_join}}</td>
                                        <td>{{$member->membership_type}}</td>
                                        <td>{{$member->shift}}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <a href="{{url('edit_members',$member->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <!-- Delete button with confirmation message -->
                                            <a href="{{url('delete_members',$member->id)}}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.script')

    <script>
function closeAlert() {
        var alertOverlay = document.querySelector('.alert-overlay');
        if (alertOverlay) {
            alertOverlay.remove();
        }
    }    </script>
</body>

</html>