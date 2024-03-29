<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('signup', '\App\Http\Controllers\AuthController@createUser');
    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');

});

Route::group([
    "middleware" => "auth:api"
], function () {

    Route::get('alerts', '\App\Http\Controllers\AlertsController@index');
    Route::post('alerts/create', '\App\Http\Controllers\AlertsController@create');
    Route::get('sensors/{id}/{parameter}', '\App\Http\Controllers\SensorsController@show')->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
	Route::get('sensors', '\App\Http\Controllers\SensorsController@index');
});

Route::get('ngos', function () {
	return \App\Ngo::all(["id", "name"]);
});