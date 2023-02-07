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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.cities')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.cities')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.cities.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.add') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i> -->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.add')</button>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.cities')</h4>
                            @include('partials._errors')



                            <!--<form action="{{ route('dashboard.cities.store') }}" method="post"-->
                            <!--      enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('post') }}-->

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.name')</label>
                                    <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
                                </div>



                            </div>


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.country')</label>
                                    <select class="form-control" name="country_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\Models\Country::get() as $country)
                                        <option value="{{$country->id}}"> {{$country->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <br><br>







                            <br>


                            <!--<div class="text-end mt-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <button type="button" class="btn btn-warning mr-1"-->
                            <!--                onclick="history.back();">-->
                            <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                            <!--        </button>-->
                            <!--        <button type="submit"  class="btn btn-primary"><i-->
                            <!--                class="fa fa-plus"></i>-->
                            <!--            @lang('site.add')</button>-->
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