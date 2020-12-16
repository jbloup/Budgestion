<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubTypeController;
use App\Http\Controllers\TypeController;
use App\Models\Category;
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

Route::get('/create/category', [CategoryController::class, 'create', 'index'])->middleware('auth');
Route::post('/create/category', [CategoryController::class, 'store', 'index'])->middleware('auth');



Route::get('/create/car', function () {
    return view('create/create_car');
})->middleware('auth')->name('car');

Route::post('/create/car', [CarController::class, 'create']);

Route::get('/create/type', [TypeController::class, 'create']);
Route::post('/create/type', [TypeController::class, 'store']);

Route::get('/create/type', [SubTypeController::class, 'create']);
Route::post('/create/type', [SubTypeController::class, 'store']);
