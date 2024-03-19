<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankAddressController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BankPolicyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->intended('/dashboard');
    }

    return view('auth/login');
});

Auth::routes();

Route::get('registration', [AgencyController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AgencyController::class, 'customRegistration'])->name('register.custom');

Route::post('resetpassword', [ResetPasswordController::class, 'resetPass'])->name('resetpassword.resetPass');
Route::get('password/reset/{email}/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset']);

Route::group(['middleware' => 'auth:web'], function ($router) {

    Route::resource('dashboard', DashboardController::class);

    Route::post('/select-banks', [BankController::class, 'selectBank']);
    Route::get('/banks/search', [BankController::class,'search'])->name('banks.search');
    Route::get('/banks/list', [BankController::class, 'list'])->name('banks.list');
    Route::resource('banks', BankController::class);

    Route::get('/address-book/search', [BankAddressController::class,'search'])->name('addressbook.search');
    Route::get('/addressbook/list', [BankAddressController::class, 'list'])->name('addressbook.list');
    Route::resource('addressbook', BankAddressController::class);

    Route::get('/loans/search', [LoanController::class,'search'])->name('loans.search');
    Route::get('/loans/list', [LoanController::class, 'list'])->name('loans.list');
    Route::resource('loans', LoanController::class);

    Route::get('/category/search', [CategoryController::class,'search'])->name('category.search');
    Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
    Route::resource('category', CategoryController::class);

    Route::get('/parameter/search', [ParameterController::class,'search'])->name('parameter.search');
    Route::get('/parameter/list', [ParameterController::class, 'list'])->name('parameter.list');
    Route::resource('parameter', ParameterController::class);

    Route::get('/policies/search', [BankPolicyController::class,'search'])->name('policies.search');
    Route::get('/policies/list', [BankPolicyController::class, 'list'])->name('policies.list');
    Route::resource('policies', BankPolicyController::class);

    Route::get('/documents/search', [DocumentController::class,'search'])->name('documents.search');
    Route::get('/documents/list', [DocumentController::class, 'list'])->name('documents.list');
    Route::resource('documents', DocumentController::class);

    Route::get('/agencies/search', [AgencyController::class,'search'])->name('agencies.search');
    Route::get('/agencies/list', [AgencyController::class, 'list'])->name('agencies.list');
    Route::resource('agencies', AgencyController::class);

    Route::get('/agents/search', [AgentController::class,'search'])->name('agents.search');
    Route::get('/agents/list', [AgentController::class, 'list'])->name('agents.list');
    Route::resource('agents', AgentController::class);

    Route::get('/customers/search', [CustomerController::class,'search'])->name('customers.search');
    Route::get('/customers/list', [CustomerController::class, 'list'])->name('customers.list');
    Route::resource('customers', CustomerController::class);

    

    Route::post('/upload-media', [MediaController::class, 'uploadMedia'])->name('upload.media');

    Route::resource('import', ImportDataController::class);

});
