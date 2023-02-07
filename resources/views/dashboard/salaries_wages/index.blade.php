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
                            <li class="breadcrumb-item active"> @lang('site.addSalary') </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.salaries_wages')</h4>
                </div>
            </div>



            <!-- Individual column searching (text inputs) Starts-->

            <div class="card">


                <div class="card-body">

                    <h4 class="card-title">برجاء تحديد شهر الراتب للبدء بعمليه تحويل الراتب</h4>
                    <form action="{{ route('dashboard.salaries_wages_data.create') }}" method="get"
                        enctype="multipart/form-data">



                        <div class="row">




                            <div class="col-md-6 form-group col-12 p-2">
                                <label>@lang('site.hiring_date')</label>
                                <input type="date" name="startDate" id="startDate" class="date-picker form-control"
                                    required />
                            </div>

                            <div class="col-md-6 form-group col-12 p-2">
                                <br>

                                <button type="submit" class="btn-primary btn">@lang('site.search')</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

            <!-- Individual column searching (text inputs) Ends-->

        </div>
        <!-- Container-fluid Ends-->
    </div>

</div>
</div>


@endsection
@section('scripts')







<script>
$(function() {
    $('.date-picker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm yy',
        onClose: function(dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth,
                1));
        }
    });
});

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

    var subtotals = Number(variabletransportation) + Number(otherallowance) + Number(
        fixedtransportation) + Number(incentives);


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


    var subtotals = Number(basic_salary) + Number(variablefood_allowance) + Number(gross_salary) +
        Number(net_income);


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

    var subtotals = Number(total_dedction1) + Number(annualtaxable_salary) + Number(taxable_salary) +
        Number(taxable_salary);


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

    var subtotals = Number(premium_card) + Number(annual_taxes) + Number(familymedical_insurance) +
        Number(total_deductions) + Number(mobile_invoice)


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


    var account_number = Number(finalnet_income) * (1875 / 100) * 100;


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