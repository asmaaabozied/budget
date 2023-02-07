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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.countries')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.edit')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.countries')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.countries.update', $country->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.edit') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i>-->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.edit')</button>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">

                            @include('partials._errors')

                            <!--<form action="{{ route('dashboard.countries.update', $country->id) }}"-->
                            <!--      method="post" enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('put') }}-->

                            <div class="row m-0 ">
                                <h4 class="card-title">@lang('site.countries')</h4>
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar" class="form-control"
                                        value="{{ $country->name_ar ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.name')</label>
                                    <input type="text" name="name_en" class="form-control"
                                        value="{{ $country->name_en ?? '' }}">
                                </div>



                            </div>



                            <br>


                            <h4 class="card-title">@lang('site.cities')</h4>
                            <!--<button class="btn btn-air-primary  btn-primary add-author">@lang('site.addss')</button>-->
                            <div class="row m-0 align-items-end">
                                @foreach($cities as $city)
                                <input type="hidden" name="city_id[]" value="{{$city->id}}">
                                <!--<div class="row m-0">-->

                                <div class="col-md-5 form-group col-12 p-2">


                                    <label>@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar_city[]" class="form-control"
                                        value="{{ $city->name_ar }}">
                                </div>
                                <div class="col-md-5 form-group col-12 p-2">

                                    <label>@lang('site.en.name')</label>
                                    <input type="text" name="name_en_city[]" class="form-control"
                                        value="{{ $city->name_en }}">
                                </div>
                                <br>



                                <!--                                       <div class="col-md-2 form-group col-12 p-2">-->
                                <!--<button class="btn btn-air-primary  btn-primary add-author">@lang('site.addss')</button>-->
                                <!--                                           <br>-->
                                <!--                                       </div>-->



                                <!--</div>-->
                                @endforeach
                                <div class="col-md-2 form-group col-12 p-2">
                                    <button
                                        class="btn btn-air-primary  btn-primary add-author">@lang('site.addss')</button>
                                    <br>
                                </div>
                            </div>


                            <div class="row authors-list">


                            </div>
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

@section('scripts')
<script>
$(document).ready(function() {
    jQuery('button.add-author').click(function(event) {
        event.preventDefault();
        var newRow = jQuery(
            '<div class="d-flex mt-2"><div class="col-md-6 form-group col-12 p-2">' +
            '<input type="text"     name="name_ar_city[]" class="form-control" placeholder="Name city AR"/></div><div class="col-md-6 form-group col-12 p-2">' +
            '<input type="text"     name="name_en_city[]" class="form-control" placeholder="Name city EN" />' +
            '</div><div class="col-md-3 col-12 ">' +


            // '</div>' +
            // '<div class="col-md-3 col-12">' +
            // ' <button onclick="deleteRow(this)">' +
            // '<i class="far fa-trash-alt me-1 fa-2x delete"></i>' +
            // '</button>' +
            '</div></div>');

        jQuery('.authors-list').append(newRow);
    });
});
</script>
@endsection