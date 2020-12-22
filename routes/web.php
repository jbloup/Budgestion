<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\TypeController;
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

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/create/category', [CategoryController::class, 'create'])->middleware('auth');
Route::post('/create/category', [CategoryController::class, 'store'])->middleware('auth');

Route::get('/create/type', [TypeController::class, 'create'])->middleware('auth');
Route::post('/create/type', [TypeController::class, 'store'])->middleware('auth');


Route::get('/create/subtype', [FamilyController::class, 'create'])->middleware('auth');
Route::post('/create/subtype', [FamilyController::class, 'store'])->middleware('auth')->name('family');

Route::get('/create/car', [CarController::class, 'create'])->middleware('auth');
Route::post('/create/car', [CarController::class, 'store'])->name('store_car')->middleware('auth');
Route::post('/create/car_update', [CarController::class, 'update'])->name('update_car')->middleware('auth');
Route::get('/create/car_update', [CarController::class, 'create'])->middleware('auth');
Route::post('/create/car_delete', [CarController::class, 'delete'])->name('delete_car')->middleware('auth');
Route::get('/create/car_delete', [CarController::class, 'create'])->middleware('auth');

