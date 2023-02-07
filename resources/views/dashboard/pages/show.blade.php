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
                            <li class="breadcrumb-item active"> @lang('site.show')</li>
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
                    <div class="bg-secondary-lighten card-header">
                        <h5>@lang('site.show') </h5>


                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang('site.pages')</h4>
                        @include('partials._errors')

                        <form action="{{ route('dashboard.pages.update', $page->id) }}" method="post"
                            enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar" class="form-control"
                                        value="{{ $page->name_ar ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.name')</label>
                                    <input type="text" name="name_en" class="form-control"
                                        value="{{ $page->name_en ?? '' }}">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.copy')</label>
                                    <input type="text" name="copy" class="form-control" value="{{ $page->copy ?? '' }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.slug')</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $page->slug ?? '' }}">
                                </div>



                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.ar.description')</label>

                                    <textarea class="form-control" id="w3review" name="description_ar" rows="4"
                                        cols="50">{{ $page->description_ar ?? '' }}
                       </textarea>

                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.en.description')</label>
                                    <textarea id="w3review" class="form-control" name="description_en" rows="4"
                                        cols="50">{{ $page->description_en ?? '' }}
                                </textarea>
                                </div>


                            </div>



                            <!--<div class="text-end mt-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <button type="button" class="btn btn-warning mr-1" onclick="history.back();">-->
                            <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                            <!--        </button>-->

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