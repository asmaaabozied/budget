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
                            <li class="breadcrumb-item active"> @lang('site.Receipt of the employee') </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.salaries_wages')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->


            <div class="col-xl-12  dashboard-sec box-col-12">
                <div class="card earning-card">
                    <div class="card-body p-0">
                        <div class="row m-0">

                            <div class="col-xl-12 p-0">
                                <div class="g-2 m-0 p-2 row">


                                    <div class="col-sm-6 col-lg-3 box-col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.salaries_wages_data.index')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%">

                                                    <h3>الرواتب الشهرية</h3>
                                                    <br>
                                                    @lang('site.salaryemployeeswedges')

                                                    <br>
                                                </div>
                                                <br>
                                                <h4 class="btn-primary btn"> بدء مسير الرواتب <i
                                                        class="ri-arrow-left-line"></i></h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6  col-lg-3 box-col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.salaries_wages_translation')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%">

                                                    <h3> سجل الرواتب</h3>
                                                    <br>
                                                    متابعة مسيرات الرواتب السابقة

                                                    <br>
                                                </div>
                                                <br>
                                                <h4 class="btn-primary btn"> متابعة مسيرات الرواتب <i
                                                        class="ri-arrow-left-line"></i> </h4>

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>

@endsection