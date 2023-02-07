<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('dashboardstyle/assets/images/fav.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title> @lang('otp.title') </title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
          rel="stylesheet">


    <!-- App css-->
    <link href="{{asset('dashboardstyle/assets/css/mainstyle.css')}}" rel="stylesheet" type="text/css" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('dashboardstyle/assets/images/fav.png')}}">
    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{asset('dashboardstyle/assets/vendor/daterangepicker/daterangepicker.css')}}">

    <!-- Vector Map css -->
    <link rel="stylesheet"
          href="{{asset('dashboardstyle/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">

    <!-- Theme Config Js -->
    <script src="{{asset('dashboardstyle/assets/js/hyper-config.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('dashboardstyle/assets/css/app-saas.min.css')}}" rel="stylesheet" type="text/css"
          id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('dashboardstyle/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive css-->

</head>

<body>
<!-- login page start-->
<div class="container-fluid">
    <div class="row">
{{--        <div class="align-items-center col-xl-5 d-flex justify-content-center"--}}
{{--             style="    background: linear-gradient(193deg, #093af4, #093af4);"><img class="bg-img-cover bg-center"--}}
{{--                                                                                     src="{{asset('dashboardstyle/assets/images/new-img/login.png')}}" alt="looginpage">--}}
{{--            <!--budget-->--}}
{{--        </div>--}}
        <div class="col-12 p-0">

            @include('google2fa.partials.otp-code',['registerPage' => false])

        </div>
    </div>
    <!-- Vendor js -->
    <script src="{{asset('dashboardstyle/assets/js/vendor.min.js')}}"></script>

    <!-- Daterangepicker js -->
    <script src="{{asset('dashboardstyle/assets/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

    <!-- Apex Charts js -->
    <script src="{{asset('dashboardstyle/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector Map js -->
    <script
            src="{{asset('dashboardstyle/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}">
    </script>
    <script
            src="{{asset('dashboardstyle/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}">
    </script>

    <!-- Dashboard App js -->
    <script src="{{asset('dashboardstyle/assets/js/pages/demo.dashboard.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('dashboardstyle/assets/js/app.min.js')}}"></script>

</div>

</body>

</html>