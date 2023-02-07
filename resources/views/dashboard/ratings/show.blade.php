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
                            <li class="breadcrumb-item active"> @lang('site.show')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.ratings')</h4>
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

                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang('site.ratings')</h4>
                        @include('partials._errors')

                        <form action="{{ route('dashboard.ratings.update', $rate->id) }}" method="post"
                            enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.rate')</label>
                                    <input type="text" name="rate" class="form-control" value="{{ $rate->rate }}" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.date')</label>
                                    <input type="date" name="date" class="form-control" value="{{$rate->date}}" readonly>
                                </div>


                            </div>



                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.employee')</label>
                                    <select class="form-control" name="employe_id" readonly="" disabled>
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\User::get() as $user)
                                        <option value="{{$user->id}}" @if($rate->employe_id==$user->id) selected
                                            @endif >{{$user->name ?? ''}}  {{$user->father_name ?? ''}}  {{$user->family_name ?? ''}} </option>
                                        @endforeach
                                    </select>
                                </div>
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
</div>

@endsection

