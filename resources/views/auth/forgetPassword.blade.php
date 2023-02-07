<!DOCTYPE html>
@if(app()->getLocale()=='ar')
<html lang="ar" dir="rtl">
@else
<html lang="en" dir="ltr">
@endif

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
    <title>budget login</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">


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
    <style>
    body {
        font-family: 'Almarai', sans-serif !important;
    }
    </style>
    <!-- Responsive css-->

</head>

<body>
<div class="container-fluid">
        <div class="row">
    <main class="login-form mt-5">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h4 class="card-header text-center mt-3">@lang('site.Reset Password')</h4>
                        <div class="card-body">
                            <div class="text-center"><img
                                    src="{{asset('dashboardstyle/assets/images/new-img/Reset-password-pana.png')}}"
                                    width="250px"></div>
                            @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                            @endif

                            <form action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                <div class="form-group row">

                                    <label for="email_address" class="col-form-label">@lang('site.email')</label>
                                    <div class="col-md-12">
                                        <input type="text" id="email_address" class="form-control" name="email" required
                                            autofocus>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mt-3 mb-4">
                                    <button type="submit" class="btn btn-primary btn-block w-100">
                                        @lang('site.Send Password Reset')
                                    </button>
                                </div>
                                <p class="mt-4 mb-0 text-center">
                                    <a href="{{ route('login') }}" class="font-12 ms-2 px-1"
                                        style="font-weight: 600;">@lang('site.back') </a>

                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    
    </div>
    <div class="row">
    <footer class="footer" style="left:0">
            <div class="justify-content-between row">

                <div class="col-12 col-sm-auto d-flex text-center">
                    <p class="mb-0 text-600">


                    </p>

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                    $properties)
                    @if($properties['native']=='English')



                    <!-- item-->
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        class="dropdown-item mx-1 notify-item">
                        <img src="{{asset('dashboardstyle/assets/images/flags/us.png')}}" alt=" user-image" class="me-1"
                            height="12"> <span class="align-middle">{{ $properties['native'] }}</span>
                    </a>

                    @else

                    <!-- item-->
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        class="dropdown-item mx-1 notify-item">
                        <img src="{{asset('dashboardstyle/assets/images/flags/sa.png')}}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">{{ $properties['native'] }}</span>
                    </a>

                    @endif
                    @endforeach

                </div>
                <div class="col-12 col-sm-auto text-center">
                    <p class="mb-0 text-600">كل حقوق الطبع والنشر محفوظة<span class="d-none d-sm-inline-block">
                        </span><br class="d-sm-none"> 2023 © <a href="https://budget.help/">ميزانية</a></p>
                </div>
            </div>
        </footer></div>
    </div>

</body>

</html>
