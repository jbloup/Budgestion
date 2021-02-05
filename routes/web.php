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


Route::get('/table/month', [TableController::class, 'view'])->name('month')->middleware('auth');

Route::get('/spent', [SpentController::class, 'view'])->name('spent')->middleware('auth');
Route::post('/spent', [SpentController::class, 'create'])->name('create_spent')->middleware('auth');
Route::post('/spent/import', [SpentController::class, 'import'])->name('import_spent')->middleware('auth');
Route::put('/spent/{i}', [SpentController::class, 'update'])->name('update_spent')->middleware('auth');
Route::delete('/spent/{i}', [SpentController::class, 'delete'])->name('delete_spent')->middleware('auth');

Route::get('/create/category', [CategoryController::class, 'create'])->middleware('auth');
Route::post('/create/category', [CategoryController::class, 'create'])->name('create_category')->middleware('auth');
Route::post('/create/category_update', [CategoryController::class, 'update'])->name('update_category')->middleware('auth');
Route::get('/create/category_update', [CategoryController::class, 'create'])->middleware('auth');
Route::get('/create/category_delete', [CategoryController::class, 'delete'])->name('delete_category')->middleware('auth');

Route::get('/create/type', [TypeController::class, 'create'])->middleware('auth');
Route::post('/create/type', [TypeController::class, 'create'])->name('create_type')->middleware('auth');
Route::post('/create/type_update', [TypeController::class, 'update'])->name('update_type')->middleware('auth');
Route::get('/create/type_update', [TypeController::class, 'create'])->middleware('auth');
Route::get('/create/type_delete', [TypeController::class, 'delete'])->name('delete_type')->middleware('auth');

Route::get('/create/subtype', [FamilyController::class, 'create'])->middleware('auth');
Route::post('/create/subtype', [FamilyController::class, 'create'])->name('create_family')->middleware('auth');
Route::post('/create/subtype_update', [FamilyController::class, 'update'])->name('update_family')->middleware('auth');
Route::get('/create/subtype_update', [FamilyController::class, 'create'])->middleware('auth');
Route::get('/create/subtype_delete', [FamilyController::class, 'delete'])->name('delete_family')->middleware('auth');

Route::get('/car', [CarController::class, 'view'])->name('car')->middleware('auth');
Route::post('/car', [CarController::class, 'create'])->name('create_car')->middleware('auth');
Route::post('/car/import', [CarController::class, 'import'])->name('import_car')->middleware('auth');
Route::put('/car/{id}', [CarController::class, 'update'])->name('update_car')->middleware('auth');
Route::delete('/car/{id}', [CarController::class, 'delete'])->name('delete_car')->middleware('auth');

Route::get('/create/account', [AccountController::class, 'create'])->middleware('auth');
Route::post('/create/account', [AccountController::class, 'create'])->name('create_account')->middleware('auth');
Route::post('/create/account_update', [AccountController::class, 'update'])->name('update_account')->middleware('auth');
Route::get('/create/account_update', [AccountController::class, 'create'])->middleware('auth');
Route::get('/create/account_delete', [AccountController::class, 'delete'])->name('delete_account')->middleware('auth');

Route::get('/create/fuel', [FuelController::class, 'create'])->name('fuel')->middleware('auth');
Route::post('/create/fuel', [FuelController::class, 'create'])->name('create_fuel')->middleware('auth');
Route::post('/create/fuel_update', [FuelController::class, 'update'])->name('update_fuel')->middleware('auth');
Route::get('/create/fuel_update', [FuelController::class, 'create'])->middleware('auth');
Route::get('/create/fuel_delete', [FuelController::class, 'delete'])->name('delete_fuel')->middleware('auth');





