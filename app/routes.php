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

	// Session routes
	Route::get('login', ['as' => 'sessions.getLogin', 'uses' => 'SessionController@getLogin']);
	Route::post('login', ['as' => 'sessions.postLogin', 'uses' => 'SessionController@postLogin']);

	Route::get('logout', ['as' => 'sessions.getLogout', 'uses' => 'SessionController@getLogout']);
});