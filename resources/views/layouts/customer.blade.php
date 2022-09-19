<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Spartan Cooperative</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{asset('customer\vendor\bootstrap\css\bootstrap.min.css')}}">
  <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('customer\vendor\bootstrap-icons\bootstrap-icons.css')}}">
  <!-- <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('customer\vendor\boxicons\css\boxicons.css')}}">
  <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('customer\vendor\quill\quill.snow.css')}}">
  <!-- <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('customer\vendor\quill\quill.bubble.css')}}">
  <!-- <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet"> -->

  <!-- <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('customer\vendor\remixicon\remixicon.css')}}">

  <link rel="stylesheet" href="{{asset('customer\css\style.css')}}">
  <!-- <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('customer\vendor\simple-datatables\style.css')}}">
  @yield('head')
  <!-- Template Main CSS File -->
  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('customer.partials._headernav')
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @include('customer.partials._sidebar')
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
    @include('customer.partials._footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <!-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script> -->
  <script src="{{asset('customer\vendor\apexcharts\apexcharts.min.js')}}"></script>
  <script src="{{asset('customer\vendor\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
  <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <script src="{{asset('customer\vendor\chart.js\chart.js')}}"></script>
  <!-- <script src="assets/vendor/chart.js/chart.min.js"></script> -->
  <script src="{{asset('customer\vendor\echarts\echarts.min.js')}}"></script>
  <!-- <script src="assets/vendor/echarts/echarts.min.js"></script> -->
  <!-- <script src="assets/vendor/quill/quill.min.js"></script> -->
  <script src="{{asset('customer\vendor\quill\quill.min.js')}}"></script>
  
  <script src="{{asset('customer\vendor\simple-datatables\simple-datatables.js')}}"></script>
  <!-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> -->

  <!-- <script src="assets/vendor/tinymce/tinymce.min.js"></script> -->
  <script src="{{asset('customer\vendor\tinymce\tinymce.js')}}"></script>
  <script src="{{asset('customer\js\main.js')}}"></script>

</body>

</html>