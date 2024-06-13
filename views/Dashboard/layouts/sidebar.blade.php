<!-- Menu -->
<?php

 

$current_route = app(\Core\Http\Request::class)->getPathInfo();

 
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme fw-semibold">
          <div class="app-brand demo">
            <a href="{{route('dashboard.home')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
                 <img src="/logo.png" alt="Logo" width="40">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2 text-dark" style="text-transform: capitalize;">{{app('config.app')['name']}}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ route('dashboard.home') == $current_route ? 'active' : ''}}">
              <a href="{{route('dashboard.home')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">{{__('Dashboard')}}</div>
              </a>
            </li>

             
            
            

            <li class="menu-item {{ route('dashboard.mission') == $current_route ? 'active' : ''}} mt-3">
              <a href="{{route('dashboard.mission')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bx-task"></i>
                <div data-i18n="Boxicons">{{__('Daily Missions')}}</div>
              </a>
            </li>
            <li class="menu-item {{ route('dashboard.vip') == $current_route ? 'active' : ''}} mt-1">
              <a href="{{route('dashboard.vip')}}" class="menu-link">
                <img class="menu-icon text-dark tf-icons "   src="data:image/svg+xml;utf8,%3Csvg viewBox='0 0 24 24' width='1em' height='1em' xmlns='http://www.w3.org/2000/svg' %3E%3Cpath fill='currentColor' d='M4.878 3.003h14.254a1 1 0 0 1 .809.412l3.822 5.256a.5.5 0 0 1-.037.633l-11.354 12.3a.5.5 0 0 1-.735 0L.283 9.305a.5.5 0 0 1-.037-.633l3.823-5.256a1 1 0 0 1 .809-.412Z'/%3E%3C/svg%3E">
                <div data-i18n="Boxicons">{{__('VIP')}}</div>
              </a>
            </li>

            
            <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text"></span></li> -->
            <li class="menu-item {{ route('dashboard.balance') == $current_route ? 'active' : ''}}">
              <a href="{{route('dashboard.balance')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bxs-wallet"></i>
                <div data-i18n="Tables">{{__('Balance')}}</div>
              </a>
            </li>
            <li class="menu-item {{ route('dashboard.withdraw') == $current_route ? 'active' : ''}}">
              <a href="{{route('dashboard.withdraw')}}" class="menu-link">
                <img  class="menu-icon text-dark tf-icons" src="data:image/svg+xml;utf8,%3Csvg viewBox='0 0 24 24' width='1em' height='1em' xmlns='http://www.w3.org/2000/svg' %3E%3Cpath fill='currentColor' d='M22 2H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h3v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-9h3a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1ZM7 20v-2a2 2 0 0 1 2 2Zm10 0h-2a2 2 0 0 1 2-2Zm0-4a4 4 0 0 0-4 4h-2a4 4 0 0 0-4-4V8h10Zm4-6h-2V7a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v3H3V4h18Zm-9 5a3 3 0 1 0-3-3a3 3 0 0 0 3 3Zm0-4a1 1 0 1 1-1 1a1 1 0 0 1 1-1Z'/%3E%3C/svg%3E" >
                <div data-i18n="Tables">{{__('Withdraw')}}</div>
              </a>
            </li>
            <li class="menu-item {{ route('dashboard.deposit') == $current_route ? 'active' : ''}}">
              <a href="{{route('dashboard.deposit')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bxs-dollar-circle"></i>
                <div data-i18n="Tables">{{__('Deposit')}}</div>
              </a>
            </li>
            <li class="menu-item {{ route('dashboard.payments') == $current_route ? 'active' : ''}}">
              <a href="{{route('dashboard.payments')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bx-trending-up"></i>
                <div data-i18n="Tables">{{__('Payments Records')}}</div>
              </a>
            </li>
            <li class="menu-item {{ route('dashboard.team') == $current_route ? 'active' : ''}}">
              <a href="{{route('dashboard.team')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bxs-user"></i>
                <div data-i18n="Tables">{{__('Affilate')}}</div>
              </a>
            </li>
            <li class="menu-item" style="">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="lottery">Lottery &amp; Bits</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-misc-error.html" class="menu-link">
                    <div data-i18n="Error">Bits</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-misc-error.html" class="menu-link">
                    <div data-i18n="Error">Lotteries</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-misc-error.html" class="menu-link">
                    <div data-i18n="Error">My Tickets</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-misc-under-maintenance.html" class="menu-link">
                    <div data-i18n="Under Maintenance">My Bits</div>
                  </a>
                </li>
              </ul>
            </li>
            
          <!--   <li class="menu-item {{ route('dashboard.home') == $current_route ? 'actives' : ''}}">
              <a href="{{route('dashboard.home')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bx-gift"></i>
                <div data-i18n="Tables">{{__('Casino')}}</div>
              </a>
            </li>
            
            <li class="menu-item {{ route('dashboard.home') == $current_route ? 'actives' : ''}}">
              <a href="{{route('dashboard.home')}}" class="menu-link">
                <i class="menu-icon text-dark tf-icons bx bx-tag"></i>
                <div data-i18n="Tables">{{__('Lottery')}}</div>
              </a>
            </li> -->

              
            
            
            <li class="menu-item  mt-3 {{ route('dashboard.support') == $current_route ? 'active' : ''}}">
              <a
                href="{{route('dashboard.support')}}"
                
                class="menu-link"
              >
                <i class="menu-icon text-dark tf-icons bx bx-support"></i>
                <div data-i18n="Support">{{__('Support')}}</div>
              </a>
            </li>
            <li class="menu-item ">
              <a
                href="{{route('logout')}}"
                 
                class="menu-link"
              >
                <i class="menu-icon text-dark tf-icons bx bx-log-out"></i>
                <div data-i18n="Documentation">{{__('Log Out')}}</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->