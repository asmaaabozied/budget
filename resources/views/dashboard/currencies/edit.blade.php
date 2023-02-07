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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.currencies')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.edit')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.currencies')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.currencies.update', $currency->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.edit') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <i class="fa fa-backward"></i> @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        @lang('site.edit')</button>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <!--<h4 class="card-title">@lang('site.currencies')</h4>-->
                            @include('partials._errors')

                            <!--<form action="{{ route('dashboard.currencies.update', $currency->id) }}"-->
                            <!--      method="post" enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('put') }}-->

                            <div class="row">
                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar" class="form-control"
                                        value="{{ $currency->name_ar ?? '' }}">
                                </div>
                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.en.name')</label>
                                    <input type="text" name="name_en" class="form-control"
                                        value="{{ $currency->name_en ?? '' }}">
                                </div>
                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.code')</label>
                                    <input type="text" name="code" class="form-control"
                                        value="{{ $currency->code ?? '' }}">
                                </div>


                            </div>


                            <br>


                            <!--<div class="text-end mt-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <button type="button" class="btn btn-warning mr-1"-->
                            <!--                onclick="history.back();">-->
                            <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                            <!--        </button>-->
                            <!--        <button type="submit" class="btn btn-primary"><i-->
                            <!--                class="fa fa-plus"></i>-->
                            <!--            @lang('site.edit')</button>-->
                            <!--    </div>-->
                            <!--</div>-->
                    </form>
                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
</div>





@endsection