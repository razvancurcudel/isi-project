<?php

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

use App\Alert;

Route::get('/', function () {
	$alert = Alert::where('id', 1)->first();

    return view('emails.test')->with('alert', $alert);
});


Route::get('/login', function () {
    return "login page";
});