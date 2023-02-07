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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.periods')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.show')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.periods')</h4>
                </div>
            </div>

        </div>
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">


                    <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                        <h5>@lang('site.show') </h5>
                        <div class="text-end  group-btn-top">
                            <div class=" d-flex form-group justify-content-between">
                                <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                    onclick="history.back();">
                                    <!--<i class="fa fa-backward"></i>-->
                                    @lang('site.back')
                                </button>

                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang('site.periods')</h4>
                        @include('partials._errors')



                        <div class="row">
                            <div class="col-md-6 form-group col-12 p-2">


                                <label>@lang('site.ar.name')</label>
                                <input type="text" name="name_ar" class="form-control"
                                    value="{{ $period->name_ar ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.en.name')</label>
                                <input type="text" name="name_en" class="form-control"
                                    value="{{ $period->name_en ?? '' }}">
                            </div>


                            <div class="col-md-6 form-group col-12 p-2">


                                <label>@lang('site.period_start')</label>
                                <input type="text" name="period_start" class="form-control"
                                    value="{{ $period->period_start ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.period_end')</label>
                                <input type="text" name="period_end" class="form-control"
                                    value="{{ $period->period_end ?? '' }}">
                            </div>






                        </div>



                        <!--<div class="text-end mt-4">-->
                        <!--    <div class="form-group">-->
                        <!--        <button type="button" class="btn btn-warning mr-1" onclick="history.back();">-->
                        <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                        <!--        </button>-->

                        <!--    </div>-->

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