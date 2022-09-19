<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spartan</title>
    <link rel="stylesheet" href="{{asset('dashboard\vendor\simple-line-icons\css\simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{asset('dashboard/css/styles.css')}}">
    @yield('head')
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    @include('admin.partials._topnav')

    <div class="main-container">
        @include('admin.partials._sidebar')

        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@stack('scripts')

<script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/popper.js/popper.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{asset('dashboard/js/carbon.js')}}"></script>
<script src="{{asset('dashboard/js/demo.js')}}"></script>
</body>
</html>
