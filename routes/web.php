<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('menu/{id}', [App\Http\Controllers\HomeController::class, 'menu'])->name('menu');
Route::get('person', [App\Http\Controllers\HomeController::class, 'person'])->name('person');
Route::get('customer', [App\Http\Controllers\HomeController::class, 'customer'])->name('customer');
Route::get('users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('company', [App\Http\Controllers\HomeController::class, 'company'])->name('company');
Route::get('provider', [App\Http\Controllers\HomeController::class, 'provider'])->name('provider');
Route::get('accounting_financial', [App\Http\Controllers\HomeController::class, 'accountingFinancial'])->name('accounting_financial');





Route::prefix('user')->group(function () {

    Route::get('page/{id}', [UserController::class, 'userPage']);
    Route::post('save', [UserController::class, 'saveUser']);
});


Route::prefix('person')->group(function () {
    Route::get('form/{type}', [App\Http\Controllers\Person\PersonController::class, 'formPerson']);
    Route::post('save', [App\Http\Controllers\Person\PersonController::class, 'savePerson']);
    Route::post('save_customer_provider', [App\Http\Controllers\Person\PersonController::class, 'savePersonCustomerProvider'])->name('save_customer_provider');
    Route::get('edit/{id}', [App\Http\Controllers\Person\PersonController::class, 'editPerson']);
    Route::get('get/{id}', [App\Http\Controllers\Person\PersonController::class, 'getPerson']);
    Route::get('get', [App\Http\Controllers\Person\PersonController::class, 'getPerson']);
    Route::get('get_by_document/{document}', [App\Http\Controllers\Person\PersonController::class, 'getPersonByDocument']);
});


Route::prefix('customer')->group(function () {
    Route::get('form', [App\Http\Controllers\Customer\CustomerController::class, 'formCustomer']);
    Route::get('edit/{id}', [App\Http\Controllers\Customer\CustomerController::class, 'editCustomer']);
    Route::post('save', [App\Http\Controllers\Customer\CustomerController::class, 'saveCustomer']);
    Route::get('get/{id}', [App\Http\Controllers\Customer\CustomerController::class, 'getCustomer']);
    Route::get('get', [App\Http\Controllers\Customer\CustomerController::class, 'getCustomer']);
});

Route::prefix('provider')->group(function () {
    Route::get('form', [App\Http\Controllers\Provider\ProviderController::class, 'formProvider']);
    Route::get('edit/{id}', [App\Http\Controllers\Provider\ProviderController::class, 'editProvider']);
    Route::post('save', [App\Http\Controllers\Provider\ProviderController::class, 'saveProvider']);
    Route::get('get/{id}', [App\Http\Controllers\Provider\ProviderController::class, 'getProvider']);
    Route::get('get', [App\Http\Controllers\Provider\ProviderController::class, 'getProvider']);
});

Route::prefix('accounting_financial')->group(function () {
    Route::get('form', [App\Http\Controllers\AccountingFinancial\AccountingFinancialController::class, 'formAccountingFinancial']);
    Route::get('edit/{id}', [App\Http\Controllers\AccountingFinancial\AccountingFinancialController::class, 'editAccountingFinancial']);
    Route::post('save', [App\Http\Controllers\AccountingFinancial\AccountingFinancialController::class, 'saveAccountingFinancial']);
    Route::get('get/{id}', [App\Http\Controllers\AccountingFinancial\AccountingFinancialController::class, 'getAccountingFinancial']);
    Route::get('get', [App\Http\Controllers\AccountingFinancial\AccountingFinancialController::class, 'getAccountingFinancial']);

    Route::prefix('import')->group(function () {
        Route::get('/', [App\Http\Controllers\AccountingFinancial\ImportAccountingFinancialController::class, 'importAccounting']);
        Route::post('save', [App\Http\Controllers\AccountingFinancial\ImportAccountingFinancialController::class, 'saveImportFile']);
    });

});



Route::prefix('company')->group(function () {
    Route::post('save', [App\Http\Controllers\Company\CompanyController::class, 'saveCompany']);
    Route::get('get/{id}', [App\Http\Controllers\Company\CompanyController::class, 'getCompany']);
});
