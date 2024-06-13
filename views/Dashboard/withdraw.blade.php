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


            <div class="col-md-6 col-lg-6 m-auto">

              <div class="card text-centers mb-3">
                <div class="card-header alert-dark">
                  @include('Dashboard.widgets.balance.withdraw' , ['balance' => $data['balance'], 'buttons' => 'none'])
                </div>
                <div class="card-body p-4 text-dark">


                  <div class="mt-2 mb-3 ">
                    <label for="amount" class="form-label">Amount min (10 USDT)</label>
                    <div class="input-group input-group-merge">

                      <span class="input-group-text">USDT</span>
                      <input id="amount" class="form-control form-control-lg text-dark fw-bold" type="number" value="" placeholder="10-1000000" autofocus>
                      <span class="input-group-text cursor-pointer text-primary fw-bold" id="basic-default-password" onclick="$('#amount').val(WCconfig.balance.withdrawBalance) ">Max</span>
                    </div>
                  </div>
                  <div class="mt-2 mb-3">
                    <label for="Address" class="form-label">TRC20 (USDT) Address</label>
                    <div class="input-group input-group-merge">
                      <input id="Address" class="form-control form-control-lg fw-semibold text-dark" type="text" value="TZuaeKRrnJdU8Yi5t66x1UcuSJkLTsqrFX" placeholder="Address">
                      <span class="input-group-text cursor-pointer text-primary fw-bold" id="basic-default-address" onclick="pasteFromClipoard() ">paste</span>
                    </div>
                  </div>
                  <div class="mt-2 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control form-control-lg" type="password" value="" placeholder="Password">
                  </div>
                  <div class="mt-2 mb-3">
                    <ul class="list-group">
                      <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                        <strong class="f-14 text-dark">Fee</strong>
                        <span class="balance"><span class="currency"></span> <span class="charts f-14">1 {{currency('USDT')}}</span></span>
                      </li>
                      <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                        <strong class="f-14 text-dark">You will recieved</strong>
                        <span class="balance"><span class="currency"></span> <span class="charts f-14"><b class="fee-balance"></b> {{currency('USDT')}}</span></span>
                      </li>
                    </ul>

                  </div>
                  <hr>
                  <!-- <p class="card-text">Please do not recharge other non-TRC20 (USDT) assets. The funds will arrive in your account in about 1 to 3 minutes after recharging..</p> -->
                  <button class="btn btn-primary btn-lg w-100" type="button" id="withdraw" onclick="Withdraw()">Withdraw</button>
                </div>
              </div>
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

@include('Dashboard.widgets.modals.message')

<script>
  function pasteFromClipoard() {

    navigator.clipboard
      .readText()
      .then((clipText) => (document.querySelector("#Address").value = clipText));
  }

  setInterval(function() {
    var amount = $('#amount').val();
    var address = $('#Address').val();
    var password = $('#password').val();
    var withdraw = $('#withdraw').val();

    $('.fee-balance').html((amount - 1) < 1 ? '0' : amount - 1);

    if (amount < WCconfig.min || amount > WCconfig.balance.withdrawBalance) {
      $('#withdraw').attr('disabled', 1);
      return;
    }

    if (password.replace(/\s+/ig, '') == '' || address.replace(/\s+/ig, '') == '') {
      $('#withdraw').attr('disabled', 1);
      return;
    }

    $('#withdraw').removeAttr('disabled');
  }, 100);


  function Withdraw(id) {


    $('#completeBtn').attr('disabled', '1');
    $('#completeBtn .bx').removeClass('bx-task');
    $('#completeBtn .bx').addClass('spinner-border spinner-border-sm');

    $.post("{{route('dashboard.withdraw')}}", {
      amount: $('#amount').val(),
      address: $('#Address').val(),
      password: $('#password').val(),
      csrf_token: '{{generate_csrf()}}',
    }, function(response) {
      try {

        response = JSON.parse(response);
      } catch (e) {
        response = {
          error: 1,
          message: '{{__("Error try Again")}}'
        }
      }


      $('#modal-message').removeClass('text-dark');
      $('#modal-message').removeClass('text-danger');

      if (response.error) {

        /*  $('#completeBtn .bx').removeClass('spinner-border spinner-border-sm').addClass('bx-task');
         $('#completeBtn').removeClass('disabled') */

        $('#modal-message').addClass('text-danger');
      } else {
        /*  $('#completeBtn').attr('disabled', '1').removeClass('btn-dark').addClass('alert-success text-dark')
         $('#completeBtn .bx').removeClass('spinner-border spinner-border-sm').addClass('bx-check')
         $('#completeBtn .msg').html('Done'); */
        $('#modal-message').addClass('text-dark');

        setTimeout(() => {
          // location.reload();
        }, 2000);
      }

      $('#modal-message').html(response.message);

      $('#messageModal').modal('show');

    });
  }
</script>
@include('Dashboard.layouts.footer')