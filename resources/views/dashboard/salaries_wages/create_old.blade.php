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
                            <li class="breadcrumb-item active"> @lang('site.add')</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.salaries_wages')</h4>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.salaries_wages.store') }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.add') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i> -->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-plus"></i>
                                        @lang('site.add')</button>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <h4 class="card-title">@lang('site.salaries_wages')</h4>
                            @include('partials._errors')


                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.employee')</label>
                                    <select class="form-control" name="employee_id">
                                        <option selected> @lang('site.select')</option>
                                        @foreach(\App\User::get() as $user)
                                        <option value="{{$user->id}}"> {{$user->full_name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.hiring_date')</label>
                                    <input type="date" name="hiring_date" class="form-control"
                                        value="{{ old('hiring_date') }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.basic_salary')</label>
                                    <input type="text" name="basic_salary" class="form-control"
                                        value="{{ old('basic_salary') }}">
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.variable_transportation')</label>
                                    <input type="text" name="variable_transportation" class="form-control"
                                        value="{{ old('variable_transportation') }}" id="variable_transportation">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.other_allowance')</label>
                                    <input type="text" name="other_allowance" class="form-control"
                                        value="{{ old('other_allowance') }}" id="other_allowance">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.fixed_transportation')</label>
                                    <input type="text" name="fixed_transportation" class="form-control"
                                        value="{{ old('fixed_transportation') }}" id="fixed_transportation">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.incentives')</label>
                                    <input type="text" name="incentives" class="form-control"
                                        value="{{ old('incentives') }}" id="incentives">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.variablefood_allowance')</label>
                                    <input type="text" name="variablefood_allowance" class="form-control"
                                        value="{{ old('variablefood_allowance') }}" id="variablefood_allowance">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.variable_overtime')</label>
                                    <input type="text" name="variable_overtime" class="form-control"
                                        value="{{ old('variable_overtime') }}">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.delay')</label>
                                    <input type="text" name="delay" class="form-control" value="{{ old('delay') }}"
                                        id="delay">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.absence')</label>
                                    <input type="text" name="absence" class="form-control" value="{{ old('absence') }}"
                                        id="absence">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.gross_salary')</label>
                                    <input type="text" name="gross_salary" class="form-control"
                                        value="{{ old('gross_salary') }}" id="gross_salary">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.other_dedutions')</label>
                                    <input type="text" name="other_dedutions" class="form-control"
                                        value="{{ old('other_dedutions') }}">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.unpaid_leave')</label>
                                    <input type="text" name="unpaid_leave" class="form-control"
                                        value="{{ old('unpaid_leave') }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.penalty')</label>
                                    <input type="text" name="penalty" class="form-control" value="{{ old('penalty') }}">
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.social_insurance')</label>
                                    <input type="text" name="social_insurance" class="form-control"
                                        value="{{ old('social_insurance') }}">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.totalgross_salary')</label>
                                    <input type="text" name="totalgross_salary" class="form-control"
                                        value="{{ old('totalgross_salary') }}">
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.total_dedction1')</label>
                                    <input type="text" name="total_dedction1" class="form-control"
                                        value="{{ old('total_dedction1') }}" id="total_dedction1">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.annualtaxable_salary')</label>
                                    <input type="text" name="annualtaxable_salary" class="form-control"
                                        value="{{ old('annualtaxable_salary') }}" id="annualtaxable_salary">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.taxable_salary')</label>
                                    <input type="text" name="taxable_salary" class="form-control"
                                        value="{{ old('taxable_salary') }}" id="taxable_salary">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.employee_socialinsurance')</label>
                                    <input type="text" name="employee_socialinsurance" class="form-control"
                                        value="{{ old('employee_socialinsurance') }}" id="employee_socialinsurance">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.net_income')</label>
                                    <input type="text" name="net_income" class="form-control"
                                        value="{{ old('net_income') }}" id="net_income">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.monthly_taxes')</label>
                                    <input type="text" name="monthly_taxes" class="form-control"
                                        value="{{ old('monthly_taxes') }}" id="monthly_taxes">
                                </div>


                            </div>

                            <hr>

                            <h3>الخصومات</h3>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.annual_taxes')</label>
                                    <input type="text" name="annual_taxes" class="form-control"
                                        value="{{ old('annual_taxes') }}" id="annual_taxes">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.premium_card')</label>
                                    <input type="text" name="premium_card" class="form-control"
                                        value="{{ old('premium_card') }}" id="premium_card">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.mobile_invoice')</label>
                                    <input type="text" name="mobile_invoice" class="form-control"
                                        value="{{ old('mobile_invoice') }}" id="mobile_invoice">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.familymedical_insurance')</label>
                                    <input type="text" name="familymedical_insurance" class="form-control"
                                        value="{{ old('familymedical_insurance') }}" id="familymedical_insurance">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.total_deductions')</label>
                                    <input type="text" name="total_deductions" class="form-control"
                                        value="{{ old('total_deductions') }}" id="total_deductions">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.loan')</label>
                                    <input type="text" name="loan" class="form-control" value="{{ old('loan') }}"
                                        id="loan">
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.otherdeductions')</label>
                                    <input type="text" name="otherdeductions" class="form-control"
                                        value="{{ old('otherdeductions') }}" id="otherdeductions">
                                </div>
                            </div>

                            <hr>

                            <h3>

                                التأمينات الاجتماعية
                            </h3>
                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.finalnet_income')</label>
                                    <input type="text" name="finalnet_income" class="form-control"
                                        value="{{ old('finalnet_income') }}" id="finalnet_income">

                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.other_allowance2')</label>
                                    <input type="text" name="other_allowance2" class="form-control"
                                        value="{{ old('other_allowance2') }}" id="other_allowance2">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.account_number')</label>
                                    <input type="text" name="account_number" class="form-control"
                                        value="{{ old('account_number') }}" id="account_number">
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.pay')</label>
                                    <input type="text" name="pay" class="form-control" value="{{ old('pay') }}"
                                        id="pay">
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">

                                    <label>@lang('site.totalsocial_insurance')</label>
                                    <input type="text" name="totalsocial_insurance" class="form-control"
                                        value="{{ old('totalsocial_insurance') }}" id="totalsocial_insurance">
                                </div>


                            </div>

                            <hr>

                            {{--                                    <div class="row">--}}
                            {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}


                            {{--                                            <label>@lang('site.email')</label>--}}
                            {{--                                            <input type="text" name="email" class="form-control"--}}
                            {{--                                                   value="{{ old('email') }}">--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-6 form-group col-12 p-2">--}}

                            {{--                                            <label>@lang('site.id_number')</label>--}}
                            {{--                                            <input type="text" name="id_number" class="form-control"--}}
                            {{--                                                   value="{{ old('id_number') }}">--}}
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
</div>




@endsection
@section('scripts')

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
</script>


<script>
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

    jQuery('input#net_income').val(Number(subtotals));

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


    var otherdeductions = Number(monthly_taxes) + Number(subtotals);

    jQuery('input#otherdeductions').val(otherdeductions);


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