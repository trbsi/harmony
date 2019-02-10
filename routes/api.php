<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->prefix('system')->group(function () {
	Route::prefix('v1')->group(function () {
		Route::get('/user', function (Request $request) {
		    return $request->user();
		});

		Route::prefix('numbers')->group(function () {
			Route::post('','\App\Api\V1\Numbers\Controllers\NumbersController@save');
		});
	});
});


	
