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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.ratings')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.edit')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.ratings')</h4>
                </div>
            </div>

        </div>


        <form action="{{ route('dashboard.ratings.update', $rate->id) }}" method="post"
              enctype="multipart/form-data">

            {{ csrf_field() }}
            {{ method_field('put') }}
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="bg-secondary-lighten card-header">
                        <div class="card-header d-flex justify-content-between">
                            <h5>@lang('site.edit') </h5>
                            <div class="text-end  group-btn-top">
                                <div class=" d-flex form-group justify-content-between">
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


                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang('site.ratings')</h4>
                        @include('partials._errors')


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.rate')</label>
                                    <input type="text" name="rate" class="form-control" value="{{ $rate->rate }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.date')</label>
                                    <input type="date" name="date" class="form-control" value="{{$rate->date}}">
                                </div>


                            </div>



                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.employee')</label>
                                    <select  class="select2 form-control " data-toggle="select2" data-placeholder="Choose..." name="employe_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\User::get() as $user)
                                        <option value="{{$user->id}}" @if($rate->employe_id==$user->id) selected
                                            @endif >{{$user->name ?? ''}}  {{$user->father_name ?? ''}}  {{$user->family_name ?? ''}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
















                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
        </form>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>

@endsection

