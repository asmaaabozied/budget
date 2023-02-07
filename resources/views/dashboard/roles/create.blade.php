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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.roles')</a></li>
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.roles')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">

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
                            <!--<h4 class="card-title">@lang('site.roles')</h4>-->
                            @include('partials._errors')

                            <!--<form action="{{ route('dashboard.roles.store') }}" method="post"-->
                            <!--      enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('post') }}-->

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="col-md-12 form-group col-12 p-2">
                                        <label>@lang('site.name')<span class="text-danger">*</span></label>
                                        <input required type="text" name="name" class="form-control"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-12 form-group col-12 p-2">
                                        <label>@lang('site.display_name')<span class="text-danger">*</span></label>
                                        <input required type="text" name="display_name" class="form-control"
                                            value="{{ old('display_name') }}">
                                    </div>


                                    <div class="col-md-12 form-group col-12 p-2">
                                        <label>@lang('site.description')</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ old('description') }}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>@lang('site.permissions')</legend>

                                        <div class="form-group">




                                            <ul class="nav ">
                                                <table class="table table-hover table-bordered">

                                                    @foreach ($models as $index=>$model)
                                                    <tr>
                                                        <td>
                                                            <li class="form-group {{ $index == 0 ? 'active' : '' }}">
                                                                @lang('site.' . $model)</li>
                                                        </td>
                                                        <td>

                                                            <div class="animate-chk d-flex justify-content-around form-group {{ $index == 0 ? 'active' : '' }}"
                                                                id="{{ $model }}">

                                                                @foreach ($maps as $map)
                                                                <label>
                                                                    <input class="checkbox_animated" type="checkbox"
                                                                        name="permissions[]"
                                                                        value="{{ $map . '_' . $model }}">
                                                                    @lang('site.'
                                                                    . $map)
                                                                    <span></span>
                                                                </label>


                                                                @endforeach

                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </table>

                                            </ul>


                                            <h4> @lang('site.tasks_permissions') </h4>
                                            <ul class="nav ">
                                                <table class="table table-hover table-bordered">

                                                    @foreach ($tasksModels as $index=>$model)
                                                    <tr>
                                                        <td>
                                                            <li class="form-group {{ $index == 0 ? 'active' : '' }}">
                                                                @lang('site.' . $model)</li>
                                                        </td>
                                                        <td>

                                                            <div class="animate-chk d-flex justify-content-around form-group {{ $index == 0 ? 'active' : '' }}"
                                                                id="{{ $model }}">

                                                                @foreach ($tasksMaps as $map)
                                                                <label>
                                                                    <input class="checkbox_animated" type="checkbox"
                                                                        name="tasks_permissions[]"
                                                                        value="{{ $map . '_' . $model }}">
                                                                    @lang('site.'
                                                                    . $map)
                                                                    <span></span>
                                                                </label>


                                                                @endforeach

                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </table>

                                            </ul>

                                            <div class="tab-content">

                                                @foreach ($models as $index=>$model)


                                                @endforeach

                                            </div><!-- end of tab content -->

                                        </div><!-- end of nav tabs -->

                                    </fieldset>


                                </div>
                            </div>


                            <!--<div class="text-end mt-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <button type="button" class="btn btn-warning mr-1"-->
                            <!--                onclick="history.back();">-->
                            <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                            <!--        </button>-->
                            <!--        <button type="submit" class="btn btn-primary"><i-->
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