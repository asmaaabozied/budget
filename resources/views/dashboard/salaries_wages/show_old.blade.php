@extends('layouts.dashboard.app')

@section('content')







    <section class="dashboard-section body-collapse">
        <div class="overlay mt-80">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row align-items-center row">
                        <div class="col-6">
                            <h3>@lang('site.salaries_wages')</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">
                                    <!--@lang('site.dashboard')-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a hhref="{{ route('dashboard.salaries_wages.index') }}">
                                        @lang('site.salaries_wages') </a>
                                </li>
                                <li class="breadcrumb-item active"><a> @lang('site.edit') </a></li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <!-- Individual column searching (text inputs) Starts-->
                    <div class="col-sm-12">
                        <div class="card">
                            <form action="{{ route('dashboard.salaries_wages.update', $salaryweges->id) }}"
                                  method="post"
                                  enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="card-header d-flex justify-content-between">
                                    <h5>@lang('site.edit') </h5>
                                    <div class="text-end  group-btn-top">
                                        <div class="form-group d-flex form-group justify-content-between">
                                            <button type="button"
                                                    class="btn btn-pill btn-outline-primary btn-air-primary"
                                                    onclick="history.back();">
                                                <!--<i class="fa fa-backward"></i> -->
                                                @lang('site.back')
                                            </button>

                                        </div>
                                    </div>


                                </div>
                                <div class="card-body">
                                <!--<h4 class="card-title">@lang('site.salaries_wages')</h4>-->
                                    @include('partials._errors')


                                    <div class="row">


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee')</label>
                                            <select class="form-control" name="employee_id" disabled readonly="">
                                                <option selected> @lang('site.select')</option>
                                                @foreach(\App\User::get() as $user)
                                                    <option value="{{$user->id}}"

                                                            @if($user->id==$salaryweges->employee_id)
                                                            selected @endif
                                                    > {{$user->full_name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                           <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.hiring_date')</label>
                                            <input type="date" name="hiring_date" class="form-control"
                                                   value="{{$salaryweges->hiring_date ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.basic_salary')</label>
                                            <input type="text" name="basic_salary" class="form-control"
                                                   value="{{$salaryweges->basic_salary ?? ''}}" readonly>
                                        </div>
                                     


                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.variable_transportation')</label>
                                            <input type="text" name="variable_transportation" class="form-control"
                                                   value="{{$salaryweges->variable_transportation ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.other_allowance')</label>
                                            <input type="text" name="other_allowance" class="form-control"
                                                   value="{{$salaryweges->other_allowance ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.fixed_transportation')</label>
                                            <input type="text" name="fixed_transportation" class="form-control"
                                                   value="{{$salaryweges->fixed_transportation ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.incentives')</label>
                                            <input type="text" name="incentives" class="form-control"
                                                   value="{{$salaryweges->incentives ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.variablefood_allowance')</label>
                                            <input type="text" name="variablefood_allowance" class="form-control"
                                                   value="{{$salaryweges->variablefood_allowance ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.variable_overtime')</label>
                                            <input type="text" name="variable_overtime" class="form-control"
                                                   value="{{$salaryweges->variable_overtime ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.delay')</label>
                                            <input type="text" name="delay" class="form-control"
                                                   value="{{$salaryweges->delay ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.absence')</label>
                                            <input type="text" name="absence" class="form-control"
                                                   value="{{$salaryweges->absence ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.gross_salary')</label>
                                            <input type="text" name="gross_salary" class="form-control"
                                                   value="{{$salaryweges->gross_salary ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.other_dedutions')</label>
                                            <input type="text" name="other_dedutions" class="form-control"
                                                   value="{{$salaryweges->other_dedutions ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.unpaid_leave')</label>
                                            <input type="text" name="unpaid_leave" class="form-control"
                                                   value="{{$salaryweges->unpaid_leave ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.penalty')</label>
                                            <input type="text" name="penalty" class="form-control"
                                                   value="{{$salaryweges->penalty ?? ''}}" readonly>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.social_insurance')</label>
                                            <input type="text" name="social_insurance" class="form-control"
                                                   value="{{$salaryweges->social_insurance ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.totalgross_salary')</label>
                                            <input type="text" name="totalgross_salary" class="form-control"
                                                   value="{{$salaryweges->totalgross_salary ?? ''}}" readonly>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.total_dedction1')</label>
                                            <input type="text" name="total_dedction1" class="form-control"
                                                   value="{{$salaryweges->total_dedction1 ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.annualtaxable_salary')</label>
                                            <input type="text" name="annualtaxable_salary" class="form-control"
                                                   value="{{$salaryweges->annualtaxable_salary ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.taxable_salary')</label>
                                            <input type="text" name="taxable_salary" class="form-control"
                                                   value="{{$salaryweges->taxable_salary ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee_socialinsurance')</label>
                                            <input type="text" name="employee_socialinsurance" class="form-control"
                                                   value="{{$salaryweges->employee_socialinsurance ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.net_income')</label>
                                            <input type="text" name="net_income" class="form-control"
                                                   value="{{$salaryweges->net_income ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.monthly_taxes')</label>
                                            <input type="text" name="monthly_taxes" class="form-control"
                                                   value="{{$salaryweges->monthly_taxes ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.annual_taxes')</label>
                                            <input type="text" name="annual_taxes" class="form-control"
                                                   value="{{$salaryweges->annual_taxes ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.premium_card')</label>
                                            <input type="text" name="premium_card" class="form-control"
                                                   value="{{$salaryweges->premium_card ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.mobile_invoice')</label>
                                            <input type="text" name="mobile_invoice" class="form-control"
                                                   value="{{$salaryweges->mobile_invoice ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.familymedical_insurance')</label>
                                            <input type="text" name="familymedical_insurance" class="form-control"
                                                   value="{{$salaryweges->familymedical_insurance ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.total_deductions')</label>
                                            <input type="text" name="total_deductions" class="form-control"
                                                   value="{{$salaryweges->total_deductions ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.loan')</label>
                                            <input type="text" name="loan" class="form-control"
                                                   value="{{$salaryweges->loan ?? ''}}" readonly>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.otherdeductions')</label>
                                            <input type="text" name="otherdeductions" class="form-control"
                                                   value="{{$salaryweges->otherdeductions ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.finalnet_income')</label>
                                            <input type="text" name="finalnet_income" class="form-control"
                                                   value="{{$salaryweges->finalnet_income ?? ''}}" readonly>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.other_allowance2')</label>
                                            <input type="text" name="other_allowance2" class="form-control"
                                                   value="{{$salaryweges->other_allowance2 ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.account_number')</label>
                                            <input type="text" name="account_number" class="form-control"
                                                   value="{{$salaryweges->account_number ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.pay')</label>
                                            <input type="text" name="pay" class="form-control"
                                                   value="{{$salaryweges->pay ?? ''}}" readonly>
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.totalsocial_insurance')</label>
                                            <input type="text" name="totalsocial_insurance" class="form-control"
                                                   value="{{$salaryweges->totalsocial_insurance ?? ''}}" readonly>
                                        </div>


                                    </div>

                                    <!--<div class="row">-->
                                    <!--    <div class="col-md-6 form-group col-12 p-2">-->


                                    <!--        <label>@lang('site.email')</label>-->
                                    <!--        <input type="text" name="email" class="form-control"-->
                                    <!--               value="{{$salaryweges->email ?? ''}}" readonly>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6 form-group col-12 p-2">-->

                                    <!--        <label>@lang('site.id_number')</label>-->
                                    <!--        <input type="text" name="id_number" class="form-control"-->
                                    <!--               value="{{$salaryweges->id_number ?? ''}}" readonly>-->
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
    </section>



@endsection
