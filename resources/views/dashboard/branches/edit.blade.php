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
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.branches')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.edit')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.branches')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <form action="{{ route('dashboard.branches.update', $branch->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.edit') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
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
                            <!--<h4 class="card-title">@lang('site.branches')</h4>-->
                            @include('partials._errors')




                            <!--<form action="{{ route('dashboard.branches.update', $branch->id) }}"-->
                            <!--      method="post" enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('put') }}-->

                            <div class="row">
                                <div class="form-group col-12 p-2 form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.type')</label>
                                    <select class="form-control company-select" name="type">
                                        <option readonly>@lang('site.select')</option>
                                        <option value="company" @if($branch->type=="company") selected
                                            @endif id="company">
                                            @lang('site.company')</option>
                                        <option value="branch" @if($branch->type=="branch") selected @endif>
                                            @lang('site.branch')</option>
                                        <option value="project" @if($branch->type=="project") selected @endif>
                                            @lang('site.project')</option>
                                    </select>
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">
                                    <label>@lang('site.branches')</label>
                                    <select class="form-control" name="parent_id" required>
                                        <option selected disabled>@lang('site.select')</option>
                                        @foreach(\App\Models\Branch::get() as $branchs)
                                        <option value="{{$branchs->id}}" @if($branch->parent_id==$branchs->id)
                                            selected @endif > {{$branchs->name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.name')</label>
                                    <input type="text" name="name" class="form-control" value="{{ $branch->name }}">
                                </div>


                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.activity')</label>
                                    <input type="text" name="activity" class="form-control"
                                        value="{{$branch->activity }}">
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.country')</label>
                                    <select class="form-control" name="country">
                                        @foreach(\App\Models\Country::get() as $country)
                                        <option value="{{$country->id}}" @if($country->id==$branch->country)
                                            selected @endif>
                                            {{$country->name}} </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.currencies')</label>
                                    <select class="form-control" name="currency_id">
                                        @foreach(\App\Models\Currency::get() as $currency)
                                        <option value="{{$currency->id}}" @if($currency->id==$branch->currency_id)
                                            selected @endif> {{$currency->name}} </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.city')</label>
                                    <select class="form-control" name="city">
                                        @foreach(\App\Models\City::get() as $city)
                                        <option value="{{$city->id}}" @if($city->id==$branch->city)@endif>
                                            {{$city->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.email')</label>
                                    <input type="text" name="email" class="form-control" value="{{ $branch->email }}">
                                </div>


                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.manger_name')</label>
                                    <input type="text" name="manger_name" class="form-control"
                                        value="{{ $branch->manger_name }}">
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.bank_name')</label>

                                    <input type="text" name="bank_name" class="form-control"
                                        value="{{ $branch->bank_name }}">

                                </div>

                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.number')</label>
                                    <input type="text" name="number" class="form-control" value="{{ $branch->number}}">
                                </div>


                                <div class=" row company">

                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.commerical_number')</label>
                                        <input type="text" name="commerical_number" class="form-control"
                                            value="{{ $branch->commerical_number }}">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.commerical_image')</label>



                                        <img src="{{asset('uploads/branches/'.$branch->commerical_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                        <input type="file" name="commerical_image" class="form-control d-inline w-75"
                                            value="{{ old('commerical_image') }}">


                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.number_hoppy')</label>
                                        <input type="text" name="number_hoppy" class="form-control"
                                            value="{{ $branch->number_hoppy }}">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.hoppy_image')</label>






                                        <img src="{{asset('uploads/branches/'.$branch->hoppy_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                        <input type="file" name="hoppy_image" class="form-control d-inline w-75"
                                            value="{{ old('hoppy_image') }}">


                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.tax')</label>
                                        <input type="text" name="tax" class="form-control" value="{{ $branch->tax }}">
                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label class="d-block">@lang('site.tax_image')</label>

                                        <img src="{{asset('uploads/branches/'.$branch->tax_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                        <input type="file" name="tax_image" class="form-control d-inline w-75"
                                            value="{{ old('tax_image') }}">


                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.linces')</label>
                                        <input type="text" name="linces" class="form-control"
                                            value="{{ $branch->linces }}">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.linces_image')</label>

                                        <img src="{{asset('uploads/branches/'.$branch->linces_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                        <input type="file" name="linces_image" class="form-control d-inline w-75"
                                            value="{{ old('linces_image') }}">
                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.work_number')</label>
                                        <input type="text" name="work_number" class="form-control"
                                            value="{{ $branch->work_number }}">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.work_image')</label>

                                        <img src="{{asset('uploads/branches/'.$branch->work_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                        <input type="file" name="work_image" class="form-control w-75 d-inline"
                                            value="{{ old('work_image') }}">


                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.row_number')</label>
                                        <input type="text" name="row_number" class="form-control"
                                            value="{{$branch->row_numbe}}">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.row_image')</label>


                                        <img src="{{asset('uploads/branches/'.$branch->row_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">


                                        <input type="file" name="row_image" class="form-control d-inline w-75"
                                            value="{{ old('row_image') }}">

                                    </div>



                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.iban')</label>
                                        <input type="text" name="iban" class="form-control" value="{{ $branch->iban }}">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.iban_image')</label>






                                        <img src="{{asset('uploads/branches/'.$branch->iban_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">

                                        <input type="file" name="iban_image" class="form-control d-inline w-75"
                                            value="{{ old('iban_image') }}">

                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label class="d-block">@lang('site.number_image')</label>


                                        <img src="{{asset('uploads/branches/'.$branch->number_image)}}" width="24%"
                                            height="50px" class="img-company"
                                            onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">



                                        <input type="file" name="number_image" class="form-control d-inline w-75"
                                            value="{{ old('number_image') }}">

                                    </div>

                                </div>

                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.description')</label>

                                    <textarea id="w3review" name="description" rows="4" cols="50" class="form-control">
                     {{$branch->description}}  </textarea>

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
                            <!--            @lang('site.edit')</button>-->
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

@section('scripts')

@if($branch->type=="project")

<script>
$('div.company').hide()
</script>

@endif



<script>
$('.company-select').on('change', function(e) {
    e.preventDefault();
    var item = $(this).val();

    if (item == 'project') {
        console.log("items", item)
        $('div.company').hide()

    } else {

        $('div.company').show()
    }


    // window.location.href = item;
});
</script>

@endsection