<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

// Route::get('api/account/balance', 'AccountController@balance');
// Route::get('api/account/position', 'AccountController@position');
// Route::get('api/account/entrust', 'AccountController@entrust');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['prefix' => 'api'], function () {
	Route::group(['prefix' => 'account'], function () {
		Route::get('balance', 'AccountController@balance');
		Route::get('position', 'AccountController@position');
		Route::get('entrust', 'AccountController@entrust');
	});
});

Route::group(['middleware' => ['web']], function () {
    //
});
