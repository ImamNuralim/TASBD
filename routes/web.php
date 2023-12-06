<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\motorController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::get('/login/store', [LoginController::class, 'store'])->name('login.store');


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/motor/add', [motorController::class, 'create'])->name('motor.create');
Route::post('/motor/store', [motorController::class, 'store'])->name('motor.store');
Route::get('/motor', [motorController::class, 'index'])->name('motor.index');
Route::get('/motor/edit/{id}', [motorController::class, 'edit'])->name('motor.edit');
Route::post('/motor/update/{id}', [motorController::class, 'update'])->name('motor.update');
Route::post('/motor/delete/{id}', [motorController::class, 'delete'])->name('motor.delete');
Route::get('/motor/search', [motorController::class, 'search'])->name('motor.search');
Route::get('/motor/hide/{id}', [motorController::class, 'hide'])->name('motor.hide');
Route::get('/motor/trash', [motorController::class, 'trash'])->name('motor.trash');
Route::get('/motor/restore/{id}', [motorController::class, 'restore'])->name('motor.restore');
Route::get('/motor/search/trash', [motorController::class, 'search_trash'])->name('motor.search_trash');


Route::get('/sopir/add', [SopirController::class, 'create'])->name('sopir.create');
Route::post('/sopir/store', [SopirController::class, 'store'])->name('sopir.store');
Route::get('/sopir', [SopirController::class, 'index'])->name('sopir.index');
Route::get('/sopir/edit/{id}', [SopirController::class, 'edit'])->name('sopir.edit');
Route::post('/sopir/update/{id}', [SopirController::class, 'update'])->name('sopir.update');
Route::post('/sopir/delete/{id}', [SopirController::class, 'delete'])->name('sopir.delete');
Route::get('/sopir/search', [SopirController::class, 'search'])->name('sopir.search');
Route::get('/sopir/hide/{id}', [SopirController::class, 'hide'])->name('sopir.hide');
Route::get('/sopir/trash', [SopirController::class, 'trash'])->name('sopir.trash');
Route::get('/sopir/restore/{id}', [SopirController::class, 'restore'])->name('sopir.restore');
Route::get('/sopir/search/trash', [SopirController::class, 'search_trash'])->name('sopir.search_trash');


Route::get('/customer/add', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::post('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');
Route::get('/customer/hide/{id}', [CustomerController::class, 'hide'])->name('customer.hide');
Route::get('/customer/trash', [CustomerController::class, 'trash'])->name('customer.trash');
Route::get('/customer/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore');
Route::get('/customer/search/trash', [CustomerController::class, 'search_trash'])->name('customer.search_trash');


Route::get('/rental/add', [RentalController::class, 'create'])->name('rental.create');
Route::post('/rental/store', [RentalController::class, 'store'])->name('rental.store');
Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
Route::get('/rental/edit/{id}', [RentalController::class, 'edit'])->name('rental.edit');
Route::post('/rental/update/{id}', [RentalController::class, 'update'])->name('rental.update');
Route::post('/rental/delete/{id}', [RentalController::class, 'delete'])->name('rental.delete');