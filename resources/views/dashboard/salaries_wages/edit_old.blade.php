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
                                            <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                                    class="fa fa-plus"></i>
                                                @lang('site.edit')</button>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-body">
                                <!--<h4 class="card-title">@lang('site.salaries_wages')</h4>-->
                                    @include('partials._errors')


                                    <div class="row">


                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee')</label>
                                            <select class="form-control" name="employee_id">
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
                                                   value="{{$salaryweges->hiring_date ?? ''}}">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.basic_salary')</label>
                                            <input type="text" name="basic_salary" class="form-control"
                                                   value="{{$salaryweges->basic_salary ?? ''}}">
                                        </div>



                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.variable_transportation')</label>
                                            <input type="text" name="variable_transportation" class="form-control"
                                                   value="{{$salaryweges->variable_transportation ?? ''}}"   id="variable_transportation">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.other_allowance')</label>
                                            <input type="text" name="other_allowance" class="form-control"
                                                   value="{{$salaryweges->other_allowance ?? ''}}"   id="other_allowance">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.fixed_transportation')</label>
                                            <input type="text" name="fixed_transportation" class="form-control"
                                                   value="{{$salaryweges->fixed_transportation ?? ''}}"  id="fixed_transportation">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.incentives')</label>
                                            <input type="text" name="incentives" class="form-control"
                                                   value="{{$salaryweges->incentives ?? ''}}"  id="incentives">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.variablefood_allowance')</label>
                                            <input type="text" name="variablefood_allowance" class="form-control"
                                                   value="{{$salaryweges->variablefood_allowance ?? ''}}"  id="variablefood_allowance">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.variable_overtime')</label>
                                            <input type="text" name="variable_overtime" class="form-control"
                                                   value="{{$salaryweges->variable_overtime ?? ''}}">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.delay')</label>
                                            <input type="text" name="delay" class="form-control"
                                                   value="{{$salaryweges->delay ?? ''}}"   id="delay">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.absence')</label>
                                            <input type="text" name="absence" class="form-control"
                                                   value="{{$salaryweges->absence ?? ''}}"   id="absence">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.gross_salary')</label>
                                            <input type="text" name="gross_salary" class="form-control"
                                                   value="{{$salaryweges->gross_salary ?? ''}}"   id="gross_salary">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.other_dedutions')</label>
                                            <input type="text" name="other_dedutions" class="form-control"
                                                   value="{{$salaryweges->other_dedutions ?? ''}}">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.unpaid_leave')</label>
                                            <input type="text" name="unpaid_leave" class="form-control"
                                                   value="{{$salaryweges->unpaid_leave ?? ''}}">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.penalty')</label>
                                            <input type="text" name="penalty" class="form-control"
                                                   value="{{$salaryweges->penalty ?? ''}}">
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.social_insurance')</label>
                                            <input type="text" name="social_insurance" class="form-control"
                                                   value="{{$salaryweges->social_insurance ?? ''}}">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.totalgross_salary')</label>
                                            <input type="text" name="totalgross_salary" class="form-control"
                                                   value="{{$salaryweges->totalgross_salary ?? ''}}">
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.total_dedction1')</label>
                                            <input type="text" name="total_dedction1" class="form-control"
                                                   value="{{$salaryweges->total_dedction1 ?? ''}}"  id="total_dedction1">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.annualtaxable_salary')</label>
                                            <input type="text" name="annualtaxable_salary" class="form-control"
                                                   value="{{$salaryweges->annualtaxable_salary ?? ''}}"   id="annualtaxable_salary">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.taxable_salary')</label>
                                            <input type="text" name="taxable_salary" class="form-control"
                                                   value="{{$salaryweges->taxable_salary ?? ''}}"  id="taxable_salary">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.employee_socialinsurance')</label>
                                            <input type="text" name="employee_socialinsurance" class="form-control"
                                                   value="{{$salaryweges->employee_socialinsurance ?? ''}}"   id="employee_socialinsurance">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.net_income')</label>
                                            <input type="text" name="net_income" class="form-control"
                                                   value="{{$salaryweges->net_income ?? ''}}"  id="net_income">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.monthly_taxes')</label>
                                            <input type="text" name="monthly_taxes" class="form-control"
                                                   value="{{$salaryweges->monthly_taxes ?? ''}}"  id="monthly_taxes">
                                        </div>


                                    </div>
                                    <hr>

                                    <h3>الخصومات</h3>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.annual_taxes')</label>
                                            <input type="text" name="annual_taxes" class="form-control"
                                                   value="{{$salaryweges->annual_taxes ?? ''}}"  id="annual_taxes">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.premium_card')</label>
                                            <input type="text" name="premium_card" class="form-control"
                                                   value="{{$salaryweges->premium_card ?? ''}}"  id="premium_card">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.mobile_invoice')</label>
                                            <input type="text" name="mobile_invoice" class="form-control"
                                                   value="{{$salaryweges->mobile_invoice ?? ''}}"  id="mobile_invoice">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.familymedical_insurance')</label>
                                            <input type="text" name="familymedical_insurance" class="form-control"
                                                   value="{{$salaryweges->familymedical_insurance ?? ''}}" id="familymedical_insurance">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.total_deductions')</label>
                                            <input type="text" name="total_deductions" class="form-control"
                                                   value="{{$salaryweges->total_deductions ?? ''}}"  id="total_deductions">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.loan')</label>
                                            <input type="text" name="loan" class="form-control"
                                                   value="{{$salaryweges->loan ?? ''}}"  id="loan">
                                        </div>


                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.otherdeductions')</label>
                                            <input type="text" name="otherdeductions" class="form-control"
                                                   value="{{$salaryweges->otherdeductions ?? ''}}"  id="otherdeductions">
                                        </div>



                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.finalnet_income')</label>
                                            <input type="text" name="finalnet_income" class="form-control"
                                                   value="{{$salaryweges->finalnet_income ?? ''}}" id="finalnet_income">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.other_allowance2')</label>
                                            <input type="text" name="other_allowance2" class="form-control"
                                                   value="{{$salaryweges->other_allowance2 ?? ''}}" id="other_allowance2">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.account_number')</label>
                                            <input type="text" name="account_number" class="form-control"
                                                   value="{{$salaryweges->account_number ?? ''}}" id="account_number">
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group col-12 p-2">


                                            <label>@lang('site.pay')</label>
                                            <input type="text" name="pay" class="form-control"
                                                   value="{{$salaryweges->pay ?? ''}}" id="pay">
                                        </div>
                                        <div class="col-md-6 form-group col-12 p-2">

                                            <label>@lang('site.totalsocial_insurance')</label>
                                            <input type="text" name="totalsocial_insurance" class="form-control"
                                                   value="{{$salaryweges->totalsocial_insurance ?? ''}}" id="totalsocial_insurance">
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

