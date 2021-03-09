<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\SpentController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
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

Route::get('/', [Controller::class, 'welcome'])->name('welcome')->middleware('guest');

Route::get('/forgot-password', [PasswordController::class, 'forgot'])->name('password.email')->middleware('guest');
Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('password.email')->middleware('guest');

Route::get('/reset-password/{token}', [PasswordController::class, 'reset'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('password.update')->middleware('guest');

Route::get('/profil', [UserController::class, 'view'])->name('profil')->middleware('auth');

Route::get('/home', [Controller::class, 'home'])->name('home')->middleware('auth');

Route::get('/month', [TableController::class, 'month'])->name('month.view')->middleware('auth');
Route::post('/month', [TableController::class, 'month'])->name('month')->middleware('auth');

Route::get('year', [TableController::class, 'year'])->name('year.view')->middleware('auth');
Route::post('year', [TableController::class, 'year'])->name('year')->middleware('auth');

Route::get('/category', [CategoryController::class, 'view'])->name('category')->middleware('auth');
Route::post('/category', [CategoryController::class, 'create'])->name('create.category')->middleware('auth');
Route::put('/category/{id}', [CategoryController::class, 'update'])->middleware('auth');
Route::delete('/category/{id}', [CategoryController::class, 'delete'])->middleware('auth');

Route::get('/type', [TypeController::class, 'view'])->name('type')->middleware('auth');
Route::post('/type', [TypeController::class, 'create'])->name('create.type')->middleware('auth');
Route::put('/type/{id}', [TypeController::class, 'update'])->middleware('auth');
Route::delete('/type/{id}', [TypeController::class, 'delete'])->middleware('auth');

Route::get('/subtype', [FamilyController::class, 'view'])->name('family')->middleware('auth');
Route::post('/subtype', [FamilyController::class, 'create'])->name('create.family')->middleware('auth');
Route::put('/subtype/{id}', [FamilyController::class, 'update'])->middleware('auth');
Route::delete('/subtype/{id}', [FamilyController::class, 'delete'])->middleware('auth');

Route::get('/account', [AccountController::class, 'view'])->name('account')->middleware('auth');
Route::post('/account', [AccountController::class, 'create'])->name('create.account')->middleware('auth');
Route::put('/account/{id}', [AccountController::class, 'update'])->middleware('auth');
Route::delete('/account/{id}', [AccountController::class, 'delete'])->middleware('auth');

Route::get('/spent', [SpentController::class, 'view'])->name('spent')->middleware('auth');
Route::post('/spent', [SpentController::class, 'create'])->name('create.spent')->middleware('auth');
Route::post('/spent/import', [SpentController::class, 'import'])->name('import_spent')->middleware('auth');
Route::put('/spent/{i}', [SpentController::class, 'update'])->middleware('auth');
Route::delete('/spent/{i}', [SpentController::class, 'delete'])->middleware('auth');

Route::get('/car', [CarController::class, 'view'])->name('car')->middleware('auth');
Route::post('/car', [CarController::class, 'create'])->name('create.car')->middleware('auth');
Route::post('/car/import', [CarController::class, 'import'])->name('import_car')->middleware('auth');
Route::put('/car/{id}', [CarController::class, 'update'])->middleware('auth');
Route::delete('/car/{id}', [CarController::class, 'delete'])->middleware('auth');

Route::get('/fuel', [FuelController::class, 'view'])->name('fuel')->middleware('auth');
Route::post('/fuel', [FuelController::class, 'create'])->name('create.fuel')->middleware('auth');
Route::put('/fuel/{id}', [FuelController::class, 'update'])->middleware('auth');
Route::delete('/fuel/{id}', [FuelController::class, 'delete'])->middleware('auth');





