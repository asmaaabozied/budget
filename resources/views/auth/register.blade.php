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
    <title>budget Register</title>
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
            <div class="col-xl-7 p-0">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <input id="user_type" hidden type="text" name="user_type" value="Admin" required>


                    <div class="login-card">
                        <div>

                            <div><a class="logo-login "><img class="img-fluid for-light" width="200px" height="100px"
                                        src="{{asset('dashboardstyle/assets/images/logo.png')}}" alt="looginpage"></a>
                                <div class="login-main">
                                    @include('partials._errors')
                                    <h4>التسجيل

                                    </h4>
                                    <p>سجل الأن بكل سرعة وسهولة</p>

                                    <input id="user_type" hidden type="text" name="user_type" value="Admin" required>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">{{ __('site.name') }}</label><a
                                            href="#" data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>

                                        <!-- <div class="col-md-6"> -->
                                        <input id="name" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                        <!-- </div> -->
                                    </div>



                                    <div class="form-group">
                                        <label for="email" class="col-form-label">{{ __('site.email') }}</label><a
                                            href="#" data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>

                                        <!-- <div class="col-md-6"> -->
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                        <!-- </div> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-form-label">{{ __('site.phone') }}</label><a
                                            href="#" data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>
                                        <!-- <div class="col-md-6"> -->
                                        <input id="phone" type="phone"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            name="phone" value="{{ old('phone') }}" required>

                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                        <!-- </div> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label">{{ __('site.company') }}</label><a
                                            href="#" data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>

                                        <!-- <div class="col-md-6"> -->
                                        <input type="text"
                                            class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}"
                                            name="company" required>

                                        @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                        @endif
                                        <!-- </div> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="password"
                                            class="col-form-label">{{ __('site.company_name_en') }}</label><a href="#"
                                            data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>

                                        <!-- <div class="col-md-6"> -->
                                        <input type="text"
                                            class="form-control{{ $errors->has('company_en') ? ' is-invalid' : '' }}"
                                            name="company_en" required>

                                        @if ($errors->has('company_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_en') }}</strong>
                                        </span>
                                        @endif
                                        <!-- </div> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">{{ __('site.password') }}</label><a
                                            href="#" data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>

                                        <!-- <div class="col-md-6"> -->
                                        <input id="password" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <!-- </div> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm"
                                            class="col-form-label">{{ __('site.confirmpassword') }}</label><a href="#"
                                            data-bs-toggle="tooltip" data-bs-title="الخانة مطلوبة"><span
                                                class="text-danger">*</span></a>

                                        <!-- <div class="col-md-6"> -->
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required>
                                        <!-- </div> -->
                                    </div>

                                    <div class="form-group mt-3">

                                        <button type="submit" class="btn btn-primary btn-block w-100">
                                            {{ __('site.Register') }}
                                        </button>

                                    </div>
                                    <p class="mt-4 mb-0 text-center"> لديك حساب
                                        ؟<a href="{{ route('login') }}" class="font-12 ms-2 px-1"
                                            style="font-weight: 600;">تسجيل الدخول</a>

                                    </p>


                                </div>
                            </div>
                        </div>
                </form>

            </div>
            <footer class="footer">
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
                        <p class="mb-0 text-600">كل حقوق الطبع والنشر محفوظة<span class="d-none d-sm-inline-block">
                            </span><br class="d-sm-none"> 2023 © <a href="https://budget.help/">ميزانية</a></p>
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