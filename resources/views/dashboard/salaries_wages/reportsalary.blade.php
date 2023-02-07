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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{$title}}({{$count}})</a>
                            </li>
                            <li class="breadcrumb-item active"> {{$title}} </li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$title}}({{$count}})</h4>
                </div>
            </div>

        </div>



        <form method="get" action="{{route('dashboard.salaries.index')}}">


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
                        @foreach(\App\Models\Branch::where('type','project')->get()  as  $project)
                        <option value="{{$project->id}}"> {{$project->name}}
                        </option>
                        @endforeach
                    </select>
                </div>



                <div class="col-md-2">
                    <br>
                    <button type="submit" class="btn-primary form-control">@lang('site.search')</button>
                </div>


            </div>
        </form>
        <br />
        <div class="row bg-secondary-lighten rounded row m-0">
            <div class="col-md-8 col-12">
                <h4 class="page-title">@lang('site.numberemployee')({{$countEmployee}})</h4>
            </div>

            <div class="col-md-4 col-12">

                <h4 class="page-title text-end">@lang('site.TotalSalary')({{$TotalSalary}})</h4>
            </div>
        </div>
        <div class="row">


            <div class="table-responsive">
                <table class="table">
                    {!! $dataTable->table([], true) !!}
                </table>
            </div>
        </div>

    </div>
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

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
{{--    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>--}}
<script src="/vendor/datatables/buttons.server-side.js"></script>

{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>--}}
{{--    <script type="application/json" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>--}}




<script>
$(document).ready(function() {
    jQuery('.delete').click(function(event) {
        event.preventDefault();


        console.log("Tapped Delete button")
        var that = $(this)
        e.preventDefault();
        var n = new Noty({
            text: "@lang('site.confirm_delete')",
            type: "error",
            killer: true,
            buttons: [
                Noty.button("@lang('site.yes')", 'btn btn-success mr-2',
                    function() {
                        that.closest('form').submit();
                    }),
                Noty.button("@lang('site.no')", 'btn btn-primary mr-2',
                    function() {
                        n.close();
                    })
            ]
        });
        n.show();


    });
});
</script>



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
                Noty.button("@lang('site.yes')", 'btn btn-success mr-2',
                    function() {
                        that.closest('form').submit();
                    }),
                Noty.button("@lang('site.no')", 'btn btn-primary mr-2',
                    function() {
                        n.close();
                    })
            ]
        });
        n.show();

    });


});
</script>


@endsection