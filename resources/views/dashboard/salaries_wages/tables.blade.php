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
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.salaries_wages')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.addSalary')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.salaries_wages')</h4>
                </div>
            </div>

        </div>

        <form action="{{route('dashboard.salaries_wages_data.create')}}" method="get">


            <div class="row">
                <input type="hidden" name="startDate" value="{{Session::get('startDate')}}">
                <div class="col-md-2">

                    <label>@lang('site.company')</label>


                    <!-- Multiple Select -->
                    <select class="select2 form-control " data-toggle="select2" data-placeholder="Choose..."
                        name="companies">
                        <option selected disabled>@lang('site.select')</option>

                        @foreach(\App\Models\Branch::where('type','company')->get()  as  $company)
                        <option value="{{$company->id}}"> {{$company->name ?? ''}}
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
                        <option value="{{$branch->id}}"> {{$branch->name ?? ''}}
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
                        <option value="{{$category->id}}"> {{$category->name ?? ''}}
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
                    <button type="submit" class="btn-primary form-control">@lang('site.search')</button>
                </div>


            </div>
        </form>

        <form action="{{ route('dashboard.salaries_wages_data.store') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
            {{ method_field('post') }}

            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="bg-secondary-lighten card-header">
                            <h4 class="card-title">@lang('site.employee')</h4>

                            <div class="dashboard-nav">
                                <div class="single-item language-area">
                                    <div class="language-btn">

                                    </div>
                                    <ul class="main-area language-content">

                                        <li>

                                            <h4>اضافة استقطاع</h4>
                                            <a class="btn-primary btn" onclick="Socialinsurancediscount()">
                                                @lang('site.Social insurance deduction')
                                            </a>

                                            <a class="btn-primary btn" onclick="absance()">

                                                @lang('site.Absencess') </a>


                                            <a class="btn-primary btn" onclick="Residence()">
                                                @lang('site.Residencess')
                                            </a>


                                            <a class="btn-primary btn" onclick="Addmoredeductions()">
                                                @lang('site.Addthewantedfromthedues')
                                            </a>

                                            {{--                                            <a class="btn-primary btn" onclick="Addmoredeductions()">--}}
                                            {{--                                                @lang('site.Add more cuts')--}}
                                            {{--                                            </a>--}}
                                            {{----}}

                                        </li>

                                        <li>
                                            <h4>اضافة استحقاق</h4>


                                            <a class="btn-primary btn" onclick="outofwork()">

                                                خارج الدوام
                                            </a>
                                            <a class="btn-primary btn" onclick="merit()">



                                                @lang('site.incentives')
                                            </a>

                                            <a class="btn-primary btn" onclick="aspirantdues()">

                                                @lang('site.Add more cuts')
                                            </a>

                                        </li>


                                    </ul>
                                </div>
                            </div>

                        </div>

                        <!-- <input type="hidden" name="hiring_date" value="{{$startDate}}"> -->
                        <!-- <div class="card-body"> -->
                        <!-- <table class="table table-striped table-bordered" style="width:100%"> -->
                        <!-- {{--                                <thead>--}}
                                {{--                                    <tr>--}}
                                {{--                                        <th>--}}
                                {{--                                            <input type="checkbox" id="select-all" checked>--}}

                                {{--                                            @lang('site.name')--}}
                                {{--                                        </th>--}}
                                {{--                                        <th>@lang('site.basic_salary')</th>--}}
                                {{--                                        --}}{{--                                            <th>@lang('site.fixed_transportation')</th>--}}
                                {{--                                        <th style="display:none" id="merit">@lang('site.Otherdues')</th>--}}
                                {{--                                        <th style="display:none" id="outofwork">@lang('site.outofhours')</th>--}}
                                {{--                                        <th style="display:none" id="aspirantdues">@lang('site.Add more cuts')</th>--}}
                                {{--                                        <th style="display:none" id="reconnaissance">@lang('site.Other deductions')</th>--}}
                                {{--                                        <th style="display:none" id="Addmoredeductions">--}}


                                {{--                                            @lang('site.Addthewantedfromthedues') </th>--}}
                                {{--                                        <th style="display:none" id="Socialinsurancediscount">--}}
                                {{--                                            @lang('site.Social insurance deduction')--}}
                                {{--                                        </th>--}}
                                {{--                                        <th style="display:none" id="absance">--}}
                                {{--                                        </th>--}}
                                {{--                                    </tr>--}}
                                {{--                                </thead>--}} -->

                        <input type="hidden" name="hiring_date" value="{{$startDate}}">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="name-table">
                                            <input type="checkbox" id="select-all" checked>

                                            @lang('site.name')
                                        </th>
                                        <th>@lang('site.basic_salary')</th>
                                        {{--                                            <th>@lang('site.fixed_transportation')</th>--}}
                                        <th style="display:none" id="merit">@lang('site.incentives')
                                        </th>
                                        <th style="display:none" id="outofwork">
                                            @lang('site.outofhours')</th>
                                        <th style="display:none" id="aspirantdues">

                                            @lang('site.Add more cuts')
                                        </th>
                                        <th style="display:none" id="reconnaissance">
                                            @lang('site.Other deductions')</th>
                                        <th style="display:none" id="Addmoredeductions">

                                            @lang('site.Addthewantedfromthedues')
                                            </th>
                                        <th style="display:none" id="Socialinsurancediscount">
                                            @lang('site.Social insurance deduction')
                                        </th>
                                        <th style="display:none" id="absance">

                                            @lang('site.Absencess')
                                        </th>
                                        <th style="display:none" id="Residence">

                                            @lang('site.Residencess')
                                        </th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>

                                        <td>
                                            <input type="checkbox" name="selcectemployee[]" value="{{$user->id}}"
                                                checked>

                                            {{ $user->name ?? '' }} {{ $user->father_name  ?? ''}}
                                            {{ $user->family_name  ?? ''}}

                                            <input type="hidden" name="employee_id[]" value="{{$user->id}}"
                                                class="form-control">
                                        </td>
                                        <td>{{\App\User::where('id',$user->id)->first()->basic_salary ?? ''}}


                                            <input type="hidden" name="basic_salary[]"
                                                value="{{\App\User::where('id',$user->id)->first()->basic_salary ?? ''}}"
                                                class="form-control">

                                        </td>
                                        {{--                                            <td>{{\App\Models\SalaryWege::where('employee_id',$user->id)->first()->fixed_transportation ?? ''}}--}}
                                        {{--                                            </td>--}}

                                        <td style="display:none" class="merits"><input type="text" name="merits[]"
                                                value="0" class="form-control">
                                        </td>

                                        <td style="display:none" class="outofwork"><input type="text" name="outofwork[]"
                                                value="0" class="form-control">
                                        </td>

                                        <td style="display:none" class="aspirantdues"><input type="text"
                                                name="aspirantdues[]" value="0" class="form-control">
                                        </td>

                                        <td style="display:none" class="reconnaissance"><input type="text"
                                                name="reconnaissance[]" value="0" class="form-control">
                                        <td style="display:none" class="Addmoredeductions"><input type="text"
                                                name="Addmoredeductions[]" value="0" class="form-control">
                                        </td>

                                        <td style="display:none" class="Socialinsurancediscount">
                                            <input type="text" name="Socialinsurancediscount[]" value="0"
                                                class="form-control">
                                        </td>
                                        <td style="display:none" class="absance"><input type="text" name="absance[]"
                                                value="0" class="form-control">
                                        </td>

                                        <td style="display:none" class="Residence"><input type="text" name="Residence[]"
                                                value="0" class="form-control">
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                        <!-- </table> -->
                    </div>
                </div>
            </div>


            <!-- </div> -->

            {{--                {{ $users->links() }}--}}

            <button class="btn-primary btn" type="submit"> التالي</button>
            <!-- Individual column searching (text inputs) Ends-->

        </form>

        <!-- Container-fluid Ends-->

    </div>

