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
              <p class="mb-4">Please sign-in to your account and start the adventure</p> -->

          <form id="formAuthentication" class="mb-3" action="{{route('auth.login')}}" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus />
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{route('auth.recovery')}}">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grids w-100 btn-submit text-center" type="submit">Sign in</button>
              <input type="hidden" name="csrf_token" value="{{generate_csrf()}}">
            </div>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="/signup">
              <span>Create an account</span>
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
  document.addEventListener('DOMContentLoaded', function() {
    
    $('#formAuthentication').submit(function(e) {

      e.preventDefault();
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
          setTimeout(function() { location.href = "{{route('dashboard.home')}}"; },2000)
        }

        $('.error-toast').addClass('show');
      })
    })
  })
</script>
@include('Web.auth.layouts.footer')