@section('scripts')

    <script>


        jQuery('input#incentives').change(function () {
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

            var subtotals =Number(variabletransportation)+Number(otherallowance)+Number(fixedtransportation)+Number(incentives);


            console.log('subtotals', subtotals)

            // console.log('total', total)
            // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

            jQuery('input#variablefood_allowance').val(Number(subtotals));

        });
    </script>


    <script>


        jQuery('input#absence').change(function () {
            console.log("fdsdf");
            var delay = jQuery('input#delay').val();
            console.log('delay', delay)
            var absence = jQuery('input#absence').val();
            console.log('absence', absence)



            var subtotals =Number(delay)+Number(absence);


            console.log('subtotals', subtotals)

            // console.log('total', total)
            // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

            jQuery('input#gross_salary').val(Number(subtotals));

        });
    </script>

    <script>


        jQuery('input#employee_socialinsurance').change(function () {
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

            var subtotals =Number(total_dedction1)+Number(annualtaxable_salary)+Number(taxable_salary)+Number(taxable_salary);


            console.log('subtotals', subtotals)

            // console.log('total', total)
            // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

            jQuery('input#net_income').val(Number(subtotals));

        });
    </script>


    <script>


        jQuery('input#employee_socialinsurance').change(function () {
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

            var subtotals =Number(net_income)+Number(gross_salary)+Number(variablefood_allowance);


            console.log('subtotals', subtotals)

            // console.log('total', total)
            // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

            jQuery('input#monthly_taxes').val(Number(subtotals));

        });
    </script>
    <script>


        jQuery('input#total_deductions').change(function () {
            console.log("fdsdf");
            var annual_taxes = jQuery('input#annual_taxes').val();
            console.log('annual_taxes', annual_taxes)
            var premium_card = jQuery('input#premium_card').val();
            console.log('premium_card', premium_card)

            var loan = jQuery('input#loan').val();
            console.log('loan', loan)



            var mobile_invoice = jQuery('input#mobile_invoice').val();
            console.log('mobile_invoice', mobile_invoice)


            var familymedical_insurance = jQuery('input#familymedical_insurance').val();
            console.log('familymedical_insurance', familymedical_insurance)


            var total_deductions = jQuery('input#total_deductions').val();
            console.log('total_deductions', total_deductions)


            // var subtotal = total - (total * (discount / 100))

            var subtotals =Number(premium_card)+Number(annual_taxes)+Number(familymedical_insurance)+Number(total_deductions)+Number(mobile_invoice)


            console.log('subtotals', subtotals)

            // console.log('total', total)
            // jQuery('input#salary_total').val(Number(subtotal) + Number(allowance));

            var monthly_taxes = jQuery('input#monthly_taxes').val();
            console.log('monthly_taxes', monthly_taxes)

            jQuery('input#loan').val(Number(subtotals));


            var otherdeductions =Number(monthly_taxes)+Number(subtotals);

            jQuery('input#otherdeductions').val(otherdeductions);



        });
    </script>


    <script>


        jQuery('input#finalnet_income').change(function () {
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
