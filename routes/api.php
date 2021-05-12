


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:api']], function(){
    Route::post('/resto', [App\Http\Controllers\RestaurantController::class, 'store']);
    Route::post('/resto/menu', [App\Http\Controllers\MenuController::class, 'getRestoMenu']);
    Route::post('/order/save', [App\Http\Controllers\RestaurantOrderController::class, 'store']);
});

Route::post('item/save', [ App\Http\Controllers\MenuController::class, 'saveMenuItem']);
