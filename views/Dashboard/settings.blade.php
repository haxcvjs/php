@include('Dashboard.layouts.header')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('Dashboard.layouts.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('Dashboard.layouts.navbar')


            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">


                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('dashboard.home')}}"><i class="bx bx-home me-1"></i> Back to Home</a>
                                </li>
                            </ul>
                            <div class="card mb-4">
                                <h5 class="card-header">Profile Details</h5>
                                <!-- Account -->
                                <div class="card-body">

                                </div>
                                <hr class="my-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <form id="formAccountSettings" class="ui-form" method="POST" action="{{route('dashboard.settings.info')}}">

                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label">Full Name</label>
                                                    <input class="form-control" type="text" id="fullname" name="fullname" value="{{$user['fullname']}}" autofocus="">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input class="form-control" type="text" id="email" name="email" value="{{$user['email']}}" placeholder="john.doe@example.com">
                                                </div>

                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <form id="formAccountSettings" class="ui-form" method="POST"  action="{{route('dashboard.settings.changepassword')}}">

                                                <div class="mb-3 form-password-toggle">
                                                    <label for="password" class="form-label">Current Password</label>
                                                    <div class="input-group input-group-merge mb-3">
                                                        <input type="password" id="password" class="form-control" name="password" placeholder="password" aria-describedby="password" />
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3 form-password-toggle">
                                                    <label for="new_password" class="form-label">New Password</label>
                                                    <div class="input-group input-group-merge mb-3">
                                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password" aria-describedby="confirm_password" />
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3 form-password-toggle">
                                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                                    <div class="input-group input-group-merge mb-3">
                                                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Re-password" aria-describedby="confirm_password" />
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>

                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-primary me-2">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Account -->
                            </div>
                            <!--   <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                          <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div> -->
                        </div>
                    </div>
                </div>
                <!-- / Content -->
                <div class="me-xl-0 d-xl-none" style="height: 200px;"></div>


                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<script>
    document.addEventListener('DOMContentLoaded' , function() {
        $('.ui-form').submit(function(e) {
            e.preventDefault();

            var data = $(this).serialize();
            $.post(this.action , data , function(response) {
                console.log(response);
            });
        });
    })
</script>
@include('Dashboard.layouts.footer')