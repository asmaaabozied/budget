
@include('layouts.dashboard.header')


        @include('layouts.dashboard.aside')

        @include('sweetalert::alert')

        <!-- ========== Left Sidebar End ========== -->


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            @if (auth()->user() && auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))


        <div class="content-page">
            @else
            <div class="content-page m-0">@endif
                @yield('content')



                        <!-- ============================================================== -->
                            <!-- End Page content -->
                            <!-- ============================================================== -->

                        </div>
                        <!-- END wrapper -->

@include('layouts.dashboard.footer')