</div>
<!-- </div> -->


@endsection


@section('scripts')

<!-- {{--<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>--}} -->
<script>
// {{--$("#add-form").submit(function(e) {--}}


// {{--    e.preventDefault();--}}
// {{--    var data = $("#add-form").serialize();--}}

// {{--    console.log(data);--}}
// {{--    var url = '{{route('--}}
// {{--    dashboard.salaries_wages_data.create ')}}';--}}
// {{--    $.ajax({--}}
// {{--        url: url,--}}
// {{--        method: 'get',--}}
// {{--        cache: false,--}}
// {{--        processData: false,--}}
// {{--        contentType: false,--}}
// {{--        //enctype: 'multipart/form-data',--}}
// {{--        data: new FormData(document.getElementById("add-form")),--}}
// {{--        success: function(response) {--}}

// {{--            if (response.success) {--}}
// {{--                // $('#spinnerss').hide();--}}
// {{--                {--}}
// {{--                    {--}}
// {{--                        --window.location.href = '{{route('--}}
// {{--                        dashboard.products.index ')}}';--}}
// {{--                        ----}}
// {{--                    }--}}
// {{--                }--}}


// {{--            } else {--}}
// {{--                alert("Error")--}}
// {{--            }--}}
// {{--        }--}}

// {{--    });--}}
// {{--});--}}


$('#select-all').click(function(event) {
    if (this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});






function Addmoredeductions() {
    document.getElementById("Addmoredeductions").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('Addmoredeductions');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function Residence() {
    document.getElementById("Residence").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('Residence');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function absance() {
    document.getElementById("absance").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('absance');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function aspirantdues() {
    document.getElementById("aspirantdues").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('aspirantdues');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function Socialinsurancediscount() {
    document.getElementById("Socialinsurancediscount").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('Socialinsurancediscount');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function merit() {
    document.getElementById("merit").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('merits');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function outofwork() {
    document.getElementById("outofwork").removeAttribute("style");
    // document.getElementsByClassName("merits").style.display = "block";
    const boxes = document.getElementsByClassName('outofwork');
    for (const box of boxes) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        // box.style.display = 'block';
        box.removeAttribute("style");
    }

    // console.log('data');
}

function reconnaissance() {
    document.getElementById("reconnaissance").removeAttribute("style");;
    // document.getElementsByClassName("merits").style.display = "block";
    const reconnaissances = document.getElementsByClassName('reconnaissance');
    for (const reconnaissance of reconnaissances) {
        // 👇️ hides element
        // box.style.visibility = 'hidden';

        // 👇️ removes element from DOM
        reconnaissance.removeAttribute("style");
    }

    // console.log('data');
}
</script>

@endsection