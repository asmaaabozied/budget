@extends('layouts.dashboard.app')
@section('style')

@endsection
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.employee')</a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('site.add')</li>
                            </ol>
                        </div>
                        <h4 class="page-title">@lang('site.employee')</h4>
                    </div>
                </div>

            </div>
            <div class="row">
                <form action="{{ route('dashboard.employee.store') }}" method="post" enctype="multipart/form-data">
                    <div class="tab-main card" id="basicwizard">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <ul class="align-items-center d-flex form-wizard-header justify-content-lg-between m-0 nav nav-justified nav-pills p-1"
                            role="tablist">

                            <li class="nav-item">
                                <a href="#account-tab" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link p-lg-1 active">
                                    <i class=" ri-account-circle-line font-18 align-middle  d-block  d-sm-none "></i>
                                    <span class="d-none d-sm-inline">@lang('site.basic information')</span>
                                </a>
                            </li>
                            <i class="ri-arrow-left-line"></i>

                            <li class="nav-item">
                                <a href="#hoppienes-tab" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link p-lg-1 ">
                                    <i class="ri-bank-card-2-line font-18 align-middle  d-block  d-sm-none "></i>
                                    <span class="d-none d-sm-inline">@lang('site.hoppienes')</span>
                                </a>
                            </li>
                            <i class="ri-arrow-left-line"></i>
                            <li class="nav-item">
                                <a href="#followers-tab" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link p-lg-1 ">
                                    <i class="ri-team-line font-18 align-middle  d-block  d-sm-none "></i>
                                    <span class="d-none d-sm-inline">@lang('site.followers')</span>
                                </a>

                            </li><i class="ri-arrow-left-line"></i>
                            <li class="nav-item">
                                <a href="#vehicles-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link p-lg-1 ">
                                    <i class="ri-truck-line font-18 align-middle  d-block  d-sm-none "></i>
                                    <span class="d-none d-sm-inline">@lang('site.vehicles')</span>
                                </a>

                            </li>

                            <i class="ri-arrow-left-line"></i>

                            <li class="nav-item">
                                <a href="#Salary-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link p-lg-1 ">
                                    <i
                                        class=" ri-money-dollar-circle-line font-18 align-middle  d-block  d-sm-none "></i>
                                    <span class="d-none d-sm-inline">@lang('site.salary and wages')</span>
                                </a>

                            </li>
                            <i class="ri-arrow-left-line"></i>
                            <li class="nav-item">
                                <a href="#vacationsbalance" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link p-lg-1 ">
                                    <i class=" ri-suitcase-3-line font-18 align-middle  d-block  d-sm-none   "></i>
                                    <span class="d-none d-sm-inline">@lang('site.vacations balance')</span>
                                </a>

                            </li>
                            <i class="ri-arrow-left-line"></i>
                            <li class="nav-item">
                                <a href="#Entitlementscovenant" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link p-lg-1 ">
                                    <i class=" ri-file-upload-line font-18 align-middle  d-block  d-sm-none  "></i>
                                    <span class="d-none d-sm-inline">@lang('site.Entitlements and covenant')</span>
                                </a>

                            </li>



                            <div class="group-btn-top mt-30 text-end w-100">
                                <br><br>
                                <div class=" d-flex  justify-content-between">
                                    <button type="button" class=" btn btn-pill btn-outline-primary btn-air-primary m-0"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i>-->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.add')</button>
                                </div>
                            </div>
                        </ul>

                        <div class="tab-content b-0 mb-0">

                            <div class="tab-pane mt-2 active show" id="account-tab">
                                <div class="row">


                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.names')</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.father_name')</label>
                                        <input type="text" name="father_name" class="form-control"
                                            value="{{old('father_name')}}">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.family_name')</label>
                                        <input type="text" name="family_name" class="form-control"
                                            value="{{old('family_name')}}">
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.quality')</label>
                                        <input type="text" name="quality" class="form-control"
                                            value="{{old('quality')}}">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.type1')</label>

                                        <div class="select-area d-flex align-items-center">
                                            <select class="form-control" name="type1">
                                                <option value="female">
                                                    @lang('site.female')
                                                </option>
                                                <option value="male">
                                                    @lang('site.male')
                                                </option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.national')</label>

                                        <input type="text" name="national" class="form-control"
                                            value="{{old('national')}}">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.Religion')</label>
                                        <input type="text" name="Religion" class="form-control"
                                            value="{{old('Religion')}}">
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.phone')</label>
                                        <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.email')</label>
                                        <input type="text" name="email" class="form-control" value="{{old('email')}}">
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">


                                            <label>@lang('site.password')</label>
                                            <input type="password" name="password" class="form-control"
                                                value="{{old('password')}}">

                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Contract_start_date')</label>
                                            <input type='text' class="form-control hijri-picker"
                                                name="Contract_start_date" id="hijri-picker"
                                                value="{{old('Contract_start_date')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Contract_expiry_date')</label>
                                            <input type="date" name="Contract_expiry_date" class="form-control"
                                                value="{{old('Contract_expiry_date')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.countrys')</label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{old('country')}}">
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.job_term')</label>


                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="job_term">
                                                    <option value="Single">
                                                        @lang('site.Single')
                                                    </option>
                                                    <option value="Married">
                                                        @lang('site.Married')
                                                    </option>

                                                    <option value="Separate">
                                                        @lang('site.Separate')
                                                    </option>

                                                    <option value="Widower">
                                                        @lang('site.Widower')
                                                    </option>

                                                </select>
                                            </div>

                                            {{--                                                                                                            <input type="text" name="job_term" class="form-control" value=" {{old('job_term')}}
                                            ">--}}
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Date_marriage')</label>
                                            <input type="date" name="Date_marriage" class="form-control"
                                                value="{{old('Date_marriage')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.image')</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">

                                        <label>@lang('site.company')</label>


                                        <!-- Multiple Select -->
                                        <select class="select2 form-control select2-multiple" data-toggle="select2"
                                            multiple="multiple" data-placeholder="Choose..." name="companies[]">

                                            @foreach(\App\Models\Branch::where('type','company')->get() as $company)
                                            <option value="{{$company->id}}"> {{$company->name}}
                                            </option>
                                            @endforeach


                                        </select>
                                    </div>





                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.branch')</label>

                                            <div class="select-area d-flex align-items-center">
                                                <!-- Multiple Select -->
                                                <select class="select2 form-control select2-multiple"
                                                    data-toggle="select2" multiple="multiple"
                                                    data-placeholder="Choose..." name="branches[]">

                                                    <option selected disabled>@lang('site.select')</option>
                                                    @foreach(\App\Models\Branch::where('type','branch')->get() as $branch)
                                                    <option value="{{$branch->id}}"> {{$branch->name}}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.project')</label>
                                            <div class="select-area d-flex align-items-center">
{{--                                                <select class="form-control" name="project_id">--}}
{{--                                                    <option selected disabled>@lang('site.select')</option>--}}
{{--                                                    @foreach(\App\Models\Branch::where('type','project')->get()--}}
{{--                                                    as--}}
{{--                                                    $project)--}}
{{--                                                    <option value="{{$project->id}}"> {{$project->name}}--}}
{{--                                                    </option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}

                                                <!-- Multiple Select -->
                                                <select class="select2 form-control select2-multiple"
                                                        data-toggle="select2" multiple="multiple"
                                                        data-placeholder="Choose..." name="projects[]">

                                                    <option selected disabled>@lang('site.select')</option>
                                                    @foreach(\App\Models\Branch::where('type','project')->get() as $project)
                                                        <option value="{{$project->id}}"> {{$project->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.categories')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <!-- Multiple Select -->
                                                <select class="select2 form-control select2-multiple"
                                                    data-toggle="select2" multiple="multiple"
                                                    data-placeholder="Choose..." name="categories[]"  >
                                                    <option selected disabled>@lang('site.select')</option>
                                                    @foreach(\App\Models\category::get() as $category)
                                                    <option value="{{$category->id}}"> {{$category->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.job')</label>
                                            <input type="text" name="job" class="form-control" value="{{old('job')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.degree_job')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="degree_job">
                                                    <option selected disabled>@lang('site.select')</option>
                                                    <option value="junior">
                                                        Junior
                                                    </option>
                                                    <option value="senior">
                                                        Senior
                                                    </option>

                                                    <option value="manger">
                                                        Manger
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.type')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="type">
                                                    <option selected disabled>@lang('site.select')</option>

                                                    <option value="fulltime">
                                                        @lang('site.fulltime')
                                                    </option>
                                                    <option value="parttime">
                                                        @lang('site.parttime')
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.housing_allowancessssss')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="housing_allowance">
                                                    <option selected disabled>@lang('site.select')</option>

                                                    <option value="Remotely">
                                                        @lang('site.Remotely')
                                                    </option>
                                                    <option value="Office">
                                                        @lang('site.Office')
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.job_end')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="job_end">
                                                    <option value="yes">
                                                        @lang('site.yes')
                                                    </option>
                                                    <option value="no">
                                                        @lang('site.no')
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.vacations_balance')</label>
                                            <input type="date" name="vacations_balance" class="form-control"
                                                value="{{old('vacations_balance')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Indemnity')</label>
                                            <input type="date" name="Indemnity" class="form-control"
                                                value="{{old('Indemnity')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hours')</label>
                                            <input type="number" name="hours" class="form-control"
                                                value="{{old('hours')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoursess')</label>
                                            <input type="number" name="allowance" class="form-control"
                                                value="{{old('allowance')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoursesss')</label>
                                            <input type="number" name="salary_total" class="form-control"
                                                value="{{old('salary_total')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.yearly')</label>
                                            <input type="text" name="yearly" class="form-control"
                                                value="{{old('yearly')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.employee_start')</label>
                                            <input type="text" name="employee_start" class="form-control hijri-picker"
                                                value="{{old('employee_start')}}" id="hijri-picker">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.employee_end')</label>
                                            <input type="date" name="employee_end" class="form-control"
                                                value="{{old('employee_end')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Date of service expiration')</label>
                                            <input type="date" name="currency" class="form-control"
                                                value="{{old('currency')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.birthday')</label>
                                            <input type="text" name="birthday" class="form-control hijri-picker"
                                                value="{{old('birthday')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Termination_type')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="Termination_type">
                                                    <option value="Resignation">
                                                        @lang('site.Resignation')
                                                    </option>
                                                    <option value="Referendum">
                                                        @lang('site.Referendum')
                                                    </option>
                                                    <option value="suspension">
                                                        @lang('site.suspension')
                                                    </option>

                                                    <option value="working">
                                                        @lang('site.working')
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.activenotes')</label>
                                            <textarea id="text-box" name="descriptions" cols="10" rows="4"
                                                class="form-control" value="{{old('descriptions')}}"></textarea>
                                        </div>
                                    </div>

                                </div>



                            </div>
                            <div class="tab-pane mt-2" id="hoppienes-tab">
                                <div class="row">


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy')</label>
                                            <input type="text" name="hoppy" class="form-control"
                                                value=" {{old('hoppy')}} ">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_date1')</label>
                                            <input type="text" name="hoppy_date1" class="form-control hijri-picker"
                                                value="{{old('hoppy_date1')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_date2')</label>
                                            <input type="date" name="hoppy_date2" class="form-control"
                                                value="{{old('hoppy_date2')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_start_date1')</label>
                                            <input type="text" name="hoppy_start_date1"
                                                class="form-control hijri-picker" value="{{old('hoppy_start_date1')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_date3')</label>
                                            <input type="date" name="hoppy_date3" class="form-control"
                                                value="{{old('hoppy_date3')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_start_date3')</label>
                                            <input type="text" name="hoppy_start_date3" class="form-control"
                                                value="{{old('hoppy_start_date3')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_date4')</label>
                                            <input type="text" name="hoppy_date4" class="form-control"
                                                value="{{old('hoppy_date4')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_start_date4')</label>
                                            <input type="date" name="hoppy_start_date4" class="form-control"
                                                value="{{old('hoppy_start_date4')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_date5')</label>
                                            <input type="date" name="hoppy_date5" class="form-control"
                                                value="{{old('hoppy_date5')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_start_date5')</label>
                                            <input type="text" name="hoppy_start_date5" class="form-control"
                                                value="{{old('hoppy_start_date5')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy_start_date2')</label>
                                            <input type="text" name="hoppy_start_date2"
                                                class="form-control hijri-picker" value="{{old('hoppy_start_date2')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.tax_numbers')</label>
                                            <input type="date" name="tax_numbers" class="form-control"
                                                value="{{old('tax_numbers')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.tax_type')</label>
                                            <input type="text" name="tax_type" class="form-control hijri-picker"
                                                value="{{old('tax_type')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.passport_number')</label>
                                            <input type="date" name="passport_number" class="form-control"
                                                value="{{old('passport_number')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.status_insure')</label>
                                            <input type="text" name="status_insure" class="form-control"
                                                value="{{old('status_insure')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.name_insure')</label>
                                            <input type="text" name="name_insure" class="form-control"
                                                value="{{old('name_insure')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.number2')</label>
                                            <input type="text" name="number2" class="form-control"
                                                value="{{old('number2')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.number2')</label>
                                            <input type="text" name="number2" class="form-control"
                                                value="{{old('number2')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.tax_type_date')</label>
                                            <input type="text" name="tax_type_date" class="form-control hijri-picker"
                                                value="{{old('tax_type_date')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.date3')</label>
                                            <input type="date" name="date3" class="form-control"
                                                value="{{old('date3')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.status_insure_date')</label>

                                            <input type="text" name="status_insure_date"
                                                class="form-control hijri-picker" value="{{old('status_insure_date')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.date4')</label>
                                            <input type="date" name="date4" class="form-control"
                                                value="{{old('date4')}}">
                                        </div>
                                    </div>


                                </div>
                                <!-- <div class="row nav nav-tabs mt-4" role="tablist">
                                <a class="w-100 btn btn-air-primary btn-pill btn-primary getActiveClass2"
                                    id="followers-tab" data-bs-toggle="tab" data-bs-target="#followers" type="button"
                                    role="tab" aria-controls="followers" aria-selected="false">
                                    @lang('site.next')</a>
                            </div> -->
                            </div>
                            <div class="tab-pane mt-2" id="followers-tab">

                                <div class="row followersOld">


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.full_names')</label>
                                            <input type="text" name="full_name[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.number')</label>
                                            <input type="text" name="number[]" class="form-control">

                                        </div>

                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.hoppy')</label>
                                            <input type="text" name="hoppys[]" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Insuranc_end_date')</label>
                                            <input type="date" name="Insuranc_end_date[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">
                                        <label>@lang('site.type1')</label>


                                        <div class="select-area d-flex align-items-center">
                                            <select class="form-control" name="type2[]">
                                                <option value="female">
                                                    @lang('site.female')
                                                </option>
                                                <option value="male">
                                                    @lang('site.male')
                                                </option>

                                            </select>
                                        </div>

                                    </div>


                                    <div class=" align-items-end d-flex justify-content-between">


                                    </div>
                                    <div class=" authors-list">

                                    </div>


                                </div>
                                <hr>
                                <div class=" align-items-end d-flex justify-content-between">

                                    <a class="btn btn-primary followers">

                                        اضافة
                                        متابع
                                        اضافي
                                    </a>
                                </div>
                                <div class="row followersNew">
                                </div>
                                <!-- <hr> -->

                                <!-- <div class="row nav nav-tabs mt-4" role="tablist">
                                <a class="w-100 btn btn-air-primary btn-pill btn-primary getActiveClass3"
                                    id="vehicles-tab" data-bs-toggle="tab" data-bs-target="#vehicles" type="button"
                                    role="tab" aria-controls="vehicles" aria-selected="false">
                                    @lang('site.next')</a>
                            </div> -->
                            </div>
                            <div class="tab-pane mt-2" id="vehicles-tab">



                                <div class="row vehiclOld" id="vehiclOld">


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Insurance_name')</label>
                                            <input type="text" name="Insurance_name[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Insuranc_start_date')</label>
                                            <input type="text" name="Insuranc_start_date[]" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.ID_expiration_dates')</label>
                                            <input type="text" name="ID_expiration_dates[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Trial_end_date')</label>
                                            <input type="text" name="Trial_end_date[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.yearly_vacation')</label>
                                            <input type="text" name="yearly_vacation[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.style')</label>
                                            <input type="text" name="style[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.brand')</label>
                                            <input type="text" name="brand[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.color')</label>
                                            <input type="color" name="color[]" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.start_dates')</label>
                                            <input type="text" name="start_date[]" class="form-control hijri-picker">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.ID_expiration_date')</label>
                                            <input type="date" name="ID_expiration_date[]" class="form-control">
                                        </div>

                                    </div>


                                </div>

                                <hr>
                                <div class=" align-items-end d-flex justify-content-between">

                                    <a class="btn btn-primary vehicles">

                                        اضافة
                                        مركبه
                                        اضافي
                                    </a>
                                </div>
                                <div class="row vehiclNew">

                                </div>
                                <!-- <hr> -->
                                <!-- <div class="row nav nav-tabs mt-4" role="tablist">
                                <a class="w-100 btn btn-air-primary btn-pill btn-primary getActiveClass4"
                                    id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                                    role="tab" aria-controls="security" aria-selected="false">
                                    @lang('site.next')</a>
                            </div> -->

                            </div>
                            <div class="tab-pane mt-2" id="Salary-tab">
                                <div class="row">

                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.salary')</label>--}}
                                    {{--                                                        <input type="text" name="salary" class="form-control" id="mainsalary"--}}
                                    {{--                                                               value=" {{old('salary')}}
                                    " >--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.Insurance_salary')</label>--}}
                                    {{--                                                        <input type="text" name="Insurance_salary" class="form-control" id="salary"--}}
                                    {{--                                                               value=" {{old('Insurance_salary')}}
                                    ">--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}


{{--                                                                                    <div class="col-md-6  col-12 p-2">--}}
{{--                                                                                        <div class="single-input">--}}
{{--                                                                                            <label>@lang('site.allowance')</label>--}}
{{--                                                                                            <input type="text" name="allowance" class="form-control"--}}
{{--                                                                                                   value=" {{old('allowance')}}--}}
{{--                                    " id="allowance">--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </div>--}}

                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.housing_allowances')</label>--}}
                                    {{--                                                        <input type="text" name="housing_allowances" class="form-control"--}}
                                    {{--                                                               value=" {{old('housing_allowances')}}
                                    "--}}
                                    {{--                                                               id="housing_allowances">--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.Transportation_allowance')</label>--}}
                                    {{--                                                        <input type="text" name="Transportation_allowances" class="form-control"--}}
                                    {{--                                                               value=" {{old('Transportation_allowances')}}
                                    "--}}
                                    {{--                                                               id="Transportation_allowances">--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}


                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.housing_allowance')</label>--}}
                                    {{--                                                        <input type="text" name="housing_allowance" class="form-control"--}}
                                    {{--                                                               value=" {{old('housing_allowance')}}
                                    "--}}
                                    {{--                                                               id="housing_allowance">--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.salary_total')</label>--}}
                                    {{--                                                        <input type="text" name="salary_total" class="form-control"--}}
                                    {{--                                                               value=" {{old('salary_total')}}
                                    " id="salary_total"--}}
                                    {{--                                                               readonly>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                    <div class="single-input">--}}
                                    {{--                                                        <label>@lang('site.total2')</label>--}}
                                    {{--                                                        <input type="text" name="total2" class="form-control"--}}
                                    {{--                                                               value=" {{old('total2')}}
                                    " id="total2">--}}
                                    {{--                                                    </div>--}}

                                    {{--                                                </div>--}}

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.bank_name')</label>
                                            <input type="text" name="bank_name" class="form-control"
                                                value="{{old('bank_name')}}">

                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.iban')</label>
                                            <input type="text" name="iban" class="form-control" value="{{old('iban')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.sick_leave')</label>
                                            <input type="text" name="sick_leave" class="form-control"
                                                value="{{old('sick_leave')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.sustainable_covenant')</label>
                                            <input type="text" name="sustainable_covenant" class="form-control"
                                                value="{{old('sustainable_covenant')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.others')</label>
                                            <textarea id="text-box" name="others" cols="10" rows="4"
                                                class="form-control" value="{{old('others')}}"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.notes')</label>

                                            <textarea id="text-box" name="notes" cols="10" rows="4" class="form-control"
                                                value="{{old('notes')}}"></textarea>
                                        </div>


                                    </div>


                                </div>


                                <div class="row">


                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.hiring_date')</label>
                                        <input type="date" name="salaries[hiring_date]" class="form-control"
                                            value="{{ old('hiring_date') }}">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.basic_salary')</label>
                                        <input type="text" name="salaries[basic_salary]" class="form-control"
                                            value="{{ old('basic_salary') }}" id="basic_salary">
                                    </div>



                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.Social insurance deduction')</label>
                                        <input type="text" name="salaries[Socialinsurancediscount]" class="form-control"
                                                >
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.Absencess')</label>
                                        <input type="text" name="salaries[absance]" class="form-control"
                                                >
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.Residencess')</label>
                                        <input type="text" name="salaries[Residence]" class="form-control"
                                               >
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.Residencess')</label>
                                        <input type="text" name="salaries[Residence]" class="form-control"
                                               >
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.Other deductions')</label>
                                        <input type="text" name="salaries[reconnaissance]" class="form-control"
                                             >
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>  @lang('site.Add more cuts') </label>
                                        <input type="text" name="salaries[Addmoredeductions]" class="form-control"
                                                >
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>  @lang('site.outofhours') </label>
                                        <input type="text" name="salaries[outofwork]" class="form-control"
                                              >
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>  @lang('site.Otherdues')</label>
                                        <input type="text" name="salaries[merits]" class="form-control"
                                              >
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label> @lang('site.Addthewantedfromthedues')</label>
                                        <input type="text" name="salaries[aspirantdues]" class="form-control"
                                               >
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label> @lang('site.total_salary')</label>
                                        <input type="text" name="salaries[total_salary]" class="form-control"
                                              >
                                    </div>



                                </div>

                                <hr>

                                <h4 class="card-title">بدلات</h4>
                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.variable_transportation')</label>
                                        <input type="text" name="salaries[variable_transportation]" class="form-control"
                                            value="{{ old('variable_transportation') }}" id="variable_transportation">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.other_allowance')</label>
                                        <input type="text" name="salaries[other_allowance]" class="form-control"
                                            value="{{ old('other_allowance') }}" id="other_allowance">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.fixed_transportation')</label>
                                        <input type="text" name="salaries[fixed_transportation]" class="form-control"
                                            value="{{ old('fixed_transportation') }}" id="fixed_transportation">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.incentives')</label>
                                        <input type="text" name="salaries[incentives]" class="form-control"
                                            value="{{ old('incentives') }}" id="incentives">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.variablefood_allowance')</label>
                                        <input type="text" name="salaries[variablefood_allowance]" class="form-control"
                                            value="{{ old('variablefood_allowance') }}" id="variablefood_allowance">
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.variable_overtime')</label>
                                        <input type="text" name="salaries[variable_overtime]" class="form-control"
                                            value="{{ old('variable_overtime') }}">
                                    </div>


                                </div>
                                <hr>

                                <h4 class="card-title">الحوافز والمكافآت</h4>


                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.delay')</label>
                                        <input type="text" name="salaries[delay]" class="form-control"
                                            value="{{ old('delay') }}" id="delay">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.absence')</label>
                                        <input type="text" name=salaries[absence]" class="form-control"
                                            value="{{ old('absence') }}" id="absence">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.gross_salary')</label>
                                        <input type="text" name="salaries[gross_salary]" class="form-control"
                                            value="{{ old('gross_salary') }}" id="gross_salary">
                                    </div>


                                </div>

                                <hr>
                                <h4 class="card-title"> العمل الاضافي</h4>






                                <div class="row">


                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.total_dedction1')</label>
                                        <input type="text" name="salaries[total_dedction1]" class="form-control"
                                            value="{{ old('total_dedction1') }}" id="total_dedction1">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.social_insurance')</label>
                                        <input type="text" name="salaries[social_insurance]" class="form-control"
                                            value="{{ old('social_insurance') }}" id="social_insurance">
                                    </div>


                                </div>
                                <div class="row">


                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.annualtaxable_salary')</label>
                                        <input type="text" name="salaries[annualtaxable_salary]" class="form-control"
                                            value="{{ old('annualtaxable_salary') }}" id="annualtaxable_salary">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.totalgross_salary')</label>
                                        <input type="text" name="salaries[totalgross_salary]" class="form-control"
                                            value="{{ old('totalgross_salary') }}" id="totalgross_salary">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.taxable_salary')</label>
                                        <input type="text" name="salaries[taxable_salary]" class="form-control"
                                            value="{{ old('taxable_salary') }}" id="taxable_salary">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.monthly_taxes')</label>
                                        <input type="text" name="salaries[monthly_taxes]" class="form-control"
                                            value="{{ old('monthly_taxes') }}" id="monthly_taxes">
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.employee_socialinsurance')</label>
                                        <input type="text" name="salaries[employee_socialinsurance]"
                                            class="form-control" value="{{ old('employee_socialinsurance') }}"
                                            id="employee_socialinsurance">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.id_number')</label>
                                        <input type="text" name="salaries[id_number]" class="form-control"
                                            value="{{ old('id_number') }}" id="id_number">
                                    </div>


                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.net_income')</label>
                                        <input type="text" name="salaries[net_income]" class="form-control"
                                            value="{{ old('net_income') }}" id="net_income">
                                    </div>


                                </div>

                                <div class="row">


                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.penalty')</label>
                                        <input type="text" name="salaries[penalty]" class="form-control"
                                            value="{{ old('penalty') }}" id="totalsalaries">
                                    </div>
                                </div>

                                <hr>

                                <h4 class="card-title">الخصومات</h4>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.annual_taxes')</label>
                                        <input type="text" name="salaries[annual_taxes]" class="form-control"
                                            value="{{ old('annual_taxes') }}" id="annual_taxes">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.premium_card')</label>
                                        <input type="text" name="salaries[premium_card]" class="form-control"
                                            value="{{ old('premium_card') }}" id="premium_card">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.mobile_invoice')</label>
                                        <input type="text" name="salaries[mobile_invoice]" class="form-control"
                                            value="{{ old('mobile_invoice') }}" id="mobile_invoice">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.familymedical_insurance')</label>
                                        <input type="text" name="salaries[familymedical_insurance]" class="form-control"
                                            value="{{ old('familymedical_insurance') }}" id="familymedical_insurance">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.total_deductions')</label>
                                        <input type="text" name="salaries[total_deductions]" class="form-control"
                                            value="{{ old('total_deductions') }}" id="total_deductions">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.loan')</label>
                                        <input type="text" name="salaries[loan]" class="form-control"
                                            value="{{ old('loan') }}" id="loan">
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.otherdeductions')</label>
                                        <input type="text" name="salaries[otherdeductions]" class="form-control"
                                            value="{{ old('otherdeductions') }}" id="otherdeductions">
                                    </div>
                                </div>

                                <hr>

                                <h4 class="card-title">

                                    التأمينات الاجتماعية
                                </h4>
                                <div class="row">

                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.finalnet_income')</label>
                                        <input type="text" name="salaries[finalnet_income]" class="form-control"
                                            value="{{ old('finalnet_income') }}" id="finalnet_income">

                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.other_allowance2')</label>
                                        <input type="text" name="salaries[other_allowance2]" class="form-control"
                                            value="{{ old('other_allowance2') }}" id="other_allowance2">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.account_number')</label>
                                        <input type="text" name="salaries[account_number]" class="form-control"
                                            value="{{ old('account_number') }}" id="account_number">
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.pay')</label>
                                        <input type="text" name="salaries[pay]" class="form-control"
                                            value="{{ old('pay') }}" id="pay">
                                    </div>
                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.totalsocial_insurance')</label>
                                        <input type="text" name="salaries[totalsocial_insurance]" class="form-control"
                                            value="{{ old('totalsocial_insurance') }}" id="totalsocial_insurance">
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-6 form-group col-12 p-2">


                                        <label>@lang('site.unpaid_leave')</label>
                                        <input type="text" name="salaries[unpaid_leave]" class="form-control"
                                            value="{{ old('unpaid_leave') }}">
                                    </div>

                                    <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.other_dedutions')</label>
                                        <input type="text" name="salaries[other_dedutions]" class="form-control"
                                            value="{{ old('other_dedutions') }}">
                                    </div>
                                </div>

                                <hr>
                                <!-- <div class="row nav nav-tabs mt-4" role="tablist">
                                <a class="w-100 btn btn-air-primary btn-pill btn-primary getActiveClass5"
                                    id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button"
                                    role="tab" aria-controls="payment" aria-selected="false">
                                    @lang('site.next')</a>
                            </div> -->
                            </div>
                            <div class="tab-pane mt-2" id="vacationsbalance">

                                <div class="row">


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.yearly_vacation')</label>
                                            <input type="text" name="yearly_vacation" class="form-control"
                                                value=" {{old('yearly_vacation')}} ">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.total')</label>
                                            <input type="text" name="total" class="form-control"
                                                value=" {{old('total')}} ">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Haj_Vacation')</label>
                                            <input type="text" name="Haj_Vacation" class="form-control"
                                                value=" {{old('Haj_Vacation')}} ">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.pregnancy_permit')</label>
                                            <input type="text" name="pregnancy_permit" class="form-control"
                                                value=" {{old('pregnancy_permit')}} ">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.permission_marry')</label>
                                            <input type="text" name="permission_marry" class="form-control"
                                                value=" {{old('permission_marry')}} ">
                                        </div>
                                    </div>

                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Opposition_leave')</label>
                                            <input type="text" name="Opposition_leave" class="form-control"
                                                value=" {{old('Opposition_leave')}} ">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.Sick_leaves')</label>
                                            <input type="text" name="Sick_leaves" class="form-control"
                                                value=" {{old('Sick_leaves')}} ">
                                        </div>
                                    </div>


                                    <div class="col-md-6  col-12 p-2">
                                        <div class="single-input">
                                            <label>@lang('site.others')</label>
                                            <textarea id="text-box" name="others" cols="10" rows="4"
                                                class="form-control" value="{{old('others')}}"></textarea>

                                        </div>
                                    </div>


                                </div>
                                <!-- <div class="row nav nav-tabs mt-4" role="tablist">
                                <a class="w-100 btn btn-air-primary btn-pill btn-primary getActiveClass6"
                                    id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification"
                                    type="button" role="tab" aria-controls="notification" aria-selected="false">
                                    @lang('site.next')</a>
                            </div> -->
                            </div>
                            <div class="tab-pane mt-2" id="Entitlementscovenant">
                                <div class="row">

                                    {{--                                                 <div class="col-md-6  col-12 p-2">--}}
                                    {{--                                                 <div class="single-input">--}}
                                    {{--                                                 <label>@lang('site.others')</label>--}}
                                    {{--                                                 <textarea id="text-box" name="others" cols="10" rows="4" class="form-control"--}}
                                    {{--                                                 value="{{old('others')}}"></textarea>--}}

                                    {{--                                                 </div>--}}
                                    {{--                                                 </div>--}}

                                    <div class=" align-items-end d-flex justify-content-between">
                                        <div class="col-md-3 col-12">
                                            <div class="single-input">
                                                <label>@lang('site.namesss')</label>
                                                <input type="text" id="category_image" class="form-control"
                                                    name="name_file[]" >
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="single-input">
                                                <label>@lang('site.end_date')</label>
                                                <input type="date" id="end_date" class="form-control" name="end_date[]"
                                                    >
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-3 mt-3">
                                            <div class="single-input">
                                                <input type="file" class="form-control" value="{{ old('image') }}"
                                                    name="image[]" >
                                            </div>
                                        </div>


                                        <div class="col-md-3 col-12 col-12 text-end mt-3">
                                            <button class="btn btn-primary add-author">
                                                <!--@lang('site.add')-->
                                                اضافة
                                                ملف
                                                اضافي
                                            </button>
                                        </div>

                                    </div>
                                    <div class=" authors-list">

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>





            </div>
        </div>
    </div>
</div>
<!-- Dashboard Section end -->




@endsection
@section('scripts')





<script>
function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementsByClassName("authors-list").deleteRow(i);
}

$(document).ready(function() {
    jQuery('a.getActiveClass').click(function(event) {
        event.preventDefault();

        $('button.button1').removeClass('active')
        $('button.button2').addClass('active')


    });
});
$(document).ready(function() {
    jQuery('a.getActiveClass2').click(function(event) {
        event.preventDefault();

        $('button.button2').removeClass('active')
        $('button.button3').addClass('active')


    });
});

$(document).ready(function() {
    jQuery('a.getActiveClass3').click(function(event) {
        event.preventDefault();

        $('button.button3').removeClass('active')
        $('button.button4').addClass('active')


    });
});

$(document).ready(function() {
    jQuery('a.getActiveClass4').click(function(event) {
        event.preventDefault();

        $('button.button4').removeClass('active')
        $('button.button5').addClass('active')


    });
});
$(document).ready(function() {
    jQuery('a.getActiveClass5').click(function(event) {
        event.preventDefault();

        $('button.button5').removeClass('active')
        $('button.button6').addClass('active')


    });
});
$(document).ready(function() {
    jQuery('a.getActiveClass6').click(function(event) {
        event.preventDefault();

        $('button.button6').removeClass('active')
        $('button.button7').addClass('active')


    });
});


$(document).ready(function() {
    jQuery('button.add-author').click(function(event) {
        event.preventDefault();
        var newRow = jQuery('<div class="d-flex mt-2"><div class="col-md-3 col-12">' +
            '<input type="text"     name="name_file[]" class="form-control"/></div><div class="col-md-3 col-12">' +
            '<input type="date"     name="end_date[]" class="form-control"/>' +
            '</div><div class="col-md-3 col-12 ">' +

            '<input type="file" name="image[]" class="form-control"/>' +
            // '</div>' +
            // '<div class="col-md-3 col-12">' +
            // ' <button onclick="deleteRow(this)">' +
            // '<i class="far fa-trash-alt me-1 fa-2x delete"></i>' +
            // '</button>' +
            '</div></div>');

        jQuery('.authors-list').append(newRow);
    });
});


$(document).ready(function() {
    jQuery('a.vehicles').click(function(event) {

        // var $button = $('.vehiclOld').clone();
        // $('.vehiclNew').html($button);


        var form = $(".vehiclOld").eq(0).clone();
        form.find("input[type=text]").val("");
        form.show().insertAfter(".vehiclNew");
    });

});

$(document).ready(function() {
    jQuery('a.followers').click(function(event) {


        var form = $(".followersOld").eq(0).clone();
        form.find("input[type=text]").val("");
        form.show().insertAfter(".followersNew");
    });

});
</script>


<script>
jQuery('input#housing_allowance').change(function() {
    console.log("fdsdf");
    var discount = jQuery('input#housing_allowance').val();
    console.log('dicscount', discount)
    var salary = jQuery('input#salary').val();
    console.log('salary', salary)

    var housing_allowances = jQuery('input#housing_allowance').val();
    console.log('housing_allowances', housing_allowances)

    var mainsalary = jQuery('input#mainsalary').val();

    console.log('mainsalary', mainsalary)

    // var allowance = jQuery('input#allowance').val();
    // console.log('allowance', allowance)
    // var total = Number(salary) + Number(housing_allowances) + Number(Transportation_allowances);
    // console.log('total', total)

    // var subtotal = total - (total * (discount / 100))

    var subtotals = (Number(salary) * Number(housing_allowances)) + Number(mainsalary);


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

    jQuery('input#salary_total').val(Number(subtotals));

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="{{asset('dashboard/js/bootstrap-hijri-datetimepickermin.js')}}"></script>

<script type="text/javascript">
$(function() {

    initDefault();

});

function initDefault() {
    $(".hijri-picker").hijriDatePicker({
        hijri: true,
        showSwitcher: false,
        useCurrent: false,
        showTodayButton: true,
        showClear: true,
    });
}
</script>
//





<!--</script>-->
<script>
jQuery('input#incentives').change(function() {
    console.log("fdsdf");
    var variabletransportation = jQuery('input#variable_transportation').val();
    console.log('variabletransportation', variabletransportation)
    var otherallowance = jQuery('input#other_allowance').val();
    console.log('otherallowance', otherallowance)

    var fixedtransportation = jQuery('input#fixed_transportation').val();
    console.log('fixedtransportation', fixedtransportation)

    var incentives = jQuery('input#incentives').val();

    console.log('incentives', incentives)

    // var allowance = jQuery('input#allowance').val();
    // console.log('allowance', allowance)
    // var total = Number(salary) + Number(housing_allowances) + Number(Transportation_allowances);
    // console.log('total', total)

    // var subtotal = total - (total * (discount / 100))

    var subtotals = Number(variabletransportation) + Number(otherallowance) + Number(fixedtransportation) +
        Number(incentives);


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

    jQuery('input#variablefood_allowance').val(Number(subtotals));

});
</script>

<script>
jQuery('input#absence').change(function() {
    console.log("fdsdf");
    var delay = jQuery('input#delay').val();
    console.log('delay', delay)
    var absence = jQuery('input#absence').val();
    console.log('absence', absence)


    var subtotals = Number(delay) + Number(absence);


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

    jQuery('input#gross_salary').val(Number(subtotals));

});


jQuery('input#net_income').change(function() {
    console.log("fdsdf");
    var basic_salary = jQuery('input#basic_salary').val();
    console.log('basic_salary', basic_salary)
    var variablefood_allowance = jQuery('input#variablefood_allowance').val();
    console.log('variablefood_allowance', variablefood_allowance)

    var gross_salary = jQuery('input#gross_salary').val();
    console.log('gross_salary', gross_salary)

    var net_income = jQuery('input#net_income').val();
    console.log('net_income', net_income)


    var subtotals = Number(basic_salary) + Number(variablefood_allowance) + Number(gross_salary) + Number(
        net_income);


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

    jQuery('input#totalsalaries').val(Number(subtotals));

});
</script>



<script>
jQuery('input#total_dedction1').change(function() {
    console.log("fdsdf");
    var total_dedction1 = jQuery('input#total_dedction1').val();
    console.log('total_dedction1', total_dedction1)

    var basic_salary = jQuery('input#basic_salary').val();
    console.log('basic_salary', basic_salary)


    var subtotals = Number(basic_salary) / 30 / 8 * 135 / 100 * Number(total_dedction1);


    console.log('subtotals', subtotals)


    jQuery('input#social_insurance').val(Number(subtotals));

});


jQuery('input#annualtaxable_salary').change(function() {
    console.log("fdsdf");
    var annualtaxable_salary = jQuery('input#annualtaxable_salary').val();
    console.log('annualtaxable_salary', annualtaxable_salary)

    var basic_salary = jQuery('input#basic_salary').val();
    console.log('basic_salary', basic_salary)


    var subtotals = Number(basic_salary) / 30 / 8 * 17 / 100 * Number(annualtaxable_salary);


    console.log('subtotals', subtotals)


    jQuery('input#totalgross_salary').val(Number(subtotals));

});

jQuery('input#taxable_salary').change(function() {
    console.log("fdsdf");
    var taxable_salary = jQuery('input#taxable_salary').val();
    console.log('taxable_salary', taxable_salary)

    var basic_salary = jQuery('input#basic_salary').val();
    console.log('basic_salary', basic_salary)


    var subtotals = Number(basic_salary) / 30 * Number(taxable_salary);


    console.log('subtotals', subtotals)


    jQuery('input#monthly_taxes').val(Number(subtotals));

});


jQuery('input#employee_socialinsurance').change(function() {
    console.log("fdsdf");
    var employee_socialinsurance = jQuery('input#employee_socialinsurance').val();
    console.log('employee_socialinsurance', employee_socialinsurance)

    var basic_salary = jQuery('input#basic_salary').val();
    console.log('basic_salary', basic_salary)

    var monthly_taxes = jQuery('input#monthly_taxes').val();
    console.log('monthly_taxes', monthly_taxes)

    var totalgross_salary = jQuery('input#totalgross_salary').val();
    console.log('totalgross_salary', totalgross_salary)

    var social_insurance = jQuery('input#social_insurance').val();
    console.log('social_insurance', social_insurance)


    var subtotals = Number(basic_salary) / 30 * 2 * Number(employee_socialinsurance);


    console.log('subtotals', subtotals)


    jQuery('input#id_number').val(Number(subtotals));

    var sumtotoal = Number(subtotals) + Number(monthly_taxes) + Number(totalgross_salary) + Number(
        social_insurance);


    console.log('sumtotoa', sumtotoal)
    jQuery('input#net_income').val(Number(sumtotoal));


});


jQuery('input#employee_socialinsurance').change(function() {
    console.log("fdsdf");
    var total_dedction1 = jQuery('input#total_dedction1').val();
    console.log('total_dedction1', total_dedction1)
    var annualtaxable_salary = jQuery('input#annualtaxable_salary').val();
    console.log('annualtaxable_salary', annualtaxable_salary)

    var taxable_salary = jQuery('input#taxable_salary').val();
    console.log('taxable_salary', taxable_salary)

    var taxable_salary = jQuery('input#taxable_salary').val();

    console.log('taxable_salary', taxable_salary)

    // var allowance = jQuery('input#allowance').val();
    // console.log('allowance', allowance)
    // var total = Number(salary) + Number(housing_allowances) + Number(Transportation_allowances);
    // console.log('total', total)

    // var subtotal = total - (total * (discount / 100))

    var subtotals = Number(total_dedction1) + Number(annualtaxable_salary) + Number(taxable_salary) + Number(
        taxable_salary);


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));


});
</script>




<script>
jQuery('input#employee_socialinsurance').change(function() {
    console.log("fdsdf");
    var net_income = jQuery('input#net_income').val();
    console.log('net_income', net_income)
    var gross_salary = jQuery('input#gross_salary').val();
    console.log('gross_salary', gross_salary)

    var variablefood_allowance = jQuery('input#variablefood_allowance').val();
    console.log('variablefood_allowance', variablefood_allowance)


    // var allowance = jQuery('input#allowance').val();
    // console.log('allowance', allowance)
    // var total = Number(salary) + Number(housing_allowances) + Number(Transportation_allowances);
    // console.log('total', total)

    // var subtotal = total - (total * (discount / 100))

    var subtotals = Number(net_income) + Number(gross_salary) + Number(variablefood_allowance);


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

    jQuery('input#monthly_taxes').val(Number(subtotals));

});
</script>



<script>
jQuery('input#total_deductions').change(function() {
    console.log("fdsdf");
    var annual_taxes = jQuery('input#annual_taxes').val();
    console.log('annual_taxes', annual_taxes)
    var premium_card = jQuery('input#premium_card').val();
    console.log('premium_card', premium_card)

    var loan = jQuery('input#loan').val();
    console.log('loan', loan)

    var totalsalaries = jQuery('input#totalsalaries').val();
    console.log('totalsalaries', totalsalaries)


    var mobile_invoice = jQuery('input#mobile_invoice').val();
    console.log('mobile_invoice', mobile_invoice)


    var familymedical_insurance = jQuery('input#familymedical_insurance').val();
    console.log('familymedical_insurance', familymedical_insurance)


    var total_deductions = jQuery('input#total_deductions').val();
    console.log('total_deductions', total_deductions)


    // var subtotal = total - (total * (discount / 100))

    var subtotals = Number(premium_card) + Number(annual_taxes) + Number(familymedical_insurance) + Number(
        total_deductions) + Number(mobile_invoice)


    console.log('subtotals', subtotals)

    // console.log('total', total)
    // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

    var monthly_taxes = jQuery('input#monthly_taxes').val();
    console.log('monthly_taxes', monthly_taxes)

    jQuery('input#loan').val(Number(subtotals));


    var afterDiscountTotal = Number(totalsalaries) - Number(subtotals);



    jQuery('input#otherdeductions').val(afterDiscountTotal);


});
</script>




<script>
jQuery('input#finalnet_income').change(function() {
    console.log("fdsdf");
    var finalnet_income = jQuery('input#finalnet_income').val();
    console.log('finalnet_income', finalnet_income)


    var other_allowance2 = Number(finalnet_income) * (11 / 100);


    console.log('other_allowance2', other_allowance2)


    jQuery('input#other_allowance2').val(other_allowance2);


    var account_number = Number(finalnet_income) * (1875 / 100);


    console.log('account_number', account_number)

    jQuery('input#account_number').val(account_number);


    var otherdeductions = jQuery('input#otherdeductions').val();
    console.log('otherdeductions', otherdeductions)


    jQuery('input#pay').val(Number(otherdeductions) - Number(other_allowance2));
    var pay = jQuery('input#pay').val();
    console.log('pay', pay)

    jQuery('input#totalsocial_insurance').val(Number(pay) * 12);


});
</script>


@endsection