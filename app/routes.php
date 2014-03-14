<?php

// Namespacing the Root Controllers
Route::group(['namespace' => 'Tyloo\Controllers'], function () {

    // Guest Routes
    Route::group(['before' => 'guest'], function () {

        // Register
        Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@register']);
        Route::post('register', ['as' => 'auth.postRegister', 'uses' => 'AuthController@postRegister']);

        // Login
        Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
        Route::post('login', ['as' => 'auth.postLogin', 'uses' => 'AuthController@postLogin']);
        Route::get('activate/{user_id}/{token}', ['as' => 'auth.activate', 'uses' => 'AuthController@activate']);

    });

    // Authenticated Routes
    Route::group(['before' => 'auth'], function () {

        // Logout
        Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);

        // My Settings
        Route::get('settings', ['as' => 'users.settings', 'uses' => 'UserController@settings']);
        Route::post('settings', ['as' => 'users.postSettings', 'uses' => 'UserController@postSettings']);

        // My Profile
        Route::get('profile', ['as' => 'users.profile', 'uses' => 'UserController@profile']);
        Route::post('profile', ['as' => 'users.postProfile', 'uses' => 'UserController@postProfile']);
    });

    // Home
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // Public Profile
    Route::get('{username}', ['as' => 'users.profilePublic', 'uses' => 'UserController@profilePublic']);

});

// Namespacing the Admin Controllers
Route::group(['namespace' => 'Tyloo\Controllers\Admin'], function () {
    Route::group(['prefix' => 'admin', 'before' => 'admin'], function () {
        Route::get('users/{id}/suspend', ['as' => 'admin.users.suspend', 'uses' => 'UsersController@suspend']);
        Route::get('users/{id}/restore', ['as' => 'admin.users.restore', 'uses' => 'UsersController@restore']);
        Route::get('users/{id}/delete', ['as' => 'admin.users.delete', 'uses' => 'UsersController@destroy']);
        Route::resource('users', 'UsersController', ['except' => ['show']]);
    });
});
