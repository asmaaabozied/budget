<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>

        {{$employee->name ?? ''}}

        {{$employee->father_name ?? ''}}


        {{$employee->family_name ?? ''}}</h1>
    <p>{{$employee->job ?? ''}}</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.hiring_date'):</h3>
            <p class="mdr">{{$salaryweges->hiring_date ?? ''}}</p>

        </div>

        <div class="col-lg-4">
            <h3>@lang('site.transfer_month'):</h3>
            <p class="mdr">{{$salaryweges->transfer_month ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.employee_end') :</h3>
            <p class="mdr">{{$employee->employee_end ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.quality')</h3>
            <p class="mdr">{{$employee->quality ?? ''}}  </p>


        </div>

        <div class="col-lg-4">
            <h3>@lang('site.hoppy'):</h3>
            <p class="mdr">{{$employee->hoppy ?? ''}}</p>

        </div>

        <div class="col-lg-4">
            <h3>@lang('site.national') :</h3>
            <p class="mdr">{{$employee->national ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.Religion')</h3>
            <p class="mdr">{{$employee->Religion ?? ''}}  </p>


        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.Contract_expiry_date'):</h3>
            <p class="mdr">{{$employee->Contract_expiry_date ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.countrys') :</h3>
            <p class="mdr">{{$employee->country ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.job_term')</h3>
            <p class="mdr">{{$employee->job_term ?? ''}}  </p>


        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.basic_salary'):</h3>
            <p class="mdr">{{$salaryweges->basic_salary ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.Absencess') :</h3>
            <p class="mdr">{{$salaryweges->absance ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.Social insurance deduction')</h3>
            <p class="mdr">{{$salaryweges->Socialinsurancediscount ?? ''}}  </p>


        </div>


        <div class="col-lg-4">
            <h3>@lang('site.Other deductions')</h3>
            <p class="mdr">{{$salaryweges->reconnaissance ?? ''}}  </p>


        </div>


        <div class="col-lg-4">
            <h3>@lang('site.Otherdues')</h3>
            <p class="mdr">{{$salaryweges->outofwork ?? ''}}  </p>


        </div>

        <div class="col-lg-4">
            <h3>@lang('site.outofhours')</h3>
            <p class="mdr">{{$salaryweges->merits ?? ''}}  </p>


        </div>


        <div class="col-lg-4">
            <h3>@lang('site.Addthewantedfromthedues')</h3>
            <p class="mdr">{{$salaryweges->aspirantdues ?? ''}}  </p>


        </div>


        <div class="col-lg-4">
            <h3>@lang('site.total_salary')</h3>
            <p class="mdr">{{$salaryweges->total_salary ?? ''}}  </p>


        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.vacations_balance'):</h3>
            <p class="mdr">{{$employee->vacations_balance ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.Indemnity') :</h3>
            <p class="mdr">{{$employee->Indemnity ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.hours')</h3>
            <p class="mdr">{{$employee->hours ?? ''}}  </p>


        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.yearly'):</h3>
            <p class="mdr">{{$employee->yearly ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.employee_start') :</h3>
            <p class="mdr">{{$employee->employee_start ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.employee_end')</h3>
            <p class="mdr">{{$employee->employee_end ?? ''}}  </p>


        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.currency'):</h3>
            <p class="mdr">{{$employee->currency ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.birthday') :</h3>
            <p class="mdr">{{$employee->birthday ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.description')</h3>
            <p class="mdr">{{$employee->descriptions ?? ''}}  </p>


        </div>
    </div>


</div>

</body>
</html>
