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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    <!-- Responsive css-->
    <style>
    .footer {
        position: initial;
        padding: 12px 16px 12px;
        font-size: 13px;
    }
    </style>

</head>

<body>
    <!-- login page start-->
    <div class="container-fluid">
        <div class="row">
            <div class="align-items-center col-xl-5 d-flex justify-content-center"
                style="    background: linear-gradient(193deg, #093af4, #093af4);"><img class="bg-img-cover bg-center"
                    src="{{asset('dashboardstyle/assets/images/new-img/login.png')}}" alt="looginpage">
                <!--budget-->
            </div>
            <div class="col-xl-7 p-0 h-100">
                <form action="{{ route('login') }}" method="post" class="login-form">
                    {{ csrf_field() }}
                    {{ method_field('post') }}


                    <div class="login-card">
                        <div>

                            <div><a class="logo-login "><img class="img-fluid for-light" width="200px" height="100px"
                                        src="{{asset('dashboardstyle/assets/images/logo.png')}}" alt="looginpage"></a>
                                <div class="login-main">
                                    @include('partials._errors')

                                    <h4>{{ __('site.login') }}

                                    </h4>
                                    <p>{{ __('site.enter_pass_email') }}


                                    </p>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('site.email') }} </label>
                                        <input class="form-control" type="email" required="" placeholder="Email"
                                            name="email">
                                    </div>


                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('site.password') }}

                                        </label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="password" name="password" required=""
                                                placeholder="*********">
                                            <div class="show-hide"><span class="show"> </span></div>
                                        </div>
                                        <p class="font-13 mt-2">
                                            <a href="{{ route('forget.password.new') }}">{{ __('site.forget_password') }} </a>
                                        </p>
                                    </div>
                                    <div class="form-group mt-3">
                                        <!-- <div class="checkbox p-0">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                                checked="">
                                            <label class="text-muted" for="checkbox1">Remember password</label>
                                        </div> -->

                                        <button class="btn btn-primary btn-block w-100" type="submit">{{ __('site.login') }}  </button>
                                    </div>
                                    <!-- <h6 class="text-muted mt-4 or">Or Sign in with</h6> -->
                                    <!-- <div class="social mt-4">
                                            <div class="btn-showcase"><a class="btn btn-light"
                                                    href="https://www.linkedin.com/login" target="_blank"><i
                                                        class="txt-linkedin" data-feather="linkedin"></i> LinkedIn
                                                </a><a class="btn btn-light" href="https://twitter.com/login?lang=en"
                                                    target="_blank"><i class="txt-twitter"
                                                        data-feather="twitter"></i>twitter</a><a class="btn btn-light"
                                                    href="https://www.facebook.com/" target="_blank"><i class="txt-fb"
                                                        data-feather="facebook"></i>facebook</a></div>
                                        </div> -->
                                    <p class="mt-4 mb-0 text-center">{{ __('site.dont_have_an_account') }}
                                        ؟<a href="{{ route('register') }}" class="font-12 ms-2 px-1"
                                            style="font-weight: 600;">{{ __('site.sing_up') }}</a>

                                    </p>


                                </div>
                            </div>
                        </div>
                </form>

            </div>
            <footer class="footer ">
                <div class="justify-content-between row">

                    <div class="col-12 col-sm-auto d-flex text-center">
                        <p class="mb-0 text-600"></p>


                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                        $properties)
                        @if($properties['native']=='English')



                        <!-- item-->
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="dropdown-item mx-1 notify-item">
                            <img src="{{asset('dashboardstyle/assets/images/flags/us.png')}}" alt=" user-image"
                                class="me-1" height="12"> <span class="align-middle">{{ $properties['native'] }}</span>
                        </a>

                        @else

                        <!-- item-->
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="dropdown-item mx-1 notify-item">
                            <img src="{{asset('dashboardstyle/assets/images/flags/sa.png')}}" alt="user-image"
                                class="me-1" height="12"> <span class="align-middle">{{ $properties['native'] }}</span>
                        </a>

                        @endif
                        @endforeach

                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600">{{ __('site.copy_right') }}<span class="d-none d-sm-inline-block">
                            </span><br class="d-sm-none"> 2023 © <a href="https://budget.help/">{{ __('site.budget') }}</a></p>
                    </div>
                </div>
            </footer>

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
