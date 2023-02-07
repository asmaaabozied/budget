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
            <h3>@lang('site.hoppy'):</h3>
            <p class="mdr">{{$employee->hoppy ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.employee_end') :</h3>
            <p class="mdr">{{$employee->employee_end ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.quality')</h3>
            <p class="mdr">{{$employee->quality ?? ''}}  </p>


        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.type1'):</h3>
            <p class="mdr">{{$employee->type1 ?? ''}}</p>

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
            <h3>@lang('site.phone'):</h3>
            <p class="mdr">{{$employee->phone ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.email') :</h3>
            <p class="mdr">{{$employee->email ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.Contract_start_date')</h3>
            <p class="mdr">{{$employee->Contract_start_date ?? ''}}  </p>


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
            <h3>@lang('site.Date_marriage'):</h3>
            <p class="mdr">{{$employee->Date_marriage ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.job') :</h3>
            <p class="mdr">{{$employee->job ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.degree_job')</h3>
            <p class="mdr">{{$employee->degree_job ?? ''}}  </p>


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

    <div class="row">
        <div class="col-lg-4">
            <h3>@lang('site.salary'):</h3>
            <p class="mdr">{{$employee->salary ?? ''}}</p>

        </div>
        <div class="col-lg-4">
            <h3>@lang('site.housing_allowance') :</h3>
            <p class="mdr">{{$employee->housing_allowance ?? ''}}  </p>
        </div>
        <div class="col-lg-4">
            <h3>@lang('site.allowance')</h3>
            <p class="mdr">{{$employee->allowance ?? ''}}  </p>

            <h3>@lang('site.salary_total')</h3>
            <p class="mdr">{{$employee->salary_total ?? ''}}  </p>


            <h3>@lang('site.total')</h3>
            <p class="mdr">{{$employee->total2 ?? ''}}  </p>

            <h3>@lang('site.hoppy_date1')</h3>
            <p class="mdr">{{$employee->hoppy_date1 ?? ''}}  </p>
            <h3>@lang('site.hoppy_date2')</h3>
            <p class="mdr">{{$employee->hoppy_date2 ?? ''}}  </p>
            <h3>@lang('site.hoppy_start_date1')</h3>
            <p class="mdr">{{$employee->hoppy_start_date1 ?? ''}}  </p>
            <h3>@lang('site.hoppy_date3')</h3>
            <p class="mdr">{{$employee->hoppy_date3 ?? ''}}  </p>
            <h3>@lang('site.hoppy_start_date3')</h3>
            <p class="mdr">{{$employee->hoppy_start_date3 ?? ''}}  </p>
            <h3>@lang('site.hoppy_date4')</h3>
            <p class="mdr">{{$employee->hoppy_date4 ?? ''}}  </p>
            <h3>@lang('site.hoppy_start_date4')</h3>
            <p class="mdr">{{$employee->hoppy_start_date4 ?? ''}}  </p>

            <h3>@lang('site.hoppy_date5')</h3>
            <p class="mdr">{{$employee->hoppy_date5 ?? ''}}  </p>
            <h3>@lang('site.hoppy_start_date5')</h3>
            <p class="mdr">{{$employee->hoppy_start_date5 ?? ''}}  </p>
            <h3>@lang('site.tax_numbers')</h3>
            <p class="mdr">{{$employee->tax_numbers ?? ''}}  </p>
            <h3>@lang('site.tax_type')</h3>
            <p class="mdr">{{$employee->tax_type ?? ''}}  </p>
            <h3>@lang('site.passport_number')</h3>
            <p class="mdr">{{$employee->passport_number ?? ''}}  </p>
            <h3>@lang('site.status_insure')</h3>
            <p class="mdr">{{$employee->status_insure ?? ''}}  </p>
            <h3>@lang('site.name_insure')</h3>
            <p class="mdr">{{$employee->name_insure ?? ''}}  </p>
            <h3>@lang('site.tax_type_date')</h3>
            <p class="mdr">{{$employee->tax_type_date ?? ''}}  </p>
            <h3>@lang('site.status_insure_date')</h3>
            <p class="mdr">{{$employee->status_insure_date ?? ''}}  </p>
            <h3>@lang('site.date4')</h3>
            <p class="mdr">{{$employee->date4 ?? ''}}  </p>

            <h3>@lang('site.salary')</h3>
            <p class="mdr">{{$employee->salary ?? ''}}  </p>
            <h3>@lang('site.Transportation_allowances')</h3>
            <p class="mdr">{{$employee->Transportation_allowances ?? ''}}  </p>
            <h3>@lang('site.bank_name')</h3>
            <p class="mdr">{{$employee->bank_name ?? ''}}  </p>
            <h3>@lang('site.iban')</h3>
            <p class="mdr">{{$employee->iban ?? ''}}  </p>
            <h3>@lang('site.sick_leave')</h3>
            <p class="mdr">{{$employee->sick_leave ?? ''}}  </p>
            <h3>@lang('site.sustainable_covenant')</h3>
            <p class="mdr">{{$employee->sustainable_covenant ?? ''}}  </p>

            <h3>@lang('site.Haj_Vacation')</h3>
            <p class="mdr">{{$employee->Haj_Vacation ?? ''}}  </p>
            <h3>@lang('site.pregnancy_permit')</h3>
            <p class="mdr">{{$employee->pregnancy_permit ?? ''}}  </p>

            <h3>@lang('site.permission_marry')</h3>
            <p class="mdr">{{$employee->permission_marry ?? ''}}  </p>
            <h3>@lang('site.Opposition_leave')</h3>
            <p class="mdr">{{$employee->Opposition_leave ?? ''}}  </p>        <h3>@lang('site.Sick_leaves')</h3>
            <p class="mdr">{{$employee->Sick_leaves ?? ''}}  </p>


        </div>
    </div>
</div>

</body>
</html>
