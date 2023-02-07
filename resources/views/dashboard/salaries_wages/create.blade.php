@extends('layouts.dashboard.app')

@section('content')
<!-- <div class="content-page"> -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a
                                        href="javascript: void(0);">@lang('site.salaries_wages')</a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('site.addSalary') </li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{$title}}</h4>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="card">


                        <div class="card-body">

{{--                            <h4 class="card-title">@lang('site.addSalary')</h4>--}}
                            <form action="{{ route('dashboard.salaries_wages.index') }}" method="get"
                                enctype="multipart/form-data">



                                <div class="row">


                                    <div class="col-md-4 form-group col-12 p-2">

                                        <label>@lang('site.company')</label>


                                        <select class="form-control" name="company_id">
                                            <option selected value="0"> @lang('site.select')
                                            </option>


                                            @foreach(\App\Models\Branch::where('type','company')->get() as $company)
                                            <option value="{{$company->id}}"> {{$company->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.hiring_date')</label>
                                        <input  type="date" name="startDate" id="startDate" class="date-picker form-control" />
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <br>

                                        <button type="submit" class="btn-primary btn">@lang('site.search')</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- Individual column searching (text inputs) Ends-->
            </div>

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
                                    {{--                                    <li class="breadcrumb-item">{{$title}}</li>
                                    --}}
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

        </div>
        <!-- Container-fluid Ends-->
    </div>

</div>


@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // $(".alert").delay(5000).slideUp(300);
    $(".alert").slideDown(300).delay(5000).slideUp(300);
});
setTimeout(function() {
    $('.alert-box').remove();
}, 30000);
</script>
<br>

{{--    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>--}}

<!-- Datatables js -->
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}">
</script>
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}">
</script>
<script
    src="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}">
</script>
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}">
</script>
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}">
</script>
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
            Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function() {
                that.submit();
            }),
            Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function() {
                n.close();
            })
        ]
    });
    n.show();
}

$(document).ready(function() {

    $("#deleteForm").on('click', "#delete", function(e) {

        console.log("Tapped Delete button")
        var that = $(this)
        e.preventDefault();
        var n = new Noty({
            text: "@lang('site.confirm_delete')",
            type: "error",
            killer: true,
            buttons: [
                Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function() {
                    that.closest('form').submit();
                }),
                Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function() {
                    n.close();
                })
            ]
        });
        n.show();

    });


});
</script>


@endsection