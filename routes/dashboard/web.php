<?php

use App\Http\Controllers\Dashboard\AttendeController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\CurrencyController;
use App\Http\Controllers\Dashboard\DiscountController;
use App\Http\Controllers\Dashboard\EmployeController;
use App\Http\Controllers\Dashboard\LeaveController;
use App\Http\Controllers\Dashboard\LinkedController;
use App\Http\Controllers\Dashboard\LoanController;
use App\Http\Controllers\Dashboard\MessagerController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\PeriodController;
use App\Http\Controllers\Dashboard\RateController;
use App\Http\Controllers\Dashboard\RewardController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SalaryController;
use App\Http\Controllers\Dashboard\SalaryWegeController;
use App\Http\Controllers\Dashboard\SalaryWegeDataController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserReportController;

Route::prefix(LaravelLocalization::setLocale())->middleware('localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
        Route::get('/', [EmployeController::class, 'Receiptemployee'])->name('welcome');

        //user routes ->middleware(['2fa'])
        Route::resource('users', UserController::class);

        Route::get('users/block/{id}', [UserController::class, 'block'])->name('users.block');
        //roles
        Route::resource('roles', RoleController::class)->except(['show']);
        //logout
        Route::get('logout', [UserController::class, 'logout'])->name('logout');

        Route::post('chanagepassword', [EmployeController::class, 'chanagepassword'])->name('chanagepassword');
        Route::get('deleteDevice/{id}', [EmployeController::class, 'deleteDevice'])->name('deleteDevice');

        //branches
        Route::resource('branches', BranchController::class);
        //periods
        Route::resource('periods', PeriodController::class);

        //salaries_wages
        Route::resource('salaries_wages', SalaryWegeController::class);
        Route::resource('salaries_wages_data', SalaryWegeDataController::class);
        Route::get('salaries_wages_translation', [SalaryWegeDataController::class, 'salariesWagesTranslation'])->name('salaries_wages_translation');

        Route::get('salaryPdf/{id}', [SalaryWegeDataController::class, 'salaryPdf'])->name('salaryPdf');

        Route::get('images/delete/{id}', [EmployeController::class, 'deleteimages'])->name('deleteimages');

        //messagers
        Route::resource('messagers', MessagerController::class);
        Route::get('send', [MessagerController::class, 'send'])->name('send');

        //loans
        Route::resource('loans', LoanController::class);

        //discounts
        Route::resource('discounts', DiscountController::class);

        //Rewards
        Route::resource('rewards', RewardController::class);

        //countries
        Route::resource('countries', CountryController::class);

        //cities
        Route::resource('cities', CityController::class);

        //currencies
        Route::resource('currencies', CurrencyController::class);

        //categories
        Route::resource('categories', CategoryController::class);

        //employee
        Route::resource('employee', EmployeController::class);

        Route::get('ReportEmployee', [EmployeController::class, 'ReportEmployee'])->name('ReportEmployee');
        Route::get('printpdf/{id}', [EmployeController::class, 'printpdf'])->name('printpdf');

        Route::get('Receiptemployee', [EmployeController::class, 'Receiptemployee'])->name('Receiptemployee');
        Route::get('download/{file}', [EmployeController::class, 'download'])->name('download');

        //ratings
        Route::resource('ratings', RateController::class);
        Route::get('ReportRatings', [RateController::class, 'ReportRatings'])->name('ReportRatings');

        Route::resource('attendees', AttendeController::class);

        Route::resource('leaves', LeaveController::class);

        Route::resource('linkeds', LinkedController::class);

        Route::resource('salaries', SalaryController::class);

        Route::get('leaveAttendees', function () {
            return view('dashboard.leaveAttendees');
        })->name('leaveAttendees');

        Route::get('salarywedgesfirst', function () {
            return view('dashboard.salaries_wages.salarywedgesfirst');
        })->name('salarywedgesfirst');

        //pages
        Route::resource('pages', PageController::class);

        Route::get('pages/show/{id}', [PageController::class, 'show'])->name('pages.show');

        //reports
        Route::get('usersReports', [UserReportController::class, 'getReportUsers'])->name('usersReports');

        // notifications routes
        require_once __DIR__.'/notifications.php';
    }); //end of dashboard routes
});
