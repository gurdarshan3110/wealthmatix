<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\MrnController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ImportDataController;
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

Route::post('resetpassword', [ResetPasswordController::class, 'resetPass'])->name('resetpassword.resetPass');
Route::get('password/reset/{email}/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset']);

Route::group(['middleware' => 'auth:web'], function ($router) {

    Route::resource('dashboard', DashboardController::class);

    Route::post('/select-store', [StoreController::class, 'selectStore']);
    Route::get('/stores/search', [StoreController::class,'search'])->name('stores.search');
    Route::get('/stores/list', [StoreController::class, 'list'])->name('stores.list');
    Route::resource('stores', StoreController::class);

    Route::get('/variants/search', [VariantController::class,'search'])->name('variants.search');
    Route::get('/variants/list', [VariantController::class, 'list'])->name('variants.list');
    Route::resource('variants', VariantController::class);

    Route::get('/attributes/search', [AttributeController::class,'search'])->name('attributes.search');
    Route::get('/attributes/list', [AttributeController::class, 'list'])->name('attributes.list');
    Route::resource('attributes', AttributeController::class);

    Route::get('/mrn/search', [MrnController::class,'search'])->name('mrn.search');
    Route::get('/mrn/list', [MrnController::class, 'list'])->name('mrn.list');
    Route::resource('mrn', MrnController::class);

    Route::get('/issue/search', [IssueController::class,'search'])->name('issue.search');
    Route::get('/issue/list', [IssueController::class, 'list'])->name('issue.list');
    Route::resource('issue', IssueController::class);

    Route::get('/sale/search', [SaleController::class,'search'])->name('sale.search');
    Route::get('/sale/list', [SaleController::class, 'list'])->name('sale.list');
    Route::resource('sale', SaleController::class);

    Route::get('/purchase-orders/search', [SupplierController::class,'search'])->name('suppliers.search');
    Route::get('/purchase-orders/list', [PurchaseOrderController::class, 'list'])->name('purchase-orders.list');
    Route::resource('purchase-orders', PurchaseOrderController::class);

    Route::get('/suppliers/search', [SupplierController::class,'search'])->name('suppliers.search');
    Route::get('/suppliers/list', [SupplierController::class, 'list'])->name('suppliers.list');
    Route::resource('suppliers', SupplierController::class);

    Route::get('/customers/search', [CustomerController::class,'search'])->name('customers.search');
    Route::get('/customers/list', [CustomerController::class, 'list'])->name('customers.list');
    Route::resource('customers', CustomerController::class);

    Route::get('/employees/list', [EmployeeController::class, 'list'])->name('employees.list');
    Route::resource('employees', EmployeeController::class);

    Route::get('/subcategories/search', [SubCategoryController::class,'search'])->name('subcategories.search');
    Route::get('/subcategories/list', [SubCategoryController::class, 'list'])->name('subcategories.list');
    Route::resource('subcategories', SubCategoryController::class);

    Route::get('/categories/search', [CategoryController::class,'search'])->name('categories.search');
    Route::get('/categories/list', [CategoryController::class, 'list'])->name('categories.list');
    Route::resource('categories', CategoryController::class);

    Route::get('/units/search', [UnitController::class,'search'])->name('units.search');
    Route::get('/units/list', [UnitController::class, 'list'])->name('units.list');
    Route::resource('units', UnitController::class);

    Route::get('/taxes/search', [TaxController::class,'search'])->name('taxes.search');
    Route::get('/taxes/list', [TaxController::class, 'list'])->name('taxes.list');
    Route::resource('taxes', TaxController::class);

    Route::get('/items/search', [ItemController::class,'search'])->name('items.search');
    Route::get('/items/list', [ItemController::class, 'list'])->name('items.list');
    Route::resource('items', ItemController::class);

    Route::resource('purchase-orders', DashboardController::class);
    Route::resource('mrns', DashboardController::class);

    Route::get('/stocks/search', [StockController::class,'search'])->name('stocks.search');
    Route::get('/stocks/list', [StockController::class, 'list'])->name('stocks.list');
    Route::resource('stocks', StockController::class);

    Route::post('/upload-media', [MediaController::class, 'uploadMedia'])->name('upload.media');

    Route::resource('import', ImportDataController::class);

});
