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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.branches')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.show')</li>
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
                    <div class="bg-secondary-lighten card-header">
                        <h5>@lang('site.show') </h5>


                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang('site.branches')</h4>
                        @include('partials._errors')





                        <div class="row m-0">
                            <div class="col-md-6 form-group col-12 p-2">


                                <label>@lang('site.type')</label>

                                <select class="form-control" name="type" readonly="">
                                    <option value="company" @if($branch->type=="company") selected @endif>
                                        @lang('site.company')</option>
                                    <option value="branch" @if($branch->type=="branch") selected @endif>
                                        @lang('site.branch')</option>
                                    <option value="project" @if($branch->type=="project") selected @endif>
                                        @lang('site.project')</option>

                                </select>
                            </div>

                            <div class="col-md-6 form-group col-12 p-2">
                                <label>@lang('site.branches')</label>
                                <select class="form-control" name="parent_id" readonly>
                                    <option selected disabled>@lang('site.select')</option>
                                    @foreach(\App\Models\Branch::get() as $branchs)
                                    <option value="{{$branchs->id}}" @if($branch->parent_id==$branchs->id) selected
                                        @endif> {{$branchs->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ $branch->name }}"
                                    readonly>
                            </div>



                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.activity')</label>
                                <input type="text" name="activity" class="form-control" value="{{$branch->activity }}"
                                    readonly>
                            </div>

                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.country')</label>
                                <select class="form-control" name="country" readonly>
                                    @foreach(\App\Models\Country::get() as $country)
                                    <option value="{{$country->id}}" @if($country->id==$branch->country) selected
                                        @endif>
                                        {{$country->name}} </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.currencies')</label>
                                <select class="form-control" name="currency_id" readonly>
                                    @foreach(\App\Models\Currency::get() as $currency)
                                    <option value="{{$currency->id}}" @if($currency->
                                        id==$branch->currency_id) selected @endif> {{$currency->name}} </option>
                                    @endforeach
                                </select>

                            </div>




                            <div class="col-md-6 form-group col-12 p-2">


                                <label>@lang('site.city')</label>
                                <select class="form-control" name="city" readonly>
                                    @foreach(\App\Models\City::get() as $city)
                                    <option value="{{$city->id}}" @if($city->id==$branch->city) selected @endif>
                                        {{$city->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.email')</label>
                                <input type="text" name="email" class="form-control" value="{{ $branch->email }}"
                                    readonly>
                            </div>




                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.manger_name')</label>
                                <input type="text" name="manger_name" class="form-control"
                                    value="{{ $branch->manger_name }}" readonly>
                            </div>

                            <div class="col-md-6 form-group col-12 p-2">


                                <label>@lang('site.bank_name')</label>

                                <input type="text" name="bank_name" class="form-control"
                                    value="{{ $branch->bank_name }}" readonly>

                            </div>



                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.number')</label>
                                <input type="text" name="number" class="form-control" value="{{ $branch->number}}"
                                    readonly>
                            </div>


                            @if($branch->type=="project")

                            @else


                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.number_image')</label>



                            </div>
                            <div class="col-md-2 col-12 form-group p-2">

                                <div class="w-100 h-100 box-img"><img
                                        src="{{asset('uploads/branches/'.$branch->number_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>


                            </div>




                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.commerical_number')</label>
                                <input type="text" name="commerical_number" class="form-control"
                                    value="{{ $branch->commerical_number }}" readonly>
                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.commerical_image')</label>



                            </div>
                            <div class="col-md-2 col-12 form-group p-2">

                                <div class="w-100 h-100 box-img">
                                    <img src="{{asset('uploads/branches/'.$branch->commerical_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>





                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.number_hoppy')</label>
                                <input type="text" name="number_hoppy" class="form-control"
                                    value="{{ $branch->number_hoppy }}" readonly>
                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.hoppy_image')</label>


                            </div>
                            <div class="col-md-2 col-12 form-group p-2">
                                <div class="w-100 h-100 box-img">

                                    <img src="{{asset('uploads/branches/'.$branch->hoppy_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>




                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.tax')</label>
                                <input type="text" name="tax" class="form-control" value="{{ $branch->tax }}" readonly>
                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.tax_image')</label>



                            </div>

                            <div class="col-md-2 col-12 form-group p-2">

                                <div class="w-100 h-100 box-img">
                                    <img src="{{asset('uploads/branches/'.$branch->tax_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>




                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.linces')</label>
                                <input type="text" name="linces" class="form-control" value="{{ $branch->linces }}"
                                    readonly>
                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.linces_image')</label>



                            </div>
                            <div class="col-md-2 col-12 form-group p-2">

                                <div class="w-100 h-100 box-img">
                                    <img src="{{asset('uploads/branches/'.$branch->linces_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>


                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.work_number')</label>
                                <input type="text" name="work_number" class="form-control"
                                    value="{{ $branch->work_number }}" readonly>
                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.work_image')</label>



                            </div>

                            <div class="col-md-2 col-12 form-group p-2">
                                <div class="w-100 h-100 box-img">

                                    <img src="{{asset('uploads/branches/'.$branch->work_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>




                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.row_number')</label>

                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.row_image')</label>



                            </div>

                            <div class="col-md-2 col-12 form-group p-2">

                                <div class="w-100 h-100 box-img">
                                    <img src="{{asset('uploads/branches/'.$branch->row_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>




                            <div class="col-md-6 form-group col-12 p-2">

                                <label>@lang('site.iban')</label>
                                <input type="text" name="iban" class="form-control" value="{{ $branch->iban }}"
                                    readonly>
                            </div>

                            <div class="align-items-center d-flex col-md-4 col-12 form-group p-2 ">


                                <label>@lang('site.iban_image')</label>



                            </div>

                            <div class="col-md-2 col-12 form-group p-2">
                                <div class="w-100 h-100 box-img">

                                    <img src="{{asset('uploads/branches/'.$branch->iban_image)}}" width="100px"
                                        height="50px" onerror="this.src='{{asset('uploads/branches/1669630543.png')}}'">
                                </div>

                            </div>

                            @endif

                            <div class="col-md-6 form-group col-12 p-2">


                                <label>@lang('site.description')</label>

                                <textarea id="w3review" name="description" readonly rows="4" cols="50"
                                    class="form-control">
                     {{$branch->description}}  </textarea>

                            </div>

                        </div>



                        <br>


                        <!--<div class="text-end mt-4">-->
                        <!--    <div class="form-group">-->
                        <!--        <button type="button" class="btn btn-warning mr-1" onclick="history.back();">-->
                        <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                        <!--        </button>-->

                        <!--    </div>-->
                        <!--</div>-->

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