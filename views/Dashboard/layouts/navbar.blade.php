<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>

  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->
      <!-- <li class="nav-item lh-1 me-5">
        <i class="bx bx-support fs-3"></i>
      </li> -->


      <!-- Balance -->

      <li class="nav-item navbar-dropdown dropdown-user dropdown d-xnone d-lg-inline-block d-md-inline-block " style="position: relative; left:13px; z-index:1">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="box-container">
            <button class="btn  alert-secondary border-0 fw-semibold text-dark btn-lg wallet-balance text-dark fw-bold w-balance" style="border-radius: 4px 0 0px 4px; font-size:13px">0.00 <i class="bx bx-money"></i></button>
          </div>
        </a>

      </li>
      <!--/ Balance -->

      <a href="{{route('dashboard.deposit')}}" class="btn bg-dark text-white  px-3 fw-semibold btn-lg d-xnone d-lg-inline-block d-md-inline-block" style="z-index: 1; font-size:12px; border-radius:4px"> <i class="bx bx-wallet"></i> Deposit</a>


      <li class="nav-item lh-1 mx-4" style="position: relative;" >
        <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" href="javascript:void();" aria-controls="offcanvasBoth" onclick="$.post('{{route('connect.seen')}}')"><i class="bx bxs-bell fs-4 text-dark mt-2"></i>
          <span class="badge bg-danger rounded-pill" style="position: absolute; top: 2px; right: -3px; font-size: 9px; padding: 5px;" id="not-count"></span>
        </a>
      </li>

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-onlines">
            <img src="/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="{{route('dashboard.balance')}}">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <i class="w-px-40 h-auto rounded-circle bx bx-wallet" ></i>
                  
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block w-balance">0.00</span>
                  <small class="text-muted">{{currency('USDT')}}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('dashboard.settings')}}">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Account Settings</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('dashboard.support')}}">
              <i class="bx bx-support me-2"></i>
              <span class="align-middle">Support</span>
            </a>
          </li>
         <!--  <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-info-circle me-2"></i>
              <span class="align-middle">How it works ?</span>
            </a>
          </li> -->
         <!--  <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Billing</span>
                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
              </span>
            </a>
          </li> -->
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="auth-login-basic.html">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>


<!-- <div class="me-xl-0 d-xl-none" style="position: fixed; bottom:0px; width:100%; z-index:99;">
  <div class="row">
    <div class="col-md-12">
      <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>
      </nav>
    </div>
  </div>
</div> -->