<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\SpentController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TypeController;
use App\Models\User;
use App\Providers\FortifyServiceProvider;
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
    return view('welcome');
});

Route::get('/home', [Controller::class, 'home'])->name('home')->middleware('auth');


Route::get('/table/month', [TableController::class, 'month'])->name('month')->middleware('auth');
Route::get('/table/year', [TableController::class, 'year'])->name('year')->middleware('auth');

Route::get('/category', [CategoryController::class, 'view'])->name('category')->middleware('auth');
Route::post('/category', [CategoryController::class, 'create'])->name('create_category')->middleware('auth');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('update_category')->middleware('auth');
Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('delete_category')->middleware('auth');

Route::get('/type', [TypeController::class, 'view'])->name('type')->middleware('auth');
Route::post('/type', [TypeController::class, 'create'])->name('create_type')->middleware('auth');
Route::put('/type/{id}', [TypeController::class, 'update'])->name('update_type')->middleware('auth');
Route::delete('/type/{id}', [TypeController::class, 'delete'])->name('delete_type')->middleware('auth');

Route::get('/subtype', [FamilyController::class, 'view'])->name('family')->middleware('auth');
Route::post('/subtype', [FamilyController::class, 'create'])->name('create_family')->middleware('auth');
Route::put('/subtype/{id}', [FamilyController::class, 'update'])->name('update_family')->middleware('auth');
Route::delete('/subtype/{id}', [FamilyController::class, 'delete'])->name('delete_family')->middleware('auth');

Route::get('/account', [AccountController::class, 'view'])->name('account')->middleware('auth');
Route::post('/account', [AccountController::class, 'create'])->name('create_account')->middleware('auth');
Route::put('/account/{id}', [AccountController::class, 'update'])->name('update_account')->middleware('auth');
Route::delete('/account/{id}', [AccountController::class, 'delete'])->name('delete_account')->middleware('auth');

Route::get('/spent', [SpentController::class, 'view'])->name('spent')->middleware('auth');
Route::post('/spent', [SpentController::class, 'create'])->name('create_spent')->middleware('auth');
Route::post('/spent/import', [SpentController::class, 'import'])->name('import_spent')->middleware('auth');
Route::put('/spent/{i}', [SpentController::class, 'update'])->name('update_spent')->middleware('auth');
Route::delete('/spent/{i}', [SpentController::class, 'delete'])->name('delete_spent')->middleware('auth');

Route::get('/car', [CarController::class, 'view'])->name('car')->middleware('auth');
Route::post('/car', [CarController::class, 'create'])->name('create_car')->middleware('auth');
Route::post('/car/import', [CarController::class, 'import'])->name('import_car')->middleware('auth');
Route::put('/car/{id}', [CarController::class, 'update'])->name('update_car')->middleware('auth');
Route::delete('/car/{id}', [CarController::class, 'delete'])->name('delete_car')->middleware('auth');

Route::get('/fuel', [FuelController::class, 'view'])->name('fuel')->middleware('auth');
Route::post('/fuel', [FuelController::class, 'create'])->name('create_fuel')->middleware('auth');
Route::put('/fuel/{id}', [FuelController::class, 'update'])->name('update_fuel')->middleware('auth');
Route::delete('/fuel/{id}', [FuelController::class, 'delete'])->name('delete_fuel')->middleware('auth');





