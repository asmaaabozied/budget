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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.rewards')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.rewards')</h4>
                </div>
            </div>

        </div>


        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.rewards.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
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
                        <div class="card-body">
                            @include('partials._errors')


                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.employee')</label>
                                    <select class="form-control" name="employee_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\User::get() as $user)
                                        <option value="{{$user->id}}"> {{$user->full_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.date')</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.reference')</label>
                                    <input type="text" name="reference" class="form-control">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.value')</label>
                                    <input type="text" name="value" class="form-control">
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.type')</label>
                                    <input type="text" name="type" class="form-control">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.notes')</label>

                                    <textarea id="text-box" name="notes" cols="10" rows="4" class="form-control"
                                        value=" {{old('notes')}} "></textarea>
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