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
          <h4 class="mb-2">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
          <!-- <h4 class="mb-2">Welcome to {{app('config.app')['name']}}! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p> -->

          <form id="formAuthentication" class="mb-3" action="{{route('auth.recovery')}}" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
            </div>

            <div class="mb-3">
              <button class="btn btn-primary d-grids w-100 btn-submit text-center" type="submit">Recover</button>
              <input type="hidden" name="csrf_token" value="{{generate_csrf()}}">
            </div>
            <div class="text-center">
              <a href="{{route('auth.login')}}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
              </a>
            </div>
          </form>


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

    $('#formAuthentication').submit(function(e) {

      e.preventDefault();


     
      var email = $('#email').val().replace(/\s+/ig, '');

      if (!email) {
        return showError('Email is Required');
      }


      var prev = $('.btn-submit').html();
      $('.btn-submit').html(`<i class="spinner-border spinner-border-sm"></i>`).attr('disabled', 1);

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
           
        }

        $('.error-toast').addClass('show');
      })
    })
  })
</script>
@include('Web.auth.layouts.footer')