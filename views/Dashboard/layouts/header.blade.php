<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title> Dashboard - </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

    <style>
      .balance {
        font-size: 30px;
        color: #000 !important;
      }

      .balance.f-20 {
        font-size: 25x !important;
        color: #000 !important;
      }
      
      .balance .title {
        font-size: 18px;
        font-weight: 500;
      }

      .balance i.bx-info-circle {
        position: absolute;
    top: 10px;
    right: 10px;
    font-size: 25px;

      }
      
      .balance .currency, .balance .balance {
        font-size: 90%;
        font-weight: 500;
      }
       
      .balance .chart {
        font-size: 45%;
        color: #31bd65 !important;
        font-weight: 500;
      }

      .text-green {
        color: #31bd65 !important;
      }

      .f-14 {
        font-size: 14px !important;
        font-weight: 500;
      }

      .nav-pills .nav-link.btn-white.active, .nav-pills .nav-link.btn-white.active:hover, .nav-pills .nav-link.btn-white.active:focus {
        background-color: #fff !important;
        color: #000 !important;
      }

      .border-solid-1 {
        border: solid 1px #eee !important;
      }
      
      .bg-none {
        background-color: transparent !important;
        background: transparent !important;
      }

      .border-radius-0 {
        border-radius: 0 !important;
      }
      .f-10 {
        font-size: 10px;
      }

      .effective {
        position: absolute;
        right: 0px;
        top: 0px;
        border-radius: 0px 0px 0px 10px !important;
      }
      
      .locker {
        position: absolute;
        right: 0px;
        top: 0px;
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
        min-height: 100%;
        z-index: 1;
        border-radius: 5px;
      }

      .unlock  {
        z-index: 2 !important;
    position: absolute !important;
    width: 100% !important;
    left: 0 !important;
    padding: 0 25px !important;
      }

      .loader {
        position: fixed;
        width: 100%;
        min-height: 100%;
        top: 0px;
        left:0px;
        background: #fff;
        z-index: 9999;
  
      }
      

    </style>


<?php



$balance = json_encode(app(\App\Models\Payment::class)->Balance());
$plans = (app(\App\Models\Plans::class)->All());
$plansObject = [];

foreach ($plans as $plan) {
  $plansObject[$plan['id']] = $plan;
}

$plansObject = json_encode($plansObject);
$user = \Core\Facades\User::get();

foreach (['password', 'mnemonic', 'xpub', 'private_key', 'private_key', 'withdraw_balance', 'account_balance'] as $key) {
  unset($user[$key]);
}

$user = json_encode($user);

?>
<script>
    window.WCconfig = {
        min: 10,
        balance: {!!$balance!!},
        plans: {!!$plansObject!!},
        user: {!!$user!!}

    }
</script>
  </head>

  <body>
    <div class="loader-parent">

      <div class="loader d-flex justify-content-center">
        <div class="m-auto">
          
          <div class="spinner-grow spinner-border-md text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow spinner-border-lg text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow spinner-border-md text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      </div>
    </div>

     @include('Dashboard.layouts.connect.notification')