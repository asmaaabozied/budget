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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.categories')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.edit')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.categories')</h4>
                </div>
            </div>

        </div>


        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
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

                        <div class="card-body">
                            <h4 class="card-title">@lang('site.categories')</h4>
                            @include('partials._errors')




                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.ar.name')</label>
                                    <input type="text" name="name_ar" class="form-control"
                                        value="{{ $category->name_ar }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.en.name')</label>
                                    <input type="text" name="name_en" class="form-control"
                                        value="{{ $category->name_en }}">


                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.ar.description')</label>



                                    <textarea id="text-box" name="description_ar" cols="10" rows="4"
                                        class="form-control">{{ $category->description_ar }}</textarea>

                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.en.description')</label>
                                    <textarea id="text-box" name="description_en" cols="10" rows="4"
                                        class="form-control"
                                        value=" {{old('description_en')}} ">{{ $category->description_en }}</textarea>

                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.created_by')</label>
                                    <input type="text" name="created_by" class="form-control" value="@if(isset($mall->user_name))
                                               {{$mall->user_name->name}}
                                               @endif" disabled>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.category')</label>
                                    <select class="form-control" name="parent">
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->parent ==$category->id)
                                            selected @endif> {{$category->name_ar}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.visible')</label>
                                    <select class="form-control" name="status">
                                        <option value="1" @if($category->status ==1) selected @endif> yes </option>
                                        <option value="0" @if($category->status ==0) selected @endif> no </option>

                                    </select>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.image')</label>
                                    <img src="{{asset('images/categories/'.$category->image)}}" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalss" width="100px" height="100px" class="img-catog"
                                         onerror="this.src='{{asset('images/employee/1671111127.png')}}'"
                                    >
                                </div>
                            </div>

                            <br>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalss" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">@lang('site.image')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="border-5">
                                                <tr>
                                                    <th>
                                                        <img name="soso"
                                                            src="{{asset('images/categories/'.$category->image)}}"
                                                            alt="" width="400px" height="aut0">

                                                    </th>
                                                </tr>


                                            </table>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">@lang('site.Cancel')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  End Of Modal -->




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
@section('script')
<script>
$("#add").click(function() {
    $("#rows").append('<input type="text" name="price[]">');
});
</script>


@endsection