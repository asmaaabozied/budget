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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.pages')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.pages')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.pages.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.add') </h5>

                            <div class="text-end  group-btn-top">
                                <div class=" d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i>-->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.add')</button>
                                </div>
                            </div>



                        </div>
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.pages')</h4>
                            @include('partials._errors')


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.name')</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.name')</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
                                </div>



                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.copy')</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="copy" class="form-control" value="{{ old('copy') }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.slug')</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug	') }}">
                                </div>



                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.description')</label>
                                    <span class="text-danger">*</span>

                                    <textarea id="w3review" name="description_ar" rows="4" cols="50"
                                        class="form-control">
                       </textarea>

                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.description')</label>
                                    <span class="text-danger">*</span>
                                    <textarea id="w3review" name="description_en" rows="4" cols="50"
                                        class="form-control">
                                </textarea>
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