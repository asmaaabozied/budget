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
                            <li class="breadcrumb-item active"> @lang('site.edit')</li>
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
                    <form action="{{ route('dashboard.leaves.update', $leave->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.edit') </h5>

                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i> -->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.edit')</button>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.leaves')</h4>
                            @include('partials._errors')

                            <!--<form action="{{ route('dashboard.leaves.update', $leave->id) }}"-->
                            <!--      method="post" enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('put') }}-->
                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('site.employee')</label>
                                    <select  class="select2 form-control " data-toggle="select2" data-placeholder="Choose..." name="employe_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\User::get() as $user)
                                        <option value="{{$user->id}}" @if($user->id==$leave->employe_id)
                                            selected @endif
                                            > {{$user->name ?? ''}}  {{$user->father_name ?? ''}}  {{$user->family_name ?? ''}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>@lang('site.type')</label>
                                    <select class="form-control" name="type">
                                        <option selected> @lang('site.select')</option>

                                        <option value="Remotely" @if($leave->type=='Remotely')
                                            selected @endif

                                            > @lang('site.Remotely')</option>
                                        <option value="Office" @if($leave->type=='Office')
                                            selected @endif
                                            > @lang('site.Office')</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.period_name')</label>
                                    <select class="form-control" name="period_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\Models\Period::get() as $period)
                                        <option value="{{$period->id}}" @if($leave->period_id==$period->id)
                                            selected @endif
                                            > {{$period->name_ar}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.hour')</label>
                                    <input type="time" name="hour" class="form-control" value="{{$leave->hour}}">
                                </div>


                                {{--                                    <div class="col-md-6 form-group col-12 p-2">--}}
                                {{--                                        <label>@lang('site.employee')</label>--}}
                                {{--                                        <select class="form-control" name="employe_id">--}}
                                {{--                                            <option selected> @lang('site.select')</option>--}}
                                {{--                                            @foreach(\App\User::get() as $user)--}}
                                {{--                                            <option value="{{$user->id}}"
                                @if($leave->employe_id==$user->id) selected--}}
                                {{--                                                @endif> {{$user->full_name}}
                                </option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}


                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.description')</label>

                                    <textarea id="w3review" name="description_ar" rows="4" cols="50"
                                        class="form-control">{{$leave->description_ar}}
                       </textarea>

                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.description')</label>
                                    <textarea id="w3review" name="description_en" rows="4" cols="50"
                                        class="form-control">{{$leave->description_en}}
                                </textarea>
                                </div>


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

<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
    nicEditors.allTextAreas()
});
</script>
@endsection