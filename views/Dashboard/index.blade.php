@include('Dashboard.layouts.header', $user)
<?php

?>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    @include('Dashboard.layouts.sidebar', $user)

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->

      @include('Dashboard.layouts.navbar', $user)


      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y mt-5">
          <!-- Layout Demo -->
          <div class="row">
            <div class="col-md-8">
              <!-- Balance  Card -->
              <div class="card border-solid-1 bg-none border-radius-0 shadow-nones">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="cards py-3">
                        <div class="card-bodys">
                          @include('Dashboard.widgets.balance.total', ['balance' => $balance])
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="cards py-3">
                        <div class="card-bodys">
                          @include('Dashboard.widgets.balance.withdraw', ['balance' => $balance])
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mt-5">

                      @include('Dashboard.widgets.filter')
                    </div>
                  </div>
                </div>
              </div>
              <!-- Balance  Card -->

              <!-- Package  Card -->
              <div class="card border-solid-1 bg-none border-radius-0 p-0 mt-5 shadow-nones">
                <div class="card-body p-3">
                  <!-- <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light mx-1"></span> Mission Hall
                  </h4> -->
                  <div class="row mt-0">
                    <div class="col-12">
                      @include('Dashboard.widgets.package.simple', ['plans' => $plans, 'user' => $user] )
                    </div>
                  </div>
                </div>
              </div>
              <!-- Package  Card -->

            </div>
            <div class="col-md-4">
              @include('Dashboard.widgets.balance.deposit', ['user' , $user])
            </div>
          </div>

          <!--/ Layout Demo -->
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