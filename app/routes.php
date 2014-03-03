<?php

// Model Binding
Route::model('user', 'Tyloo\User');

// Namespacing the Controllers
Route::group(['namespace' => 'Tyloo\Controllers'], function() {

	// Guest Routes
	Route::group(['before' => 'guest'], function() {

		// Register
		Route::get('register', ['as' => 'auth.getRegister', 'uses' => 'AuthController@getRegister']);
		Route::post('register', ['as' => 'auth.postRegister', 'uses' => 'AuthController@postRegister']);

		// Login
		Route::get('login', ['as' => 'auth.getLogin', 'uses' => 'AuthController@getLogin']);
		Route::post('login', ['as' => 'auth.postLogin', 'uses' => 'AuthController@postLogin']);

	});

	// Authenticated Routes
	Route::group(['before' => 'auth'], function() {

		// Logout
		Route::get('logout', ['as' => 'auth.getLogout', 'uses' => 'AuthController@getLogout']);

		// My Profile
		Route::get('profile', ['as' => 'users.getProfile', 'uses' => 'UserController@getProfile']);
		Route::put('profile', ['as' => 'users.postProfile', 'uses' => 'UserController@postProfile']);

	});

	// Home
	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

	// Public Profile
	//Route::get('{user}', ['as' => 'users.getPublicProfile', 'uses' => 'UserController@getPublicProfile']);

});