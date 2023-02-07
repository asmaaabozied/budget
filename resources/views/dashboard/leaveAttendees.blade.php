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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.LeaveAttendence')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.Receipt of the employee') </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.LeaveAttendence')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->


            <div class="col-xl-12  dashboard-sec box-col-12">
                <div class="card0 earning-card">
                    <div class="card-body p-0">
                        <div class="row m-0 gap-4">
                            <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 p-0">
                                <div class="card social-widget-card"
                                    onclick="window.location='{{route('dashboard.attendees.index')}}';">
                                    <div class="card-body text-center">
                                        <div class="" data-label="50%">
                                            <img src="{{asset('dashboardstyle/assets/images/new-img/signin.png')}}"
                                                class="img-card">
                                        </div>
                                        <h5 class="b-t-light"> @lang('site.attendees')</h5>

                                    </div>
                                </div>
                            </div>
                            <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 p-0">
                                <div class="card social-widget-card"
                                    onclick="window.location='{{route('dashboard.leaves.index')}}';">
                                    <div class="card-body text-center">


                                        <div class="" data-label="50%"><img
                                                src="{{asset('dashboardstyle/assets/images/new-img/signout.png')}}"
                                                class="img-card">
                                        </div>
                                        <h5 class="b-t-light">@lang('site.leaves')</h5>

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