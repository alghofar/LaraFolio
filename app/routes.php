<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group([ 'namespace' => 'Tyloo\Controllers' ], function () {
	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

	// User routes
	Route::get('register', ['as' => 'users.getRegister', 'uses' => 'UserController@getRegister']);
	Route::post('register', ['as' => 'users.postRegister', 'uses' => 'UserController@postRegister']);

	Route::get('profile', ['as' => 'users.getProfile', 'uses' => 'UserController@getProfile']);

	// Auth routes
	Route::get('login', ['as' => 'auth.getLogin', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'auth.postLogin', 'uses' => 'AuthController@postLogin']);

	Route::get('logout', ['as' => 'auth.getLogout', 'uses' => 'AuthController@getLogout']);
});