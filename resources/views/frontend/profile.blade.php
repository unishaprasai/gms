
<section class="common-hero type-banner">
    <div class="section-container">
        <div class="custom-container">
            <div class="text-container center">
                <div class="section-title">
                    <h1 class="type-white">Edit your profile</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-xxl py-5" style="display:flex; justify-content:center; align-items:center;">
    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
        <div class="card h-100">
            <form action="/profile" method="POST">
                @method('PATCH')
                @csrf
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2 class="mb-2 text" style="color:#d23f1e;text-align:center;">Personal Details</h2>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">First Name</label>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="eMail">Last Name</label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Email</label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters" style="margin-top:15px">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-center">
                                <button id="submit" class="btn btn-primary" style="background-color: #d23f1e; border-color:#d23f1e">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
        <div class="text-center">
            <a href="/profile/orderHistory"><button class="btn btn-primary" style="background-color: #303030; border-color:#303030;padding:10px;">Order History</button></a>
        </div>
        <div class="text-center" style="margin-top: 20px;">
            <button id="submit" class="btn btn-primary" style="background-color: #303030; border-color:#303030;padding:10px;">Booking History</button>
        </div>
    </div>
</div>

@endsection
