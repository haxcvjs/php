@include('Web.auth.layouts.header')
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="/logo.png" alt="Logo" width="40">
                            </span>
                            <!--  <span class="app-brand-text demo text-body fw-bolder">{{app('config.app')['name']}}</span> -->
                        </a>
                    </div>
                    <!-- /Logo -->
                    <!-- <h4 class="mb-2">Welcome to {{app('config.app')['name']}}! 👋</h4>
                    <p class="mb-4">Get started and Register and start earnings </p> -->

                    <form id="formRegiseration" class="mb-3" action="{{route('auth.signup')}}" method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your Fullname" autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="email" class="form-label">Password</label>
                            <div class="input-group input-group-merge mb-3">
                                <input type="password" id="password" class="form-control" name="password" placeholder="password" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="email" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge mb-3">
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Re-password" aria-describedby="confirm_password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <!-- <label for="email" class="form-label">Invitation code</label> -->
                        <div class="input-group input-group-merge mb-3">
                            <input type="hidden" id="code" class="form-control" name="code" placeholder="4DA608" value="{{$code}}" />
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grids w-100 btn-submit" type="submit">Sign up</button>
                            <input type="hidden" name="csrf_token" value="{{generate_csrf()}}">
                        </div>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{route('auth.login')}}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->


<script>
    function showError(message) {
        $('.error-toast').removeClass('bg-success');
        $('.error-toast').addClass('bg-danger');
        $('.error-toast .icon').removeClass('bx-error');
        $('.error-toast .icon').removeClass('bx-check-circle');
        $('.error-toast .title').html('Error')
        $('.error-toast .toast-body').html(message)
        $('.error-toast').addClass('show');
    }

    document.addEventListener('DOMContentLoaded', function() {

        $('#formRegiseration').submit(function(e) {

            e.preventDefault();

            var password = $('#password').val().replace(/\s+/ig, '');
            var confirm_password = $('#confirm_password').val().replace(/\s+/ig, '');
            var email = $('#email').val().replace(/\s+/ig, '');

            if (!email) {
                return showError('Email is Required');
            }
            
            if (!password) {
                return showError('Password is Required');
            }

            if (!confirm_password) {
                return showError('please Confirm Password');
            }
            
            if (password != confirm_password) {
                return showError('Passwords doesn\'t matches');
            }
            
            if(password.length < 6 ) {
                return showError('Passwords should be more than 6 digits');
            }
            




            var prev = $('.btn-submit').html();
            $('.btn-submit').html(`<i class="spinner-border spinner-border-sm"></i>`);//.attr('disabled', 1);

            $.post(this.action, $(this).serialize(), function(response) {
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    response = {
                        error: 1,
                        message: 'Error try Again'
                    }
                }


                $('.error-toast .toast-body').html(response.message)
                $('.error-toast').removeClass('bg-danger');
                $('.error-toast').removeClass('bg-success');
                $('.error-toast .icon').removeClass('bx-error');
                $('.error-toast .icon').removeClass('bx-check-circle');
                if (response.error) {
                    $('.btn-submit').html(prev).removeAttr('disabled');
                    $('.error-toast .title').html('Error')
                    $('.error-toast').addClass('bg-danger');
                    $('.error-toast .icon').addClass('bx-error');
                } else {
                    $('.btn-submit').html('redirecting...').addClass('bg-dark');
                    $('.error-toast .title').html('Success')
                    $('.error-toast').addClass('bg-success');
                    $('.error-toast .icon').addClass('bx-check-circle');
                    setTimeout(function() {
                        location.href = "{{route('dashboard.home')}}";
                    }, 2000)
                }

                $('.error-toast').addClass('show');
            })
        })
    })
</script>


@include('Web.auth.layouts.footer')