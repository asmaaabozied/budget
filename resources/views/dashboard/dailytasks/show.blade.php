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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.dailytasks')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.show')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.dailytasks')</h4>
                </div>
            </div>

        </div>
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="bg-secondary-lighten card-header">
                        <h5>@lang('site.edit') </h5>


                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang('site.dailytasks')</h4>
                        @include('partials._errors')



                        <div class="row">

                            <div class="col-md-6">

                                <label>@lang('site.date')</label>
                                <input type="date" name="date" class="form-control" value="{{$dailytask->date}}">
                            </div>

                            <div class="col-md-6">
                                <label>@lang('site.hour')</label>
                                <input type="text" name="hour" class="form-control" value="{{$dailytask->hour}}">
                            </div>



                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('site.employee')</label>
                                <select class="form-control" name="employe_id">
                                    <option selected> @lang('site.select')</option>
                                    @foreach(\App\User::get() as $user)
                                    <option value="{{$user->id}}" @if($dailytask->employe_id==$user->id) selected
                                        @endif> {{$user->full_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>


                        <br><br>
                        <div class="row">
                            <div class="col-md-6">


                                <label>@lang('site.ar.description')</label>

                                <textarea id="w3review" name="description_ar" rows="4" cols="50" class="form-control">{{$dailytask->description_ar}}
                       </textarea>

                            </div>
                            <div class="col-md-6">

                                <label>@lang('site.en.description')</label>
                                <textarea id="w3review" name="description_en" rows="4" cols="50" class="form-control">{{$dailytask->description_en}}
                                </textarea>
                            </div>


                        </div>


                        <br>
                        <br>


                        <div class="text-end mt-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                    <i class="fa fa-backward"></i> @lang('site.back')
                                </button>

                            </div>
                        </div>

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