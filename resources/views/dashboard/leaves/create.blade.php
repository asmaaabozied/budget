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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.leaves')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.leaves')</h4>
                </div>
            </div>

        </div>


        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.leaves.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="card-body">
                            <!--<h4 class="card-title">@lang('site.leaves')</h4>-->
                            @include('partials._errors')

                            <!--<form action="{{ route('dashboard.leaves.store') }}" method="post"-->
                            <!--      enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('post') }}-->
                            <div class="row">
                                {{--                                    @if (auth()->user()->hasRole('Super Admin'))--}}

                                {{--                                        <div class="col-md-60">--}}
                                {{--                                            <label>@lang('site.employee')</label>--}}
                                {{--                                            <select required class="select2 form-control " data-toggle="select2"--}}
                                {{--                                                    data-placeholder="Choose..." name="employe_id">--}}
                                {{--                                                <option> @lang('site.select')</option>--}}
                                {{--                                                @foreach(\App\User::get() as $user)--}}
                                {{--                                                    <option value="{{$user->id}}">{{$user->name ?? ''}}
                                {{$user->father_name ?? ''}} {{$user->family_name ?? ''}} </option>--}}
                                {{--                                                @endforeach--}}
                                {{--                                            </select>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endif--}}

                                {{--                                    <div class="col-md-60">--}}
                                {{--                                        <label>@lang('site.type')</label>--}}
                                {{--                                        <select class="form-control" name="type" required>--}}
                                {{--                                            <option> @lang('site.select')</option>--}}

                                {{--                                            <option value="Remotely"> @lang('site.Remotely')</option>--}}
                                {{--                                            <option value="Office"> @lang('site.Office')</option>--}}

                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                            </div>
                            <div class="row">

                                {{--                                    <div class="col-md-60 form-group col-12 p-2">--}}

                                {{--                                        <label>@lang('site.period_name')</label>--}}
                                {{--                                        --}}{{--                                        <span class="text-danger">*</span>--}}
                                {{--                                        --}}{{--                                        <input type="text" name="period_name" class="form-control" value="{{ old('period_name') }}">--}}
                                {{--                                        <select class="form-control" name="period_id" required>--}}
                                {{--                                            <option> @lang('site.select')</option>--}}
                                {{--                                            @foreach(\App\Models\Period::get() as $period)--}}
                                {{--                                                <option value="{{$period->id}}">
                                {{$period->name_ar}} </option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}

                                {{--                                    </div>--}}
                                <div class="col-md-60 form-group col-12 p-2">

                                    <label>@lang('site.hour')</label>
                                    <span class="text-danger">*</span>
                                    <input type="time" name="hour" class="form-control" value="{{$time}}" disabled>
                                    <input type="hidden" value="{{$time}}" name="hour">


                                </div>

                                <div class="col-md-60 form-group col-12 p-2">

                                    <label>@lang('site.date')</label>
                                    <span class="text-danger">*</span>
                                    <input type="date" name="date" class="form-control date" value="{{$date}}"
                                        readonly="">


                                </div>


                                {{--                                    <div class="col-md-60 form-group col-12 p-2">--}}
                                {{--                                        <label>@lang('site.employee')</label>--}}
                                {{--                                        <select class="form-control" name="employe_id">--}}
                                {{--                                            <option selected> @lang('site.select')</option>--}}
                                {{--                                            @foreach(\App\User::get() as $user)--}}
                                {{--                                            <option value="{{$user->id}}">
                                {{$user->full_name}} </option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="col-md-60 form-group col-12 p-2"></div>--}}





                                <div class="col-md-60 form-group col-12 p-2">


                                    <label>اكتب ملخص مختصر لاهم الأشياء اللي انجزتها اليوم</label>

                                    <textarea id="w3review" name="description_ar" rows="4" cols="50"
                                        class="form-control" required>
                       </textarea>

                                </div>
                                {{--                                    <div class="col-md-60 form-group col-12 p-2">--}}

                                {{--                                        <label>@lang('site.en.description')</label>--}}
                                {{--                                        <textarea id="w3review" name="description_en" rows="4" cols="50"--}}
                                {{--                                                  class="form-control">--}}
                                {{--                                </textarea>--}}
                                {{--                                    </div>--}}


                            </div>

                            <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                                <h5>@lang('site.add') </h5>

                                <div class="text-end  group-btn-top">
                                    <div class="form-group d-flex form-group justify-content-between">
                                        <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                            onclick="history.back();">
                                            <i class="fa fa-backward"></i> @lang('site.back')
                                        </button>
                                        <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                                class="fa fa-plus"></i>
                                            @lang('site.add')</button>
                                    </div>
                                </div>


                            </div>



                        </div>
                    </form>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>




@endsection

@section('scripts')

<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
    nicEditors.allTextAreas()
});
</script>
@endsection