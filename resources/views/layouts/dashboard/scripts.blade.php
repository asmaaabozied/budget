

<!-- Vendor js -->
<script src="{{asset('dashboardstyle/assets/js/vendor.min.js')}}"></script>
<!--  Select2 Js -->
<script src="{{asset('dashboardstyle/assets/vendor/select2/js/select2.min.js')}}"></script>
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
<!-- Bootstrap Wizard Form js -->
<script
        src="{{asset('dashboardstyle/assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}">
</script>

<!-- Wizard Form Demo js -->
<script src="{{asset('dashboardstyle/assets/js/pages/demo.form-wizard.js')}}"></script>
<!-- Dashboard App js -->
<script src="{{asset('dashboardstyle/assets/js/pages/demo.dashboard.js')}}"></script>

<!-- App js -->
<script src="{{asset('dashboardstyle/assets/js/app.min.js')}}"></script>

<script src="{{asset('js/dashboard/notifications.js')}}"></script>

{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                jQuery('.delete').click(function (event) {--}}
{{--                    event.preventDefault();--}}


{{--                    console.log("Tapped Delete button")--}}
{{--                    var that = $(this)--}}

{{--                    var n = new Noty({--}}
{{--                        text: "@lang('site.confirm_delete')",--}}
{{--                        type: "error",--}}
{{--                        killer: true,--}}
{{--                        buttons: [--}}
{{--                            Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {--}}
{{--                                that.closest('form').submit();--}}
{{--                            }),--}}
{{--                            Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {--}}
{{--                                n.close();--}}
{{--                            })--}}
{{--                        ]--}}
{{--                    });--}}
{{--                    n.show();--}}


{{--                });--}}
{{--            });--}}
{{--        </script>--}}
@yield('scripts')

