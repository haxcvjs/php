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
          <!-- Layout Demo -->
          <div class="layout-demo-wrapper">

            <div class="layout-demo-info">
              <h4></h4>
            </div>
          </div>
          <!--/ Layout Demo -->
          <div class="row">

            <div class="col-md-6 col-lg-5 m-auto">
              @include('Dashboard.widgets.balance.deposit', ['user' , $user, 'isButton' => true])
            </div>
          </div>
        </div>
        <!-- / Content -->

        <!-- <div class="me-xl-0 d-xl-none" style="height: 200px;"></div> -->

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

@include('Dashboard.widgets.modals.unlockconfirm')

<script>
  function verifyDeposit() {
    var element = '#completeBtn';

    var html = $(element).html();
    $(element).html(`<div class="spinner-border spinner-border-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>`).attr('disabled', '1');



    $.post("{{route('dashboard.deposit.verify')}}", {
      csrf_token: '{{generate_csrf()}}',
    }, function(response) {
      $('#deposit-link').attr('href', `{{route('dashboard.balance')}}`);
      try {
        response = JSON.parse(response)
        $('#deposit-message').html(response.message);


        if (response.error) {

          $(element).html(html);
          $(element).removeAttr('disabled')
          $('#deposit-link').hide();
          $('#modal-message').addClass('text-danger');
        } else {
          $(element).attr('disabled', '1').removeClass('btn-dark').addClass('alert-success text-dark')
          $(element).html('<i class="bx bx-check"></i> Success');
          $('#modal-message').addClass('text-dark');
          $('#deposit-link').hide();
          /* setTimeout(() => {
            location.reload();
          }, 3300); */
        }


      } catch (error) {
        $('#deposit-link').attr('href', `{{route('dashboard.vip')}}`).hide();
      }

      $('#modalToggle').modal('show');
    })

  }
</script>
@include('Dashboard.layouts.footer')