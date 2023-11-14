<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillingController;
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


Auth::routes();

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // DASHBOARD
    Route::middleware(['auth:sanctum', 'verified'])->get('/home', [HomeController::class, 'index'])->name('home');

    // DASHBOARD FILTER
    Route::middleware(['auth:sanctum', 'verified'])->put('/zworktech-rajagopuram/home/datefilter', [App\Http\Controllers\HomeController::class, 'datefilter'])->name('home.datefilter');
});


// CUSTOMER CONTROLLER
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // INDEX
    Route::middleware(['auth:sanctum', 'verified'])->get('/zworktech-rajagopuram/customer', [CustomerController::class, 'index'])->name('customer.index');
    // CREATE
    Route::middleware(['auth:sanctum', 'verified'])->get('/zworktech-rajagopuram/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    // STORE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    // EDIT
    Route::middleware(['auth:sanctum', 'verified'])->get('/zworktech-rajagopuram/customer/edit/{unique_key}', [CustomerController::class, 'edit'])->name('customer.edit');
    // UPDATE
    Route::middleware(['auth:sanctum', 'verified'])->put('/zworktech-rajagopuram/customer/update/{unique_key}', [CustomerController::class, 'update'])->name('customer.update');
    // DELETE
    Route::middleware(['auth:sanctum', 'verified'])->put('/zworktech-rajagopuram/customer/delete/{unique_key}', [CustomerController::class, 'delete'])->name('customer.delete');
    // CHECK DUPLICATE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/customer/checkduplicate', [CustomerController::class, 'checkduplicate'])->name('customer.checkduplicate');
});




// EMPLOYEE CONTROLLER
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // INDEX
    Route::middleware(['auth:sanctum', 'verified'])->get('/zworktech-rajagopuram/employee', [EmployeeController::class, 'index'])->name('employee.index');
    // STORE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    // EDIT
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/employee/edit/{unique_key}', [EmployeeController::class, 'edit'])->name('employee.edit');
    // DELETE
    Route::middleware(['auth:sanctum', 'verified'])->put('/zworktech-rajagopuram/employee/delete/{unique_key}', [EmployeeController::class, 'delete'])->name('employee.delete');
    // CHECK DUPLICATE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/employee/checkduplicate', [EmployeeController::class, 'checkduplicate'])->name('employee.checkduplicate');
});


// PRODUCT CONTROLLER
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // INDEX
    Route::middleware(['auth:sanctum', 'verified'])->get('/zworktech-rajagopuram/product', [ProductController::class, 'index'])->name('product.index');
    // STORE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/product/store', [ProductController::class, 'store'])->name('product.store');
    // EDIT
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/product/edit/{unique_key}', [ProductController::class, 'edit'])->name('product.edit');
    // DELETE
    Route::middleware(['auth:sanctum', 'verified'])->put('/zworktech-rajagopuram/product/delete/{unique_key}', [ProductController::class, 'delete'])->name('product.delete');
});



// BILLING CONTROLLER
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // INDEX
    Route::middleware(['auth:sanctum', 'verified'])->get('/zworktech-rajagopuram/billing', [BillingController::class, 'index'])->name('billing.index');
    // STORE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/billing/store', [BillingController::class, 'store'])->name('billing.store');
    // EDIT
    Route::middleware(['auth:sanctum', 'verified'])->post('/zworktech-rajagopuram/billing/edit/{unique_key}', [BillingController::class, 'edit'])->name('billing.edit');
    // DELETE
    Route::middleware(['auth:sanctum', 'verified'])->put('/zworktech-rajagopuram/billing/delete/{unique_key}', [BillingController::class, 'delete'])->name('billing.delete');
});