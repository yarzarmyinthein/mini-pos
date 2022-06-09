<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/profile',\App\Http\Controllers\ProfileController::class);
Route::resource('/category',\App\Http\Controllers\CategoryController::class);
Route::resource('/item',\App\Http\Controllers\ItemController::class);

Route::get('/pos',[\App\Http\Controllers\PosController::class,'index'])->name('pos');
Route::post('/order',[\App\Http\Controllers\PosController::class,'order'])->name('order');
