<?php

Route::group(['middleware' => ['auth', 'NotUser'], 'prefix' => 'back', 'namespace' => 'back'], function () {
	Route::get('/', 'backController@index');
	Route::resource('admin', 'adminController');
	Route::resource('category', 'categoryController');
	Route::resource('item', 'itemController');
});
Route::group(['middleware' => ['auth', 'NotUser']], function () {
	Route::controller('filemanager', 'FilemanagerLaravelController');
});
Route::group(['namespace' => 'front'], function () {
	Route::get('/', 'ShopController@index');
	Route::get('/{id}', 'ShopController@show');
});

// 認證路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');