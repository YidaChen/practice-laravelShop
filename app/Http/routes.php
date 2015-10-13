<?php

Route::group(['middleware' => ['auth', 'NotUser'], 'prefix' => 'back', 'namespace' => 'back'], function () {
	Route::get('/', 'backController@index');
	Route::resource('admin', 'adminController');
	Route::resource('category', 'categoryController');
	Route::resource('item', 'itemController');
	Route::put('item/updatePublished/{id}', 'itemController@updatePublished');
	Route::resource('review', 'reviewController');
	Route::put('review/updateSeen/{id}', 'reviewController@updateSeen');
});
Route::group(['middleware' => ['auth', 'NotUser']], function () {
	Route::controller('filemanager', 'FilemanagerLaravelController');
});
Route::group(['namespace' => 'front'], function () {
	Route::get('/item={id}', 'ShopController@show');
	Route::get('search', 'ShopController@search');
	Route::get('/{category?}', 'ShopController@index');
	Route::post('storeReview', 'reviewController@store');
});

// 認證路由
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 註冊路由
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('login/{provider?}', 'Auth\AuthController@login');