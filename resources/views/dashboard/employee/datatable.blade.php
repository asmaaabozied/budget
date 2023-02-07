@extends('layouts.dashboard.app')
@section('style')

<!-- Datatables css -->
<link href="{{asset('dashboardstyle/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{asset('dashboardstyle/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link
    href="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{asset('dashboardstyle/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{asset('dashboardstyle/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{asset('dashboardstyle/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />




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
                            <li class="breadcrumb-item"><a href="{{url('ar/dashboard')}}">@lang('site.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$title}}({{$count}})</h4>
                </div>
                <!-- end page title -->

            </div>

            <!-- end page title -->

            <form method="get" action="{{route('dashboard.employee.index')}}">


                <div class="row">
                    <div class="col-md-2">

                        <label>@lang('site.company')</label>


                        <!-- Multiple Select -->
                        <select class="select2 form-control " data-toggle="select2" data-placeholder="Choose..."
                            name="companies">
                            <option selected disabled>@lang('site.select')</option>

                            @foreach(\App\Models\Branch::where('type','company')->get() as $company)
                            <option value="{{$company->id}}"> {{$company->name}}
                            </option>
                            @endforeach


                        </select>

                    </div>

                    <div class="col-md-2">

                        <label>@lang('site.branch')</label>

                        <select class="select2 form-control" data-placeholder="Choose..." name="branches"
                            data-toggle="select2">

                            <option selected disabled>@lang('site.select')</option>
                            @foreach(\App\Models\Branch::where('type','branch')->get() as $branch)
                            <option value="{{$branch->id}}"> {{$branch->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">

                        <label>@lang('site.categories')</label>
                        <!-- Multiple Select -->
                        <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose..."
                            name="categories">
                            <option selected disabled>@lang('site.select')</option>
                            @foreach(\App\Models\category::get() as $category)
                            <option value="{{$category->id}}"> {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>@lang('site.project')</label>
                        <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose..."
                            name="projects">

                            <option selected disabled>@lang('site.select')</option>
                            @foreach(\App\Models\Branch::where('type','project')->get() as $project)
                            <option value="{{$project->id}}"> {{$project->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-md-2">
                        <br>
                        <button type="submit" class="btn-primary form-control ">@lang('site.search')</button>
                    </div>


                </div>
            </form>

        </div> <!-- container -->

        <div class="row">
            <div class="col-xl-12">
                <div class="transactions-main">
                    <div class="top-items">
                        <div class="export-area">
                            <ul class="d-flex align-items-center">


                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="fixed-columns-preview">


                            <table id="fixed-columns-datatable"
                                class="table table-striped nowrap row-border order-column w-100">


                                {!! $dataTable->table([], true) !!}
                            </table>
                        </div>
                    </div>
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