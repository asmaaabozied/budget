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
                                <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">@lang('site.salaries_wages')</a>
                                </li>
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

                                <div class="col-xl-9 p-0">
                                    <div class="g-2 m-0 p-2 row">

                                        @foreach($salaries->unique('transfer_month') as $salary)

                                        <div class="col-sm-4 col-xl-4  col-lg-6 box-col-6">
                                            <div class="card social-widget-card"
                                                 onclick="window.location='{{url('dashboard/salaries_wages/?date='.$salary->transfer_month)}}';">
                                                <div class="card-body">
                                                    <div class="" data-label="50%">

                                                        <h4>تحويلات  الرواتب للشهر

                                                            {{\Carbon\Carbon::parse($salary->transfer_month)->format('F')}}

                                                        </h4>
                                                        <br>

                                                       <h3>  {{$salary->transfer_month ?? ''}} </h3>

                                                    </div>
                                                    <br>
                                                    <h4 class="btn-primary btn">@lang('site.employees')<i
                                                                class="ri-arrow-left-line"></i></h4>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

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