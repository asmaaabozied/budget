<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Google2FAController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('forget-password', function () {
//    return view('auth.forgetPassword');
//})->name('forget.password');
//
///
///




Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', function () {
    return view('website.index');
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    app()->setLocale($locale);
    //dd(app()->getLocale());
    return redirect()->back();
})->name('switchLan');  //add name to router
Route::get('/logins', function () {
    return view('website.login');
})->name('logins');

Route::get('/registers', function () {
    return view('website.register');
})->name('registers');




Route::get('/about_us', function () {
    return view('website.about_us');
})->name('about_us');

Route::prefix(LaravelLocalization::setLocale())->middleware('localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
    Auth::routes(['register' => true]);
    Route::get('forget-password-new', function () {
        return view('auth.forgetPassword');
    })->name('forget.password.new');
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
        //user routes
    });
});

Route::middleware('web')->group(function () {
    Route::get('/2fa/enable/{id}', [Google2FAController::class, 'enableTwoFactor'])->name('2fa.enable');
    Route::get('/2fa/disable', [Google2FAController::class, 'disableTwoFactor'])->name('2fa.disable');
    Route::get('/2fa/validate', [TwoFactorController::class, 'getValidateToken']);
    Route::post('/2fa/validate', [TwoFactorController::class, 'postValidateToken'])->middleware('throttle:5');
});
