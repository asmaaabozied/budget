@extends('layouts.dashboard.app')

@section('content')


<!-- Dashboard Section start -->
<div class=" dashboard-section body-collapse account show-employee step crypto deposit-money">
    <div class="content">
        <div class="container-fluid">


            <!-- start main -->
            <div class="main-content">

                {{--                <form action="{{ route('dashboard.employee.update', $employee->id) }}"
                method="post"--}}
                {{--                    enctype="multipart/form-data" id="add-form">--}}

                {{--                    {{ csrf_field() }}--}}
                {{--                    {{ method_field('put') }}--}}
                <div class="row">


                    <div class="col-md-3  col-12">
                        <div class="owner-details card">
                            <div class="profile-area">
                                <div class="profile-img">
                                    <img src="{{asset('images/employee/'.$employee->image)}}" alt="image" width="100x"
                                        height="100px" class="rounded-3"
                                         onerror="this.src='{{asset('images/employee/1671111127.png')}}'">

                                </div>
                                <div class="name-area">
                                    <h6> {{$employee->name ?? ''}}

                                        {{$employee->father_name ?? ''}}


                                        {{$employee->family_name ?? ''}}

                                    </h6>


                                    <p class="active-status font-weight-bold"> @if($employee->status==1)
                                        @lang('site.active') @else @lang('site.inactive') @endif</p>
                                </div>
                            </div>
                            <div class="owner-info">
                                <ul>
                                    <li>
                                        <p>@lang('site.hoppy'):</p>
                                        <span class="mdr">{{$employee->hoppy ?? ''}}</span>
                                    </li>
                                    <li>
                                        <p>@lang('site.employee_end') :</p>
                                        <span class="mdr">{{$employee->employee_end ?? ''}} </span>

                                    </li>
                                    <li>
                                        <p>@lang('site.job') :</p>
                                        <span class="mdr"> {{$employee->job ?? ''}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="owner-action">

                                <a href="{{route('dashboard.logout')}}">
                                    <i data-feather="log-out"></i>
                                    <span class="txt-danger">@lang('site.logout')</span>
                                </a>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-9 col-12">
                        <div class="tab-main card" id="basicwizard">
                            <ul class="form-wizard-header  m-0 nav nav-justified nav-pills" role="tablist">

                                <li class="nav-item">
                                    <a href="#account-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i
                                            class=" ri-account-circle-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.basic information')</span>
                                    </a>
                                </li>
                                <!--start Salary tab-->
                                <li class="nav-item">
                                    <a href="#Salary-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i
                                            class=" ri-money-dollar-circle-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.informationss')</span>
                                    </a>

                                </li>
                                <!--end Salary tab-->
                                <!--start password tab-->
                                <li class="nav-item">

                                    <a href="#security-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i class=" ri-lock-2-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.passwordsecurity')</span>
                                    </a>
                                </li>
                                <!--end password tab-->

                                <!--start notifictions-->

                                <li class="nav-item">
                                    <a href="#notification-tab" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link  ">
                                        <i
                                            class=" ri-notification-2-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.notifications')</span>
                                    </a>
                                </li>

                                <!--end notifictions-->


                                <li class="nav-item">

                                    <a href="#hoppienes-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i class="ri-bank-card-2-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.hoppienes')</span>
                                    </a>


                                </li>


                                <li class="nav-item" role="presentation">
                                    <a href="#followers-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i class="ri-team-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.followers')</span>
                                    </a>

                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#vehicles-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i class="ri-truck-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.vehicles')</span>
                                    </a>

                                </li>


                                <li class="nav-item" role="presentation">

                                    <a href="#securitys-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link  ">
                                        <i class="ri-secure-payment-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.salary and wages')</span>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#payment-tab" data-bs-toggle="tab" data-toggle="tab" class="nav-link ">
                                        <i class=" ri-suitcase-3-line font-18 align-middle  d-block  d-sm-none  "></i>
                                        <span class="d-none d-sm-inline">@lang('site.vacations balance')</span>
                                    </a>

                                </li>


                                <li class="nav-item" role="presentation">
                                    <a href="#notifications-tab" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link  ">
                                        <i class=" ri-file-upload-line font-18 align-middle  d-block  d-sm-none "></i>
                                        <span class="d-none d-sm-inline">@lang('site.Entitlements and covenant')</span>
                                    </a>

                                </li>

                            </ul>


                            <div class="tab-content b-0 mb-0">
                                <div class=" d-flex justify-content-end">

                                    {{--                                        <button type="submit" class="btn btn-air-primary btn-pill btn-primary mx-2"><i--}}
                                    {{--                                                class="fa fa-magic"></i>--}}
                                    {{--                                            @lang('site.edit')</button>--}}

                                    <a href="{{route('dashboard.printpdf',$employee->id)}}"
                                        class="btn btn-outline-primary"><i class="fa fa-download"></i>
                                        PDF</a>

                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                            onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i>-->
                                        @lang('site.back')
                                    </button>
                                </div>
                                <div class="tab-pane mt-2" id="account-tab">
                                    <div class="row">
                                        <div
                                            class="align-items-center bg-light col-12 col-md-12 d-flex form-group justify-content-between p-2 upload-avatar">
                                            <div class="avatar-left align-items-center d-flex">


                                                <div class="profile-img ">
                                                    <img src="{{asset('dashboardstyle/assets/images/pdf-file-icon-29.png')}}"
                                                        width="60px" height="60px" class="rounded-3">

                                                    {{--                                                        <img src="{{asset('images/employee/'.$employee->image)}}"--}}
                                                    {{--                                                            alt="image" width="80px" height="80px"--}}
                                                    {{--                                                            onerror="this.src='{{asset('uploads/'.auth()->user()->image)}}'">
                                                    --}}
                                                </div>
                                                <a href="{{route('dashboard.printpdf',$employee->id)}}"
                                                    class="instraction px-3">
                                                    <h6>تحميل كامل معلوماتي</h6>
                                                </a>
                                            </div>
                                            <div class="avatar-right text-center">
                                                <div class="file-upload">
                                                    {{--                                                        <div class="right-area">--}}
                                                    {{--                                                            <label class="file">--}}
                                                    {{--                                                                <h6>ارفع صورة جديدة لك</h6>--}}
                                                    {{--                                                                <input type="file" name="photo">--}}
                                                    {{--                                                                <span class="file-custom"></span>--}}
                                                    {{--                                                            </label>--}}
                                                    {{--                                                        </div>--}}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.names')</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{$employee->name ?? ''}}" readonly>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.father_name')</label>
                                            <input type="text" name="father_name" class="form-control"
                                                value="{{$employee->father_name ?? ''}}" readonly>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.family_name')</label>
                                            <input type="text" name="family_name" class="form-control"
                                                value="{{$employee->family_name ?? ''}}" readonly>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.quality')</label>
                                            <input type="text" name="quality" class="form-control"
                                                value="{{$employee->quality ?? ''}}" readonly>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.type1')</label>
                                            <input type="text" name="type1" class="form-control"
                                                value="{{$employee->type1 ?? ''}}" readonly>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.national')</label>

                                            <input type="text" name="national" class="form-control"
                                                value="{{$employee->national ?? ''}}" readonly>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.Religion')</label>
                                            <input type="text" name="Religion" class="form-control"
                                                value="{{$employee->Religion ?? ''}}" readonly>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.phone')</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{$employee->phone ?? ''}}" readonly>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.email')</label>
                                            <input type="text" name="email" class="form-control"
                                                value="{{$employee->email ?? ''}}" readonly>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.Contract_start_date')</label>
                                            <input type="text" name="Contract_start_date" class="form-control"
                                                value="{{$employee->Contract_start_date ?? ''}}" readonly>

                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.Contract_expiry_date')</label>
                                            <input type="text" name="Contract_expiry_date" class="form-control"
                                                value="{{$employee->Contract_expiry_date ?? ''}}" readonly>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.countrys')</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{$employee->country ?? ''}}" readonly>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.job_term')</label>
                                            <input type="text" name="job_term" class="form-control"
                                                value="{{$employee->job_term ?? ''}}" readonly>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.Date_marriage')</label>
                                            <input type="text" name="Date_marriage" class="form-control"
                                                value="{{$employee->Date_marriage ?? ''}}" readonly>

                                        </div>
                                        <!-- </form> -->


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.company')</label>

                                                <div class="select-area d-flex align-items-center">

                                                    <!-- Multiple Select -->
                                                    <!-- Multiple Select -->
                                                    <select class="select2 form-control select2-multiple"
                                                        data-toggle="select2" multiple="multiple"
                                                        data-placeholder="Choose..." disabled>

                                                        {{--                                                            <option selected disabled>@lang('site.select')</option>--}}
                                                        @foreach(\App\Models\Branch::where('type','company')->get() as $company)
                                                        <option value="{{$company->id}}" @if(in_array($company->
                                                            id,$companies)) selected @endif>
                                                            {{$company->name}} </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.branch')</label>

                                                <div class="select-area d-flex align-items-center">
                                                    <!-- Multiple Select -->
                                                    <select class="select2 form-control select2-multiple"
                                                        data-toggle="select2" multiple="multiple"
                                                        data-placeholder="Choose..." disabled>

                                                        {{--                                                            <option selected disabled>@lang('site.select')</option>--}}
                                                        @foreach(\App\Models\Branch::where('type','branch')->get() as $branch)
                                                        <option value="{{$branch->id}}" @if(in_array($branch->
                                                            id,$branches)) selected @endif>
                                                            {{$branch->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.project')</label>
                                            <div class="select-area d-flex align-items-center">
                                                {{--                                                    <select class="form-control" name="project_id" disabled>--}}
                                                {{--                                                        <option selected disabled>@lang('site.select')</option>--}}
                                                {{--                                                        @foreach(\App\Models\Branch::where('type','project')->get()--}}
                                                {{--                                                        as--}}
                                                {{--                                                        $project)--}}
                                                {{--                                                        <option value="{{$project->id}}"
                                                @if($employee->--}}
                                                {{--                                                            project_id==$project->id)--}}
                                                {{--                                                            selected @endif> {{$project->name}}
                                                </option>--}}
                                                {{--                                                        @endforeach--}}
                                                {{--                                                    </select>--}}

                                                <!-- Multiple Select -->
                                                <select class="select2 form-control select2-multiple"
                                                    data-toggle="select2" multiple="multiple"
                                                    data-placeholder="Choose..." disabled>

                                                    {{--                                                        <option disabled>@lang('site.select')</option>--}}
                                                    @foreach(\App\Models\Branch::where('type','project')->get() as $project)
                                                    <option value="{{$project->id}}" @if(in_array($project->
                                                        id,$projects)) selected @endif> {{$project->name}}
                                                    </option>
                                                    @endforeach


                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.categories')</label>

                                                <!-- Multiple Select -->
                                                <select class="select2 form-control select2-multiple"
                                                    data-toggle="select2" multiple="multiple"
                                                    data-placeholder="Choose..." disabled>
                                                    <div class="select-area d-flex align-items-center">

                                                        {{--                                                            <option selected disabled>@lang('site.select')</option>--}}
                                                        @foreach(\App\Models\category::get() as $category)
                                                        <option value="{{$category->id}}" @if(in_array($category->
                                                            id,$categories)) selected
                                                            @endif> {{$category->name}} </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.job')</label>
                                            <input type="text" name="job" class="form-control"
                                                value="{{$employee->job ?? ''}}" readonly>

                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.degree_job')</label>
                                                <input type="text" name="degree_job" class="form-control"
                                                    value="{{$employee->degree_job ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.housing_allowancessssss')</label>
                                                <div class="select-area d-flex align-items-center">
                                                    <select class="form-control" name="housing_allowance" disabled>
                                                        <option>@lang('site.select')</option>

                                                        <option value="Remotely" @if($employee->
                                                            housing_allowance=='Remotely')
                                                            selected @endif>
                                                            @lang('site.Remotely') </option>
                                                        <option value="Office" @if($employee->
                                                            housing_allowance=='Office')
                                                            selected @endif>
                                                            @lang('site.Office') </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.type')</label>
                                            <div class="select-area d-flex align-items-center ">
                                                <select class="form-control" name="type" disabled>
                                                    <option value="fulltime" @if($employee->type=='fulltime')
                                                        selected @endif>
                                                        @lang('site.fulltime') </option>
                                                    <option value="parttime" @if($employee->type=='parttime')
                                                        selected @endif>
                                                        @lang('site.parttime') </option>

                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.job_end')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="job_end" disabled>
                                                    <option value="yes" @if($employee->job_end=='yes') selected
                                                        @endif>
                                                        @lang('site.yes')
                                                    </option>
                                                    <option value="no" @if($employee->job_end=='no') selected
                                                        @endif>
                                                        @lang('site.no')
                                                    </option>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.vacations_balance')</label>
                                                <input type="date" name="vacations_balance" class="form-control"
                                                    value="{{$employee->vacations_balance ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Indemnity')</label>
                                                <input type="date" name="Indemnity" class="form-control"
                                                    value="{{$employee->Indemnity ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.hours')</label>
                                            <input type="number" name="hours" class="form-control"
                                                value="{{$employee->hours ?? ''}}" readonly>


                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">


                                            <div class="single-input">
                                                <label>@lang('site.hoursess')</label>
                                                <input type="number" name="allowance" class="form-control"
                                                    value="{{$employee->allowance ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoursesss')</label>
                                                <input type="number" name="salary_total" class="form-control"
                                                    value="{{$employee->salary_total ?? ''}}" readonly>
                                            </div>
                                        </div>




                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.yearly')</label>
                                            <input type="text" name="yearly" class="form-control"
                                                value="{{$employee->yearly ?? ''}}" readonly>

                                        </div>


                                        {{--                                            <div class="col-md-6 form-group col-12 p-2">--}}


                                        {{--                                                <label>@lang('site.password')</label>--}}
                                        {{--                                                <input type="password" name="password" class="form-control" required--}}
                                        {{--                                                       readonly>--}}


                                        {{--                                            </div>--}}


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee_start')</label>
                                            <input type="text" name="employee_start" class="form-control"
                                                value="{{$employee->employee_start ?? ''}}" readonly>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee_end')</label>
                                            <input type="text" name="employee_end" class="form-control"
                                                value="{{$employee->employee_end ?? ''}}" readonly>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.Date of service expiration')</label>
                                            <input type="text" name="currency" class="form-control"
                                                value="{{$employee->currency ?? ''}}" readonly>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.birthday')</label>
                                            <input type="text" name="birthday" class="form-control"
                                                value="{{$employee->birthday ?? ''}}" readonly>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.Termination_type')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" name="Termination_type" disabled>
                                                    <option value="Resignation" @if($employee->
                                                        Termination_type=='Resignation')
                                                        selected @endif> @lang('site.Resignation') </option>
                                                    <option value="Referendum" @if($employee->
                                                        Termination_type=='Referendum')
                                                        selected @endif> @lang('site.Referendum') </option>
                                                    <option value="suspension" @if($employee->
                                                        Termination_type=='suspension')
                                                        selected @endif> @lang('site.suspension') </option>

                                                    <option value="working" @if($employee->
                                                        Termination_type=='working')
                                                        selected @endif> @lang('site.working') </option>

                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.activenotes')</label>
                                            <textarea id="text-box" name="descriptions" cols="10" rows="4"
                                                class="form-control" readonly
                                                value=" {{$employee->descriptions ?? ''}} ">{{$employee->descriptions ?? ''}}</textarea>

                                        </div>


                                        <!-- start next step -->
                                        <ul class="list-inline wizard mb-0">
                                            <li class="next list-inline-item float-end">
                                                <a href="javascript:void(0);" class="btn btn-primary">@lang('site.next')
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end next step -->
                                    </div>
                                </div>


                                <!--start Salary  tab-->
                                <div class="tab-pane mt-2" id="Salary-tab">
                                    <div class="row">


                                        <div class="col col-12 col-md-4 form-group p-2 ">

                                            <label>@lang('site.salary')</label>
                                            <input type="text" name="salary" class="form-control"
                                                value="{{$employee->basic_salary ?? ''}}" readonly>

                                        </div>
{{--                                        <div class="col col-12 col-md-4 form-group p-2 ">--}}

{{--                                            <label>@lang('site.housing_allowance')</label>--}}
{{--                                            <input type="text" name="housing_allowance" class="form-control"--}}
{{--                                                value="{{$employee->housing_allowance ?? ''}}" readonly>--}}

{{--                                        </div>--}}
{{--                                        <div class="col col-12 col-md-4 form-group p-2 ">--}}

{{--                                            <label>@lang('site.allowance')</label>--}}
{{--                                            <input type="text" name="allowance" class="form-control"--}}
{{--                                                value="{{$employee->allowance ?? ''}}" readonly>--}}

{{--                                        </div>--}}
                                        <div class=" col col-12 col-md-8 form-group p-2">

                                            <label>@lang('site.salary_total')</label>
                                            <div class="align-items-center d-flex">
                                                <input type="text" name="salary_total" class="form-control w-75"
                                                    value="{{$total ?? ''}}" readonly> <span
                                                    class="px-3">


                                                    {{$employee->company->currency->name ?? ''}}
                                                </span>
                                            </div>


                                        </div>

                                        {{--                                            <div class="col-12 col-md-7 d-flex form-group p-2">--}}

                                        {{--                                                <label class="col-md-5 font-weight-bold li txt-primary p-0">اجمالي--}}
                                        {{--                                                    المبالغ التي تم دفعها لي منذ بداية الوظيفة حتي الان هي:</label>--}}
                                        {{--                                                <div class="align-items-center d-flex">--}}
                                        {{--                                                    <input type="text" name="total2" class="form-control w-auto"--}}
                                        {{--                                                        value="{{$employee->total2 ?? ''}}"
                                        readonly>--}}
                                        {{--                                                    <span class="p-1">--}}



                                        {{--                                                        {{$employee->company->currency->name ?? ''}}--}}

                                        {{--                                                    </span>--}}
                                        {{--                                                </div>--}}


                                        {{--                                            </div>--}}

                                        <div class="align-items-end col col-12 col-md-4 d-flex form-group p-2">
                                            <img src="{{asset('dashboardstyle/assets/images/pdf-file-icon-29.png')}}"
                                                width="50px" height="50px">
                                            <a href="{{route('dashboard.printpdf',$employee->id)}}"
                                                class="btn font-weight-bold txt-primary">
                                                تحميل

                                            </a>
                                        </div>

                                        <div class="left-area mt-2">
                                            <label class="py-3">سجل تحويل راتبك حتي الان :</label>
                                            <ul>
                                                @foreach(\App\Models\SalaryWege::where('employee_id',$employee->id)->get() as $user)
                                                @if(!empty($user->hiring_date))

                                                <li><a href="" class="single-link active">لقد تم دفع راتبك لشهر
                                                        {{(!empty($user->hiring_date)) ?
                                                       $user->hiring_date : ''}}
                                                        بقيمة
                                                        {{$user->total_salary ?? ' 100'}}
                                                        {{$employee->company->currency->name ?? ' جنيه مصري'}} </a>
                                                </li>
                                                @endif

                                                @endforeach

                                            </ul>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <!--end Salary tab-->

                                <!--start password tab-->
                                <div class="tab-pane mt-2" id="security-tab">
                                    <div class="row">
                                        <div
                                            class="align-items-center authentication bg-light border-r-10 d-flex justify-content-between p-2 single-content">
                                            <div class="left">

                                              @if(auth()->user() && auth()->user()->google2fa_secret)
                                                    <p class="font-weight-bold txt-primary text-title-alert m-0">
                                                        @lang('otp.2fa_enabled')
                                                    </p>
                                                  @endif

                                                  @if(auth()->user() && ! auth()->user()->google2fa_secret)
                                                      <p class="font-weight-bold txt-danger text-title-alert m-0">
                                                          @lang('otp.2fa_not_enabled')
                                                      </p>
                                                  @endif

                                            </div>

                                            <div class="right">
                                                @if(auth()->user() && ! auth()->user()->google2fa_secret)
                                                    <a class="btn btn-primary"
                                                        href="{{route('2fa.enable', $employee->id) }}">
                                                        @lang('otp.enable')
                                                    </a>
                                                @endif

                                                @if(auth()->user() && auth()->user()->google2fa_secret)
                                                        <a class="btn btn-danger"
                                                           href="{{route('2fa.disable') }}">
                                                            @lang('otp.disable')
                                                        </a>
                                               @endif
                                            </div>
                                        </div>

                                    </div>

                                    @include('partials._errors')
                                    <div class="change-pass mb-4 mt-4">
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <form action="{{route('dashboard.chanagepassword')}}" method="post">
                                                    @csrf
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12  col-12 p-2">
                                                            <div class="single-input">
                                                                <label
                                                                    for="current-password">@lang('site.passwords')</label>
                                                                <input type="text" name="password" id="current-password"
                                                                    placeholder="@lang('site.passwords')" required
                                                                    class="form-control">

                                                                <input type="hidden" name="id" value="{{$employee->id}}"
                                                                    class="form-control">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  col-12 p-2">
                                                            <div class="single-input">
                                                                <label
                                                                    for="new-password">@lang('site.newpassword')</label>
                                                                <input type="text" id="new-password" name="newpassword"
                                                                    placeholder="@lang('site.newpassword')" required
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  col-12 p-2">
                                                            <div class="single-input">
                                                                <label
                                                                    for="confirm-password">@lang('site.confirmpassword')</label>
                                                                <input type="text" id="confirm-password"
                                                                    name="confirmpassword"
                                                                    placeholder="@lang('site.confirmpassword')" required
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  col-12 p-2">
                                                            <div class="btn-border w-100">
                                                                <button class="btn btn-primary w-100 "
                                                                    type="submit">@lang('site.chanage')</button>
                                                                <span
                                                                    class="d-block font-weight-bold pt-2 text-primary">اذا
                                                                    كنت قد نسيت
                                                                    كلمة
                                                                    السر فيمكنك استراجاعها من هنا

                                                                    <a href="#"
                                                                        class="btn font-weight-bold txt-primary btn-link">(صفحة
                                                                        الدعم
                                                                        الفني)</a>


                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="bg-light p-2 rounded-2 single-content your-devices">
                                                    <div
                                                        class="head-item d-flex align-items-center justify-content-between">
                                                        <h5>اجهزتك</h5>
                                                        <a href="javascript:void(0)">سجل خروج من كل الاجهزة</a>
                                                    </div>


                                                    @foreach(\App\Models\Device::get() as $device)
                                                    <div class="single-setting">
                                                        <div class="left">
                                                            <div class="icon-area">
                                                                {{--                                                                    <img src="{{asset('dashboard/assets/images/icon/iphone.png')}}"--}}
                                                                {{--                                                                        alt="icon">--}}

                                                            </div>
                                                            <div class="text-area">
                                                                <h6>{{$device->name ?? ''}}</h6>
                                                                <p>Cairo

                                                                    <!--{{$device->county ?? ''}}-->


                                                                    · {{$device->created_at ?? ''}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <button class="btn btn-outline-primary btn-primary-link"
                                                                onclick="window.location='{{route('dashboard.deleteDevice',$device->id)}}';">@lang('site.logout')</button>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    {{--                                                        <div class="single-setting">--}}
                                                    {{--                                                            <div class="left">--}}
                                                    {{--                                                                <div class="icon-area">--}}
                                                    {{--                                                                    <img src="{{asset('dashboard/assets/images/icon/ipad.png')}}"
                                                    alt="icon">--}}

                                                    {{--                                                                </div>--}}
                                                    {{--                                                                <div class="text-area">--}}
                                                    {{--                                                                    <h6>iPad Pro</h6>--}}
                                                    {{--                                                                    <p>New York City · June 20 at 14:00</p>--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <div class="right">--}}
                                                    {{--                                                                <button class="btn-primary-link">خروج</button>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <div class="single-setting">--}}
                                                    {{--                                                            <div class="left">--}}
                                                    {{--                                                                <div class="icon-area">--}}
                                                    {{--                                                                    <img src="{{asset('dashboard/assets/images/icon/imac.png')}}"
                                                    alt="icon">--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                                <div class="text-area">--}}
                                                    {{--                                                                    <h6>iMac OSX</h6>--}}
                                                    {{--                                                                    <p>New York City · June 20 at 14:00</p>--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <div class="right">--}}
                                                    {{--                                                                <button class="btn-primary-link">خروج</button>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                        </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button"
                                                    class="btn btn-primary">@lang('site.next')</button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <!--end password tab-->

                                <!--start notifictions tab-->
                                <div class="tab-pane mt-2" id="notification-tab">
                                    <div class="row">
                                        <div class="col-12 p-2">
                                            <h5 class="f-16 my-3 p-0">التنبيهات الاخيرة:</h5>
                                            <div class="alert alert-primary">
                                                <i class="ri-notification-3-fill"></i>
                                                <span class="txt-primary font-weight-bold">تم تحديث بعض البيانات في
                                                    حسابك من قبل المحاسب
                                                    ادم</span>

                                            </div>
                                            <div class="alert alert-primary">
                                                <i class="ri-notification-3-fill"></i>
                                                <span class="txt-primary font-weight-bold">تم اضافة راتب
                                                    الشهر.</span>

                                            </div>
                                            <div class="alert alert-primary">
                                                <i class="ri-notification-3-fill"></i>
                                                <span class="txt-primary font-weight-bold">تم اضافة راتب
                                                    الشهر.</span>

                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!--end notifictions tab-->


                                <div class="tab-pane mt-2" id="hoppienes-tab">
                                    <div class="row">


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_date1')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_date1 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_date2')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_date2 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_start_date1')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_start_date1 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_date3')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_date3 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_start_date3')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_start_date3 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_date4')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_date4 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_start_date4')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_start_date4 ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_date5')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_date5 ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_start_date5')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->hoppy_start_date5 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy_start_date2')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employees->hoppy_start_date2 ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.tax_numbers')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employees->tax_numbers ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.tax_type')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employees->tax_type ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.passport_number')</label>
                                                <input type="text" name="passport_number" class="form-control"
                                                    value="{{$employees->passport_number ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.status_insure')</label>
                                                <input type="text" name="status_insure" class="form-control"
                                                    value="{{$employees->status_insure ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.name_insure')</label>
                                                <input type="text" name="name_insure" class="form-control"
                                                    value="{{$employees->name_insure ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.number2')</label>
                                                <input type="text" name="number2" class="form-control"
                                                    value="{{$employees->number2 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.tax_type_date')</label>
                                                <input type="text" name="tax_type_date" class="form-control"
                                                    value="{{$employees->tax_type_date ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.date3')</label>
                                                <input type="text" name="date3" class="form-control"
                                                    value="{{$employees->date3 ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.status_insure_date')</label>

                                                <input type="text" name="status_insure_date" class="form-control"
                                                    value="{{$employees->status_insure_date ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.date4')</label>
                                                <input type="text" name="date4" class="form-control"
                                                    value="{{$employees->date4 ?? ''}}" readonly>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="tab-pane mt-2" id="securitys-tab">


                                    <div class="row">


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.bank_name')</label>
                                                <p>{{$employee->bank_name ?? ''}}</p>

                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.iban')</label>
                                                <p>{{$employee->iban ?? ''}}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.total2')</label>
                                                <p>{{$employee->total2 ?? ''}}</p>
                                            </div>

                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.sick_leave')</label>
                                                <p>{{$employee->sick_leave ?? ''}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.sustainable_covenant')</label>
                                                <p>{{$employee->sustainable_covenant ?? ''}}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.others')</label>
                                                <p>{{$employee->others ?? ''}}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.notes')</label>

                                                <p>{{$employee->notes ?? ''}}</p>
                                            </div>


                                        </div>


                                    </div>

                                    <div class="row">


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.hiring_date')</label>
                                            <p>{{$salaryweges->hiring_date ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.basic_salary')</label>
                                            <p>{{$employee->basic_salary ?? ''}}</p>
                                        </div>


                                    </div>

                                    <hr>
                                    <h4 class="card-title">بدلات</h4>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.variable_transportation')</label>
                                            <p>{{$salaryweges->variable_transportation ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.other_allowance')</label>
                                            <p>{{$salaryweges->other_allowance ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.fixed_transportation')</label>
                                            <p>{{$salaryweges->fixed_transportation ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.incentives')</label>
                                            <p>{{$salaryweges->incentives ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.variablefood_allowance')</label>
                                            <p>{{$salaryweges->variablefood_allowance ?? ''}}</p>
                                        </div>


                                    </div>

                                    <hr>


                                    <h4 class="card-title">الحوافز والمكافآت</h4>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.delay')</label>
                                            <p>{{$salaryweges->delay ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.absence')</label>
                                            <p>{{$salaryweges->absence ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.gross_salary')</label>
                                            <p>{{$salaryweges->gross_salary ?? ''}}</p>
                                        </div>


                                    </div>
                                    <hr>
                                    <h4 class="card-title"> العمل الاضافي</h4>


                                    <div class="row">


                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.total_dedction1')</label>
                                            <p>{{$salaryweges->total_dedction1 ?? ''}}</p>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.social_insurance')</label>
                                            <p>{{$salaryweges->social_insurance ?? ''}}</p>
                                        </div>


                                    </div>
                                    <div class="row">


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.annualtaxable_salary')</label>
                                            <p>{{$salaryweges->annualtaxable_salary ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.totalgross_salary')</label>
                                            <p>{{$salaryweges->totalgross_salary ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.taxable_salary')</label>
                                            <p>{{$salaryweges->taxable_salary ?? ''}}</p>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.monthly_taxes')</label>
                                            <p>{{$salaryweges->monthly_taxes ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee_socialinsurance')</label>
                                            <p>{{$salaryweges->employee_socialinsurance ?? ''}}</p>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.id_number')</label>
                                            <p>{{$salaryweges->id_number ?? ''}}</p>
                                        </div>


                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.net_income')</label>
                                            <p>{{$salaryweges->net_income ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.penalty')</label>
                                            <p>{{$salaryweges->penalty ?? ''}}</p>
                                        </div>
                                    </div>


                                    <hr>

                                    <h4 class="card-title">الخصومات</h4>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.annual_taxes')</label>
                                            <p>{{$salaryweges->annual_taxes ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.premium_card')</label>
                                            <p>{{$salaryweges->premium_card ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.mobile_invoice')</label>
                                            <p>{{$salaryweges->mobile_invoice ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.familymedical_insurance')</label>
                                            <p>{{$salaryweges->familymedical_insurance ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.total_deductions')</label>
                                            <p>{{$salaryweges->total_deductions ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.loan')</label>
                                            <p>{{$salaryweges->loan ?? ''}}</p>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.otherdeductions')</label>
                                            <p>{{$salaryweges->otherdeductions ?? ''}}</p>
                                        </div>


                                    </div>

                                    <hr>

                                    <h4 class="card-title">

                                        التأمينات الاجتماعية
                                    </h4>
                                    <div class="row">

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.finalnet_income')</label>
                                            <p>{{$salaryweges->finalnet_income ?? ''}}</p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.other_allowance2')</label>
                                            <p>{{$salaryweges->other_allowance2 ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.account_number')</label>
                                            <p>{{$salaryweges->account_number ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.pay')</label>
                                            <p>{{$salaryweges->pay ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.totalsocial_insurance')</label>
                                            <p>{{$salaryweges->totalsocial_insurance ?? ''}}</p>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.unpaid_leave')</label>
                                            <p>{{$salaryweges->unpaid_leave ?? ''}}</p>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.other_dedutions')</label>
                                            <p>{{$salaryweges->other_dedutions ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="tab-pane mt-2" id="payment-tab">


                                    {{--                                        //holidays--}}


                                    <div class="row">


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Haj_Vacation')</label>
                                                <input type="text" name="Haj_Vacation" class="form-control"
                                                    value="{{$employee->Haj_Vacation ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.pregnancy_permit')</label>
                                                <input type="text" name="pregnancy_permit" class="form-control"
                                                    value="{{$employee->pregnancy_permit ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.permission_marry')</label>
                                                <input type="text" name="permission_marry" class="form-control"
                                                    value="{{$employee->permission_marry ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Opposition_leave')</label>
                                                <input type="text" name="Opposition_leave" class="form-control"
                                                    value="{{$employee->Opposition_leave ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Sick_leaves')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->Sick_leaves ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.total')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$employee->total ?? ''}}" readonly>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>


                                <div class="tab-pane mt-2" id="followers-tab">


                                    @foreach($followers as $Follower)
                                    <div class="row followersOld">


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.full_names')</label>
                                                <input type="text" name="full_name[]" class="form-control"
                                                    value="{{$Follower->full_name ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.number')</label>
                                                <input type="text" name="number[]" class="form-control"
                                                    value="{{$Follower->number}}" readonly>

                                            </div>

                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.hoppy')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$Follower->hoppy ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Insuranc_end_date')</label>
                                                <input type="text" class="form-control"
                                                    value="{{$Follower->Insuranc_end_date ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group col-12 p-2">
                                            <label>@lang('site.type1')</label>
                                            <div class="select-area d-flex align-items-center">
                                                <select class="form-control" readonly disabled>
                                                    <option value="female" @if($Follower->type1=='female')
                                                        selected @endif >
                                                        @lang('site.female')
                                                    </option>
                                                    <option value="male" @if($Follower->type1=='male')
                                                        selected @endif>
                                                        @lang('site.male')
                                                    </option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class=" align-items-end d-flex justify-content-between">


                                        </div>


                                    </div>
                                    @endforeach

                                    <!--<hr>-->
                                    <div class="row followersNew">
                                    </div>
                                    <!--<hr>-->
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>


                                </div>


                                <div class="tab-pane mt-2" id="vehicles-tab">


                                    @foreach($vehicles as $vehicle)
                                    <div class="row vehiclOld" id="vehiclOld">


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Insurance_name')</label>
                                                <input type="text" name="Insurance_name[]" class="form-control"
                                                    value="{{$vehicle->Insurance_name ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Insuranc_start_date')</label>
                                                <input type="text" name="Insuranc_start_date[]" class="form-control"
                                                    value="{{$vehicle->Insuranc_start_date ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.ID_expiration_dates')</label>
                                                <input type="text" name="ID_expiration_dates[]" class="form-control"
                                                    value="{{$vehicle->ID_expiration_dates ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.Trial_end_date')</label>
                                                <input type="text" name="Trial_end_date[]" class="form-control"
                                                    value="{{$vehicle->Trial_end_date ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.yearly_vacation')</label>
                                                <input type="text" name="yearly_vacation[]" class="form-control"
                                                    value="{{$vehicle->yearly_vacation ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.style')</label>
                                                <input type="text" name="style[]" class="form-control"
                                                    value="{{$vehicle->style ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.brand')</label>
                                                <input type="text" name="brand[]" class="form-control"
                                                    value="{{$vehicle->brand ?? ''}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.color')</label>
                                                <input type="color" name="color[]" class="form-control"
                                                    value="{{$vehicle->color ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.start_dates')</label>
                                                <input type="text" name="start_date[]" class="form-control"
                                                    value="{{$vehicle->start_date ?? ''}}" readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6  col-12 p-2">
                                            <div class="single-input">
                                                <label>@lang('site.ID_expiration_date')</label>
                                                <input type="text" name="ID_expiration_date[]" class="form-control"
                                                    value="{{$vehicle->ID_expiration_date ?? ''}}" readonly>
                                            </div>

                                        </div>


                                        <div class=" align-items-end d-flex justify-content-between">


                                        </div>


                                    </div>

                                    @endforeach



                                    <!--<hr>-->
                                    <div class="row vehiclNew">

                                    </div>
                                    <!--<hr>-->
                                    <div class="row">
                                        <ul class="pager wizard mb-0 list-inline">
                                            <li class="previous list-inline-item">
                                                <button type="button" class="btn btn-light"><i
                                                        class="mdi mdi-arrow-left  "></i>
                                                    @lang('site.back')</button>
                                            </li>
                                            <li class="next list-inline-item float-end">
                                                <button type="button" class="btn btn-primary">@lang('site.next')
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>


                                <div class="tab-pane mt-2" id="notifications-tab">
                                    <div class="row">


                                        @foreach(\App\Models\Image::where('imageable_id','=',$employee->id)->get()
                                        as $row)
                                        <div class="align-items-end row">
                                            <div class="col-md-3">
                                                <label>@lang('site.namesss')</label>
                                                <input type="text" id="category_image" class="form-control"
                                                    name="name_file[]" value="{{$row->name ?? ''}}" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>@lang('site.end_date')</label>
                                                <input type="text" id="end_date" class="form-control" name="end_date[]"
                                                    value="{{$row->end_date ?? ''}}" readonly>
                                            </div>
                                            <!--<div class="col-md-3">-->
                                            <!--    <input type="file" class="form-control"-->
                                            <!--           value="{{ old('image') }}"-->
                                            <!--           name="image[]">-->
                                            <!--</div>-->

                                            <div class="col-md-3">
                                                <a
                                                    onclick="window.open('{{asset('images/employee/'.$row->image)}}', '_blank')">
                                                    <i class="ri-eye-line"></i></a>
                                                <!--<a href="{{route('dashboard.download',$row->image)}}"> <i-->
                                                <!--        class="fa fa-download"></i></a>-->


                                                <br>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                    <div class=" authors-list">

                                    </div>


                                    <!--<div class="group-btn-top mt-30 text-end w-100">-->
                                    <!--    <br><br>-->
                                    <!--    <div class=" d-flex  justify-content-between">-->
                                    <!--        <button type="button"-->
                                    <!--                class=" btn btn-pill btn-outline-primary btn-air-primary"-->
                                    <!--                onclick="history.back();">-->
                                    <!--<i class="fa fa-backward"></i>-->
                                    <!--            @lang('site.back')-->
                                    <!--        </button>-->

                                    <!--    </div>-->
                                    <!--</div>-->

                                </div>


                                <!-- </div> -->



                            </div>


                        </div>

                    </div>
                    {{--                </form>--}}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection