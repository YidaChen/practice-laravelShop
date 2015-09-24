<?php

Route::group(['middleware' => 'auth', 'prefix' => 'back', 'namespace' => 'back'], function () {
	Route::get('/', 'backController@index');
	Route::resource('admin', 'adminController');
});

// 認證路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');