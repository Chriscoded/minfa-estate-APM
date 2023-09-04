<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WaterReadingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\PaymentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Route::redirect('/', 'admin-dash', 301);
Route::redirect('home', 'admin-dash', 301);


Route::group(['middleware' => ['auth']], function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin-dash', [AdminController::class, 'index']);

    Route::get('all-users', [UserController::class, 'index']);
    Route::get('new-user', [UserController::class, 'create']);
    Route::post('new-user', [UserController::class, 'store']);
    Route::get('show-user/{id}', [UserController::class, 'show']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::post('/update-user/{id}', [UserController::class, 'update']);
    Route::get('/delete-user/{id}', [UserController::class, 'destroy']);

    //Tenants ROUTES (ADMIN) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('all-tenants', [TenantController::class, 'index']);
    Route::get('new-tenant', [TenantController::class, 'create']);
    Route::post('new-tenant', [TenantController::class, 'store']);
    Route::get('show-tenant/{id}', [TenantController::class, 'show']);
    Route::get('/edit-tenant/{id}', [TenantController::class, 'edit']);
    Route::post('/update-tenant/{id}', [TenantController::class, 'update']);
    Route::get('/delete-tenant/{id}', [TenantController::class, 'destroy']);

    //Units ROUTES (User) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('all-units', [UnitController::class, 'index']);
    Route::get('new-unit', [UnitController::class, 'create']);
    Route::post('new-unit', [UnitController::class, 'store']);
    Route::get('show-unit/{id}', [UnitController::class, 'show']);
    Route::get('/edit-unit/{id}', [UnitController::class, 'edit']);
    Route::post('/update-unit/{id}', [UnitController::class, 'update']);
    Route::get('/delete-unit/{id}', [UnitController::class, 'destroy']);

    //VEHICLES ROUTES (User) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('all-vehicles', [VehicleController::class, 'index']);
    Route::get('new-vehicle', [VehicleController::class, 'create']);
    Route::post('new-vehicle', [VehicleController::class, 'store']);
    Route::get('show-vehicle/{id}', [VehicleController::class, 'show']);
    Route::get('/edit-vehicle/{id}', [VehicleController::class, 'edit']);
    Route::post('/update-vehicle/{id}', [VehicleController::class, 'update']);
    Route::get('/delete-vehicle/{id}', [VehicleController::class, 'destroy']);

    //WATER READINGS ROUTES (User) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('readings', [WaterReadingController::class, 'index']);
    Route::get('new-reading', [WaterReadingController::class, 'create']);
    Route::post('new-reading', [WaterReadingController::class, 'store']);
    Route::get('show-reading/{id}', [WaterReadingController::class, 'show']);
    Route::get('/edit-reading/{id}', [WaterReadingController::class, 'edit']);
    Route::post('/update-reading/{id}', [WaterReadingController::class, 'update']);
    Route::get('/delete-reading/{id}', [WaterReadingController::class, 'destroy']);


    //Invoices ROUTES (User) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('all-invoices', [InvoiceController::class, 'index']);
    Route::get('new-invoice',  [InvoiceController::class, 'create']);
    Route::post('new-invoice',  [InvoiceController::class, 'store']);
    Route::get('show-invoice/{id}',  [InvoiceController::class, 'show']);
    Route::get('/edit-invoice/{id}',  [InvoiceController::class, 'edit']);
    Route::post('/update-invoice/{id}',  [InvoiceController::class, 'update']);
    Route::get('/delete-invoice/{id}',  [InvoiceController::class, 'destroy']);


    //RECEIPTS ROUTES (ADMIN) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('receipts', [ReceiptController::class, 'index']);
    Route::get('new-receipt', [ReceiptController::class, 'create']);
    Route::post('new-receipt', [ReceiptController::class, 'store']);
    Route::get('/edit-receipt/{id}', [ReceiptController::class, 'edit']);
    Route::post('/update-receipt/{id}', [ReceiptController::class, 'update']);
    Route::get('/delete-receipt/{id}', [ReceiptController::class, 'destroy']);


    //PAYMENTS ROUTES (ADMIN) DEEEEEEVVVVVVVVVVVVVVVVVVEEEEELOPER
    Route::get('all-payments', [PaymentController::class, 'index']);
    Route::get('new-payment', [PaymentController::class, 'create']);
    Route::post('new-payment', [PaymentController::class, 'store']);
    Route::get('show-payment/{id}', [PaymentController::class, 'show']);
    Route::get('/edit-payment/{id}', [PaymentController::class, 'edit']);
    Route::post('/update-payment/{id}', [PaymentController::class, 'update']);
    Route::get('/delete-payment/{id}', [PaymentController::class, 'destroy']);

});
