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
              <h4>support</h4>
              <p>Container layout sets a <code>max-width</code> at each responsive breakpoint.</p>
            </div>
          </div>
          <!--/ Layout Demo -->
          <div class="col-md-12">
            <?php print_r($data); ?>
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
@include('Dashboard.layouts.footer')