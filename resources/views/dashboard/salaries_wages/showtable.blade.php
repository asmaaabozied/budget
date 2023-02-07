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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.salaries_wages')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.addSalary') </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.salaries_wages')</h4>
                </div>
            </div>

            <div class="row0">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="bg-secondary-lighten card-header">
                            <h4 class="card-title">@lang('site.employee')</h4>

                            <div class="dashboard-nav">
                                <div class="single-item language-area">
                                    <div class="language-btn">

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <table id="users-data-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.basic_salary')</th>
                                        {{--                                            <th>@lang('site.fixed_transportation')</th>--}}
                                        <th>@lang('site.penalty')</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $total = 0;?>


                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }} {{ $user->father_name }} {{ $user->family_name }}
                                            <input type="hidden" name="employee_id[]" value="{{$user->id}}">
                                        </td>
                                        <td>{{\App\User::where('id',$user->id)->first()->basic_salary ?? ''}}
                                        </td>
                                        {{--                                            <td>{{\App\Models\SalaryWege::where('employee_id',$user->id)->first()->fixed_transportation ?? ''}}--}}
                                        {{--                                            </td>--}}
                                        <td>{{\App\User::where('id',$user->id)->first()->total_salary ?? 0 }}
                                        </td>
                                    </tr>


                                    <?php $salary=\App\User::where('id', $user->id)->first()->total_salary ?? 0;   $total = $total + $salary  ;     ?>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>


                    </div>
                    <br>
                    <h4 class="list-group-item-primary text-center p-2">@lang('site.penalty'):{{$total}}</h4>
                    <br>
                    <br>
                    <br>
                </div>

                {{--                    {{ $users->links() }}--}}


                {{--                    <form action="{{route('dashboard.salaries_wages_data.show',1)}}"
                method="get">--}}
                <button class="btn-primary btn w-100"
                    onclick="window.location='{{ route('dashboard.salaries_wages_data.show',1) }}';">

                    {{--                        <input type="hidden" name="request_data" value="{{$request_data}}">--}}

                    التالي</button>

                {{--                    </form>--}}
                <!-- Individual column searching (text inputs) Ends-->
            </div>
        </div>
        <!-- Container-fluid Ends-->


    </div>
</div>
</div>


@endsection


@section('scripts')

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
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

$(document).ready(function() {
    $('#users-data-table').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        },
        "columnDefs": [{
                "targets": [5],
                "searchable": false
            },
            {
                "bSortable": false,
                "aTargets": [0, 5]
            }
        ],
        /* active column position */
        "order": [
            [3, "asc"]
        ]
    });
});
</script>

@endsection