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

        </div>
        <!-- Individual column searching (text inputs) Starts-->

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
            <form action="{{ route('dashboard.salaries_wages_data.update',1) }}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="card-body">


                    <div class="align-items-end row">

                        <div class="col-md-6 col-12">
                            <label> @lang('site.transfer_month')</label>
                            <input type="date" name="transfer_month" class="form-control" required>
                        </div>
                        <!-- </div>

                                    <div class="row"> -->
                        <!-- <div class="col-md-6">
                                        </div> -->
                        <div class="col-md-6 col-12">
                            <button class="btn-primary btn mt-3" type="submit"> التحويل الان
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>




        <!-- Individual column searching (text inputs) Ends-->

        <!-- Container-fluid Ends-->


    </div>

</div>

</div>
@endsection