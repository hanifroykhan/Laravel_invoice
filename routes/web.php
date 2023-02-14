<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\InvoiceController;

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
    return view('auth.login');
});

Auth::routes();

// Products
Route::get('/indexProducts',[ProductController::class, 'index'])->name('indexProducts');
Route::get('/createProducts',[ProductController::class, 'create'])->name('createProducts');
Route::post('/storeProducts', [ProductController::class,'store'])->name('storeProducts');
Route::get('editProduct/{id}', [ProductController::class, 'edit']);
Route::put('updateProduct/{id}', [ProductController::class, 'update']);
Route::get('deleteProduct/{id}',[ProductController::class, 'destroy']);

// Customer
Route::get('/indexCustomers', [CustomerController::class,'index'])->name('indexCustomers');
Route::get('/createCustomers',[CustomerController::class, 'create'])->name('createCustomers');
Route::post('/storeCustomers', [CustomerController::class,'store'])->name('storeCustomers');
Route::get('editCustomer/{id}', [CustomerController::class, 'edit']);
Route::put('updateCustomer/{id}', [CustomerController::class, 'update']);
Route::get('deleteCustomer/{id}',[CustomerController::class, 'destroy']);

// Invoice
Route::get('/indexInvoice', [InvoiceController::class,'index'])->name('indexInvoice');
Route::get('/createInvoice',[InvoiceController::class, 'create'])->name('createInvoice');
Route::post('/storeInvoice', [InvoiceController::class,'store'])->name('storeInvoice');
Route::get('paymentInvoice/{id}', [InvoiceController::class, 'payment'])->name('payInvoice');
Route::get('printInvoice/{id}', [InvoiceController::class, 'print'])->name('printInvoice');
Route::get('editInvoice/{id}', [InvoiceController::class, 'edit'])->name('editInvoice');
Route::put('updateInvoice/{id}', [InvoiceController::class, 'update'])->name('updateInvoice');
Route::delete('deleteInvoice/{id}', [InvoiceController::class,'destroy'])->name('deleteInvoice');