<?php

use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Api\V1\GetMenuItems;
use App\Http\Controllers\Api\V1\GetRestaurantDetails;
use App\Http\Controllers\Api\V1\GetRestaurantMenus;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){
    // Admin ajax json apis
    Route::get('restaurant/menus', GetRestaurantMenus::class)->name('restaurant.menus');
    Route::get('menu/items', GetMenuItems::class)->name('menu.items');
    Route::post('extras', [ExtraController::class, 'store'])->name('extras.store');

    // Mobile App apis
    Route::name('api.v1.')->group(function (){
        Route::get('restaurant/{restaurant}', GetRestaurantDetails::class)->name('restaurant');

    });
});
