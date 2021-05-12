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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/restaurants', [App\Http\Controllers\RestaurantController::class, 'index'])->name('restos');
    Route::get('/restaurants/menu/{id}', [App\Http\Controllers\MenuController::class, 'index'])->name('restos.menu');
    Route::get('/restaurants/orders/{id}', [App\Http\Controllers\RestaurantOrderController::class, 'index'])->name('restos.orders');
    Route::get('/restaurants/orders/{id}/add', [App\Http\Controllers\RestaurantOrderController::class, 'add'])->name('restos.orders.add');
});



