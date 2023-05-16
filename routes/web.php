<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\DetailController;
use \App\Http\Controllers\ItemController;
use \App\Http\Controllers\ItemdetailsController;
use \App\Http\Controllers\InvoiceController;
use \App\Http\Controllers\ReportController;
use \App\Http\Controllers\PasswordController;

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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('customers', CustomerController::class);
Route::resource('items', ItemController::class);
Route::resource('invoices', InvoiceController::class);

Route::resource('details', DetailController::class)->except(['update', 'destroy']);
Route::put('details/district', [DetailController::class, 'districtUpdate'])->name('details.districtUpdate');
Route::delete('details/district', [DetailController::class, 'districtDestroy'])->name('details.districtDestroy');

Route::resource('itemdetails', ItemdetailsController::class)->except(['update', 'destroy']);
Route::put('itemdetails/district', [ItemdetailsController::class, 'categoryUpdate'])->name('itemdetails.categoryUpdate');
Route::delete('itemdetails/district', [ItemdetailsController::class, 'categoryDestroy'])->name('itemdetails.categoryDestroy');

Route::post('itemdetails/shape', [ItemdetailsController::class, 'subcategory'])->name('itemdetails.subcategory');
Route::put('itemdetails/shape', [ItemdetailsController::class, 'subcategoryUpdate'])->name('itemdetails.subcategoryUpdate');
Route::delete('itemdetails/shape', [ItemdetailsController::class, 'subcategoryDestroy'])->name('itemdetails.subcategoryDestroy');

Route::resource('users', UserController::class);
Route::resource('reports', ReportController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    Route::put('/profile', [PasswordController::class, 'update'])->name('password.update');
});
