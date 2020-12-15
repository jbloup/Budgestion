<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
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

Route::get('/create/category', function () {
    return view('create/create_category');
})->middleware('auth')->name('category');

Route::post('/create/category', [CategoryController::class, 'create']);

Route::get('/create/car', function () {
    return view('create/create_car');
})->middleware('auth')->name('car');

Route::post('/create/car', [CarController::class, 'create']);
