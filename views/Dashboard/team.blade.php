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
          <div class="row mb-5">
            <div class="col-md-3">
              <div class="card py-3 mt-1">
                <div class="card-body">
                  @include('Dashboard.widgets.balance.total', ['balance' => $data['balance']])
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card py-3 mt-1">
                <div class="card-body">
                  @include('Dashboard.widgets.balance.withdraw', ['balance' => $data['balance']])
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card py-3 mt-1">
                <div class="card-body">
                  @include('Dashboard.widgets.balance.account', ['balance' => $data['balance']])
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card py-3 mt-1">
                <div class="card-body">
                  @include('Dashboard.widgets.balance.funding', ['balance' => $data['balance']])
                </div>
              </div>
            </div>
          </div>
          <!--/ Layout Demo -->
          @include('Dashboard.widgets.balance.payments' , ['title' => 'Recent Payments Records', 'data' => $data, 'filter' => 'none' ])
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
@include('Dashboard.layouts.footer')