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

Route::prefix('inventory')->group(function () {
    Route::get('index', 'InventoryController@index');
    Route::get('search', 'InventoryController@search');
    Route::post('{id}/update', 'InventoryController@update');
});
