<!DOCTYPE html>
<?php
$file = file_get_contents($errors->getFile());
$code_p = explode("\n", $file);

$line = 1;
?>
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
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Error 500 Server Error</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    /> -->

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-misc.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <!-- Error -->
    <div class="container mt-4">
     <!--  <div class="col-12 text-center mt-3">
        <h2 class="mb-2 mx-2">Server Error 500 :(</h2>
        <p class="mb-4 mx-2">Oops! 😖 Server Error please contact Web Administrator.</p>
        
      </div> -->
      <div class="row p-0">
      <div class="col-md-6">
      <div class="col-md-12 p-0">
      <div class="card">
        <div class="card-body">
            <div class="card-title text-danger h4">{{$errors->getMessage()}}</div>
            <div class="card-title"><strong>{{$errors->getFile()}}:{{$errors->getLine()}}</strong></div>
            <div class="card-title">Line: <strong>{{$errors->getLine()}}</strong></div>
        </div>
      </div>

      @foreach($errors->getTrace() as $trace)
      <div class="card mt-2 px-0">
            <div class="card-body px-2">
            <div class="card-title"><strong>{{$trace['file']}}</strong></div>
            <ul>

                @if($trace['line'])
                <li>line: <b>{{$trace['line']}}</b></li>
                @endif
                @if($trace['class'])
                <li>Class: <b>{{$trace['class']}}</b></li>
                @endif
                @if($trace['function'])
                <li>Function: @<b>{{$trace['function']}}</b></li>
                @endif
                @if($trace['args'])
                <li>arguments: </li>
              
                @endif
            </ul>
        </div>
      </div>
      @endforeach
         
      </div>
      </div>
      <div class="col-md-6 p-0" >
        <div style="position: relative; min-height:100%" class="w-100">
            <pre class="bg-dark py-5 text-light" style="position: absolute; top:0px; left:0px; width:100%; min-height:100%; line-height:8px;">   @foreach($code_p as $code)
            @if($line == $errors->getLine())
                 {{ $line  }} <span class="mx-4 text-danger">{{$code}}</span>
                 @else
                 {{ $line  }} <span class="mx-4">{{$code}}</span>
                 @endif
                 <?php $line++; ?>
                @endforeach
        </pre>
        </div>
      </div>
    </div>

      
      </div>
    </div>
    <!-- /Error -->

    <!-- / Content -->

  

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

   
  </body>
</html>