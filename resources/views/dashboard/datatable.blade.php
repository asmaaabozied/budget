@extends('layouts.dashboard.app')
@section('style')

    <!-- Datatables css -->
    <link href="{{asset('dashboardstyle/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboardstyle/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboardstyle/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}"
          rel="stylesheet" type="text/css"/>


@endsection

@section('content')






    <!-- <div class="content-page"> -->
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                                href="{{url('ar/dashboard')}}">@lang('site.dashboard')</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>
                            <h4 class="page-title">{{$title}}({{$count}})</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


            </div> <!-- container -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="transactions-main">
                        <div class="top-items">
                            {{--                            <h6>{{$title}}({{$count}})</h6>--}}
                            <div class="export-area">
                                <ul class="d-flex align-items-center">
                                    {{--                                    <li class="breadcrumb-item active">--}}
                                    {{--                                        <a href="{{route('dashboard.welcome') }}">--}}
                                    {{--                                        <!-- @lang('site.dashboard') -->--}}
                                    {{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
                                    {{--                                                 viewBox="0 0 24 24"--}}
                                    {{--                                                 fill="none" stroke="currentColor" stroke-width="2"--}}
                                    {{--                                                 stroke-linecap="round"--}}
                                    {{--                                                 stroke-linejoin="round" class="feather feather-home">--}}
                                    {{--                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>--}}
                                    {{--                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </a>--}}

                                    {{--                                    </li>--}}
                                    {{--                                    <li class="breadcrumb-item">{{$title}}</li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-columns-preview">
                                <!-- <div class="table-responsive ooooo"> -->
                                {{--                    <table class="table w-100 nowrap " id="scroll-horizontal-datatable">--}}
                                <table id="fixed-columns-datatable"
                                       class="table table-striped nowrap row-border order-column w-100">

                                    {{--                        <table class="table table-striped nowrap row-border order-column w-100 dataTable no-footer" style="margin-left: 0px; width: 1155.95px;"><thead>--}}

                                    {!! $dataTable->table([], true) !!}
                                </table>
                            </div>
                        </div>
                        {{--                    <!-- </div> -->--}}
                    </div>
                </div>
            </div>


        </div> <!-- content -->


    </div>









@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            // $(".alert").delay(5000).slideUp(300);
            $(".alert").slideDown(300).delay(5000).slideUp(300);
        });
        setTimeout(function () {
            $('.alert-box').remove();
        }, 30000);
    </script>
    <br>

    {{--    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">--}}
    {{--    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>--}}

    <!-- Datatables js -->
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('dashboardstyle/assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>

    <script src="/vendor/datatables/buttons.server-side.js"></script>


{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            jQuery('.delete').click(function (event) {--}}
{{--                event.preventDefault();--}}


{{--                console.log("Tapped Delete button")--}}
{{--                var that = $(this)--}}
{{--                e.preventDefault();--}}
{{--                var n = new Noty({--}}
{{--                    text: "@lang('site.confirm_delete')",--}}
{{--                    type: "error",--}}
{{--                    killer: true,--}}
{{--                    buttons: [--}}
{{--                        Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {--}}
{{--                            that.closest('form').submit();--}}
{{--                        }),--}}
{{--                        Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {--}}
{{--                            n.close();--}}
{{--                        })--}}
{{--                    ]--}}
{{--                });--}}
{{--                n.show();--}}


{{--            });--}}
{{--        });--}}
{{--    </script>--}}



    {!! $dataTable->scripts() !!}

    <script>
        function confirmDelete($id) {
            console.log("Tapped Delete button")
            var that = document.getElementById("deleteForm" + $id);
            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "error",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        that.submit();
                    }),
                    Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
        }

        $(document).ready(function () {

            $("#deleteForm").on('click', "#delete", function (e) {

                console.log("Tapped Delete button")
                var that = $(this)
                e.preventDefault();
                var n = new Noty({
                    text: "@lang('site.confirm_delete')",
                    type: "error",
                    killer: true,
                    buttons: [
                        Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                            that.closest('form').submit();
                        }),
                        Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                            n.close();
                        })
                    ]
                });
                n.show();

            });


        });
    </script>


@endsection