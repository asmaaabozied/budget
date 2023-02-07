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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.salaries_wages')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('site.show') </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.salaries_wages')</h4>
                </div>
            </div>


            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.show') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i> -->
                                        @lang('site.back')
                                    </button>

                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.salaries_wages')</h4>
                            @include('partials._errors')


                            <div class="row">


                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.employee')</label>
                                    <select class="form-control" name="employee_id" disabled readonly="">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\User::get() as $user)
                                        <option value="{{$user->id}}" @if($user->id==$salaryweges->employee_id)
                                            selected @endif
                                            > {{$user->name}} </option>
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
                                        value="{{$salaryweges->basic_salary ?? ''}}" id="basic_salary" readonly>
                                </div>



                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.Social insurance deduction')</label>
                                    <input type="text" name="Socialinsurancediscount" class="form-control"
                                        value="{{$salaryweges->Socialinsurancediscount ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.Absencess')</label>
                                    <input type="text" name="absance" class="form-control"
                                        value="{{$salaryweges->absance ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.Residencess')</label>
                                    <input type="text" name="Residence" class="form-control"
                                        value="{{$salaryweges->Residence ?? ''}}" readonly>
                                </div>

                                {{--                                    <div class="col-md-6 form-group col-12 p-2">--}}


                                {{--                                        <label>@lang('site.Residencess')</label>--}}
                                {{--                                        <input type="text" name="Residence" class="form-control"--}}
                                {{--                                               value="{{$salaryweges->Residence ?? ''}}"
                                readonly >--}}
                                {{--                                    </div>--}}
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.Other deductions')</label>
                                    <input type="text" name="reconnaissance" class="form-control"
                                        value="{{$salaryweges->reconnaissance ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">


                                    <label> @lang('site.Add more cuts') </label>
                                    <input type="text" name="Addmoredeductions" class="form-control"
                                        value="{{$salaryweges->Addmoredeductions ?? ''}}" readonly>
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">


                                    <label> @lang('site.outofhours') </label>
                                    <input type="text" name="outofwork" class="form-control"
                                        value="{{$salaryweges->outofwork ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">


                                    <label> @lang('site.Otherdues')</label>
                                    <input type="text" name="merits" class="form-control"
                                        value="{{$salaryweges->merits ?? ''}}" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label> @lang('site.Addthewantedfromthedues')</label>
                                    <input type="text" name="aspirantdues" class="form-control"
                                        value="{{$salaryweges->aspirantdues ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">


                                    <label> @lang('site.total_salary')</label>
                                    <input type="text" name="total_salary" class="form-control"
                                        value="{{$salaryweges->total_salary ?? ''}}" readonly>
                                </div>




                            </div>
                            <hr>
                            <h4 class="card-title">بدلات</h4>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.variable_transportation')</label>
                                    <input type="text" name="variable_transportation" class="form-control"
                                        value="{{$salaryweges->variable_transportation ?? ''}}"
                                        id="variable_transportation" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.other_allowance')</label>
                                    <input type="text" name="other_allowance" class="form-control"
                                        value="{{$salaryweges->other_allowance ?? ''}}" id="other_allowance" readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.fixed_transportation')</label>
                                    <input type="text" name="fixed_transportation" class="form-control"
                                        value="{{$salaryweges->fixed_transportation ?? ''}}" id="fixed_transportation"
                                        readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.incentives')</label>
                                    <input type="text" name="incentives" class="form-control"
                                        value="{{$salaryweges->incentives ?? ''}}" id="incentives" readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.variablefood_allowance')</label>
                                    <input type="text" name="variablefood_allowance" class="form-control"
                                        value="{{$salaryweges->variablefood_allowance ?? ''}}"
                                        id="variablefood_allowance" readonly>
                                </div>
                                {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}

                                {{--                                            <label>@lang('site.variable_overtime')</label>--}}
                                {{--                                            <input type="text" name="variable_overtime" class="form-control"--}}
                                {{--                                                   value="{{$salaryweges->variable_overtime ?? ''}}"
                                readonly>--}}
                                {{--                                        </div>--}}


                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.delay')</label>
                                    <input type="text" name="delay" class="form-control"
                                        value="{{$salaryweges->delay ?? ''}}" id="delay" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.absence')</label>
                                    <input type="text" name="absence" class="form-control"
                                        value="{{$salaryweges->absence ?? ''}}" id="absence" readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.gross_salary')</label>
                                    <input type="text" name="gross_salary" class="form-control"
                                        value="{{$salaryweges->gross_salary ?? ''}}" id="gross_salary" readonly>
                                </div>
                                {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}

                                {{--                                            <label>@lang('site.other_dedutions')</label>--}}
                                {{--                                            <input type="text" name="other_dedutions" class="form-control"--}}
                                {{--                                                   value="{{$salaryweges->other_dedutions ?? ''}}"
                                readonly>--}}
                                {{--                                        </div>--}}


                            </div>

                            <hr>
                            <h4 class="card-title"> العمل الاضافي</h4>

                            {{--                                    <div class="row">--}}
                            {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}


                            {{--                                            <label>@lang('site.unpaid_leave')</label>--}}
                            {{--                                            <input type="text" name="unpaid_leave" class="form-control"--}}
                            {{--                                                   value="{{$salaryweges->unpaid_leave ?? ''}}"
                            readonly>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}

                            {{--                                            <label>@lang('site.penalty')</label>--}}
                            {{--                                            <input type="text" name="penalty" class="form-control"--}}
                            {{--                                                   value="{{$salaryweges->penalty ?? ''}}"
                            readonly>--}}
                            {{--                                        </div>--}}


                            {{--                                    </div>--}}


                            <div class="row">


                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.total_dedction1')</label>
                                    <input type="text" name="total_dedction1" class="form-control" id="total_dedction1"
                                        value="{{$salaryweges->total_dedction1 ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.social_insurance')</label>
                                    <input type="text" name="social_insurance" class="form-control"
                                        value="{{$salaryweges->social_insurance ?? ''}}" id="social_insurance" readonly>
                                </div>


                            </div>
                            <div class="row">


                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.annualtaxable_salary')</label>
                                    <input type="text" name="annualtaxable_salary" class="form-control"
                                        value="{{$salaryweges->annualtaxable_salary ?? ''}}" id="annualtaxable_salary"
                                        readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.totalgross_salary')</label>
                                    <input type="text" name="totalgross_salary" class="form-control"
                                        value="{{$salaryweges->totalgross_salary ?? ''}}" id="totalgross_salary"
                                        readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.taxable_salary')</label>
                                    <input type="text" name="taxable_salary" class="form-control"
                                        value="{{$salaryweges->taxable_salary ?? ''}}" id="taxable_salary" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.monthly_taxes')</label>
                                    <input type="text" name="monthly_taxes" class="form-control"
                                        value="{{$salaryweges->monthly_taxes ?? ''}}" id="monthly_taxes" readonly>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.employee_socialinsurance')</label>
                                    <input type="text" name="employee_socialinsurance" class="form-control"
                                        value="{{$salaryweges->employee_socialinsurance ?? ''}}"
                                        id="employee_socialinsurance" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.id_number')</label>
                                    <input type="text" name="id_number" class="form-control"
                                        value="{{$salaryweges->id_number ?? ''}}" id="id_number" readonly>
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.net_income')</label>
                                    <input type="text" name="net_income" class="form-control"
                                        value="{{$salaryweges->net_income ?? ''}}" id="net_income" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.penalty')</label>
                                    <input type="text" name="penalty" class="form-control"
                                        value="{{$salaryweges->penalty ?? ''}}" id="totalsalaries" readonly>
                                </div>


                            </div>



                            <hr>

                            <h4 class="card-title">الخصومات</h4>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.annual_taxes')</label>
                                    <input type="text" name="annual_taxes" class="form-control"
                                        value="{{$salaryweges->annual_taxes ?? ''}}" id="annual_taxes" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.premium_card')</label>
                                    <input type="text" name="premium_card" class="form-control"
                                        value="{{$salaryweges->premium_card ?? ''}}" id="premium_card" readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.mobile_invoice')</label>
                                    <input type="text" name="mobile_invoice" class="form-control"
                                        value="{{$salaryweges->mobile_invoice ?? ''}}" id="mobile_invoice" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.familymedical_insurance')</label>
                                    <input type="text" name="familymedical_insurance" class="form-control"
                                        value="{{$salaryweges->familymedical_insurance ?? ''}}"
                                        id="familymedical_insurance" readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.total_deductions')</label>
                                    <input type="text" name="total_deductions" class="form-control"
                                        value="{{$salaryweges->total_deductions ?? ''}}" id="total_deductions" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.loan')</label>
                                    <input type="text" name="loan" class="form-control"
                                        value="{{$salaryweges->loan ?? ''}}" id="loan" readonly>
                                </div>


                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.otherdeductions')</label>
                                    <input type="text" name="otherdeductions" class="form-control"
                                        value="{{$salaryweges->otherdeductions ?? ''}}" id="otherdeductions" readonly>
                                </div>



                            </div>
                            <hr>

                            <h4 class="card-title">

                                التأمينات الاجتماعية
                            </h4>

                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.finalnet_income')</label>
                                    <input type="text" name="finalnet_income" class="form-control"
                                        value="{{$salaryweges->finalnet_income ?? ''}}" id="finalnet_income" readonly>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.other_allowance2')</label>
                                    <input type="text" name="other_allowance2" class="form-control"
                                        value="{{$salaryweges->other_allowance2 ?? ''}}" id="other_allowance2" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.account_number')</label>
                                    <input type="text" name="account_number" class="form-control"
                                        value="{{$salaryweges->account_number ?? ''}}" id="account_number" readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.pay')</label>
                                    <input type="text" name="pay" class="form-control"
                                        value="{{$salaryweges->pay ?? ''}}" id="pay" readonly>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.totalsocial_insurance')</label>
                                    <input type="text" name="totalsocial_insurance" class="form-control"
                                        value="{{$salaryweges->totalsocial_insurance ?? ''}}" id="totalsocial_insurance"
                                        readonly>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.unpaid_leave')</label>
                                    <input type="text" name="unpaid_leave" class="form-control"
                                        value="{{$salaryweges->unpaid_leave ?? ''}}" readonly>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.other_dedutions')</label>
                                    <input type="text" name="other_dedutions" class="form-control"
                                        value="{{$salaryweges->other_dedutions ?? ''}}" readonly>
                                </div>
                            </div>


                            {{--                                    <div class="row">--}}
                            {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}


                            {{--                                            <label>@lang('site.email')</label>--}}
                            {{--                                            <input type="text" name="email" class="form-control"--}}
                            {{--                                                   value="{{$salaryweges->email ?? ''}}">--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}

                            {{--                                            <label>@lang('site.id_number')</label>--}}
                            {{--                                            <input type="text" name="id_number" class="form-control"--}}
                            {{--                                                   value="{{$salaryweges->id_number ?? ''}}">--}}
                            {{--                                        </div>--}}


                            {{--                                    </div>--}}
                            {{--                            </form>--}}
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