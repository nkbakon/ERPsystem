<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\DetailController;

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

Route::resource('details', DetailController::class)->except(['update', 'destroy']);
Route::put('details/district', [DetailController::class, 'districtUpdate'])->name('details.districtUpdate');
Route::delete('details/district', [DetailController::class, 'districtDestroy'])->name('details.districtDestroy');

Route::resource('users', UserController::class);
