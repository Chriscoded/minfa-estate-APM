<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\WaterReadingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Tenant\TenantSectController;
use App\Http\Controllers\Tenant\TenantRentsController;
use App\Http\Controllers\Tenant\TenantComplainsController;
use App\Http\Controllers\Tenant\TenantApartmentController;
use App\Http\Controllers\ComplainsController;

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

    //Tenants ROUTES (ADMIN)
    Route::get('all-tenants', [TenantController::class, 'index']);
    Route::get('new-tenant', [TenantController::class, 'create']);
    Route::post('new-tenant', [TenantController::class, 'store']);
    Route::get('show-tenant/{id}', [TenantController::class, 'show']);
    Route::get('/edit-tenant/{id}', [TenantController::class, 'edit']);
    Route::post('/update-tenant/{id}', [TenantController::class, 'update']);
    Route::get('/delete-tenant/{id}', [TenantController::class, 'destroy']);

     //Building ROUTES (User)
     Route::get('all-buildings', [BuildingController::class, 'index']);
     Route::get('new-building', [BuildingController::class, 'create']);
     Route::post('new-building', [BuildingController::class, 'store']);
     Route::get('show-building/{id}', [BuildingController::class, 'show']);
     Route::get('/edit-building/{id}', [BuildingController::class, 'edit']);
     Route::post('/update-building/{id}', [BuildingController::class, 'update']);
     Route::get('/delete-building/{id}', [BuildingController::class, 'destroy']);

    //Apartments ROUTES (User)
    Route::get('all-apartments', [ApartmentController::class, 'index']);
    Route::get('new-apartment', [ApartmentController::class, 'create']);
    Route::post('new-apartment', [ApartmentController::class, 'store']);
    Route::get('show-apartment/{id}', [ApartmentController::class, 'show']);
    Route::get('/edit-apartment/{id}', [ApartmentController::class, 'edit']);
    Route::post('/update-apartment/{id}', [ApartmentController::class, 'update']);
    Route::get('/delete-apartment/{id}', [ApartmentController::class, 'destroy']);

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

    Route::get('/all-rent-payments', [PaymentController::class, 'all_paid_rents'])->name('all-rent-payments');
    Route::get('/delete-payment/{id}', [PaymentController::class, 'destroy_rent']);
    Route::get('/rent/accept', [PaymentController::class, 'accept_rent']);
    Route::get('/complains', [ComplainsController::class, 'index'])->name('all-tenants-complains');
    Route::get('/settle-complain', [ComplainsController::class, 'settle_complain']);


    // Tenant route Area
    Route::get('/tenant-dash', [TenantSectController::class, 'index']);

    // Tenant rent
    Route::get('/all-my-rents', [TenantRentsController::class, 'index']);
    Route::get('/my-new-rent', [TenantRentsController::class, 'new_rent']);
    Route::post('rent/rent-manually', [TenantRentsController::class, 'store'])->name('pay_manually');

    // Tenant complains
    Route::get('/all-my-complains', [TenantComplainsController::class, 'index']);
    Route::get('/my-new-complain', [TenantComplainsController::class, 'new_complain'])->name('my-new-complains');
    Route::post('complain/report', [TenantComplainsController::class, 'store'])->name('report_complain');
    //tenant view apartments
    Route::get('/available-apartments', [TenantApartmentController::class, 'available_apartments'])->name('available-apartments');

    //ajax route
    Route::get('/rent/amount', [TenantRentsController::class, 'rent_amount'])->name('rent-amount');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tenant/create-account/{email}', [TenantController::class, 'create_tenant_account']);

