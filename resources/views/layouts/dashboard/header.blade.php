<!doctype html>
@if(app()->getLocale()=='ar')
    <html lang="ar" dir="rtl">
    @else
        <html lang="en" dir="ltr">
        @endif

        <head>
            <meta charset="utf-8"/>
            <title>Dashboard | Budget</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
            <meta content="Coderthemes" name="author"/>

            <!-- Scripts and styles , with customized vite directive -->
            {{-- will disabled untill migrate all css and js files to compiling using vite --}}

{{--            {{--}}
{{--                Vite::useHotFile(storage_path('vite.hot'))--}}
{{--                    ->useBuildDirectory('build-main')--}}
{{--                    ->useManifestFilename('main_manifest.json')--}}
{{--                    ->withEntryPoints(['resources/assets/sass/app.scss','resources/assets/js/app.js'])--}}
{{--            }}--}}

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- to prevent css MIME type error in live -->
            <base href="/">

            <!-- App favicon -->
            <link rel="shortcut icon" href="{{asset('dashboardstyle/assets/images/fav.png')}}">
            <!-- font-family -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                    href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:wght@300;400;500;600;800;900&display=swap"
                    rel="stylesheet">
            <!-- Daterangepicker css -->
            <link rel="stylesheet" href="{{asset('dashboardstyle/assets/vendor/daterangepicker/daterangepicker.css')}}">

            <!-- Vector Map css -->
            <link rel="stylesheet"
                  href="{{asset('dashboardstyle/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
            <!-- Select2 css -->
            <link href="{{asset('dashboardstyle/assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet"
                  type="text/css"/>


            <!-- Theme Config Js -->
            <script src="{{asset('dashboardstyle/assets/js/hyper-config.js')}}"></script>

            <!-- App css -->
            @if(app()->getLocale()=='ar')
                <link href="{{asset('dashboardstyle/assets/css/app-saas-rtl.min.css')}}" rel="stylesheet"
                      type="text/css"
                      id="app-style"/>
            @else
                <link href="{{asset('dashboardstyle/assets/css/app-saas.min.css')}}" rel="stylesheet" type="text/css"
                      id="app-style"/>
            @endif

            {{-- Do not edit these lines Never ,, it is very important for users inside budget app , we will use web and auth not sanctum to avoid problems with auth in tasks --}}
            {{-- TO DO , orgnize it better , use    window.Laravel = {!! json_encode([ ... etc --}}
            {{--  for notifications pusher service --}}
            <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

            <!-- GCM Manifest (optional if VAPID is used) -->
            @if (config('webpush.gcm.sender_id'))
                <link rel="manifest" href="/manifest.json">
            @endif

            @if(auth()->check())
                <script type="text/javascript">

                    Pusher.logToConsole = true;

                    var appHost = "{{ request()->getHttpHost() }}";
                    var loggedInWebUser = {!! json_encode(auth()->user()->toArray(), JSON_HEX_TAG) !!};
                    var webLocale = "{{ app()->getLocale() }}";
                    var dashboardUrl = appHost == 'budget.help' ? "{{ config('app.live_dashboard_url') }}" : "{{ config('app.url') }}";
                    var webUserToken = document.querySelector('meta[name="csrf-token"]').content;

                    console.log('update notifications dashboardUrl ', dashboardUrl);

                    var pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", {
                        useTLS: "{{ config('broadcasting.connections.pusher.options.useTLS') }}",
                        cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
                        authEndpoint: `${dashboardUrl}/broadcasting/auth`,
                        auth: {
                            headers: {
                                "Authorization": "Bearer" + " " + webUserToken,
                            }
                        }
                    });
                    // main system notifications
                    var mainSystemChannel = pusher.subscribe('private-App.User.' + loggedInWebUser.id);
                    // Tasks Module Notifications
                    var workspaceChannel = pusher.subscribe('private-workspace-tasks');

                    // this part responsible about web device notifications
                    window.Laravel = {!! json_encode([
                            'user' => Auth::user(),
                            'vapidPublicKey' => config('webpush.vapid.public_key'),
                            'pusher' => [
                                'key' => config('broadcasting.connections.pusher.key'),
                                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                            ],
                        ]) !!};

                </script>
            @endif


        <!-- Icons css -->
            <link href="{{asset('dashboardstyle/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
            <!-- add css-->
            <link href="{{asset('dashboardstyle/assets/css/mainstyle.css')}}" rel="stylesheet" type="text/css"/>


            <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
            <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>
            @yield('style')

        </head>
        <body>
        <!-- Begin page -->
        <div class="wrapper">

        @if (auth()->user())
            <!-- ========== Topbar Start ========== -->
                <div class="navbar-custom topnav-navbar">
                    <div class="container-fluid detached-nav">

                        <!-- Topbar Logo -->
                        <div class="logo-topbar">
                            <!-- Logo light -->
                            <a href="{{route('dashboard.Receiptemployee')}}" class="logo-light">
                        <span class="logo-lg">
                            <img src="{{asset('dashboardstyle/assets/images/logo.png')}}" alt="logo" height="22">
                        </span>
                                <span class="logo-sm">
                            <img src="{{asset('dashboardstyle/assets/images/logo-sm.png')}}" alt="small logo"
                                 height="22">
                        </span>
                            </a>

                            <!-- Logo Dark -->
                            <a href="{{route('dashboard.Receiptemployee')}}" class="logo-dark">
                        <span class="logo-lg">
                            <img src="{{asset('dashboardstyle/assets/images/logo-dark.png')}}" alt="dark logo"
                                 height="22">
                        </span>
                                <span class="logo-sm">
                            <img src="{{asset('dashboardstyle/assets/images/logo.png')}}" alt="small logo" height="22">
                        </span>
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>

                        <!-- Horizontal Menu Toggle Button -->
                        <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>

                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list d-lg-none">
                                {{--                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"--}}
                                {{--                               role="button"--}}
                                {{--                               aria-haspopup="false" aria-expanded="false">--}}
                                {{--                                <i class="ri-search-line noti-icon"></i>--}}
                                {{--                            </a>--}}
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="search" class="form-control" placeholder="Search ..."
                                               aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>

                            <li class="dropdown notification-list topbar-dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                                   role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="{{asset('dashboardstyle/assets/images/flags/us.png')}}" alt="user-image"
                                         class="me-0 me-sm-1" height="12">
                                    <span class="align-middle d-none d-lg-inline-block">English</span> <i
                                            class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">


                                    <!-- item-->


                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                                $properties)
                                    @if($properties['native']=='English')



                                        <!-- item-->
                                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                               class="dropdown-item notify-item">
                                                <img src="{{asset('dashboardstyle/assets/images/flags/us.png')}}"
                                                     alt=" user-image"
                                                     class="me-1" height="12"> <span
                                                        class="align-middle">{{ $properties['native'] }}</span>
                                            </a>

                                    @else

                                        <!-- item-->
                                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                               class="dropdown-item notify-item">
                                                <img src="{{asset('dashboardstyle/assets/images/flags/sa.png')}}"
                                                     alt="user-image"
                                                     class="me-1" height="12"> <span
                                                        class="align-middle">{{ $properties['native'] }}</span>
                                            </a>

                                        @endif
                                    @endforeach

                                </div>
                            </li>

                        {{--  all system notifications --}}
                        @include('partials.dashboard.notifications-card')

                        <!-- <li class="notification-list d-none d-sm-inline-block">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                            <i class="ri-settings-3-line noti-icon"></i>
                        </a>
                    </li> -->

                            <li class="notification-list d-none d-sm-inline-block">
                                <a class="nav-link" href="javascript:void(0)" id="light-dark-mode">
                                    <i class="ri-moon-line noti-icon"></i>
                                </a>
                            </li>

                            <li class="notification-list d-none d-md-inline-block">
                                <a class="nav-link" href="" data-toggle="fullscreen">
                                    <i class="ri-fullscreen-line noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center"
                                   data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                   aria-expanded="false">
                            <span class="account-user-avatar">

                                <img src="{{asset('images/employee/'.auth()->user()->image)}}"
                                     onerror="this.src='{{asset('images/employee/1671111127.png')}}'" width="100px"
                                     height="100px" alt="user-image" class="rounded-circle">
                            </span>
                                    <span>
                                <span class="account-user-name">مرحبا ! {{auth()->user()->username ?? ''}} </span>
                                <span class="account-position ">{{auth()->user()->name ?? '' }}</span>
                                <div
                                        class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title badge-secondary-lighten nav-link">
                                        <h6 class="text-overflow m-0">مرحبا !</h6>
                                    </div>

                                        <a href="{{route('dashboard.users.edit',auth()->user()->id)}}"
                                           class="dropdown-item notify-item">
                                        <i class="mdi mdi-face-man-profile me-1"></i>
                                        <span>@lang('site.Profile')</span>
                                    </a>

                                    <a href="{{route('dashboard.logout')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>@lang('site.logout')</span>
                                    </a>

                                </div>
                                </span>
                                </a>
                            </li>
                        </ul>

                        <!-- Topbar Search Form -->
                    </div>
                </div>
                <!-- ========== Topbar End ========== -->

                <!-- ========== Left Sidebar Start ========== -->
@endif