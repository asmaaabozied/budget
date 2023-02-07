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
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
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
                    <form action="{{ route('dashboard.branches.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.add') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
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
                            <!--<h4 class="card-title">@lang('site.branches')</h4>-->
                            @include('partials._errors')

                            <!--<form action="{{ route('dashboard.branches.store') }}" method="post"-->
                            <!--      enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('post') }}-->

                            <div class="row">
                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.type')</label><span class="text-danger">*</span>
                                    <select class="form-control company-select" name="type" required>
                                        <option readonly>@lang('site.select')</option>
                                        <option value="company" id="company"> @lang('site.company')</option>
                                        <option value="branch"> @lang('site.branch')</option>
                                        <option value="project"> @lang('site.project')</option>
                                    </select>
                                </div>


                                <div class="form-group col-12 p-2 col-md-6">
                                    <label>@lang('site.branches')</label><span class="text-danger">*</span>
                                    <select class="form-control" name="parent_id" required>
                                        <option>@lang('site.select')</option>
                                        @foreach(\App\Models\Branch::get() as $branchs)
                                        <option value="{{$branchs->id}}"> {{$branchs->name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.name')</label>
                                    <input type="text" name="name" class="form-control">
                                </div>


                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>{{__('site.activity')}}</label>
                                    <input type="text" name="activity" class="form-control">
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.country')</label>
                                    <select class="form-control" name="country">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\Models\Country::get() as $country)
                                        <option value="{{$country->id}}"> {{$country->name}} </option>
                                        @endforeach
                                    </select>

                                </div>


                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.city')</label>
                                    <select class="form-control" name="city">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\Models\City::get() as $country)
                                        <option value="{{$country->id}}"> {{$country->name}} </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.currencies')</label>
                                    <select class="form-control" name="currency_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\Models\Currency::get() as $currency)
                                        <option value="{{$currency->id}}"> {{$currency->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.email')</label>
                                    <input type="text" name="email" class="form-control">
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.manger_name')</label>
                                    <input type="text" name="manger_name" class="form-control">
                                </div>

                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.bank_name')</label>

                                    <input type="text" name="bank_name" class="form-control">

                                </div>


                                <div class="form-group col-12 p-2 col-md-6">

                                    <label>@lang('site.number')</label>
                                    <input type="text" name="number" class="form-control">
                                </div>




                                <div class=" row company">


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.commerical_number')</label>
                                        <input type="text" name="commerical_number" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.commerical_image')</label>

                                        <input type="file" name="commerical_image" class="form-control">

                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.number_hoppy')</label>
                                        <input type="text" name="number_hoppy" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.hoppy_image')</label>

                                        <input type="file" name="hoppy_image" class="form-control">

                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.tax')</label>
                                        <input type="text" name="tax" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.tax_image')</label>

                                        <input type="file" name="tax_image" class="form-control">

                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.linces')</label>
                                        <input type="text" name="linces" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.linces_image')</label>

                                        <input type="file" name="linces_image" class="form-control">

                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.work_number')</label>
                                        <input type="text" name="work_number" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.work_image')</label>

                                        <input type="file" name="work_image" class="form-control">

                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.row_number')</label>
                                        <input type="text" name="row_number" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.number_image')</label>

                                        <input type="file" name="number_image" class="form-control">

                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.row_image')</label>

                                        <input type="file" name="row_image" class="form-control">

                                    </div>


                                    <div class="form-group col-12 p-2 col-md-6">

                                        <label>@lang('site.iban')</label>
                                        <input type="text" name="iban" class="form-control">
                                    </div>

                                    <div class="form-group col-12 p-2 col-md-6">


                                        <label>@lang('site.iban_image')</label>

                                        <input type="file" name="iban_image" class="form-control">

                                    </div>


                                </div>
                                <div class="form-group col-12 p-2 col-md-6">


                                    <label>@lang('site.description')</label>

                                    <textarea id="w3review" name="description" rows="4" cols="50" class="form-control">
                     </textarea>

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
@section('scripts')





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