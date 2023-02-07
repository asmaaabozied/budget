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
                            <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li> -->
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.Receipt of the employee')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.Receipt of the employee')</h4>
                </div>
            </div>
        </div>


        <!-- end page title -->

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-xl-4 col-lg-12  morning-sec box-col-12">
                <div class="card o-hidden profile-greeting">
                    <div class="card-body">
                        <div class="media">
                            <div class="badge-groups w-100">
                                <div class="badge f-10 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-clock me-1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span id="txt">{{$date}} {{$dayName}}




                                    </span>

                                </div>
                                <!-- <div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div> -->
                            </div>
                        </div>
                        <div class="greeting-user text-center text-white">

                            <div class="profile-vector"><img class="img-fluid border-r-10"
                                    src="{{asset('images/employee/'.auth()->user()->image)}}"
                                    onerror="this.src='{{asset('images/employee/1671111127.png')}}'" alt="">
                            </div>
                            <h4 class="f-w-600 m-3 name-user"><span id="greeting">@lang('site.goodmorring')
                                    <span class="">{{auth()->user()->name ?? ''}}</span></span>
                                <span. class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span>
                            </h4>
                            <p>
                                <span class="notes font-16">
                                    @lang('site.Tip of the Day') : {{$note}}</span>
                            </p>
                            <!-- <div class="whatsnew-btn"><a class="btn " data-bs-original-title="" title="">Whats New
                                            !</a></div>
                                    <div class="left-icon"><i class="fa fa-bell"> </i></div> -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-8  dashboard-sec box-col-12">
                <div class="card earning-card m-0">
                    <div class="card-body p-0">
                        <div class="row m-0">
                            <div class="col-xl-3 earning-content">
                                <div class="row m-0 chart-left">
                                    <div class="col-xl-12 p-0 left_side_earning">


                                        {{--                                              {{Auth::user()->company->country}}--}}
                                        <h5>@lang('site.date'):</h5>
                                        <p class="font-roboto"> {{ $date ?? ''}} {{$dayName ?? ''}}</p>

                                        <h5>@lang('site.hourss')</h5>

                                        <p class="font-roboto">
                                            @if(auth::user()->company)
                                            @if(auth::user()->company->country==1)
                                            <a id="time_is_link" rel="nofollow" style="font-size:36px"></a>
                                            <span id="Riyadh_z439" style="font-size:36px"></span>
                                            @endif
                                            @else


                                            <a id="time_is_link" rel="nofollow" style="font-size:36px"></a>
                                            <span id="Al_Mansurah_z00c" style="font-size:36px"></span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>@lang('site.Remaining salarys') :</h5>
                                        <p class="font-roboto">{{$remainday ?? ''}} @lang('site.day')</p>
                                    </div>
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>@lang('site.ratingss'): </h5>
                                        <p class="font-roboto">{{$rate ?? ''}}من 10</p>
                                    </div>

                                    <div class="col-xl-12 p-0 left-btn"
                                        onclick="window.location='{{route('dashboard.employee.show',\Illuminate\Support\Facades\Auth::id())}}';">
                                        <a class="btn btn-primary"> @lang('site.my private information')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 p-0">
                                <div class="g-2 m-0 p-2 row">
                                    <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.messagers.index')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%">
                                                    <img src="{{asset('dashboardstyle/assets/images/new-img/message.png')}}"
                                                        class="border-r-10 w-75">
                                                </div>
                                                <h5 class="b-t-light"> @lang('site.message')</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('tasks.board')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%"><img
                                                        src="{{asset('dashboardstyle/assets/images/new-img/5.png')}}"
                                                        class="border-r-10 w-75">
                                                </div>

                                                <h5 class="b-t-light">@lang('site.dailydays')</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.linkeds.index')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%">
                                                    <img src="{{asset('dashboardstyle/assets/images/new-img/4.png')}}"
                                                        class="border-r-10 w-75">
                                                </div>
                                                <h5 class="b-t-light">@lang('site.linkeds')</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.leaveAttendees')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%"><img
                                                        src="{{asset('dashboardstyle/assets/images/new-img/1.png')}}"
                                                        class="border-r-10 w-75">
                                                </div>
                                                <h5 class="b-t-light"> @lang('site.LeaveAttendence')</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.ratings.index')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%"><img
                                                        src="{{asset('dashboardstyle/assets/images/new-img/2.png')}}"
                                                        class="border-r-10 w-75">
                                                </div>
                                                <h5 class="b-t-light"> @lang('site.ratings')</h5>

                                            </div>
                                        </div>
                                    </div>
                                    @if (auth()->user()->hasPermission('read_salaries'))
                                    <div class="box-col-6 col-6 col-lg-6 col-sm-4 col-xl-4 col-6">
                                        <div class="card social-widget-card"
                                            onclick="window.location='{{route('dashboard.salarywedgesfirst')}}';">
                                            <div class="card-body">
                                                <div class="" data-label="50%"><img
                                                        src="{{asset('dashboardstyle/assets/images/new-img/6.png')}}"
                                                        class="border-r-10 w-75">
                                                </div>
                                                <h5 class="b-t-light">@lang('site.salaries')</h5>

                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>

@endsection

@section('scripts')
<script src="//widget.time.is/t.js"></script>
@if(auth::user()->company)
@if(auth::user()->company->country==1)
<script>
time_is_widget.init({
    Riyadh_z439: {}
});
</script>
@endif
@else
<script>
time_is_widget.init({
    Al_Mansurah_z00c: {}
});
</script>

@endif
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
    nicEditors.allTextAreas()
});
</script>
@endsection